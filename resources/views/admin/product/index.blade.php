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
                                        <form action="{{ url('product-add') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Category</label>
                                                        <select id="category_id" name="category_id" class="form-control ">
                                                            <option value="">-- Pilih Category --</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name_category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- Brand -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Brand</label>
                                                        <select name="brand_id" class="form-control select2">
                                                            <option value="">-- Pilih Brand --</option>
                                                            @foreach($brands as $brand)
                                                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                                    {{ $brand->name_brand }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Model Name -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Model Name</label>
                                                        <input type="text" name="model_name" class="form-control" value="{{ old('model_name') }}">
                                                        @error('model_name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Miles -->
                                                    <div class="col-lg-6 mb-3" id="miles_div">
                                                        <label class="form-label">Miles</label>
                                                        <input type="number" name="miles" class="form-control" value="{{ old('miles') }}">
                                                        @error('miles')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Seats -->
                                                    <div class="col-lg-6 mb-3" id="seats_div">
                                                        <label class="form-label">Seats</label>
                                                        <input type="number" name="seats" class="form-control" value="{{ old('seats') }}">
                                                        @error('seats')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Price -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Harga</label>
                                                        <input type="text" name="price" id="price" class="form-control rupiah" value="{{ old('price') }}">
                                                        @error('price')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Stock Status -->
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

                                                    <!-- Featured -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Featured</label>
                                                        <select name="featured" id="featured" class="form-control">
                                                            <option value="0" {{ old('featured') == 0 ? 'selected' : '' }}>Tidak</option>
                                                            <option value="1" {{ old('featured') == 1 ? 'selected' : '' }}>Ya (Featured)</option>
                                                        </select>
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="col-12 mb-3" id="description_div">
                                                        <label class="form-label">Deskripsi Produk</label>
                                                        <textarea name="description" id="editor">{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
                                                    <script>
                                                        ClassicEditor
                                                            .create(document.querySelector('#editor'))
                                                            .catch(error => console.error(error));
                                                    </script>

                                                    <!-- Images -->
                                                    <div class="col-12 mb-3">
                                                        <label class="form-label">Foto Produk (Multiple)</label>
                                                        <input type="file" name="images[]" class="form-control" multiple accept="image/png, image/jpg, image/jpeg" required>

                                                        <small class="text-muted d-block">Anda dapat memilih lebih dari 1 gambar.</small>
                                                        <small class="text-muted d-block">Jenis file yang diperbolehkan: <strong>PNG, JPG, JPEG</strong>.</small>
                                                        <small class="text-muted d-block">Ukuran file maksimal: <strong>2MB per gambar</strong>.</small>
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
                                            <th>Kategori</th>
                                            <th>Model</th>
                                            <th>Harga</th>
                                            <th>Stock</th>
                                            
                                            <th style="width: 100px; text-align: center;">Aksi</th>
                                        </tr>
                                </thead>

                                <tbody>
                                    @forelse ($products as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->brand->name_brand }}</td>
                                            <td>{{ $item->category->name_category }}</td>
                                            <td>{{ $item->model_name }}</td>
                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($item->stock_status == 'in_stock')
                                                    <span class="badge bg-label-success">In Stock</span>
                                                @else
                                                    <span class="badge bg-label-danger">Out of Stock</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('product-show/' . $item->slug) }}" class="btn btn-icon btn-outline-info" title="Detail">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <a href="{{ url('product/' . $item->slug . '/edit') }}" 
                                                class="btn btn-icon btn-outline-primary" 
                                                title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>

                                                    <a href="javascript:void(0)" 
                                                    onclick="confirmDeleteproduct('{{ $item->slug }}', '{{ $item->model_name }}')">
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
                            {{-- <div class="d-flex justify-content-end mt-3">
                                {{ $products->appends(request()->input())->links('pagination::bootstrap-4') }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    function confirmDeleteproduct(slug, model_name ) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `"${model_name}" akan dihapus secara permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Arahkan ke route GET untuk destroy
                window.location.href = `/product-destroy/${slug}`;
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryType = document.getElementById('category');
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
        const categoryType = document.getElementById('category');
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

      <script>
    const input = document.getElementById('regular_price');

    input.addEventListener('input', function (e) {
        let value = this.value.replace(/\./g, ""); // hapus semua titik

        // cegah input selain angka
        if (!/^\d*$/.test(value)) {
            value = value.replace(/\D/g, "");
        }

        // format ke ribuan
        this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
</script>


@include('sweetalert::alert')
@endsection
