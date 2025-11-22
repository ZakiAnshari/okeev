@extends('layout.admin')
@section('title', 'Edit')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <!-- Tombol kembali -->
        <div class="d-flex align-items-center border-bottom pb-2 mb-3">
            <!-- Tombol Kembali -->
            <a class="mx-4 my-4" href="{{ route('brands.index') }}">
                <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                    data-bs-toggle="tooltip" title="Kembali">
                    <i class="bi bi-arrow-left fs-5 mx-1"></i>
                </button>
            </a>
            <!-- Judul Halaman -->
            <h4 class="fw-bold d-flex align-items-center my-4 ">
                <span class="text-muted fw-light me-1"></span> Edit Brand 
                <i class="bx bx-car mx-2 text-primary" style="font-size: 1.5rem;"></i>
            </h4>
        </div>
        
        <div class="card-body">
            <div class="text-nowrap">

                {{-- Tampilkan error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form action="{{ route('brands.update', $brands->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST') <!-- atau PUT jika route diganti -->


                    <div class="row">

                        <!-- Kolom kiri -->
                        <div class="col-lg-6">

                            <!-- NAME BRAND -->
                            <div class="mb-3">
                                <label class="form-label">Brand Name</label>
                                <input type="text" name="name_brand" class="form-control"
                                    value="{{ old('name_brand', $brands->name_brand) }}" required>
                            </div>

                        </div>

                        <div class="col-lg-6">
                        <!-- Kolom kanan -->
                        <div class="mb-3">
                            <label class="form-label">Brand Logo</label>
                            <input type="file" name="image" class="form-control" id="imageInput">

                            <img id="imagePreview"
                                src="{{ $brands->image ? asset('storage/' . $brands->image) : '#' }}"
                                width="120"
                                class="mt-2 rounded shadow"
                                alt="Brand Logo"
                                style="cursor:pointer"
                                data-bs-toggle="modal"
                                data-bs-target="#logoModal">
                        </div>

                        <!-- MODAL PREVIEW -->
                        <div class="modal fade" id="logoModal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Brand Logo Preview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img id="modalImage" src="{{ $brands->image ? asset('storage/' . $brands->image) : '#' }}"
                                            class="img-fluid rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <!-- BUTTON -->
                        <div class="text-end mt-4">
                            <a href="{{ route('brands.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@endsection
