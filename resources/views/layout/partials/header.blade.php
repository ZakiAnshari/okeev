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
                                        
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 mb-4">
                                                <h6 class="fw-bold mb-3">Electric Cars</h6>
                                                <div class="row">
                                                    @foreach ($brandChunksCategory1 as $chunk)
                                                        <div class="col-6 col-md-4">
                                                            <ul class="list-unstyled">
                                                                @foreach ($chunk as $brand)
                                                                    @if ($brand->category_id == 1)
                                                                        <li>
                                                                            <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                                class="dropdown-item">
                                                                                {{ $brand->name_brand }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-1 d-none d-lg-flex ">
                                                <div style="width:1px; background:#d1d1d1; height:100%;"></div>
                                            </div>

                                            <div class="col-lg-5 col-md-6">
                                                <h6 class="fw-bold mb-3">Electric Motorcycles</h6>
                                                {{-- Menu untuk category_id = 2 --}}
                                                <div class="row">
                                                    @foreach ($brandChunksCategory2 as $chunk)
                                                        <div class="col-6 col-md-4">
                                                            <ul class="list-unstyled">
                                                                @foreach ($chunk as $brand)
                                                                    @if ($brand->category_id == 2)
                                                                        <li>
                                                                            <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                                class="dropdown-item">
                                                                                {{ $brand->name_brand }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown position-static">
                                    <a class="dd-menu collapsed" href="#" id="megaElectric" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Electric
                                    </a>
                                    <div class="dropdown-menu w-100 p-4" aria-labelledby="megaElectric">
                                        <div class="d-flex flex-wrap justify-content-center">
                                            @foreach ($brandChunksCategory3 as $chunk)
                                                @foreach ($chunk as $brand)
                                                    @if ($brand->category_id == 3)
                                                        <div class="p-2" style="flex: 0 0 auto; width: 150px;">
                                                            <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                class="dropdown-item text-center">
                                                                {{ $brand->name_brand }}
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a href="/about">About OKEEV</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="/about">News</a>
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
                                        <a href="{{ route('profil.show', optional(Auth::user())->slug ?? 'guest') }}"
                                            class="profile-box">
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
