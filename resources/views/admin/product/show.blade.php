@extends('layout.admin')
@section('title', 'Detail')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <!-- Header: Tombol Kembali & Aksi -->
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <!-- Tombol Kembali -->
                <a class="mx-4 my-4" href="{{ route('product.index') }}">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                    </button>
                </a>

                <!-- Tombol Aksi Kanan -->
                <div class="d-flex gap-2 mx-4 my-4">
                    <!-- Technology -->
                    <div class="d-flex justify-content-end">
                        <button type="button"
                            class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#technologyModal">
                            <i class="bi bi-plus-circle fs-5 me-2"></i>
                            <span>Technology</span>
                        </button>
                    </div>

                    <!-- Feature -->
                    <div class="d-flex justify-content-end">
                        <button type="button"
                            class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#FeatureModal">
                            <i class="bi bi-plus-circle fs-5 me-2"></i>
                            <span>Feature</span>
                        </button>
                    </div>

                    <!-- Color -->
                    <div class="d-flex justify-content-end">
                        <button type="button"
                            class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#ColorModal">
                            <i class="bi bi-plus-circle fs-5 me-2"></i>
                            <span>Color</span>
                        </button>
                    </div>

                    <!-- Specification -->
                    <div class="d-flex justify-content-end">
                        <button type="button"
                            class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#SpecificationModal">
                            <i class="bi bi-plus-circle fs-5 me-2"></i>
                            <span>Specification</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Body Card -->
            <div class="card-body">
                <div class="text-nowrap">
                    <div class="row">
                        {{-- MODAL TAMBAH UNTUK TEKNOLOGI --}}
                        <div class="modal fade" id="technologyModal" tabindex="-1" aria-labelledby="addCarModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="technologyModal">Tambah Technology</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <hr>
                                    <form action="{{ route('technologies.store', $product->slug) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">

                                                    <!-- Name -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ old('name') }}">
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Image dengan preview -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" name="image" class="form-control"
                                                            accept="image/png, image/jpg, image/jpeg">

                                                        <!-- Notifikasi Format & Ukuran -->
                                                        <small class="text-muted d-block mt-1">
                                                            Format yang diizinkan: <strong>PNG, JPG, JPEG</strong> —
                                                            Maksimal <strong>2 MB</strong>
                                                        </small>

                                                        @error('image')
                                                            <small class="text-danger d-block">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL TAMBAH UNTUK FEATURE --}}
                        <div class="modal fade" id="FeatureModal" tabindex="-1" aria-labelledby="addCarModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="FeatureModal">Tambah Feature</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <hr>
                                    <form action="{{ route('features.store', $product->slug) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <!-- Name -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ old('name') }}">
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Image dengan preview -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" name="image" class="form-control">
                                                        @error('image')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL TAMBAH UNTUK COLOR --}}
                        <div class="modal fade" id="ColorModal" tabindex="-1" aria-labelledby="addCarModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="FeatureModal">Tambah Color</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <hr>
                                    <form action="{{ route('colors.store', $product->slug) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <!-- Nama Warna -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Warna</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ old('name') }}"
                                                            placeholder="Contoh: Pristine White">
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Color Picker -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Pilih Warna</label>
                                                        <input type="color" name="hex"
                                                            class="form-control form-control-color"
                                                            value="{{ old('hex', '#ffffff') }}" title="Pilih warna">
                                                        @error('hex')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <!-- Image dengan preview -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" name="image" class="form-control"
                                                            id="imageInput">

                                                        <!-- Pemberitahuan -->
                                                        <small class="text-muted d-block mt-1">
                                                            Format yang diperbolehkan: <strong>PNG, JPG, JPEG</strong>. <br>
                                                            Maksimal ukuran file <strong>2 MB</strong>.
                                                        </small>

                                                        @error('image')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>


                                                    <!-- Preview di bawah -->
                                                    <div class="text-center mt-2">
                                                        <img id="imagePreview" src="#" alt="Preview"
                                                            style="
                                                                width: 150px;
                                                                height: 150px;
                                                                object-fit: contain;   /* Biar gambar tidak terlalu besar */
                                                                background: #f8f8f8;   /* Biar kelihatan batas area gambar */
                                                                display: none;
                                                                border-radius: 5px;
                                                                border: 1px solid #ccc;
                                                            ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL TAMBAH UNTUK SPESIFICATION --}}
                        <div class="modal fade" id="SpecificationModal" tabindex="-1"
                            aria-labelledby="addCarModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="SpecificationModal">Tambah Specification</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <hr>
                                    <form action="{{ route('specifications.store', $product->slug) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">

                                                    <!-- Title -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ old('title') }}">
                                                        @error('title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Specifications</label>

                                                            <table class="table table-bordered" id="spec_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Label</th>
                                                                        <th>Nilai</th>
                                                                        <th width="50">#</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><input type="text" name="specs[0][label]"
                                                                                class="form-control">
                                                                        </td>
                                                                        <td><input type="text" name="specs[0][value]"
                                                                                class="form-control">
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-success btn-sm"
                                                                                onclick="addRow()">+</button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Kartu Kiri (Profile & Gambar) -->
                        <div class="col-lg-4 mb-4">
                            <div class="card h-100 border border-1 border-secondary rounded-3">
                                <div class="card-body position-relative">
                                    <!-- Badge Brand -->
                                    <div class="position-absolute end-0 top-0 p-3 mb-5">
                                        <span class="badge bg-primary">{{ $product->brand->name_brand }}</span>
                                    </div>
                                    <br><br>
                                    <!-- Foto Utama -->
                                    <div class="text-center mt-4">
                                        <div class="d-flex justify-content-center align-items-center mb-3"
                                            style="gap:10px;">
                                            <!-- Prev Button -->
                                            <button class="btn btn-sm btn-outline-primary"
                                                data-bs-target="#productAvatarCarousel" data-bs-slide="prev">
                                                ‹
                                            </button>
                                            <!-- Carousel Box -->
                                            <div id="productAvatarCarousel" class="carousel slide"
                                                style="width:200px; height:auto; border-radius:11px; overflow:hidden; background:#f8f9fa;">
                                                <div class="carousel-inner d-flex align-items-center"
                                                    style="height:150px;">
                                                    @if ($product->images->count() > 0)
                                                        @foreach ($product->images as $index => $img)
                                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                <div class="d-flex justify-content-center align-items-center"
                                                                    style="height:150px;">
                                                                    <img src="{{ asset('storage/' . $img->image) }}"
                                                                        class="img-fluid" alt="product-image"
                                                                        style="max-width:100%; max-height:100%; object-fit:contain; padding:10px;">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="carousel-item active">
                                                            <div class="d-flex justify-content-center align-items-center"
                                                                style="height:150px;">
                                                                <img src="{{ asset('no-image.png') }}" class="img-fluid"
                                                                    style="max-width:100%; max-height:100%; object-fit:contain; padding:10px;">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Next Button -->
                                            <button class="btn btn-sm btn-outline-primary"
                                                data-bs-target="#productAvatarCarousel" data-bs-slide="next">
                                                ›
                                            </button>

                                        </div>

                                        <!-- Galeri Gambar 2-4 -->

                                        <!-- Model & Harga -->
                                        <h5 class="mb-1 mt-3">{{ $product->model }}</h5>
                                        <h5 class="mt-2 text-success fw-bold" style="font-size: 1.2rem;">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </h5>
                                        <hr class="my-3">

                                        <!-- Info Miles, Electric, Seats -->
                                        <div class="d-flex justify-content-center gap-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-speedometer2 fs-4 text-primary"></i>
                                                <span>{{ $product->miles }} miles</span>
                                            </div>
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-battery-charging fs-4 text-success"></i>
                                                <span>Electric</span>
                                            </div>

                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-people fs-4 text-info"></i>
                                                <span>{{ $product->seats }} Seat</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kartu Kanan (Personal Detail) -->
                        <div class="col-lg-8">
                            <div class="nav-align-top mb-4">
                                @php
                                    $activeTab = session('tab', request('tab', 'technology'));
                                @endphp
                                <ul class="nav nav-pills mb-3" role="tablist">
                                    <li class="nav-item">
                                        <button type="button"
                                            class="nav-link d-flex align-items-center {{ $activeTab == 'technology' ? 'active' : '' }}"
                                            data-bs-toggle="tab" data-bs-target="#navs-pills-top-home">
                                            <i class="bi bi-cpu fs-5 me-2"></i>
                                            Technology
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button type="button"
                                            class="nav-link d-flex align-items-center {{ $activeTab == 'feature' ? 'active' : '' }}"
                                            data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile">
                                            <i class="bi bi-stars fs-5 me-2"></i>
                                            Feature
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button type="button"
                                            class="nav-link d-flex align-items-center {{ $activeTab == 'color' ? 'active' : '' }}"
                                            data-bs-toggle="tab" data-bs-target="#navs-pills-top-color">
                                            <i class="bi bi-palette fs-5 me-2"></i>
                                            Color
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button type="button"
                                            class="nav-link d-flex align-items-center {{ $activeTab == 'spesification' ? 'active' : '' }}"
                                            data-bs-toggle="tab" data-bs-target="#navs-pills-top-spesification">
                                            <i class="bi bi-list-check fs-5 me-2"></i>
                                            Specification
                                        </button>
                                    </li>
                                </ul>


                                <div class="tab-content">
                                    {{-- TEKNOLOGI TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'technology' ? 'show active' : '' }}"
                                        id="navs-pills-top-home" role="tabpanel">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5px;">No</th>
                                                    <th>Title</th>
                                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($technologies as $item)
                                                    <tr>
                                                        <td>{{ ($technologies->currentPage() - 1) * $technologies->perPage() + $loop->iteration }}
                                                        </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td class="text-center">
                                                            <!-- Edit -->
                                                            <a href="{{ route('technologies.edit', [$product->slug, $item->id]) }}"
                                                                class="btn btn-icon btn-outline-primary" title="Edit">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>
                                                            <!-- Delete -->
                                                            <button class="btn btn-icon btn-outline-danger"
                                                                onclick="confirmDelete('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->name }}', 'technologies')"
                                                                title="Hapus">
                                                                <i class="bx bx-trash"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Data Teknologi Kosong</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <!-- Pagination -->
                                        <div class="d-flex justify-content-end mt-3">
                                            {{ $technologies->appends(request()->input())->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                    {{-- FEATURE  TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'feature' ? 'show active' : '' }}"
                                        id="navs-pills-top-profile" role="tabpanel">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5px;">No</th>
                                                    <th>Title</th>
                                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($features as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td class="text-center">
                                                            <!-- Edit -->
                                                            <a href="{{ route('features.edit', [$product->slug, $item->id]) }}"
                                                                class="btn btn-icon btn-outline-primary">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>
                                                            <!-- Delete -->
                                                            <button class="btn btn-icon btn-outline-danger"
                                                                onclick="confirmDelete('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->name }}', 'features')"
                                                                title="Hapus">
                                                                <i class="bx bx-trash"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Data Feature Kosong</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-3">
                                            {{ $features->appends(request()->input())->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                    {{-- COLOR  TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'color' ? 'show active' : '' }}"
                                        id="navs-pills-top-color" role="tabpanel">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5px;">No</th>
                                                    <th>Nama Warna</th>
                                                    <th>Hex Warna</th>
                                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($colors as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>
                                                            <div
                                                                style="width: 100px; height: 10px; border: 1px solid #ccc; background-color: {{ $item->hex }};">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">

                                                            <!-- Edit -->
                                                            <a href="{{ route('colors.edit', [$product->slug, $item->id]) }}"
                                                                class="btn btn-icon btn-outline-primary">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>
                                                            <!-- Delete -->
                                                            <button class="btn btn-icon btn-outline-danger"
                                                                onclick="confirmDelete('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->name }}', 'colors')"
                                                                title="Hapus">
                                                                <i class="bx bx-trash"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Data Warna Kosong</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>

                                        </table>
                                        <!-- Pagination -->
                                        <div class="d-flex justify-content-end mt-3">
                                            {{ $colors->appends(request()->input())->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                    {{-- SPECIFICATION  TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'spesification' ? 'show active' : '' }}"
                                        id="navs-pills-top-spesification" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5px;">No</th>
                                                        <th style="width: 15px;">Title</th>
                                                        <th>Label</th>
                                                        <th>Nilai</th>
                                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @forelse ($specifications as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>

                                                            <!-- SECTION -->
                                                            <td>{{ $item->title }}</td>
                                                            <!-- TITLE -->
                                                            <td>{{ $item->label }}</td>
                                                            <td>{{ $item->value }}</td>
                                                            <td class="text-center">
                                                                <!-- Edit -->
                                                                <a href="{{ route('specifications.edit', [$product->slug, $item->id]) }}"
                                                                    class="btn btn-icon btn-outline-primary">
                                                                    <i class="bx bx-edit-alt"></i>
                                                                </a>
                                                                <!-- Delete -->
                                                                <button class="btn btn-icon btn-outline-danger"
                                                                    onclick="confirmDelete('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->title }}', 'specifications')"
                                                                    title="Hapus">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">Data Spesification
                                                                Kosong</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <!-- Pagination -->
                                            <div class="d-flex justify-content-end mt-3">
                                                {{ $specifications->appends(request()->input())->links('pagination::bootstrap-4') }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- SCRIPT PENGHPAUSAN --}}

    <script>
        function confirmDelete(product, itemId, name, type) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${name}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/product/${product}/${type}/${itemId}`;
                }
            });
        }
    </script>


    @include('sweetalert::alert')
@endsection
