@extends('layout.user')
@section('title', 'Profil')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <br><br><br>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">

                <!-- Kolom Kiri -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm ">
                        <div class="card-body text-center">

                            <!-- Foto Profil -->
                            {{-- <img src="{{ asset('front_end/assets/images/hero/mobil.png') }}" class="img-fluid rounded mb-3" alt="Profile"> --}}
                            <img src="{{ Auth::user()->image_provile
                                ? asset('storage/' . Auth::user()->image_provile)
                                : asset('front_end/assets/images/hero/mobil.png') }}"
                                class="profile-img rounded mb-3" alt="Profile">


                            <!-- Tombol ganti foto -->
                            <form action="{{ route('profilestore.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Input file disembunyikan -->
                                <input type="file" name="image_provile" id="image_provile" accept="image/*" hidden
                                    onchange="this.form.submit()">

                                <!-- Tombol ganti foto -->
                                <button type="button" class="btn btn-success w-100 mb-2" style="border-radius: 8px;"
                                    onclick="document.getElementById('image_provile').click()">
                                    Change Profile Photo
                                </button>
                            </form>

                            <!-- Info kecil -->
                            <small class="text-muted d-block">
                                File size: maximum 2 Megabytes. Allowed file<br>
                                extensions: JPG, JPEG, PNG
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6 ">
                    <div class="p-3">

                        <!-- Nama -->
                        <h3 class="fw-bold mb-0">{{ $user->name }}</h3>

                        <!-- Email -->
                        <a href="mailto:okeev2025@gmail.com" class="d-block mb-3"
                            style="color: #2ED3C1; text-decoration:none;">
                            {{ $user->email }}
                        </a>

                        <!-- Contact -->
                        <p class="mb-1">
                            <i class="bi bi-telephone text-danger me-2"></i>
                            {{ $user->contact }}
                        </p>

                        <!-- Alamat -->
                        <p>
                            <i class="bi bi-geo-alt text-danger me-2"></i>
                            Jl. Ahmad Yani, Blok 66 17
                        </p>

                        <!-- Garis -->
                        <div class="gradient-divider my-4"></div>
                        <style>
                            .gradient-divider {
                                width: 100%;
                                height: 12px;
                                border-radius: 0px;
                                background: linear-gradient(90deg,
                                        #2f4858 0%,
                                        #2e6f73 25%,
                                        #2fb7a6 55%,
                                        #3ff0c3 100%);
                            }

                            @keyframes loadingGradient {
                                0% {
                                    background-position: 0% 50%;
                                }

                                50% {
                                    background-position: 100% 50%;
                                }

                                100% {
                                    background-position: 0% 50%;
                                }
                            }
                        </style>
                        <!-- Tombol Keluar -->
                        <!-- Logout Form -->
                        <form id="logoutForm" action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark w-100 py-2" style="border-radius: 8px;">
                                <i class="bi bi-box-arrow-right me-2"></i> Keluar
                            </button>
                        </form>

                        <!-- SweetAlert2 CDN (jika belum ada) -->
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const logoutForm = document.getElementById('logoutForm');

                                logoutForm.addEventListener('submit', function(e) {
                                    e.preventDefault(); // hentikan submit default

                                    Swal.fire({
                                        title: 'Keluar?',
                                        text: "Apakah kamu yakin ingin logout?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, keluar!',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            this.submit(); // submit form jika dikonfirmasi
                                        }
                                    });
                                });
                            });
                        </script>



                    </div>
                </div>

            </div>
        </div>
    </section>
    <style>
        .profile-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            /* potong rapi tanpa merusak rasio */
            object-position: center;
            border-radius: 12px;
        }
    </style>
    @include('sweetalert::alert')
@endsection
