@extends('layout.user')
@section('title', 'testdrive')
@section('content')

<br><br><br><br>
<section class="test-drive-section ">
    <div class="container">
        
        <div class="header-title">
            <a href="/detailwuling" class="text-decoration-none text-dark me-2">
            <i class="bx bx-arrow-back"></i>
            </a>
            Test Drive
        </div>


        <div class="row g-4">
            
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="image-container">
                    <img src="front_end/assets/images/Pristine_White 1.png" alt="New Air Ev Lite Long Range" class="car-image">
                </div>
            </div>

            <div class="col-lg-6  p-5">
                <h4 class="fw-semibold mb-4">New Air Ev Lite Long Range</h4>
                
                <form class="form-grid">
                    <div class="row g-4">
                        
                        <div class="col-6">
                            <input type="text" class="form-control form-control-minimal" placeholder="First Name" required>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control form-control-minimal" placeholder="Second Name" required>
                        </div>
                        
                        <div class="col-6">
                            <input type="tel" class="form-control form-control-minimal" placeholder="Telp" required>
                        </div>
                        <div class="col-6">
                            <input type="email" class="form-control form-control-minimal" placeholder="Email" required>
                        </div>

                        <div class="col-12">
                            <input type="text" class="form-control form-control-minimal" placeholder="City" required>
                        </div>
                        
                        
                        <div class="col-12 mt-4 form-group-icon">
                            <input type="text" class="form-control form-control-minimal" placeholder="Choose Dealer" required>
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
            background-color: #f8f8f8;
        }

        /* Styling Kontainer Gambar */
        .image-container {
            border: 1px solid #cceeff; /* Garis tepi biru muda */
            padding: 10px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%; /* Penting agar container mengisi tinggi kolom */
        }

        .car-image {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Styling Input Minimalis */
        .form-control-minimal {
            border: none;
            border-bottom: 1px solid #ccc; /* Hanya garis bawah */
            border-radius: 0;
            padding: 8px 0;
            box-shadow: none;
            background-color: transparent;
            font-size: 1rem;
        }

        .form-control-minimal:focus {
            border-color: #0d6efd; /* Warna garis bawah saat fokus */
            box-shadow: none;
        }

        /* Styling untuk Input dengan Ikon (City, Dealer) */
        .form-group-icon {
            position: relative;
        }

        .form-group-icon .form-control-minimal {
            padding-right: 25px; /* Beri ruang untuk ikon */
            cursor: pointer;
        }

        .form-group-icon .arrow-icon {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            pointer-events: none; /* Biarkan klik tembus ke input */
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
            border-radius: 50px; /* Bentuk oval/pil */
            transition: opacity 0.3s;
        }

        .btn-test-drive:hover {
            opacity: 0.9;
            color: white; /* Pertahankan warna teks */
        }

        /* Styling Header "Test Drive" */
        .header-title {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 20px;
        }

        /* Responsivitas Grid Form */
        @media (max-width: 768px) {
            .form-grid > div {
                margin-bottom: 20px; /* Tambahkan jarak antar input di layar kecil */
            }
        }
    </style>
@endsection