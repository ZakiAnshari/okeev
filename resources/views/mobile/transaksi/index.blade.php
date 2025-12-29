@extends('layout.mobile.app')
@section('title', 'Transaksi')
@section('content')
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            padding-bottom: 80px;
            padding-top: 0px !important;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            background-color: white;
            min-height: 100vh;
        }

        .header {
            display: flex;
            align-items: center;
            padding: 16px;
            background-color: white;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #333;
            padding: 8px;
            margin-right: 16px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .category-tabs {
            display: flex;
            justify-content: space-around;
            background-color: white;
            padding: 16px 8px;
            border-bottom: 2px solid #e0e0e0;
            overflow-x: auto;
            gap: 8px;
        }

        .category-tab {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            min-width: 70px;
        }

        .category-tab:hover {
            background-color: #f5f5f5;
        }

        /* .category-tab.active {
                                background-color: rgba(53, 245, 198, 0.1);
                            } */

        .category-icon {
            width: 32px;
            height: 32px;
            margin-bottom: 8px;
            position: relative;
        }

        .category-icon svg {
            width: 100%;
            height: 100%;
        }

        .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background-color: #ff4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .category-label {
            font-size: 11px;
            text-align: center;
            color: #666;
            line-height: 1.3;
        }

        .category-tab.active .category-label {
            color: var(--light-green);
            font-weight: 600;
        }

        .content-section {
            padding: 16px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 16px;
        }

        .transaction-card {
            background-color: white;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .transaction-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .transaction-time {
            font-size: 12px;
            color: #999;
        }

        .transaction-body {
            display: flex;
            gap: 12px;
        }

        .transaction-image {
            width: 60px;
            height: 60px;
            background-color: #f5f5f5;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .transaction-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .transaction-info {
            flex: 1;
        }

        .transaction-type {
            font-size: 13px;
            color: #666;
            margin-bottom: 4px;
        }

        .transaction-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--light-green);
            margin-bottom: 4px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 200;
        }



        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 8px 16px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #999;
        }

        .nav-item:hover {
            color: var(--light-green);
        }

        .nav-item.active {
            color: var(--light-green);
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            margin-bottom: 4px;
        }

        .nav-label {
            font-size: 11px;
        }

        .hidden {
            display: none;
        }

        .category-img {
            width: 34px;
            height: 34px;
            object-fit: contain;
        }

        .transaction-card {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 12px;
            margin-bottom: 16px;
            transition: transform 0.2s;
        }

        .transaction-card:hover {
            transform: translateY(-2px);
        }

        .transaction-header {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 8px;
        }

        .transaction-time {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .transaction-body {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .transaction-image img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .transaction-info {
            display: flex;
            flex-direction: column;
        }

        .transaction-type {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .transaction-title {
            /* font-size: 1rem; */
            font-weight: 600;
            color: #007bff;
            /* sama seperti warna link di gambar */
            text-decoration: none;
        }
    </style>

    <div class="container">
        <div class="header" style="display: flex; justify-content: center; align-items: center; height: 60px;">
            <div class="header-title">Transaction</div>
        </div>


        <div class="category-tabs">
            <div class="category-tab active" onclick="changeCategory('waiting')">
                <div class="category-icon-waiting mb-2">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/tdesign_time.jpg') }}" alt="Waiting Icon"
                        class="category-img-waiting">
                    <span class="badge">2</span>
                </div>
                <div class="category-label">Waiting for<br>Confirmation</div>
            </div>

            <div class="category-tab" onclick="changeCategory('waiting')">
                <div class="category-icon-waiting mb-2">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/tdesign_time (1).jpg') }}" alt="Waiting Icon"
                        class="category-img-waiting">
                </div>
                <div class="category-label">Process</div>
            </div>

            <div class="category-tab" onclick="changeCategory('sent')">
                <div class="category-icon-waiting mb-2">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/tdesign_time (2).jpg') }}" alt="Waiting Icon"
                        class="category-img-waiting">
                </div>
                <div class="category-label">Being<br>Sent</div>
            </div>

            <div class="category-tab" onclick="changeCategory('location')">
                <div class="category-icon-waiting mb-2">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/tdesign_time (3).jpg') }}" alt="Waiting Icon"
                        class="category-img-waiting">
                </div>
                <div class="category-label">to the<br>Location</div>
            </div>


        </div>

        <div class="content-section">
            <!-- Waiting for Confirmation -->
            <div id="waiting-content" class="category-content">
                <div class="section-title">Waiting For Confirmation</div>

                <a href="payment.html" class="text-decoration-none">
                    <div class="transaction-card">
                        <div class="transaction-header">
                            <div class="transaction-time">2:00 AM</div>
                        </div>
                        <div class="transaction-body">
                            <div class="transaction-image">
                                <img src="{{ asset('front_end/assets/images/logo/mobile/Rectangle 430.jpg') }}" alt="Car">
                            </div>
                            <div class="transaction-info">
                                <div class="transaction-type">Menunggu Pembayaran</div>
                                <div class="transaction-title">New Air Ev Lite Long Range</div>
                            </div>
                        </div>
                    </div>
                </a>

                <div class="transaction-card" onclick="viewTransaction(2)">
                    <div class="transaction-header">
                        <div class="transaction-time">Yesterday</div>
                    </div>
                    <div class="transaction-body">
                        <div class="transaction-image">
                            <img src="{{ asset('front_end/assets/images/logo/mobile/w800 1.jpg') }}" alt="Laptop">
                        </div>
                        <div class="transaction-info">
                            <div class="transaction-type">Menunggu Pembayaran</div>
                            <div class="transaction-title">ASUS Zenbook A1X (UX3407)</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Process -->
            <div id="process-content" class="category-content hidden">
                <div class="section-title">In Process</div>
                <div class="empty-state">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                    <p>Tidak ada transaksi dalam proses</p>
                </div>
            </div>

            <!-- Being Sent -->
            <div id="sent-content" class="category-content hidden">
                <div class="section-title">Being Sent</div>
                <div class="empty-state">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z" />
                    </svg>
                    <p>Tidak ada pengiriman saat ini</p>
                </div>
            </div>

            <!-- To the Location -->
            <div id="location-content" class="category-content hidden">
                <div class="section-title">To the Location</div>
                <div class="empty-state">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                    </svg>
                    <p>Tidak ada paket dalam perjalanan</p>
                </div>
            </div>
        </div>
    </div>
@endsection
