@extends('layout.admin')
@section('title', 'Brand')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-purchase-tag-alt me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="text-muted fw-light me-1"></span> Brand
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

                            <div class="d-flex justify-content-end ">
                                <!-- Form Search -->

                                <div class="d-flex gap-2 mb-3">
                                    <!-- Tombol Tambah -->
                                    <div class="d-flex ">
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
                                            <h5 class="modal-title" id="addCarModalLabel">Tambah Brand </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="brands-add" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Category</label>
                                                            <select name="category_id" class="form-control">
                                                                <option value="">-- Pilih Category --</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name_category }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Brand Name</label>
                                                            <input type="text" name="name_brand" class="form-control"
                                                                value="{{ old('name_brand') }}">
                                                            @error('name_brand')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Logo Brand</label>
                                                            <input type="file" name="image" class="form-control"
                                                                id="imageInput" accept="image/*">

                                                            @error('image')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror


                                                            {{-- Keterangan --}}
                                                            <small class="text-muted d-block mt-1">
                                                                • Maksimal ukuran file <strong>2MB</strong><br>
                                                                • Format diperbolehkan: <strong>JPG, JPEG, PNG</strong><br>
                                                                • Logo akan tampil di halaman brand dan bagian navigasi
                                                            </small>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        const imageInput = document.getElementById('imageInput');
                                                        const imagePreview = document.getElementById('imagePreview');

                                                        imageInput.addEventListener('change', function() {
                                                            const file = this.files[0];
                                                            if (file) {
                                                                const reader = new FileReader();
                                                                reader.onload = function(e) {
                                                                    imagePreview.src = e.target.result;
                                                                    imagePreview.style.display = 'block';
                                                                }
                                                                reader.readAsDataURL(file);
                                                            }
                                                        });
                                                    </script>



                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Wallpaper</label>

                                                            {{-- Preview Wallpaper Jika Ada --}}
                                                            @if (!empty($brand->wallpaper))
                                                                <div class="mb-2">
                                                                    <img src="{{ asset('storage/' . $brand->wallpaper) }}"
                                                                        alt="Wallpaper Preview"
                                                                        class="img-fluid rounded border"
                                                                        style="max-height: 180px;">
                                                                </div>
                                                            @endif

                                                            {{-- Input File --}}
                                                            <input type="file" name="wallpaper"
                                                                class="form-control @error('wallpaper') is-invalid @enderror"
                                                                accept="image/*">

                                                            {{-- Error Message --}}
                                                            @error('wallpaper')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror

                                                            {{-- Keterangan --}}
                                                            <small class="text-muted mt-1">
                                                                • Maksimal ukuran file <strong>10MB</strong><br>
                                                                • Format yang diperbolehkan: <strong>JPG, JPEG,
                                                                    PNG</strong><br>
                                                                • Wallpaper digunakan untuk tampilan detail brand
                                                            </small>
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



                            <!-- Table Data -->
                            <table id="brandTable" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Nama Brand</th>
                                        <th>Logo</th>
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($brands as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name_brand }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="Brand Image"
                                                    style="width: 80px; height: auto; object-fit: cover; border-radius: 5px;">
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('brands.edit', $item->slug) }}"
                                                    class="btn btn-icon btn-outline-primary" title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="confirmDeletebrand('{{ $item->slug }}', '{{ $item->name_brand }}')">
                                                    <button class="btn btn-icon btn-outline-danger" title="Hapus">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Data Brand Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDeletebrand(slug, name_brand) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${name_brand}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Arahkan ke route GET untuk destroy
                    window.location.href = `/brands-destroy/${slug}`;
                }
            });
        }
    </script>

    @include('sweetalert::alert')
@endsection
