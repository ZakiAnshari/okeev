@extends('layout.admin')
@section('title', 'Feature')
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
                                <h5 class="mb-0">Features List</h5>
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
                                            <h5 class="modal-title" id="addCarModalLabel">Tambah Feature</h5>
                                            <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="{{ route('features.store', $product->slug) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-12">

                                                        <!-- Name -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Feature</label>
                                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
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
                                                                <input type="file" name="image" class="form-control" id="imageInput">
                                                                @error('image')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="ms-3">
                                                                <img id="imagePreview" src="#" alt="Preview" style="max-width: 150px; display: none; border-radius: 5px; border: 1px solid #ccc;">
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
                                        <th>Nama Feature</th>
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
                                                    onclick="confirmDeleteFeature('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->name }}')"
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
    function confirmDeleteFeature(product, featureId, name) {
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
                window.location.href = `/product/${product}/features/${featureId}`;
            }
        });
    }
</script>

@include('sweetalert::alert')
@endsection
