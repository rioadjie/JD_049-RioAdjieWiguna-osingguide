<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OsingGuide | Beri Ulasan Guide</title>

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

        .rating-stars {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }

        .star {
            font-size: 2rem;
            cursor: pointer;
            color: #ddd;
            transition: color 0.2s;
        }

        .star.active {
            color: #ffc107;
        }

        .star:hover {
            color: #ffc107;
        }

        .booking-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .guide-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        /* === DETAIL WRAPPER === */
        .detail-wrapper {
            display: flex;
            gap: 2rem;
            align-items: stretch;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        /* === FOTO GUIDE === */
        .guide-photo {
            flex: 1 1 300px;
            max-width: 400px;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .guide-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* === INFO GUIDE === */
        .detail-wrapper > div:last-child {
            flex: 2 1 300px;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            padding: 0;
            min-height: 100%;
            box-sizing: border-box;
        }

        /* === HEADER INFO === */
        .guide-header {
            margin-bottom: 0.3rem;
        }

        .guide-name {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            color: #222;
        }

        .guide-level {
            font-size: 1.2rem;
            color: #666;
            margin: 0.2rem 0 0;
        }

        /* === TRIP DETAILS === */
        .trip-details {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .detail-item strong {
            font-size: 0.9rem;
            color: #666;
            font-weight: 600;
        }

        .detail-item p {
            font-size: 1rem;
            color: #222;
            margin: 0;
            font-weight: 500;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .detail-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }

            .guide-photo,
            .detail-wrapper > div:last-child {
                max-width: 100%;
                width: 100%;
                min-height: auto;
            }

            .detail-wrapper > div:last-child {
                padding: 1rem 0;
                box-sizing: border-box;
            }
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
                    <h2 class="h2 section-title">Review Guide</h2>
                    <p class="section-text">Share your experience with our guide.</p>

                    <!-- Booking Info -->
                    <div class="detail-wrapper">
                        <!-- Foto Profil Guide -->
                        <div class="guide-photo">
                            <img src="{{ $booking->guide->guideProfile->photo ? asset('storage/' . $booking->guide->guideProfile->photo) : asset('assets/img/team-1.jpg') }}"
                                alt="{{ $booking->guide->name }}">
                        </div>

                        <!-- Informasi Utama -->
                        <!-- Nama & Level -->
                        <div class="guide-header">
                            <h2 class="guide-name">{{ $booking->guide->name }}</h2>
                            <p class="guide-level">{{ ucfirst($booking->guide->guideProfile->level) }} Guide</p>
                            <!-- Trip Details -->
                            <div class="trip-details mt-2">
                                <div class="detail-item">
                                    <strong>Trip Dates:</strong>
                                    <p>{{ $booking->start_time->format('d M Y H:i') }} - {{ $booking->end_time->format('d M Y H:i') }}</p>
                                </div>

                                <div class="detail-item">
                                    <strong>Destination:</strong>
                                    <p>{{ $booking->destination }}</p>
                                </div>

                                <div class="detail-item">
                                    <strong>Number of Travelers:</strong>
                                    <p>{{ $booking->number_of_travelers }} orang</p>
                                </div>

                                <div class="detail-item">
                                    <strong>Total Price:</strong>
                                    <p>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Review Form -->
                    <div class="card shadow-lg border-1 mb-3">
                        <div class="card-body p-4">
                            <form action="{{ route('customer.review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                <div class="mb-4">
                                    <label class="form-label">Rating Guide</label>
                                    <div class="rating-stars" id="ratingStars">
                                        <span class="star" data-rating="1">★</span>
                                        <span class="star" data-rating="2">★</span>
                                        <span class="star" data-rating="3">★</span>
                                        <span class="star" data-rating="4">★</span>
                                        <span class="star" data-rating="5">★</span>
                                    </div>
                                    <input type="hidden" name="rating" id="ratingInput" required>
                                    @error('rating')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="comment" class="form-label">Comment (Optional)</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="4"
                                        placeholder="Bagikan pengalaman Anda dengan guide ini...">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Send Review
                                    </button>
                                    <a href="{{ route('customer.bookings') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Back
                                    </a>
                                </div>
                            </form>
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

    <!-- Rating Stars JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('ratingInput');
            let currentRating = 0;

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    currentRating = rating;
                    ratingInput.value = rating;

                    // Update star display
                    stars.forEach((s, index) => {
                        if (index < rating) {
                            s.classList.add('active');
                        } else {
                            s.classList.remove('active');
                        }
                    });
                });

                star.addEventListener('mouseenter', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));

                    stars.forEach((s, index) => {
                        if (index < rating) {
                            s.style.color = '#ffc107';
                        } else {
                            s.style.color = '#ddd';
                        }
                    });
                });

                star.addEventListener('mouseleave', function() {
                    stars.forEach((s, index) => {
                        if (index < currentRating) {
                            s.style.color = '#ffc107';
                        } else {
                            s.style.color = '#ddd';
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
