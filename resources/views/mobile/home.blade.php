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
                    <a href="{{ route('notification.index') }}">
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
                <a href="{{ route('shoppingcart.index') }}" class="icon-btn">
                    <img src="{{ asset('front_end/assets/images/logo/cart.jpg') }}" alt="Cart" class="icon-img">
                </a>
            </div>
        </div>
    </nav>

    <div class="category-wrapper">
        <div class="category-section">
            <a href="{{ route('vehiclecard.show') }}" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('front_end/assets/images/logo/1.jpg') }}" alt="Electric Car">
                </div>
                <span class="category-text">Electric<br>Car</span>
            </a>

            <a href="{{ route('showmotorcycles.show') }}" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('front_end/assets/images/logo/2.jpg') }}" alt="Electric Motor">
                </div>
                <span class="category-text">Electric<br>Motor</span>
            </a>

            {{-- <a href="{{ route('showelectric.show') }}" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('front_end/assets/images/logo/3.jpg') }}" alt="Electronic">
                </div>
                <span class="category-text">Electronic</span>
            </a> --}}

            <a href="{{ route('showaccessories.show') }}" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('front_end/assets/images/logo/Accessoris.jpg') }}" alt="Accessories">
                </div>
                <span class="category-text">Accessories</span>
            </a>
        </div>
    </div>

    <!-- Promo Banner -->
    <div class="container content-container">
        <div class="promo-banner">
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner" style="border-radius: 12px; overflow: hidden; height: 215px;">
                    @if (isset($sliders) && $sliders->isNotEmpty())
                        @foreach ($sliders as $index => $slider)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }} h-100">
                                <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100 h-100"
                                    alt="{{ $slider->title ?? 'Promo Banner' }}" style="object-fit: cover;">
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active h-100">
                            <img src="{{ asset('front_end/assets/images/logo/Mobile.jpg') }}" class="d-block w-100 h-100"
                                alt="Electric Vehicle Promo" style="object-fit: cover;">
                        </div>
                    @endif
                </div>

                @if (isset($sliders) && $sliders->isNotEmpty() && $sliders->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel"
                        data-bs-slide="prev"
                        style="background-color: rgba(0,0,0,0.3); border-radius: 50%; width: 32px; height: 32px; left: 10px; padding: 4px; top: 50%; transform: translateY(-50%);">
                        <span class="carousel-control-prev-icon" aria-hidden="true"
                            style="width: 16px; height: 16px; display: inline-block;"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel"
                        data-bs-slide="next"
                        style="background-color: rgba(0,0,0,0.3); border-radius: 50%; width: 32px; height: 32px; right: 10px; padding: 4px; top: 50%; transform: translateY(-50%);">
                        <span class="carousel-control-next-icon" aria-hidden="true"
                            style="width: 16px; height: 16px; display: inline-block;"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Text -->
    <div class="container content-container main-text-section">
        @php $hero = ($homeContents ?? collect())->first(); @endphp
        <h6 class="heading-hero mb-2">{{ $hero->about_title ?? 'Masa Depan Berkendara Dimulai dari Sini' }}</h6>
        <p> {{ $hero->about_description ?? 'Temukan kendaraan listrik impian Anda dari berbagai merek ternama. Hemat energi, ramah lingkungan, dan siap mengubah cara Anda melaju.' }}
        </p>
        @if (!empty($hero->button_text) && !empty($hero->button_link))
            <a href="{{ $hero->button_link }}" class="btn btn-primary mt-3">{{ $hero->button_text }}</a>
        @endif
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
                        <h5>{{ $hero->why_title_1 ?? 'Pilihan Merek & Model Lengkap' }}</h5>
                    </div>
                    <hr class="feature-line">
                    <p class="feature-desc">
                        {{ $hero->why_description_1 ?? 'Semua merek mobil listrik favorit Anda tersedia di satu showroom.' }}
                    </p>
                </div>


                <!-- ITEM 2 -->
                <div class="feature-card">
                    <div class="feature-header">
                        <img src="{{ asset('front_end/assets/images/logo/mobileicon2-Photoroom.png') }}"
                            class="feature-icon" alt="">
                        <h5>{{ $hero->why_title_2 ?? 'Test Drive Kendaraan yang di inginkan' }}</h5>
                    </div>

                    <hr class="feature-line">

                    <p class="feature-desc">
                        {{ $hero->why_description_2 ?? 'Rasakan sendiri performa mobil listrik favorit Anda sebelum memutuskan.' }}
                    </p>
                </div>

                <!-- ITEM 3 -->
                <div class="feature-card">
                    <div class="feature-header">
                        <img src="{{ asset('front_end/assets/images/logo/mobileicon3-Photoroom.png') }}"
                            class="feature-icon" alt="">
                        <h5>{{ $hero->why_title_3 ?? 'Komitmen pada Lingkungan' }}</h5>
                    </div>

                    <hr class="feature-line">

                    <p class="feature-desc">
                        {{ $hero->why_description_3 ?? 'Dengan setiap mobil listrik yang terjual, kita bersama selangkah lebih dekat menuju masa depan hijau.' }}
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
    </style>

    <!-- Counting Section -->
    <div class="container content-container counting-section mt-5">
        <div class="row mb-4 text-center">
            <div class="col-4">
                <h2 class="fw-bold text-primary"><span class="counter"
                        data-target="{{ $brands->count() }}">0</span></h2>
                <p class="text-muted small mb-0">Collaboration<br>with brands</p>
            </div>
            <div class="col-4">
                <h2 class="fw-bold text-primary"><span class="counter"
                        data-target="{{ $hero->collaboration_customer ?? 0 }}">{{ $hero->collaboration_customer ?? 0 }}</span>
                </h2>
                <p class="text-muted small mb-0">Customer</p>
            </div>
            <div class="col-4">
                <h2 class="fw-bold text-primary"><span class="counter"
                        data-target="{{ $hero->collaboration_customer_happy ?? 0 }}">{{ $hero->collaboration_customer_happy ?? 0 }}</span>
                </h2>
                <p class="text-muted small mb-0">Customer Happy</p>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#testimonialModal"
                        style="text-decoration: none;">
                        <div class="me-3 d-flex" style="gap: -8px; cursor: pointer;">
                            @forelse($testimonials->take(3) as $testimonial)
                                @if ($testimonial->profile_picture)
                                    <img src="{{ asset($testimonial->profile_picture) }}"
                                        class="rounded-circle border border-white" width="45" height="45"
                                        style="object-fit: cover; flex-shrink: 0; margin-left: -8px; cursor: pointer; transition: transform 0.2s ease-in-out;"
                                        alt="{{ $testimonial->name }}" title="{{ $testimonial->name }}"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                @endif
                            @empty
                                <img src="{{ asset('front_end/assets/images/logo/Group 16.png') }}"
                                    class="rounded-circle border border-white" width="45" height="45"
                                    style="object-fit: cover; flex-shrink: 0; cursor: pointer; transition: transform 0.2s ease-in-out;"
                                    onmouseover="this.style.transform='scale(1.1)'"
                                    onmouseout="this.style.transform='scale(1)'" alt="">
                                <img src="{{ asset('front_end/assets/images/logo/Group 17.png') }}"
                                    class="rounded-circle border border-white" width="45" height="45"
                                    style="object-fit: cover; flex-shrink: 0; margin-left: -8px; cursor: pointer; transition: transform 0.2s ease-in-out;"
                                    onmouseover="this.style.transform='scale(1.1)'"
                                    onmouseout="this.style.transform='scale(1)'" alt="">
                            @endforelse
                        </div>
                    </a>
                    <div>
                        <h5 class="fw-bold mb-1">Million of happy customers</h5>
                        <p class="text-muted small mb-0">{{ $testimonials->count() }} Testimonial from our happy
                            customers</p>
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


        <div id="vehicle-brands" class="brand-grid p-3 tab-content active">
            @foreach ($brands->where('category_position_id', 1) as $brand)
                <div class="brand-item">
                    <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name_brand }}"
                        class="brand-logo">
                </div>
            @endforeach
        </div>

        <div id="electric-brands" class="brand-grid p-3 tab-content">
            @foreach ($brands->where('category_position_id', 2) as $brand)
                <div class="brand-item">
                    <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name_brand }}"
                        class="brand-logo">
                </div>
            @endforeach
        </div>

    </div>

    <!-- Most Searched Section -->
    <div class="container content-container most-searched-section p-3">
        <div class="strip-divider"></div>
        <h3 class="text-center">The Most Searched Vehicle</h3>

        <div class="search-tabs p-3">
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

        </div>
    </div>

    </div>

    <!-- Testimonial Modal -->
    <div class="modal fade" id="testimonialModal" tabindex="-1" aria-labelledby="testimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="testimonialModalLabel">Customer Testimonials</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @forelse($testimonials as $testimonial)
                        <div class="testimonial-item mb-4 pb-3 border-bottom">
                            <div class="d-flex align-items-start">
                                @if ($testimonial->profile_picture)
                                    <img src="{{ asset($testimonial->profile_picture) }}"
                                        class="rounded-circle me-3" width="50" height="50"
                                        style="object-fit: cover;" alt="{{ $testimonial->name }}">
                                @else
                                    <img src="{{ asset('front_end/assets/images/logo/Group 16.png') }}"
                                        class="rounded-circle me-3" width="50" height="50"
                                        style="object-fit: cover;" alt="">
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">{{ $testimonial->name ?? 'Anonymous' }}</h6>
                                    <div class="mb-2">
                                        @for ($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        @endfor
                                    </div>
                                    <p class="small text-muted mb-0">{{ $testimonial->message ?? $testimonial->testimonial }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <p class="text-muted">Belum ada testimonial dari pelanggan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
