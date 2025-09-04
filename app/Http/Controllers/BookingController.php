<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\GuideAvailability;
use App\Models\Setting;
use App\Models\User;
use App\Models\PromoCode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookings()
    {
        $bookings = Booking::where('customer_id', auth()->id())
            ->with(['guide', 'guide.guideProfile'])
            ->latest()
            ->get();

        return view('landing.booking-history', compact('bookings'));
    }

    public function create($guideId)
    {
        $guide = User::where('role', 'guide')
            ->whereHas('guideProfile', function($q) {
                $q->where('status', 'active');
            })
            ->with('guideProfile')
            ->findOrFail($guideId);

        return view('landing.booking', compact('guide'));
    }


    private function generateBookingCode()
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $randomLength = 4;

        $datePart = now()->format('yymdHi'); // YYMMDD

        do {
            $randomPart = '';
            for ($i = 0; $i < $randomLength; $i++) {
                $randomPart .= $characters[random_int(0, strlen($characters) - 1)];
            }

            $code = "G-{$datePart}-{$randomPart}";
        } while (Booking::where('booking_code', $code)->exists());

        return $code;
    }

    public function store(Request $request)
    {
        $request->validate([
            'guide_id' => 'required|exists:users,id,role,guide',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:now',
            'number_of_travelers' => 'required|integer|min:1',
            'destination' => 'required|string',
            'notes' => 'nullable|string',
            'promo_code' => 'nullable|string|exists:promo_codes,code',
        ]);

        $guide = User::where('role', 'guide')
            ->whereHas('guideProfile', function($q) {
                $q->where('status', 'active');
            })
            ->with('guideProfile')
            ->findOrFail($request->guide_id);
        $profile = $guide->guideProfile;

        // Cek kapasitas
        if ($request->number_of_travelers > $profile->max_travelers) {
            return back()->withErrors(['number_of_travelers' => "Maksimal {$profile->max_travelers} orang."]);
        }

        $start = Carbon::parse($request->start_time)->startOfDay();
        $end = Carbon::parse($request->end_time)->endOfDay();

        $datesInRange = [];
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $datesInRange[] = $date->format('Y-m-d');
        }

        // 1. Cek konflik booking
        $hasBookingConflict = Booking::where('guide_id', $guide->id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                    });
            })->exists();

        // 2. Cek apakah SEMUA tanggal di rentang sudah di-set 'available'
        $availableDatesCount = GuideAvailability::where('guide_id', $guide->id)
            ->whereIn('date', $datesInRange)
            ->where('status', 'available')
            ->count();

        $allDatesAvailable = $availableDatesCount === count($datesInRange);

        if ($hasBookingConflict || !$allDatesAvailable) {
            $errorMessage = '';

            if ($hasBookingConflict) {
                $errorMessage = 'Guide sudah memiliki booking lain pada tanggal yang dipilih. ';
            }

            if (!$allDatesAvailable) {
                $errorMessage .= 'Guide belum menandai ketersediaan untuk semua tanggal yang dipilih. ';
            }

            $errorMessage .= 'Silakan pilih tanggal lain atau hubungi admin untuk konfirmasi ketersediaan.';

            return back()->withErrors([
                'start_time' => $errorMessage
            ]);
        }

        // Hitung harga
        $start = Carbon::parse($request->start_time);
        $end = Carbon::parse($request->end_time);

        // For same-day bookings, count as 1 day
        // For multi-day bookings, count the actual difference
        if ($start->isSameDay($end)) {
            $totalDays = 1;
        } else {
            $totalDays = $start->diffInDays($end);
        }

        $subTotal = $profile->daily_rate * $totalDays;
        $feeType = Setting::getValue('platform_fee_type') ?? 'percentage';
        $feeValue = (float) Setting::getValue('platform_fee_value') ?? 15;

        $platformFee = $feeType === 'percentage'
            ? ($subTotal * $feeValue / 100)
            : $feeValue;

        $totalAmount = $subTotal + $platformFee;

        // Proses promo code
        $promoCode = null;
        $discountAmount = 0;
        $finalAmount = $totalAmount;

        if ($request->promo_code) {
            $promoCode = PromoCode::where('code', strtoupper($request->promo_code))->first();

            if ($promoCode && $promoCode->isValid()) {
                $discountAmount = $promoCode->calculateDiscount($totalAmount);
                $finalAmount = $totalAmount - $discountAmount;

                // Increment usage count
                $promoCode->incrementUsage();
            }
        }

        $booking = Booking::create([
            'customer_id' => auth()->id(),
            'booking_code' => $this->generateBookingCode(),
            'guide_id' => $guide->id,
            'guide_profile_id' => $profile->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_days' => $totalDays,
            'number_of_travelers' => $request->number_of_travelers,
            'destination' => $request->destination,
            'notes' => $request->notes,
            'status' => 'pending',
            'guide_daily_rate' => $profile->daily_rate,
            'sub_total' => $subTotal,
            'platform_fee' => $platformFee,
            'total_price' => $totalAmount,
            'promo_code' => $promoCode ? $promoCode->code : null,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'fee_type' => $feeType,
            'fee_value' => $feeValue,
        ]);

        // Kirim Telegram
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        // Pastikan relasi dimuat
        $booking->load(['customer', 'guide', 'guide.guideProfile']);

        $customer = $booking->customer;
        $guide = $booking->guide;
        $profile = $guide->guideProfile;

        $customerName = $customer->name;
        $customerEmail = $customer->email;
        $customerPhone = $customer->phone
            ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', ltrim($customer->phone, '0'))
            : '-';

        $guideName = $guide->name;
        $guideLevel = $profile->level ?? '-';
        $bookingCode = $booking->booking_code;
        $destination = $booking->destination;
        $notes = $booking->notes ?? 'Tidak ada';

        // Buat pesan plain text
        $message  = "🚨 PESANAN BARU DITERIMA 🚨\n\n";
        $message .= "📦 Detail Pemesanan:\n";
        $message .= "• Kode: {$bookingCode}\n";
        $message .= "• Status: {$booking->status}\n\n";

        $message .= "👤 Customer:\n";
        $message .= "• Nama: {$customerName}\n";
        $message .= "• Email: {$customerEmail}\n";
        $message .= "• HP: {$customerPhone}\n\n";

        $message .= "🧑‍✈️ Pemandu:\n";
        $message .= "• Nama: {$guideName}\n";
        $message .= "• Level: {$guideLevel}\n\n";

        $message .= "📅 Jadwal:\n";
        $message .= "• Mulai: {$booking->start_time->format('d M Y H:i')}\n";
        $message .= "• Selesai: {$booking->end_time->format('d M Y H:i')}\n";
        $message .= "• Durasi: {$booking->total_days} hari\n";
        $message .= "• Jumlah Wisatawan: {$booking->number_of_travelers}\n\n";

        $message .= "💰 Total: Rp " . number_format($booking->total_price, 0, ',', '.') . "\n";
        if ($booking->promo_code) {
            $message .= "🎫 Promo Code: {$booking->promo_code}\n";
            $message .= "💸 Discount: Rp " . number_format($booking->discount_amount, 0, ',', '.') . "\n";
            $message .= "💳 Final Amount: Rp " . number_format($booking->final_amount, 0, ',', '.') . "\n";
        }
        $message .= "\n📍 Tujuan: {$destination}\n\n";
        $message .= "📝 Catatan: {$notes}";

        // Kirim ke Telegram
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'disable_web_page_preview' => true
        ];

        $url = "https://api.telegram.org/bot{$token}/sendMessage";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        if (curl_error($ch)) {
            echo ('Telegram send error: ' . curl_error($ch));
        }
        curl_close($ch);

        return redirect('/customer/bookings')->with('success', 'Booking berhasil dibuat!');
    }

    public function validatePromoCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'amount' => 'required|numeric|min:0'
        ]);

        $promoCode = PromoCode::where('code', strtoupper($request->code))->first();

        if (!$promoCode) {
            return response()->json([
                'valid' => false,
                'message' => 'Promo code tidak ditemukan.'
            ]);
        }

        if (!$promoCode->isValid()) {
            $message = 'Promo code tidak valid.';

            if ($promoCode->isExpired()) {
                $message = 'Promo code sudah expired.';
            } elseif ($promoCode->isNotStarted()) {
                $message = 'Promo code belum aktif.';
            } elseif ($promoCode->isUsageLimitReached()) {
                $message = 'Promo code sudah mencapai batas penggunaan.';
            } elseif (!$promoCode->is_active) {
                $message = 'Promo code tidak aktif.';
            }

            return response()->json([
                'valid' => false,
                'message' => $message
            ]);
        }

        if ($request->amount < $promoCode->minimum_amount) {
            return response()->json([
                'valid' => false,
                'message' => "Minimum pembelian Rp" . number_format($promoCode->minimum_amount, 0, ',', '.')
            ]);
        }

        $discountAmount = $promoCode->calculateDiscount($request->amount);
        $finalAmount = $request->amount - $discountAmount;

        return response()->json([
            'valid' => true,
            'message' => 'Promo code valid!',
            'data' => [
                'code' => $promoCode->code,
                'name' => $promoCode->name,
                'discount_type' => $promoCode->discount_type,
                'discount_value' => $promoCode->discount_value,
                'discount_amount' => $discountAmount,
                'final_amount' => $finalAmount,
                'minimum_amount' => $promoCode->minimum_amount,
                'maximum_discount' => $promoCode->maximum_discount
            ]
        ]);
    }
}
