@extends('layout.mobile.app')
@section('title', 'Detail')
@section('content')
    <style>
        body {
            padding-top: 0px !important;
        }
    </style>


    <div class="mobile-header">
        <div class="container header-container">
            <a href="{{ route('vehiclecard.detail', $product->brand->slug) }}" class="back-btn-img">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="mobile-header-title">Car Details</div>
        </div>
    </div>
    <br>
    <section class="container car-section-01 mt-5">
        <div class="car-main-image-container">
            <img id="mainCarImage" src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->model_name }}"
                class="car-main-image mt-4" onclick="openModal()">
        </div>

        <div class="car-thumbnail-scroll">
            @foreach ($product->images as $i => $img)
                <img src="{{ asset('storage/' . $img->image) }}" alt="Thumbnail {{ $i + 1 }}"
                    class="car-thumbnail {{ $i == 0 ? 'active' : '' }}" onclick="changeMainImage(this)">
            @endforeach
        </div>

        <style>
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
                opacity: 0.7;
                transition: all 0.25s ease;
            }
        </style>
        <div class="car-info-01">
            <div class="car-name-01" style="text-align: start"> {{ $product->model_name }}</div>
            <div class="car-price-01" style="text-align: start">
                IDR {{ number_format($product->price, 0, ',', '.') }}
            </div>

            <div class="car-button-group-01">
                <button class="car-btn-outline-01 w-50" onclick="location.href='{{ route('drive.index', $product->slug) }}'">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/streamline_steering-wheel-solid.png') }}"
                        alt="Car Icon" class="car-btn-icon-01">
                    Test Drive
                </button>
                <button class="car-btn-outline-01 w-50" onclick="location.href='cart.html'">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/ri_shopping-bag-fill.png') }}" alt="Cart Icon"
                        class="car-btn-icon-01">
                    Add to Cart
                </button>
            </div>


            <button class="car-btn-order" onclick="location.href='checkout-wuling-air-ev.html'">Order Now</button>
        </div>
    </section>



    <section>
        <div class="container mt-5">

            <!-- Main Tabs -->
            <div class="tech-tabs-wrapper mb-3">
                <div class="d-flex tech-tabs" style=" border-bottom: 1px solid rgba(48, 68, 92, 0.5);">
                    <div class="tab-item" data-tab="technology">Technology</div>
                    <div class="tab-item" data-tab="feature">Feature</div>
                    <div class="tab-item" data-tab="color">Color</div>
                    <div class="tab-item" data-tab="spec">Spec</div>
                    <div class="tab-item" data-tab="extra1">Extra 1</div>
                    <div class="tab-item" data-tab="extra2">Extra 2</div>

                </div>

            </div>
            {{-- ________________________________________________________________________________________ --}}
            <div class="d-flex align-items-center mb-5 mt-5">
                <h4 class="wuling-title mb-0 me-3">Wuling Technology</h4>
                <div class="flex-grow-1 wuling-line"></div>
            </div>




            <!-- Sub Tabs -->
            <div class="sub-tabs-wrapper mb-3">
                <div class="d-flex sub-tabs" id="technology-subtabs">
                    <div class="sub-tab active" data-subtab="drive">Easy to Drive</div>
                    <div class="sub-tab" data-subtab="own">Easy to Own</div>
                    <div class="sub-tab" data-subtab="charge">Easy to Charge</div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="tech-content-wrapper">
                <div class="tech-content" data-content="drive">
                    <h5>Easy to Drive</h5>
                    <p>
                        Tak perlu cemas soal ganjil-genap atau jalan sempit! Desain compact buat Wuling New Air ev mudah
                        dikendarai, diparkir, dan jadi pilihan mobilitas harian yang praktis. Sekali charge, bisa menempuh
                        sampai 300km!
                    </p>
                    <p>
                        Dilengkapi fitur pintar seperti Hill Hold Control (HHC) untuk keamanan di tanjakan dan WIND (Wuling
                        Indonesia Command), New Air ev siap menemani aktivitas harianmu tanpa hambatan.
                    </p>
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Easy_to_Drive 1 (2).png') }}" alt="Car Image">
                </div>

                <div class="tech-content d-none" data-content="own">
                    <h5>Easy to Own</h5>
                    <p>
                        Wuling New Air ev mudah dimiliki, biaya perawatan rendah, dan dilengkapi garansi resmi. Semua
                        dokumen
                        dan proses administrasi dijamin cepat dan praktis.
                    </p>
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Easy_to_Drive 1 (2).png') }}" alt="Own Image">
                </div>

                <div class="tech-content d-none" data-content="charge">
                    <h5>Easy to Charge</h5>
                    <p>
                        Mengisi daya Wuling New Air ev gampang! Bisa di rumah atau stasiun charging umum. Cepat dan aman,
                        mendukung mobilitas harian tanpa khawatir kehabisan baterai.
                    </p>
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Easy_to_Drive 1 (2).png') }}"
                        alt="Charge Image">
                </div>
            </div>

            {{-- ________________________________________________________________________________________ --}}
            <div class="wuling-feature-section">
                <div class="d-flex align-items-center mb-4 mt-5">
                    <h4 class="wuling-title mb-0 me-3">Wuling Feature</h4>
                    <div class="flex-grow-1 wuling-line"></div>
                </div>


                <div class="wf-container d-flex flex-column flex-md-row">
                    <!-- Tabs / List -->
                    <div class="wf-tabs mb-3 mb-md-0">
                        <div class="wf-tab active" data-feature="battery">Main Battery & Powertrain</div>
                        <div class="wf-tab" data-feature="widescreen">Integrated Floating Widescreen</div>
                        <div class="wf-tab" data-feature="exterior">Exterior</div>
                        <div class="wf-tab" data-feature="interior">Interior</div>
                        <div class="wf-tab" data-feature="rear-camera">Rear Parking Camera</div>
                    </div>

                    <!-- Content -->
                    <div class="wf-content flex-grow-1 ms-md-4">
                        <div class="wf-content-item" data-content="battery">
                            <img src="{{ asset('front_end/assets/images/logo/mobile/young-couple-talking-sales-person-car-showroom 1.jpg') }}"
                                alt="Battery Image" class="img-fluid mb-3">
                            {{-- <h5>Proven & Tested Battery, IP67</h5> --}}
                            <p>
                                Wuling's battery has been rigorously tested to meet IP67 standards for water and dust
                                resistance,
                                ensuring reliable performance in any condition.
                            </p>
                        </div>

                        <div class="wf-content-item d-none" data-content="widescreen">
                            <img src="{{ asset('front_end/assets/images/logo/mobile/battery 1 (1).png') }}"
                                alt="Widescreen Image" class="img-fluid mb-3">
                            {{-- <h5>Floating Widescreen Display</h5> --}}
                            <p>
                                Enjoy an integrated floating widescreen display with intuitive controls and seamless user
                                experience.
                            </p>
                        </div>

                        <div class="wf-content-item d-none" data-content="exterior">
                            <img src="{{ asset('front_end/assets/images/logo/mobile/battery 1 (1).png') }}"
                                alt="Exterior Image" class="img-fluid mb-3">
                            {{-- <h5>Stylish Exterior Design</h5> --}}
                            <p>
                                Aerodynamic and sleek design elements give Wuling a modern and dynamic appearance.
                            </p>
                        </div>

                        <div class="wf-content-item d-none" data-content="interior">
                            <img src="{{ asset('front_end/assets/images/logo/mobile/battery 1 (1).png') }}"
                                alt="Interior Image" class="img-fluid mb-3">
                            {{-- <h5>Comfortable Interior</h5> --}}
                            <p>
                                Spacious and ergonomic interior designed for maximum comfort during every ride.
                            </p>
                        </div>

                        <div class="wf-content-item d-none" data-content="rear-camera">
                            <img src="{{ asset('front_end/assets/images/logo/mobile/battery 1 (1).png') }}"
                                alt="Rear Camera Image" class="img-fluid mb-3">
                            {{-- <h5>Rear Parking Camera</h5> --}}
                            <p>
                                Advanced rear parking camera provides clear guidance for safe and easy parking.
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            {{-- ________________________________________________________________________________________ --}}
            <div class="wuling-feature-section">
                <div class="d-flex align-items-center mb-5 mt-4">
                    <h4 class="wuling-title mb-0 me-3">Wuling Color</h4>
                    <div class="flex-grow-1 wuling-line"></div>
                </div>
                <div class="row align-items-center g-4">
                    <!-- Gambar Mobil -->
                    <div class="container">
                        <img id="mainCarImage"
                            src="{{ asset('front_end/assets/images/logo/mobile/download (3) 1 (1).png') }}"
                            alt="Wuling Air EV" class="car-main-image custom-car-image mt-4" onclick="openModal()">
                    </div>

                    <div class="col-lg-5 mt-4">
                        <div class="d-flex flex-column align-items-center custom-box">
                            <!-- Baris 1 -->
                            <div class="d-flex justify-content-center gap-4 mb-4 mt-4">
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #fff 50%);"
                                    data-name="Black & White"></div>
                                <div class="color-circle" style="background: linear-gradient(#2f3a2f 50%, #d7e1d2 50%);"
                                    data-name="Forest Green"></div>
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #ffd500 50%);"
                                    data-name="Black & Yellow"></div>
                            </div>

                            <!-- Baris 2 -->
                            <div class="d-flex justify-content-center gap-4 mb-3">
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #d7b0a4 50%);"
                                    data-name="Black & Beige"></div>
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #c7cae8 50%);"
                                    data-name="Black & Light Blue"></div>
                                <div class="color-circle" style="background: linear-gradient(#000 50%, #000 50%);"
                                    data-name="All Black"></div>
                            </div>
                            <p class="fw-semibold fs-6 mt-2" id="color-name">Pristine White</p>
                        </div>
                        <!-- Buttons -->
                        <div class="car-button-group-01 mt-4">
                            <button class="car-btn-outline-01 w-50 p-0" onclick="location.href='test-drive.html'">
                                <img src="{{ asset('front_end/assets/images/logo/mobile/streamline_steering-wheel-solid.png') }}"
                                    alt="Car Icon" class="car-btn-icon-01">
                                Test Drive
                            </button>
                            <button class="car-btn-outline-01 w-50 p-0" onclick="location.href='cart.html'">
                                <a href="order.html" class="btn btn-primary w-100 py-2 rounded-3"
                                    style="background: linear-gradient(to right, #0094ff, #00e6a8); border: none;">
                                    Order Now
                                </a>
                            </button>
                        </div>
                    </div>


                </div>



            </div>

            {{-- SPECIFICATION ________________________________________________________________________________________ --}}
            <div class="container my-5">
                <!-- Title -->
                <div class="d-flex align-items-center mb-4">
                    <h4 class="wuling-title mb-0 me-3">Wuling Specification</h4>
                    <div class="flex-grow-1 wuling-line"></div>
                </div>
                <!-- Card -->
                <div class="card spec-card shadow-sm">
                    <div class="card-body">
                        <div class="spec-tabs-wrapper mb-3">
                            <ul class="nav spec-tabs flex-nowrap" id="specTab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="dimension-tab" data-bs-toggle="tab"
                                        data-bs-target="#dimension" type="button" role="tab"
                                        aria-controls="dimension" aria-selected="true">
                                        Dimension
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="battery-tab" data-bs-toggle="tab"
                                        data-bs-target="#battery" type="button" role="tab" aria-controls="battery"
                                        aria-selected="false">
                                        Main Battery And Powertrain
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="exterior-tab" data-bs-toggle="tab"
                                        data-bs-target="#exterior" type="button" role="tab"
                                        aria-controls="exterior" aria-selected="false">
                                        Exterior
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="interior-tab" data-bs-toggle="tab"
                                        data-bs-target="#interior" type="button" role="tab"
                                        aria-controls="interior" aria-selected="false">
                                        Interior
                                    </button>
                                </li>

                            </ul>
                        </div>

                        <!-- Progress -->
                        <div class="spec-progress mb-4">
                            <span class="progress-bar"></span>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">

                            <!-- Dimension -->
                            <div class="tab-pane fade show active" id="dimension">
                                <div class="spec-list">
                                    <div class="spec-item">
                                        <p class="title">Lenght x Width x Height (mm)</p>
                                        <p class="value">2,974 x 1,505 x 1,631</p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Wheelbase (mm)</p>
                                        <p class="value">2,010</p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Seat capacity</p>
                                        <p class="value">4</p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Suspension</p>
                                        <p class="value">
                                            McPherson (Front) + 3-link coil spring (Rear)
                                        </p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Wheel and tire</p>
                                        <p class="value">
                                            12” steel wheel with full cap, 145/70R12
                                        </p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Brakes</p>
                                        <p class="value">Disc (Front) + Drum (Rear)</p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Steering</p>
                                        <p class="value">Electric Power Steering</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Battery -->
                            <div class="tab-pane fade" id="battery">
                                <div class="spec-list">
                                    <div class="spec-item">
                                        <p class="title">Battery Type</p>
                                        <p class="value">Lithium Ferro-Phosphate (LFP)</p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Battery Capacity</p>
                                        <p class="value">26.7 kWh</p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Charging Time</p>
                                        <p class="value">6.5 Hours (AC)</p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Driving Range</p>
                                        <p class="value">300 KM</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Exterior -->
                            <div class="tab-pane fade" id="exterior">
                                <div class="spec-list">
                                    <div class="spec-item">
                                        <p class="title">Headlamp</p>
                                        <p class="value">LED</p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Rear Lamp</p>
                                        <p class="value">LED Combination Lamp</p>
                                    </div>
                                    <div class="spec-item">
                                        <p class="title">Wheel Cover</p>
                                        <p class="value">Full Cap</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <section>
        {{-- Kredit Calculator ________________________________________________________________________________________ --}}
        <div class="">
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
            <span class="bf-price-value mb-3">Rp 194.00.000</span>
        </div>

        <div class="bf-actions">
            <button class="bf-btn bf-btn-outline w-50">
                Test Drive
            </button>

            <button class="bf-btn bf-btn-solid w-50">
                Bayar Now
            </button>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- animasi scroll --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('#specTab .nav-link');
            const progressBar = document.querySelector('.spec-progress .progress-bar');
            const totalTabs = tabs.length;
            tabs.forEach((tab, index) => {
                tab.addEventListener('shown.bs.tab', function() {
                    const step = tab.getAttribute('data-step') || (index + 1);
                    const progress = (step / totalTabs) * 100;
                    progressBar.style.width = progress + '%';
                });
            });
        });
    </script>

    <script>
        // Ambil semua color-circle
        const circles = document.querySelectorAll('.color-circle');
        const colorName = document.getElementById('color-name');

        circles.forEach(circle => {
            circle.addEventListener('click', () => {
                // Hapus class 'active' dari semua
                circles.forEach(c => c.classList.remove('active'));
                // Tambahkan class 'active' ke yang diklik
                circle.classList.add('active');
                // Update teks nama warna
                colorName.textContent = circle.dataset.name;
            });
        });
    </script>

    <script>
        // Switch content on tab click
        document.querySelectorAll('.wf-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const feature = this.getAttribute('data-feature');

                // Active tab
                document.querySelectorAll('.wf-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Show content
                document.querySelectorAll('.wf-content-item').forEach(c => {
                    if (c.getAttribute('data-content') === feature) {
                        c.classList.remove('d-none');
                    } else {
                        c.classList.add('d-none');
                    }
                });
            });
        });
    </script>
    <script>
        document.querySelectorAll('.sub-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Hapus active dari semua tab
                document.querySelectorAll('.sub-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const target = this.getAttribute('data-subtab');

                // Tampilkan konten sesuai tab
                document.querySelectorAll('.tech-content').forEach(content => {
                    if (content.getAttribute('data-content') === target) {
                        content.classList.remove('d-none');
                    } else {
                        content.classList.add('d-none');
                    }
                });
            });
        });
    </script>

    <script>
        function changeMainImage(el) {
            document.getElementById('mainCarImage').src = el.src;
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
        }
    </script>


    @include('sweetalert::alert')
@endsection
