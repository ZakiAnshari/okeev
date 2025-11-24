@extends('layout.admin')
@section('title', 'Brand')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-badge me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="text-muted fw-light me-1"></span> Brand Logo
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
                            <h5>Brand Table</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Form Search -->
                                <form method="GET" class="d-flex align-items-center my-3" style="max-width: 350px;">
                                    <div class="input-group shadow-sm" style="height: 38px; width: 100%;">
                                        <input type="text" name="name" value="{{ request('name') }}"
                                            class="form-control border-end-0 py-2 px-3" style="font-size: 0.9rem;"
                                            placeholder="Cari nama brand..." aria-label="Search">
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
                                            <h5 class="modal-title" id="addCarModalLabel">Tambah Brand </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="brands-add" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-lg-6">
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
                                                            <label class="form-label">Image Brand</label>
                                                            <input type="file" name="image" class="form-control" id="imageInput">

                                                            @error('image')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <!-- Preview + Remove -->
                                                        <div class="d-flex align-items-center mt-3">

                                                            <div style="position: relative; display: inline-block;">
                                                                <!-- Gambar kecil -->
                                                                <img id="imagePreview" 
                                                                    src="#" 
                                                                    alt="Preview"
                                                                    style="width: 90px; height: 90px; object-fit: cover; border-radius: 6px; display:none; border:1px solid #ccc;">
                                                                
                                                                <!-- Tombol close kecil yang elegan -->
                                                                <button type="button"
                                                                    id="removeImageBtn"
                                                                    class="btn btn-sm btn-danger"
                                                                    style="
                                                                        position: absolute;
                                                                        top: -8px;
                                                                        right: -8px;
                                                                        width: 24px;
                                                                        height: 24px;
                                                                        padding: 0;
                                                                        border-radius: 50%;
                                                                        display: none;
                                                                        font-weight: bold;
                                                                    ">
                                                                    ×
                                                                </button>
                                                            </div>

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
                                                <img src="{{ asset('storage/' . $item->image) }}" 
                                                    alt="Brand Image" 
                                                    style="width: 80px; height: auto; object-fit: cover; border-radius: 5px;">
                                            </td>

                                            <td class="text-center">
                                            

                                                <a href="{{ route('brands.edit', $item->slug) }}" 
                                                class="btn btn-icon btn-outline-primary" 
                                                title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>


                                                <a href="javascript:void(0)" 
                                                  onclick="confirmDeletebrand('{{ $item->slug }}',  
                                                '{{ $item->name_brand }}')">
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
                                {{ $brands->appends(request()->input())->links('pagination::bootstrap-4') }}
                            </div>
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
