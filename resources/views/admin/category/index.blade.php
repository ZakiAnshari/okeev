@extends('layout.admin')
@section('title', 'Category')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-category me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="text-muted fw-light me-1"></span> Category
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
                                <div class="d-flex gap-2  mb-3">
                                    <!-- Tombol Tambah -->
                                    <div class="d-flex  ">
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
                                            <h5 class="modal-title" id="addCarModalLabel">Tambah Category </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="category-add" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row justify-content-center">
                                                    <div class="row">
                                                        <!-- Select Category Position -->
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">Category Position</label>
                                                                <select name="category_position_id" class="form-control">
                                                                    <option value="">-- Pilih Position --</option>
                                                                    @foreach ($positions as $pos)
                                                                        @if ($pos->id != 1)
                                                                            <option value="{{ $pos->id }}">
                                                                                {{ $pos->category_position }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>

                                                                @error('category_position_id')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Nama Category -->
                                                        <div class="col-lg-8">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Category</label>
                                                                <input type="text" name="name_category"
                                                                    class="form-control" value="{{ old('name_category') }}">

                                                                @error('name_category')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
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
                            <!-- Table Data -->
                            <table id="categoryTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Posisi</th>
                                        <th>Nama Category</th>
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorys as $item)
                                        <tr>
                                            <td></td> {{-- auto-number by DataTables --}}
                                            <td>{{ $item->position->category_position ?? '-' }}</td>

                                            <td>{{ $item->name_category }}</td>

                                            <td class="text-center">
                                                {{-- EDIT --}}
                                                @if ($item->category_position_id != 1)
                                                    <a href="{{ url('category/' . $item->slug . '/edit') }}"
                                                        class="btn btn-icon btn-outline-primary" title="Edit">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-secondary">--</span>
                                                @endif

                                                {{-- AKHIR EDIT --}}
                                                {{--  HAPUS --}}
                                                @if ($item->category_position_id != 1)
                                                    <a href="javascript:void(0)"
                                                        onclick="confirmDeleteCategory('{{ $item->slug }}', '{{ $item->name_category }}')">
                                                        <button class="btn btn-icon btn-outline-danger" title="Hapus">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <span class="badge bg-secondary">--</span>
                                                @endif
                                                {{-- AKHIR HAPUS --}}
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
        function confirmDeleteCategory(slug, model_name) {
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
                    window.location.href = `/category-destroy/${slug}`;
                }
            });
        }
    </script>





    @include('sweetalert::alert')
@endsection
