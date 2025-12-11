@extends('layout.admin')
@section('title', 'Messages')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold d-flex align-items-center my-4">
            <i class="bx bx-user me-2 text-primary" style="font-size: 1.5rem;"></i>
            <span class="text-muted fw-light me-1"></span> Lihat Messages
        </h4>
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('Contact.index') }}">
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
                            <div class="card h-100 border">
                                <div class="card-body position-relative">
                                    {{-- <div class="position-absolute end-0 top-0 p-3">
                                        <span class="badge bg-primary">{{ $contacts->name }}</span>
                                    </div> --}}
                                    <div class="text-center mt-3">
                                        <div class="chat-avatar d-inline-flex mx-auto mb-3">
                                            <img src="{{ asset('backend/assets/img/avatars/' . (Auth::user()->jenis_kelamin === 'Perempuan' ? '6.png' : '1.png')) }}"
                                                alt="user-image" class="user-avatar img-fluid"
                                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 11px;">
                                        </div>
                                        <h5 class="mb-1">{{ $contacts->name }}</h5>
                                        <hr class="my-3">
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            <i class="ti ti-mail me-2 text-primary"></i>
                                            <p class="mb-0">{{ $contacts->email }}</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            <i class="ti ti-phone me-2 text-primary"></i>
                                            <p class="mb-0">{{ $contacts->phone }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Kartu Kanan (Personal Detail) -->
                        <div class="col-lg-8 mb-4">

                            <div class="card h-100 border">
                                <div class="card-header">
                                    <h5 class="mb-0">Messages Details</h5>
                                </div>

                                <div class="card-body">

                                    <div class="mb-3">
                                        <label class="form-label">Subject</label>
                                        <input type="text" class="form-control" value="{{ $contacts->subject }}"
                                            readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Message</label>
                                        <textarea class="form-control" rows="5" readonly>{{ $contacts->message }}</textarea>
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
