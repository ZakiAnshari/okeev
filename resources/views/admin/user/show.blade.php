@extends('layout.admin')
@section('title', 'User')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold d-flex align-items-center my-4">
            <i class="bx bx-user me-2 text-primary" style="font-size: 1.5rem;"></i>
            <span class="text-muted fw-light me-1"></span> Lihat User
        </h4>
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('user.index') }}">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                        <span class="fw-normal">Kembali</span>
                    </button>
                </a>
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    <div class="row">
                        <!-- Kartu Kiri (Profile) -->
                        <div class="col-lg-4 mb-4">
                            <div class="card h-100 border rounded-4" style="border-color:#E5E7EB;">
                                <div class="card-body position-relative">

                                    <!-- Badge Role -->
                                    <div class="position-absolute end-0 top-0 p-3">
                                        <span class="badge bg-primary rounded-pill px-3">
                                            {{ $users->role->name }}
                                        </span>
                                    </div>

                                    <div class="text-center mt-3">
                                        <div class="chat-avatar d-inline-flex mx-auto mb-3">
                                            <img src="{{ Auth::user()->image_provile
                                                ? asset('storage/' . Auth::user()->image_provile)
                                                : asset('backend/assets/img/avatars/' . (Auth::user()->jenis_kelamin === 'Perempuan' ? '6.png' : '1.png')) }}"
                                                alt="user-image" class="user-avatar"
                                                style="
                                                    width:150px;
                                                    height:150px;
                                                    object-fit:cover;
                                                    border-radius:14px;
                                                    border:3px solid #F1F5F9;
                                                ">
                                        </div>


                                        <h5 class="mb-1 fw-semibold">{{ $users->name }}</h5>

                                        <hr class="my-3">

                                        <div class="d-flex align-items-center justify-content-center mb-2 text-muted">
                                            <i class="ti ti-mail me-2 text-primary"></i>
                                            <span>{{ $users->email }}</span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center mb-2 text-muted">
                                            <i class="ti ti-phone me-2 text-primary"></i>
                                            <span>{{ $users->contact }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kartu Kanan (Personal Detail) -->
                        <div class="col-lg-8 mb-4">
                            <div class="card h-100 border rounded-4" style="border-color:#E5E7EB;">
                                <div class="card-header bg-white border-bottom">
                                    <h5 class="mb-0">Personal Details</h5>
                                </div>

                                <div class="card-body mt-4">
                                    <div class="row g-4">

                                        <!-- Nama Lengkap -->
                                        <div class="col-md-6">
                                            <label class="form-label text-muted">Nama Lengkap</label>
                                            <input type="text" class="form-control bg-light" value="{{ $users->name }}"
                                                readonly style="cursor:default;">
                                        </div>

                                        <!-- Username -->
                                        <div class="col-md-6">
                                            <label class="form-label text-muted">Username</label>
                                            <input type="text" class="form-control bg-light"
                                                value="{{ $users->username }}" readonly style="cursor:default;">
                                        </div>

                                        <!-- Jenis Kelamin -->
                                        <div class="col-md-6">
                                            <label class="form-label text-muted">Jenis Kelamin</label>
                                            <input type="text" class="form-control bg-light"
                                                value="{{ $users->jenis_kelamin }}" readonly style="cursor:default;">
                                        </div>

                                        <!-- Hak Akses -->
                                        @auth
                                            @if (Auth::user()->role_id === 1)
                                                <div class="col-md-6">
                                                    <label class="form-label text-muted">Hak Akses</label>
                                                    <input type="text" class="form-control bg-light"
                                                        value="{{ $users->role->name }}" readonly>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
