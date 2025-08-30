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

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
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

                <a href="tel:{{ $contact->no_telp }}" class="helpline-box">

                    <div class="icon-box">
                        <ion-icon name="call-outline"></ion-icon>
                    </div>

                    <div class="wrapper">
                        <p class="helpline-title">For Further Inquires :</p>

                        <p class="helpline-number">{{ $contact->no_telp }}</p>
                    </div>

                </a>

                <a href="/" class="logo">
                    <img src="{{ asset('assets/img/landing-page/osingguide-whitelogo.PNG') }}" alt="OsingGuide logo" width="100px">
                </a>

                <div class="header-btn-group">

                    <button class="search-btn" aria-label="Search">
                        <ion-icon name="search"></ion-icon>
                    </button>

                    <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
                        <ion-icon name="menu-outline"></ion-icon>
                    </button>

                </div>

            </div>
        </div>

        <div class="header-bottom">
            <div class="container">

                <ul class="social-list">

                    <li>
                        <a href="https://www.instagram.com/osingguide?igsh=eXVmdWlkbHdyMmYx" class="social-link">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-youtube"></ion-icon>
                        </a>
                    </li>

                </ul>

                <nav class="navbar" data-navbar>

                    <div class="navbar-top">

                        <a href="/" class="logo">
                            <img src="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}" alt="OsingGuide logo">
                        </a>

                        <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>

                    </div>

                    <ul class="navbar-list">

                        <li>
                            <a href="/#home" class="navbar-link" data-nav-link>home</a>
                        </li>

                        <li>
                            <a href="#" class="navbar-link" data-nav-link>about us</a>
                        </li>

                        <li>
                            <a href="#place" class="navbar-link" data-nav-link>place to visit</a>
                        </li>

                        <li>
                            <a href="#recommendation" class="navbar-link" data-nav-link>recomendation</a>
                        </li>

                        <li>
                            <a href="#gallery" class="navbar-link" data-nav-link>gallery</a>
                        </li>

                        <li>
                            <a href="#contact" class="navbar-link" data-nav-link>contact us</a>
                        </li>

                    </ul>

                </nav>

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
                            <span class="profile-name">{{ Auth::user()->name }}</span>
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

    </header>

    <main>
        <article>

            <!--
        - #HERO
      -->

            <section class="hero" id="home">
                <div class="container">

                    <h2 class="h1 hero-title">enhance your travel experience in banyuwangi with our guide</h2>

                    <p class="hero-text">
                        OsingGuide is paltform for you to explore banyuwangi with great guide
                    </p>

                    <div class="btn-group">
                        <button class="btn btn-primary">Learn more</button>

                        <a href="{{ route('customer.list-guides') }}" class="btn btn-secondary">Book Now</a>
                    </div>

                </div>
            </section>

            <!--
        - # Menu
      -->

            <section class="tour-search">
                <div class="container">
                    <form action="{{ route('customer.list-guides') }}" method="GET" class="tour-search-form">

                        <div class="input-wrapper">
                            <label for="level" class="input-label">Level Guides*</label>
                            <select name="level" id="level" class="input-select">
                                <option value="" selected hidden>--Select Level--</option>
                                <option value="junior" {{ request('level')=='junior' ?'selected':'' }}>Junior</option>
                                <option value="intermediate" {{ request('level')=='intermediate' ?'selected':'' }}>Intermediate
                                </option>
                                <option value="expert" {{ request('level')=='expert' ?'selected':'' }}>Expert</option>
                            </select>
                        </div>

                        <div class="input-wrapper">
                            <label for="skill" class="input-label">Skills*</label>
                            <select name="skills[]" id="skill" class="input-select">
                                <option value="" selected hidden>-- Select Skill--</option>
                                @foreach(['Hiking','Photography','Cultural Tour','Food Tour','City
                                Walk','History','Adventure','Family Tour'] as $skill)
                                <option value="{{ $skill }}" {{ in_array($skill,(array)request('skills'))?'selected':'' }}>
                                    {{ $skill }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrapper">
                            <label for="start-date" class="input-label">Start Tour*</label>
                            <input type="date" name="start_date" id="start-date" value="{{ request('start_date') }}" required
                                class="input-field">
                        </div>

                        <div class="input-wrapper">
                            <label for="end-date" class="input-label">End Tour*</label>
                            <input type="date" name="end_date" id="end-date" value="{{ request('end_date') }}" required
                                class="input-field">
                        </div>

                        <button type="submit" class="btn btn-secondary">Search Guides</button>
                    </form>
                </div>
            </section>

            <!--
        - #POPULAR
      -->

            <section class="popular" id="place">
                <div class="container">

                    <p class="section-subtitle">most visited</p>

                    <h2 class="h2 section-title">Popular Place to Visit in Banyuwangi</h2>

                    <p class="section-text">
                        There are many tourist attractions in Banyuwangi that must be visited, starting from mountains, forests or
                        beaches and they certainly will not disappoint.
                    </p>

                    <ul class="popular-list">
                        @foreach($places as $place)
                        <li>
                            <div class="popular-card">

                                <figure class="card-img">
                                    <img src="{{ asset('storage/' . $place->image) }}" alt="{{ $place->name_place }}"
                                        loading="lazy">
                                </figure>

                                <div class="card-content">

                                    <div class="card-rating">
                                        @for($i = 0; $i < $place->rating; $i++)
                                            <ion-icon name="star"></ion-icon>
                                            @endfor
                                    </div>

                                    <p class="card-subtitle">
                                        {{ $place->location }}
                                    </p>

                                    <h3 class="h3 card-title">
                                        <a href="#">
                                            {{ $place->name_place }}
                                        </a>
                                    </h3>

                                    <p class="card-text">
                                        {{ Str::limit($place->content, 25, '...') }}
                                    </p>

                                </div>

                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('customer.list-places') }}">
                        <button class="btn btn-primary">More Place Destination</button>
                    </a>

                </div>
            </section>

            <!--
        - #PACKAGE
      -->

            <section class="package" id="recommendation">
                <div class="container">

                    <p class="section-subtitle">Check Our Guide to Help Your Travel</p>

                    <h2 class="h2 section-title">Guide Recommendation</h2>

                    <p class="section-text">
                        We provide guides who are professional in their duties who will definitely guide you to get to know more
                        about the city of Banyuwangi.
                    </p>

                    <ul class="package-list">
                        @foreach($guides as $guide)
                        <li>
                            <div class="package-card">

                                <figure class="card-banner">
                                    <img src="{{ $guide->guideProfile->photo ? asset('storage/'.$guide->guideProfile->photo) : asset('assets/img/team-1.jpg') }}"
                                        alt="{{ $guide->name }}" loading="lazy">
                                </figure>

                                <div class="card-content">

                                    <h3 class="h3 card-title">{{ $guide->name }}</h3>

                                    <p class="card-text">
                                        {{ $guide->guideProfile->bio }}
                                    </p>

                                    <ul class="card-meta-list">
                                        <li class="card-meta-item">
                                            <div class="meta-box">
                                                <ion-icon name="people"></ion-icon>
                                                <p class="text">{{ ucfirst($guide->guideProfile->level) }} Guide</p>
                                            </div>
                                        </li>

                                        <li class="card-meta-item">
                                            <div class="meta-box">
                                                <ion-icon name="location"></ion-icon>
                                                <p class="text">Banyuwangi</p>
                                            </div>
                                        </li>
                                    </ul>

                                </div>

                                <div class="card-price">

                                    <div class="wrapper">
                                        <p class="reviews">({{ $guide->reviews_count }} reviews)</p>

                                        <div class="card-rating">
                                            <span class="rating-text">{{ number_format($guide->guideProfile->rating ?? 0, 1) }}/5</span>
                                            <ion-icon name="star"></ion-icon>
                                        </div>
                                    </div>

                                    <p class="price">
                                        @php
                                        $dailyRate = $guide->guideProfile->daily_rate;
                                        $platformFeePercentage = \App\Models\Setting::getValue('platform_fee_value') ?? 15;
                                        $platformFee = ($dailyRate * $platformFeePercentage) / 100;
                                        $totalDailyRate = $dailyRate + $platformFee;
                                        @endphp
                                        Rp. {{ number_format($totalDailyRate, 0, ',', '.') }}
                                        <span>/ per day</span>
                                    </p>

                                    <a href="{{ route('customer.booking.create', $guide->id) }}">
                                        <button class="btn btn-secondary">Book Now</button>
                                    </a>

                                </div>

                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('customer.list-guides') }}">
                        <button class="btn btn-primary">View All Guide</button>
                    </a>

                </div>
            </section>
            <!--
        - #GALLERY
      -->

            <section class="gallery" id="gallery">
                <div class="container">

                    <p class="section-subtitle">Photo Gallery</p>

                    <h2 class="h2 section-title">Photo's From Travellers</h2>

                    <p class="section-text">
                        These beautiful photos were captured as very beautiful memories while exploring Banyuwangi.
                    </p>

                    <ul class="gallery-list">

                        @foreach($galleries as $gallery)
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gallery Images">
                            </figure>
                        </li>
                        @endforeach

                    </ul>

                    <a href="{{ route('customer.list-gallery') }}">
                        <button class="btn btn-primary">More Photo's</button>
                    </a>

                </div>
            </section>

         <!--
        - #CTA
      -->

            <section class="cta" id="contact">
                <div class="container">

                    <div class="cta-content">
                        <p class="section-subtitle">Call To Action</p>

                        <h2 class="h2 section-title">Confused about where to go in Banyuwangi?</h2>

                        <p class="section-text">
                            Don't worry, we offer free consultations!
                            <br> Free consultations to help you decide where to go in Banyuwangi because Banyuwangi has so many cool tourist attractions.
                        </p>
                    </div>

                    <a href="https://wa.me/{{ $contact->no_telp }}?text=Hallo%2C%20saya%20ingin%20konsultasi%20perjalanan%20wisata">
                        <button class="btn btn-secondary">Get Free Consultation Now!</button>
                    </a>

                </div>
            </section>

        </article>
    </main>

    <!--
    - #FOOTER
  -->

    <footer class="footer">

        <div class="footer-top">
            <div class="container">

                <div class="footer-brand">

                    <a href="#" class="logo">
                        <img src="{{ asset('storage/' . $about->logo) }}" alt="OsingGuide logo">
                    </a>

                    <p class="footer-text">
                        {{ $about->description }}
                    </p>

                </div>

                <div class="footer-contact">

                    <h4 class="contact-title">Contact Us</h4>

                    <p class="contact-text">
                        Feel free to contact and reach us !!
                    </p>

                    <ul>

                        <li class="contact-item">
                            <ion-icon name="call-outline"></ion-icon>

                            <a href="tel:{{ $contact->no_telp }}" class="contact-link">{{ $contact->no_telp }}</a>
                        </li>

                        <li class="contact-item">
                            <ion-icon name="mail-outline"></ion-icon>

                            <a href="mailto:{{ $contact->email }}" class="contact-link">{{ $contact->email }}</a>
                        </li>

                        <li class="contact-item">
                            <ion-icon name="location-outline"></ion-icon>

                            <address>{{ $contact->address }}</address>
                        </li>

                    </ul>

                </div>

                <div class="footer-form">

                    <p class="form-text">
                        Subscribe our newsletter for more update & news !!
                    </p>

                    <form action="" class="form-wrapper">
                        <input type="email" name="email" class="input-field" placeholder="Enter Your Email" required>

                        <button type="submit" class="btn btn-secondary">Subscribe</button>
                    </form>

                </div>

            </div>
        </div>

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

</body>

</html>
