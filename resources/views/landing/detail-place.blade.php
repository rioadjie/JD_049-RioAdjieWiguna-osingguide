<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OsingGuide - Detail Place</title>

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
        /* === PLACE PHOTO === */
        .place-photo {
            width: 100%;
            max-width: 100%;
            height: 500px;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .place-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* === PLACE HEADER === */
        .place-header {
            margin-bottom: 1.5rem;
        }

        .place-name-rating {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .place-name {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            color: #222;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-weight: 600;
            color: #444;
            font-size: 1.2rem;
        }

        .star-icon {
            color: #f5c518;
            font-size: 1.5rem;
        }

        .place-location {
            font-size: 1.3rem;
            color: #666;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .location-icon {
            color: var(--primary);
            font-size: 1.3rem;
        }

        /* === PLACE DESCRIPTION === */
        .place-description {
            line-height: 1.8;
            color: #555;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        /* === SECTION UMUM === */
        .detail-section {
            margin-bottom: 2rem;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-top: .5rem;
        }

        .tags .tag {
            background: #f0f0f0;
            padding: .4rem .8rem;
            border-radius: 12px;
            font-size: .9rem;
        }

        .h4, .h5 {
            font-weight: var(--fw-800);
            font-family: var(--ff-montserrat);
            text-transform: uppercase;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .place-photo {
                height: 300px;
            }

            .place-name-rating {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .place-name {
                font-size: 2rem;
            }

            .place-location {
                font-size: 1.1rem;
            }

            .place-description {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body id="top">

    <!-- HEADER -->
    <header class="header" data-header>

        <div class="overlay" data-overlay></div>

        <div class="header-top">
            <div class="container">

                <a href="#" class="helpline-box">
                </a>

                <a href="/" class="logo">
                    <img src="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}" alt="OsingGuide logo">
                </a>

            </div>
        </div>

    </header>

    <main>
        <article>
            <section class="place-detail">
                <div class="container" style="margin-top: 80px">
                    <h2 class="h2 section-title">Detail Place</h2>
                    <p class="section-text">Discover more about this amazing tourist destination.</p>

                    <!-- Foto Place Full Width -->
                    <div class="place-photo">
                        <img src="{{ $place->image ? asset('storage/' . $place->image) : asset('assets/img/landing-page/ijen-photo.jpeg') }}"
                            alt="{{ $place->name_place }}">
                    </div>

                    <!-- Nama Tempat - Rating -->
                    <div class="place-header">
                        <div class="place-name-rating">
                            <h2 class="place-name">{{ $place->name_place }}</h2>
                            <div class="rating">
                                <ion-icon name="star" class="star-icon"></ion-icon>
                                <span>{{ number_format($place->rating, 1) }}/5</span>
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <p class="place-location">
                            <ion-icon name="location-outline" class="location-icon"></ion-icon>
                            {{ $place->location }}
                        </p>
                    </div>

                    <!-- Deskripsi Tempat -->
                    <div class="place-description">
                        <h4 class="h4">Description</h4>
                        {{ $place->description }}
                    </div>

                    <!-- Fasilitas -->
                    @if($place->facilities)
                    <div class="detail-section">
                        <h4 class="h4">Facilities</h4>
                        <ul class="tags">
                            @foreach (explode(',', $place->facilities) as $facility)
                                <li class="tag">{{ trim($facility) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Tips -->
                    @if($place->tips)
                    <div class="detail-section">
                        <h4 class="h4">Travel Tips</h4>
                        <p class="place-description">
                            {{ $place->tips }}
                        </p>
                    </div>
                    @endif

                </div>
            </section>

            <!-- CTA -->
            <section class="cta" id="contact">
                <div class="container">
                    <div class="cta-content">
                        <p class="section-subtitle">Need Help?</p>
                        <h2 class="h2 section-title">Confused about where to go in Banyuwangi?</h2>
                        <p class="section-text">Don't worry, we offer free consultations!</p>
                    </div>
                    <a
                        href="https://wa.me/6287864310772?text=Hallo%2C%20saya%20ingin%20konsultasi%20perjalanan%20wisata">
                        <button class="btn btn-secondary">Get Free Consultation Now!</button>
                    </a>
                </div>
            </section>
        </article>
    </main>

    <!-- FOOTER -->
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
                        <input type="email" name="email" class="input-field" placeholder="Enter Your Email"
                            required>

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

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up-outline"></ion-icon>
    </a>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
