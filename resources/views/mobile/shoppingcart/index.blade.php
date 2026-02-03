@extends('layout.mobile.app')
@section('title', 'Notifikasi')
@section('content')

    <style>
        body {
            padding-top: 64px;
            /* ⬅️ sesuaikan dengan tinggi header */
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 64px;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            /* Safari */

            z-index: 999;
            border-bottom: 1px solid #eee;
            border-radius: 0 0 16px 16px;

            /* Transisi halus */
            transition: box-shadow 0.3s ease, backdrop-filter 0.3s ease, background-color 0.3s ease;
        }

        /* Aktif saat scroll */
        .header.header-scrolled {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.85);
        }


        .header-container {
            width: 100%;
            display: flex;
            align-items: center;
            padding: 0 16px;
            position: relative;
        }

        .back-btn-img {
            display: flex;
            align-items: center;
            z-index: 2;
        }

        .back-icon {
            width: 22px;
            height: auto;
        }

        .header-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
            font-weight: 600;
            color: #30445C;
            white-space: nowrap;
        }
    </style>


    <div class="header ">
        <div class="container header-container">
            <a href="{{ route('mobile.home') }}" class="back-btn-img">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="header-title">Cart</div>
        </div>
    </div>





    <div class="container py-4">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <div class="container py-4">
            <div class="cart-card">

                <!-- Select all -->
                <div class="d-flex align-items-center mb-3">
                    <label class="check-wrapper">
                        <input class="check-input" type="checkbox" checked>
                        <span class="check-box"></span>
                    </label>
                    <span class="fw-medium ms-2">select all products</span>
                </div>

                <!-- Cart Item -->
                <div class="cart-item d-flex align-items-center">
                    <label class="check-wrapper me-3">
                        <input class="check-input" type="checkbox" checked>
                        <span class="check-box"></span>
                    </label>

                    <img src="https://via.placeholder.com/90x70" class="product-img" alt="product">

                    <div class="ms-3 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small class="text-muted d-block">Menunggu Pembayaran</small>
                                <div class="fw-semibold text-primary product-title">
                                    ASUS Zenbook A14 (UX3407)
                                </div>
                            </div>
                            <div class="price-text">
                                Rp 14.999.000
                            </div>
                        </div>

                        <div class="d-flex justify-content-start align-items-center mt-3">
                            <div class="qty-box">
                                <button class="qty-btn">−</button>
                                <span class="qty-number">1</span>
                                <button class="qty-btn">+</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>



    <style>
        .cart-card {
            background: #fff;
            border-radius: 14px;
            padding: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            max-width: 420px;
            margin: auto;
        }

        .cart-item {
            border-radius: 12px;
            padding: 12px;
            background: #ffffff;
            border: 1px solid rgba(25,195,125,0.06);
            box-shadow: 0 6px 18px rgba(0,0,0,0.03);
            gap: 12px;
        }

        .product-img {
            width: 90px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #f0f0f0;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }

        .qty-box {
            display: flex;
            align-items: center;
            border: 1px solid #19c37d;
            border-radius: 20px;
            padding: 2px 10px;
        }

        .qty-btn {
            background: none;
            border: none;
            font-size: 18px;
            color: #19c37d;
            width: 24px;
        }

        .qty-number {
            font-weight: 600;
            margin: 0 8px;
        }

        .price-text {
            color: #e53935;
            font-weight: 700;
        }

        /* Custom square checkbox */
        .check-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .check-wrapper .check-input {
            display: none;
        }

        .check-box {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            border: 2px solid #19c37d;
            display: inline-block;
            background: #fff;
            position: relative;
        }

        .check-wrapper .check-input:checked + .check-box {
            background: #19c37d;
        }

        .check-box::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 4px;
            width: 8px;
            height: 14px;
            border: solid #fff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            opacity: 0;
        }

        .check-wrapper .check-input:checked + .check-box::after {
            opacity: 1;
        }

        .product-title {
            max-width: 180px;
        }
    </style>


@endsection
