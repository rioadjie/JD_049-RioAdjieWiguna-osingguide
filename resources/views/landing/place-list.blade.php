<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OsingGuide - Places to Visit</title>

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

    <!-- Search Box Styles -->
    <style>
        /* Search Box Styles */
        .search-box {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 15px;
        }

        .search-box input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
        }

        .search-box input[type="text"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.1);
        }

        .search-box input[type="text"]::placeholder {
            color: #999;
            font-style: italic;
        }

        .search-box .btn-search {
            padding: 10px 16px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            white-space: nowrap;
        }

        .search-box .btn-search:hover {
            background-color: var(--secondary);
            transform: translateY(-1px);
        }

        .search-box .btn-search:active {
            transform: translateY(0);
        }

        /* Media query untuk search box di mobile */
        @media (max-width: 480px) {
            .search-box {
                flex-direction: column;
                gap: 8px;
            }

            .search-box input[type="text"],
            .search-box .btn-search {
                width: 100%;
            }
        }
    </style>

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
                            <a href="{{ route('customer.list-places') }}" class="navbar-link" data-nav-link>place to
                                visit</a>
                        </li>

                        <li>
                            <a href="{{ route('customer.list-guides') }}" class="navbar-link"
                                data-nav-link>recomendation</a>
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

            <!--
            - #List Places
            -->

            <section class="package" id="places">
                <div class="container" style="margin-top: 80px">
                    <p class="section-subtitle">Discover Amazing Destinations</p>
                    <h2 class="h2 section-title">Places to Visit</h2>
                    <p class="section-text">Explore the beautiful destinations in Banyuwangi.</p>

                    <!-- Top Filter -->
                    <div class="top-filters">
                        <button class="filter-btn {{ request('rating')=='all' || !request('rating') ? 'active':'' }}"
                            data-sort="all">All Places</button>
                        <button class="filter-btn {{ request('rating')=='5' ? 'active':'' }}" data-sort="5">5+
                            Stars</button>
                        <button class="filter-btn {{ request('rating')=='4' ? 'active':'' }}" data-sort="4">4+
                            Stars</button>
                        <button class="filter-btn {{ request('rating')=='3' ? 'active':'' }}" data-sort="3">3+
                            Stars</button>

                        <select id="rating-sort">
                            <option value="">Sort by Rating</option>
                            <option value="high">Highest Rating</option>
                            <option value="low">Lowest Rating</option>
                        </select>
                    </div>

                    <div class="place-page">
                        <!-- Tombol untuk membuka sidebar (tampil di mobile) -->
                        <button class="open-sidebar-btn">☰ Filters</button>

                        <!-- Sidebar Filter -->
                        <aside class="sidebar" id="sidebar">
                            <button class="close-sidebar-btn">&times;</button> <!-- Tombol close -->

                            <section>
                                <h3>Search Places</h3>
                                <div class="search-box">
                                    <input type="text" id="search-input" placeholder="Search by name, location..."
                                        value="{{ request('search') }}">
                                    <button type="button" class="btn-search" id="search-btn">Search</button>
                                </div>
                            </section>

                            <section>
                                <h3>Rating Filter</h3>
                                @foreach([5,4,3,2,1] as $rating)
                                <label>
                                    <input type="checkbox" value="{{ $rating }}" class="filter-rating" {{
                                        in_array($rating,(array)request('rating')) ? 'checked' : '' }}>
                                    <span class="checkmark"></span> {{ $rating }}+ Stars
                                </label>
                                @endforeach
                            </section>

                            <section class="filter-reset">
                                <button type="button" class="btn-reset-filters" id="reset-filters-btn">Reset All
                                    Filters</button>
                            </section>
                        </aside>

                        <!-- Konten Card -->
                        <main class="place-list-wrapper">
                            <div class="cards-grid" id="place-list">
                                @forelse($places as $place)
                                <div class="popular-card" data-rating="{{ $place->rating }}"
                                    data-name="{{ strtolower($place->name_place) }}"
                                    data-location="{{ strtolower($place->location) }}"
                                    data-description="{{ strtolower($place->description) }}">
                                    <figure class="card-img">
                                        <img src="{{ $place->image ? asset('storage/'.$place->image) : asset('assets/img/landing-page/ijen-photo.jpeg') }}"
                                            alt="{{ $place->name_place }}" loading="lazy">
                                    </figure>

                                    <div class="card-content">
                                        <div class="card-rating">
                                            <span class="rating-text">{{ $place->rating }}/5</span>
                                            <ion-icon name="star"></ion-icon>
                                        </div>
                                        <p class="card-subtitle">{{ $place->location }}</p>
                                        <h3 class="h3 card-title">{{ $place->name_place }}</h3>
                                        <p class="card-text">
                                            {{ Str::limit($place->description, 100) }}
                                        </p>
                                        <a href="{{ route('customer.place-detail', $place->id) }}">
                                            <button type="button" class="btn-book-now">Lihat Detail</button>
                                        </a>
                                    </div>
                                </div>
                                @empty
                                <p class="section-text">No places available for your filters.</p>
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
            const ratingSort = document.getElementById("rating-sort");
            const searchBtn = document.getElementById("search-btn");
            const resetBtn = document.getElementById("reset-filters-btn");

            function applyFilters() {
                const activeCategory = document.querySelector(".filter-btn.active")?.dataset.sort || "all";
                const selectedRatings = Array.from(document.querySelectorAll(".filter-rating:checked")).map(el => parseInt(el.value));
                const searchTerm = document.getElementById("search-input")?.value.toLowerCase();

                cards.forEach(card => {
                    const rating = parseFloat(card.dataset.rating);
                    const name = card.dataset.name;
                    const location = card.dataset.location;
                    const description = card.dataset.description;

                    let visible = true;

                    // Filter kategori
                    if (activeCategory !== "all") {
                        const minRating = parseInt(activeCategory);
                        if (rating < minRating) visible = false;
                    }

                    // Filter rating
                    if (selectedRatings.length) {
                        const matchRating = selectedRatings.some(minRating => rating >= minRating);
                        if (!matchRating) visible = false;
                    }

                    // Filter search
                    if (searchTerm) {
                        const matchSearch = name.includes(searchTerm) ||
                                          location.includes(searchTerm) ||
                                          description.includes(searchTerm);
                        if (!matchSearch) visible = false;
                    }

                    card.style.display = visible ? "block" : "none";
                });

                // Sort rating
                if (ratingSort.value) {
                    const sortedCards = Array.from(cards).sort((a, b) => {
                        const ratingA = parseFloat(a.dataset.rating);
                        const ratingB = parseFloat(b.dataset.rating);
                        return ratingSort.value === "high" ? ratingB - ratingA : ratingA - ratingB;
                    });
                    const container = document.getElementById("place-list");
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

            document.querySelectorAll(".filter-rating").forEach(el => el.addEventListener("change", applyFilters));
            ratingSort.addEventListener("change", applyFilters);
            searchBtn?.addEventListener("click", applyFilters);

            // Search on Enter key
            document.getElementById("search-input")?.addEventListener("keypress", function(e) {
                if (e.key === "Enter") {
                    applyFilters();
                }
            });

            // Reset All Filters
            resetBtn?.addEventListener("click", () => {
                // Reset kategori ke 'all'
                filterBtns.forEach(btn => btn.classList.remove("active"));
                const defaultBtn = document.querySelector(".filter-btn[data-sort='all']");
                if (defaultBtn) defaultBtn.classList.add("active");

                // Reset checkboxes
                document.querySelectorAll(".filter-rating").forEach(el => el.checked = false);

                // Reset search
                const searchInput = document.getElementById("search-input");
                if (searchInput) searchInput.value = "";

                // Reset sort rating
                if (ratingSort) ratingSort.value = "";

                applyFilters();
            });

            applyFilters(); // apply default on load
        });

        function showPlaceDetail(placeId) {
            // You can implement a modal or redirect to detail page
            alert('Place detail for ID: ' + placeId + ' - This can be implemented as a modal or detail page');
        }
    </script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>
        .place-page {
            display: flex;
            gap: 20px;
        }

        .sidebar {
            width: 250px;
            /* desktop */
        }

        .place-list-wrapper {
            flex: 1;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .popular-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            background: white;
        }

        .card-img img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-content {
            padding: 10px;
        }

        .card-content .btn-book-now {
            background-color: var(--primary);
            color: #fff;
            border: none;
            padding: 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .card-content .btn-book-now:hover {
            background-color: var(--secondary);
        }

        @media (max-width: 768px) {
            .place-page {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }

        }
    </style>

</body>

</html>
