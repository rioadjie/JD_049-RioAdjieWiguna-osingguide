<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class GuideReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('guide_id', auth()->id())
            ->with('customer')
            ->with('booking')
            ->latest()
            ->get();

        $avgRating = $reviews->avg('rating');
        $totalReviews = $reviews->count();

        return view('guide.reviews.index', compact('reviews', 'avgRating', 'totalReviews'));
    }
}
