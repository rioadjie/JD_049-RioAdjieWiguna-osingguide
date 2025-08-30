<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OsingGuide - Photo Gallery</title>

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

            <!--
            - #GALLERY
            -->

            <section class="gallery" id="gallery">
                <div class="container" style="margin-top: 80px">
                    <p class="section-subtitle">Photo Gallery</p>
                    <h2 class="h2 section-title">Photo's From Travellers</h2>
                    <p class="section-text">
                        These beautiful photos were captured as very beautiful memories while exploring Banyuwangi.
                    </p>

                    <ul class="gallery-list">
                        @forelse($galleries as $gallery)
                        <li class="gallery-item" onclick="openLightbox('{{ $gallery->image ? asset('storage/'.$gallery->image) : asset('assets/img/landing-page/gallery-1.jpg') }}', '{{ $gallery->description }}')">
                            <figure class="gallery-image">
                                <img src="{{ $gallery->image ? asset('storage/'.$gallery->image) : asset('assets/img/landing-page/gallery-1.jpg') }}" alt="Gallery Images">
                            </figure>
                        </li>
                        @empty
                        <!-- Fallback images if no gallery data -->
                        <li class="gallery-item" onclick="openLightbox('{{ asset('assets/img/landing-page/gallery-1.jpg') }}', 'Kawah Ijen')">
                            <figure class="gallery-image">
                                <img src="{{ asset('assets/img/landing-page/gallery-1.jpg') }}" alt="Kawah Ijen">
                            </figure>
                        </li>
                        <li class="gallery-item" onclick="openLightbox('{{ asset('assets/img/landing-page/gallery-2.jpg') }}', 'Pulau Merah')">
                            <figure class="gallery-image">
                                <img src="{{ asset('assets/img/landing-page/gallery-2.jpg') }}" alt="Pulau Merah">
                            </figure>
                        </li>
                        <li class="gallery-item" onclick="openLightbox('{{ asset('assets/img/landing-page/gallery-3.jpg') }}', 'Djawatan')">
                            <figure class="gallery-image">
                                <img src="{{ asset('assets/img/landing-page/gallery-3.jpg') }}" alt="Djawatan">
                            </figure>
                        </li>
                        <li class="gallery-item" onclick="openLightbox('{{ asset('assets/img/landing-page/gallery-4.jpg') }}', 'Banyuwangi Landscape')">
                            <figure class="gallery-image">
                                <img src="{{ asset('assets/img/landing-page/gallery-4.jpg') }}" alt="Banyuwangi Landscape">
                            </figure>
                        </li>
                        <li class="gallery-item" onclick="openLightbox('{{ asset('assets/img/landing-page/gallery-5.jpg') }}', 'Beach View')">
                            <figure class="gallery-image">
                                <img src="{{ asset('assets/img/landing-page/gallery-5.jpg') }}" alt="Beach View">
                            </figure>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </section>

            <!-- Lightbox Modal -->
            <div id="lightbox" class="lightbox">
                <span class="close-lightbox">&times;</span>
                <img class="lightbox-content" id="lightbox-img">
                <div class="lightbox-caption" id="lightbox-caption"></div>
            </div>

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

    <script>
        // Lightbox functionality
        function openLightbox(imageSrc, caption) {
            const lightbox = document.getElementById("lightbox");
            const lightboxImg = document.getElementById("lightbox-img");
            const lightboxCaption = document.getElementById("lightbox-caption");

            lightboxImg.src = imageSrc;
            lightboxCaption.textContent = caption;
            lightbox.style.display = "block";
        }

        // Close lightbox
        document.querySelector(".close-lightbox").addEventListener("click", function() {
            document.getElementById("lightbox").style.display = "none";
        });

        // Close lightbox when clicking outside
        document.getElementById("lightbox").addEventListener("click", function(e) {
            if (e.target === this) {
                this.style.display = "none";
            }
        });

        // Close lightbox with Escape key
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                document.getElementById("lightbox").style.display = "none";
            }
        });
    </script>

        <style>
        /* Lightbox styles */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .lightbox-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 800px;
            max-height: 80%;
            object-fit: contain;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .lightbox-caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 800px;
            text-align: center;
            color: white;
            padding: 10px 0;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .close-lightbox {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-lightbox:hover,
        .close-lightbox:focus {
            color: #bbb;
            text-decoration: none;
        }

        /* Add cursor pointer to gallery items for lightbox */
        .gallery-item {
            cursor: pointer;
        }
    </style>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
