@extends('layout.user')
@section('title', 'about')
@section('content')
<br><br><br><br>
<section class="mt-5">
    <div class="container position-relative text-center my-5 ">
        <!-- Gambar utama -->
        <img src="{{ asset('front_end/assets/images/logo/Frame 987.png') }}"
                alt="Customer Collage"
                class="img-fluid w-100"
                style="border-radius: 20px;">
        <!-- Overlay teks -->
        <div class="overlay-content">
            <span class="badge bg-success px-4 py-2 mb-3 d-inline-block">
                OKEEV
            </span>

            <h2 class="fw-bold text-dark" style="font-size: 2.2rem;">
                Customer trust is the reason<br>
                we continue to grow.
            </h2>

            <p class="mt-3 text-dark" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                We are proud to be part of the journey of many customers who have found
                their dream vehicles & goods here.
            </p>
        </div>
    </div>

    <style>
        .overlay-content {
            position: absolute;
            top: 75%;
            left: 50%;
            transform: translate(-50%, -25%); /* Geser sedikit naik biar pas seperti contoh */
            width: 100%;
            max-width: 700px;
        }
    </style>

</section>

<br><br><br>

<section class="py-5 " style="background-color: #F9F9F9;">
    <div class="container py-5">
        <div class="row align-items-start">

            <!-- KIRI -->
            <div class="col-md-6">

                <p style="color: #1abc9c; font-weight: 500; font-size: 1rem; margin-bottom: 10px;">
                    About Okeev
                </p>

                <h2 class="fw-bold mb-4" style="font-size: 2.4rem; color: #2c3e50; line-height: 1.2;">
                    Trusted Multi-Brand<br>
                    Electric Car Dealer
                </h2>

                <!-- DIPINDAHKAN KE POSISI PALING BAWAH -->
                <p style="color: #34495e; font-size: 1.1rem; font-weight: 500; margin-top: 40px;">
                    Bringing You Into the Era of Future Mobility
                </p>

            </div>

            <!-- KANAN -->
            <div class="col-md-6">

                <p class="mb-2" style="color: #4d5b69; font-size: 1rem; line-height: 1.7;">
                    We are a multi-brand electric car dealership committed to providing 
                    modern, environmentally friendly, and efficient mobility solutions for the 
                    Indonesian people. With a diverse selection of models from leading brands, 
                    we believe every customer deserves a vehicle that suits their needs, 
                    lifestyle, and future driving comfort.
                </p>

                <p class="mb-2" style="color: #4d5b69; font-size: 1rem; line-height: 1.7;">
                    Since our inception, we have focused on transparent, educational, and 
                    reliable service. From vehicle consultations and the purchasing process to 
                    after-sales service, we are here as a partner ready to help you transition 
                    to an electric vehicle safely and confidently.
                </p>

                <p class="mb-2" style="color: #4d5b69; font-size: 1rem; line-height: 1.7;">
                    The trust of hundreds of customers who have purchased vehicles from us 
                    motivates us to continue providing the best experience and improving our 
                    service standards every day.
                </p>

            </div>

        </div>
    </div>
</section>


<section class="py-5">
    <div class="container py-4">

        <div class="row">

            <!-- ========================= -->
            <!--        VISI (KIRI)        -->
            <!-- ========================= -->
            <div class="col-md-6 mb-5">

                <h2 style="color:#31d2a8; font-weight:700; font-size:2.4rem;">Visi</h2>

                <p style="color:#4d5b69; font-size:1.1rem; line-height:1.7; max-width:90%;">
                    Menjadi dealer mobil listrik yang paling dipercaya pelanggan
                    melalui kualitas produk, pelayanan tulus, dan pengalaman
                    pembelian yang memberikan rasa aman.
                </p>

                <img src="{{ asset('front_end/assets/images/logo/Frame 988.png') }}"
                     class="img-fluid mt-4"
                     style="border-radius:16px;">

            </div>

            <!-- ========================= -->
            <!--        MISI (KANAN)       -->
            <!-- ========================= -->
            <div class="col-md-6">

                <h2 style="color:#31d2a8; font-weight:700; font-size:2.4rem;">Misi</h2>

                <p style="color:#4d5b69; font-size:1.1rem; line-height:1.7; max-width:85%;">
                    Lorem ipsum dolor sit amet consectetur. Tellus donec netus 
                    aliquam habitant risus facilisis hendrerit.
                </p>

                <!-- Gambar kecil kanan -->
                <div class="mb-4">
                     <img src="{{ asset('front_end/assets/images/logo/misi.png') }}"
                        class="img-fluid"
                        style="width:180px; border-radius:12px;">
                </div>

                <!-- Bullet list misi -->
                <ul class="list-unstyled" style="color:#2c3e50; font-size:1.05rem; line-height:1.9;">
                    <li class="d-flex mb-2">
                        <span class="me-3" 
                              style="width:10px; height:10px; background:#213b56; border-radius:50%; margin-top:9px;">
                        </span>
                        Mengkurasi kendaraan listrik terbaik dengan standar kualitas premium.
                    </li>

                     <li class="d-flex mb-2">
                        <span class="me-3" 
                              style="width:10px; height:10px; background:#213b56; border-radius:50%; margin-top:9px;">
                        </span>
                        Mengkurasi kendaraan listrik terbaik dengan standar kualitas premium.
                    </li>

                   <li class="d-flex mb-2">
                        <span class="me-3" 
                              style="width:10px; height:10px; background:#213b56; border-radius:50%; margin-top:9px;">
                        </span>
                        Mengkurasi kendaraan listrik terbaik dengan standar kualitas premium.
                    </li>

                    <li class="d-flex mb-2">
                        <span class="me-3" 
                              style="width:10px; height:10px; background:#213b56; border-radius:50%; margin-top:9px;">
                        </span>
                        Mengkurasi kendaraan listrik terbaik dengan standar kualitas premium.
                    </li>
                </ul>

            </div>

        </div>

    </div>
</section>

@endsection
