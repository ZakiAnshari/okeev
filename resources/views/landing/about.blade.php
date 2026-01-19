@extends('layout.user')
@section('title', 'about')
@section('content')
    @php
        $about = \App\Models\HomeAbout::first();
    @endphp
    <br><br><br><br>
    <section class="mt-5">
        <div class="container position-relative text-center my-5 ">
            <!-- Gambar utama -->
            <img src="{{ asset('front_end/assets/images/logo/Frame 987.png') }}" alt="Customer Collage" class="img-fluid w-100"
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
                transform: translate(-50%, -25%);
                /* Geser sedikit naik biar pas seperti contoh */
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
                        {{ $about->section_label ?? 'About Okeev' }}
                    </p>

                    <h2 class="fw-bold mb-4" style="font-size: 2.4rem; color: #2c3e50; line-height: 1.2;">
                        {{ $about->title_main ?? 'Trusted Multi-Brand\nElectric Car Dealer' }}
                    </h2>
                    <br><br><br><br><br><br><br><br><br>
                    <!-- DIPINDAHKAN KE POSISI PALING BAWAH -->
                    <p style="color: #34495e; font-size: 1.1rem; font-weight: 500; margin-top: 40px;">
                        {{ $about->tagline ?? 'Bringing You Into the Era of Future Mobility' }}
                    </p>

                </div>

                <!-- KANAN -->
                <div class="col-md-6">

                    @if (!empty($about->description_main))
                        <p class="mb-2" style="color: #4d5b69; font-size: 1rem; line-height: 1.7;">
                            {{ $about->description_main }}</p>
                    @endif



                </div>

            </div>
        </div>
    </section>

    <section class="py-5" style="background:#23364B;">
        <div class="container">
            <div class="row align-items-start">

                <!-- Left Title -->
                <div class="col-lg-3 col-md-4 mb-3">
                    <h4 class="fw-bold" style="color:#1FE4D4;">About OKEEV</h4>
                </div>

                <!-- Right Description -->
                <div class="col-lg-9 col-md-8 text-white" style="color:#dce4ea;">
                    <p class="mb-3" style="line-height:1.6;">
                        {{ $about->description_second ?? '' }}
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
                        {{ $about->visi_description ?? 'Menjadi platform terdepan di Asia Tenggara dalam penjualan kendaraan listrik dan elektronik pintar yang mendukung masa depan hijau dan digital.' }}
                    </p>

                    @if (!empty($about->visi_image))
                        <img src="{{ asset('storage/' . $about->visi_image) }}" class="img-fluid mt-4"
                            style="border-radius:16px;">
                    @else
                        <img src="{{ asset('front_end/assets/images/logo/Frame 988.png') }}" class="img-fluid mt-4"
                            style="border-radius:16px;">
                    @endif

                </div>

                <!-- ========================= -->
                <!--        MISI (KANAN)       -->
                <!-- ========================= -->
                <div class="col-md-6">

                    <h2 style="color:#31d2a8; font-weight:700; font-size:2.4rem;">Misi</h2>

                    <!-- Gambar kecil kanan -->
                    <div class="mb-4">
                        @if (!empty($about->misi_image))
                            <img src="{{ asset('storage/' . $about->misi_image) }}" class="img-fluid"
                                style="width:100%; border-radius:12px;">
                        @else
                            <img src="{{ asset('front_end/assets/images/logo/misi.png') }}" class="img-fluid"
                                style="width:100%; border-radius:12px;">
                        @endif
                    </div>

                    <!-- Bullet list misi -->
                    <ul class="list-unstyled" style="color:#2c3e50; font-size:1.05rem; line-height:1.9;">
                        @foreach ([$about->title_1 ?? null, $about->title_2 ?? null, $about->title_3 ?? null, $about->title_4 ?? null] as $item)
                            @if ($item)
                                <li class="d-flex mb-2">
                                    <i class="bi bi-circle-fill me-3"
                                        style="font-size:0.55rem; color:#213b56; margin-top:6px;"></i>
                                    {{ $item }}
                                </li>
                            @endif
                        @endforeach

                        @unless ($about && ($about->title_1 || $about->title_2 || $about->title_3 || $about->title_4))
                            <li class="d-flex mb-2">
                                <i class="bi bi-circle-fill me-3" style="font-size:0.55rem; color:#213b56; margin-top:6px;"></i>
                                Menyediakan akses mudah ke kendaraan listrik dan perangkat elektronik berkualitas tinggi.
                            </li>
                            <li class="d-flex mb-2">
                                <i class="bi bi-circle-fill me-3" style="font-size:0.55rem; color:#213b56; margin-top:6px;"></i>
                                Mendorong adopsi teknologi ramah lingkungan di seluruh lapisan masyarakat.
                            </li>
                            <li class="d-flex mb-2">
                                <i class="bi bi-circle-fill me-3" style="font-size:0.55rem; color:#213b56; margin-top:6px;"></i>
                                Menghadirkan layanan pelanggan berbasis digital yang cepat, aman dan transparan.
                            </li>
                            <li class="d-flex mb-2">
                                <i class="bi bi-circle-fill me-3" style="font-size:0.55rem; color:#213b56; margin-top:6px;"></i>
                                Membangun ekosistem berkelanjutan melalui kolaborasi dengan produsen dan penyedia infrastruktur
                                hijau.
                            </li>
                        @endunless
                    </ul>

                </div>

            </div>

        </div>
    </section>

@endsection
