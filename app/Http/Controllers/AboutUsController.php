<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first(); // hanya ambil data pertama
        return view('admin.about.index', compact('about'));
    }

    public function edit()
    {
        $about = AboutUs::first();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = AboutUs::first();

        $request->validate([
            'description' => 'required',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,bep|max:2048',
        ]);

        $data = [
            'description' => $request->description,
        ];

        if ($request->hasFile('logo')) {
            if ($about->logo && Storage::disk('public')->exists($about->logo)) {
                Storage::disk('public')->delete($about->logo);
            }
            $data['logo'] = $request->file('logo')->store('about', 'public');
        }

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'About Us updated successfully!');
    }
}

