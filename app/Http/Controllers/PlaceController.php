<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::get();
        return view('admin.places.index', compact('places'));
    }

    public function create()
    {
        return view('admin.places.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'name_place' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'content' => 'required',
            'rating' => 'required',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('places', 'public');

        Place::create([
            'image' => $imagePath,
            'name_place' => $request->name_place,
            'location' => $request->location,
            'content' => $request->content,
            'rating' => $request->rating,
            'slug' => Str::slug($request->name_place),
            'description' => $request->description,
            'keywords' => $request->keywords,
        ]);

        return redirect()->route('admin.places.index')->with('success', 'Place created successfully.');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);
        return view('admin.places.edit', compact('place'));
    }

    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name_place' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'content' => 'required',
            'rating' => 'required',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
        ]);

        $data = $request->only([
            'name_place', 'location', 'content', 'rating', 'description', 'keywords'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('places', 'public');
        }

        $data['slug'] = Str::slug($request->name_place);

        $place->update($data);

        return redirect()->route('admin.places.index')->with('success', 'Place updated successfully.');
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();
        return redirect()->route('admin.places.index')->with('success', 'Place deleted successfully.');
    }
}
