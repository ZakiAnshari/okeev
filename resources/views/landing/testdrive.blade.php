@extends('layout.user')
@section('title', 'testdrive')
@section('content')

    <br><br><br><br>
    <section class="test-drive-section ">
        <div class="container">


            <div class="header-title">
                <a href="{{ route('landing.product', $product->slug) }}" class="text-decoration-none text-dark me-2">
                    <i class="bx bx-arrow-back me-2"></i> Test Drive
                </a>
            </div>



            <div class="row g-4">

                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="image-container">
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">

                            <div class="carousel-inner">
                                @foreach ($product->images as $key => $image)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->image) }}" class="d-block w-100 car-image"
                                            alt="{{ $product->model_name }}">
                                    </div>
                                @endforeach
                            </div>
                            <style>
                                .carousel-item {
                                    height: 300px;
                                    /* bebas atur */
                                }

                                .carousel-item img.car-image {
                                    width: 100%;
                                    height: 100%;
                                    object-fit: contain;
                                    /* atau cover */

                                    /* biar rapi */
                                    padding: 10px;
                                    /* opsional */
                                }
                            </style>
                            <!-- prev arrow -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>

                            <!-- next arrow -->
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>

                            <!-- indicators -->
                            <div class="carousel-indicators">
                                @foreach ($product->images as $key => $image)
                                    <button type="button" data-bs-target="#productCarousel"
                                        data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}"
                                        aria-current="{{ $key === 0 ? 'true' : 'false' }}">
                                    </button>
                                @endforeach
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-6  p-5">
                    <h4 class="fw-semibold mb-4">{{ $product->model_name }}</h4>

                    <form action="{{ route('testdrive.store', $product->slug) }}" method="POST" class="form-grid">
                        @csrf

                        <div class="row g-4">

                            <div class="col-6">
                                <div class="position-relative">
                                    <i class="bi bi-person position-absolute top-50 translate-middle-y ms-2 text-muted"></i>

                                    <input type="text" name="first_name" class="form-control form-control-minimal ps-5"
                                        placeholder="First Name" value="{{ old('first_name', Auth::user()->first_name) }}"
                                        required>
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="position-relative">
                                    <i
                                        class="bi bi-person-badge position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
                                    <input type="text" name="second_name" class="form-control form-control-minimal ps-5"
                                        placeholder="Second Name"
                                        value="{{ old('second_name', Auth::user()->second_name) }}" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="position-relative">
                                    <i
                                        class="bi bi-telephone position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
                                    <input type="tel" name="telp" class="form-control form-control-minimal ps-5"
                                        placeholder="Telp" value="{{ old('contact', Auth::user()->contact) }}" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="position-relative">
                                    <i
                                        class="bi bi-envelope position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
                                    <input type="email" name="email" class="form-control form-control-minimal ps-5"
                                        placeholder="Email" value="{{ old('email', Auth::user()->email) }}" required
                                        >
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <i
                                        class="bi bi-geo-alt position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
                                    <input type="text" name="city" class="form-control form-control-minimal ps-5"
                                        placeholder="City" value="{{ old('city', Auth::user()->city) }}" required>
                                </div>
                            </div>


                            <div class="col-12 mt-4">
                                <div class="position-relative">
                                    <i class="bi bi-shop position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
                                    <select name="dealer" class="form-control form-control-minimal ps-5" required>
                                        <option value="" selected disabled>Choose Dealer</option>
                                        <option value="Dealer A">Dealer A</option>
                                        <option value="Dealer B">Dealer B</option>
                                        <option value="Dealer C">Dealer C</option>
                                        <option value="Dealer D">Dealer D</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-test-drive w-100">Test Drive</button>
                            </div>

                            <div class="col-12 mt-3 text-center">
                                <small class="text-muted">We will send this data to your email address.</small>
                            </div>

                        </div>

                    </form>

                </div>

            </div>
        </div>
    </section>


    <style>
        /* CSS Kustom untuk Efek Mirip Gambar */
        .test-drive-section {
            padding: 40px 0;

        }

        /* Styling Kontainer Gambar */
        .image-container {

            /* Garis tepi biru muda */
            padding: 10px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            /* Penting agar container mengisi tinggi kolom */
        }

        .car-image {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Styling Input Minimalis */
        .form-control-minimal {
            border: none;
            border-bottom: 1px solid #ccc;
            /* Hanya garis bawah */
            border-radius: 0;
            padding: 8px 0;
            box-shadow: none;
            background-color: transparent;
            font-size: 1rem;
        }

        .form-control-minimal:focus {
            border-color: #0d6efd;
            /* Warna garis bawah saat fokus */
            box-shadow: none;
        }

        /* Styling untuk Input dengan Ikon (City, Dealer) */
        .form-group-icon {
            position: relative;
        }

        .form-group-icon .form-control-minimal {
            padding-right: 25px;
            /* Beri ruang untuk ikon */
            cursor: pointer;
        }

        .form-group-icon .arrow-icon {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            pointer-events: none;
            /* Biarkan klik tembus ke input */
            font-size: 1rem;
        }

        /* Styling Tombol Gradien */
        .btn-test-drive {
            /* Mengganti warna solid default Bootstrap dengan gradien */
            background: linear-gradient(to right, #00c6ff, #00ff9f);
            border: none;
            color: white;
            font-weight: bold;
            padding: 12px 24px;
            font-size: 1.2rem;
            border-radius: 50px;
            /* Bentuk oval/pil */
            transition: opacity 0.3s;
        }

        .btn-test-drive:hover {
            opacity: 0.9;
            color: white;
            /* Pertahankan warna teks */
        }

        /* Styling Header "Test Drive" */
        .header-title {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 20px;
        }

        /* Responsivitas Grid Form */
        @media (max-width: 768px) {
            .form-grid>div {
                margin-bottom: 20px;
                /* Tambahkan jarak antar input di layar kecil */
            }
        }
    </style>
@endsection
