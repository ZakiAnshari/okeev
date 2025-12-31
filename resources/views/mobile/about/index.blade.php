@extends('layout.mobile.app')
@section('title', 'About')
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

        body {
            font-family: 'Oxanium', sans-serif;
            background-color: #fff;
            color: #333;
            padding-top: 0 !important;
        }

        /* Header */
        .header {
            background-color: #fff;
            padding: 16px;
            display: flex;
            align-items: center;
            /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
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
            margin-right: 16px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 500;
        }

        /* Content */
        .content {
            padding-bottom: 10px;
        }

        /* Hero Section */
        .hero-section {
            width: 100%;
            padding: 20px;
            padding-top: 25px;
        }

        .hero-image {
            width: 100%;
            /* max-width: 322px; */
            height: auto;
            object-fit: cover;
            border-radius: 12px;
            margin: 0 auto 16px;
            display: block;
        }


        .okeev-badge {
            background: linear-gradient(135deg, var(--light-green) 0%, #00b894 100%);
            color: #30445C;
            padding: 3px 18px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        .tagline {
            text-align: center;
            margin-bottom: 12px;
        }

        .tagline h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .tagline h3 {
            font-size: 16px;
            font-weight: 600;
        }

        .description {
            text-align: center;
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            /* margin-bottom: 30px; */
        }

        /* BAGIAN ATAS  */

        .header {
            display: flex;
            align-items: center;
            padding: 16px;
            background-color: white;
            /* border-bottom: 1px solid #e0e0e0; */
        }

        .header-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .back-btn {
            position: absolute;
            left: 16px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .header {
            position: relative;
            height: 56px;
            display: flex;
            align-items: center;
        }

        .back-btn {
            position: absolute;
            left: 16px;
            font-size: 24px;
            text-decoration: none;
            color: #333;
        }

        .header-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
            font-weight: 500;
        }
    </style>



    <!-- HEADER -->
    <div class="header">
        <div class="container header-container">
            <a href="{{ route('profilm.show') }}" class="back-btn-img">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>

            <div class="header-title">About OKEEV</div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- HERO SECTION -->
        <section class="hero-section">
            <img src="{{ asset('front_end/assets/images/logo/mobile/Group 1004.png') }}" alt="Electric vehicles"
                class="hero-image">

            <div class="okeev-badge-wrapper">
                <span class="okeev-badge">OKEEV</span>
            </div>

            <div class="tagline">
                <h2>Customer trust is the reason</h2>
                <h3>we continue to grow.</h3>
            </div>

            <p class="description">
                We are proud to be part of the journey of many customers who have found their dream vehicles & goods here.
            </p>
        </section>

        <!-- ABOUT SECTION -->
        <section class="container about-section">
            <h3 class="okeev-intro__title">Introducing Okeev</h3>
            <h2 class="okeev-hero-heading">Trusted Multi-Brand Electric Car Dealer</h2>

            <p class="okeev-intro-text">
                Bringing You Into the Era of Future Mobility
            </p>

            <p class="okeev-hero__text">
                Kendaraan listrik adalah inovasi teknologi otomotif yang mampu merubah cara masyarakat Indonesia dalam
                berkendara. Dengan kendaraan listrik, masyarakat berkendara dengan efisien tanpa udara yang tercemar,
                menghemat serta dengan regulasi dan juga estate yang berkembang tetap terkontrol dan tertata maksimum.
            </p>

            <p class="okeev-hero__text">
                Perkembangan mobil listrik di Indonesia mulai menunjukkan momen yang penting. Hal tersebut dapat kita lihat
                mulai dari 2015 bahwa pemerintah sudah mulai melakukan audit kendaraan dan lokal pertama kali telah
                dilaksanakan. Hingga trend saat ini, industri otomotif lokal telah mengembangkan berbagai model mobil
                listrik untuk kepentingan terhadap lingkungan Tanah Air.
            </p>

            <p class="okeev-hero__text m-0">
                OKEEV berperan aktif dalam membantu jalannya kebijakan pemerintah melalui pembangunan infrastruktur
                pendukung, yang terfokus dalam roaming service dan pembangunan pemetaan.
            </p>
        </section>

    </div>

    <!-- SECTION 2 -->
    <section class="section2" style="background: #30445C">
        <div class="container pb-5 pt-5">
            <h1 class="okeev-about-heading">About OKEEV</h1>

            <p class="okeev-hero__text_about">
                OKEEV adalah Startup Inovatif yang berfokus pada penjualan kendaraan listrik baru dan produk elektronik
                modern.
                Berdiri dengan visi untuk mempercepat transisi menuju gaya hidup berkelanjutan dan cerdas.
            </p>

            <p class="okeev-hero__text_about">
                Kami menggabungkan teknologi digital, layanan pelanggan unggul, dan kemitraan strategis dengan berbagai
                merek
                terkemuka untuk menghadirkan pengalaman belanja yang mudah, transparan, dan terpercaya baik secara Online
                maupun Offline.
            </p>
        </div>
    </section>

    <section class="section3">
        <div class="container pb-4 pt-4">
            <h1 class="okeev-about-Visi">Visi</h1>
            <p class="okeev-hero__text_visi">
                Menjadi dealer mobil listrik yang paling dipercaya pelanggan melalui kualitas produk, pelayanan tulus, dan
                pengalaman pembelian yang memberikan rasa aman.
            </p>

            <div class="okeev-visi-image">
                <img src="{{ asset('front_end/assets/images/logo/mobile/man-woman-closing-deal 1.jpg') }}" alt="Visi OKEEV"
                    class="okeev-visi-img">
            </div>
        </div>

        <div class="container pb-4 ">
            <h1 class="okeev-about-Visi">Misi</h1>


            <div class="okeev-visi-image">
                <img src="{{ asset('front_end/assets/images/logo/mobile/young-couple-talking-sales-person-car-showroom 1.jpg') }}"
                    alt="Misi OKEEV" class="okeev-visi-img">
            </div>

            <ul class="bullet-list">
                <li>Menyediakan akses mudah ke kendaraan listrik dan produk terberkualitas tinggi.</li>
                <li>Memberikan adopsi teknologi ramah lingkungan di seluruh lapisan masyarakat.</li>
                <li>Membangun layanan pelanggan berbasis digital yang cepat, aman dan transparan.</li>
                <li>Membangun ekosistem berkelanjutan melalui dengan jaringan penjualan dan penyedia infrastruktur hijau.
                </li>
            </ul>
        </div>
    </section>

    <section class="section3 pt-4 " style="background:#30445Ced">
        <div class="container">
            <h1 class="okeev-about-servise mb-5">Product & Services</h1>

            <div class="row okeev-about-frame-grid pb-4">

                <div class="okeev-about-frame-col">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Frame 1020.png') }}" alt="Image Left"
                        class="okeev-about-frame-img">

                    <p class="okeev-about-frame-text">
                        ELECTRIC <br> CAR
                    </p>
                </div>

                <div class="okeev-about-frame-col">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Frame 1019.png') }}" alt="Image Right"
                        class="okeev-about-frame-img">

                    <p class="okeev-about-frame-text">
                        ELECTRIC <br> MOTOR
                    </p>
                </div>

            </div>

            <div class="row okeev-about-frame-grid pb-4">

                <div class="okeev-about-frame-col">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Frame 1023.png') }}" alt="Image Left"
                        class="okeev-about-frame-img">

                    <p class="okeev-about-frame-text">
                        MOTORCYCLE
                    </p>
                </div>

                <div class="okeev-about-frame-col">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Frame 1025.png') }}" alt="Image Right"
                        class="okeev-about-frame-img">

                    <p class="okeev-about-frame-text">
                        EV ACCESSORIES <br>
                        & SPARE PARTS
                    </p>
                </div>

            </div>

            <div class="row okeev-about-frame-grid pb-4" style="display: flex; justify-content: center;">

                <div class="okeev-about-frame-col"
                    style="display: flex; flex-direction: column; align-items: center; text-align: center;">

                    <img src="{{ asset('front_end/assets/images/logo/mobile/Frame 1027.png') }}" alt="Consultation Services"
                        class="okeev-about-frame-img" style="width: clamp(100px, 20vw, 200px); height: auto;">


                    <p class="okeev-about-frame-text">
                        CONSULTATION SERVICES <br>
                        PURCHASING & FINANCING
                    </p>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container py-4 okeev-section">

            <!-- Electronic and Smart Devices -->
            <h6 class="okeev-title mb-3">Electronic and Smart Devices</h6>

            <div class="okeev-card-list mb-4">
                <div class="okeev-card-item">Smart Home Appliances</div>
                <div class="okeev-card-item">Gadget and Accessories Electronics</div>
                <div class="okeev-card-item">Renewable Energy Product</div>
            </div>

            <!-- Support Services -->
            <h6 class="okeev-title mb-3">Support Services</h6>

            <ul class="okeev-support-list">
                <li>Platform E-Commerce berbasis teknologi AI untuk rekomendasi produk</li>
                <li>Program Trade-In dan pembiayaan flexible</li>
                <li>Layanan purna jual dan servis terintegrasi</li>
                <li>Pengiriman cepat dan ramah lingkungan</li>
            </ul>

        </div>
    </section>
@endsection
