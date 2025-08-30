<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OsingGuide - Make Your Trip Easier</title>

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

    <style>
        .booking-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
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

        .guide-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .booking-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .price-summary {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-top: 20px;
            border: 2px solid #e9ecef;
        }

        .price-summary h3 {
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .price-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .price-row:last-child {
            border-bottom: none;
        }

        .price-row.total {
            font-weight: bold;
            font-size: 1.1em;
            color: #2a7f46;
            border-top: 2px solid #2a7f46;
            margin-top: 10px;
            padding-top: 15px;
        }

        .price-row span:first-child {
            color: #666;
        }

        .price-row span:last-child {
            font-weight: 500;
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
                    <h2 class="h2 section-title">Detail Guide & Booking Form</h2>
                    <p class="section-text">Check our guide to see if it suits your needs.</p>

                    <!-- Detail Guide -->
                    <div class="guide-info">
                        <div class="guide-photo">
                            <img src="{{ $guide->guideProfile->photo ? asset('storage/'.$guide->guideProfile->photo) : asset('assets/img/team-1.jpg') }}"
                                        alt="{{ $guide->name }}" loading="lazy">
                        </div>
                        <div class="guide-desc">
                            <h2>{{ $guide->name }}</h2>
                            <p class="guide-category">{{ ucfirst($guide->guideProfile->level) }} Guide</p>
                            <div class="guide-rating">
                                <span class="rating-text">{{ number_format($guide->guideProfile->rating ?? 0, 1) }}/5</span>
                                <ion-icon name="star"></ion-icon>
                            </div>
                            <p class="guide-price">
                                @php
                                $dailyRate = $guide->guideProfile->daily_rate;
                                $platformFeePercentage = \App\Models\Setting::getValue('platform_fee_value') ?? 15;
                                $platformFee = ($dailyRate * $platformFeePercentage) / 100;
                                $totalDailyRate = $dailyRate + $platformFee;
                                @endphp
                                Rp. {{ number_format($totalDailyRate, 0, ',', '.') }} <span>/day</span>
                            </p>
                            <p class="guide-bio">Bio : {{ $guide->guideProfile->bio }}</p>

                            <ul class="guide-skills">
                                @if(!empty($guide->guideProfile->skills) && is_array($guide->guideProfile->skills))
                                @foreach($guide->guideProfile->skills as $skill)
                                <li>{{ $skill }}</li>
                                @endforeach
                                @else
                                <li>No skills listed</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <hr>

                    <!-- Form Pemesanan -->
                    <div class="booking-form">
                        <h3>Booking Form of {{ $guide->name }}</h3>

                        <!-- Info Box -->
                        <div class="alert alert-info" role="alert">
                            <strong>Info:</strong> Pastikan guide telah menandai ketersediaan untuk tanggal yang Anda pilih.
                            Jika guide belum menandai ketersediaan, booking tidak dapat diproses.
                        </div>

                        <!-- Error Notifications -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-start" role="alert">
                                <div>
                                    <strong>Error!</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-start" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('customer.booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="guide_id" value="{{ $guide->id }}">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Start Date</label>
                                    <input type="datetime-local" name="start_time" class="form-control @error('start_time') is-invalid @enderror"
                                           min="{{ date('Y-m-d\TH:i') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>End Date</label>
                                    <input type="datetime-local" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                                           min="{{ date('Y-m-d\TH:i') }}" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Number of Participants</label>
                                <input type="number" name="number_of_travelers" class="form-control @error('number_of_travelers') is-invalid @enderror"
                                       min="1" max="{{ $guide->guideProfile->max_travelers }}" required>
                                @error('number_of_travelers')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>Travel Destination</label>
                                <input type="text" name="destination" class="form-control @error('destination') is-invalid @enderror" required>
                                @error('destination')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>Notes (Opsional)</label>
                                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror"></textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Booking Now</button>
                        </form>
                    </div>

                    <!-- Price Summary -->
                    <div class="price-summary" id="price-summary" style="display: none;">
                        <h3>Price Summary</h3>
                        <div class="price-details">
                            <div class="price-row">
                                <span>Guide Daily Rate:</span>
                                <span id="daily-rate">Rp 0</span>
                            </div>
                            <div class="price-row">
                                <span>Total Days:</span>
                                <span id="total-days">0 days</span>
                            </div>
                            <div class="price-row total">
                                <span>Total Price:</span>
                                <span id="total-price">Rp 0</span>
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
        // Price calculation variables - using total daily rate that already includes platform fee
        const totalDailyRate = {{ $guide->guideProfile->daily_rate + (($guide->guideProfile->daily_rate * (\App\Models\Setting::getValue('platform_fee_value') ?? 15)) / 100) }};

        // Function to calculate price
        function calculatePrice() {
            const startTime = document.querySelector('input[name="start_time"]').value;
            const endTime = document.querySelector('input[name="end_time"]').value;

            if (startTime && endTime) {
                const start = new Date(startTime);
                const end = new Date(endTime);

                // Check if same day booking
                const startDate = start.toDateString();
                const endDate = end.toDateString();
                let totalDays;

                if (startDate === endDate) {
                    // Same day booking = 1 day
                    totalDays = 1;
                } else {
                    // Multi-day booking = actual difference
                    const timeDiff = end.getTime() - start.getTime();
                    totalDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                }

                if (totalDays > 0) {
                    const totalPrice = totalDailyRate * totalDays;

                    // Update price summary
                    document.getElementById('daily-rate').textContent = 'Rp ' + totalDailyRate.toLocaleString('id-ID');
                    document.getElementById('total-days').textContent = totalDays + ' days';
                    document.getElementById('total-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');

                    // Show price summary
                    document.getElementById('price-summary').style.display = 'block';
                }
            }
        }

        // Function to validate dates
        function validateDates() {
            const startTimeInput = document.querySelector('input[name="start_time"]');
            const endTimeInput = document.querySelector('input[name="end_time"]');
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;

            if (startTime && endTime) {
                const start = new Date(startTime);
                const end = new Date(endTime);
                const now = new Date();

                // Check if start date is in the past
                if (start < now) {
                    startTimeInput.setCustomValidity('Start date cannot be in the past');
                    startTimeInput.reportValidity();
                    return false;
                } else {
                    startTimeInput.setCustomValidity('');
                }

                // Check if end date is before start date
                if (end <= start) {
                    endTimeInput.setCustomValidity('End date must be after start date');
                    endTimeInput.reportValidity();
                    return false;
                } else {
                    endTimeInput.setCustomValidity('');
                }

                // Check if booking is more than 90 days in advance
                const daysDiff = Math.ceil((start - now) / (1000 * 60 * 60 * 24));
                if (daysDiff > 90) {
                    startTimeInput.setCustomValidity('Booking cannot be more than 90 days in advance');
                    startTimeInput.reportValidity();
                    return false;
                } else {
                    startTimeInput.setCustomValidity('');
                }
            }

            return true;
        }

        // Add event listeners to form inputs
        document.addEventListener('DOMContentLoaded', function() {
            const startTimeInput = document.querySelector('input[name="start_time"]');
            const endTimeInput = document.querySelector('input[name="end_time"]');
            const form = document.querySelector('form');

            // Set minimum date to current date and time
            const now = new Date();
            const nowString = now.toISOString().slice(0, 16);
            startTimeInput.min = nowString;
            endTimeInput.min = nowString;

            startTimeInput.addEventListener('change', function() {
                validateDates();
                calculatePrice();

                // Update end date minimum to start date
                if (this.value) {
                    endTimeInput.min = this.value;
                }
            });

            endTimeInput.addEventListener('change', function() {
                validateDates();
                calculatePrice();
            });

            // Form submission validation
            form.addEventListener('submit', function(e) {
                if (!validateDates()) {
                    e.preventDefault();
                    return false;
                }
            });

            // Auto-hide alerts after 5 seconds
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
