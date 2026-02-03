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
            <div class="header-title">Notification</div>
        </div>
    </div>


   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container py-4">
        <div class="">

            <!-- ITEM 1 -->
            <div class="notification-item">
                <div class="icon-circle">
                    $
                </div>
                <div class="flex-grow-1 ms-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="fw-bold mb-1">ORDER VEHICLE</h6>
                        <small class="text-success fw-semibold">2.00 AM</small>
                    </div>
                    <p class="text-muted mb-1 small">
                        You have placed an order & will immediately make payment for the
                        WULING vehicle - New Air Ev...
                    </p>
                    <a href="#" class="details-link">Details...</a>
                </div>
            </div>

            <hr>

            <!-- ITEM 2 -->
            <div class="notification-item d-flex">
                <div class="icon-circle">
                    🚗
                </div>
                <div class="flex-grow-1 ms-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="fw-bold mb-1">TEST DRIVE</h6>
                        <small class="text-muted fw-semibold">Yesterday</small>
                    </div>
                    <p class="text-muted mb-1 small">
                        You apply to do a test drive of the WULING vehicle - New Air Ev...
                    </p>
                    <a href="#" class="details-link">Details...</a>
                </div>
            </div>

        </div>
    </div>

    <style>
        .notification-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            max-width: 520px;
            margin: auto;
        }

        .notification-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #e8faf3;
            color: #19c37d;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .details-link {
            color: #19c37d;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
        }

        .details-link:hover {
            text-decoration: underline;
        }

        hr {
            margin: 16px 0;
            opacity: 0.15;
        }
    </style>





@endsection
