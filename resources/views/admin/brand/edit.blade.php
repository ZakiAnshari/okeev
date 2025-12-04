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
                        @method('POST')

                        <div class="modal-body">
                            <div class="row">

                                <!-- CATEGORY -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Category</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">-- Pilih Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $brands->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- BRAND NAME -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Brand Name</label>
                                        <input type="text" name="name_brand" class="form-control"
                                            value="{{ old('name_brand', $brands->name_brand) }}" required>
                                        @error('name_brand')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- LOGO BRAND -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Logo Brand</label>
                                        <input type="file" name="image" class="form-control" id="imageInput"
                                            accept="image/*">

                                        {{-- Preview Logo --}}
                                        <div class="d-flex align-items-center mt-3">
                                            <div style="position: relative; display: inline-block;">
                                                <img id="imagePreview"
                                                    src="{{ $brands->image ? asset('storage/' . $brands->image) : '#' }}"
                                                    style="width: 90px; height: 90px; object-fit: cover; border-radius: 6px; border:1px solid #ccc;"
                                                    alt="Preview Logo" {{ $brands->image ? '' : 'style=display:none;' }}>

                                                <button type="button" id="removeImageBtn" class="btn btn-sm btn-danger"
                                                    style="position: absolute; top: -8px; right: -8px; width: 24px; height: 24px; padding: 0; border-radius: 50%; {{ $brands->image ? '' : 'display:none;' }}">
                                                    ×
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Keterangan --}}
                                        <small class="text-muted d-block mt-1">
                                            • Maksimal ukuran file <strong>2MB</strong><br>
                                            • Format diperbolehkan: <strong>JPG, JPEG, PNG</strong><br>
                                            • Logo akan tampil di halaman brand dan bagian navigasi
                                        </small>
                                    </div>
                                </div>

                                <!-- WALLPAPER -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Wallpaper</label>



                                        {{-- Input File --}}
                                        <input type="file" name="wallpaper" id="wallpaperInput"
                                            class="form-control @error('wallpaper') is-invalid @enderror" accept="image/*">

                                        {{-- Preview Wallpaper baru --}}
                                        <div class="d-flex align-items-center mt-3">
                                            <div style="position: relative; display: inline-block;">
                                                <img id="wallpaperPreview" src="#" alt="Preview Wallpaper"
                                                    style="width: 180px; height: 100px; object-fit: cover; border-radius: 6px; border:1px solid #ccc; display:none;">

                                                <button type="button" id="removeWallpaperBtn" class="btn btn-sm btn-danger"
                                                    style="position: absolute; top: -8px; right: -8px; width: 24px; height: 24px; padding: 0; border-radius: 50%; display: none; font-weight: bold;">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                        {{-- Preview Wallpaper lama --}}
                                        @if (!empty($brands->wallpaper))
                                            <div class="mb-2">
                                                <img id="existingWallpaperPreview"
                                                    src="{{ asset('storage/' . $brands->wallpaper) }}"
                                                    alt="Wallpaper Preview" class="img-fluid rounded border"
                                                    style="max-height: 180px;">
                                            </div>
                                        @endif
                                        {{-- Error Message --}}
                                        @error('wallpaper')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        {{-- Keterangan --}}
                                        <small class="text-muted d-block mt-1">
                                            • Maksimal ukuran file <strong>10MB</strong><br>
                                            • Format diperbolehkan: <strong>JPG, JPEG, PNG</strong><br>
                                            • Wallpaper digunakan untuk tampilan detail brand
                                        </small>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <a href="{{ route('brands.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
