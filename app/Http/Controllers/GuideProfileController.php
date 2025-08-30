<?php

namespace App\Http\Controllers;

use App\Models\GuideProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuideProfileController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->guideProfile ?? new GuideProfile();
        return view('guide.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string',
            'experience' => 'nullable|string',
            'languages' => 'required|array',
            'skills' => 'required|array',
            'daily_rate' => 'required|numeric|min:100000',
            'max_travelers' => 'required|integer|min:1|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // opsional, maks 2MB
        ]);

        $guide = auth()->user();
        $profile = $guide->guideProfile ?? $guide->guideProfile()->make();

        // Ambil data form, kecuali foto
        $data = $request->except('photo');

        // Handle upload foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($profile->photo && Storage::exists('public/' . $profile->photo)) {
                Storage::delete('public/' . $profile->photo);
            }

            // Simpan foto baru
            $data['photo'] = $request->file('photo')->store('guide_photos', 'public');
        }

        // Simpan data
        $profile->fill($data);
        $profile->status = 'active'; // selalu aktif saat update profil
        $guide->guideProfile()->save($profile);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
