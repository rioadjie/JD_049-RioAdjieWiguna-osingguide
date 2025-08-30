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
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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

                        <a href="#" class="logo">
                            <img src="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}" alt="Tourly logo">
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
                            <a href="/#" class="navbar-link" data-nav-link>about us</a>
                        </li>

                        <li>
                            <a href="{{ route('customer.list-places') }}" class="navbar-link" data-nav-link>place to visit</a>
                        </li>

                        <li>
                            <a href="{{ route('customer.list-guides') }}" class="navbar-link" data-nav-link>recomendation</a>
                        </li>

                        <li>
                            <a href="{{ route('customer.list-gallery') }}" class="navbar-link" data-nav-link>gallery</a>
                        </li>

                        <li>
                            <a href="/#contact" class="navbar-link" data-nav-link>contact us</a>
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
                            <img src="{{ asset('assets/img/team-1.jpg') }}" alt="Avatar">
                            <span class="profile-name">{{ Auth::user()->name }}</span>
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

    </header>

    <main>
        <article>

            <!-- Carousel Section -->
            {{-- <div class="swiper heroSwiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/landing-page/ijen-photo.jpeg') }}" alt="Kawah Ijen" />
                    </div>

                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/landing-page/pulau-merah.jpeg') }}" alt="Pulau Merah" />
                    </div>

                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/landing-page/djawatan.jpeg') }}" alt="Djawatan" />
                    </div>

                </div>

                <!-- Pagination & Navigation -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div> --}}

            <!--
            - #List Guide
            -->

            <section class="package" id="guide">
                <div class="container" style="margin-top: 80px">
                    <p class="section-subtitle">Check Our Guide to Help Your Travel</p>
                    <h2 class="h2 section-title">List Guide</h2>
                    <p class="section-text">List of our guide in OsingGuide.</p>

                    <!-- Top Filter -->
                    <div class="top-filters">
                        <button class="filter-btn {{ request('level')=='all' || !request('level') ? 'active':'' }}"
                            data-sort="all">All</button>
                        <button class="filter-btn {{ request('level')=='junior' ? 'active':'' }}" data-sort="junior">Junior Guide</button>
                        <button class="filter-btn {{ request('level')=='intermediate' ? 'active':'' }}"
                            data-sort="intermediate">Intermediate Guide</button>
                        <button class="filter-btn {{ request('level')=='expert' ? 'active':'' }}" data-sort="expert">Expert Guide</button>

                        <select id="price-sort">
                            <option value="">Sort by Price</option>
                            <option value="low">Lowest Price</option>
                            <option value="high">Highest Price</option>
                        </select>
                    </div>

                    <div class="guide-page">
                        <!-- Tombol untuk membuka sidebar (tampil di mobile) -->
                        <button class="open-sidebar-btn">☰ Filters</button>

                        <!-- Sidebar Filter -->
                        <aside class="sidebar" id="sidebar">
                            <button class="close-sidebar-btn">&times;</button> <!-- Tombol close -->

                            <section>
                                <h3>Availbility Guides</h3>
                                <div class="date-range">
                                    <label for="start-date">From</label>
                                    <input type="date" id="start-date" value="{{ request('start_date') }}">

                                    <label for="end-date">To</label>
                                    <input type="date" id="end-date" value="{{ request('end_date') }}">

                                    <button type="button" class="btn-apply-date" id="apply-date-btn">Apply Date</button>
                                </div>
                            </section>

                            <section>
                                <h3>Language</h3>
                                @foreach(['Indonesia','English','Mandarin','Japanese','Korean','Arabic'] as $lang)
                                <label>
                                    <input type="checkbox" value="{{ $lang }}" class="filter-language" {{
                                        in_array($lang,(array)request('languages')) ? 'checked' : '' }}>
                                    <span class="checkmark"></span> {{ $lang }}
                                </label>
                                @endforeach
                            </section>

                            <section>
                                <h3>Skills</h3>
                                @foreach(['Hiking','Photography','Cultural Tour','Food Tour','City
                                Walk','History','Adventure','Family Tour', 'Fasilitator Outbound', 'Trainer Outbound'] as $skill)
                                <label>
                                    <input type="checkbox" value="{{ $skill }}" class="filter-skill" {{ in_array($skill,(array)request('skills'))
                                        ? 'checked' : '' }}>
                                    <span class="checkmark"></span> {{ $skill }}
                                </label>
                                @endforeach
                            </section>

                            <section class="filter-reset">
                                <button type="button" class="btn-reset-filters" id="reset-filters-btn">Reset All
                                    Filters</button>
                            </section>
                        </aside>


                        <!-- Konten Card -->
                        <main class="guide-list-wrapper">
                            <div class="cards-grid" id="guide-list">
                                @forelse($guides as $guide)
                                <div class="popular-card" data-category="{{ strtolower($guide->guideProfile->level) }}"
                                    data-price="{{ $guide->guideProfile->daily_rate }}"
                                    data-language="{{ implode(',', $guide->guideProfile->languages) }}"
                                    data-skill="{{ implode(',', $guide->guideProfile->skills) }}"
                                    data-availability='@json($guide->availabilities->where("status","available")->pluck("date")->map->format("Y-m-d"))'>
                                    <figure class="card-img">
                                        <img src="{{ $guide->guideProfile->photo ? asset('storage/'.$guide->guideProfile->photo) : asset('assets/img/team-1.jpg') }}"
                                            alt="{{ $guide->name }}" loading="lazy">
                                    </figure>

                                    <div class="card-content">
                                        <div class="card-rating">
                                            <span class="rating-text">{{ number_format($guide->guideProfile->rating ??
                                                0, 1)
                                                }}/5</span>
                                            <ion-icon name="star"></ion-icon>
                                        </div>
                                        <p class="card-subtitle">{{ ucfirst($guide->guideProfile->level) }}</p>
                                        <h3 class="h3 card-title">{{ $guide->name }}</h3>
                                        <p class="card-text">
                                            @php
                                                $dailyRate = $guide->guideProfile->daily_rate;
                                                $platformFeePercentage = \App\Models\Setting::getValue('platform_fee_value') ?? 15;
                                                $platformFee = ($dailyRate * $platformFeePercentage) / 100;
                                                $totalDailyRate = $dailyRate + $platformFee;
                                            @endphp
                                            Rp. {{ number_format($totalDailyRate, 0, ',', '.') }} / per day
                                        </p>
                                        <a href="{{ route('customer.show', $guide->id) }}">
                                            <button type="button" class="btn-book-now">Lihat Detail</button>
                                        </a>
                                    </div>
                                </div>
                                @empty
                                <p class="section-text">No guides available for your filters.</p>
                                @endforelse
                            </div>
                        </main>
                    </div>
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
                            <br> Free consultations to help you decide where to go in Banyuwangi because Banyuwangi has
                            so many cool tourist attractions.
                        </p>
                    </div>

                    <a
                        href="https://wa.me/6287864310772?text=Hallo%2C%20saya%20ingin%20konsultasi%20perjalanan%20wisata">
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
                        <img src="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}" alt="Tourly logo">
                    </a>

                    <p class="footer-text">
                        OsingGuide is for you to make your travel more easier with our guide.
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

                            <a href="tel:+6287864310772" class="contact-link">+6287864310772</a>
                        </li>

                        <li class="contact-item">
                            <ion-icon name="mail-outline"></ion-icon>

                            <a href="mailto:osingguide@gmail.com" class="contact-link">osingguide@gmail.com</a>
                        </li>

                        <li class="contact-item">
                            <ion-icon name="location-outline"></ion-icon>

                            <address>Banyuwangi</address>
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
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Init Hero Swiper -->
    <script>
        var heroSwiper = new Swiper(".heroSwiper", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    </script>
    {{-- filter js --}}
    <script>
        const sidebar = document.getElementById("sidebar");
        const openBtn = document.querySelector(".open-sidebar-btn");
        const closeBtn = document.querySelector(".close-sidebar-btn");

        openBtn.addEventListener("click", () => {
            sidebar.classList.add("active");
        });

        closeBtn.addEventListener("click", () => {
            sidebar.classList.remove("active");
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll(".popular-card");
            const filterBtns = document.querySelectorAll(".filter-btn");
            const priceSort = document.getElementById("price-sort");
            const applyDateBtn = document.getElementById("apply-date-btn");
            const resetBtn = document.getElementById("reset-filters-btn");

            function applyFilters() {
                const activeCategory = document.querySelector(".filter-btn.active")?.dataset.sort || "all";
                const selectedLanguages = Array.from(document.querySelectorAll(".filter-language:checked")).map(el => el.value);
                const selectedSkills = Array.from(document.querySelectorAll(".filter-skill:checked")).map(el => el.value);
                const startDate = document.getElementById("start-date")?.value;
                const endDate = document.getElementById("end-date")?.value;

                cards.forEach(card => {
                    const category = card.dataset.category;
                    const price = parseInt(card.dataset.price);
                    const languages = card.dataset.language ? card.dataset.language.split(",") : [];
                    const skills = card.dataset.skill ? card.dataset.skill.split(",") : [];
                    const availabilities = card.dataset.availability ? JSON.parse(card.dataset.availability) : [];

                    let visible = true;

                    // Filter kategori
                    if (activeCategory !== "all" && category !== activeCategory) visible = false;

                    // Filter bahasa
                    if (selectedLanguages.length) {
                        const matchLanguage = selectedLanguages.some(lang => languages.includes(lang));
                        if (!matchLanguage) visible = false;
                    }

                    // Filter skill
                    if (selectedSkills.length) {
                        const matchSkill = selectedSkills.some(skill => skills.includes(skill));
                        if (!matchSkill) visible = false;
                    }

                    // Filter tanggal (availability)
                    if (startDate || endDate) {
                        let matchDate = false;
                        if (availabilities.length) {
                            matchDate = availabilities.some(date => {
                                if (startDate && date < startDate) return false;
                                if (endDate && date > endDate) return false;
                                return true;
                            });
                        }
                        if (!matchDate) visible = false;
                    }

                    card.style.display = visible ? "block" : "none";
                });

                // Sort harga
                if (priceSort.value) {
                    const sortedCards = Array.from(cards).sort((a, b) => {
                        const priceA = parseInt(a.dataset.price);
                        const priceB = parseInt(b.dataset.price);
                        return priceSort.value === "low" ? priceA - priceB : priceB - priceA;
                    });
                    const container = document.getElementById("guide-list");
                    container.innerHTML = "";
                    sortedCards.forEach(card => container.appendChild(card));
                }
            }

            // Event listeners
            filterBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    filterBtns.forEach(b => b.classList.remove("active"));
                    btn.classList.add("active");
                    applyFilters();
                });
            });

            document.querySelectorAll(".filter-language, .filter-skill").forEach(el => el.addEventListener("change", applyFilters));
            priceSort.addEventListener("change", applyFilters);
            applyDateBtn?.addEventListener("click", applyFilters);

            // Reset All Filters
            resetBtn?.addEventListener("click", () => {
                // Reset kategori ke 'all'
                filterBtns.forEach(btn => btn.classList.remove("active"));
                const defaultBtn = document.querySelector(".filter-btn[data-sort='all']");
                if (defaultBtn) defaultBtn.classList.add("active");

                // Reset checkboxes
                document.querySelectorAll(".filter-language, .filter-skill").forEach(el => el.checked = false);

                // Reset tanggal
                const startInput = document.getElementById("start-date");
                const endInput = document.getElementById("end-date");
                if (startInput) startInput.value = "";
                if (endInput) endInput.value = "";

                // Reset sort harga
                if (priceSort) priceSort.value = "";

                applyFilters();
            });

            applyFilters(); // apply default on load
        });
    </script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
