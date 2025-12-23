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
                    @php
                        $categoryId = $product->category_id;
                    @endphp

                    {{-- Jika category_id = 1 --}}
                    @if ($categoryId == 1)
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-success border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#technologyModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Technology</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-danger border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#FeatureModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Feature</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#ColorModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Color</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-warning border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#SpecificationModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Specification</span>
                            </button>
                        </div>

                        {{-- Jika category_id = 2 --}}
                    @elseif($categoryId == 2)
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#ColorModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Color</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-danger border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#PowerModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Power</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-success border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#DimensiModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Dimensi</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-warning border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#SuspensiModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Suspensi</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-dark border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#FiturModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Fitur</span>
                            </button>
                        </div>
                        {{-- Category_id lainnya --}}
                    @else
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#ColorModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Color</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button"
                                class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#DetailModal">
                                <i class="bi bi-plus-circle fs-5 me-2"></i><span>Detail</span>
                            </button>
                        </div>
                    @endif
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
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <label class="form-label">Image</label>
                                                            <input type="file" name="image" class="form-control"
                                                                id="imageInput3"
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

                                                        <div class="ms-3">
                                                            <img id="imagePreview3" src="#" alt="Preview"
                                                                style="max-width: 150px; display: none; border-radius: 5px; border: 1px solid #ccc;">
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
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <label class="form-label">Image</label>
                                                            <input type="file" name="image" class="form-control"
                                                                id="imageInput" accept="image/jpeg,image/png,image/jpg">

                                                            <!-- Pemberitahuan Jenis File & Ukuran -->
                                                            <small class="text-muted d-block mt-1">
                                                                Format yang diizinkan: JPG, JPEG, PNG — Maksimal 2MB
                                                            </small>

                                                            @error('image')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="ms-3">
                                                            <img id="imagePreview" src="#" alt="Preview"
                                                                style="max-width: 150px; display: none; border-radius: 5px; border: 1px solid #ccc;">
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
                                                            id="imageInput2">

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
                                                        <img id="imagePreview2" src="#" alt="Preview"
                                                            style="display:none; max-width:150px; border:1px solid #ccc; border-radius:5px;">
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

                        {{-- MODAL TAMBAH UNTUK POWER --}}
                        <div class="modal fade" id="PowerModal" tabindex="-1" aria-labelledby="PowerModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="PowerModalLabel">Tambah Power</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <hr>
                                    <form action="{{ route('powers.store', $product->slug) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered" id="power_table">
                                                        <thead>
                                                            <tr>
                                                                <th>Label</th>
                                                                <th>Nilai</th>
                                                                <th width="50">#</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="powers[0][label]"
                                                                        class="form-control"
                                                                        value="{{ old('powers.0.label') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="powers[0][nilai]"
                                                                        class="form-control"
                                                                        value="{{ old('powers.0.nilai') }}">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-success btn-sm"
                                                                        onclick="addPowerRow()">+</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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

                        {{-- MODAL TAMBAH UNTUK DIMENSI --}}
                        <div class="modal fade" id="DimensiModal" tabindex="-1" aria-labelledby="DimensiModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="DimensiModalLabel">Tambah Dimensi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <hr>
                                    <form action="{{ route('dimensis.store', $product->slug) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered" id="dimensi_table">
                                                        <thead>
                                                            <tr>
                                                                <th>Label</th>
                                                                <th>Nilai</th>
                                                                <th width="50">#</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="dimensis[0][label]"
                                                                        class="form-control"
                                                                        value="{{ old('dimensis.0.label') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="dimensis[0][nilai]"
                                                                        class="form-control"
                                                                        value="{{ old('dimensis.0.nilai') }}">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-success btn-sm"
                                                                        onclick="addDimensiRow()">+</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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

                        {{-- MODAL TAMBAH UNTUK SUSPENSI --}}
                        <div class="modal fade" id="SuspensiModal" tabindex="-1" aria-labelledby="SuspensiModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="SuspensiModalLabel">Tambah Suspensi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <hr>
                                    <form action="{{ route('suspensis.store', $product->slug) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered" id="suspensi_table">
                                                        <thead>
                                                            <tr>
                                                                <th>Label</th>
                                                                <th>Nilai</th>
                                                                <th width="50">#</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="suspensis[0][label]"
                                                                        class="form-control"
                                                                        value="{{ old('suspensis.0.label') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="suspensis[0][nilai]"
                                                                        class="form-control"
                                                                        value="{{ old('suspensis.0.nilai') }}">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-success btn-sm"
                                                                        onclick="addSuspensiRow()">+</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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

                        {{-- MODAL TAMBAH UNTUK FITUR --}}
                        <div class="modal fade" id="FiturModal" tabindex="-1" aria-labelledby="FiturModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="FiturModalLabel">Tambah Fitur</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <hr>
                                    <form action="{{ route('fiturs.store', $product->slug) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered" id="fitur_table">
                                                        <thead>
                                                            <tr>
                                                                <th>Label</th>
                                                                <th>Nilai</th>
                                                                <th width="50">#</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="fiturs[0][label]"
                                                                        class="form-control"
                                                                        value="{{ old('fiturs.0.label') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="fiturs[0][nilai]"
                                                                        class="form-control"
                                                                        value="{{ old('fiturs.0.nilai') }}">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-success btn-sm"
                                                                        onclick="addFiturRow()">+</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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

                        {{-- MODAL UNTUK DETAIL --}}
                        <div class="modal fade" id="DetailModal" tabindex="-1" aria-labelledby="DetailModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="DetailModalLabel">Tambah Detail</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <hr>
                                    <form action="{{ route('details.store', $product->slug) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row  justify-content-center">
                                                <div class="col-lg-8 mb-3">
                                                    <label class="form-label">Label</label>
                                                    <input type="text" name="label" class="form-control"
                                                        value="{{ old('label') }}">
                                                    @error('label')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-8 mb-3">
                                                    <label class="form-label">Nilai</label>
                                                    <textarea name="nilai" id="nilai-editor">{{ old('nilai') }}</textarea>
                                                    @error('nilai')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <!-- CKEditor 5 CDN -->
                                                <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
                                                <script>
                                                    ClassicEditor
                                                        .create(document.querySelector('#nilai-editor'))
                                                        .catch(error => console.error(error));
                                                </script>
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
                                    $categoryId = $product->category_id;

                                    if (!in_array($categoryId, [1, 2])) {
                                        $defaultTab = 'detail';
                                    } else {
                                        $defaultTab = $categoryId == 1 ? 'technology' : 'color';
                                    }

                                    $activeTab = session('tab', request('tab', $defaultTab));
                                @endphp

                                <ul class="nav nav-pills mb-3" role="tablist">

                                    {{-- CATEGORY 1 --}}
                                    @if ($categoryId == 1)
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'technology' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-technology">
                                                <i class="bi bi-cpu fs-5 me-2"></i> Technology
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'feature' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-feature">
                                                <i class="bi bi-stars fs-5 me-2"></i> Feature
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'color' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-color">
                                                <i class="bi bi-palette fs-5 me-2"></i> Color
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'specification' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-specification">
                                                <i class="bi bi-list-check fs-5 me-2"></i> Specification
                                            </button>
                                        </li>
                                    @endif

                                    {{-- CATEGORY 2 --}}
                                    @if ($categoryId == 2)
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'color' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-color">
                                                <i class="bi bi-palette fs-5 me-2"></i> Color
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'power' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-power">
                                                <i class="bi bi-lightning-charge fs-5 me-2"></i> Power
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'dimensi' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-dimensi">
                                                <i class="bi bi-rulers fs-5 me-2"></i> Dimensi
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'suspensi' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-suspensi">
                                                <i class="bx bx-cog fs-5 me-2"></i> Suspensi
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'fitur' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-fitur">
                                                <i class="bx bx-list-check fs-5 me-2"></i> Fitur
                                            </button>
                                        </li>
                                    @endif

                                    {{-- CATEGORY LAINNYA --}}
                                    @if (!in_array($categoryId, [1, 2]))
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'color' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-color">
                                                <i class="bi bi-palette fs-5 me-2"></i> Color
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="nav-link d-flex align-items-center {{ $activeTab == 'detail' ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-detail">
                                                <i class="bx bx-info-circle fs-5 me-2"></i> Detail
                                            </button>
                                        </li>
                                    @endif
                                </ul>


                                <div class="tab-content">
                                    {{-- TEKNOLOGI TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'technology' ? 'show active' : '' }}"
                                        id="navs-pills-top-technology" role="tabpanel">
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
                                        id="navs-pills-top-feature" role="tabpanel">

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
                                                        <td>{{ ($features->currentPage() - 1) * $features->perPage() + $loop->iteration }}
                                                        </td>
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
                                                        <td>{{ ($colors->currentPage() - 1) * $colors->perPage() + $loop->iteration }}
                                                        </td>

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
                                    <div class="tab-pane fade {{ $activeTab == 'specification' ? 'show active' : '' }}"
                                        id="navs-pills-top-specification" role="tabpanel">
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
                                                            <td>{{ ($specifications->currentPage() - 1) * $specifications->perPage() + $loop->iteration }}
                                                            </td>

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
                                    {{-- POWER TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'power' ? 'show active' : '' }}"
                                        id="navs-pills-top-power" role="tabpanel">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5px;">No</th>
                                                    <th>Label</th>
                                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($powers as $item)
                                                    <tr>
                                                        <td>{{ ($powers->currentPage() - 1) * $powers->perPage() + $loop->iteration }}
                                                        </td>
                                                        <td>{{ $item->label }}</td>
                                                        <td class="text-center">
                                                            <!-- Edit -->
                                                            <a href="{{ route('powers.edit', [$product->slug, $item->id]) }}"
                                                                class="btn btn-icon btn-outline-primary">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>
                                                            <!-- Delete -->
                                                            <button class="btn btn-icon btn-outline-danger"
                                                                onclick="confirmDelete('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->label }}', 'powers')"
                                                                title="Hapus">
                                                                <i class="bx bx-trash"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Data Power Kosong</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-3">
                                            {{ $powers->appends(request()->input())->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                    {{-- DIMENSI TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'dimensi' ? 'show active' : '' }}"
                                        id="navs-pills-top-dimensi" role="tabpanel">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5px;">No</th>
                                                    <th>Label</th>
                                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dimensis as $item)
                                                    <tr>
                                                        <td>{{ ($dimensis->currentPage() - 1) * $dimensis->perPage() + $loop->iteration }}
                                                        </td>
                                                        <td>{{ $item->label }}</td>
                                                        <td class="text-center">
                                                            <!-- Edit -->
                                                            <a href="{{ route('dimensis.edit', [$product->slug, $item->id]) }}"
                                                                class="btn btn-icon btn-outline-primary">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>
                                                            <!-- Delete -->
                                                            <button class="btn btn-icon btn-outline-danger"
                                                                onclick="confirmDelete('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->label }}', 'dimensis')"
                                                                title="Hapus">
                                                                <i class="bx bx-trash"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Data Dimensi Kosong</td>
                                                    </tr>
                                                @endforelse
                                        </table>
                                        <div class="d-flex justify-content-end mt-3">
                                            {{ $dimensis->appends(request()->input())->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                    {{-- SUSPENSI TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'suspensi' ? 'show active' : '' }}"
                                        id="navs-pills-top-suspensi" role="tabpanel">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5px;">No</th>
                                                    <th>Label</th>
                                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($suspensis as $item)
                                                    <tr>
                                                        <td>{{ ($suspensis->currentPage() - 1) * $suspensis->perPage() + $loop->iteration }}
                                                        </td>
                                                        <td>{{ $item->label }}</td>
                                                        <td class="text-center">
                                                            <!-- Edit -->
                                                            <a href="{{ route('suspensis.edit', [$product->slug, $item->id]) }}"
                                                                class="btn btn-icon btn-outline-primary">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>
                                                            <!-- Delete -->
                                                            <button class="btn btn-icon btn-outline-danger"
                                                                onclick="confirmDelete('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->label }}', 'suspensis')"
                                                                title="Hapus">
                                                                <i class="bx bx-trash"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Data Suspensi Kosong</td>
                                                    </tr>
                                                @endforelse
                                        </table>
                                        <div class="d-flex justify-content-end mt-3">
                                            {{ $suspensis->appends(request()->input())->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                    {{-- FITUR TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'fitur' ? 'show active' : '' }}"
                                        id="navs-pills-top-fitur" role="tabpanel">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5px;">No</th>
                                                    <th>Label</th>
                                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($fiturs as $item)
                                                    <tr>
                                                        <td>{{ ($fiturs->currentPage() - 1) * $fiturs->perPage() + $loop->iteration }}
                                                        </td>
                                                        <td>{{ $item->label }}</td>
                                                        <td class="text-center">
                                                            <!-- Edit -->
                                                            <a href="{{ route('fiturs.edit', [$product->slug, $item->id]) }}"
                                                                class="btn btn-icon btn-outline-primary">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>
                                                            <!-- Delete -->
                                                            <button class="btn btn-icon btn-outline-danger"
                                                                onclick="confirmDelete('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->label }}', 'fiturs')"
                                                                title="Hapus">
                                                                <i class="bx bx-trash"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Data Fitur Kosong</td>
                                                    </tr>
                                                @endforelse
                                        </table>
                                        <div class="d-flex justify-content-end mt-3">
                                            {{ $fiturs->appends(request()->input())->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>

                                    {{-- DETAIL TABLE --}}
                                    <div class="tab-pane fade {{ $activeTab == 'detail' ? 'show active' : '' }}"
                                        id="navs-pills-top-detail" role="tabpanel">

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5px;">No</th>
                                                    <th>Label</th>
                                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($details as $item)
                                                    <tr>
                                                        <td>{{ ($details->currentPage() - 1) * $details->perPage() + $loop->iteration }}
                                                        </td>
                                                        <td>{{ $item->label }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('details.edit', [$product->slug, $item->id]) }}"
                                                                class="btn btn-icon btn-outline-primary">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>

                                                            <button class="btn btn-icon btn-outline-danger"
                                                                onclick="confirmDelete('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->label }}', 'details')">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">Data Detail Kosong</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-end mt-3">
                                            {{ $details->links('pagination::bootstrap-4') }}
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
