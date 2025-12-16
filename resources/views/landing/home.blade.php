@extends('layout.user')
@section('title', 'Home')
@section('content')
    {{-- SECTION 1 --}}
    <section class="image-section ">
        <div class="container">
            <img src="{{ asset('front_end/assets/images/hero/wallpaper.png') }}" alt="Gambar Hero"
                class="img-fluid responsive-image">
            <div class="hero-content  mt-5">
                <h2 class="hero-title">Masa Depan Berkendara Dimulai dari Sini</h2>
                <p class="hero-subtitle">
                    Temukan kendaraan listrik impian Anda dari berbagai merek ternama.
                    Hemat energi, ramah lingkungan, dan siap mengubah cara Anda melaju.
                </p>
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
        .bg-union-img {
            position: absolute;
            top: 80px;
            /* Pas dengan bagian mulai background biru */
            transform: translateX(-50%);
            /* Tetap rata agar tidak kabur bentuknya */
            width: 128%;
            /* Melebar pas seperti contoh */
            height: 65%;
            z-index: 0;
        }

        .why-choose-us-section .container {
            position: relative;
            z-index: 2;
            /* Konten di depan gambar */
        }

        .why-choose-us-section {
            padding: 80px 0;
            overflow: hidden;
            /* Biar gambar tidak keluar area */
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
                                                    class="d-block mx-auto img-fluid p-4"
                                                    style="" alt="Thumbnail">
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
