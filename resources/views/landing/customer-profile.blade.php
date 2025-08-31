<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OsingGuide - My Profile</title>

    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}" type="image/svg+xml">

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css')}}" rel="stylesheet" />

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            /* Biar bagian utama ngambil sisa tinggi layar */
        }

        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #6c757d;
            border: 4px solid #e9ecef;
        }

        .profile-avatar-small {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: white;
            margin-right: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 1px solid #d1d3e2;
            border-radius: 0.375rem;
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

        .form-select {
            border: 1px solid #d1d3e2;
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-select:focus {
            border-color: #5e72e4;
            box-shadow: 0 0 0 0.2rem rgba(94, 114, 228, 0.25);
        }

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            font-size: 16px;
        }

        .password-toggle:hover {
            color: #5e72e4;
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

        .btn-secondary {
            background: #6c757d;
            border: 0;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.15s ease;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }

        .btn-warning {
            background: linear-gradient(87deg, #f7b731 0, #f0933b 100%);
            border: 0;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.15s ease;
            color: white;
        }

        .btn-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
            color: white;
        }

        .alert {
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-dismissible {
            position: relative;
            padding-right: 4rem;
        }

        .close {
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

        .close:hover {
            opacity: 0.75;
        }
    </style>
</head>

<body id="top">

    <!--
    - #HEADER
  -->

    <header class="header" data-header>

        <div class="overlay" data-overlay></div>

        <div class="header-top">
            <div class="container">
                <a href="tel:+6287864310772" class="helpline-box">

                    <div class="icon-box">
                        <ion-icon name="call-outline"></ion-icon>
                    </div>

                    <div class="wrapper">
                        <p class="helpline-title">For Further Inquires :</p>

                        <p class="helpline-number">+6287864310772</p>
                    </div>

                </a>

                <a href="/" class="logo">
                    <img src="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}" alt="OsingGuide logo">
                </a>

                <div class="header-btn-group">

                    <button class="search-btn" aria-label="Search">
                        <ion-icon name="search"></ion-icon>
                    </button>

                     <div class="menu-right">
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    @endguest

                    @auth
                    <div class="profile-dropdown">
                        <button class="profile-btn">
                            <div class="profile-avatar-small">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1) . substr(strrchr(Auth::user()->name, ' '), 1, 1)) }}
                            </div>
                            <span class="text-primary">{{ Auth::user()->name }}</span>
                            <i class="arrow-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="{{ route('customer.profile') }}">My Profile</a>
                            <a href="{{ route('customer.bookings') }}">Booking History</a>
                            <hr>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-btn">Logout</button>
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>

                </div>

            </div>
        </div>

    </header>

    <!--
    - #MAIN CONTENT
  -->

    <main>
        <article>
            <section class="guide-detail">
                <div class="container">
                    <h2 class="h2 section-title">My Profile</h2>
                    <p class="section-text">Manage your account information and preferences.</p>

                    <div class="profile-container">
                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Error Notifications -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Profile Information Card -->
                        <div class="profile-card">
                            <div class="profile-header">
                                <div class="profile-avatar">
                                    {{ strtoupper(substr($user->name, 0, 1) . substr(strrchr($user->name, ' '), 1, 1)) }}
                                </div>
                                <h3>{{ $user->name }}</h3>
                                <p class="text-muted">Customer Account</p>
                            </div>

                            <form action="{{ route('customer.profile.update') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="form-control-label">Full Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                           name="name" type="text" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="form-control-label">Phone Number</label>
                                    <div class="d-flex">
                                        @php
                                            $currentPhone = $user->phone ?? '';
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
                                            <option value="+62" {{ old('country_code', $currentCountryCode)=='+62' ? 'selected' : '' }}>🇮🇩 +62 (Indonesia)</option>
                                            <option value="+60" {{ old('country_code', $currentCountryCode)=='+60' ? 'selected' : '' }}>🇲🇾 +60 (Malaysia)</option>
                                            <option value="+65" {{ old('country_code', $currentCountryCode)=='+65' ? 'selected' : '' }}>🇸🇬 +65 (Singapore)</option>
                                            <option value="+1" {{ old('country_code', $currentCountryCode)=='+1' ? 'selected' : '' }}>🇺🇸 +1 (USA)</option>
                                            <option value="+81" {{ old('country_code', $currentCountryCode)=='+81' ? 'selected' : '' }}>🇯🇵 +81 (Japan)</option>
                                            <option value="+91" {{ old('country_code', $currentCountryCode)=='+91' ? 'selected' : '' }}>🇮🇳 +91 (India)</option>
                                            <option value="+44" {{ old('country_code', $currentCountryCode)=='+44' ? 'selected' : '' }}>🇬🇧 +44 (UK)</option>
                                            <option value="+49" {{ old('country_code', $currentCountryCode)=='+49' ? 'selected' : '' }}>🇩🇪 +49 (Germany)</option>
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
                                    <label for="email" class="form-control-label">Email Address</label>
                                    <input class="form-control" name="email" type="email"
                                           value="{{ $user->email }}" readonly>
                                    <small class="form-text text-muted">
                                        Email tidak dapat diubah karena sudah diverifikasi.
                                        Hubungi admin jika perlu mengubah email.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="role" class="form-control-label">Account Type</label>
                                    <input class="form-control" name="role" type="text"
                                           value="{{ ucfirst($user->role) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="created_at" class="form-control-label">Member Since</label>
                                    <input class="form-control" name="created_at" type="text"
                                           value="{{ $user->created_at->format('d M Y') }}" readonly>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Back to Home
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Change Password Card -->
                        <div class="profile-card">
                            <h4 class="mb-3">Change Password</h4>
                            <form action="{{ route('customer.profile.updatePassword') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="current_password" class="form-control-label">Current Password</label>
                                    <div class="password-field">
                                        <input class="form-control @error('current_password') is-invalid @enderror"
                                               name="current_password" type="password" id="current_password" required>
                                    </div>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="new_password" class="form-control-label">New Password</label>
                                    <div class="password-field">
                                        <input class="form-control @error('new_password') is-invalid @enderror"
                                               name="new_password" type="password" id="new_password" required>
                                    </div>
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation" class="form-control-label">Confirm New Password</label>
                                    <div class="password-field">
                                        <input class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                               name="new_password_confirmation" type="password" id="new_password_confirmation" required>
                                    </div>
                                    @error('new_password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-key me-2"></i>Update Password
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Account Statistics Card -->
                        <div class="profile-card">
                            <h4 class="mb-3">Account Statistics</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <h5 class="text-primary">{{ $user->bookingsAsCustomer->count() }}</h5>
                                        <p class="text-muted">Total Bookings</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <h5 class="text-success">{{ $user->bookingsAsCustomer->where('status', 'completed')->count() }}</h5>
                                        <p class="text-muted">Completed Trips</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <h5 class="text-warning">{{ $user->bookingsAsCustomer->where('status', 'pending')->count() }}</h5>
                                        <p class="text-muted">Pending Bookings</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </main>

    <!--
    - #FOOTER
  -->

    <footer class="footer">

        <div class="footer-bottom">
            <div class="container">

                <p class="copyright">
                    &copy; 2025 <a href="">osingguide</a>. All rights reserved
                </p>

                <ul class="footer-bottom-list">

                    <li>
                        <a href="#" class="footer-bottom-link">Privacy Policy</a>
                    </li>

                    <li>
                        <a href="#" class="footer-bottom-link">Term & Condition</a>
                    </li>

                    <li>
                        <a href="#" class="footer-bottom-link">FAQ</a>
                    </li>

                </ul>

            </div>
        </div>

    </footer>

    <!--
    - #GO TO TOP
  -->

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up-outline"></ion-icon>
    </a>

    <!--
    - custom js link
  -->
    <script src="{{ asset('assets/js/landing-page.js') }}"></script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('assets/js/argon-dashboard.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>

</html>
