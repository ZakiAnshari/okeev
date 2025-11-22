@extends('layout.admin')
@section('title', 'Detail')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <!-- Header: Tombol Kembali & Aksi -->
        <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">

            <!-- Tombol Kembali -->
            <a class="mx-4 my-4" href="{{ route('cars.index') }}">
                <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                    <i class="bi bi-arrow-left fs-5 mx-1"></i>
                </button>
            </a>

            <!-- Tombol Aksi Kanan -->
            <div class="d-flex gap-2 mx-4 my-4">
                <!-- Technology -->
                <a href="{{ route('technologies.index', $cars->id) }}" 
                class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                data-bs-toggle="tooltip" title="Technology">
                    <i class="bi bi-cpu fs-5 me-1"></i> Technology
                </a>

                <!-- Feature -->
                <a href="{{ route('features.index', $cars->id) }}">
                    <button class="btn btn-outline-success border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                            data-bs-toggle="tooltip" title="Feature">
                        <i class="bi bi-stars fs-5 me-1"></i> Feature
                    </button>
                </a>

                <!-- Color -->
                <a href="{{ route('colors.index', $cars->id) }}">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                            data-bs-toggle="tooltip" title="Color">
                        <i class="bi bi-palette2 fs-5 me-1"></i>Color
                    </button>
                </a>

                <!-- Specification -->
                <a href="{{ route('specifications.index', $cars->id) }}">
                    <button class="btn btn-outline-info border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                            data-bs-toggle="tooltip" title="Specification">
                        <i class="bi bi-file-text fs-5 me-1"></i> Specification
                    </button>
                </a>
            </div>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <div class="text-nowrap">
                <div class="row">

                    <!-- Kartu Kiri (Profile & Gambar) -->
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 border border-1 border-secondary rounded-3">
                            <div class="card-body position-relative">

                                <!-- Badge Brand -->
                                <div class="position-absolute end-0 top-0 p-3">
                                    <span class="badge bg-primary">{{ $cars->brand }}</span>
                                </div>

                                <!-- Foto Utama -->
                                <div class="text-center mt-4">
                                    <div class="chat-avatar d-inline-flex mx-auto mb-3"
                                        style="width: 150px; height: 150px; border-radius: 11px; overflow: hidden; background-color: #f0f0f0;">
                                        <img src="{{ asset('storage/' . $cars->image) }}"
                                                alt="user-image"
                                                class="user-avatar img-fluid"
                                                style="width: 100%; height: 100%; object-fit: contain;">
                                    </div>

                                    <!-- Galeri Gambar 2-4 -->
                                    <!-- Container grid tetap 3 kolom -->
                                    <div class="d-grid gap-3" style="grid-template-columns: repeat(3, 1fr);">
                                        @foreach(['image2', 'image3', 'image4'] as $index => $img)
                                            @if($cars->$img)
                                            <div class="card border border-1 border-secondary rounded-3">
                                                <div class="card-body p-1 d-flex justify-content-center align-items-center">
                                                    <img src="{{ asset('storage/' . $cars->$img) }}"
                                                        alt="Foto {{ $index + 2 }}"
                                                        class="img-fluid"
                                                        style="width: 100%; height: auto; cursor: pointer; border-radius: 8px;"
                                                        data-bs-toggle="modal" data-bs-target="#modal{{ ucfirst($img) }}">
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal{{ ucfirst($img) }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <img src="{{ asset('storage/' . $cars->$img) }}" class="img-fluid w-100" alt="Foto {{ $index + 2 }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>


                                    <!-- Model & Harga -->
                                    <h5 class="mb-1 mt-3">{{ $cars->model }}</h5>
                                    <h5 class="mt-2 text-success fw-bold" style="font-size: 1.2rem;">
                                        Rp {{ number_format($cars->price, 0, ',', '.') }}
                                    </h5>

                                    <hr class="my-3">

                                    <!-- Info Miles, Electric, Seats -->
                                    <div class="d-flex justify-content-center gap-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-speedometer2 fs-4 text-primary"></i>
                                            <span>{{ $cars->mileage }} miles</span>
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-battery-charging fs-4 text-success"></i>
                                            <span>{{ $cars->is_electric ? 'Electric' : 'Gas' }}</span>
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-people fs-4 text-info"></i>
                                            <span>{{ $cars->seats }} seats</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Kanan (Personal Detail) -->
                    <div class="col-lg-8 mb-4">
                        <div class="card h-100 border border-1 border-secondary rounded-3">
                                <div class="card-header">
                                    <h5 class="mb-0">Header</h5>
                                </div>
                                <hr>
                            <div class="card-body">
                                
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
