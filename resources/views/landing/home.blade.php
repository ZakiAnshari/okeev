@extends('layout.user')
@section('title', 'Home')
@section('content')
    {{-- SECTION 1 --}}
    <section class="image-section ">
        <div class="container">
            <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner" style="border-radius:12px">
                    @php
                        $carouselItems = collect($homeContents ?? [])->filter(function($c) { return !empty($c->image) && ($c->is_active ?? true); })->values();
                    @endphp

                    @if($carouselItems->isNotEmpty())
                        @foreach($carouselItems as $i => $item)
                            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $item->image) }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <img src="{{ asset('front_end/assets/images/hero/wallpaper.png') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('front_end/assets/images/hero/wallpaper2.png') }}" class="d-block w-100" alt="...">
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
                <h2 class="hero-title">{{ $hero->title ?? 'Masa Depan Berkendara Dimulai dari Sini' }}</h2>
                <p class="hero-subtitle">{{ $hero->description ?? 'Temukan kendaraan listrik impian Anda dari berbagai merek ternama. Hemat energi, ramah lingkungan, dan siap mengubah cara Anda melaju.' }}</p>
                @if(!empty($hero->button_text) && !empty($hero->button_link))
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
                            <h3 style="margin: 0px">Pilihan Merek & Model Lengkap</h3>
                        </div>
                        <hr>
                        <p>Semua merek mobil listrik favorit Anda tersedia di satu showroom.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-choose-feature">
                        <div class="feature-header d-flex align-items-center" style="margin: 0px">
                            <div class="feature-icon me-3">
                                <img src="{{ asset('front_end/assets/images/logo/icon2.png') }}" alt="">
                            </div>
                            <h3 style="margin: 0px">Test Drive Kendaraan yang di inginkan</h3>
                        </div>
                        <hr>
                        <p>Rasakan sendiri performa mobil listrik favorit Anda sebelum memutuskan.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-choose-feature">
                        <div class="feature-header d-flex align-items-center" style="margin: 0px">
                            <div class="feature-icon me-3">
                                <img src="{{ asset('front_end/assets/images/logo/icon3.png') }}" alt="">
                            </div>
                            <h3 style="margin: 0px">Komitmen pada Lingkungan</h3>
                        </div>
                        <hr>
                        <p>Dengan setiap mobil listrik yang terjual, kita bersama selangkah lebih dekat menuju masa depan
                            hijau.</p>
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
            #carouselExampleControls { border-radius: 12px; overflow: hidden; }
            .carousel { border-radius: 12px; }

            width: 100%;
            height: clamp(448px, 45vh, 640px);
            object-fit: cover;
            display: block;
        }

        /* PRODUCT CARDS: unify image container and padding so all sides look equal */
        .vehicle-img-wrapper {
            height: 260px;
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
            padding: 16px !important;
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
        }

        /* Brand logos uniform size */
        .brand-grid { display:flex; flex-wrap:wrap; gap:12px; align-items:center; }
        .brand-box { flex: 0 0 auto; padding:6px; display:flex; align-items:center; justify-content:center; }
        .brand-box img { max-height:48px; width:auto; object-fit:contain; display:block; }

        /* Scroll wrapper smooth */
        .scroll-wrapper { position:relative; }
        #vehicle-scroll { scroll-behavior: smooth; }
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
                            @if (in_array($brand->category_id, [1, 2]))
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
                            @if (in_array($brand->category_id, [3, 4]))
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
                        <a href="#" id="btn-electric" class="text-decoration-none fw-semibold text-muted">Electric
                            &gt;</a>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-lg-5 ps-lg-5">
                    <div class="row mb-4 text-center">
                        <div class="col-4">
                            <h2 class="fw-bold text-primary"><span class="counter" data-target="28">0</span></h2>
                            <p class="text-muted small mb-0">Collaboration<br>with brands</p>
                        </div>
                        <div class="col-4">
                            <h2 class="fw-bold text-primary"><span class="counter" data-target="500">0</span></h2>
                            <p class="text-muted small mb-0">Customer</p>
                        </div>
                        <div class="col-4">
                            <h2 class="fw-bold text-primary"><span class="counter" data-target="497">0</span></h2>
                            <p class="text-muted small mb-0">Customer Happy</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <img src="{{ asset('front_end/assets/images/logo/Group 16.png') }}"
                                class="rounded-circle me-n2 border border-white" width="40" alt="">
                            <img src="{{ asset('front_end/assets/images/logo/Group 17.png') }}"
                                class="rounded-circle me-n2 border border-white" width="40" alt="">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Million of happy customers</h5>
                            <p class="text-muted small mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
            <!-- === GRADIENT LINE ANIMATED === -->
            <div class="gradient-line my-4 mx-auto"></div>
        </div>
    </section>

    {{-- SECTION 5 --}}
    @if ($products->isNotEmpty())
        <section class="bg-white py-5">
            <div class="container">
                <!-- Title -->
                <div class="text-center mb-4">
                    <h3 class="fw-bold" style="color:#30445C;">The Most Searched Vehicle</h3>
                </div>

                <!-- Tabs -->
                {{-- <ul class="nav nav-pills justify-content-center mb-4">
                <li class="nav-item">
                    <a class="nav-link active px-3 py-1" href="#">In Stock</a>
                </li>
                
                <li class="nav-item"><a class="nav-link px-3 py-1" href="#">Sedan</a></li>
                <li class="nav-item"><a class="nav-link px-3 py-1" href="#">SUV</a></li>
                <li class="nav-item"><a class="nav-link px-3 py-1" href="#">Motorcycle</a></li>
            </ul> --}}

                <!-- Scrollable cards -->
                <div class="scroll-wrapper position-relative">
                    <div class="overflow-auto pb-3" id="vehicle-scroll">
                        <!-- CARD -->
                        <div class="row">
                            @forelse($products as $product)
                                <div class="col-12 col-md-6 col-lg-3 mb-4">
                                    @if (in_array($product->category_id, [1, 2]))
                                        <div class="vehicle-card rounded shadow-sm h-100"
                                            style="border: 1px solid #F1F1F1 !important;">

                                            <!-- Image -->
                                            <div class="vehicle-img-wrapper"
                                                style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%);
                                                border-radius: 4px 4px 0 0;">

                                                <div class="product-images">
                                                    @if ($product->images->first())
                                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                            class="d-block mx-auto img-fluid p-4" style=""
                                                            alt="Thumbnail">
                                                    @else
                                                        <img src="{{ asset('path/to/default-image.jpg') }}"
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
                                                <div class="d-flex justify-content-between text-center mb-2">

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
                        class="btn btn-light shadow position-absolute top-50 start-0 translate-middle-y ms-2">
                        <i class="bx bx-chevron-left"></i>
                    </button>

                    <button id="scrollRight"
                        class="btn btn-light shadow position-absolute top-50 end-0 translate-middle-y me-2">
                        <i class="bx bx-chevron-right"></i>
                    </button>

                </div>

            </div>
        </section>
    @endif
    @include('sweetalert::alert')
@endsection
