@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Profile Header Card -->
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-sm-auto col-4">
                                <div class="avatar avatar-xxl position-relative">
                                    <div>
                                        <label for="photo-input"
                                            class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" aria-hidden="true" data-bs-original-title="Edit Image"
                                                aria-label="Edit Image"></i>
                                            <span class="sr-only">Edit Image</span>
                                        </label>

                                        <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                            @if ($profile->photo)
                                            <img src="{{ asset('storage/' . $profile->photo) }}" alt="Profile Photo"
                                                class="w-100 border-radius-lg shadow-sm">
                                            @else
                                            <div
                                                class="w-100 h-100 bg-gradient-primary border-radius-lg shadow-sm d-flex align-items-center justify-content-center">
                                                <span class="text-white font-weight-bold text-lg">{{
                                                    strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                            </div>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="mb-1">{{ old('name', auth()->user()->name) }}</h4>
                                <p class="text-sm text-secondary mb-0">{{ ucfirst($profile->level ?? 'Guide') }} Guide
                                </p>
                            </div>
                            {{-- <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="availabilityToggle" checked>
                                    <label class="form-check-label" for="availabilityToggle">
                                        Available for Booking
                                    </label>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Basic Info Card -->
                <div class="card mb-4" id="basic-info">
                    <div class="card-header pb-0">
                        <h5 class="mb-2">Basic Info</h5>
                    </div>
                    <div class="card-body pt-0">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('guide.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="photo" id="photo-input"
                                class="form-control @error('photo') is-invalid @enderror" accept="image/*"
                                style="display: none;">
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Nama Lengkap</label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                                            type="text" value="{{ old('name', auth()->user()->name) }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">WhatsApp Number</label>
                                        <div class="d-flex">
                                            @php
                                            $currentPhone = auth()->user()->phone ?? '';
                                            $currentCountryCode = '+62'; // default
                                            $currentPhoneNumber = '';

                                            if ($currentPhone) {
                                            if (str_starts_with($currentPhone, '+62')) {
                                            $currentCountryCode = '+62';
                                            $currentPhoneNumber = substr($currentPhone, 3);
                                            } elseif (str_starts_with($currentPhone, '+60')) {
                                            $currentCountryCode = '+60';
                                            $currentPhoneNumber = substr($currentPhone, 3);
                                            } elseif (str_starts_with($currentPhone, '+65')) {
                                            $currentCountryCode = '+65';
                                            $currentPhoneNumber = substr($currentPhone, 3);
                                            } elseif (str_starts_with($currentPhone, '+1')) {
                                            $currentCountryCode = '+1';
                                            $currentPhoneNumber = substr($currentPhone, 1);
                                            } elseif (str_starts_with($currentPhone, '+81')) {
                                            $currentCountryCode = '+81';
                                            $currentPhoneNumber = substr($currentPhone, 3);
                                            } elseif (str_starts_with($currentPhone, '+91')) {
                                            $currentCountryCode = '+91';
                                            $currentPhoneNumber = substr($currentPhone, 3);
                                            } elseif (str_starts_with($currentPhone, '+44')) {
                                            $currentCountryCode = '+44';
                                            $currentPhoneNumber = substr($currentPhone, 3);
                                            } elseif (str_starts_with($currentPhone, '+49')) {
                                            $currentCountryCode = '+49';
                                            $currentPhoneNumber = substr($currentPhone, 3);
                                            } else {
                                            $currentPhoneNumber = $currentPhone;
                                            }
                                            }
                                            @endphp

                                            <select name="country_code" class="form-select w-25 me-2" required>
                                                <option value="+62" {{ old('country_code', $currentCountryCode)=='+62'
                                                    ? 'selected' : '' }}>🇮🇩 +62 (Indonesia)</option>
                                                <option value="+60" {{ old('country_code', $currentCountryCode)=='+60'
                                                    ? 'selected' : '' }}>🇲🇾 +60 (Malaysia)</option>
                                                <option value="+65" {{ old('country_code', $currentCountryCode)=='+65'
                                                    ? 'selected' : '' }}>🇸🇬 +65 (Singapore)</option>
                                                <option value="+1" {{ old('country_code', $currentCountryCode)=='+1'
                                                    ? 'selected' : '' }}>🇺🇸 +1 (USA)</option>
                                                <option value="+81" {{ old('country_code', $currentCountryCode)=='+81'
                                                    ? 'selected' : '' }}>🇯🇵 +81 (Japan)</option>
                                                <option value="+91" {{ old('country_code', $currentCountryCode)=='+91'
                                                    ? 'selected' : '' }}>🇮🇳 +91 (India)</option>
                                                <option value="+44" {{ old('country_code', $currentCountryCode)=='+44'
                                                    ? 'selected' : '' }}>🇬🇧 +44 (UK)</option>
                                                <option value="+49" {{ old('country_code', $currentCountryCode)=='+49'
                                                    ? 'selected' : '' }}>🇩🇪 +49 (Germany)</option>
                                            </select>

                                            <input type="number" id="phone_number" name="phone_number"
                                                value="{{ old('phone_number', $currentPhoneNumber) }}"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                placeholder="8123456789" required>
                                        </div>
                                        @error('phone_number')
                                        <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="level" class="form-control-label">Level</label>
                                        <select name="level" class="form-control @error('level') is-invalid @enderror"
                                            disabled>
                                            <option value="junior" {{ $profile->level == 'junior' ? 'selected' : ''
                                                }}>Junior</option>
                                            <option value="intermediate" {{ $profile->level == 'intermediate' ?
                                                'selected' : '' }}>Intermediate</option>
                                            <option value="expert" {{ $profile->level == 'expert' ? 'selected' : ''
                                                }}>Expert</option>
                                        </select>
                                        <small class="form-text text-muted">Level hanya bisa diubah oleh admin.</small>
                                        @error('level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="daily_rate" class="form-control-label">Tarif Harian (Rp)</label>
                                        <input class="form-control @error('daily_rate') is-invalid @enderror"
                                            name="daily_rate" type="number"
                                            value="{{ old('daily_rate', $profile->daily_rate) }}" required min="100000"
                                            placeholder="100000">
                                        @error('daily_rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="max_travelers" class="form-control-label">Maksimal Wisatawan</label>
                                        <input class="form-control @error('max_travelers') is-invalid @enderror"
                                            name="max_travelers" type="number"
                                            value="{{ old('max_travelers', $profile->max_travelers) }}" required min="1"
                                            max="20" placeholder="10">
                                        @error('max_travelers')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="experience" class="form-control-label">Pengalaman</label>
                                        <input class="form-control @error('experience') is-invalid @enderror"
                                            name="experience" type="text"
                                            value="{{ old('experience', $profile->experience) }}"
                                            placeholder="Contoh: 5 tahun memandu wisata di Bali">
                                        @error('experience')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="languages" class="form-control-label">Bahasa yang Dikuasai</label>
                                        <select name="languages[]"
                                            class="form-control @error('languages') is-invalid @enderror" multiple
                                            required>
                                            @foreach (['Indonesia', 'English', 'Japanese', 'Mandarin', 'Korean',
                                            'Arabic'] as $lang)
                                            <option value="{{ $lang }}" {{ in_array($lang, $profile->languages ?? []) ?
                                                'selected' : '' }}>
                                                {{ $lang }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple
                                            languages.</small>
                                        @error('languages')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="skills" class="form-control-label">Skill / Keahlian</label>
                                        <select name="skills[]"
                                            class="form-control @error('skills') is-invalid @enderror" multiple
                                            required>
                                            @foreach (['Hiking', 'Photography', 'Cultural Tour', 'Food Tour', 'City
                                            Walk', 'History', 'Adventure', 'Family Tour', 'Fasilitator Outbound',
                                            'Trainer Outbound'] as $skill)
                                            <option value="{{ $skill }}" {{ in_array($skill, $profile->skills ?? []) ?
                                                'selected' : '' }}>
                                                {{ $skill }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple
                                            skills.</small>
                                        @error('skills')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                                                         <div class="form-group">
                                         <label for="bio" class="form-control-label">Bio (Tentang Saya)</label>
                                         <textarea name="bio" class="form-control @error('bio') is-invalid @enderror"
                                             rows="4"
                                             placeholder="Ceritakan tentang diri Anda...">{{ old('bio', $profile->bio) }}</textarea>
                                         @error('bio')
                                         <div class="invalid-feedback">{{ $message }}</div>
                                         @enderror
                                     </div>

                                     <div class="form-group">
                                         <label for="cv" class="form-control-label">CV/Resume (PDF)</label>
                                         <div class="d-flex align-items-center">
                                             @if ($profile->cv)
                                                 <div class="me-3">
                                                     <a href="{{ asset('storage/' . $profile->cv) }}" target="_blank" class="btn btn-sm btn-info">
                                                         <i class="fas fa-file-pdf me-1"></i>Lihat CV
                                                     </a>
                                                 </div>
                                             @endif
                                             <input type="file" name="cv" id="cv-input"
                                                 class="form-control @error('cv') is-invalid @enderror"
                                                 accept=".pdf" style="flex: 1;">
                                         </div>
                                         <small class="form-text text-muted">Upload CV dalam format PDF (maksimal 5MB)</small>
                                         @error('cv')
                                         <div class="invalid-feedback">{{ $message }}</div>
                                         @enderror
                                     </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Profil
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password Card -->
                <div class="card mb-4" id="change-password">
                    <div class="card-header">
                        <h5 class="mb-0">Change Password</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('guide.profile.updatePassword') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="current_password" class="form-control-label">Password Saat Ini</label>
                                <input type="password" id="current_password" name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    placeholder="Masukkan password saat ini" required>
                                @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password" class="form-control-label">Password Baru</label>
                                <input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror"
                                    placeholder="Password Minimal 8 Karakter" required>
                                @error('new_password')
                                <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation" class="form-control-label">Konfirmasi Password
                                    Baru</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    placeholder="Ulangi Password Baru" required>
                                @error('new_password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary text-white fw-bold float-end mt-3 mb-1">
                                <i class="fa fa-key me-2"></i>Ubah Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</main>
@endsection

@push('css')
<style>
    .avatar {
        position: relative;
        display: inline-block;
        width: 3rem;
        height: 3rem;
    }

    .avatar-xl {
        width: 5rem;
        height: 5rem;
    }

    .form-control-label {
        font-weight: 600;
        color: #344767;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 1px solid #d2d6da;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #5e72e4;
        box-shadow: 0 0 0 0.2rem rgba(94, 114, 228, 0.25);
    }

    .form-control[readonly] {
        background-color: #f8f9fa;
        opacity: 1;
    }

    .form-check-input:checked {
        background-color: #fb6340;
        border-color: #fb6340;
    }

    .btn-primary {
        background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%);
        border: 0;
        border-radius: 0.375rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.15s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .alert {
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
    }

    .alert-dismissible {
        position: relative;
        padding-right: 4rem;
    }

    .btn-close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 1rem;
        background: none;
        border: 0;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
        color: #000;
        opacity: 0.5;
    }

    .btn-close:hover {
        opacity: 0.75;
    }

    .btn-icon-only {
        width: 2rem;
        height: 2rem;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .btn-icon-only:hover {
        transform: scale(1.1);
    }

    .bg-gradient-light {
        background: linear-gradient(87deg, #f8f9fa 0, #e9ecef 100%);
        color: #6c757d;
    }

    .position-absolute {
        position: absolute !important;
    }

    .bottom-0 {
        bottom: 0 !important;
    }

    .end-0 {
        right: 0 !important;
    }

    .mb-n2 {
        margin-bottom: -0.5rem !important;
    }

    .me-n2 {
        margin-right: -0.5rem !important;
    }

    .h-12 {
        height: 3rem !important;
    }

    .w-12 {
        width: 3rem !important;
    }

    .rounded-full {
        border-radius: 9999px !important;
    }

    .overflow-hidden {
        overflow: hidden !important;
    }

    .bg-gray-100 {
        background-color: #f8f9fa !important;
    }

    .form-select {
        border: 1px solid #d2d6da;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-select:focus {
        border-color: #5e72e4;
        box-shadow: 0 0 0 0.2rem rgba(94, 114, 228, 0.25);
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-sm {
        font-size: 0.875rem !important;
    }

    .mt-1 {
        margin-top: 0.25rem !important;
    }

    /* CV upload styling */
    .btn-info {
        background: linear-gradient(87deg, #11cdef 0, #1171ef 100%);
        border: 0;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        font-weight: 600;
        color: white;
        transition: all 0.15s ease;
    }

    .btn-info:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        color: white;
    }

    .d-flex {
        display: flex !important;
    }

    .align-items-center {
        align-items: center !important;
    }

    .me-3 {
        margin-right: 1rem !important;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 300);
            }, 5000);
        });

        // Image preview functionality
        const photoInput = document.getElementById('photo-input');
        if (photoInput) {
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        alert('Please select an image file');
                        return;
                    }

                    // Validate file size (max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size must be less than 2MB');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Update the avatar image
                        const imgElement = document.querySelector('.avatar img');
                        if (imgElement) {
                            imgElement.src = e.target.result;
                        } else {
                            // If no image exists, create one
                            const avatarDiv = document.querySelector('.avatar div');
                            if (avatarDiv) {
                                avatarDiv.innerHTML = `<img src="${e.target.result}" alt="Profile Photo" class="w-100 border-radius-lg shadow-sm">`;
                            }
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Real-time name update in header
        const nameInput = document.querySelector('input[name="name"]');
        const headerName = document.querySelector('.col h4');

        if (nameInput && headerName) {
            nameInput.addEventListener('input', function(e) {
                headerName.textContent = e.target.value;
            });
        }

        // CV file input validation
        const cvInput = document.getElementById('cv-input');
        if (cvInput) {
            cvInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file type
                    if (file.type !== 'application/pdf') {
                        alert('Please select a PDF file');
                        this.value = '';
                        return;
                    }

                    // Validate file size (max 5MB)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('File size must be less than 5MB');
                        this.value = '';
                        return;
                    }
                }
            });
        }

        // Form validation
        const form = document.querySelector('form[action*="profile"]');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields');
                }
            });
        }

        // Remove invalid class on input
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    });
</script>
@endpush
