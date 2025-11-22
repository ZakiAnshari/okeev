@extends('layout.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-car me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="text-muted fw-light me-1"></span> Cars Overview
            </h4>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h5>Cars Table</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Form Search -->
                                <form method="GET" class="d-flex align-items-center my-3" style="max-width: 350px;">
                                    <div class="input-group shadow-sm" style="height: 38px; width: 100%;">
                                        <input type="text" name="name" value="{{ request('name') }}"
                                            class="form-control border-end-0 py-2 px-3" style="font-size: 0.9rem;"
                                            placeholder="Cari nama user..." aria-label="Search">
                                        <button class="btn btn-outline-primary px-3" type="submit"
                                            style="font-size: 0.9rem;">
                                            <i class="bx bx-search"></i>
                                        </button>
                                    </div>
                                </form>
                                <div class="d-flex gap-2">
                                <!-- Tombol Tambah -->
                                <div class="d-flex justify-content-end">
                                    <button type="button"
                                        class="btn btn-outline-success account-image-reset d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#addCarModal">
                                        <i class="bx bx-plus me-2 d-block"></i>
                                        <span>Tambah</span>
                                    </button>
                                </div>

                                </div>
                            </div>
                            <!-- Modal tambah Data -->
                            <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">

                                        <!-- Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCarModalLabel">Tambah Electric Car</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="cars-add" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Kolom Kiri -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Brand</label>
                                                            <input type="text" name="brand" class="form-control"
                                                                value="{{ old('brand') }}">
                                                            @error('brand')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Model</label>
                                                            <input type="text" name="model" class="form-control"
                                                                value="{{ old('model') }}">
                                                            @error('model')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Mileage (km)</label>
                                                            <input type="number" name="mileage" class="form-control"
                                                                value="{{ old('mileage') }}">
                                                            @error('mileage')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Image Wallpaper</label>
                                                            <input type="file" name="image_wallpaper" class="form-control">
                                                            @error('image')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <!-- Kolom Kanan -->
                                                    <div class="col-lg-6">

                                                        <div class="mb-3">
                                                            <label class="form-label">Electric?</label>
                                                            <select name="is_electric" class="form-select">
                                                                <option value="">Pilih</option>
                                                                <option value="1" {{ old('is_electric') == 1 ? 'selected' : '' }}>Ya (Electric)</option>
                                                                <option value="0" {{ old('is_electric') == 0 ? 'selected' : '' }}>Tidak</option>
                                                            </select>
                                                            @error('is_electric')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Seats</label>
                                                            <input type="number" name="seats" class="form-control"
                                                                value="{{ old('seats') }}" max="5" min="2">
                                                            @error('seats')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Price (Rp)</label>
                                                            <input type="text" id="price" name="price" class="form-control"
                                                                value="{{ old('price') }}" autocomplete="off">

                                                            @error('price')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Image Detail</label>
                                                            <input type="file" name="image" class="form-control">
                                                            @error('image')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Image Tambahan</label>

                                                            <input type="file" name="image2" class="form-control mb-2">
                                                            @error('image2')
                                                                <small class="text-danger d-block">{{ $message }}</small>
                                                            @enderror

                                                            <input type="file" name="image3" class="form-control mb-2">
                                                            @error('image3')
                                                                <small class="text-danger d-block">{{ $message }}</small>
                                                            @enderror

                                                            <input type="file" name="image4" class="form-control">
                                                            @error('image4')
                                                                <small class="text-danger d-block">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>



                            <!-- Table Data -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Mileage</th>
                                        <th>Seats</th>
                                        <th>Price</th>
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($cars as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->brand }}</td>
                                            <td>{{ $item->model }}</td>
                                            <td>{{ $item->mileage }} Miles</td>
                                            <td>{{ $item->seats }}</td>
                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                
                                                <a href="{{ url('cars-show/' . $item->id) }}" class="btn btn-icon btn-outline-info" title="Detail">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <a href="{{ url('cars-edit/' . $item->id) }}" class="btn btn-icon btn-outline-primary" title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>

                                                <a href="javascript:void(0)" onclick="confirmDeleteElectrikCar({{ $item->id }}, '{{ $item->model }}')">
                                                    <button class="btn btn-icon btn-outline-danger" title="Hapus">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Data Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-end mt-3">
                                {{ $cars->appends(request()->input())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    <script>
        function confirmDeleteElectrikCar(id, model) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${model}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/cars-destroy/${id}`;
                }
            });
        }
    </script>
    
@include('sweetalert::alert')
@endsection
