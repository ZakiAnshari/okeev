@extends('layout.mobile.app')
@section('title', 'Home')
@section('content')
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="container">
            <!-- Top Row: Logo dan Notifikasi -->
            <div class="navbar-top">
                <div class="logo-icon">
                    <img src="{{ asset('front_end/assets/images/logo/logo.png') }}" alt="OKEEV Logo">
                </div>
                <button class="icon-btn" style="background: none">
                    <a href="notification.html">
                        <img src="{{ asset('front_end/assets/images/logo/bel.jpg') }}" alt="Belt" class="icon-img">
                    </a>
                </button>
            </div>

            <!-- Bottom Row: Search Bar dan Cart -->
            <div class="navbar-bottom">

                <div class="search-wrapper">
                    <i class="bi bi-search search-icon"></i>

                    <input type="text" class="search-bar" placeholder="Search Vehicle / Electronic">
                </div>

                <a href="#" class="icon-btn">
                    <img src="{{ asset('front_end/assets/images/logo/cart.jpg') }}" alt="Cart" class="icon-img">
                </a>

            </div>




        </div>
    </nav>

    <div class="category-wrapper">
        <div class="category-section">
            <a href="vehicle.html" class="category-item">
                <div class="category-btn">
                    <div class="category-icon">
                        <img src="{{ asset('front_end/assets/images/logo/Cars.jpg') }}" class="category-icon-img">
                    </div>
                    <span class="category-text">Electric Car</span>
                </div>
            </a>

            <a href="vehicle.html" class="category-item">
                <div class="category-btn">
                    <div class="category-icon">
                        <img src="{{ asset('front_end/assets/images/logo/Motor.jpg') }}" class="category-icon-img">
                    </div>
                    <span class="category-text">Electric Motor</span>
                </div>
            </a>

            <a href="vehicle.html" class="category-item">
                <div class="category-btn">
                    <div class="category-icon">
                        <img src="{{ asset('front_end/assets/images/logo/Electric.jpg') }}" class="category-icon-img">
                    </div>
                    <span class="category-text">Electronic</span>
                </div>
            </a>

            <a href="vehicle.html" class="category-item">
                <div class="category-btn">
                    <div class="category-icon">
                        <img src="{{ asset('front_end/assets/images/logo/Electric.jpg') }}" class="category-icon-img">
                    </div>
                    <span class="category-text">Accessories</span>
                </div>
            </a>
        </div>
    </div>

    <style>
        .category-wrapper {
            padding: 0 16px;
            /* jarak aman dari pinggir layar */
        }

        .category-section {
            display: flex;
            justify-content: center;
            /* bukan space-between */
            gap: 13px;
            /* jarak antar item */
            max-width: 420px;
            /* BATAS lebar biar ga meleber */
            margin: 0 auto;
            /* TENGAH layar */
        }

        .category-item {
            flex: 1;
            text-decoration: none;
            color: inherit;
        }

        .category-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .category-icon-img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .category-text {
            margin-top: 6px;
            font-size: 13px;
        }
    </style>

    <!-- Promo Banner -->
    <div class="container content-container">
        <div class="promo-banner">
            <img src="assets/banner/promo-car.png" alt="Electric Vehicle Promo">
        </div>
    </div>

    <!-- Main Text -->
    <div class="container content-container main-text-section">
        <h2>The Future of Driving Starts Here</h2>
        <p>Find your dream electric vehicle from a variety of leading brands. Energy-efficient, environmentally friendly,
            and ready to transform the way you travel.</p>
    </div>

    <!-- Slider Section -->
    <div class="container content-container">
        <div class="slider-wrapper">
            <div class="slider-section">
                <div class="slider-container">
                    <div class="slider-card">
                        <img src="assets/slider/slider1.jpg" alt="Electric Vehicle 1" class="slider-card-img">
                        <div class="slider-card-overlay">
                            <button class="see-more-btn">See more →</button>
                        </div>
                    </div>
                    <div class="slider-card">
                        <img src="assets/slider/slider2.jpg" alt="Electric Vehicle 2" class="slider-card-img">
                        <div class="slider-card-overlay">
                            <button class="see-more-btn">See more →</button>
                        </div>
                    </div>
                    <div class="slider-card-short">
                        <img src="assets/slider/slider3.jpg" alt="Electric Vehicle 3" class="slider-card-img">
                        <div class="slider-card-overlay">
                            <button class="see-more-btn">See more →</button>
                        </div>
                    </div>
                    <div class="slider-card">
                        <img src="assets/slider/slider4.jpg" alt="Electric Vehicle 4" class="slider-card-img">
                        <div class="slider-card-overlay">
                            <button class="see-more-btn">See more →</button>
                        </div>
                    </div>
                    <div class="slider-card-short">
                        <img src="assets/slider/slider5.jpg" alt="Electric Vehicle 5" class="slider-card-img">
                        <div class="slider-card-overlay">
                            <button class="see-more-btn">See more →</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="why-choose-section" style="position: relative; padding: 80px 0; overflow:hidden; background: white;">

        <!-- SVG sebagai background full kiri–kanan -->
        <svg viewBox="0 0 440 650" xmlns="http://www.w3.org/2000/svg"
            style="
                position:absolute;
                top:0;
                left:0;
                width:100%;
                height:100%;
                object-fit:cover;
                z-index:1;
            ">
            <path
                d="M476 630C476 641.046 467.046 650 456 650H-10C-21.0457 650 -30 641.046 -30 630V70C-30 58.9543 -21.0457 50 -10 50H190.179C197.27 50 203.831 46.2451 207.423 40.131L225.202 9.86901C228.794 3.75491 235.355 0 242.446 0H456C467.046 0 476 8.95431 476 20V630Z"
                fill="#30445C" />
        </svg>





        <!-- Konten di atas SVG -->
        <div class="container content-container" style="position: relative; z-index:2; margin-bottom: 10px;">

            <h3
                style="
                color: var(--dark-bg);
                font-weight:700;
                margin-bottom:130px;
                font-size:20px;
                text-align:left;
                padding-left:5px;

            ">
                Why choose us?
            </h3>

            <div class="features-container" style="display:flex; flex-direction:column; gap:35px; padding-bottom:60px;">

                <div class="feature-item" style="display:flex; gap:20px; margin-bottom:30px;">
                    <div class="feature-icon">
                        <img src="assets/icon/icon1.png" width="55" alt="Lightning Icon">
                    </div>
                    <div class="feature-content">
                        <div class="feature-title" style="color:#35F5C6; font-weight:600;">
                            Pilihan Merek & Model Lengkap
                        </div>
                        <p style="color:#fff;">Semua merek mobil listrik favorit Anda tersedia di satu showroom.</p>
                    </div>
                </div>

                <div class="feature-item" style="display:flex; gap:20px; margin-bottom:30px;">
                    <div class="feature-icon">
                        <img src="assets/icon/icon2.png" width="55" alt="Steering Icon">
                    </div>
                    <div class="feature-content">
                        <div class="feature-title" style="color:#35F5C6; font-weight:600;">
                            Test Drive Kendaraan yang di Inginkan
                        </div>
                        <p style="color:#fff;">Rasakan sendiri performa mobil listrik favorit Anda sebelum memutuskan.</p>
                    </div>
                </div>

                <div class="feature-item" style="display:flex; gap:20px;">
                    <div class="feature-icon">
                        <img src="assets/icon/icon3.png" width="55" alt="Leaf Icon">
                    </div>
                    <div class="feature-content">
                        <div class="feature-title" style="color:#35F5C6; font-weight:600;">
                            Komitmen pada Lingkungan
                        </div>
                        <p style="color:#fff;">Dengan setiap mobil listrik yang terjual, kita bersama selangkah lebih dekat
                            menuju masa depan hijau.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>



    <!-- Counting Section -->
    <div class="container content-container counting-section">
        <div class="row">
            <div class="col-4">
                <div class="count-item">
                    <h3>28</h3>
                    <p>Collaboration<br>with brands</p>
                </div>
            </div>
            <div class="col-4">
                <div class="count-item">
                    <h3>500+</h3>
                    <p>Customer</p>
                </div>
            </div>
            <div class="col-4">
                <div class="count-item">
                    <h3>497</h3>
                    <p>Customer<br>Happy</p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="customer-profiles">
                    <div class="profile-img">
                        <img src="assets/customer/customer.png" alt="profile">
                    </div>
                    <div class="profile-img">
                        <img src="assets/customer/customer.png" alt="profile">
                    </div>
                    <div class="profile-img">
                        <img src="assets/customer/customer.png" alt="profile">
                    </div>
                    <div class="customer-text">
                        <h4>Million of happy customers</h4>
                        <p>Lorem ipsum dolor sit amet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collaboration Section -->
    <div class="container content-container collab-section">
        <h3>Our collaboration with brands</h3>

        <div class="collab-tabs">
            <button class="collab-tab active" onclick="showTab('vehicle')">Vehicle</button>
            <button class="collab-tab" onclick="showTab('electric')">Electric</button>
        </div>

        <div id="vehicle-brands" class="brand-grid">
            <div class="brand-item"><img src="assets/brand/vehicle/BMW.png" alt="Brand 1" class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/vehicle/BYD.png" alt="Brand 2" class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/vehicle/Chery.png" alt="Brand 3" class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/vehicle/DENZA.png" alt="Brand 4" class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/vehicle/Maka.png" alt="Brand 5" class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/vehicle/Mercedes.png" alt="Brand 6" class="brand-logo">
            </div>
            <div class="brand-item"><img src="assets/brand/vehicle/Polytron.png" alt="Brand 7" class="brand-logo">
            </div>
            <div class="brand-item"><img src="assets/brand/vehicle/U-Winfly.png" alt="Brand 8" class="brand-logo">
            </div>
            <div class="brand-item"><img src="assets/brand/vehicle/VinFast.png" alt="Brand 9" class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/vehicle/Volta.png" alt="Brand 8" class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/vehicle/Wuling.png" alt="Brand 9" class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/vehicle/Yadea.png" alt="Brand 9" class="brand-logo"></div>
        </div>

        <div id="electric-brands" class="brand-grid" style="display: none;">
            <div class="brand-item"><img src="assets/brand/electronic/Xiaomi.png" alt="Electric Brand 1"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/iPhone.png" alt="Electric Brand 2"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Samsung.png" alt="Electric Brand 3"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Asus.png" alt="Electric Brand 4"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Acer.png" alt="Electric Brand 5"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Lenovo.png" alt="Electric Brand 6"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Poco.png" alt="Electric Brand 6"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Tecno.png" alt="Electric Brand 6"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Vivo.png" alt="Electric Brand 6"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Oppo.png" alt="Electric Brand 6"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Advan.png" alt="Electric Brand 6"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="assets/brand/electronic/Infinix.png" alt="Electric Brand 6"
                    class="brand-logo"></div>
        </div>
    </div>

    <!-- Most Searched Section -->
    <div class="container content-container most-searched-section">
        <div class="strip-divider"></div>

        <h3 class="text-center my-4">The Most Searched Vehicle</h3>

        <div class="search-tabs">
            <button class="search-tab active">In Stock</button>
            <button class="search-tab">Sedan</button>
            <button class="search-tab">SUV</button>
            <button class="search-tab">Motorcycle</button>
        </div>

        <div class="row">
            <!-- Vehicle Card 1 -->
            <div class="col-md-6 mb-3">
                <a href="wuling-air-ev.html" class="vehicle-card">
                    <div class="vehicle-img">
                        <img src="assets/product/vehicles/wuling/air-ev/Views.png" class="car-img" alt="Wuling Air EV">
                    </div>

                    <div class="vehicle-info">
                        <h6>Wuling</h6>
                        <p>New Air Ev Lite Long Range</p>

                        <div class="vehicle-specs">
                            <!-- Speed -->
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <!-- Speedometer SVG -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                        <path d="M12 3a9 9 0 1 0 9 9" />
                                        <path d="M12 12l4-2" />
                                    </svg>
                                </div>
                                <div class="spec-label">Speed</div>
                                <div class="spec-value">20 Miles</div>
                            </div>

                            <!-- Power -->
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <!-- Lightning Bolt SVG -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                        <path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z" />
                                    </svg>
                                </div>
                                <div class="spec-label">Power</div>
                                <div class="spec-value">Electric</div>
                            </div>

                            <!-- Seat -->
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <!-- User SVG -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                        <circle cx="12" cy="7" r="4" />
                                        <path d="M6 21c0-4 3-7 6-7s6 3 6 7" />
                                    </svg>
                                </div>
                                <div class="spec-label">Seat</div>
                                <div class="spec-value">2 Seat</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="vehicle-price">IDR 194.000.000</span>
                            <P>Details →</P>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Vehicle Card 2 -->
            <div class="col-md-6 mb-3">
                <a href="wuling-air-ev.html" class="vehicle-card">
                    <div class="vehicle-img">
                        <img src="assets/product/vehicles/vehicle1.png" class="car-img" alt="Wuling Air EV">
                    </div>

                    <div class="vehicle-info">
                        <h6>Wuling</h6>
                        <p>New Air Ev Lite Long Range</p>

                        <div class="vehicle-specs">
                            <!-- Speed -->
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <!-- Speedometer SVG -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                        <path d="M12 3a9 9 0 1 0 9 9" />
                                        <path d="M12 12l4-2" />
                                    </svg>
                                </div>
                                <div class="spec-label">Speed</div>
                                <div class="spec-value">20 Miles</div>
                            </div>

                            <!-- Power -->
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <!-- Lightning Bolt SVG -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                        <path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z" />
                                    </svg>
                                </div>
                                <div class="spec-label">Power</div>
                                <div class="spec-value">Electric</div>
                            </div>

                            <!-- Seat -->
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <!-- User SVG -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                        <circle cx="12" cy="7" r="4" />
                                        <path d="M6 21c0-4 3-7 6-7s6 3 6 7" />
                                    </svg>
                                </div>
                                <div class="spec-label">Seat</div>
                                <div class="spec-value">2 Seat</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="vehicle-price">IDR 194.000.000</span>
                            <P>Details →</P>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Vehicle Card 3 -->
            <div class="col-md-6 mb-3">
                <a href="wuling-air-ev.html" class="vehicle-card">
                    <div class="vehicle-img">
                        <img src="assets/product/vehicles/vehicle1.png" class="car-img" alt="Wuling Air EV">
                    </div>

                    <div class="vehicle-info">
                        <h6>Wuling</h6>
                        <p>New Air Ev Lite Long Range</p>

                        <div class="vehicle-specs">
                            <!-- Speed -->
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <!-- Speedometer SVG -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                        <path d="M12 3a9 9 0 1 0 9 9" />
                                        <path d="M12 12l4-2" />
                                    </svg>
                                </div>
                                <div class="spec-label">Speed</div>
                                <div class="spec-value">20 Miles</div>
                            </div>

                            <!-- Power -->
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <!-- Lightning Bolt SVG -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                        <path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z" />
                                    </svg>
                                </div>
                                <div class="spec-label">Power</div>
                                <div class="spec-value">Electric</div>
                            </div>

                            <!-- Seat -->
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <!-- User SVG -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                        <circle cx="12" cy="7" r="4" />
                                        <path d="M6 21c0-4 3-7 6-7s6 3 6 7" />
                                    </svg>
                                </div>
                                <div class="spec-label">Seat</div>
                                <div class="spec-value">2 Seat</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="vehicle-price">IDR 194.000.000</span>
                            <P>Details →</P>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>

    <!-- Hotbar -->
    <div class="bottom-nav">
        <div class="bottom-nav-container">
            <a href="transaction.html" class="nav-item">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                </svg>
                <span class="nav-label">Transaction</span>
            </a>
            <a href="index.html" class="nav-item active">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
                <span class="nav-label">Home</span>
            </a>
            <a href="news.html" class="nav-item">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                </svg>
                <span class="nav-label">News</span>
            </a>
            <a href="profile.html" class="nav-item">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                </svg>
                <span class="nav-label">Profile</span>
            </a>
        </div>
    </div>
@endsection
