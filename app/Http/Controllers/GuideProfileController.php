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
            'name' => 'required|string|max:255',
            'country_code' => 'required|string',
            'phone_number' => 'required|numeric|min:8',
            'bio' => 'nullable|string',
            'experience' => 'nullable|string',
            'languages' => 'required|array',
            'skills' => 'required|array',
            'daily_rate' => 'required|numeric|min:100000',
            'max_travelers' => 'required|integer|min:1|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // opsional, maks 2MB
            'cv' => 'nullable|mimes:pdf|max:5120', // opsional, maks 5MB
        ]);

        $guide = auth()->user();
        $profile = $guide->guideProfile ?? $guide->guideProfile()->make();

        // Combine country code and phone number
        $phone = $request->country_code . $request->phone_number;

        // Update data user (nama dan telepon)
        $guide->update([
            'name' => $request->name,
            'phone' => $phone,
        ]);

        // Ambil data form untuk profile, kecuali foto, cv dan data user
        $profileData = $request->except(['photo', 'cv', 'name', 'phone']);

        // Handle upload foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($profile->photo && Storage::exists('public/' . $profile->photo)) {
                Storage::delete('public/' . $profile->photo);
            }

            // Simpan foto baru
            $profileData['photo'] = $request->file('photo')->store('guide_photos', 'public');
        }

        // Handle upload CV
        if ($request->hasFile('cv')) {
            // Hapus CV lama jika ada
            if ($profile->cv && Storage::exists('public/' . $profile->cv)) {
                Storage::delete('public/' . $profile->cv);
            }

            // Simpan CV baru
            $profileData['cv'] = $request->file('cv')->store('guide_cvs', 'public');
        }

        // Simpan data profile
        $profile->fill($profileData);
        $profile->status = 'active'; // selalu aktif saat update profil
        $guide->guideProfile()->save($profile);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
