@extends('layout.user')
@section('title', 'Profil')
@section('content')
<link rel="stylesheet" 
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<br><br><br>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            
            <!-- Kolom Kiri -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">

                        <!-- Foto Profil -->
                        <img src="{{ asset('front_end/assets/images/hero/mobil.png') }}" 
                             class="img-fluid rounded mb-3" 
                             alt="Profile">

                        <!-- Tombol ganti foto -->
                        <button class="btn btn-success w-100 mb-2" style="border-radius: 8px;">
                            Change Profile Photo
                        </button>

                        <!-- Info kecil -->
                        <small class="text-muted d-block">
                            File size: maximum 10 Megabytes. Allowed file<br>
                            extensions: JPG, JPEG, PNG
                        </small>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="p-3">

                    <!-- Nama -->
                    <h3 class="fw-bold mb-0">OKEEV</h3>

                    <!-- Email -->
                    <a href="mailto:okeev2025@gmail.com" 
                       class="d-block mb-3" 
                       style="color: #2ED3C1; text-decoration:none;">
                        okeev2025@gmail.com
                    </a>

                    <!-- Contact -->
                    <p class="mb-1">
                        <i class="bi bi-telephone text-danger me-2"></i>
                        +62 857 6765 6789
                    </p>

                    <!-- Alamat -->
                    <p>
                        <i class="bi bi-geo-alt text-danger me-2"></i>
                        Jl. Ahmad Yani, Blok 66 17
                    </p>

                    <!-- Garis -->
                    <div class="w-100 my-4" style="height: 6px; background:#26d0cf; border-radius:4px;"></div>

                    <!-- Tombol Keluar -->
                    <form action="{{ route('user.logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                            class="btn btn-dark w-100 py-2" 
                            style="border-radius: 8px;">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                        </button>
                    </form>


                </div>
            </div>

        </div>
    </div>
</section>

@include('sweetalert::alert')
@endsection

