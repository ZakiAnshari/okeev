@extends('layout.user')
@section('title', 'detail')
@section('content')
    <br><br>
    <section class="py-4 mt-5">
        <div class="container">

            <!-- Back Button -->
            <div class="header-title">
                @if (in_array($product->category_id, [1, 2]))
                    <a href="{{ route('landing.cars', $product->brand->slug) }}" class="text-decoration-none text-dark me-2">
                        <i class="bx bx-arrow-back me-2"></i> Detail Kendaraan
                    </a>
                @endif
                @if ($product->category_id == 3)
                    <a href="{{ route('landing.cars', $product->brand->slug) }}" class="text-decoration-none text-dark me-2">
                        <i class="bx bx-arrow-back me-2"></i> Detail Laptop
                    </a>
                @endif
                @if ($product->category_id == 4)
                    <a href="{{ route('landing.cars', $product->brand->slug) }}" class="text-decoration-none text-dark me-2">
                        <i class="bx bx-arrow-back me-2"></i> Detail Laptop
                    </a>
                @endif
            </div>
            {{-- TAMPILAN DETAIL --}}
            @if (in_array($product->category_id, [1, 2]))
                <div class="row g-4 mt-2 align-items-start">

                    <!-- Gambar Utama -->
                    <div class="col-12 col-lg-9">
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" style="max-height: 395px; background-color: #f8f9fa;">
                                <!-- background supaya terlihat rapi -->
                                @foreach ($product->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->image) }}" class="d-block mx-auto rounded"
                                            alt="{{ $product->model_name }}"
                                            style="object-fit: contain; max-height: 395px; ">
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <!-- Thumbnail -->
                    <div class="col-12 col-lg-3">
                        <div class="thumb-container">
                            @foreach ($product->images->skip(1)->take(3) as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" class="thumbnail-img"
                                    alt="{{ $product->model_name }}">
                            @endforeach
                        </div>
                    </div>
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
                            class="btn btn-outline-info w-100 py-2 d-flex justify-content-center align-items-center">
                            <i class="bx bx-car me-2"></i>
                            Test Drive
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="/cart"
                            class="btn btn-outline-success w-100 py-2 d-flex justify-content-center align-items-center">
                            <i class="bx bx-cart me-2"></i>
                            Add to Cart
                        </a>

                    </div>

                    <div class="col-12">
                        <button class="btn text-white w-100 py-2 order-btn">
                            Order Now
                        </button>
                    </div>
                </div>
            @endif
            @if (in_array($product->category_id, [3, 4]))
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
                                <div class="d-flex gap-3 mt-4">
                                    <button class="btn btn-outline-primary px-4 py-2 rounded-pill">
                                        <i class="bx bx-cart-alt me-2"></i>
                                        Keranjang
                                    </button>

                                    <button class="btn px-4 py-2 rounded-pill text-white"
                                        style="background: linear-gradient(to right, #00A6FF, #00D8A4); border: none;">
                                        Pesan Sekarang
                                    </button>
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
            <ul class="nav justify-content-center border-bottom pb-2 mb-4 tech-nav">
                <!-- Tab -->
                @if ($product->category_id == 1)
                    <li class="nav-item">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Technology</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Feature</a>
                    </li>
                @endif
                @if (in_array($product->category_id, [1, 2]))
                    <li class="nav-item">
                        <a class="nav-link" id="color-tab" href="javascript:void(0)">Color</a>
                    </li>
                @endif

                @if ($product->category_id == 1)
                    <li class="nav-item">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Specification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Credit Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Other</a>
                    </li>
                @endif
                @if ($product->category_id == 2)
                    <li class="nav-item ">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Power</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Dimensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Sistem Suspensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tech-tab" href="javascript:void(0)">Fitur</a>
                    </li>
                @endif

            </ul>

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
            </script>

            @if (in_array($product->category_id, [3, 4]))

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
        </div>
    </section>


    {{-- INI FEATURE UNTUK CATEGORI 1 --}}
    @if ($product->category_id == 1)
        <section class="py-5">
            <div class="container">
                <!-- Title -->
                <div class="d-flex align-items-center mb-5">
                    <h4 class="fw-bold me-3 mb-0"> {{ $product->brand->name_brand ?? 'Unknown Brand' }} Feature</h4>
                    <div class="flex-grow-1 line-tech"></div>
                </div>
                <style>
                    .line-tech {
                        height: 2px;
                        background: #DADADA;
                    }

                    .tech-nav {
                        gap: 50px;
                        /* boleh disesuaikan */
                    }
                </style>

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
                    <style>
                        .feature-item {
                            /* warna default */
                            cursor: pointer;
                            margin-bottom: 0.5rem;
                            transition: all 0.3s ease;
                        }

                        .feature-item:hover {
                            color: #00C092;
                            /* efek hover */
                        }

                        .feature-item.active {
                            color: #00C092;
                            /* warna hijau saat active */
                        }
                    </style>

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
            </div>
        </section>
    @endif

    @if (in_array($product->category_id, [1, 2]))
        <section class="py-5">
            <div class="container">

                <!-- Title -->
                <div class="d-flex align-items-center mb-5">
                    <h4 class="fw-bold me-3 mb-0"> {{ $product->brand->name_brand ?? 'Unknown Brand' }} Color</h4>
                    <div class="flex-grow-1 line-tech"></div>
                </div>

                {{-- COLOR --}}
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
                                <button class="btn btn-outline-primary w-100 py-2 rounded-3">
                                    Test Drive
                                </button>
                            </div>
                            <div class="col-6 ps-1">
                                <button class="btn btn-primary w-100 py-2 rounded-3"
                                    style="background: linear-gradient(to right, #0094ff, #00e6a8); border: none;">
                                    Order Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Gambar Mobil -->
                    <div class="col-lg-7 text-center">
                        <img src="@if ($product->colors->isNotEmpty()) {{ asset('storage/' . $product->colors->first()->image) }} @endif"
                            class="img-fluid car-preview" id="car-preview" alt="Car">
                    </div>

                </div>

            </div>
        </section>
    @endif
    {{-- INI FEATURE UNTUK CATEGORI 1 --}}
    @if ($product->category_id == 1)
        <section class="py-5 container">
            <div class="d-flex align-items-center mb-5">
                <h4 class="fw-bold me-3 mb-0">{{ $product->brand->name_brand ?? 'Unknown Brand' }} Specification</h4>
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
                <div class="spec-content">
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
                <h5 class="credit-title">CREDIT CALCULATOR</h5>
                <p class="powered">Powered by <span>OKKEV FINANCE</span></p>
                <p class="sub-text">
                    Our internal loans guarantee flexible financing options at competitive rates.
                </p>
            </div>

            <div class="credit-box">
                <div class="container py-5">
                    <h5 class="text-center credit-subtitle">Monthly Installment Budget</h5>
                    <h3 class="text-center credit-amount">Rp 3.886.600 / Months</h3>

                    <p class="text-center desc-text mt-3">
                        Calculate monthly installments that fit your budget by setting the down
                        payment and loan period.
                    </p>

                    <div class="row g-4 mt-4">

                        <div class="col-md-6">
                            <label class="credit-label">Car Price</label>
                            <input type="text" class="form-control credit-input" value="Rp 149.000.000">
                        </div>

                        <div class="col-md-6">
                            <label class="credit-label">Interest Rate</label>
                            <input type="text" class="form-control credit-input" value="10.96 %">
                        </div>

                        <div class="col-md-6">
                            <label class="credit-label">Loan Amount</label>
                            <input type="text" class="form-control credit-input" value="Rp 160.000.000">
                        </div>

                        <div class="col-md-6">
                            <label class="credit-label">Loan Period</label>
                            <select class="form-control credit-input">
                                <option>1 Tahun</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="credit-label">First Payment</label>
                            <input type="text" class="form-control credit-input" value="Rp 55.000.000">
                        </div>

                    </div>

                    <div class="mt-4 note-box">
                        <p><strong>Important note:</strong> Requirements may vary from bank to bank. This calculation is
                            purely
                            a simulation.</p>
                        <p>For cars outside Jakarta, the above calculation is not binding. Additional shipping costs are not
                            included.</p>
                        <p>The above calculation applies to a minimum down payment of IDR 10,000,000.</p>
                    </div>

                </div>
            </div>
        </section>
    @endif

    @if ($product->category_id == 2)
        {{-- POWER --}}
        <section class="py-5 container">
            <div class="d-flex align-items-center mb-4">
                <h4 class="fw-bold me-3 mb-0">Power (Motor Penggerak)</h4>
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
                <h4 class="fw-bold me-3 mb-0">Dimensi</h4>
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
                <h4 class="fw-bold me-3 mb-0">Sistem Suspensi</h4>
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
                <h4 class="fw-bold me-3 mb-0">Fitur</h4>
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


    {{-- ------------------------------------------------------------ --}}
    @if ($product->category_id == 1)
        <section>
            <div class="container mt-5">
                <h4>There are still other options</h4>
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
                                            <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                                alt="{{ $product->model_name }}"
                                                class="img-fluid mb-2 vehicle-img w-100 p-4">
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
@endsection
