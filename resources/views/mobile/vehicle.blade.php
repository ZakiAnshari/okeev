@extends('layout.mobile.app')
@section('title', 'Vehicle')
@section('content')
    <style>
        :root {
            --primary-blue: #213A94;
            --dark-bg: #30445C;
            --light-green: #35F5C6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }

        body {
            background-color: white;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            padding-bottom: 80px;
            padding-top: 150px;
        }

        .navbar-custom {
            background-color: var(--dark-bg);
            padding: 1rem 1rem 1.5rem 1rem;
            border-radius: 0 0 18px 18px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 500;
        }

        .navbar-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .back-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            margin-right: 1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .search-box {
            background-color: white;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            flex-grow: 1;
            display: flex;
            align-items: center;
            margin-right: 1rem;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 0.9rem;
        }

        .search-box-icon {
            margin-right: 5px;
        }

        .notif-btn {
            background-color: white;
            border: none;
            border-radius: 10px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
            flex-shrink: 0;
        }

        .notif-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #FF6B6B;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .title-text {
            color: white;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 0.3rem;
            line-height: 1.4;
            font-family: 'Oxanium', sans-serif;
        }

        .subtitle-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            margin: 0;
        }

        .content-section {
            /* padding: 1.5rem; */
            overflow: hidden;
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
            margin-bottom: 1.5rem;
            touch-action: pan-y;
        }

        .brands-slider {
            display: flex;
            transition: transform 0.3s ease;
        }

        .brands-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr) !important;
            grid-template-rows: repeat(2, 1fr);
            gap: 1.25rem;
            min-width: 100%;
            flex-shrink: 0;
        }

        /* .brand-item {
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                        gap: 8px;
                                        cursor: pointer;
                                    } */

        .brand-item a {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            width: 100%;
        }

        .brand-logo-wrapper {
            background-color: white;
            border-radius: 25px;
            padding: 0.8rem 0.4rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            border: 2px solid #e2e2e2;
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1;
            width: 100%;
        }

        .brand-item:hover .brand-logo-wrapper {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .brand-logo {
            width: 100%;
            height: 100%;
            max-width: 50px;
            max-height: 50px;
            object-fit: contain;
        }

        .brand-name {
            font-family: 'Oxanium', sans-serif;
            font-size: 13px;
            color: #333;
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
        }

        .pagination-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #d0d0d0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background-color: var(--light-green);
            width: 24px;
            border-radius: 4px;
        }

        /*Most Search*/
        .most-searched-section {
            padding: 20px 0 40px 0;
        }

        .most-searched-section h3 {
            font-family: 'Oxanium', sans-serif;
            font-weight: 700;
            font-size: 18px;
            color: #35F5C6;
            margin-bottom: 15px;
        }

        .strip-divider {
            height: 3px;
            background: linear-gradient(to right, var(--primary-blue), var(--light-green));
            margin: 20px 0;
        }

        .search-tabs {
            display: flex;
            gap: 15px;
            margin: 20px 0;
            border-bottom: 2px solid #ddd;
            overflow-x: auto;
        }

        .search-tab {
            padding: 10px 20px;
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            white-space: nowrap;
        }

        .search-tab.active {
            color: var(--primary-blue);
            border-bottom: 3px solid var(--primary-blue);
            font-weight: bold;
        }

        /* Vehicle Card */
        .vehicle-card {
            display: block;
            background: white;
            /* border: 1px solid #ddd; */
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 20px;
            text-decoration: none;
            color: inherit;
            transition: 0.2s ease;
        }

        .vehicle-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .vehicle-img {
            display: flex;
            width: 100%;
            height: 220px;
            /* background: #f1f1f1; */
            overflow: hidden;
            align-items: center;
            justify-content: center;
        }

        .car-img {
            width: 90%;
            height: auto;
            object-fit: contain;
            max-height: 180px;
        }

        .vehicle-info {
            padding: 20px;
        }

        .vehicle-specs {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            margin: 15px 0;
        }

        .spec-item {
            text-align: center;
        }

        .spec-icon svg {
            width: 22px;
            height: 22px;
            margin-bottom: 4px;
        }

        .spec-label {
            font-size: 12px;
            color: #666;
        }

        .vehicle-price {
            font-family: 'Oxanium', sans-serif;
            color: red;
            font-weight: bold;
            font-size: 18px;
        }

        /* Hotbar */
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

        @media (max-width: 768px) {
            .brands-grid {
                grid-template-columns: repeat(4, 1fr) !important;
            }
        }
    </style>

    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-top">
            <a href="{{ route('mobile.home') }}" class="back-btn">
                <i class='bx bx-arrow-back'></i>
            </a>

            <div class="search-box">
                <svg class="search-box-icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.5 2C9.1446 2.00012 7.80887 2.32436 6.60427 2.94569C5.39966 3.56702 4.3611 4.46742 3.57525 5.57175C2.78939 6.67609 2.27902 7.95235 2.08672 9.29404C1.89442 10.6357 2.02576 12.004 2.46979 13.2846C2.91382 14.5652 3.65766 15.7211 4.63925 16.6557C5.62084 17.5904 6.81171 18.2768 8.11252 18.6576C9.41333 19.0384 10.7864 19.1026 12.117 18.8449C13.4477 18.5872 14.6975 18.015 15.762 17.176L19.414 20.828C19.6026 21.0102 19.8552 21.111 20.1174 21.1087C20.3796 21.1064 20.6304 21.0012 20.8158 20.8158C21.0012 20.6304 21.1064 20.3796 21.1087 20.1174C21.111 19.8552 21.0102 19.6026 20.828 19.414L17.176 15.762C18.164 14.5086 18.7792 13.0024 18.9511 11.4157C19.123 9.82905 18.8448 8.22602 18.1482 6.79009C17.4517 5.35417 16.3649 4.14336 15.0123 3.29623C13.6597 2.44911 12.096 1.99989 10.5 2ZM4.00001 10.5C4.00001 8.77609 4.68483 7.12279 5.90382 5.90381C7.1228 4.68482 8.7761 4 10.5 4C12.2239 4 13.8772 4.68482 15.0962 5.90381C16.3152 7.12279 17 8.77609 17 10.5C17 12.2239 16.3152 13.8772 15.0962 15.0962C13.8772 16.3152 12.2239 17 10.5 17C8.7761 17 7.1228 16.3152 5.90382 15.0962C4.68483 13.8772 4.00001 12.2239 4.00001 10.5Z"
                        fill="#35F5C6" />
                </svg>

                <input type="text" placeholder="Search in Cars">
            </div>
            <style>
                .search-box {
                    display: flex;
                    align-items: center;
                    /* ⬅️ ini yang sejajarkan */
                    gap: 10px;
                    padding: 10px 14px;
                    background: #fff;
                    border-radius: 12px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                }

                .search-box input::placeholder {
                    color: #35F5C6;
                    opacity: 1;
                    /* penting agar warnanya tidak pudar */
                }

                .search-box-icon {
                    flex-shrink: 0;
                }

                .search-box input {
                    border: none;
                    outline: none;
                    font-size: 14px;
                    width: 100%;
                    padding: 0;
                    /* ⬅️ hilangkan padding bawaan */
                    line-height: 1.2;
                }
            </style>
            <button class="notif-btn">
                <a href="notification.html">
                    <svg width="24" height="24" viewBox="0 0 28 28" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M17.2107 2.233C16.557 3.13264 16.1606 4.19327 16.064 5.3011C15.9673 6.40894 16.1741 7.52218 16.6622 8.5214C17.1502 9.52063 17.9011 10.3681 18.8342 10.973C19.7674 11.5779 20.8476 11.9173 21.959 11.9548V11.9677C21.9765 12.1987 21.994 12.4355 22.0173 12.6642C22.2938 15.2857 22.9238 17.0858 23.5293 18.2677C23.9318 19.0552 24.3273 19.5778 24.6073 19.894C24.7302 20.0334 24.8628 20.164 25.004 20.2848L25.0157 20.2918C25.1654 20.4005 25.2768 20.5538 25.3339 20.7297C25.3911 20.9056 25.391 21.0951 25.3337 21.271C25.2764 21.4469 25.1649 21.6001 25.0151 21.7086C24.8653 21.8171 24.685 21.8754 24.5 21.875H3.5C3.31544 21.8748 3.13567 21.8162 2.9864 21.7077C2.83714 21.5991 2.72602 21.4461 2.66894 21.2706C2.61186 21.0951 2.61174 20.906 2.66859 20.7304C2.72545 20.5549 2.83638 20.4017 2.9855 20.293L2.99484 20.2848L3.0695 20.2218C3.1395 20.1588 3.25267 20.0527 3.39267 19.894C3.67267 19.579 4.06817 19.0563 4.47067 18.2688C5.27567 16.695 6.125 14.035 6.125 9.8C6.125 7.6055 6.94167 5.49034 8.41167 3.92234C9.884 2.352 11.893 1.45834 14 1.45834C14.4464 1.45834 14.8871 1.49761 15.3218 1.57617C15.5995 1.62634 16.5095 1.90984 17.2107 2.233Z"
                            fill="#35F5C6" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M17.7917 5.83334C17.7917 4.67301 18.2526 3.56021 19.0731 2.73974C19.8935 1.91927 21.0063 1.45834 22.1667 1.45834C23.327 1.45834 24.4398 1.91927 25.2603 2.73974C26.0807 3.56021 26.5417 4.67301 26.5417 5.83334C26.5417 6.99366 26.0807 8.10646 25.2603 8.92693C24.4398 9.7474 23.327 10.2083 22.1667 10.2083C21.0063 10.2083 19.8935 9.7474 19.0731 8.92693C18.2526 8.10646 17.7917 6.99366 17.7917 5.83334ZM11.543 23.7428C11.6424 23.6852 11.7522 23.6478 11.8661 23.6326C11.9801 23.6174 12.0958 23.6248 12.2069 23.6544C12.3179 23.684 12.4221 23.7351 12.5133 23.805C12.6046 23.8748 12.6812 23.9619 12.7388 24.0613C12.8671 24.2822 13.0511 24.4655 13.2724 24.5929C13.4937 24.7203 13.7446 24.7874 14 24.7874C14.2554 24.7874 14.5063 24.7203 14.7276 24.5929C14.9489 24.4655 15.1329 24.2822 15.2612 24.0613C15.3189 23.9619 15.3956 23.8748 15.4869 23.805C15.5782 23.7352 15.6824 23.6841 15.7935 23.6546C15.9046 23.6251 16.0205 23.6177 16.1344 23.633C16.2483 23.6482 16.3582 23.6857 16.4576 23.7434C16.557 23.8011 16.6441 23.8778 16.7139 23.9691C16.7837 24.0605 16.8348 24.1647 16.8643 24.2758C16.8939 24.3869 16.9012 24.5027 16.886 24.6166C16.8707 24.7306 16.8332 24.8404 16.7755 24.9398C16.4935 25.4262 16.0887 25.8298 15.6016 26.1105C15.1145 26.3911 14.5622 26.5388 14 26.5388C13.4378 26.5388 12.8855 26.3911 12.3984 26.1105C11.9113 25.8298 11.5065 25.4262 11.2245 24.9398C11.1667 24.8404 11.1291 24.7304 11.1138 24.6164C11.0986 24.5024 11.1059 24.3865 11.1355 24.2753C11.1651 24.1641 11.2163 24.0598 11.2862 23.9685C11.3562 23.8771 11.4434 23.8004 11.543 23.7428Z"
                            fill="#FF0000" />
                    </svg>
                </a>
            </button>
        </div>
        <div>
            <h1 class="title-text m-0">Find Your Dream Car Only at OKEEV</h1>
            <p class="subtitle-text">Lorem ipsum dolor sit amet consectetur.</p>
        </div>
    </nav>

    <!-- Content -->
    <div class="content-section p-0">
        <!-- Brands Carousel -->
        <div id="vehicle-brands" class="brand-grid p-4">
            @for ($i = 1; $i <= 8; $i++)
                <div class="brand-wrap mb-2">
                    <div class="brand-item">
                        <img src="{{ asset('front_end/assets/images/logo/1.png') }}" class="brand-logo">
                    </div>
                    <span class="brand-text">BMW</span>
                </div>
            @endfor


        </div>

        <!-- Most Searched Section -->
        <div class="most-searched-section p-3">
            <h3>The newest cars at OKEEV</h3>

            <div class="row">
                <!-- Vehicle Card 1 -->
                <div class="col-md-6 mb-3">
                    <a href="wuling-air-ev.html" class="vehicle-card">
                        <div class="vehicle-img">
                            <img src="{{ asset('front_end/assets/images/logo/mobile/download (3) 1 (1).png') }}"
                                class="car-img" alt="Wuling Air EV">
                        </div>

                        <div class="vehicle-info">
                            <h6 class="mb-1">Wuling</h6>
                            <p class="text-semibold">New Air Ev Lite Long Range</p>

                            <div class="vehicle-specs p-4">
                                <!-- Miles -->
                                <div class="spec-item">
                                    <div class="spec-icon mb-1">
                                        <img src="{{ asset('front_end/assets/images/logo/mobile/ion_speedometer.jpg') }}"
                                            alt="Speedometer Icon" class="spec-icon-img">
                                    </div>
                                    <div class="spec-value">20 Miles</div>
                                </div>

                                <div class="spec-item">
                                    <div class="spec-icon mb-1">
                                        <img src="{{ asset('front_end/assets/images/logo/mobile/material-symbols-light_electric-bolt-rounded.jpg') }}"
                                            alt="Speedometer Icon" class="spec-icon-img">
                                    </div>
                                    <div class="spec-value">Electric</div>
                                </div>

                                <div class="spec-item">
                                    <div class="spec-icon mb-1">
                                        <img src="{{ asset('front_end/assets/images/logo/mobile/Group.jpg') }}"
                                            alt="Speedometer Icon" class="spec-icon-img">
                                    </div>
                                    <div class="spec-value">6 Seat</div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="vehicle-price">IDR 194.000.000</span>

                                <div class="d-flex align-items-center details-link">
                                    <p class="m-0 me-1 mx-1">Details</p>
                                    <img src="{{ asset('front_end/assets/images/logo/mobile/majesticons_arrow-up-line.jpg') }}"
                                        alt="Details Icon" class="details-icon">
                                </div>
                            </div>

                        </div>
                    </a>
                </div>

                <style>
                    .spec-icon {
                        width: 32px;
                        height: 32px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .spec-icon-img {
                        width: 100%;
                        height: 100%;
                        object-fit: contain;
                        /* icon tidak terpotong */
                    }
                </style>

            </div>
        </div>
    </div>

@endsection
