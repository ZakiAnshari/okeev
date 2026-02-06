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
                        <h3 class="fw-bold mb-0">{{ $user->first_name }}</h3>

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
                            {{ $user->city }}
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
                        <!-- Tombol Edit -->
                        <button type="button" class="btn btn-primary w-100 py-2 mb-2" style="border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="bi bi-pencil-square me-2"></i> Edit Profil
                        </button>

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

    <!-- Modal Edit Profil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profilestore.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                id="first_name" name="first_name" 
                                value="{{ old('first_name', Auth::user()->first_name ?? '') }}" required>
                            @error('first_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" 
                                value="{{ old('email', Auth::user()->email ?? '') }}" required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                                id="contact" name="contact" 
                                value="{{ old('contact', Auth::user()->contact ?? '') }}" required>
                            @error('contact')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City / Address</label>
                            <textarea class="form-control @error('city') is-invalid @enderror" 
                                id="city" name="city" rows="4">{{ old('city', Auth::user()->city ?? '') }}</textarea>
                            @error('city')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .profile-img {
            width: 320px;
            height: 320px;
            object-fit: cover;
            /* potong rapi tanpa merusak rasio */
            object-position: center;
            border-radius: 12px;
        }

        /* Prevent scrollbar dari hilang saat modal dibuka */
        html {
            scrollbar-gutter: stable;
        }

        body.modal-open {
            padding-right: 0 !important;
        }
    </style>
    @include('sweetalert::alert')
@endsection
