@extends('layout.user')
@section('title', 'Order-Now')
@section('content')

    <br><br><br><br>


    <section class="py-5">
        <div class="container">

            <!-- Back -->
            <a href="/" class="text-decoration-none d-flex align-items-center mb-4">
                <i class="bx bx-arrow-back me-2"></i> Order Now
            </a>

            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-8">
                    <div class="card shadow-sm p-4 rounded-4">
                        <div class="d-flex flex-column flex-md-row gap-3 align-items-start">

                            <!-- IMAGE -->
                            <div class="product-image-box">
                                <img src="{{ asset('front_end/assets/images/Pristine_White 1.png') }}"
                                    class="product-image">
                            </div>

                            <!-- TEXT + PRICE + COLORS -->
                            <div class="flex-grow-1">

                                <h5 class="fw-bold mb-1">New Air Ev Lite Long Range</h5>

                                <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                                    <h5 class="fw-bold text-danger mb-0">Rp 194.000.000</h5>

                                    <!-- Counter -->
                                    <div class="d-flex align-items-center border rounded px-2 py-1"
                                        style="gap: 10px; min-width: 90px; justify-content: center;">
                                        <button class="btn p-0 fw-bold" style="font-size: 20px;">-</button>
                                        <span class="fw-bold">1</span>
                                        <button class="btn p-0 fw-bold" style="font-size: 20px;">+</button>
                                    </div>
                                </div>

                                <hr>

                                <p class="fw-semibold mb-2">Pilih Warna</p>

                                <div class="d-flex flex-wrap gap-2 gap-md-3 justify-content-center align-items-center">
                                    <div class="color-circle" style="background: linear-gradient(#000 50%, #fff 50%);">
                                    </div>
                                    <div class="color-circle"
                                        style="background: linear-gradient(#2f3a2f 50%, #d7e1d2 50%);"></div>
                                    <div class="color-circle" style="background: linear-gradient(#000 50%, #ffd500 50%);">
                                    </div>
                                    <div class="color-circle" style="background: linear-gradient(#000 50%, #d7b0a4 50%);">
                                    </div>
                                    <div class="color-circle" style="background: linear-gradient(#000 50%, #c7cae8 50%);">
                                    </div>
                                    <div class="color-circle" style="background: linear-gradient(#000 50%, #000 50%);">
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

                <style>
                    .product-image-box {
                        width: 200px;
                        height: 165px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: #f8f9fa;
                        border-radius: 12px;
                        flex-shrink: 0;
                        overflow: hidden;
                    }

                    .product-image {
                        height: 100%;
                        width: auto;
                        object-fit: contain;
                    }

                    .color-circle {
                        width: 45px;
                        height: 45px;
                        border-radius: 50%;
                        border: 1px solid #ddd;
                        cursor: pointer;
                        transition: .25s;
                    }

                    .color-circle:hover {
                        transform: scale(1.15);
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    }

                    /* ---------- RESPONSIVE HP ---------- */
                    @media (max-width: 576px) {

                        .product-image-box {
                            width: 100% !important;
                            height: auto !important;
                        }

                        .product-image {
                            width: 100% !important;
                            height: auto !important;
                            object-fit: contain;
                        }
                    }
                </style>



                <!-- RIGHT SIDE -->
                <div class="col-lg-4">
                    <div class="card  shadow-sm p-4 rounded-4">

                        <!-- Payment Title -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-bold mb-0">Payment Methods</h6>
                            <a href="#" class="small text-decoration-none">See all</a>
                        </div>

                        <!-- Payment List -->
                        <div class="list-group mb-4">

                            @foreach ([['img' => 'Group.png', 'name' => 'BCA Virtual Account'], ['img' => 'Group (1).png', 'name' => 'Mandiri Virtual Account'], ['img' => 'BRIVA-BRI 1.png', 'name' => 'BRI Virtual Account'], ['img' => 'Logo-CIMB-Niaga-Linkqu 1.png', 'name' => 'CIMB Virtual Account']] as $key => $bank)
                                <label
                                    class="list-group-item d-flex align-items-center justify-content-between border-0 payment-item">

                                    <div class="d-flex align-items-center gap-3">
                                        <div class="brand-box">
                                            <img src="{{ asset('front_end/assets/images/' . $bank['img']) }}"
                                                class="brand-img" alt="Bank Logo">
                                        </div>

                                        <span class="fw-semibold">{{ $bank['name'] }}</span>
                                    </div>

                                    <label class="custom-radio">
                                        <input type="radio" name="pay" {{ $key === 0 ? 'checked' : '' }}>
                                        <span></span>
                                    </label>

                                </label>
                            @endforeach

                        </div>

                        <hr>

                        <!-- Summary -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Total price (1 item)</span>
                                <span style="font-weight: 900; letter-spacing: 1px; color: #00B0E5;">
                                    Rp 194.000.000
                                </span>


                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Service Fee</span>
                                <span class="fw-semibold">Rp 2.000</span>
                            </div>
                        </div>

                        <hr>

                        <!-- Total Bill -->
                        <div class="d-flex justify-content-between fw-semibold fs-6 mb-3">
                            <span>Total Bill</span>
                            <span style="font-weight: 900; letter-spacing: 1px; color: #00B0E5;">
                                Rp 194.002.000
                            </span>
                        </div>

                        <!-- Payment Button -->
                        <a href="{{ route('payment.va') }}" class="btn btn-info text-white w-100 py-2 rounded-pill">
                            Payment
                        </a>


                    </div>
                </div>

            </div>

        </div>
    </section>

    <style>
        .product-card {
            padding: 16px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        /* IMAGE */
        .product-image-box {
            width: 80px;
            height: 80px;
            background: #f9fafb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
        }

        .product-image-box img {
            max-width: 100px !important;
            max-height: 100px;
            object-fit: contain;
        }

        /* DROPDOWN OFFSET */
        .shipping-options {
            margin-left: calc(80px + 16px);
            /* PENTING */
            max-width: 260px;
        }

        .form-select {
            font-size: 14px;
            border-radius: 8px;
        }

        .shipping-card,
        .product-card {
            padding: 16px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .location-icon {
            color: #ef4444;
            font-size: 18px;
            margin-top: 3px;
        }

        .product-image-box {
            width: 80px;
            height: 80px;
            background: #f9fafb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
        }

        .product-image-box img {
            max-width: 70px;
            max-height: 70px;
            object-fit: contain;
        }

        .shipping-options {
            max-width: 260px;
            /* INI YANG BIKIN POSISI SAMA */
        }

        .form-select {
            font-size: 14px;
            border-radius: 8px;
        }

        .custom-radio {
            position: relative;
            display: inline-block;
            width: 24px;
            /* ukuran lingkaran luar */
            height: 24px;
        }

        .custom-radio input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .custom-radio span {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid #00B0E5;
            /* warna border */
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .custom-radio span::after {
            content: "";
            width: 12px;
            /* lingkaran dalam */
            height: 12px;
            background-color: #00B0E5;
            /* warna lingkaran tengah */
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .custom-radio input:checked+span::after {
            opacity: 1;
        }

        .product-image-box {
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
        }

        .product-image {
            height: 100%;
            width: auto;
            object-fit: contain;
        }
    </style>

    <style>
        /* PRODUCT IMAGE */
        .product-image-box {
            width: 160px;
            height: 110px;
            background: #f8f8f8;
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* COLOR CIRCLE */
        .color-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: .25s;
        }

        .color-circle:hover {
            transform: scale(1.15);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* PAYMENT LIST */
        .payment-item {
            border-radius: 14px;
            background: #fff;
            padding: 14px 16px;
            margin-bottom: 10px;
        }

        .brand-box {
            width: 60px;
            height: 60px;
            /* background: #f5f5f5; */
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .brand-img {
            max-height: 30px;
        }

        .radio-lg {
            transform: scale(1.2);
        }
    </style>


@endsection
