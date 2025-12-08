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
                                            @forelse ($categoriesPosition1 as $category)
                                                <div class="col-lg-6 col-md-6 mb-4">
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
                                                                                class="dropdown-item">
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

                                    </div>
                                </li>

                                <li class="nav-item dropdown position-static">
                                    <a class="dd-menu collapsed" href="#" id="megaElectric" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Electric
                                    </a>
                                    <div class="dropdown-menu w-100 p-4" aria-labelledby="megaElectric">

                                        <div class="row">
                                            @forelse ($categoriesPosition2 as $category)
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <!-- Header kategori -->
                                                    <h6 class="fw-bold mb-3">{{ $category->name_category }}</h6>

                                                    <!-- Grid brands per kategori -->
                                                    <div class="row">
                                                        @foreach ($category->brands->chunk(4) as $chunk)
                                                            @foreach ($chunk as $brand)
                                                                <div class="col-6 col-md-6">
                                                                    <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                        class="dropdown-item">
                                                                        {{ $brand->name_brand }}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-0">Kategori Electric belum tersedia.</p>
                                                </div>
                                            @endforelse
                                        </div>

                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a href="/about">Accessories</a>
                                </li>

                                <li class="nav-item">
                                    <a href="/about">About</a>
                                </li>

                                <li class="nav-item">
                                    <a href="/news">News</a>
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
                                        <a href="/cart" class="icon-btn position-relative">
                                            <i class="bx bx-shopping-bag fs-3"></i>

                                            <!-- Badge jumlah item -->
                                            <span id="cartCount"
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                style="font-size:12px;">
                                                0
                                            </span>
                                        </a>

                                        <a href="javascript:void(0)" class="icon-btn notif position-relative"
                                            data-bs-toggle="modal" data-bs-target="#notificationModal">

                                            <i class="bx bx-bell fs-4"></i>
                                            <span class="rounded-circle bg-danger position-absolute top-0 end-0 p-1"
                                                style="width:8px; height:8px;"></span>
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
