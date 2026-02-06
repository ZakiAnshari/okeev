@extends('layout.user')
@section('title', 'Home')
@section('content')
    {{-- SECTION 1 --}}
    <section class="image-section ">
        <div class="container">
            <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="3000">
                <div class="carousel-inner" style="border-radius:12px">
                    @if (isset($sliders) && $sliders->isNotEmpty())
                        @foreach ($sliders as $index => $slider)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100"
                                    alt="{{ $slider->title ?? 'Hero Slider' }}">
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <img src="{{ asset('front_end/assets/images/hero/wallpaper.png') }}" class="d-block w-100"
                                alt="Default Image">
                        </div>
                    @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="hero-content  mt-5">
                @php $hero = ($homeContents ?? collect())->first(); @endphp
                <h2 class="hero-title">{{ $hero->about_title ?? 'Masa Depan Berkendara Dimulai dari Sini' }}</h2>
                <p class="hero-subtitle">
                    {{ $hero->about_description ?? 'Temukan kendaraan listrik impian Anda dari berbagai merek ternama. Hemat energi, ramah lingkungan, dan siap mengubah cara Anda melaju.' }}
                </p>
                @if (!empty($hero->button_text) && !empty($hero->button_link))
                    <a href="{{ $hero->button_link }}" class="btn btn-primary mt-3">{{ $hero->button_text }}</a>
                @endif
            </div>
        </div>
    </section>

    {{-- SECTION 2 --}}
    <section id="features" class="features section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('front_end/assets/images/hero/wallpaper1.png') }}" alt="Gambar Besar"
                            class="img-fluid rounded">
                        <div class="image-overlay">
                            <a href="#" class="selengkapnya-btn">Selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('front_end/assets/images/hero/wallpaper2.png') }}" alt="Gambar Besar"
                            class="img-fluid rounded">
                        <div class="image-overlay">
                            <a href="#" class="selengkapnya-btn">Selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-feature feature-fixed-size wow fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('front_end/assets/images/hero/Frame 7.png') }}" alt="Gambar Besar"
                            class="img-fluid">
                        <div class="image-overlay">
                            <a href="#" class="selengkapnya-btn">Selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('front_end/assets/images/hero/Frame 9.png') }}" alt="Gambar Besar"
                            class="img-fluid rounded">
                        <div class="image-overlay">
                            <a href="#" class="selengkapnya-btn">Selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('front_end/assets/images/hero/Frame 8.png') }}" alt="Gambar Besar"
                            class="img-fluid rounded">
                        <div class="image-overlay">
                            <a href="#" class="selengkapnya-btn">Selengkapnya →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 3 --}}
    <section class="why-choose-us-section position-relative">

        <!-- Gambar sebagai background -->
        <img src="{{ asset('front_end/assets/images/Union.png') }}" alt="Background" class="bg-union-img">

        <div class="container position-relative">
            <div class="text-start mb-5">
                <h4 class="section-title" style="color: #30445C">Why Choose Us ?</h4>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-choose-feature">
                        <div class="feature-header d-flex align-items-center" style="margin: 0px">
                            <div class="feature-icon me-3">
                                <img src="{{ asset('front_end/assets/images/logo/icon1.png') }}" alt="">
                            </div>
                            <h3 style="margin: 0px">{{ $hero->why_title_1 ?? 'Pilihan Merek & Model Lengkap' }}</h3>
                        </div>
                        <hr>
                        <p>{{ $hero->why_description_1 ?? 'Semua merek mobil listrik favorit Anda tersedia di satu showroom.' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-choose-feature">
                        <div class="feature-header d-flex align-items-center" style="margin: 0px">
                            <div class="feature-icon me-3">
                                <img src="{{ asset('front_end/assets/images/logo/icon2.png') }}" alt="">
                            </div>
                            <h3 style="margin: 0px">{{ $hero->why_title_2 ?? 'Test Drive Kendaraan yang di inginkan' }}
                            </h3>
                        </div>
                        <hr>
                        <p>{{ $hero->why_description_2 ?? 'Rasakan sendiri performa mobil listrik favorit Anda sebelum memutuskan.' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-choose-feature">
                        <div class="feature-header d-flex align-items-center" style="margin: 0px">
                            <div class="feature-icon me-3">
                                <img src="{{ asset('front_end/assets/images/logo/icon3.png') }}" alt="">
                            </div>
                            <h3 style="margin: 0px">{{ $hero->why_title_3 ?? 'Komitmen pada Lingkungan' }}</h3>
                        </div>
                        <hr>
                        <p>{{ $hero->why_description_3 ?? 'Dengan setiap mobil listrik yang terjual, kita bersama selangkah lebih dekat menuju masa depan hijau.' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <style>
        /* Background union image */
        .bg-union-img {
            position: absolute;
            top: 80px;
            transform: translateX(-50%);
            width: 128%;
            height: 65%;
            z-index: 0;
        }

        .why-choose-us-section .container {
            position: relative;
            z-index: 2;
        }

        .why-choose-us-section {
            padding: 80px 0;
            overflow: hidden;
        }

        /* HERO CAROUSEL: ensure all slides have equal visible area */
        /* Make carousel transitions smooth (fade) */
        .carousel.carousel-fade .carousel-item {
            transition: opacity 1s ease-in-out;
        }

        .carousel.carousel-fade .carousel-item img {

            /* HERO CAROUSEL: ensure all slides have equal visible area */
            /* Add rounded corners to the carousel and clip overflow so images follow the radius */
            #carouselExampleControls {
                border-radius: 12px;
                overflow: hidden;
            }

            .carousel {
                border-radius: 12px;
            }

            width: 100%;
            height: clamp(448px, 45vh, 640px);
            object-fit: cover;
            display: block;
        }

        /* PRODUCT CARDS: unify image container and padding so all sides look equal */
        .vehicle-img-wrapper {
            /* height: 260px; */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 4px 4px 0 0;
        }

        .product-images img {
            max-height: 100%;
            width: auto;
            object-fit: contain;
            /* padding: 16px !important; */
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
        }

        /* Brand logos uniform size */
        .brand-grid {
            /* display: flex; */
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .brand-box {
            flex: 0 0 auto;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-box img {
            max-height: 48px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        /* Scroll wrapper smooth */
        .scroll-wrapper {
            position: relative;
        }

        #vehicle-scroll {
            scroll-behavior: smooth;
        }
    </style>

    {{-- SECTION 4 --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">

                <!-- Kolom Kiri -->
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <h4 class="fw-semibold text-secondary mb-4">Our collaboration with brands</h4>

                    <!-- === VEHICLE ICONS === -->
                    <div id="vehicle-logos" class="brand-grid">
                        @foreach ($brands as $brand)
                            @if ($brand->category_position_id == 1)
                                <div class="brand-box">
                                    <img src="{{ asset('storage/' . $brand->image) }}" class="img-fluid"
                                        alt="{{ $brand->name_brand }}">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- === ELECTRIC ICONS === -->
                    <div id="electric-logos" class="d-none brand-grid">
                        @foreach ($brands as $brand)
                            @if ($brand->category_position_id == 4)
                                <div class="brand-box">
                                    <img src="{{ asset('storage/' . $brand->image) }}" class="img-fluid"
                                        alt="{{ $brand->name_brand }}">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Switch -->
                    <div class="d-flex justify-content-between mt-3">
                        <a href="#" id="btn-vehicle"
                            class="text-decoration-none fw-semibold text-info active-link">&lt; Vehicle</a>
                        <a href="#" id="btn-electric" class="text-decoration-none fw-semibold text-muted">Accessories
                            &gt;</a>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-lg-5 ps-lg-5">
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

                    <div class="d-flex align-items-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#testimonialModal"
                            style="text-decoration: none;">
                            <div class="me-3 d-flex" style="gap: -8px; cursor: pointer;">
                                @forelse($testimonials->take(3) as $testimonial)
                                    @if ($testimonial->profile_picture)
                                        <img src="{{ asset($testimonial->profile_picture) }}" class="border border-white"
                                            width="45" height="45"
                                            style="object-fit: cover; flex-shrink: 0; cursor: pointer; transition: transform 0.2s ease-in-out; border-radius: 50%; display: block;"
                                            alt="{{ $testimonial->name }}" title="{{ $testimonial->name }}"
                                            onmouseover="this.style.transform='scale(1.1)'"
                                            onmouseout="this.style.transform='scale(1)'">
                                    @endif
                                @empty
                                    <img src="{{ asset('front_end/assets/images/logo/Group 16.png') }}"
                                        class="border border-white" width="45" height="45"
                                        style="object-fit: cover; flex-shrink: 0; cursor: pointer; transition: transform 0.2s ease-in-out; border-radius: 50%; display: block;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'" alt="">
                                    <img src="{{ asset('front_end/assets/images/logo/Group 17.png') }}"
                                        class="border border-white" width="45" height="45"
                                        style="object-fit: cover; flex-shrink: 0; cursor: pointer; transition: transform 0.2s ease-in-out; border-radius: 50%; display: block;"
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
            <br><br><br>
            <!-- === GRADIENT LINE ANIMATED === -->
            <div class="gradient-line my-4 mx-auto"></div>
        </div>
    </section>

    <!-- === TESTIMONIAL MODAL === -->
    <div class="modal fade" id="testimonialModal" tabindex="-1" aria-labelledby="testimonialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 bg-gradient">
                    <h5 class="modal-title fw-bold" style="color: #30445C" id="testimonialModalLabel">
                        <i class="bx bxs-star me-2"></i>Customer Testimonials
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    @if ($testimonials->isNotEmpty())
                        <div class="row g-4">
                            @foreach ($testimonials as $testimonial)
                                <div class="col-12">
                                    <div class="testimonial-card">
                                        <div class="d-flex gap-3">
                                            <!-- Profile Picture -->
                                            <div class="flex-shrink-0">
                                                @if ($testimonial->profile_picture)
                                                    <img src="{{ asset($testimonial->profile_picture) }}" class="border"
                                                        width="70" height="70"
                                                        style="object-fit: cover; border: 3px solid #30445C; box-shadow: 0 2px 8px rgba(48, 68, 92, 0.15); border-radius: 50%; display: block;"
                                                        alt="{{ $testimonial->name }}">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center"
                                                        style="width: 70px; height: 70px; background: linear-gradient(135deg, #658FC2, #30445C); color: white; font-weight: bold; font-size: 28px; box-shadow: 0 2px 8px rgba(48, 68, 92, 0.15); border-radius: 50%; flex-shrink: 0;">
                                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Testimonial Content -->
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-0">{{ $testimonial->name }}</h6>
                                                        <small
                                                            class="text-muted">{{ $testimonial->created_at->format('d M Y') }}</small>
                                                    </div>
                                                    <div class="text-warning">
                                                        <i class="bx bxs-star"></i>
                                                        <i class="bx bxs-star"></i>
                                                        <i class="bx bxs-star"></i>
                                                        <i class="bx bxs-star"></i>
                                                        <i class="bx bxs-star"></i>
                                                    </div>
                                                </div>
                                                <p class="text-secondary mb-0"
                                                    style="font-size: 15px; line-height: 1.7; font-style: italic;">
                                                    "{{ $testimonial->message }}"
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted">No testimonials yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #30445C 0%, #658FC2 100%);
        }

        .testimonial-card {
            background: #FFFFFF;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #F1F1F1;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            border-color: #30445C;
            box-shadow: 0 8px 20px rgba(48, 68, 92, 0.12);
            transform: translateY(-2px);
        }

        .modal-content {
            border-radius: 16px;
        }

        .bx-star {
            font-size: 18px;
        }

        /* Prevent scrollbar layout shift - modern approach */
        html {
            scrollbar-gutter: stable;
        }

        /* Fallback for older browsers */
        body {
            overflow-y: scroll;
        }

        /* Ensure modal doesn't cause layout shift */
        body.modal-open {
            padding-right: 0 !important;
            overflow-y: scroll !important;
        }

        .modal.show {
            padding-right: 0 !important;
        }

        .modal-dialog-scrollable .modal-body {
            overflow-y: auto;
            max-height: calc(100vh - 200px);
            scrollbar-width: none;
        }

        /* Hide scrollbar by default */
        .modal-dialog-scrollable .modal-body::-webkit-scrollbar {
            display: none;
        }

        /* Show scrollbar on hover */
        .modal-dialog-scrollable .modal-body:hover {
            scrollbar-width: thin;
        }

        .modal-dialog-scrollable .modal-body:hover::-webkit-scrollbar {
            display: block;
            width: 8px;
        }

        .modal-dialog-scrollable .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modal-dialog-scrollable .modal-body::-webkit-scrollbar-thumb {
            background: #30445C;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        .modal-dialog-scrollable .modal-body::-webkit-scrollbar-thumb:hover {
            background: #658FC2;
        }

        /* Smooth modal animation */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
            transform: scale(0.95);
            opacity: 0;
        }

        .modal.show .modal-dialog {
            transform: scale(1);
            opacity: 1;
        }

        /* Fix for Bootstrap's padding adjustment on modal open */
        .modal {
            padding: 0 !important;
        }

        .modal.show {
            padding: 0 !important;
        }
    </style>

    {{-- SECTION 5 --}}
    @if ($products->isNotEmpty())
        <section class="bg-white py-5">
            <div class="container">
                <!-- Title -->
                <div class="text-center mb-4">
                    <h3 class="fw-bold" style="color:#30445C;">The Most Searched Vehicle</h3>
                </div>

                <!-- Tabs -->
                <ul class="nav nav-pills justify-content-center mb-4" id="productTabs">
                    <li class="nav-item">
                        <a class="nav-link active px-3 py-1" href="#" data-tab="in-stock">In Stock</a>
                    </li>

                    <li class="nav-item"><a class="nav-link px-3 py-1" href="#" data-tab="sedan">Sedan</a></li>
                    <li class="nav-item"><a class="nav-link px-3 py-1" href="#" data-tab="suv">SUV</a></li>
                    <li class="nav-item"><a class="nav-link px-3 py-1" href="#"
                            data-tab="motorcycle">Motorcycle</a></li>
                </ul>

                <!-- Scrollable cards -->
                <div class="scroll-wrapper position-relative">
                    <div class="overflow-auto pb-3" id="vehicle-scroll">
                        <!-- CARD -->
                        <div class="row g-4" style="flex-wrap: nowrap; min-width: min-content;">
                            @forelse($products as $product)
                                <div class="col-12 col-md-6 col-lg-2 mb-4"
                                    style="flex: 0 0 calc(20% - 10px); min-width: 300px;">
                                    @if (in_array($product->category_id, [1, 2]))
                                        <div class="vehicle-card rounded shadow-sm h-100"
                                            style="border: 1px solid #F1F1F1 !important;">

                                            <!-- Image -->
                                            <div class="vehicle-img-wrapper"
                                                style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%);
                                                border-radius: 4px 4px 0 0;">
                                                <div class="product-images">
                                                    @if ($product->thumbnail)
                                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                            class="d-block mx-auto img-fluid p-4"
                                                            alt="{{ $product->model_name }}">
                                                    @else
                                                        <img src="{{ asset('front_end/assets/images/placeholder.jpg') }}"
                                                            alt="No Image" class="img-fluid mb-2 vehicle-img w-100 p-4">
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Detail -->
                                            <div class="card-body p-3 bg-white rounded-bottom">
                                                <h6 class="fw-semibold text-dark mb-0">{{ $product->brand->name_brand }}
                                                </h6>
                                                <p class="fw-bold text-secondary small mb-1">{{ $product->model_name }}
                                                </p>
                                                <hr class="my-2">

                                                <!-- Icons -->
                                                <div class="d-flex justify-content-between text-center mb-2 mt-sm-3">

                                                    <div class="icon-box flex-fill d-flex flex-column align-items-center">
                                                        <img src="{{ asset('front_end/assets/images/3.png') }}"
                                                            width="22" class="mb-1">
                                                        <p class="small text-black mb-0 fw-semibold">{{ $product->miles }}
                                                            Miles</p>
                                                    </div>

                                                    <div class="icon-box flex-fill d-flex flex-column align-items-center">
                                                        <img src="{{ asset('front_end/assets/images/2.png') }}"
                                                            width="23" class="mb-1">
                                                        <p class="small text-black mb-0 fw-semibold">Electric</p>
                                                    </div>

                                                    @if ($product->category_id == 1)
                                                        <div
                                                            class="icon-box flex-fill d-flex flex-column align-items-center">
                                                            <img src="{{ asset('front_end/assets/images/1.png') }}"
                                                                width="21" class="mb-1">
                                                            <p class="small text-black mb-0 fw-semibold">
                                                                {{ $product->seats }} Seat</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                <hr class="my-2">

                                                <!-- Price & Detail Link -->
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <p class="fw-bold text-danger mb-0">
                                                        IDR {{ number_format($product->price, 0, ',', '.') }}
                                                    </p>

                                                    <a href="{{ route('landing.product', $product->slug) }}"
                                                        class="text-decoration-none fw-semibold d-flex align-items-center"
                                                        style="color: #30445C !important;">
                                                        Detail
                                                        <img src="{{ asset('front_end/assets/images/icon.png') }}"
                                                            width="10" class="mb-1 ms-2">
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p class="text-center">Tidak ada produk untuk brand ini.</p>
                            @endforelse
                        </div>

                    </div>


                    <!-- Scroll buttons -->
                    <button id="scrollLeft"
                        class="btn btn-light shadow position-absolute top-50 start-0 translate-middle-y ms-2"
                        style="z-index: 10;">
                        <i class="bx bx-chevron-left"></i>
                    </button>

                    <button id="scrollRight"
                        class="btn btn-light shadow position-absolute top-50 end-0 translate-middle-y me-2"
                        style="z-index: 10;">
                        <i class="bx bx-chevron-right"></i>
                    </button>

                </div>

                <script>
                    // Counter Animation
                    function animateCounters() {
                        const counters = document.querySelectorAll('.counter');
                        counters.forEach(counter => {
                            const target = parseInt(counter.getAttribute('data-target'));
                            let current = 0;
                            const increment = Math.ceil(target / 50);
                            
                            const timer = setInterval(() => {
                                current += increment;
                                if (current >= target) {
                                    counter.textContent = target;
                                    clearInterval(timer);
                                } else {
                                    counter.textContent = current;
                                }
                            }, 20);
                        });
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        // Start counter animation
                        animateCounters();

                        // Tab Navigation Handler
                        const tabLinks = document.querySelectorAll('#productTabs .nav-link');

                        tabLinks.forEach(link => {
                            link.addEventListener('click', function(e) {
                                e.preventDefault(); // Cegah default link behavior

                                // Remove active class dari semua link
                                tabLinks.forEach(l => l.classList.remove('active'));

                                // Add active class ke link yang diklik
                                this.classList.add('active');
                            });
                        });

                        // Brand Switch Handler
                        const btnVehicle = document.getElementById('btn-vehicle');
                        const btnElectric = document.getElementById('btn-electric');
                        const vehicleLogos = document.getElementById('vehicle-logos');
                        const electricLogos = document.getElementById('electric-logos');

                        if (btnVehicle && btnElectric && vehicleLogos && electricLogos) {
                            btnVehicle.addEventListener('click', function(e) {
                                e.preventDefault();
                                vehicleLogos.classList.remove('d-none');
                                electricLogos.classList.add('d-none');
                                btnVehicle.classList.remove('text-muted');
                                btnVehicle.classList.add('text-info');
                                btnElectric.classList.remove('text-info');
                                btnElectric.classList.add('text-muted');
                            });

                            btnElectric.addEventListener('click', function(e) {
                                e.preventDefault();
                                vehicleLogos.classList.add('d-none');
                                electricLogos.classList.remove('d-none');
                                btnElectric.classList.remove('text-muted');
                                btnElectric.classList.add('text-info');
                                btnVehicle.classList.remove('text-info');
                                btnVehicle.classList.add('text-muted');
                            });
                        }

                        // Scroll functionality
                        const scrollContainer = document.getElementById('vehicle-scroll');
                        const scrollLeftBtn = document.getElementById('scrollLeft');
                        const scrollRightBtn = document.getElementById('scrollRight');
                        const scrollAmount = 350;

                        if (scrollLeftBtn && scrollRightBtn && scrollContainer) {
                            scrollLeftBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                scrollContainer.scrollBy({
                                    left: -scrollAmount,
                                    behavior: 'smooth'
                                });
                            });

                            scrollRightBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                scrollContainer.scrollBy({
                                    left: scrollAmount,
                                    behavior: 'smooth'
                                });
                            });

                            // Hide/show scroll buttons based on scroll position
                            function updateScrollButtons() {
                                const hasScroll = scrollContainer.scrollWidth > scrollContainer.clientWidth;
                                if (!hasScroll) {
                                    scrollLeftBtn.style.display = 'none';
                                    scrollRightBtn.style.display = 'none';
                                    return;
                                }
                                scrollLeftBtn.style.display = 'block';
                                scrollRightBtn.style.display = 'block';

                                scrollLeftBtn.style.opacity = scrollContainer.scrollLeft > 0 ? '1' : '0.3';
                                scrollRightBtn.style.opacity =
                                    scrollContainer.scrollLeft < (scrollContainer.scrollWidth - scrollContainer.clientWidth -
                                        10) ? '1' : '0.3';
                            }

                            scrollContainer.addEventListener('scroll', updateScrollButtons);
                            window.addEventListener('resize', updateScrollButtons);
                            updateScrollButtons();
                        }
                    });
                </script>

            </div>
        </section>
    @endif
    @include('sweetalert::alert')
@endsection
