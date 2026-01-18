@extends('layout.user')
@section('title', 'detail')
@section('content')
    <br><br>
    <style>
        /* Prevent layout shift when modals open/close by reserving scrollbar gutter */
        html { overflow-y: scroll; scrollbar-gutter: stable; }
        /* Prevent bootstrap from adding body padding which causes horizontal shift */
        body.modal-open { padding-right: 0 !important; margin-right: 0 !important; }
    </style>
    <section class="py-4 mt-5">
        <div class="container">
            <!-- Back Button -->
            <div class="header-title">
                <a href="{{ route('landing.cars', $product->brand->slug) }}" class="text-decoration-none text-dark me-2">
                    <i class="bx bx-arrow-back me-2"></i> Detail
                </a>
            </div>
            {{-- TAMPILAN DETAIL UNTUK VEHICLE --}}
            @if ($product->category_position_id == 1)
                <div class="row g-4 mt-2">
                    <!-- Gambar Utama -->
                    <div class="col-12">
                        <div id="productCarousel" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
                            <div class="carousel-inner bg-light rounded" style="max-height: 395px;">
                                @forelse ($product->images as $key => $image)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->image) }}"
                                            class="d-block mx-auto img-fluid p-4"
                                            style="max-height: 395px; object-fit: contain;" alt="Image {{ $key }}">
                                    </div>
                                @empty
                                    <div class="carousel-item active">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                            class="d-block mx-auto img-fluid p-4"
                                            style="max-height: 395px; object-fit: contain;" alt="Thumbnail">
                                    </div>
                                @endforelse
                            </div>

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Thumbnail -->
                            <div class="col-12">
                        <div class="image-row-5">
                            @foreach ($product->images->take(5) as $key => $image)
                                <div class="thumb-box" onclick="productCarouselTo({{ $key }})">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="" class="thumb-img">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <script>
                        function productCarouselTo(index) {
                            const el = document.getElementById('productCarousel');
                            if (!el) return;

                            // Try using Bootstrap API first (smooth, keeps internal state)
                            try {
                                const car = bootstrap.Carousel.getOrCreateInstance(el);
                                if (car && typeof car.to === 'function') {
                                    car.to(index);
                                    return;
                                }
                            } catch (e) {
                                // ignore and fallback to manual switch
                            }

                            // Fallback: manually toggle active class on carousel items
                            const items = el.querySelectorAll('.carousel-item');
                            items.forEach((it, i) => {
                                if (i === index) {
                                    it.classList.add('active');
                                } else {
                                    it.classList.remove('active');
                                }
                            });
                        }
                    </script>
                </div>

                <!-- Detail Kendaraan -->
                <div class="mt-4">
                    <h5 class="mb-1">{{ $product->model_name }}</h5>
                    <h4 class="text-danger fw-bold">
                        IDR {{ number_format($product->price, 0, ',', '.') }}
                    </h4>
                </div>

                <!-- Tombol -->
                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <a href="{{ route('landing.product.testdrive', $product->slug) }}"
                            class="btn btn-outline-info w-100 py-2 d-flex justify-content-center align-items-center fw-bold"
                            style="--bs-btn-hover-color:#fff;">
                            <i class="bx bx-car me-2"></i>
                            Test Drive
                        </a>
                        <style>
                            .btn-outline-info:hover,
                            .btn-outline-info:hover:focus,
                            .btn-outline-info:hover:active {
                                color: #fff !important;
                            }
                        </style>
                    </div>

                    <div class="col-md-6">
                        @if (Auth::check())
                            <button type="button" class="btn btn-outline-success w-100 py-2 add-to-cart-btn fw-bold"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->model_name }}"
                                data-price="{{ $product->price }}"
                                data-image="{{ asset('storage/' . ($product->images->first()->image ?? $product->thumbnail)) }}">
                                <i class="bx bx-cart me-2"></i> Add to Cart
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-success w-100 py-2 fw-bold">
                                <i class="bx bx-cart me-2"></i> Add to Cart
                            </a>
                        @endif
                    </div>

                    <div class="col-12">
                        <button class="btn text-white w-100 py-2 order-btn fw-bold" id="orderBtn">
                            Order Now
                        </button>


                        <script>
                            document.getElementById('orderBtn').addEventListener('click', function() {
                                window.location.href = "{{ route('order.show', $product->slug) }}";
                            });
                        </script>
                    </div>
                </div>
            @endif
            @if ($product->category_position_id == 2 || $product->category_position_id == 3 || $product->category_position_id == 4)
                <section class="pt-5">
                    <div class="container">
                        <div class="row g-4">

                            <!-- LEFT: IMAGE + THUMBNAILS -->
                            <div class="col-lg-6">

                                <!-- Logo Copilot -->
                                {{-- <div class="mb-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3b/Microsoft_365_Copilot_Icon.svg/800px-Microsoft_365_Copilot_Icon.svg.png"
                                        alt="Copilot" width="120">
                                </div> --}}

                                <!-- Main Image -->
                                <div class="border rounded-4 overflow-hidden shadow-sm p-3 mb-3 text-center">
                                    <div style="width: 100%; height: 250px; display: flex; justify-content: center;">
                                        @if ($product->images->isNotEmpty())
                                            <img id="mainImage"
                                                src="{{ asset('storage/' . $product->images->first()->image) }}"
                                                alt="{{ $product->model_name }}"
                                                style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                        @endif
                                    </div>
                                </div>
                                <!-- Thumbnails -->
                                <div class="d-flex gap-3 justify-content-center">
                                    @foreach ($product->images->take(6) as $image)
                                        <img src="{{ asset('storage/' . $image->image) }}" class="thumb border rounded p-2"
                                            width="70" onclick="document.getElementById('mainImage').src=this.src">
                                    @endforeach
                                </div>
                            </div>

                            <!-- RIGHT: PRODUCT DETAILS -->
                            <div class="col-lg-6">
                                <h3 class="fw-bold">{{ $product->model_name }}</h3>
                                <h4 class="fw-bold text-primary mb-3" style="color:#00AEEF !important;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </h4>
                                <p class="text-secondary">
                                    {!! $product->description !!}
                                </p>
                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-center gap-4 mt-4 flex-wrap">

                                    @if (Auth::check())
                                        <button
                                            class="btn btn-outline-primary px-5 py-3 rounded-pill fs-5 fw-bold add-to-cart-btn"
                                            data-id="{{ $product->id }}" data-name="{{ $product->model_name }}"
                                            data-price="{{ $product->price }}"
                                            data-image="{{ asset('storage/' . $product->images->first()->image) }}">
                                            <i class="bx bx-cart-alt me-2"></i>
                                            Keranjang
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="btn btn-outline-primary px-5 py-3 rounded-pill fs-5 fw-bold">
                                            <i class="bx bx-cart-alt me-2"></i>
                                            Keranjang
                                        </a>
                                    @endif

                                    <a href="{{ route('order.show', $product->slug) }}"
                                        class="btn px-5 py-3 rounded-pill text-white fs-5 fw-bold"
                                        style="background: linear-gradient(to right, #00A6FF, #00D8A4); border: none;">
                                        Pesan Sekarang
                                    </a>

                                </div>


                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <!-- Top Navigation -->
            <style>
                .tech-nav{
                    background: #fff;
                    padding-top: .5rem;
                    padding-bottom: .5rem;
                    transition: box-shadow .2s;
                }

                .tech-nav.is-fixed{
                    position: fixed !important;
                    top: var(--nav-top, 120px) !important; /* set by JS to match navbar height */
                    left: 0;
                    right: 0;
                    z-index: 1020; /* lower than navbar so navbar won't overlap */
                    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
                }
            </style>

            <ul class="nav justify-content-center border-bottom pb-2 mb-4 tech-nav">
                <!-- Tab -->
                @if ($product->category_id == 1)
                    <li class="nav-item">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Technology</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="feature-tab" href="javascript:void(0)">Feature</a>
                    </li>
                @endif
                @if (in_array($product->category_id, [1, 2]))
                    <li class="nav-item">
                        <a class="nav-link" id="color-tab" href="javascript:void(0)">Color</a>
                    </li>
                @endif

                @if ($product->category_id == 1)
                    <li class="nav-item">
                        <a class="nav-link" id="specification-tab" href="javascript:void(0)">Specification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="credit-tab" href="javascript:void(0)">Credit Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="other-tab" href="javascript:void(0)">Other</a>
                    </li>
                @endif
                @if ($product->category_id == 2)
                    <li class="nav-item ">
                        <a class="nav-link" id="power-tab" href="javascript:void(0)">Power</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="dimensi-tab" href="javascript:void(0)">Dimensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sistemsuspensi-tab" href="javascript:void(0)">Sistem Suspensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="fitur-tab" href="javascript:void(0)">Fitur</a>
                    </li>
                @endif
            </ul>

                @if (in_array($product->category_position_id, [2, 3, 4]))

                <section class="py-5 container">
                    <div class="row gx-5">
                        @foreach ($details as $detail)
                            <div class="col-6 text-start mb-3">
                                <p class="text-secondary fs-5 fw-bold mb-0">
                                    {{ $detail->label }}
                                </p>
                            </div>

                            <div class="col-6 text-start mb-3">
                                <p class="text-secondary mb-0">
                                    {!! $detail->nilai !!}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const nav = document.querySelector('.tech-nav');
                    if (!nav) return;

                    // detect navbar/header height
                    const header = document.querySelector('.navbar') || document.querySelector('header') || document.querySelector('.header-title');
                    const headerHeight = header ? Math.ceil(header.getBoundingClientRect().height) : 120;

                    // set CSS variable for top offset used by fixed class
                    nav.style.setProperty('--nav-top', headerHeight + 'px');

                    const navRect = nav.getBoundingClientRect();
                    const navOffsetTop = navRect.top + window.pageYOffset;
                    const navHeight = navRect.height;
                    let placeholder = null;

                    function makeFixed() {
                        if (nav.classList.contains('is-fixed')) return;
                        // create placeholder to avoid layout jump
                        placeholder = document.createElement('div');
                        placeholder.style.height = navHeight + 'px';
                        nav.parentNode.insertBefore(placeholder, nav);

                        // set nav fixed and match width/left to original position
                        const rect = nav.getBoundingClientRect();
                        nav.style.width = rect.width + 'px';
                        nav.style.left = rect.left + 'px';
                        nav.classList.add('is-fixed');
                    }

                    function removeFixed() {
                        if (!nav.classList.contains('is-fixed')) return;
                        nav.classList.remove('is-fixed');
                        nav.style.width = '';
                        nav.style.left = '';
                        if (placeholder) { placeholder.remove(); placeholder = null; }
                    }

                    function onScroll() {
                        const scrollY = window.pageYOffset || document.documentElement.scrollTop;
                        if (scrollY > navOffsetTop - headerHeight) {
                            makeFixed();
                        } else {
                            removeFixed();
                        }
                    }

                    window.addEventListener('scroll', onScroll, { passive: true });
                    window.addEventListener('resize', function() {
                        // recompute measurements
                        removeFixed();
                        nav.style.setProperty('--nav-top', (header ? Math.ceil(header.getBoundingClientRect().height) : 120) + 'px');
                    });

                    onScroll();
                });
            </script>

            @if ($product->category_id == 1)
                <br><br>
                <!-- Title -->
                <div class="d-flex align-items-center mb-5">
                    <!-- Tujuan scroll -->
                    <h4 id="technology-heading" class="fw-bold me-3 mb-0">
                        {{ $product->brand->name_brand ?? 'Unknown Brand' }} Technology
                    </h4>
                    <div class="flex-grow-1 line-tech"></div>
                </div>

                <div class="row align-items-center g-4 mt-1">
                    <!-- Left Text -->
                    <div class="col-lg-6 col-md-12">
                        @forelse($product->technologies as $index => $tech)
                            <div class="tab-content {{ $index === 0 ? 'active' : '' }}" id="tech-{{ $index }}">
                                <h5 class="fw-bold" style="color:#00C092;">{{ $tech->name }}</h5>
                                <p class="text-secondary" style="line-height: 1.7;">
                                    {!! $tech->description !!}
                                </p>
                            </div>
                        @empty
                            <p class="text-muted"></p>
                        @endforelse
                    </div>

                    <!-- Right Image -->
                    <div class="col-lg-6 col-md-12">
                        @forelse($product->technologies as $index => $tech)
                            @if (!empty($tech->image) && file_exists(public_path('storage/' . $tech->image)))
                                <img src="{{ asset('storage/' . $tech->image) }}"
                                    class="img-fluid rounded shadow-sm tech-image {{ $index === 0 ? 'active' : '' }}"
                                    alt="{{ $tech->name }}" id="tech-image-{{ $index }}"
                                    style="display: {{ $index === 0 ? 'block' : 'none' }};">
                            @endif
                        @empty
                            <p class="text-muted"></p>
                        @endforelse
                    </div>

                </div>

                <!-- Bottom Nav Tabs -->
                <div class="d-flex gap-4 mt-4 tech-tabs">
                    @foreach ($product->technologies as $index => $tech)
                        <span class="tab-item {{ $index === 0 ? 'active' : '' }}" data-target="tech-{{ $index }}"
                            data-image="tech-image-{{ $index }}">
                            {{ $tech->name }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- INI FEATURE UNTUK CATEGORI 1 --}}
    @if ($product->category_id == 1)
        <section class="py-5">
            <div class="container">
                <!-- Title -->
                <div class="d-flex align-items-center mb-5">
                    <h4 id="feature-heading" class="fw-bold  me-3 mb-0">
                        {{ $product->brand->name_brand ?? 'Unknown Brand' }} Feature
                    </h4>

                    <div class="flex-grow-1 line-tech"></div>
                </div>
                <div class="row align-items-center g-4 mt-1">
                    <!-- Left Text -->
                    <div class="col-lg-6 col-md-12">
                        <h4 class="mb-5" id="feature-description">
                            @if ($product->features->isNotEmpty())
                                {!! $product->features->first()->description !!}
                            @endif
                        </h4>
                        @forelse($product->features as $index => $feature)
                            <h5 class="feature-item {{ $index === 0 ? 'active' : '' }}"
                                data-index="{{ $index }}">
                                {{ $feature->name }}
                            </h5>
                        @empty
                            <p class="text-muted"></p>
                        @endforelse
                    </div>
                    <!-- Right Image -->
                    <div class="col-lg-6 col-md-12">
                        @forelse($product->features as $index => $feature)
                            @if (!empty($feature->image) && file_exists(public_path('storage/' . $feature->image)))
                                <img src="{{ asset('storage/' . $feature->image) }}"
                                    class="img-fluid rounded shadow-sm feature-image {{ $index === 0 ? 'active' : '' }}"
                                    alt="{{ $feature->name }}" id="feature-image-{{ $index }}"
                                    style="display: {{ $index === 0 ? 'block' : 'none' }};">
                            @endif
                        @empty
                            <p class="text-muted"></p>
                        @endforelse
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const featureItems = document.querySelectorAll(".feature-item");
                        const featureImages = document.querySelectorAll(".feature-image");
                        const descriptionElement = document.getElementById("feature-description");

                        featureItems.forEach(item => {
                            item.addEventListener("click", function() {
                                // Ambil index
                                const index = this.dataset.index;

                                // --- Update Active Class di daftar fitur ---
                                featureItems.forEach(i => i.classList.remove("active"));
                                this.classList.add("active");

                                // --- Update Teks Deskripsi ---
                                const selectedFeature = @json($product->features);
                                descriptionElement.innerHTML = selectedFeature[index].description;

                                // --- Update Gambar ---
                                featureImages.forEach(img => img.style.display = "none");

                                const activeImage = document.getElementById(`feature-image-${index}`);
                                if (activeImage) {
                                    activeImage.style.display = "block";
                                }
                            });
                        });
                    });
                </script>

            </div>
        </section>
    @endif

    @if (in_array($product->category_id, [1, 2]))
        <section class="py-5">
            <div class="container">

                <!-- Title -->
                <div class="d-flex align-items-center mb-5">
                    <h4 class="fw-bold me-3 mb-0" id="color-heading">
                        {{ $product->brand->name_brand ?? 'Unknown Brand' }} Color</h4>
                    <div class="flex-grow-1 line-tech"></div>
                </div>

                {{-- COLOR --}}
                @if ($product->colors->isNotEmpty())
                    <div class="row align-items-center g-4">
                        <div class="col-lg-5">
                            <div class="p-4 border rounded-4 shadow-sm text-center">

                                <!-- Warna -->
                                <div class="d-flex flex-column align-items-center">
                                    <div class="d-flex flex-wrap justify-content-center gap-4 mb-3 color-container">
                                        @forelse($product->colors as $index => $color)
                                            <div class="color-circle {{ $index === 0 ? 'active' : '' }}"
                                                data-index="{{ $index }}" data-name="{{ $color->name }}"
                                                data-image="{{ asset('storage/' . $color->image) }}"
                                                style="background: linear-gradient(to bottom, #000 50%, {{ $color->hex }} 50%);">
                                            </div>
                                        @empty
                                            <p class="text-muted"></p>
                                        @endforelse
                                    </div>

                                    <p class="fw-semibold fs-6 mt-2" id="color-name">
                                        @if ($product->colors->isNotEmpty())
                                            {{ $product->colors->first()->name }}
                                        @endif
                                    </p>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="row mt-4">
                                <div class="col-6 pe-1">
                                    <a href="{{ route('landing.product.testdrive', $product->slug) }}"
                                        class="btn btn-outline-primary w-100 py-2 rounded-3">
                                        Test Drive
                                    </a>

                                </div>
                                <div class="col-6 ps-1">
                                    <a href="{{ route('order.show', $product->slug) }}"
                                        class="btn btn-primary w-100 py-2 rounded-3"
                                        style="background: linear-gradient(to right, #0094ff, #00e6a8); border: none;">
                                        Order Now
                                    </a>

                                </div>
                            </div>
                        </div>

                        <!-- Gambar Mobil -->
                        <div class="col-lg-7 text-center">
                            <img src="@if ($product->colors->isNotEmpty()) {{ asset('storage/' . $product->colors->first()->image) }} @endif"
                                class="img-fluid car-preview" id="car-preview" alt="Car"
                                style="max-height: 250px; width: auto;">
                        </div>


                    </div>
                @endif
            </div>
        </section>
    @endif

    @if ($product->category_id == 1)
        <section class="py-5 container">
            <div class="d-flex align-items-center mb-5">
                <h4 class="fw-bold me-3 mb-0" id="specification-heading">
                    {{ $product->brand->name_brand ?? 'Unknown Brand' }} Specification</h4>
                <div class="flex-grow-1 line-tech"></div>
            </div>

            <div class="container spec-box">
                @php
                    $specSections = $product->specifications->pluck('title')->unique();
                @endphp

                <!-- Tabs -->
                <ul class="nav justify-content-center pb-2 mb-4 tech-nav" id="spec-tabs">
                    @foreach ($specSections as $index => $title)
                        <li class="nav-item">
                            <a class="nav-link {{ $index === 0 ? 'active' : '' }}" href="#"
                                data-index="{{ $index }}">
                                {{ $title }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="gradient-line my-4 mx-auto"></div>

                <!-- Specification Content -->
                <div class="spec-content ">
                    @foreach ($specSections as $index => $title)
                        <div class="spec-list {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"
                            style="{{ $index === 0 ? '' : 'display:none;' }}">
                            @foreach ($product->specifications->where('title', $title) as $spec)
                                <div class="spec-item">
                                    <span class="spec-title">{{ $spec->label }}</span>
                                    <span class="spec-value">{{ $spec->value }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <style>
                .spec-item {
                    display: grid !important;
                    grid-template-columns: 500px 1fr !important;
                    /* kolom sejajar */
                    text-align: left !important;
                }

                .spec-title {
                    text-align: left !important;
                }

                .spec-value {
                    text-align: left !important;
                    justify-self: start !important;
                }
            </style>
            <!-- Tab JS -->
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const tabs = document.querySelectorAll("#spec-tabs .nav-link");
                    const contents = document.querySelectorAll(".spec-list");

                    tabs.forEach(tab => {
                        tab.addEventListener("click", function(e) {
                            e.preventDefault();
                            const index = this.dataset.index;

                            // Hapus active semua tab
                            tabs.forEach(t => t.classList.remove("active"));
                            // Sembunyikan semua konten
                            contents.forEach(c => {
                                c.classList.remove("active");
                                c.style.display = "none";
                            });

                            // Aktifkan tab yang diklik
                            this.classList.add("active");
                            // Tampilkan konten sesuai index
                            const activeContent = document.querySelector(
                                `.spec-list[data-index="${index}"]`);
                            activeContent.classList.add("active");
                            activeContent.style.display = "block";
                        });
                    });
                });
            </script>
        </section>
        <section class="credit-section">
                <div class="container text-center py-5">
                    <h5 class="credit-title" id="credit-heading">CREDIT CALCULATOR</h5>
                    <p class="powered">Powered by <span>OKKEV FINANCE</span></p>
                    <p class="sub-text">
                        Our internal loans guarantee flexible financing options at competitive rates.
                    </p>
                </div>

                <div class="credit-box">
                    <div class="container py-5">
                        <h5 class="text-center credit-subtitle">Monthly Installment Budget</h5>
                        <h3 class="text-center credit-amount" id="creditAmount">Rp 0 / Months</h3>

                        <p class="text-center desc-text mt-3">
                            Calculate monthly installments that fit your budget by setting the down
                            payment and loan period.
                        </p>

                        <div class="row g-4 mt-4">

                            <div class="col-md-6">
                                <label class="credit-label">Car Price</label>
                                <input id="carPrice" type="text" class="form-control credit-input" value="{{ 'Rp ' . number_format($product->price,0,',','.') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="credit-label">Interest Rate (Annual %)</label>
                                <input id="interestRate" type="text" class="form-control credit-input" value="10.96">
                            </div>

                            <div class="col-md-6">
                                <label class="credit-label">Loan Amount</label>
                                <input id="loanAmount" type="text" class="form-control credit-input" value="{{ 'Rp ' . number_format($product->price,0,',','.') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="credit-label">Loan Period (Years)</label>
                                <select id="loanPeriod" class="form-control credit-input">
                                    @for ($y = 1; $y <= 6; $y++)
                                        <option value="{{ $y }}">{{ $y }} Tahun</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="credit-label">First Payment (Down Payment)</label>
                                <input id="firstPayment" type="text" class="form-control credit-input" value="0">
                            </div>

                        </div>

                        <div class="mt-4 note-box">
                            <p><strong>Important note:</strong> Requirements may vary from bank to bank. This calculation is
                                purely a simulation.</p>
                            <p>For cars outside Jakarta, the above calculation is not binding. Additional shipping costs are
                                not included.</p>
                            <p>The above calculation applies to a minimum down payment of IDR 10,000,000.</p>
                        </div>

                    </div>
                </div>
            </section>

            <script>
                (function(){
                    const q = (s) => document.querySelector(s);
                    const parseCurrency = (v) => {
                        if (v === null || v === undefined) return 0;
                        // strip everything except digits and minus (remove thousands separators)
                        const n = String(v).replace(/[^0-9\-]/g, '');
                        return n === '' ? 0 : Number(n);
                    };

                    const formatIDR = (value) => {
                        if (!isFinite(value)) return 'Rp 0';
                        return 'Rp ' + Number(value).toLocaleString('id-ID');
                    };

                    const carPriceEl = q('#carPrice');
                    const interestEl = q('#interestRate');
                    const loanAmountEl = q('#loanAmount');
                    const loanPeriodEl = q('#loanPeriod');
                    const firstPaymentEl = q('#firstPayment');
                    const creditAmountEl = q('#creditAmount');

                    const compute = () => {
                        const loanAmount = parseCurrency(loanAmountEl.value);
                        const firstPayment = parseCurrency(firstPaymentEl.value);
                        const principal = Math.max(0, loanAmount - firstPayment);
                        const annualRate = parseFloat(String(interestEl.value).replace(/[^0-9\.\-]/g,'')) || 0;
                        const months = (parseInt(loanPeriodEl.value) || 1) * 12;
                        const monthlyRate = annualRate / 100 / 12;

                        let monthly = 0;
                        if (principal <= 0 || months <= 0) {
                            monthly = 0;
                        } else if (monthlyRate === 0) {
                            monthly = principal / months;
                        } else {
                            monthly = principal * (monthlyRate) / (1 - Math.pow(1 + monthlyRate, -months));
                        }

                        creditAmountEl.textContent = formatIDR(Math.round(monthly)) + ' / Months';
                    };

                    // attach listeners (debounced)
                    let t;
                    const debounceCompute = () => { clearTimeout(t); t = setTimeout(compute, 250); };

                    [carPriceEl, interestEl, loanAmountEl, loanPeriodEl, firstPaymentEl].forEach(el => {
                        if (!el) return;
                        el.addEventListener('input', debounceCompute);
                        el.addEventListener('change', debounceCompute);
                    });

                    // Auto-format currency inputs on blur (keeps editing easy)
                    [carPriceEl, loanAmountEl, firstPaymentEl].forEach(el => {
                        if (!el) return;
                        el.addEventListener('blur', function() {
                            const v = parseCurrency(this.value);
                            this.value = formatIDR(v);
                        });
                        // on focus, show raw number for easier editing
                        el.addEventListener('focus', function() {
                            this.value = parseCurrency(this.value) || '';
                        });
                    });

                    // initialize fields formatting
                    [carPriceEl, loanAmountEl, firstPaymentEl].forEach(el => {
                        if (!el) return;
                        el.value = formatIDR(parseCurrency(el.value));
                    });

                    compute();
                })();
            </script>
    @endif

    @if ($product->category_id == 2)
        {{-- POWER --}}
        <section class="py-5 container">
            <div class="d-flex align-items-center mb-4">
                <h4 class="fw-bold me-3 mb-0" id="power-heading">Power (Motor Penggerak)</h4>
                <div class="flex-grow-1 border-top"></div>
            </div>

            <div class="row gx-5">

                <!-- LABEL -->
                <div class="col-6 text-start">
                    @foreach ($powers as $index => $power)
                        <p class="mb-3 text-secondary">{{ $power->label }}</p>
                    @endforeach
                </div>

                <!-- VALUE -->
                <div class="col-6 text-start">
                    @foreach ($powers as $index => $power)
                        <p class="mb-3 text-secondary">{{ $power->nilai }}</p>
                    @endforeach
                </div>

            </div>
        </section>
        {{-- DIMENSI --}}
        <section class="py-5 container">
            <div class="d-flex align-items-center mb-4">
                <h4 class="fw-bold me-3 mb-0" id="dimensi-heading">Dimensi</h4>
                <div class="flex-grow-1 border-top"></div>
            </div>

            <div class="row gx-5">

                <!-- LABEL -->
                <div class="col-6 text-start">
                    @foreach ($dimensis as $index => $dimensi)
                        <p class="mb-3 text-secondary">{{ $dimensi->label }}</p>
                    @endforeach
                </div>

                <!-- VALUE -->
                <div class="col-6 text-start">
                    @foreach ($dimensis as $index => $dimensi)
                        <p class="mb-3 text-secondary">{{ $dimensi->nilai }}</p>
                    @endforeach
                </div>

            </div>
        </section>
        {{-- SUSPENSI --}}
        <section class="py-5 container">
            <div class="d-flex align-items-center mb-4">
                <h4 class="fw-bold me-3 mb-0" id="sistemsuspensi-heading">Sistem Suspensi</h4>
                <div class="flex-grow-1 border-top"></div>
            </div>

            <div class="row gx-5">

                <!-- LABEL -->
                <div class="col-6 text-start">
                    @foreach ($suspensis as $index => $suspensi)
                        <p class="mb-3 text-secondary">{{ $suspensi->label }}</p>
                    @endforeach
                </div>

                <!-- VALUE -->
                <div class="col-6 text-start">
                    @foreach ($suspensis as $index => $suspensi)
                        <p class="mb-3 text-secondary">{{ $suspensi->nilai }}</p>
                    @endforeach
                </div>

            </div>
        </section>
        {{-- FITUR --}}
        <section class="py-5 container">
            <div class="d-flex align-items-center mb-4">
                <h4 class="fw-bold me-3 mb-0" id="fitur-heading">Fitur</h4>
                <div class="flex-grow-1 border-top"></div>
            </div>

            <div class="row gx-5">

                <!-- LABEL -->
                <div class="col-6 text-start">
                    @foreach ($fiturs as $index => $fitur)
                        <p class="mb-3 text-secondary">{{ $fitur->label }}</p>
                    @endforeach
                </div>

                <!-- VALUE -->
                <div class="col-6 text-start">
                    @foreach ($fiturs as $index => $fitur)
                        <p class="mb-3 text-secondary">{{ $fitur->nilai }}</p>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    @if ($product->category_id == 1)
        <section>
            <div class="container mt-5">
                <h4 id="other-heading">There are still other options</h4>
                <h6 class="mb-5">if you are not satisfied with the above vehicles.</h6>
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
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
                                                style="max-height: 230px; object-fit: contain;" alt="Thumbnail">
                                        @else
                                            <img src="{{ asset('path/to/default-image.jpg') }}" alt="No Image"
                                                class="img-fluid mb-2 vehicle-img w-100 p-4">
                                        @endif
                                    </div>
                                </div>
                                <!-- Detail -->
                                <div class="card-body p-3 bg-white rounded-bottom">
                                    <h6 class="fw-semibold text-dark mb-0">{{ $product->brand->name_brand }}</h6>
                                    <p class="fw-bold text-secondary small mb-1">{{ $product->model_name }}</p>
                                    <hr class="my-2">
                                    <!-- Icons -->
                                    <div class="d-flex justify-content-between text-center mb-2">
                                        <div class="icon-box flex-fill d-flex flex-column align-items-center">
                                            <img src="{{ asset('front_end/assets/images/3.png') }}" width="22"
                                                class="mb-1">
                                            <p style="font-weight: 600;"class="small text-black mb-0 fw-semibold">
                                                {{ $product->miles }} Miles</p>
                                        </div>

                                        <div class="icon-box flex-fill d-flex flex-column align-items-center">
                                            <img src="{{ asset('front_end/assets/images/2.png') }}" width="23"
                                                class="mb-1">
                                            <p style="font-weight: 600;" class="small text-black mb-0 fw-semibold">
                                                Electric</p>
                                        </div>

                                        <div class="icon-box flex-fill d-flex flex-column align-items-center">
                                            <img src="{{ asset('front_end/assets/images/1.png') }}" width="21"
                                                class="mb-1">
                                            <p style="font-weight: 600;" class="small text-black mb-0 fw-semibold">
                                                {{ $product->seats }} Seat</p>
                                        </div>
                                    </div>
                                    <hr class="my-2">

                                    <!-- Price & Detail Link -->
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <p class="fw-bold text-danger mb-0">
                                            IDR {{ number_format($product->price, 0, ',', '.') }}
                                        </p>

                                        <a href="{{ route('landing.product', ['brandSlug' => Str::slug($product->brand), 'productSlug' => $product->slug]) }}"
                                            class="text-decoration-none fw-semibold d-flex align-items-center"
                                            style="color: #30445C !important;">
                                            Detail
                                            <img src="{{ asset('front_end/assets/images/icon.png') }}" width="10"
                                                class="mb-1 ms-2">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Tidak ada produk untuk brand ini.</p>
                    @endforelse
                </div>

            </div>
        </section>
    @endif

    <script>
        const descriptionH4 = document.getElementById('feature-description');
        const featureImages = document.querySelectorAll('.feature-image');

        document.querySelectorAll('.feature-item').forEach(item => {
            item.addEventListener('click', function() {
                const index = this.dataset.index;

                // Update H4 dengan description feature sesuai index
                const feature = @json($product->features);
                descriptionH4.innerHTML = feature[index].description;

                // Hapus active dari semua H5
                document.querySelectorAll('.feature-item').forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                // Sembunyikan semua gambar dan tampilkan sesuai index
                featureImages.forEach(img => img.style.display = 'none');
                const img = document.getElementById(`feature-image-${index}`);
                if (img) img.style.display = 'block';
            });
        });
    </script>

    {{-- ini scrip untuk menambahkan cart  --}}
    {{-- <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseInt(this.dataset.price);
                const image = this.dataset.image;

                let existing = cart.find(p => p.id == id);
                if (existing) {
                    existing.qty += 1;
                } else {
                    cart.push({
                        id,
                        name,
                        price,
                        image,
                        qty: 1
                    });
                }

                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartBadge();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: `${name} ditambahkan ke keranjang`,
                    timer: 1200,
                    showConfirmButton: false
                });
            });
        });

        function updateCartBadge() {
            const count = cart.reduce((sum, item) => sum + item.qty, 0);
            document.getElementById('cartCount').textContent = count;
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tabs = document.querySelectorAll(".tech-nav .nav-link");

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {
                    const text = this.innerText.trim();

                    // Cari H4 atau H5 yang mengandung teks tab
                    const target = Array.from(document.querySelectorAll("h4, h5"))
                        .find(el => el.innerText.toLowerCase().includes(text.toLowerCase()));

                    if (target) {
                        const top = target.getBoundingClientRect().top + window.scrollY;
                        const offset = 120; // tinggi berhenti

                        window.scrollTo({
                            top: top - offset,
                            behavior: "smooth"
                        });
                    }
                });
            });
        });
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Modal: Pilih Warna -->
    <div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="colorModalLabel">Pilih Warna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($product->colors->isNotEmpty())
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-wrap gap-3 justify-content-center mb-3">
                                    @foreach($product->colors as $index => $color)
                                        <div class="modal-color-circle d-flex flex-column align-items-center text-center" data-color-id="{{ $color->id }}" data-name="{{ $color->name }}" data-image="{{ asset('storage/' . $color->image) }}">
                                            <div class="color-circle" style="width:56px;height:56px;border-radius:50%;background:linear-gradient(to bottom, #000 50%, {{ $color->hex }} 50%);border:1px solid #ddd;cursor:pointer;" data-index="{{ $index }}"></div>
                                            <div class="small mt-2">{{ $color->name }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-6 text-center">
                                <div class="p-3 border rounded-3">
                                    <img src="@if($product->colors->isNotEmpty()) {{ asset('storage/' . $product->colors->first()->image) }} @endif" id="modal-car-preview" class="img-fluid" style="max-height:180px; object-fit:contain; width:auto;">
                                </div>
                                <p class="fw-semibold fs-6 mt-2" id="modal-color-name">
                                    @if ($product->colors->isNotEmpty())
                                        {{ $product->colors->first()->name }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @else
                        <p>Tidak ada pilihan warna untuk produk ini.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmAddToCart">Tambah ke Keranjang</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.add-to-cart-btn');
            const colorModalEl = document.getElementById('colorModal');
            const colorModal = new bootstrap.Modal(colorModalEl);
            let currentProduct = {};

            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    currentProduct.id = this.dataset.id;
                    currentProduct.name = this.dataset.name || '{{ $product->model_name }}';
                    currentProduct.price = this.dataset.price || '{{ $product->price }}';
                    currentProduct.image = this.dataset.image || '{{ asset('storage/' . $product->thumbnail) }}';

                    colorModal.show();
                });
            });

            // Handle selection when clicking color circles inside modal
            colorModalEl.querySelectorAll('.modal-color-circle .color-circle').forEach(circle => {
                circle.addEventListener('click', function() {
                    // remove active from other circles
                    colorModalEl.querySelectorAll('.modal-color-circle').forEach(c => c.classList.remove('active'));
                    const parent = this.closest('.modal-color-circle');
                    parent.classList.add('active');

                    // update preview image and name
                    const img = parent.getAttribute('data-image');
                    const name = parent.getAttribute('data-name');
                    const preview = document.getElementById('modal-car-preview');
                    const nameEl = document.getElementById('modal-color-name');
                    if (preview) preview.src = img;
                    if (nameEl) nameEl.textContent = name;
                });
            });

            // ensure default selection when showing modal
            colorModalEl.addEventListener('shown.bs.modal', function() {
                const first = colorModalEl.querySelector('.modal-color-circle');
                if (first && !colorModalEl.querySelector('.modal-color-circle.active')) {
                    first.classList.add('active');
                    const img = first.getAttribute('data-image');
                    const name = first.getAttribute('data-name');
                    const preview = document.getElementById('modal-car-preview');
                    const nameEl = document.getElementById('modal-color-name');
                    if (preview) preview.src = img;
                    if (nameEl) nameEl.textContent = name;
                }
            });

            document.getElementById('confirmAddToCart').addEventListener('click', function() {
                const active = colorModalEl.querySelector('.modal-color-circle.active');
                const colorId = active ? active.getAttribute('data-color-id') : null;
                const colorName = active ? active.getAttribute('data-name') : null;

                // Kirim data ke backend
                fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: currentProduct.id,
                            product_name: currentProduct.name,
                            price: currentProduct.price,
                            image: currentProduct.image,
                            color_id: colorId,
                            color_name: colorName
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            try {
                                const dot = document.getElementById('cartDot');
                                if (dot) {
                                    if (typeof data.cart_count !== 'undefined') {
                                        dot.style.display = data.cart_count > 0 ? 'inline-block' : 'none';
                                    } else {
                                        dot.style.display = 'inline-block';
                                    }
                                }
                            } catch (e) {
                                console.warn('Could not update cart dot', e);
                            }

                            colorModal.hide();

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: currentProduct.name + ' telah ditambahkan ke keranjang.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message || 'Produk gagal ditambahkan ke keranjang.'
                            });
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menambahkan produk.'
                        });
                    });
            });
        });
    </script>

    {{-- <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseInt(this.dataset.price);
                const image = this.dataset.image;

                // Cek jika sudah ada
                let existing = cart.find(p => p.id == id);
                if (existing) {
                    existing.qty += 1;
                } else {
                    cart.push({
                        id,
                        name,
                        price,
                        image,
                        qty: 1
                    });
                }

                localStorage.setItem('cart', JSON.stringify(cart));

                // Update badge
                document.getElementById('cartCount').textContent = cart.reduce((a, b) => a + b.qty, 0);

                // SweetAlert notifikasi
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: `${name} ditambahkan ke keranjang`,
                    timer: 1200,
                    showConfirmButton: false
                });
            });
        });
    </script> --}}
    {{-- JS untuk switch tab dan gambar --}}
    <script>
        document.querySelectorAll('.tab-item').forEach(tab => {
            tab.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const imageId = this.dataset.image;

                // Hapus active dari semua tab dan konten teks
                document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                // Tambahkan active ke tab dan konten teks yang dipilih
                this.classList.add('active');
                document.getElementById(targetId).classList.add('active');

                // Sembunyikan semua gambar
                document.querySelectorAll('.tech-image').forEach(img => img.style.display = 'none');

                // Tampilkan gambar yang sesuai
                document.getElementById(imageId).style.display = 'block';
            });
        });
    </script>




    <script>
        const offset = 160; // jarak dari atas, sesuaikan dengan tinggi navbar

        const tabs = [{
                tabId: 'tech-tab',
                sectionId: 'technology-heading'
            },
            {
                tabId: 'feature-tab',
                sectionId: 'feature-heading'
            },
            {
                tabId: 'color-tab',
                sectionId: 'color-heading'
            },
            {
                tabId: 'specification-tab',
                sectionId: 'specification-heading'
            },
            {
                tabId: 'credit-tab',
                sectionId: 'credit-heading'
            },
            {
                tabId: 'other-tab',
                sectionId: 'other-heading'
            },
            {
                tabId: 'power-tab',
                sectionId: 'power-heading'
            },
            {
                tabId: 'dimensi-tab',
                sectionId: 'dimensi-heading'
            },
            {
                tabId: 'sistemsuspensi-tab',
                sectionId: 'sistemsuspensi-heading'
            },
            {
                tabId: 'fitur-tab',
                sectionId: 'fitur-heading'
            },
        ];

        tabs.forEach(item => {
            const tab = document.getElementById(item.tabId);
            if (tab) {
                tab.addEventListener('click', function() {
                    const element = document.getElementById(item.sectionId);
                    if (element) {
                        const topPos = element.getBoundingClientRect().top + window.pageYOffset - offset;
                        window.scrollTo({
                            top: topPos,
                            behavior: 'smooth'
                        });
                    }
                });
            }
        });
    </script>



@endsection
