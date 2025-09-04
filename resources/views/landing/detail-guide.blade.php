<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OsingGuide - Detail Guide</title>

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
        /* === DETAIL WRAPPER === */
        .detail-wrapper {
            display: flex;
            gap: 2rem;
            align-items: stretch;
            /* 🔥 tinggi anak otomatis sama */
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        /* === FOTO GUIDE === */
        .guide-photo {
            flex: 1 1 300px;
            max-width: 400px;
            aspect-ratio: 1 / 1;
            /* bisa diganti 1 / 1 kalau mau kotak */
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
        .guide-info {
            flex: 2 1 300px;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            padding: 0.8rem 1rem;
            min-height: 100%;
            /* 🔥 selalu ikut tinggi parent */
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

        /* === RATING & PRICE === */
        .rating {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-weight: 600;
            color: #444;
        }

        .star-icon {
            color: #f5c518;
            font-size: 1.2rem;
        }

        .guide-price {
            font-size: 1.5rem;
            font-weight: 600;
            color: #222;
        }

        .guide-price span {
            font-size: .9rem;
            color: #777;
        }

        /* === BUTTON === */
        .book-btn {
            display: inline-block;
            background: #2a7f46;
            color: #fff;
            text-align: center;
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s ease;
            margin-top: auto;
            /* 🔥 dorong ke bawah biar rapih */
        }

        .book-btn:hover {
            background: #256d3d;
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

        .availability-list {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .avail-date {
            background: #e8f7ef;
            color: #2a7f46;
            padding: .4rem .8rem;
            border-radius: 8px;
            font-size: .9rem;
        }

        .h4, .h5 {
            font-weight: var(--fw-800);
            font-family: var(--ff-montserrat);
            text-transform: uppercase;
        }

        /* === REVIEWS SECTION === */
        .reviews-summary {
            margin-bottom: 1.5rem;
        }

        .rating-display {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .rating-number {
            color: #f5c518;
            font-size: 1.3rem;
        }

        .rating-text {
            color: #666;
        }

        .total-reviews {
            color: #888;
            font-size: 0.9rem;
            font-weight: 400;
        }

        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .review-item {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1rem;
            border-left: 4px solid #2a7f46;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.8rem;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .reviewer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: white;
        }

        .reviewer-details {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .reviewer-name {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            color: #333;
        }

        .review-rating {
            display: flex;
            gap: 0.2rem;
        }

        .review-rating .star-icon {
            font-size: 0.9rem;
        }

        .review-rating .star-icon.filled {
            color: #f5c518;
        }

        .review-rating .star-icon.empty {
            color: #ddd;
        }

        .review-date {
            font-size: 0.8rem;
            color: #888;
            font-weight: 400;
        }

        .review-comment {
            margin-top: 0.5rem;
        }

        .review-comment p {
            margin: 0;
            color: #555;
            font-style: italic;
            line-height: 1.5;
        }

        .no-reviews {
            text-align: center;
            padding: 2rem;
            color: #888;
            background: #f8f9fa;
            border-radius: 12px;
            border: 2px dashed #ddd;
        }

        .view-all-reviews {
            text-align: center;
            margin-top: 1.5rem;
        }

        .view-all-reviews .btn {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .detail-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }

            .guide-photo,
            .guide-info {
                max-width: 100%;
                width: 100%;
                min-height: auto;
            }

            .guide-info {
                padding: 1rem;
                /* 🔥 kasih ruang biar isi nggak nempel ke pinggir */
                box-sizing: border-box;
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
            <section class="guide-detail">
                <div class="container">
                    <h2 class="h2 section-title">Detail Guide</h2>
                    <p class="section-text">Discover more about this professional guide and their expertise.</p>

                    <!-- Wrapper Flex -->
                    <div class="detail-wrapper">

                        <!-- Foto Profil Guide -->
                        <div class="guide-photo">
                            <img src="{{ $guide->guideProfile->photo ? asset('storage/' . $guide->guideProfile->photo) : asset('assets/img/team-1.jpg') }}"
                                alt="{{ $guide->name }}">
                        </div>

                        <!-- Informasi Utama -->
                        <div class="guide-info">

                            <!-- Nama & Level -->
                            <div class="guide-header">
                                <h2 class="guide-name">{{ $guide->name }}</h2>
                                <p class="guide-level">{{ ucfirst($guide->guideProfile->level) }} Guide</p>
                            </div>

                            <!-- Rating -->
                            <div class="rating">
                                <ion-icon name="star" class="star-icon"></ion-icon>
                                <span class="rating-number">{{ number_format($avgRating, 1) }}</span>
                                <span class="rating-text">/ 5</span>
                                <span class="total-reviews">({{ $totalReviews }} reviews)</span>
                            </div>

                            <!-- Harga -->
                            <div class="guide-price">
                                @php
                                $dailyRate = $guide->guideProfile->daily_rate;
                                $platformFeePercentage = \App\Models\Setting::getValue('platform_fee_value') ?? 15;
                                $platformFee = ($dailyRate * $platformFeePercentage) / 100;
                                $totalDailyRate = $dailyRate + $platformFee;
                                @endphp
                                Rp. {{ number_format($totalDailyRate, 0, ',', '.') }} <span>/day</span>
                            </div>

                            <!-- Tombol -->
                            <a href="{{ route('customer.booking.create', $guide->id) }}" class="book-btn">
                                Book Now
                            </a>
                        </div>
                    </div>


                    <!-- Deskripsi -->
                    <div class="detail-section">
                        <h4 class="h4">About {{ $guide->name }}</h4>
                        <p class="tags">
                            {{ $guide->guideProfile->bio ?? 'No description available.' }}
                        </p>
                    </div>

                    <!-- Bahasa -->
                    <div class="detail-section">
                        <h4 class="h4">Languages</h4>
                        <ul class="tags">
                            @foreach ($guide->guideProfile->languages as $lang)
                                <li class="tag">{{ $lang }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Skills -->
                    <div class="detail-section">
                        <h4 class="h4">Skills</h4>
                        <ul class="tags">
                            @foreach ($guide->guideProfile->skills as $skill)
                                <li class="tag">{{ $skill }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Availability -->
                    <div class="detail-section">
                        <h4 class="h4">Availability</h4>
                        <div class="availability-list">
                            @php
                                // Filter availability dates that don't have active bookings
                                $availableDates = $guide->availabilities->where("status","available")->filter(function($avail) use ($guide) {
                                    // Check if there's any active booking on this date
                                    $hasActiveBooking = $guide->bookingsAsGuide->where('status', '!=', 'cancelled')
                                        ->where(function($booking) use ($avail) {
                                            $bookingStart = $booking->start_time->format('Y-m-d');
                                            $bookingEnd = $booking->end_time->format('Y-m-d');
                                            $availDate = $avail->date->format('Y-m-d');

                                            // Check if the availability date falls within any active booking period
                                            return ($availDate >= $bookingStart && $availDate <= $bookingEnd);
                                        })->count() > 0;

                                    return !$hasActiveBooking;
                                });
                            @endphp

                            @forelse($availableDates as $avail)
                                <span class="avail-date">{{ $avail->date->format('d M Y') }}</span>
                            @empty
                                <p>No available dates for this guide.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Reviews -->
                    <div class="detail-section">
                        <h4 class="h4">Customer Reviews</h4>
                        <div class="reviews-summary">
                            <div class="rating-display">
                                <ion-icon name="star" class="star-icon"></ion-icon>
                                <span class="rating-number">{{ number_format($avgRating, 1) }}</span>
                                <span class="rating-text">/ 5</span>
                                <span class="total-reviews">({{ $totalReviews }} reviews)</span>
                            </div>
                        </div>

                        <div class="reviews-list">
                            @forelse($guide->reviewsReceived->take(5) as $review)
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <div class="reviewer-avatar">
                                                {{ strtoupper(substr($review->customer->name, 0, 1) . substr(strrchr($review->customer->name, ' '), 1, 1)) }}
                                            </div>
                                            <div class="reviewer-details">
                                                <h5 class="reviewer-name">{{ $review->customer->name }}</h5>
                                                <div class="review-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <ion-icon name="star" class="star-icon {{ $i <= $review->rating ? 'filled' : 'empty' }}"></ion-icon>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-date">
                                            {{ $review->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    @if($review->comment)
                                        <div class="review-comment">
                                            <p>"{{ $review->comment }}"</p>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="no-reviews">
                                    <p>Belum ada ulasan untuk guide ini.</p>
                                </div>
                            @endforelse
                        </div>

                        @if($totalReviews > 5)
                            <div class="view-all-reviews">
                                <a href="#" class="btn btn-outline-primary">Lihat Semua Ulasan ({{ $totalReviews }})</a>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section class="cta" id="contact">
                <div class="container">
                    <div class="cta-content">
                        <p class="section-subtitle">Need Help?</p>
                        <h2 class="h2 section-title">Confused about where to go in Banyuwangi?</h2>
                        <p class="section-text">Don’t worry, we offer free consultations!</p>
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
