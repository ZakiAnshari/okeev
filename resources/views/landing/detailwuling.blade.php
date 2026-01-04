@extends('layout.user')
@section('title', 'detail')
@section('content')
    <br><br>
    <section class="py-4 mt-5">
        <div class="container">

            <!-- Back Button -->
            <a href="/wuling" class="text-decoration-none mb-3 d-inline-flex align-items-center">
                <i class="bx bx-arrow-back me-2"></i> Detail Kendaraan
            </a>

            <div class="row g-4 mt-2 align-items-start">

                <!-- Gambar Utama -->
                <div class="col-12 col-lg-8">
                    <div class="main-img-box p-3 rounded">
                        <img src="{{ asset('front_end/assets/images/Pristine_White 1.png') }}" class="main-img"
                            alt="Car">
                    </div>
                </div>

                <!-- Thumbnail -->
                <div class="col-12 col-lg-4">
                    <div class="thumb-container">

                        <img src="{{ asset('front_end/assets/images/integrated-floating-widescreen-and-smart-start-system 1.png') }}"
                            class="thumbnail-img" alt="Thumb 1">

                        <img src="{{ asset('front_end/assets/images/interior-trim-2 1.png') }}" class="thumbnail-img"
                            alt="Thumb 2">

                        <img src="{{ asset('front_end/assets/images/easy-to-park-with-rear-parking-camera 1.png') }}"
                            class="thumbnail-img" alt="Thumb 3">

                    </div>
                </div>

            </div>

            <!-- Detail Kendaraan -->
            <div class="mt-4">
                <h5 class="mb-1">New Air Ev Lite Long Range</h5>
                <h4 class="text-danger fw-bold">IDR 194.000.000</h4>
            </div>

            <!-- Tombol -->
            <div class="row mt-4 g-3">

                <div class="col-md-6">
                    <a href="/testdrive"
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
        </div>
    </section>


    <style>
        /* ============================================================
           MAIN IMAGE WRAPPER
        ============================================================= */
        .main-img-box {
            background: #F5F5F5;
            border-radius: 12px;
            height: 392px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-img {
            max-height: 100%;
            width: 100%;
            object-fit: contain;
        }

        /* ============================================================
           THUMBNAILS
        ============================================================= */
        .thumb-container {
            display: grid;
            gap: 15px;
            grid-template-columns: 1fr;
        }

        .thumbnail-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .thumbnail-img:hover {
            transform: scale(1.03);
            opacity: 0.9;
        }

        /* ============================================================
           BUTTON GRADIENT
        ============================================================= */
        .order-btn {
            background: linear-gradient(90deg, #00C6FF 0%, #00E676 100%);
            border-radius: 8px;
        }

        /* ============================================================
           RESPONSIVE OPTIMIZATION
        ============================================================= */
        @media (max-width: 991px) {
            .main-img-box {
                height: auto;
                padding: 0;
            }
        }

        /* Tablet */
        @media (min-width: 768px) and (max-width: 991px) {
            .thumb-container {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                /* 2 kolom thumbnail */
                gap: 12px;
            }

            .thumbnail-img {
                height: 140px;
                /* proporsional dan tidak pecah */
                object-fit: cover;
            }

            /* Biar gambar utama & thumbnail tetap sejajar */
            .main-image-col {
                margin-bottom: 0;
            }
        }


        /* Mobile */
        @media (max-width: 576px) {
            .thumb-container {
                grid-template-columns: repeat(3, 1fr);
            }

            .thumbnail-img {
                height: 95px;
            }
        }
    </style>

    {{-- ////////////////////////////////////////////////////////////////////////////////// --}}


    <section class="py-5">
        <div class="container">

            <!-- Top Navigation -->
            <ul class="nav justify-content-center border-bottom pb-2 mb-4 tech-nav">
                <li class="nav-item"><a class="nav-link active" href="#">Technology</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Feature</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Color</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Specification</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Credit Calculator</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Other</a></li>
            </ul>

            <br><br>
            <!-- Title -->
            <div class="d-flex align-items-center mb-5">
                <h4 class="fw-bold me-3 mb-0">Wuling Technology</h4>
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
                    <h5 class="fw-bold" style="color:#00C092;">Easy to Drive</h5>

                    <p class="text-secondary" style="line-height: 1.7;">
                        Tak perlu cemas soal ganjil - genap atau jalan sempit! Desain compact buat Wuling
                        New Air ev mudah dikendarai, diparkir, dan jadi pilihan mobilitas harian yang praktis.
                        Sekali charge, bisa menempuh sampai 300km!
                    </p>

                    <p class="text-secondary" style="line-height: 1.7;">
                        Dilengkapi fitur pintar seperti Hill Hold Control (HHC) untuk keamanan di tanjakan dan
                        WIND (Wuling Indonesia Command), New Air ev siap menemani aktivitas harianmu tanpa hambatan.
                    </p>
                </div>

                <!-- Right Image -->
                <div class="col-lg-6 col-md-12">
                    <img src="front_end/assets/images/Easy_to_Drive 1.png" class="img-fluid rounded shadow-sm tech-image"
                        alt="Technology Image">
                </div>
            </div>

            <!-- Bottom Nav Tabs -->
            <div class="d-flex gap-4 mt-4 tech-tabs">
                <span class="tab-item active">Easy to Drive</span>
                <span class="tab-item">Easy to Own</span>
                <span class="tab-item">Easy to Charge</span>
            </div>

        </div>
    </section>

    <style>
        /* Desktop – rapikan jarak item */
        .tech-nav {
            gap: 28px;
        }

        /* HP – jadikan scroll horizontal */
        @media (max-width: 768px) {
            .tech-nav {
                overflow-x: auto;
                white-space: nowrap;
                flex-wrap: nowrap;
                gap: 20px;
                padding-bottom: 6px;
            }

            .tech-nav::-webkit-scrollbar {
                height: 5px;
            }

            .tech-nav::-webkit-scrollbar-thumb {
                background: #ccc;
                border-radius: 10px;
            }
        }

        /* Top Nav */
        .tech-nav .nav-link {
            color: #7A7A7A;
            font-size: 15px;
            padding: 8px 14px;
        }

        .tech-nav .nav-link.active {
            color: #00A8FF;
            font-weight: 600;
            border-bottom: 2px solid #00A8FF;
        }

        /* Bottom Tabs */
        .tab-item {
            font-size: 15px;
            padding-bottom: 5px;
            cursor: pointer;
            color: #8A8A8A;
        }

        .tab-item.active {
            color: #00C092;
            font-weight: 700;
            border-bottom: 2px solid #00C092;
        }

        /* Responsive tweak */
        @media (max-width: 992px) {
            .tech-tabs {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 768px) {
            .tech-image {
                margin-top: 20px;
            }

            .tech-nav {
                flex-wrap: wrap;
            }
        }
    </style>

    {{-- ????????????????????????????????????????????????????? --}}
    <section class="py-5">
        <div class="container">
            <!-- Title -->
            <div class="d-flex align-items-center mb-5">
                <h4 class="fw-bold me-3 mb-0">Wuling Feature</h4>
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
                    <h4 class="mb-5">Proven & Tested Battery, IP67</h4>
                    <h5 class="fw-bold" style="color:#00C092;">Main Battery & Powertrain</h5>
                    <h5>Integrated Floating Widescreen</h5>
                    <h5>Exterior</h5>
                    <h5>Interior</h5>
                    <h5>Rear Parking Camera</h5>
                </div>

                <!-- Right Image -->
                <div class="col-lg-6 col-md-12">
                    <img src="front_end/assets/images/battery 1.png" class="img-fluid rounded shadow-sm tech-image"
                        alt="Technology Image">
                </div>
            </div>

        </div>
    </section>


    {{-- ----------------------------------------------------------------------------- --}}

    <section class="py-5">
        <div class="container">

            <!-- Title -->
            <div class="d-flex align-items-center mb-5">
                <h4 class="fw-bold me-3 mb-0">Wuling Color</h4>
                <div class="flex-grow-1 line-tech"></div>
            </div>

            <div class="row align-items-center g-4">
                <!-- Color Picker -->
                <div class="col-lg-5">
                    <div class="p-4 border rounded-4 shadow-sm text-center">

                        <!-- Warna -->
                        <div class="d-flex flex-column align-items-center">

                            <!-- Baris 1 -->
                            <div class="d-flex justify-content-center gap-4 mb-3">
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #fff 50%);"></div>
                                <div class="color-circle" style="background: linear-gradient(#2f3a2f 50%, #d7e1d2 50%);">
                                </div>
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #ffd500 50%);">
                                </div>
                            </div>

                            <!-- Baris 2 -->
                            <div class="d-flex justify-content-center gap-4 mb-3">
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #d7b0a4 50%);">
                                </div>
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #c7cae8 50%);">
                                </div>
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #000 50%);"></div>
                            </div>

                            <p class="fw-semibold fs-6 mt-2">Pristine White</p>
                        </div>

                    </div>
                    <!-- Buttons -->
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
                    <img src="front_end/assets/images/Pristine_White 1.png" class="img-fluid car-preview" alt="Car">
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Kotak warna */
        .color-box {
            border: 1px solid #E6E6E6;
        }

        /* Bulatan warna */
        .color-circle {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border: 2px solid #ddd;
            cursor: pointer;
            transition: 0.2s;
        }

        .color-circle:hover {
            transform: scale(1.12);
            border-color: #999;
        }

        /* Responsif Mobil */
        .car-preview {
            max-width: 480px;
        }

        /* Responsif lebih kecil */
        @media (max-width: 768px) {
            .color-circle {
                width: 45px;
                height: 45px;
            }

            .car-preview {
                max-width: 100%;
            }
        }
    </style>

    {{-- ----------------------------------------------------------------- --}}
    <section class="py-5 container">
        <div class="d-flex align-items-center mb-5">
            <h4 class="fw-bold me-3 mb-0">Wuling Specification</h4>
            <div class="flex-grow-1 line-tech"></div>
        </div>
        <div class="container spec-box">
            <!-- Title -->
            <ul class="nav justify-content-center pb-2 mb-4 tech-nav">
                <li class="nav-item"><a class="nav-link active" href="#">Dimension</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Main Battery And Powertrain</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Exterior</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Interior</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Safety</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Convenience & Multimedia</a></li>
            </ul>
            <div class="gradient-line my-4 mx-auto"></div>

            <div class="spec-list">

                <div class="spec-item">
                    <span class="spec-title">Length x Width x Height (mm)</span>
                    <span class="spec-value text">2,974 x 1,505 x 1,631</span>
                </div>

                <div class="spec-item">
                    <span class="spec-title">Wheelbase (mm)</span>
                    <span class="spec-value">2,010</span>
                </div>

                <div class="spec-item">
                    <span class="spec-title">Seat Capacity</span>
                    <span class="spec-value">4</span>
                </div>

                <div class="spec-item">
                    <span class="spec-title">Suspension</span>
                    <span class="spec-value">McPherson (Front) + 3-link coil spring (Rear)</span>
                </div>

                <div class="spec-item">
                    <span class="spec-title">Wheel and Tire</span>
                    <span class="spec-value">12” steel wheel with full cap; 145/70R12</span>
                </div>

                <div class="spec-item">
                    <span class="spec-title">Brakes</span>
                    <span class="spec-value">Disc (Front) + Drum (Rear)</span>
                </div>

                <div class="spec-item">
                    <span class="spec-title">Steering</span>
                    <span class="spec-value">Electric Power Steering</span>
                </div>

            </div>
        </div>




    </section>

    <style>
        .spec-box {
            border: 1px solid #E5E5E5;
            border-radius: 16px;
            padding: 35px 40px;
            background: #fff;
        }

        /* Nav style */
        .tech-nav .nav-link {
            color: #444;
            font-weight: 500;

        }

        .tech-nav .nav-link.active {
            color: #007bff;
            font-weight: 600;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .spec-box {
                padding: 20px;
                border-radius: 12px;
            }

            .tech-nav .nav-link {
                padding: 6px 12px;
                font-size: 14px;
            }
        }

        .spec-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #e9e9e9;
            padding: 10px 0;
        }

        .spec-title {
            font-weight: 500;
            color: #444;
            font-size: 15px;
        }

        .spec-value {
            font-weight: 600;
            color: #000;
            text-align: right;
            font-size: 15px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .spec-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .spec-value {
                text-align: left;
                margin-top: 4px;
            }
        }
    </style>


    {{-- 
------------------------------------------------------------------------------------------------ --}}

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
                    <p><strong>Important note:</strong> Requirements may vary from bank to bank. This calculation is purely
                        a simulation.</p>
                    <p>For cars outside Jakarta, the above calculation is not binding. Additional shipping costs are not
                        included.</p>
                    <p>The above calculation applies to a minimum down payment of IDR 10,000,000.</p>
                </div>

            </div>
        </div>
    </section>

    <style>
        .credit-section {
            background: #ffffff;
        }

        .credit-title {
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .powered span {
            color: #37d99e;
            font-weight: 600;
        }

        .sub-text {
            font-size: 14px;
            color: #777;
            margin-top: 10px;
        }

        /* BOX BIRU TUA */
        .credit-box {
            background: #1b2c47;
            color: white;
        }

        /* Judul Tengah */
        .credit-subtitle {
            font-size: 15px;
            color: #cfd9ea;
            letter-spacing: 0.5px;
        }

        .credit-amount {
            color: #32e081;
            font-weight: 700;
            margin-top: 5px;
        }

        .desc-text {
            color: #cbd4e6;
            font-size: 14px;
        }

        /* Input */
        .credit-label {
            font-size: 14px;
            font-weight: 500;
            color: #cfd9ea;
            margin-bottom: 5px;
        }

        .credit-input {
            height: 45px;
            border-radius: 4px;
            border: none;
            padding-left: 12px;
            font-size: 14px;
        }

        /* Catatan */
        .note-box {
            font-size: 13px;
            color: #cfd4e6;
            margin-top: 20px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .credit-input {
                height: 42px;
                font-size: 13px;
            }

            .credit-amount {
                font-size: 22px;
            }
        }
    </style>


    {{-- ------------------------------------------------------------ --}}

    <section>
        <div class="container mt-5">
            <h4>There are still other options</h4>
            <h6 class="mb-5">if you are not satisfied with the above vehicles.</h6>
            <div class="row">
                @foreach ([1, 2, 3, 4] as $i)
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="vehicle-card rounded shadow-sm h-100" style="border: 1px solid #F1F1F1 !important;">

                            <!-- Image -->
                            <div class="vehicle-img-wrapper"
                                style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%);
                                        border-radius: 4px 4px 0 0;">
                                <img src="{{ asset('front_end/assets/images/card.png') }}" class="vehicle-img w-100 p-3"
                                    alt="Vehicle">
                            </div>

                            <!-- Detail -->
                            <div class="card-body p-3 bg-white rounded-bottom">
                                <h6 class="fw-semibold text-dark mb-0">Brand {{ $i }}</h6>
                                <p class="fw-bold text-secondary small mb-1">Model {{ $i }} Edition</p>

                                <hr class="my-2">

                                <!-- Icons -->
                                <div class="d-flex justify-content-between text-center mb-2">


                                    <div class="icon-box flex-fill">
                                        <img src="{{ asset('front_end/assets/images/3.png') }}" width="22"
                                            class="mb-1">
                                        <p class="small text-black mb-0">20 Miles</p>
                                    </div>


                                    <div class="icon-box flex-fill">
                                        <img src="{{ asset('front_end/assets/images/2.png') }}" width="22"
                                            class="mb-1">
                                        <p class="small text-black mb-0">400 km</p>
                                    </div>


                                    <div class="icon-box flex-fill">
                                        <img src="{{ asset('front_end/assets/images/1.png') }}" width="22"
                                            class="mb-1">
                                        <p class="small text-black mb-0">2 seat</p>
                                    </div>
                                </div>

                                <hr class="my-2">

                                <!-- Price & Detail Link -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <p class="fw-bold text-danger mb-0">
                                        IDR {{ number_format(500000000 * $i, 0, ',', '.') }}
                                    </p>

                                    <a href="/detailwuling"
                                        class="text-decoration-none fw-semibold d-flex align-items-center"
                                        style="color:#30445C !important">
                                        Detail
                                        <img src="{{ asset('front_end/assets/images/icon.png') }}" width="10"
                                            class="mb-1 mx-2">
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
