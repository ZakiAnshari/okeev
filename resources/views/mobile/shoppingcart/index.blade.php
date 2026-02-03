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

        <div class="container pb-5">
            <div class="cart-card mb-3">

                <!-- Select all -->
                <div class="d-flex align-items-center ">
                    <label class="check-wrapper select-all">
                        <input class="check-input" type="checkbox" checked>
                        <span class="check-box"></span>
                    </label>
                    <span class="fw-medium ms-2">select all products</span>
                </div>



            </div>
            <!-- Cart Item -->
            <div class="cart-item d-flex align-items-center">
                <label class="check-wrapper">
                    <input class="check-input" type="checkbox" checked>
                    <span class="check-box"></span>
                </label>

                <div class="item-left d-flex flex-column align-items-start me-3">
                    <img src="https://via.placeholder.com/90x70" class="product-img" alt="product">
                    <div class="price-text mt-2">
                        Rp 14.999.000
                    </div>
                </div>
                <div class="ms-0 flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted d-block"style="font-size: 12px">Menunggu Pembayaran</small>
                            <div class="fw-semibold text-primary product-title" style="font-size: 12px">
                                ASUS Zenbook A14 (UX3407)
                            </div>
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
            border: 1px solid rgba(25, 195, 125, 0.06);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.03);
            gap: 12px;
            position: relative;
            padding-left: 56px;
            /* space for absolute checkbox */
        }

        .product-img {
            width: 90px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #f0f0f0;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
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

        /* Keep the select-all checkbox inline (not absolute) */
        .check-wrapper.select-all {
            position: static;
            margin: 0;
        }

        /* Position item checkboxes inside cart items */
        .cart-item .check-wrapper {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 3;
            margin: 0;
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

        .check-wrapper .check-input:checked+.check-box {
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

        .check-wrapper .check-input:checked+.check-box::after {
            opacity: 1;
        }

        .product-title {
            max-width: 180px;
        }

        /* Footer wrapper styles */
        .bf-wrapper {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ffffff;
            padding: 25px 16px;
            border-radius: 20px 20px 0 0;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.15);
            z-index: 100;
        }

        .bf-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            max-width: 420px;
            margin: 0 auto;
        }

        .bf-left {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .bf-left .check-wrapper {
            position: static;
        }

        .bf-left .check-box {
            background: #19c37d;
            border-color: #19c37d;
            width: 24px;
            height: 24px;
        }

        .bf-left .check-box::after {
            opacity: 1;
            left: 5px;
            top: 2px;
            width: 6px;
            height: 12px;
        }

        .bf-all-text {
            color: #ffffff;
            font-weight: 600;
            font-size: 13px;
        }

        .bf-middle {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .bf-total-label {
            color: #888888;
            font-size: 11px;
        }

        .bf-total-price {
            color: #e53935;
            font-weight: 700;
            font-size: 16px;
        }

        .bf-btn-buy {
            background: #0099ff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 10px 24px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.3s;
            flex-shrink: 0;
        }

        /* .bf-btn-buy:hover {
            background: #0077cc;
        } */

        .bf-btn-buy {
            padding: 12px 28px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #00DAD7, #006BE5);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .bf-btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 107, 229, 0.35);
        }
    </style>

    <div class="bf-wrapper">
        <div class="bf-content">
            <div class="bf-left">
                <label class="check-wrapper select-all">
                    <input class="check-input" type="checkbox" checked>
                    <span class="check-box"></span>
                </label>
                <span class="bf-all-text">All</span>
            </div>
            <div class="bf-middle">
                <span class="bf-total-label">Total</span>
                <span class="bf-total-price">Rp 194.000.000</span>
            </div>
            <button class="bf-btn-buy">BUY</button>

        </div>
    </div>

@endsection
