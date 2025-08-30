@extends('layouts.app')
@section('title', 'Osing Guide | Register')
@section('main')
<div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
    style="background-image: url('{{ asset('assets/img/landing-page/ijen-photo.jpeg') }}'); background-position: top;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
                <h1 class="text-white mb-2 mt-5">Welcome Admin!</h1>
                <p class="text-lead text-white">Create your account to manage our platform.</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h4 class="font-weight-bolder">Sign Up</h4>
                    <p class="mb-0">complete your personal data.</p>
                </div>

                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        {{-- Role hidden --}}
                        <input type="hidden" name="role" value="admin">

                        {{-- Name --}}
                        <div class="mb-3">
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name" required
                                autofocus>
                            @error('name')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                            @error('email')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3 d-flex">
                            <select name="country_code" class="form-select w-25 me-2" required>
                                <option value="+62" {{ old('country_code')=='+62' ? 'selected' : '' }}>🇮🇩 +62
                                    (Indonesia)</option>
                                <option value="+60" {{ old('country_code')=='+60' ? 'selected' : '' }}>🇲🇾 +60
                                    (Malaysia)</option>
                                <option value="+65" {{ old('country_code')=='+65' ? 'selected' : '' }}>🇸🇬 +65
                                    (Singapore)</option>
                                <option value="+1" {{ old('country_code')=='+1' ? 'selected' : '' }}>🇺🇸 +1
                                    (USA)</option>
                                <option value="+81" {{ old('country_code')=='+81' ? 'selected' : '' }}>🇯🇵 +81
                                    (Japan)</option>
                                <option value="+91" {{ old('country_code')=='+91' ? 'selected' : '' }}>🇮🇳 +91
                                    (India)</option>
                                <option value="+44" {{ old('country_code')=='+44' ? 'selected' : '' }}>🇬🇧 +44
                                    (UK)</option>
                                <option value="+49" {{ old('country_code')=='+49' ? 'selected' : '' }}>🇩🇪 +49
                                    (Germany)</option>
                                <!-- tambahkan sesuai kebutuhan -->
                            </select>

                            <input type="number" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                placeholder="8123456789" required>

                            @error('phone_number')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Password --}}
                        <div class="mb-3">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                required>
                            @error('password')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm Password" required>
                        </div>

                        <div class="form-check form-check-info text-start mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                            <label class="form-check-label" for="flexCheckDefault">
                                I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms
                                    and Conditions</a>
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                        </div>
                        <p class="text-sm mt-3 mb-0">Already have an account?
                            <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
