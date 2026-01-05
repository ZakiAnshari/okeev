@extends('layout.mobile.app')
@section('title', 'Detail')
@section('content')
    <style>
        body {
            padding-top: 0px !important;
        }
    </style>


    <div class="mobile-header">
        @if (isset($product) && $product->category_id == 1)
            <div class="container header-container">
                <a href="{{ route('vehiclecard.detail', $product->brand->slug) }}" class="back-btn-img">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
                </a>
                <div class="mobile-header-title">Car Details</div>
            </div>
        @endif
        @if (isset($product) && $product->category_id == 2)
            <div class="container header-container">
                <a href="{{ route('vehiclemotor.detail', $product->brand->slug) }}" class="back-btn-img">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back"
                        class="back-icon">
                </a>
                <div class="mobile-header-title">Motor Details</div>
            </div>
        @endif
        @if (isset($product) && $product->category_position_id == 2)
            <div class="container header-container">
                <a href="{{ route('electric.detail', $product->brand->slug) }}" class="back-btn-img">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back"
                        class="back-icon">
                </a>
                <div class="mobile-header-title">Electric Details</div>
            </div>
        @endif
        @if (isset($product) && in_array($product->category_position_id, [3, 4]))
            <div class="container header-container">
                <a href="{{ route('accessories.detail', $product->brand->slug) }}" class="back-btn-img">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back"
                        class="back-icon">
                </a>
                <div class="mobile-header-title">Accessories Details</div>
            </div>
        @endif
    </div>
    <br>
    <section class="container car-section-01 mt-5">
        <div class="car-main-image-container">
            <img id="mainCarImage" src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->model_name }}"
                class="car-main-image mt-4" onclick="openModal()">
        </div>

        <div class="car-thumbnail-scroll mt-3">
            @foreach ($product->images as $i => $img)
                <img src="{{ asset('storage/' . $img->image) }}" alt="Thumbnail {{ $i + 1 }}"
                    class="car-thumbnail {{ $i == 0 ? 'active' : '' }}" onclick="changeMainImage(this)">
            @endforeach
        </div>

        <style>
            .car-thumbnail {
                border: 1px solid #d1d5db !important;
                /* abu-abu halus */
                border-radius: 6px;
                padding: 2px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .car-thumbnail {
                outline: none;
                border: none;
            }

            .car-thumbnail:focus,
            .car-thumbnail:active {
                outline: none !important;
                border: none !important;
                box-shadow: none !important;
            }

            .car-thumbnail-scroll {
                display: flex;
                gap: 12px;
                overflow-x: auto;
                padding: 10px 5px;
                /* 👈 ini mencegah kepotong kiri/kanan */
                scroll-behavior: smooth;

                /* UX mobile */
                -webkit-overflow-scrolling: touch;
            }

            .car-thumbnail-scroll::-webkit-scrollbar {
                display: none;
                /* bersih */
            }

            .car-thumbnail {
                flex: 0 0 auto;
                /* 👈 PENTING: jangan mengecil */
                width: 100px;
                height: 100px;
                object-fit: cover;
                border-radius: 12px;
                cursor: pointer;
                /* opacity: 0.7; */
                transition: all 0.25s ease;
            }
        </style>
        @if (!in_array($product->category_position_id, [2, 3, 4]))
            <div class="car-info-01">
                <div class="car-name-01" style="text-align: start">
                    {{ $product->model_name }}
                </div>

                <div class="car-price-01" style="text-align: start">
                    IDR {{ number_format($product->price, 0, ',', '.') }}
                </div>

                <div class="car-button-group-01">
                    <button class="car-btn-outline-01 w-50"
                        onclick="location.href='{{ route('drive.index', $product->slug) }}'">
                        <img src="{{ asset('front_end/assets/images/logo/mobile/streamline_steering-wheel-solid.png') }}"
                            alt="Car Icon" class="car-btn-icon-01">
                        Test Drive
                    </button>

                    <button class="car-btn-outline-01 w-50" onclick="location.href='#'">
                        <img src="{{ asset('front_end/assets/images/logo/mobile/ri_shopping-bag-fill.png') }}"
                            alt="Cart Icon" class="car-btn-icon-01">
                        Add to Cart
                    </button>
                </div>

                <button class="car-btn-order" onclick="location.href='#'">
                    Order Now
                </button>
            </div>
        @endif

        @if ($product->category_position_id != 1)
            <div class="pd-info-box text-start mt-3">
                <h5 class="pd-name">
                    {{ $product->model_name }}
                </h5>

                <div class="pd-price">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>


                <p class="pd-desc">
                    {{ strip_tags($product->description ?? '') }}
                </p>

            </div>
            <hr>
        @endif

    </section>



    <section>
        @if (!in_array($product->category_position_id, [2, 3, 4])) {{-- kalau category_position_id 2 3 4 maka sembunyikan ini  --}}
            <div class="container mt-5">

                <!-- Main Tabs -->
                <div class="tech-tabs-wrapper mb-3">

                    <div class="d-flex tech-tabs" style="border-bottom: 1px solid rgba(48, 68, 92, 0.5);">
                        @if ($product->category_id == 1)
                            <div class="tab-item" data-target="technology-section">Technology</div>
                            <div class="tab-item" data-target="feature-section">Feature</div>
                            <div class="tab-item" data-target="spec-section">Specification</div>
                            <div class="tab-item" data-target="credit-section">Credit Calculator</div>
                        @endif

                        <div class="tab-item" data-target="color-section">Color</div>

                        @if ($product->category_id == 2)
                            <div class="tab-item" data-target="power-section">Power</div>
                            <div class="tab-item" data-target="dimensi-section">Dimensi</div>
                            <div class="tab-item" data-target="sistemsuspensi-section">Sistem Suspensi</div>
                            <div class="tab-item" data-target="fitur-section">Fitur</div>
                        @endif

                    </div>
                </div>
                {{-- INI TEKNOLOGIN UNTUK MOBIL --}}
                @if ($product->category_id == 1)
                    {{-- TEKNOLOGY ________________________________________________________________________________________ --}}
                    <div id="technology-section" class="d-flex align-items-center mb-5 mt-5">
                        <h4 class="wuling-title mb-0 me-3">
                            {{ $product->brand->name_brand ?? 'Unknown Brand' }} Technology
                        </h4>
                        <div class="flex-grow-1 wuling-line"></div>
                    </div>

                    <div class="sub-tabs-wrapper mb-3">
                        <div class="d-flex sub-tabs" id="technology-subtabs">
                            @foreach ($technologies as $index => $technology)
                                <div class="sub-tab {{ $index === 0 ? 'active' : '' }}"
                                    data-subtab="{{ $technology->slug ?? Str::slug($technology->name) }}">
                                    {{ $technology->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Content Area -->
                    <div class="tech-content-wrapper">
                        @foreach ($technologies as $index => $technology)
                            <div class="tech-content {{ $index !== 0 ? 'd-none' : '' }}"
                                data-content="{{ $technology->slug ?? Str::slug($technology->name) }}">

                                <h5>{{ $technology->name }}</h5>

                                @if (!empty($technology->description))
                                    {!! nl2br(e($technology->description)) !!}
                                @endif

                                @if (!empty($technology->image))
                                    <img src="{{ asset('storage/' . $technology->image) }}" alt="{{ $technology->name }}">
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
                {{-- INI FEATURE UNTUK MOBIL --}}
                @if ($product->category_id == 1)
                    {{-- Feature________________________________________________________________________________________ --}}
                    <div class="wuling-feature-section">
                        <div id="feature-section" class="d-flex align-items-center mb-4 mt-5">
                            <h4 class="wuling-title mb-0 me-3">
                                {{ $product->brand->name_brand ?? 'Unknown Brand' }} Feature
                            </h4>
                            <div class="flex-grow-1 wuling-line"></div>
                        </div>



                        <div class="wf-container d-flex flex-column flex-md-row">
                            <!-- Tabs / List -->
                            <div class="wf-tabs mb-3 mb-md-0">
                                @foreach ($features as $index => $feature)
                                    <div class="wf-tab {{ $index == 0 ? 'active' : '' }}"
                                        data-feature="{{ Str::slug($feature->name) }}">
                                        {{ $feature->name }}
                                    </div>
                                @endforeach
                            </div>

                            <!-- Content -->
                            <div class="wf-content flex-grow-1 ms-md-4">
                                @foreach ($features as $index => $feature)
                                    <div class="wf-content-item {{ $index != 0 ? 'd-none' : '' }}"
                                        data-content="{{ Str::slug($feature->name) }}">
                                        <img src="{{ asset('storage/' . $feature->image) }}"
                                            alt="{{ $feature->name }} Image" class="img-fluid mb-3">
                                        {{-- <h5>{{ $feature->name }}</h5> --}}
                                        <p>{{ $feature->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- COLOR________________________________________________________________________________________ --}}
                <div class="wuling-feature-section">
                    <div id="color-section" class="d-flex align-items-center mb-5 mt-4">
                        <h4 class="wuling-title mb-0 me-3">
                            {{ $product->brand->name_brand ?? 'Unknown Brand' }} Color
                        </h4>
                        <div class="flex-grow-1 wuling-line"></div>
                    </div>

                    <div class="row align-items-center g-4">

                        <!-- Gambar Mobil -->
                        <div class="container">
                            <img src="@if ($product->colors->isNotEmpty()) {{ asset('storage/' . $product->colors->first()->image) }} @endif"
                                class="img-fluid car-preview" id="car-preview" alt="Car"
                                style="max-height: 250px; width: auto;">
                        </div>

                        <!-- Warna -->
                        <div class="d-flex flex-column align-items-center custom-box mt-4">
                            <div class="d-flex flex-wrap justify-content-center gap-4 mb-3 mt-4">
                                @forelse($product->colors as $index => $color)
                                    <div class="color-circle {{ $index === 0 ? 'active' : '' }}"
                                        data-index="{{ $index }}" data-name="{{ $color->name }}"
                                        data-image="{{ asset('storage/' . $color->image) }}"
                                        style="background: linear-gradient(to bottom, #000 50%, {{ $color->hex }} 50%); cursor: pointer;">
                                    </div>
                                @empty
                                    <p class="text-muted">Tidak ada warna tersedia</p>
                                @endforelse
                            </div>

                            <!-- Nama warna -->
                            <p class="fw-semibold fs-6 mt-2" id="color-name">{{ $product->colors->first()?->name ?? '' }}
                            </p>
                        </div>

                    </div>

                    <!-- JavaScript -->


                    <!-- CSS untuk styling (opsional) -->




                </div>
                @if ($product->category_id == 1)
                    {{-- SPECIFICATION ________________________________________________________________________________________ --}}
                    <div class="my-5">
                        <!-- Title -->
                        <div id="spec-section" class="d-flex align-items-center mb-4">
                            <h4 class="wuling-title mb-0 me-3">
                                {{ $product->brand->name_brand ?? 'Unknown Brand' }} Specification
                            </h4>
                            <div class="flex-grow-1 wuling-line"></div>
                        </div>

                        <!-- Card -->
                        <div class="card spec-card shadow-sm">
                            <div class="card-body">
                                <div class="spec-tabs-wrapper mb-3">
                                    <ul class="nav spec-tabs flex-nowrap" id="specTab" role="tablist">
                                        @foreach ($specifications->unique('title') as $index => $spec)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                    id="{{ Str::slug($spec->title) }}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#{{ Str::slug($spec->title) }}" type="button"
                                                    role="tab" aria-controls="{{ Str::slug($spec->title) }}"
                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                    {{ $spec->title }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Progress -->
                                <div class="spec-progress mb-4">
                                    <span class="progress-bar"></span>
                                </div>

                                <!-- Tab Content -->
                                <div class="tab-content">


                                    @foreach ($specifications->groupBy('title') as $title => $specs)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                            id="{{ Str::slug($title) }}">

                                            <div class="spec-list">
                                                @foreach ($specs as $spec)
                                                    <div class="spec-item">
                                                        <p class="title">{{ $spec->label }}</p>
                                                        <p class="value">{{ $spec->value }}</p>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($product->category_id == 2)
                    {{-- POWER --}}
                    <div id="power-section" class="d-flex align-items-center mb-4 mt-5">
                        <h4 class="wuling-title mb-0 me-3">
                            {{ $product->brand->name_brand ?? 'Unknown Brand' }} Power
                        </h4>
                        <div class="flex-grow-1 wuling-line"></div>
                    </div>
                    <div class="custom-specs rounded" style="max-width: 300px;">
                        @foreach ($powers as $power)
                            <div class="custom-spec-item mb-3">
                                <h6 class="custom-spec-title mb-2" style="color:rgba(48, 68, 92, 1);">{{ $power->label }}
                                </h6>
                                <p class="custom-spec-value mb-3">{{ $power->nilai }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- DIMENSI --}}
                    <div id="dimensi-section" class="d-flex align-items-center mb-4 mt-5">
                        <h4 class="wuling-title mb-0 me-3">
                            {{ $product->brand->name_brand ?? 'Unknown Brand' }} Dimensi
                        </h4>
                        <div class="flex-grow-1 wuling-line"></div>
                    </div>
                    <div class="custom-specs rounded" style="max-width: 300px;">
                        @foreach ($dimensis as $dimensi)
                            <div class="custom-spec-item mb-3">
                                <h6 class="custom-spec-title mb-2" style="color:rgba(48, 68, 92, 1);">
                                    {{ $dimensi->label }}</h6>
                                <p class="custom-spec-value mb-3">{{ $dimensi->nilai }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- SISTEM SUSPENSI --}}
                    <div id="sistemsuspensi-section" class="d-flex align-items-center mb-4 mt-5">
                        <h4 class="wuling-title mb-0 me-3">
                            {{ $product->brand->name_brand ?? 'Unknown Brand' }} Sistem Suspensi
                        </h4>
                        <div class="flex-grow-1 wuling-line"></div>
                    </div>
                    <div class="custom-specs rounded" style="max-width: 300px;">
                        @foreach ($suspensis as $suspensi)
                            <div class="custom-spec-item mb-3">
                                <h6 class="custom-spec-title mb-2" style="color:rgba(48, 68, 92, 1);">
                                    {{ $suspensi->label }}</h6>
                                <p class="custom-spec-value mb-3">{{ $suspensi->nilai }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- FITUR --}}
                    <div id="fitur-section" class="d-flex align-items-center mb-4 mt-5">
                        <h4 class="wuling-title mb-0 me-3">
                            {{ $product->brand->name_brand ?? 'Unknown Brand' }} Fitur
                        </h4>
                        <div class="flex-grow-1 wuling-line"></div>
                    </div>
                    <div class="custom-specs rounded" style="max-width: 300px;">
                        @foreach ($fiturs as $fitur)
                            <div class="custom-spec-item mb-3">
                                <h6 class="custom-spec-title mb-2" style="color:rgba(48, 68, 92, 1);">{{ $fitur->label }}
                                </h6>
                                <p class="custom-spec-value mb-3">{{ $fitur->nilai }}</p>
                            </div>
                        @endforeach
                    </div>

                @endif

            </div>
        @endif
        <div class="container">
            @foreach ($product->details as $detail)
                <div class="row align-items-start">
                    <div class="col-6">
                        <p class="text-hello mb-0">
                            {{ $detail->label }}
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="text-hello2 mb-0">
                            {!! $detail->nilai !!}
                        </p>
                    </div>
                </div>
            @endforeach


        </div>
    </section>

    <section>
        {{-- Kredit Calculator ________________________________________________________________________________________ --}}
        <div class="" id="credit-section">
            <div class="cc-card">

                <div class="cc-header">
                    <h2>CREDIT CALCULATOR</h2>
                    <p class="cc-powered">Powered by <span>BAEV FINANCE</span></p>
                    <p class="cc-desc">
                        Our internal loans guarantee flexible financing options at competitive rates.
                    </p>
                </div>

                <p class="cc-intro">
                    Calculate monthly installments that fit your budget by setting the down payment and loan period.
                </p>

                <div class="cc-form">

                    <div class="cc-group">
                        <label>Car Price</label>
                        <input type="text" value="Rp 149.000.000" readonly>
                    </div>

                    <div class="cc-group">
                        <label>Loan Amount</label>
                        <input type="text" value="Rp 160.000.000" readonly>
                    </div>

                    <div class="cc-group">
                        <label>First Payment</label>
                        <input type="text" value="Rp 55.000.000">
                    </div>

                    <div class="cc-group">
                        <label>Interest Rate</label>
                        <input type="text" value="10.96 %">
                    </div>

                    <div class="cc-group">
                        <label>Tenure</label>
                        <div class="cc-select">
                            <select>
                                <option>1 Year</option>
                                <option>2 Years</option>
                                <option>3 Years</option>
                                <option>4 Years</option>
                                <option>5 Years</option>
                            </select>
                            <span>›</span>
                        </div>
                    </div>

                </div>

                <div class="cc-note">
                    <p><strong>Important note:</strong> Requirements may vary from bank to bank. This calculation is
                        purely a
                        simulation.</p>
                    <p>For cars outside Jakarta, additional shipping costs and regional taxes may apply.</p>
                    <p>This above calculation applies to a minimum down payment of not 10,000,000</p>
                </div>

            </div>
        </div>
    </section>
    <style>
        .tab-content {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .spec-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            text-align: left;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            text-align: left;
        }

        .spec-item .title {
            flex: 1;
            margin: 0;
            font-weight: 500;
            text-align: left;
        }

        .spec-item .value {
            flex: 1;
            margin: 0;
            text-align: left;
        }

        /* WRAPPER */
        .bf-wrapper {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ffffff;
            box-shadow: 0 -4px 14px rgba(0, 0, 0, 0.12);
            padding: 14px 18px;
            /* display: flex; */
            justify-content: space-between;
            align-items: center;
            z-index: 999;
            background: rgba(255, 255, 255, 0.75);
            /* transparan biar blur kelihatan */
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

        }

        /* PRICE */
        .bf-price {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .bf-price-label {
            font-size: 13px;
            color: #555;
        }

        .bf-price-value {
            font-size: 18px;
            font-weight: 700;
            color: #e60000;
        }

        /* ACTION BUTTONS */
        .bf-actions {
            display: flex;
            gap: 12px;
        }

        /* BASE BUTTON */
        .bf-btn {
            min-width: 120px;
            height: 44px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        /* OUTLINE BUTTON */
        .bf-btn-outline {
            background: #ffffff;
            color: #00a0e3;
            border: 2px solid #00a0e3;
        }

        .bf-btn-outline:hover {
            background: #eaf7ff;
        }

        /* SOLID BUTTON */
        .bf-btn-solid {
            background: linear-gradient(135deg, #00c6d4, #0097d6);
            color: #ffffff;
            border: none;
        }

        .bf-btn-solid:hover {
            opacity: 0.9;
        }
    </style>

    <br><br>
    <div class="bf-wrapper">
        <div class="bf-price">
            <span class="bf-price-label">Price</span>
            <span class="bf-price-value mb-3"> Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        </div>

        <div class="bf-actions">
            @if ($product->category_position_id == 1)
                <button class="bf-btn bf-btn-outline w-50"
                    onclick="window.location='{{ route('drive.index', $product->slug) }}'">
                    Test Drive
                </button>
            @else
                <button class="bf-btn bf-btn-outline w-50" onclick="window.location='#'">
                    + Cart
                </button>
            @endif



            <button class="bf-btn bf-btn-solid w-50">
                Bayar Now
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const colorCircles = document.querySelectorAll('.color-circle');
            const carPreview = document.getElementById('car-preview');
            const colorName = document.getElementById('color-name');

            colorCircles.forEach(circle => {
                circle.addEventListener('click', function() {
                    // Hapus class active dari semua circle
                    colorCircles.forEach(c => c.classList.remove('active'));

                    // Tambah class active ke circle yang diklik
                    this.classList.add('active');

                    // Ambil data dari circle yang diklik
                    const imagePath = this.getAttribute('data-image');
                    const name = this.getAttribute('data-name');

                    // Update gambar dan nama warna
                    carPreview.src = imagePath;
                    colorName.textContent = name;
                });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ==============================
            // 1️⃣ Sub-Tabs / Technology Section
            // ==============================
            document.querySelectorAll('.sub-tabs-wrapper').forEach(wrapper => {
                const tabs = wrapper.querySelectorAll('.sub-tab');
                const contents = document.querySelectorAll('.tech-content');

                tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        const target = tab.dataset.subtab;
                        if (!target) return;

                        // Reset all tabs & content
                        tabs.forEach(t => t.classList.remove('active'));
                        contents.forEach(c => c.classList.add('d-none'));

                        // Activate clicked tab & content
                        tab.classList.add('active');
                        const activeContent = document.querySelector(
                            `.tech-content[data-content="${target}"]`);
                        if (activeContent) activeContent.classList.remove('d-none');
                    });
                });
            });

            // ==============================
            // 2️⃣ WF-Tabs / Feature Section
            // ==============================
            document.querySelectorAll('.wf-container').forEach(container => {
                const tabs = container.querySelectorAll('.wf-tab');
                const contents = container.querySelectorAll('.wf-content-item');

                tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        const feature = tab.dataset.feature;
                        if (!feature) return;

                        // Reset tabs & content
                        tabs.forEach(t => t.classList.remove('active'));
                        contents.forEach(c => {
                            c.classList.add('d-none');
                            c.style.display = 'none';
                        });

                        // Activate tab
                        tab.classList.add('active');

                        // Show content
                        const activeContent = container.querySelector(
                            `.wf-content-item[data-content="${feature}"]`);
                        if (activeContent) {
                            activeContent.classList.remove('d-none');
                            activeContent.style.display = 'block';
                        }
                    });
                });
            });

            // ==============================
            // 3️⃣ Scroll to Section
            // ==============================
            document.querySelectorAll('.tab-item').forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetId = this.dataset.target;
                    const target = document.getElementById(targetId);
                    if (!target) return;

                    const offset = 90; // sesuaikan jarak header
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
                    window.scrollTo({
                        top: targetPosition - offset,
                        behavior: 'smooth'
                    });
                });
            });


            // ==============================
            // 4️⃣ Spec Progress Bar (Bootstrap)
            // ==============================
            const specTabs = document.querySelectorAll('#specTab .nav-link');
            const progressBar = document.querySelector('.spec-progress .progress-bar');
            if (specTabs.length && progressBar) {
                const totalTabs = specTabs.length;
                specTabs.forEach((tab, index) => {
                    tab.addEventListener('shown.bs.tab', function() {
                        const step = tab.dataset.step || (index + 1);
                        const progress = (step / totalTabs) * 100;
                        progressBar.style.width = progress + '%';
                    });
                });
            }

            // ==============================
            // 5️⃣ Color Picker
            // ==============================
            const circles = document.querySelectorAll('.color-circle');
            const colorName = document.getElementById('color-name');
            if (circles.length && colorName) {
                circles.forEach(circle => {
                    circle.addEventListener('click', function() {
                        circles.forEach(c => c.classList.remove('active'));
                        this.classList.add('active');
                        colorName.textContent = this.dataset.name || '';
                    });
                });
            }

            // ==============================
            // 6️⃣ Main Image Switcher
            // ==============================
            window.changeMainImage = function(el) {
                const mainImg = document.getElementById('mainCarImage');
                if (!mainImg) return;

                mainImg.src = el.src;
                document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                el.classList.add('active');
            };

        });
    </script>


    @include('sweetalert::alert')
@endsection
