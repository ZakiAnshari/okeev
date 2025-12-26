@extends('layout.mobile.app')
@section('title', 'Home')
@section('content')
    <!-- Navbar -->
    <br>
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
            <a href="" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('front_end/assets/images/logo/1.jpg') }}" alt="Electric Car">
                </div>
                <span class="category-text">Electric<br>Car</span>
            </a>

            <a href="vehicle.html" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('front_end/assets/images/logo/2.jpg') }}" alt="Electric Motor">
                </div>
                <span class="category-text">Electric<br>Motor</span>
            </a>

            <a href="vehicle.html" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('front_end/assets/images/logo/3.jpg') }}" alt="Electronic">
                </div>
                <span class="category-text">Electronic</span>
            </a>

            <a href="vehicle.html" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('front_end/assets/images/logo/Accessoris.jpg') }}" alt="Accessories">
                </div>
                <span class="category-text">Accessories</span>
            </a>
        </div>
    </div>
    <style>
        .category-wrapper {
            width: 100%;
            padding: 16px 0;
        }

        .category-section {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 25px;
            padding: 0 25px;
        }

        .category-item {
            width: 80px;
            text-decoration: none;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }

        .category-icon {
            width: 64px;
            height: 64px;
            /* AREA SAMA */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
        }

        .category-icon img {
            width: 200%;
            height: 90%;
            /* DIPAKSA NGISI AREA */
            object-fit: contain;
            /* GAMBAR TETAP PROPORSI */
        }


        .category-text {
            font-size: 12px;
            text-align: center;
            line-height: 1.25;
            white-space: normal;
            /* penting untuk <br> */
        }
    </style>


    <!-- Promo Banner -->
    <div class="container content-container">
        <div class="promo-banner">
            <img src="{{ asset('front_end/assets/images/logo/Mobile.jpg') }}" alt="Electric Vehicle Promo">
        </div>
    </div>

    <!-- Main Text -->
    <div class="container content-container main-text-section">
        <h6 class="heading-hero mb-2">The Future of Driving Starts Here</h6>
        <p>Temukan kendaraan listrik impian Anda dari berbagai merek ternama. Hemat energi, ramah lingkungan, dan siap
            mengubah cara Anda melaju.</p>
    </div>

    <!-- Slider Section -->
    <div class="container content-container">
        <div class="slider-wrapper">
            <div class="slider-section">
                <div class="slider-container">
                    <div class="slider-card">
                        <img src="{{ asset('front_end/assets/images/logo/background2.jpg') }}" alt="Electric Vehicle 1"
                            class="slider-card-img">
                        <div class="slider-card-overlay">
                            <button class="see-more-btn">See more →</button>
                        </div>
                    </div>
                    <div class="slider-card">
                        <img src="{{ asset('front_end/assets/images/logo/background.jpg') }}" alt="Electric Vehicle 2"
                            class="slider-card-img">
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



    <!-- WHY CHOOSE US -->
    <!-- Why Choose Us -->
    <section class="why-choose">



        <div class="container position-relative">

            <h3 class="why-title ">Why Choose Us ?</h3>

            <div class="why-items">
                <br>
                <!-- ITEM 1 -->
                <div class="feature-card">
                    <div class="feature-header">
                        <img src="{{ asset('front_end/assets/images/logo/mobileicon-Photoroom.png') }}"
                            class="feature-icon" alt="">
                        <h5>Pilihan Merek & Model Lengkap</h5>
                    </div>
                    <hr class="feature-line">
                    <p class="feature-desc">
                        Semua merek mobil listrik favorit Anda tersedia di satu showroom.
                    </p>
                </div>


                <!-- ITEM 2 -->
                <div class="feature-card">
                    <div class="feature-header">
                        <img src="{{ asset('front_end/assets/images/logo/mobileicon2-Photoroom.png') }}"
                            class="feature-icon" alt="">
                        <h5>Test Drive Kendaraan yang di inginkan</h5>
                    </div>

                    <hr class="feature-line">

                    <p class="feature-desc">
                        Rasakan sendiri performa mobil listrik favorit Anda sebelum memutuskan.
                    </p>
                </div>

                <!-- ITEM 3 -->
                <div class="feature-card">
                    <div class="feature-header">
                        <img src="{{ asset('front_end/assets/images/logo/mobileicon3-Photoroom.png') }}"
                            class="feature-icon" alt="">
                        <h5>Komitmen pada Lingkungan</h5>
                    </div>

                    <hr class="feature-line">

                    <p class="feature-desc">
                        Dengan setiap mobil listrik yang terjual, kita bersama selangkah lebih dekat
                        menuju masa depan hijau.
                    </p>
                </div>


            </div>
        </div>
    </section>
    <style>
        .why-choose {
            position: relative;
            padding: 80px 0;
            overflow: hidden;

            background-image: url('front_end/assets/images/logo/Union.jpg');
            background-size: cover;
            background-position: center 70px;
            /* turun 80px */
            background-repeat: no-repeat;
        }

        .feature-card {
            background: transparent;
        }

        /* HEADER: ICON + TITLE */
        .feature-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* TITLE */
        .feature-header h5 {
            font-size: 18px;
            font-weight: 600;
            color: #35F5C6;
            margin: 0;
        }

        /* GARIS TIPIS */
        .feature-line {
            border: none;
            height: 2px;
            background: #ffffff;
            margin: 8px 0px;
        }

        /* DESKRIPSI */
        .feature-desc {
            font-size: 15px;
            color: #ffffff;
            line-height: 1.6;
            margin: 0;
        }

        /* LANDI KIRI ATAS */
        .why-choose::before {
            content: "";
            background: #ffffff;
            border-bottom-right-radius: 280px 130px;
            z-index: 1;
        }

        /* KONTEN DI ATAS BACKGROUND */
        .why-choose .container {
            position: relative;
            z-index: 2;
        }

        /* TITLE */
        .why-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e2f3d;
            margin-bottom: 40px;
        }

        /* ITEMS */
        .why-items {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .why-item {
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }

        .why-icon {
            width: 44px;
            flex-shrink: 0;
        }

        .why-item h5 {
            font-size: 15px;
            color: #35F5C6;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .why-item p {
            font-size: 13px;
            color: #ffffff;
            line-height: 1.6;
        }
    </style>

    <!-- Counting Section -->
    <div class="container content-container counting-section mt-5">
        <div class="row p-3">
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

        <div class="row mt-2">
            <div class="col-12">
                <div class="customer-profiles">
                    <div class="profile-img">
                        <img src="{{ asset('front_end/assets/images/logo/mobile/1.jpg') }}" alt="profile">
                    </div>
                    <div class="profile-img">
                        <img src="{{ asset('front_end/assets/images/logo/mobile/2.jpg') }}" alt="profile">
                    </div>
                    <div class="profile-img">
                        <img src="{{ asset('front_end/assets/images/logo/mobile/3.jpg') }}" alt="profile">
                    </div>
                    <div class="customer-text text-start mx-4">
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

        <div class="collab-tabs mx-3">
            <button class="collab-tab active" onclick="showTab('vehicle')">
                Vehicle
            </button>
            <button class="collab-tab" onclick="showTab('electric')">
                Electric
            </button>
        </div>


        <div id="vehicle-brands" class="brand-grid p-3">
            <div class="brand-item"><img src="{{ asset('front_end/assets/images/logo/8.png') }}" alt="Brand 1"
                    class="brand-logo"></div>
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

        <div id="electric-brands" class="brand-grid p-3">
            <div class="brand-item"><img src="{{ asset('front_end/assets/images/logo/8.png') }}" alt="Brand 3"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="{{ asset('front_end/assets/images/logo/2.png') }}" alt="Brand 3"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="{{ asset('front_end/assets/images/logo/3.png') }}" alt="Brand 3"
                    class="brand-logo"></div>
            <div class="brand-item"><img src="{{ asset('front_end/assets/images/logo/4.png') }}" alt="Brand 3"
                    class="brand-logo"></div>
        </div>
    </div>

    <!-- Most Searched Section -->
    <div class="container content-container most-searched-section ">
        <div class="strip-divider"></div>

        <h3 class="text-center p-3">The Most Searched Vehicle</h3>

        {{-- <div class="search-tabs p-3">
            <button class="search-tab active">In Stock</button>
            <button class="search-tab">Sedan</button>
            <button class="search-tab">SUV</button>
            <button class="search-tab">Motorcycle</button>
        </div> --}}



        <div class="row">
            <!-- Vehicle Card 1 -->
            <div class="col-md-6 mb-3">
                <a href="wuling-air-ev.html" class="vehicle-card">
                    <div class="vehicle-img">
                        <img src="{{ asset('front_end/assets/images/logo/mobile/download (3) 1 (1).png') }}"
                            class="car-img" alt="Wuling Air EV">
                    </div>

                    <div class="vehicle-info">
                        <h6 class="mb-1">Wuling</h6>
                        <p class="text-semibold">New Air Ev Lite Long Range</p>

                        <div class="vehicle-specs p-4">
                            <!-- Miles -->
                            <div class="spec-item">
                                <div class="spec-icon mb-1">
                                    <img src="{{ asset('front_end/assets/images/logo/mobile/ion_speedometer.jpg') }}"
                                        alt="Speedometer Icon" class="spec-icon-img">
                                </div>
                                <div class="spec-value">20 Miles</div>
                            </div>

                            <div class="spec-item">
                                <div class="spec-icon mb-1">
                                    <img src="{{ asset('front_end/assets/images/logo/mobile/material-symbols-light_electric-bolt-rounded.jpg') }}"
                                        alt="Speedometer Icon" class="spec-icon-img">
                                </div>
                                <div class="spec-value">Electric</div>
                            </div>

                            <div class="spec-item">
                                <div class="spec-icon mb-1">
                                    <img src="{{ asset('front_end/assets/images/logo/mobile/Group.jpg') }}"
                                        alt="Speedometer Icon" class="spec-icon-img">
                                </div>
                                <div class="spec-value">6 Seat</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="vehicle-price">IDR 194.000.000</span>

                            <div class="d-flex align-items-center details-link">
                                <p class="m-0 me-1 mx-1">Details</p>
                                <img src="{{ asset('front_end/assets/images/logo/mobile/majesticons_arrow-up-line.jpg') }}"
                                    alt="Details Icon" class="details-icon">
                            </div>
                        </div>

                    </div>
                </a>
            </div>

            <style>
                .spec-icon {
                    width: 32px;
                    height: 32px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .spec-icon-img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                    /* icon tidak terpotong */
                }
            </style>

        </div>
    </div>

    </div>

@endsection
