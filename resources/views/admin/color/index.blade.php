@extends('layout.admin')
@section('title', 'Color')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
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
                            <div class="d-flex align-items-center mb-3">
                                <!-- Tombol Kembali -->
                                <a class="me-3" href="{{ route('product.show', $product->slug) }}">
                                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                                            data-bs-toggle="tooltip" title="Kembali">
                                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                                    </button>
                                </a>
                                <!-- Judul -->
                                <h5 class="mb-0">Color List</h5>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Form Search -->
                                <form method="GET" class="d-flex align-items-center my-3" style="max-width: 350px;">
                                    <div class="input-group shadow-sm" style="height: 38px; width: 100%;">
                                        <input type="text" name="name" value="{{ request('name') }}"
                                            class="form-control border-end-0 py-2 px-3" style="font-size: 0.9rem;"
                                            placeholder="Search Technology" aria-label="Search">
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
                                            <h5 class="modal-title" id="addCarModalLabel">Tambah Color</h5>
                                            <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="{{ route('colors.store', $product->slug) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <!-- Nama Warna -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Warna</label>
                                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Pristine White">
                                                            @error('name')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <!-- Color Picker -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Pilih Warna</label>
                                                            <input type="color" name="hex" class="form-control form-control-color" value="{{ old('hex', '#ffffff') }}" title="Pilih warna">
                                                            @error('hex')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <!-- Image dengan preview -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Image</label>
                                                            <input type="file" name="image" class="form-control" id="imageInput">
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
                                        <th>Nama Warna</th>
                                        <th>Hex Warna</th>
                                        <th style="text-align: center">Image</th>
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($colors as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <div style="width: 100px; height: 10px; border: 1px solid #ccc; background-color: {{ $item->hex }};"></div>
                                            </td>
                                            <td style="text-align: center">
                                                @if($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" 
                                                        alt="Color Image" 
                                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                                                @else
                                                    <span class="text-muted">Tidak ada gambar</span>
                                                @endif
                                            </td>


                                          <td class="text-center">
                                                <!-- Edit -->
                                                <a href="{{ route('colors.edit', [$product->slug, $item->id]) }}" 
                                                class="btn btn-icon btn-outline-primary">
                                                        <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <!-- Delete -->
                                                <button class="btn btn-icon btn-outline-danger"
                                                    onclick="confirmDeleteColor('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->name }}')"
                                                    title="Hapus">
                                                <i class="bx bx-trash"></i>
                                                </button>
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
                                {{ $features->appends(request()->input())->links('pagination::bootstrap-4') }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
 <script>
    function confirmDeleteColor(product, colorsId, name) {
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
                window.location.href = `/product/${product}/colors/${colorsId}`;
            }
        });
    }
</script>


{{-- SCRIPT WARNA --}}
<script>
    // Preview gambar
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function(e) {
        const [file] = e.target.files;
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
        }
    });
</script>
@include('sweetalert::alert')
@endsection
