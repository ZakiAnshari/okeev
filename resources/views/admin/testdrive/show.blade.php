@extends('layout.admin')
@section('title', 'TestDrive')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold d-flex align-items-center my-4">
            <i class="bx bx-user me-2 text-primary" style="font-size: 1.5rem;"></i>
            <span class="text-muted fw-light me-1"></span> Lihat Request
        </h4>
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('testdrive.index') }}">
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
                            <div class="card h-100">
                                <div class="card-body position-relative">
                                    <div class="position-absolute end-0 top-0 p-3">
                                        <span
                                            class="badge 
                                            @if ($testdrives->status == 'pending') bg-warning 
                                            @elseif($testdrives->status == 'approved') bg-primary
                                            @elseif($testdrives->status == 'done') bg-success
                                            @else bg-danger @endif ">
                                                {{ ucfirst($testdrives->status) }}
                                        </span>
                                    </div>
                                    <br>
                                    <div class="text-center mt-3">
                                        <div class="chat-avatar d-inline-flex mx-auto mb-3">
                                            <img src="{{ asset('backend/assets/img/avatars/' . (Auth::user()->jenis_kelamin === 'Perempuan' ? '6.png' : '1.png')) }}"
                                                alt="user-image" class="user-avatar img-fluid"
                                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 11px;">
                                        </div>
                                        <h5 class="mb-1">{{ $testdrives->first_name }}</h5>
                                        <hr class="my-3">
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            <i class="ti ti-mail me-2 text-primary"></i>
                                            <p class="mb-0">{{ $testdrives->email }}</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            <i class="ti ti-phone me-2 text-primary"></i>
                                            <p class="mb-0">{{ $testdrives->telp }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Kartu Kanan (Personal Detail) -->
                        <div class="col-lg-8 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="mb-0">Personal Details</h5>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <!-- Nama Lengkap -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control"
                                                value="{{ $testdrives->first_name }} {{ $testdrives->second_name }}"
                                                readonly>
                                        </div>

                                        <!-- Telepon -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control" value="{{ $testdrives->telp }}"
                                                readonly>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" value="{{ $testdrives->email }}"
                                                readonly>
                                        </div>

                                        <!-- Kota -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Kota</label>
                                            <input type="text" class="form-control" value="{{ $testdrives->city }}"
                                                readonly>
                                        </div>

                                        <!-- Dealer -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Dealer</label>
                                            <input type="text" class="form-control" value="{{ $testdrives->dealer }}"
                                                readonly>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0">Product Details</h5>
                            </div>
                            <div class="card-body">

                                <!-- Gambar Produk -->
                                @if ($testdrives->product->image)
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('storage/' . $testdrives->product->image) }}"
                                            alt="Product Image" class="img-fluid rounded"
                                            style="max-height: 150px; object-fit: cover;">
                                    </div>
                                @endif

                                <!-- Nama Produk -->
                                <div class="mb-3">
                                    <label class="form-label">Nama Mobil</label>
                                    <input type="text" class="form-control"
                                        value="{{ $testdrives->product->model_name }}" readonly>
                                </div>

                                <!-- Brand -->
                                <div class="mb-3">
                                    <label class="form-label">Brand</label>
                                    <input type="text" class="form-control"
                                        value="{{ $testdrives->product->brand->name_brand ?? '-' }}" readonly>
                                </div>

                                <!-- Harga -->
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" class="form-control"
                                        value="Rp {{ number_format($testdrives->product->price, 0, ',', '.') }}" readonly>
                                </div>

                                <!-- Type (opsional) -->
                                @if (isset($testdrives->product->type))
                                    <div class="mb-3">
                                        <label class="form-label">Tipe</label>
                                        <input type="text" class="form-control" value="{{ $testdrives->product->type }}"
                                            readonly>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
