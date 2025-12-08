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
                            <div class="d-flex justify-content-end">
                                <!-- Form Search -->

                                <div class="d-flex gap-2">
                                    <!-- Tombol Tambah -->
                                    <div class="d-flex  mb-3">
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
                            <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <!-- Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCarModalLabel">Tambah Product </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="{{ url('product-add') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">

                                                    <!-- Category -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Category</label>
                                                        <select name="category_id" id="category-select" class="form-control"
                                                            required>
                                                            <option value="">-- Pilih Category --</option>
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->id }}"
                                                                    data-position="{{ $cat->category_position_id }}">
                                                                    {{ $cat->name_category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <!-- Brand -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Brand</label>
                                                        <select name="brand_id" id="brand-select" class="form-control"
                                                            required>
                                                            <option value="">-- Pilih Brand --</option>
                                                        </select>
                                                    </div>

                                                    <!-- Model Name -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Model Name</label>
                                                        <input type="text" name="model_name" class="form-control"
                                                            placeholder="Masukkan nama model" required>
                                                    </div>
                                                    <!-- Miles -->
                                                    <div class="col-lg-6 mb-3" id="miles-field">
                                                        <label class="form-label">Miles</label>
                                                        <input type="number" name="miles" class="form-control"
                                                            placeholder="Contoh: 12000">
                                                    </div>

                                                    <!-- Seats -->
                                                    <div class="col-lg-6 mb-3" id="seats-field">
                                                        <label class="form-label">Seats</label>
                                                        <input type="number" name="seats" class="form-control"
                                                            placeholder="Contoh: 4">
                                                    </div>

                                                    <!-- Price -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Price</label>
                                                        <input type="text" id="price" name="price"
                                                            class="form-control" placeholder="Harga produk" required>
                                                    </div>

                                                    <!-- Stock Status -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Stock Status</label>
                                                        <select name="stock_status" class="form-control" required>
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="in_stock">In Stock</option>
                                                            <option value="out_of_stock">Out of Stock</option>
                                                        </select>
                                                    </div>

                                                    <!-- Featured -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Featured</label>
                                                        <select name="featured" class="form-control">
                                                            <option value="0">Tidak</option>
                                                            <option value="1">Ya</option>
                                                        </select>
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="col-12 mb-3" id="description-field">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" id="editor" class="form-control" rows="4" placeholder="Deskripsi produk"></textarea>
                                                    </div>

                                                    <!-- Multiple Images -->
                                                    <div class="col-12 mb-3">
                                                        <label class="form-label">Images</label>
                                                        <input type="file" name="images[]" class="form-control"
                                                            multiple>
                                                        <small class="text-muted">
                                                            Maksimal 5 file. Format gambar: JPG, PNG, atau JPEG. Ukuran
                                                            maksimal per file 2MB.
                                                        </small>
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



                            <!-- Table Data -->
                            <table id="productTable" class="table table-bordered table-striped">
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
                                    @foreach ($products as $item)
                                        <tr>
                                            <td></td> {{-- Auto-number by DataTables --}}
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
                                                <a href="{{ url('product-show/' . $item->slug) }}"
                                                    class="btn btn-icon btn-outline-info" title="Detail">
                                                    <i class="bx bx-show"></i>
                                                </a>

                                                <a href="{{ url('product/' . $item->slug . '/edit') }}"
                                                    class="btn btn-icon btn-outline-primary" title="Edit">
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDeleteproduct(slug, model_name) {
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

    {{-- FORMAT KE RUPIAH --}}
    <script>
        const input = document.getElementById('regular_price');
        input.addEventListener('input', function(e) {
            let value = this.value.replace(/\./g, ""); // hapus semua titik
            // cegah input selain angka
            if (!/^\d*$/.test(value)) {
                value = value.replace(/\D/g, "");
            }
            // format ke ribuan
            this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    </script>
    {{-- INI SCRIPT UNTUK MEBEDAKAN BRAND DI CATEGORY --}}
    <script>
        document.getElementById('category-select').addEventListener('change', function() {
            let categoryId = this.value;

            // Kosongkan dahulu brand
            let brandSelect = document.getElementById('brand-select');
            brandSelect.innerHTML = '<option value="">-- Pilih Brand --</option>';

            if (categoryId) {
                fetch('/get-brands/' + categoryId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(brand => {
                            brandSelect.innerHTML +=
                                `<option value="${brand.id}">${brand.name_brand}</option>`;
                        });
                    });
            }
        });
    </script>
    {{-- SEMBUNYIKAN FORM SESUAI KATEGORI POSITION --}}
    <script>
        const categorySelect = document.getElementById('category-select');

        const milesField = document.getElementById('miles-field');
        const seatsField = document.getElementById('seats-field');
        const descriptionField = document.getElementById('description-field'); // tambahkan id di div textarea

        function checkFields() {
            let selectedOption = categorySelect.options[categorySelect.selectedIndex];
            let positionId = selectedOption.getAttribute('data-position');

            // posisi yang harus disembunyikan untuk miles & seats
            const hiddenPositions = ["2", "3", "4"];

            if (hiddenPositions.includes(positionId)) {
                // hide miles
                milesField.style.display = "none";
                milesField.querySelector('input').value = "";

                // hide seats
                seatsField.style.display = "none";
                seatsField.querySelector('input').value = "";
            } else {
                // show miles
                milesField.style.display = "block";

                // show seats
                seatsField.style.display = "block";
            }

            // hide description jika positionId = 1
            if (positionId === "1") {
                descriptionField.style.display = "none";
                descriptionField.querySelector('textarea').value = "";
            } else {
                descriptionField.style.display = "block";
            }
        }

        categorySelect.addEventListener('change', checkFields);

        // Jalankan ketika halaman pertama di-load
        checkFields();
    </script>




    @include('sweetalert::alert')
@endsection
