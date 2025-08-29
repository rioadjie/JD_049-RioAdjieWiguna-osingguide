<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalGuides = User::where('role', 'guide')->count();
        $totalCustomers = User::where('role', 'customer')->count();

        // 🔽 Tambahkan ini
        $bookings = Booking::with(['customer', 'guide'])
            ->latest()
            ->take(10) // ambil 10 terbaru
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'totalGuides',
            'totalCustomers',
            'bookings' // ✅ jangan lupa tambahkan!
        ));
    }

    public function bookings()
    {
        $bookings = Booking::with(['customer', 'guide'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $request->validate(['status' => 'required|in:confirmed,ongoing,completed,cancelled']);
        $booking->status = $request->status;
        $booking->save();

        return back()->with('success', 'Status booking berhasil diupdate.');
    }

    public function commissionSettings()
    {
        $feeType = Setting::getValue('platform_fee_type') ?? 'percentage';
        $feeValue = Setting::getValue('platform_fee_value') ?? '15';

        return view('admin.settings.commission', compact('feeType', 'feeValue'));
    }

    public function updateCommission(Request $request)
    {
        $request->validate([
            'fee_type' => 'required|in:percentage,fixed',
            'fee_value' => 'required|numeric|min:0',
        ]);

        Setting::updateOrCreate(
            ['key' => 'platform_fee_type'],
            ['value' => $request->fee_type]
        );

        Setting::updateOrCreate(
            ['key' => 'platform_fee_value'],
            ['value' => $request->fee_value]
        );

        return back()->with('success', 'Komisi berhasil diperbarui!');
    }

    public function manageGuides()
    {
        $guides = User::where('role', 'guide')
            ->with('guideProfile')
            ->withCount('bookingsAsGuide')
            ->latest()
            ->get();

        return view('admin.guides.index', compact('guides'));
    }

    public function guideDetail($id)
    {
        $guide = User::where('id', $id)
            ->where('role', 'guide')
            ->with('guideProfile')
            ->withCount(['bookingsAsGuide as total_bookings' => function ($q) {
                $q->where('status', 'completed');
            }])
            ->with(['bookingsAsGuide' => function ($q) {
                $q->with('customer')->latest()->take(5);
            }])
            ->firstOrFail();

        $avgRating = Review::where('guide_id', $guide->id)->avg('rating') ?? 0;

        return view('admin.guides.detail', compact('guide', 'avgRating'));
    }

    public function toggleGuideStatus($id)
    {
        $guide = User::where('id', $id)->where('role', 'guide')->firstOrFail();

        // Toggle status di guide_profile
        $profile = $guide->guideProfile;
        if ($profile) {
            $profile->status = $profile->status === 'active' ? 'inactive' : 'active';
            $profile->save();
        }

        $status = $profile->status ?? 'inactive';
        return back()->with('success', "Status guide diubah menjadi {$status}.");
    }

    public function updateGuideLevel(Request $request, $id)
    {
        $request->validate([
            'level' => 'required|in:junior,intermediate,expert'
        ]);

        $guide = User::where('id', $id)->where('role', 'guide')->firstOrFail();

        $profile = $guide->guideProfile;
        if (!$profile) {
            return back()->with('error', 'Profil guide belum dibuat.');
        }

        $profile->level = $request->level;
        $profile->save();

        return back()->with('success', "Level guide berhasil diubah menjadi {$profile->level}.");
    }

    public function manageCustomers()
    {
        $customers = User::where('role', 'customer')
            ->withCount('bookingsAsCustomer')
            ->latest()
            ->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function customerDetail($id)
    {
        $customer = User::where('id', $id)->where('role', 'customer')->with(['bookingsAsCustomer' => function ($q) {
            $q->with('guide')->latest();
        }])->withCount('bookingsAsCustomer')->firstOrFail();
        return view('admin.customers.detail', compact('customer'));
    }
}
