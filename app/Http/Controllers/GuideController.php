<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function dashboard()
    {
        $guide = auth()->user();

        // Muat relasi reviewsReceived
        $guide->load('reviewsReceived');

        $bookings = Booking::where('guide_id', $guide->id)->latest()->get();

        $totalEarnings = $bookings->where('status', 'completed')
            ->sum('sub_total') * 0.85; // 15% komisi untuk platform

        // Sekarang aman karena relasi sudah dimuat
        $avgRating = $guide->reviewsReceived->avg('rating') ?? 0;

        return view('guide.dashboard', compact('bookings', 'totalEarnings', 'avgRating'));
    }

    public function bookings()
    {
        $bookings = Booking::where('guide_id', auth()->id())->with('customer')->latest()->get();
        return view('guide.bookings.index', compact('bookings'));
    }

    public function markAsCompleted(Request $request, $id)
    {
        $booking = Booking::where('id', $id)
            ->where('guide_id', auth()->id())
            ->whereIn('status', ['ongoing', 'confirmed'])
            ->firstOrFail();

        // Cek apakah end_time sudah lewat
        if (now()->lt($booking->end_time)) {
            return back()->with('error', 'Perjalanan belum selesai. Anda hanya bisa tandai selesai setelah waktu berakhir.');
        }

        $booking->status = 'completed';
        $booking->save();

        return back()->with('success', 'Status booking berhasil diubah menjadi Selesai.');
    }
}
