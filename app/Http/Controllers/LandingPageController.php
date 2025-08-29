<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
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

        return view('landing.landing-page', compact('places', 'guides', 'galleries', 'about', 'contact'));
    }
}
