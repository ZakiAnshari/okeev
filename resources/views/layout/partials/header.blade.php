<header class="header navbar-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">
                    <!-- Start Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <a href="/" class="d-inline-block">
                            <img src="{{ asset('front_end/assets/images/logo/logo.png') }}" alt="Logo"
                                class="img-fluid logo-header">
                        </a>
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">

                                <li class="nav-item dropdown position-static">
                                    <a class="dd-menu collapsed" href="#" id="megaVehicle" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Vehicle
                                    </a>
                                    <div class="dropdown-menu w-100 p-4" aria-labelledby="megaVehicle">

                                        <div class="row position-relative vehicle-divider">
                                            @forelse ($categoriesPosition1 as $category)
                                                <div class="col-lg-6 col-md-6 mb-4 p-5">
                                                    <!-- Header kategori -->
                                                    <h6 class="fw-bold mb-3">{{ $category->name_category }}</h6>
                                                    <!-- Grid brands per kategori -->
                                                    <div class="row">
                                                        @foreach ($category->brands->chunk(4) as $chunk)
                                                            <div class="col-6 col-md-4">
                                                                <ul class="list-unstyled">
                                                                    @foreach ($chunk as $brand)
                                                                        <li>
                                                                            <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                                class="dropdown-item brand-item">
                                                                                {{ $brand->name_brand }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-0">Kategori Vehicle belum tersedia.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <style>
                                            .brand-item {
                                                font-weight: normal !important;
                                            }

                                            .vehicle-divider {
                                                position: relative;
                                            }

                                            .vehicle-divider::before {
                                                content: "";
                                                position: absolute;
                                                top: 0;
                                                bottom: 0;
                                                /* Garis tetap di tengah, tapi diberi margin kiri & kanan */
                                                left: calc(50% - 1px);
                                                /* posisi tengah */
                                                width: 3px;
                                                background-color: #dcdcdc;
                                                /* Margin kiri–kanan garis */
                                                margin-left: -20px;
                                                margin-right: -20px;
                                            }

                                            .dropdown-menu {
                                                background-color: rgba(255, 255, 255, 0.85) !important;
                                                backdrop-filter: blur(4px);
                                                /* opsional biar lebih halus */
                                            }
                                        </style>


                                    </div>
                                </li>

                                <li class="nav-item dropdown position-static">
                                    <a class="dd-menu collapsed" href="#" id="megaElectric" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Electric
                                    </a>

                                    <div class="dropdown-menu w-100 p-4" aria-labelledby="megaElectric">

                                        <div class="row electric-divider">
                                            @forelse ($categoriesPosition2 as $category)
                                                <div class="col-lg-3 col-md-6 mb-4 p-5">
                                                    <h6 class="fw-bold mb-3">{{ $category->name_category }}</h6>
                                                    <div class="row">
                                                        @foreach ($category->brands->chunk(4) as $chunk)
                                                            @foreach ($chunk as $brand)
                                                                <div class="col-6 col-md-6">
                                                                    <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                        class="dropdown-item brand-item">
                                                                        {{ $brand->name_brand }}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-0">
                                                        Electric belum tersedia.</p>
                                                </div>
                                            @endforelse

                                        </div>
                                        <style>
                                            /* Hilangkan bold brand */
                                            .brand-item {
                                                font-weight: normal !important;
                                            }

                                            /* Garis pemisah setiap kategori */
                                            .electric-divider>div {
                                                border-right: 2px solid #dcdcdc;
                                            }

                                            /* Hilangkan garis di kolom terakhir */
                                            .electric-divider>div:last-child {
                                                border-right: none;
                                            }
                                        </style>


                                    </div>
                                </li>


                                <li class="nav-item dropdown position-static">
                                    <a style="padding: 35px 0px" class="nav-link dropdown-toggle" href="#"
                                        id="megaAccessories" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Accessories
                                    </a>

                                    <div class="dropdown-menu w-100 p-4" aria-labelledby="megaAccessories">
                                        <div class="row g-4 accessories-divider">
                                            @forelse ($categoriesPosition3 as $category)
                                                <div class="col-lg-3 col-md-6 mb-4 p-5">
                                                    <h6 class="fw-bold mb-3">{{ $category->name_category }}</h6>

                                                    <div class="row g-2">
                                                        @foreach ($category->brands->chunk(4) as $chunk)
                                                            @foreach ($chunk as $brand)
                                                                <div class="col-6 col-md-6">
                                                                    <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                        class="dropdown-item px-0 brand-item">
                                                                        {{ $brand->name_brand }}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-0">Accessories belum tersedia.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <style>
                                            /* Garis pemisah antar kategori */
                                            .accessories-divider>div {
                                                border-right: 2px solid #dcdcdc;
                                            }

                                            /* Hilangkan garis di kolom terakhir */
                                            .accessories-divider>div:last-child {
                                                border-right: none;
                                            }

                                            /* Hilangkan bold di brand */
                                            .brand-item {
                                                font-weight: normal !important;
                                            }
                                        </style>



                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a href="/about">About</a>
                                </li>

                                <li class="nav-item">
                                    <a href="/News">News</a>
                                </li>

                                <li class="nav-item">
                                    <a href="/contact">Contact</a>
                                </li>

                            </ul>
                            <div class="button add-list-button">
                                <div class="button-group">
                                    @guest
                                        <a href="/login" class="btn-login">Login</a>
                                    @endguest

                                    {{-- <a href="#" class="btn-download">
                                                Download App   <i class="bx bx-download me-2 fs-4"></i>
                                            </a> --}}
                                </div>
                            </div>
                            {{-- SUDAH LOGIN --}}
                            <div class="topbar-wrapper">
                                @auth
                                    <!-- Search -->
                                    <div class="search-box">
                                        <i class="bx bx-search"></i>
                                        <input type="text" placeholder="Search">
                                    </div>
                                    <!-- Icon Buttons -->
                                    <div class="icon-box">

                                        <a href="{{ route('cart') }}" class="icon-btn position-relative">
                                            <i class="bx bx-shopping-bag fs-3"></i>
                                            <span id="cartDot"
                                                class="position-absolute top-0 start-100 translate-middle bg-danger rounded-circle"
                                                style="width:10px;height:10px; display: {{ $cartCount > 0 ? 'inline-block' : 'none' }};">
                                            </span>
                                        </a>
                                        <a href="#" id="notifBtn" class="icon-btn position-relative">
                                            <i class="bx bx-bell fs-4"></i>
                                            <span class="rounded-circle bg-danger position-absolute top-0 end-0"
                                                style="width:8px;height:8px;"></span>
                                        </a>

                                        <div id="notifModal" class="notif-modal">

                                            <div class="notif-tabs">
                                                <div class="tab active" data-target="notifContent">
                                                    Notification <span class="dot">1</span>
                                                </div>
                                                <div class="tab" data-target="transContent">
                                                    Transaction <span class="dot">1</span>
                                                </div>
                                            </div>

                                            <div class="notif-content show" id="notifContent">

                                                <div class="item">
                                                    <div class="icon bg-success">
                                                        <i class="bx bx-dollar-circle"></i>
                                                    </div>
                                                    <div>
                                                        <div class="title">
                                                            ORDER VEHICLE <span>2.00 AM</span>
                                                        </div>
                                                        <p>
                                                            You have placed an order & will immediately make payment for
                                                            the WULING vehicle - New Air Ev...
                                                        </p>
                                                        <a href="#">Details...</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="item">
                                                    <div class="icon bg-info">
                                                        <i class="bx bx-car"></i>
                                                    </div>
                                                    <div>
                                                        <div class="title">
                                                            TEST DRIVE <span>Yesterday</span>
                                                        </div>
                                                        <p>
                                                            You apply to do a test drive of the WULING vehicle - New Air
                                                            Ev...
                                                        </p>
                                                        <a href="#">Details...</a>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="notif-content" id="transContent">

                                                <!-- PURCHASE TITLE -->
                                                <div class="trans-title">Purchase</div>

                                                <!-- STEPS -->
                                                <div class="trans-steps">

                                                    <div class="step active">
                                                        <div class="step-icon">
                                                            <i class="bx bx-time"></i>
                                                            <span class="step-dot">1</span>
                                                        </div>
                                                        <span>Waiting for<br>Confirmation</span>
                                                    </div>

                                                    <div class="step">
                                                        <div class="step-icon">
                                                            <i class="bx bx-refresh"></i>
                                                            <span class="step-dot">1</span>
                                                        </div>
                                                        <span>Process</span>
                                                    </div>

                                                    <div class="step">
                                                        <div class="step-icon">
                                                            <i class="bx bxs-truck"></i>
                                                            <span class="step-dot">1</span>
                                                        </div>
                                                        <span>Being<br>sent</span>
                                                    </div>


                                                    <div class="step">
                                                        <div class="step-icon">
                                                            <i class="bx bx-map"></i>
                                                            <span class="step-dot">1</span>
                                                        </div>
                                                        <span>to the<br>Location</span>
                                                    </div>

                                                </div>

                                                <hr>

                                                <!-- STATUS TITLE -->
                                                <div class="trans-status-title">Waiting For Confirmation</div>

                                                <!-- CARD -->
                                                <a href="/payment/va">
                                                    <div class="trans-card">
                                                        <img src="{{ asset('front_end/assets/images/Pristine_White 1.png') }}"
                                                            alt="car">

                                                        <div class="trans-card-body">
                                                            <div class="trans-card-top">
                                                                <span class="status">Menunggu Pembayaran</span>
                                                                <span class="time">2.00 AM</span>
                                                            </div>
                                                            <div class="product">
                                                                New Air Ev Lite Long Range
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>

                                            </div>


                                        </div>


                                        <!-- PROFILE -->
                                        <a href="{{ route('profil.show', optional(Auth::user())->slug ?? 'guest') }}"
                                            class="profile-box">
                                            <img src="{{ asset('front_end/assets/images/Group 21.png') }}"
                                                alt="Profile">
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* TRANSACTION TITLE */
    .trans-title {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 14px;
    }

    /* STEPS */
    .trans-steps {
        display: flex;
        justify-content: space-between;
        text-align: center;
        margin-bottom: 14px;
    }

    .step {
        font-size: 11px;
        color: #9aa5b1;
        width: 25%;
    }

    .step-icon {
        position: relative;
        width: 38px;
        height: 38px;
        margin: 0 auto 6px;
        border-radius: 50%;
        background: #f1f3f5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9aa5b1;
        font-size: 18px;
    }

    .step.active .step-icon {
        background: #e9fff7;
        color: #1dd1a1;
    }

    .step-dot {
        position: absolute;
        top: -3px;
        right: -3px;
        background: #ff3b30;
        color: #fff;
        font-size: 9px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step.active span {
        color: #1dd1a1;
        font-weight: 500;
    }

    /* STATUS TITLE */
    .trans-status-title {
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    /* CARD */
    .trans-card {
        display: flex;
        gap: 12px;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 10px;
        background: #fff;
    }

    .trans-card img {
        width: 70px;
        height: 45px;
        object-fit: cover;
        border-radius: 6px;
        background: #f5f5f5;
    }

    .trans-card-body {
        flex: 1;
    }

    .trans-card-top {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .status {
        color: #6c757d;
    }

    .time {
        color: #1dd1a1;
    }

    .product {
        font-size: 13px;
        font-weight: 500;
        color: #1dd1a1;
    }

    /* ICON CONTAINER – BULAT SEMPURNA */
    .icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        min-height: 44px;
        border-radius: 50%;
        background: #e9fff7;
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
    }

    /* ICON DI DALAM – CENTER & PROPORSIONAL */
    .icon i {
        font-size: 20px;
        line-height: 1;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1dd1a1;
    }

    /* HILANGKAN PENGARUH BG BOOTSTRAP */
    .bg-success,
    .bg-info {
        background: transparent !important;
    }

    /* CONTAINER */
    .notif-modal {
        position: absolute;
        top: 75px;
        right: 20px;
        width: 360px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .12);
        border: 1px solid #eee;
        font-family: 'Inter', sans-serif;
        z-index: 9999;
    }

    /* TABS HEADER */
    .notif-tabs {
        display: flex;
        border-bottom: 1px solid #eee;
    }

    .notif-tabs .tab {
        flex: 1;
        padding: 14px 0;
        text-align: center;
        font-size: 14px;
        font-weight: 500;
        color: #b5b5b5;
        cursor: pointer;
        position: relative;
    }

    .notif-tabs .tab.active {
        color: #1dd1a1;
    }

    .notif-tabs .tab.active::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 25%;
        width: 50%;
        height: 2px;
        background: #1dd1a1;
        border-radius: 10px;
    }

    /* RED BADGE */
    .dot {
        position: absolute;
        top: 8px;
        right: 35%;
        background: #ff3b30;
        color: #fff;
        font-size: 10px;
        padding: 1px 5px;
        border-radius: 50%;
    }

    /* CONTENT */
    .notif-content {
        display: none;
        padding: 14px 16px;
    }

    .notif-content.show {
        display: block;
    }

    /* ITEM */
    .item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    /* ICON BULAT */
    .icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        background: #e8fff8;
        color: #1dd1a1;
    }

    .bg-success,
    .bg-info {
        background: #e8fff8 !important;
        color: #1dd1a1 !important;
    }

    /* TITLE */
    .title {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
    }

    .title span {
        font-size: 13px;
        font-weight: 500;
        color: #1dd1a1;
    }

    /* DESC */
    .item p {
        font-size: 13px;
        line-height: 1.5;
        color: #8a8a8a;
        margin: 6px 0 4px;
    }

    /* LINK */
    .item a {
        font-size: 13px;
        color: #1dd1a1;
        text-decoration: none;
    }

    /* HR */
    .notif-content hr {
        border: none;
        border-top: 1px solid #eee;
        margin: 14px 0;
    }

    /* EMPTY */
    .empty {
        text-align: center;
        padding: 30px 0;
        color: #aaa;
        font-size: 14px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const btn = document.getElementById('notifBtn');
        const modal = document.getElementById('notifModal');

        // 🔥 PAKSA SEMBUNYI SAAT PAGE LOAD / REFRESH
        modal.style.display = 'none';

        // toggle popup
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        });

        // klik luar nutup
        document.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // biar klik di dalam modal nggak nutup
        modal.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // tab switch
        document.querySelectorAll('.notif-tabs .tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.notif-tabs .tab').forEach(t => t.classList.remove(
                    'active'));
                document.querySelectorAll('.notif-content').forEach(c => c.classList.remove(
                    'show'));

                tab.classList.add('active');
                document.getElementById(tab.dataset.target).classList.add('show');
            });
        });

    });
</script>
