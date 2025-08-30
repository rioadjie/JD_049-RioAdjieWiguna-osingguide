<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $bookings = auth()->user()->bookingsAsCustomer;
        // Ambil 3 tempat populer, bisa disesuaikan
        $places = Place::latest()->take(3)->get();
        // Ambil 3 guide populer
        $guides = User::where('role', 'guide')
            ->whereHas('guideProfile') // hanya ambil yang punya profile
            ->with('guideProfile') // biar sekaligus load data profil\
            ->take(3)
            ->get();
        // Gallery
        $galleries = Gallery::latest()->take(5)->get();
        // About Us
        $about = AboutUs::first();
        // Contact Us
        $contact = Contact::first();

        return view('landing.landing-page', compact('bookings', 'places', 'guides', 'galleries', 'about', 'contact'));
    }

    public function guides(Request $request)
    {
        $query = User::where('role', 'guide')->whereHas('guideProfile');

        // Filter level (junior/intermediate/profesional)
        if ($request->level) {
            $query->whereHas('guideProfile', fn($q) => $q->where('level', $request->level));
        }

        // Filter tanggal
        if ($request->start_date && $request->end_date) {
            $start = $request->start_date;
            $end   = $request->end_date;

            $query
                ->whereHas('availabilities', function ($q) use ($start, $end) {
                    $q->where('status', 'available')
                        ->whereBetween('date', [$start, $end]);
                })
                ->whereDoesntHave('bookingsAsGuide', function ($q) use ($start, $end) {
                    $q->where('status', '!=', 'cancelled')
                        ->where(function ($q2) use ($start, $end) {
                            $q2->whereBetween('start_time', [$start, $end])
                                ->orWhereBetween('end_time', [$start, $end])
                                ->orWhere(function ($q3) use ($start, $end) {
                                    $q3->where('start_time', '<=', $start)
                                        ->where('end_time', '>=', $end);
                                });
                        });
                });
        }

        // Filter bahasa
        if ($request->languages) {
            $languages = (array) $request->languages;
            $query->whereHas('guideProfile', function ($q) use ($languages) {
                foreach ($languages as $lang) {
                    $q->whereJsonContains('languages', $lang);
                }
            });
        }

        // Filter skills
        if ($request->skills) {
            $skills = (array) $request->skills;
            $query->whereHas('guideProfile', function ($q) use ($skills) {
                foreach ($skills as $skill) {
                    $q->whereJsonContains('skills', $skill);
                }
            });
        }

        // Sort harga
        if ($request->sort_price == 'low') {
            $query->orderBy('guideProfile->daily_rate', 'asc');
        } elseif ($request->sort_price == 'high') {
            $query->orderBy('guideProfile->daily_rate', 'desc');
        }

        $guides = $query->with('guideProfile')->get();

        return view('landing.guide-list', compact('guides'));
    }

    // Function untuk melihat detail guide
    public function show($id)
    {
        $guide = User::with(['guideProfile', 'availabilities']) // kalau pakai spatie role
            ->findOrFail($id);

        return view('landing.detail-guide', compact('guide'));
    }
}
