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
                                        <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                            <div class="w-100 h-100 bg-gradient-primary border-radius-lg shadow-sm d-flex align-items-center justify-content-center">
                                                <span class="text-white font-weight-bold text-lg">{{ strtoupper(substr(auth()->user()->name, 0, 1) . substr(strrchr(auth()->user()->name, ' '), 1, 1)) }}</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="mb-1">{{ old('name', auth()->user()->name) }}</h4>
                                <p class="text-sm text-secondary mb-0">Administrator</p>
                            </div>
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

                        <form action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                                    value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-control-label">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                                    value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-control-label">No. Telephone</label>
                                <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text"
                                    value="{{ old('phone', auth()->user()->phone) }}" placeholder="08123456789">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-primary btn-sm ms-auto">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password Card -->
                <div class="card mb-4" id="change-password">
                    <div class="card-header pb-0">
                        <h5 class="mb-2">Change Password</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="current_password" class="form-control-label">Current Password</label>
                                <input class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                                    type="password" required>
                                @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-control-label">New Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label">Confirm New Password</label>
                                <input class="form-control" name="password_confirmation" type="password" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-warning btn-sm ms-auto">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
