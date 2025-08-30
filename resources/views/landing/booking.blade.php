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
                            <img src="{{ asset('assets/img/team-1.jpg') }}" alt="Avatar">
                            <span class="text-primary">{{ Auth::user()->name }}</span>
                            <i class="arrow-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#">My Profile</a>
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
                            <p class="guide-price">Rp. {{ number_format($guide->guideProfile->daily_rate, 0, ',', '.') }} / per day</p>
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
                        <form action="{{ route('customer.booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="guide_id" value="{{ $guide->id }}">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Start Date</label>
                                    <input type="datetime-local" name="start_time" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>End Date</label>
                                    <input type="datetime-local" name="end_time" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Number of Participants</label>
                                <input type="number" name="number_of_travelers" class="form-control" min="1"
                                    max="{{ $guide->guideProfile->max_travelers }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Travel Destination</label>
                                <input type="text" name="destination" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Notes (Opsional)</label>
                                <textarea name="notes" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Booking Now</button>
                        </form>
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
</body>

</html>
