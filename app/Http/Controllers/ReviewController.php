<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('customer_id', auth()->id())
            ->where('status', 'completed')
            ->with('guide')
            ->firstOrFail();

        return view('customer.reviews.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        Review::create([
            'booking_id' => $booking->id,
            'customer_id' => auth()->id(),
            'guide_id' => $booking->guide_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect('/customer/bookings')->with('success', 'Terima kasih atas ulasannya!');
    }
}
