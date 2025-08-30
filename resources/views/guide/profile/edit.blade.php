@extends('layouts.master')
@section('main')
    <main class="main-content position-relative border-radius-lg">
        @include('layouts.header')

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Profil Saya</h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('guide.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                            <div class="mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}">
                            </div>

                            <div class="mb-3">
                                <label>WhatsApp Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" placeholder="081234567890">
                            </div>

                                <div class="mb-3">
                                    <label>Level</label>
                                    <select name="level" class="form-control" disabled>
                                        <option value="junior" {{ $profile->level == 'junior' ? 'selected' : '' }}>Junior
                                        </option>
                                        <option value="intermediate"
                                            {{ $profile->level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="expert" {{ $profile->level == 'expert' ? 'selected' : '' }}>Expert
                                        </option>
                                    </select>
                                    <small class="text-muted">Level hanya bisa diubah oleh admin.</small>
                                </div>

                                <div class="mb-3">
                                    <label>Tarif Harian (Rp)</label>
                                    <input type="number" name="daily_rate" class="form-control"
                                        value="{{ $profile->daily_rate }}" required min="100000">
                                </div>

                                <div class="mb-3">
                                    <label>Maksimal Wisatawan</label>
                                    <input type="number" name="max_travelers" class="form-control"
                                        value="{{ $profile->max_travelers }}" required min="1" max="20">
                                </div>

                                <div class="mb-3">
                                    <label>Bahasa yang Dikuasai</label>
                                    <select name="languages[]" class="form-control" multiple required>
                                        @foreach (['Indonesia', 'English', 'Japanese', 'Mandarin', 'Korean', 'Arabic'] as $lang)
                                            <option value="{{ $lang }}"
                                                {{ in_array($lang, $profile->languages ?? []) ? 'selected' : '' }}>
                                                {{ $lang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Skill / Keahlian</label>
                                    <select name="skills[]" class="form-control" multiple required>
                                        @foreach (['Hiking', 'Photography', 'Cultural Tour', 'Food Tour', 'City Walk', 'History', 'Adventure', 'Family Tour'] as $skill)
                                            <option value="{{ $skill }}"
                                                {{ in_array($skill, $profile->skills ?? []) ? 'selected' : '' }}>
                                                {{ $skill }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Pengalaman</label>
                                    <input type="text" name="experience" class="form-control"
                                        value="{{ $profile->experience }}"
                                        placeholder="Contoh: 5 tahun memandu wisata di Bali">
                                </div>

                                <div class="mb-3">
                                    <label>Bio (Tentang Saya)</label>
                                    <textarea name="bio" class="form-control" rows="4" placeholder="Ceritakan tentang diri Anda...">{{ $profile->bio }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Foto Profil</label>
                                    @if ($profile->photo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $profile->photo) }}" alt="Foto Profil"
                                                class="rounded" width="120">
                                        </div>
                                    @endif
                                    <input type="file" name="photo" class="form-control" accept="image/*">
                                    <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Profil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @include('layouts.footer')
    </div>
</main>
@endsection
