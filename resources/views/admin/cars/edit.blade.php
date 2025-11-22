@extends('layout.admin')
@section('title', 'Edit')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <!-- Tombol kembali -->
        <div class="d-flex align-items-center border-bottom pb-2 mb-3">
            <!-- Tombol Kembali -->
            <a class="mx-4 my-4" href="{{ route('cars.index') }}">
                <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                    data-bs-toggle="tooltip" title="Kembali">
                    <i class="bi bi-arrow-left fs-5 mx-1"></i>
                </button>
            </a>
            <!-- Judul Halaman -->
            <h4 class="fw-bold d-flex align-items-center my-4 ">
                <span class="text-muted fw-light me-1"></span> Edit Electric Car
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

                <form action="{{ url(path: 'cars-edit/' . $cars->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="row">

                        <!-- Kolom kiri -->
                        <div class="col-lg-6">

                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" name="brand" class="form-control"
                                    value="{{ old('brand', $cars->brand) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Model</label>
                                <input type="text" name="model" class="form-control"
                                    value="{{ old('model', $cars->model) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mileage (km)</label>
                                <input type="number" name="mileage" class="form-control"
                                    value="{{ old('mileage', $cars->mileage) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image Wallpaper</label>
                                <input type="file" name="image_wallpaper" class="form-control">

                                @if ($cars->image)
                                    <!-- Thumbnail -->
                                    <img src="{{ asset('storage/' . $cars->image_wallpaper) }}" 
                                        width="120" 
                                        class="mt-2 rounded" 
                                        style="cursor:pointer"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#imagePreviewModal">
                                @endif
                            </div>

                            <!-- Modal Preview -->
                            <div class="modal fade" id="imagePreviewModal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Image Wallpaper</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/' . $cars->image_wallpaper) }}" 
                                            class="img-fluid rounded" 
                                            alt="Preview Image">
                                    </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Kolom kanan -->
                        <div class="col-lg-6">

                            <div class="mb-3">
                                <label class="form-label">Electric?</label>
                                <select name="is_electric" class="form-select">
                                    <option value="">Pilih</option>
                                    <option value="1" {{ $cars->is_electric == 1 ? 'selected' : '' }}>Ya (Electric)</option>
                                    <option value="0" {{ $cars->is_electric == 0 ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Seats</label>
                                <input type="number" name="seats" class="form-control"
                                    value="{{ old('seats', $cars->seats) }}" max="5">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price (Rp)</label>
                                <input type="text" id="price" name="price" class="form-control"
                                    value="{{ old('price', number_format($cars->price, 0, ',', '.')) }}" autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image Utama</label>
                                <input type="file" name="image" class="form-control">

                                @if ($cars->image)
                                    <!-- Thumbnail -->
                                    <img src="{{ asset('storage/' . $cars->image) }}" 
                                        width="120" 
                                        class="mt-2 rounded" 
                                        style="cursor:pointer"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#imagePreviewModal">
                                @endif
                            </div>

                            <!-- Modal Preview -->
                            <div class="modal fade" id="imagePreviewModal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Image Utama</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/' . $cars->image) }}" 
                                            class="img-fluid rounded" 
                                            alt="Preview Image">
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image Tambahan</label>

                                <!-- IMAGE 2 -->
                                <input type="file" name="image2" class="form-control mb-2">
                                @if ($cars->image2)
                                    <img src="{{ asset('storage/' . $cars->image2) }}" 
                                        width="100" class="rounded mb-2" 
                                        style="cursor:pointer"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#image2Modal">
                                @endif

                                <!-- IMAGE 3 -->
                                <input type="file" name="image3" class="form-control mb-2">
                                @if ($cars->image3)
                                    <img src="{{ asset('storage/' . $cars->image3) }}" 
                                        width="100" class="rounded mb-2"
                                        style="cursor:pointer"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#image3Modal">
                                @endif

                                <!-- IMAGE 4 -->
                                <input type="file" name="image4" class="form-control">
                                @if ($cars->image4)
                                    <img src="{{ asset('storage/' . $cars->image4) }}" 
                                        width="100" class="rounded mt-2"
                                        style="cursor:pointer"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#image4Modal">
                                @endif
                            </div>

                            <!-- MODAL IMAGE 2 -->
                            <div class="modal fade" id="image2Modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Image 2 </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $cars->image2) }}" class="img-fluid rounded">
                                </div>
                                </div>
                            </div>
                            </div>

                            <!-- MODAL IMAGE 3 -->
                            <div class="modal fade" id="image3Modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Image 3 </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $cars->image3) }}" class="img-fluid rounded">
                                </div>
                                </div>
                            </div>
                            </div>

                            <!-- MODAL IMAGE 4 -->
                            <div class="modal fade" id="image4Modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Image 4 </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $cars->image4) }}" class="img-fluid rounded">
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="text-end btn-page mb-0 mt-4">
                            <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@endsection
