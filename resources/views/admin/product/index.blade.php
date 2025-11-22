@extends('layout.admin')
@section('title', 'Product')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-category me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="text-muted fw-light me-1"></span> Product
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
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Form Search -->
                                <form method="GET" class="d-flex align-items-center my-3" style="max-width: 350px;">
                                    <div class="input-group shadow-sm" style="height: 38px; width: 100%;">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control border-end-0 py-2 px-3"
                                        placeholder="Cari nama product..." aria-label="Search">

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
                                            <h5 class="modal-title" id="addCarModalLabel">Tambah Product </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="{{ url('products-add') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">

                                                <!-- MAIN INFO -->
                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Brand</label>
                                                    <select name="brand" class="form-control">
                                                        <option value="">-- Pilih Brand --</option>
                                                        @foreach($brands as $brand)
                                                            <option value="{{ $brand->name_brand }}" {{ old('brand') == $brand->name_brand ? 'selected' : '' }}>
                                                                {{ $brand->name_brand }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                 <!-- Category Type -->
                                                <!-- Category Type Dropdown -->
                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Category Type</label>
                                                    <select id="category_type" name="category_type" class="form-control">
                                                        <option value="">-- Pilih Type --</option>
                                                        <option value="cars" {{ old('category_type') == 'cars' ? 'selected' : '' }}>Cars</option>
                                                        <option value="motorcycles" {{ old('category_type') == 'motorcycles' ? 'selected' : '' }}>Motorcycles</option>
                                                    </select>
                                                    @error('category_type')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Model Name</label>
                                                    <input type="text" name="model_name" class="form-control" value="{{ old('model_name') }}">
                                                    @error('model_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                

                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Miles</label>
                                                    <input type="number" name="miles" class="form-control" value="{{ old('miles') }}">
                                                    @error('miles')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Type</label>
                                                    <select name="type" class="form-control">
                                                        <option value="electric" {{ old('type') == 'electric' ? 'selected' : '' }}>Electric</option>
                                                        <option value="hybrid" {{ old('type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                                        <option value="fuel" {{ old('type') == 'fuel' ? 'selected' : '' }}>Fuel</option>
                                                    </select>
                                                    @error('type')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <!-- Seats Input (Hidden by default jika bukan cars) -->
                                                <div class="col-lg-6 mb-3" id="seats_div" style="display: none;">
                                                    <label class="form-label">Seats</label>
                                                    <input type="number" name="seats" class="form-control" value="{{ old('seats') }}">
                                                    @error('seats')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                            <div class="col-lg-6 mb-3" id="cc_div" style="display: none;">
                                                <label class="form-label">CC</label>
                                                <input type="text" name="cc" class="form-control" value="{{ old('cc') }}">
                                                @error('cc')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                                <!-- PRICES -->
                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Regular Price</label>
                                                    <input type="number" name="regular_price" class="form-control" value="{{ old('regular_price') }}">
                                                    @error('regular_price')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Sale Price</label>
                                                    <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
                                                    @error('sale_price')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <!-- INVENTORY -->
                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 0) }}">
                                                    @error('quantity')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Stock Status</label>
                                                    <select name="stock_status" class="form-control">
                                                        <option value="in_stock" {{ old('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                                        <option value="out_of_stock" {{ old('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                                    </select>
                                                    @error('stock_status')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <!-- FLAGS -->
                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label d-block">Featured</label>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="featured">Tandai sebagai Featured</label>
                                                    </div>
                                                </div>

                                                <!-- IMAGES -->
                                                <div class="col-lg-6 mb-3">
                                                    <label class="form-label">Wallpaper Image</label>
                                                    <input type="file" name="image_wallpaper" class="form-control">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label class="form-label">Main Image</label>
                                                    <input type="file" name="image" class="form-control" required>
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label class="form-label">Detail Image 1</label>
                                                    <input type="file" name="image_detail_1" class="form-control">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label class="form-label">Detail Image 2</label>
                                                    <input type="file" name="image_detail_2" class="form-control">
                                                </div>

                                                <div class="col-lg-3 mb-3">
                                                    <label class="form-label">Detail Image 3</label>
                                                    <input type="file" name="image_detail_3" class="form-control">
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
                                        <th>Nama</th>
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($products as $item)
                                        <tr>
                                         <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>

                                            <td>{{ $item->name_category }}</td>
                                        

                                            <td class="text-center">
                                                <a href="{{ url('category/' . $item->slug . '/edit') }}" 
                                                class="btn btn-icon btn-outline-primary" 
                                                title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>

                                                <a href="javascript:void(0)" 
                                                onclick="confirmDeleteCategory('{{ $item->slug }}', '{{ $item->name_category }}')">
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
                                {{ $products->appends(request()->input())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    function confirmDeleteCategory(slug, name_category) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `"${name_category}" akan dihapus secara permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Arahkan ke route GET untuk destroy
                window.location.href = `/category-destroy/${slug}`;
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryType = document.getElementById('category_type');
        const seatsDiv = document.getElementById('seats_div');

        // Fungsi toggle
        function toggleSeats() {
            if(categoryType.value === 'cars') {
                seatsDiv.style.display = 'block';
            } else {
                seatsDiv.style.display = 'none';
            }
        }

        // Jalankan saat load untuk old() value
        toggleSeats();

        // Event listener saat dropdown berubah
        categoryType.addEventListener('change', toggleSeats);
    });
</script>
<!-- JavaScript untuk toggle Seats & CC -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryType = document.getElementById('category_type');
        const seatsDiv = document.getElementById('seats_div'); // dari sebelumnya
        const ccDiv = document.getElementById('cc_div');

        function toggleFields() {
            // Seats hanya untuk cars
            if(categoryType.value === 'cars') {
                seatsDiv.style.display = 'block';
            } else {
                seatsDiv.style.display = 'none';
            }

            // CC hanya untuk motorcycles
            if(categoryType.value === 'motorcycles') {
                ccDiv.style.display = 'block';
            } else {
                ccDiv.style.display = 'none';
            }
        }

        // Jalankan saat load untuk old() value
        toggleFields();

        // Event listener saat dropdown berubah
        categoryType.addEventListener('change', toggleFields);
    });
</script>
    
@include('sweetalert::alert')
@endsection
