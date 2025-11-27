<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Okeev</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/front_end/assets/images/favicon.svg') }}" />
    
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/main.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Oxanium', sans-serif !important;
        }

        /* === BUTTON GROUP === */
        .menu-buttons {
            margin-left: 40px;
        }

        .button-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        @media (max-width: 768px) {
            .d-lg-none {
                display: flex !important;
                justify-content: start;
                align-items: center;
                gap: 10px;
                width: 100%;
                
                padding: 10px 0;
            }
        }

        @media (min-width: 769px) {
            .d-lg-none {
                display: none !important;
            }
        }

        .btn-login,
        .btn-download {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Oxanium', sans-serif;
            font-size: 17px !important;
            padding: 8px 20px;
            border-radius: 40px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: #2c3552;
            color: #fff !important;
        }

        .btn-login:hover {
            background-color: #464747;
        }

        /* .btn-download {
            background: linear-gradient(90deg, #00b4ff, #00fff0);
            color: #083b4c;
        } */

        /* .btn-download i {
            margin-left: 6px;
            font-size: 13px;
        }

        .btn-download:hover {
            filter: brightness(1.1);
        } */

        .header .navbar .mobile-menu-btn .toggler-icon {
            background-color: #000 !important;
        }

        .logo-header {
            max-width: 180px; /* ukuran default untuk layar besar */
            height: auto;
            transition: all 0.3s ease;
        }

/* Ukuran menengah */
@media (max-width: 992px) {
.logo-header {
    max-width: 150px;
}

}

/* Ukuran kecil (HP) */
@media (max-width: 576px) {
.logo-header {
    max-width: 110px;
}
}

    .dropdown-menu .dropdown-item {
    padding: 15px 0 !important;
}
/* Semua item warna hitam */
.dropdown-menu .dropdown-item {
    color: #30445c !important;
    background-color: transparent !important;
}

/* Hanya item yang di-hover -> biru */
.dropdown-menu .dropdown-item:hover {
    color: #0d6efd !important;        /* biru bootstrap */
    background-color: transparent !important;
}
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                             <a href="/" class="d-inline-block">
                            <img 
                                src="{{ asset('front_end/assets/images/logo/logo.png') }}" 
                                alt="Logo"
                                class="img-fluid logo-header"
                            >
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
                                            <a class="dd-menu collapsed" href="#" id="megaVehicle" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Vehicle
                                            </a>
                                            <div class="dropdown-menu w-100 p-4" aria-labelledby="megaVehicle">
                                                <div class="row"> 
                                                    <div class="col-lg-6 col-md-6 mb-4">
                                                        <h6 class="fw-bold mb-3">Electric Cars
                                                        </h6>
                                                        <div class="row">
                                                            @foreach($brandChunks as $chunk)
                                                                <div class="col-6 col-md-4">
                                                                    <ul class="list-unstyled">
                                                                        @foreach($chunk as $brand)
                                                                            <li>
                                                                                <a href="{{ route('landing.cars', $brand->slug) }}" class="dropdown-item">
                                                                                    {{ $brand->brand }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                
                                                    <div class="col-lg-1 d-none d-lg-flex justify-content-center">
                                                        <div style="width:1px; background:#d1d1d1; height:100%;"></div>
                                                    </div>

                                                
                                                    <div class="col-lg-5 col-md-6">
                                                        <h6 class="fw-bold mb-3">Electric Motorcycles</h6>
                                                        <div class="row">

                                                            <div class="col-6">
                                                                <ul class="list-unstyled">
                                                                    <li><a href="#" class="dropdown-item">Polytron</a></li>
                                                                </ul>
                                                            </div>

                                                            <div class="col-6">
                                                                <ul class="list-unstyled">
                                                                    <li><a href="#" class="dropdown-item">Sellis</a></li>
                                                                    <li><a href="#" class="dropdown-item">Yadea</a></li>
                                                                    <li><a href="#" class="dropdown-item">Volta</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                                data-bs-target="#submenu-electric" aria-expanded="false">
                                                Electric
                                            </a>
                                            <ul class="sub-menu collapse" id="submenu-electric">
                                                <li class="nav-item"><a href="#">Electric 1</a></li>
                                                <li class="nav-item"><a href="#">Electric 2</a></li>
                                                <li class="nav-item"><a href="#">Electric 3</a></li>
                                            </ul>
                                        </li>

                                        <li class="nav-item">
                                            <a href="/about">About OKEEV</a>
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
                                                <input type="text" placeholder="Search Vehicle / electric">
                                            </div>

                                            <!-- Icon Buttons -->
                                            <div class="icon-box">
                                                <a href="/login" class="icon-btn">
                                                    <i class="bx bx-shopping-bag"></i>
                                                </a>
                                                <a href="/notification" class="icon-btn notif">
                                                    <i class="bx bx-bell"></i>
                                                    <span class="dot"></span>
                                                </a>
                                                <!-- PROFILE -->
                                                <a href="{{ route('profil.show', optional(Auth::user())->slug ?? 'guest') }}" class="profile-box">
                                                    <img src="{{ asset('front_end/assets/images/Group 21.png') }}" alt="Profile">
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
    <!-- End Header Area -->

    @yield('content')

    <footer style="background-color: #F9F9F9;" class="pt-5">
        <div class="container">
            <div class="row pb-4">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <a href="/">
                                    <img src="{{ asset('front_end/assets/images/logo/logo.png') }}" alt="Logo">
                                </a>
                    </div>
                    <p class="text-secondary small">
                        Lorem ipsum dolor sit amet consectetur. Velit fermentum mi consectetur egestas in mauris. Enim orci volutpat nullam ac sed dolor etiam nulla fringilla. Laoreet sagittis elementum elit ipsum cras aenean malesuada.
                    </p>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-body">Vehicle</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-body">Electric</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-envelope me-2"></i> 
                            <a href="mailto:okeev2025@gmail.com" class="text-decoration-none text-body small">okeev2025@gmail.com</a>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-telephone me-2"></i> 
                            <span class="text-body small">+62 5689 8546 253</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-geo-alt me-2 mt-1"></i> 
                            <span class="text-body small">Lorem ipsum dolor sit amet consectetur. Velit fermentum mi consectetur egestas in mauris.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-white text-center py-3" style="background-color: #30445C !important;"> 
            <div class="container">
                <p class="mb-0 small">PT. Okeev 2025</p>
            </div>
        </div>
    </footer>


    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="bx bx-chevron-up"></i>
    </a>


    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('/front_end/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/count-up.min.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/main.js') }}"></script>

    <script type="text/javascript">
        //====== counter up 
        var cu = new counterUp({
            start: 0,
            duration: 2000,
            intvalues: true,
            interval: 100,
            append: " ",
        });
        cu.start();
    </script>
</body>
</html>
