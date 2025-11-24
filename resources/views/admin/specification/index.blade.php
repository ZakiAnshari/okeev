@extends('layout.admin')
@section('title', 'Specification')
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
                                <h5 class="mb-0">Specification List</h5>
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
                                            <h5 class="modal-title" id="addCarModalLabel">Tambah Specification</h5>
                                            <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="{{ route('specifications.store', $product->slug) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- Section -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Section</label>
                                                        <select name="section" class="form-control">
                                                            <option value="">-- Pilih Section --</option>

                                                            <option value="dimension" 
                                                                {{ old('section') == 'dimension' ? 'selected' : '' }}>
                                                                Dimension
                                                            </option>

                                                            <option value="main_battery_powertrain" 
                                                                {{ old('section') == 'main_battery_powertrain' ? 'selected' : '' }}>
                                                                Main Battery And Powertrain
                                                            </option>

                                                            <option value="exterior" 
                                                                {{ old('section') == 'exterior' ? 'selected' : '' }}>
                                                                Exterior
                                                            </option>

                                                            <option value="interior" 
                                                                {{ old('section') == 'interior' ? 'selected' : '' }}>
                                                                Interior
                                                            </option>

                                                            <option value="safety" 
                                                                {{ old('section') == 'safety' ? 'selected' : '' }}>
                                                                Safety
                                                            </option>

                                                            <option value="convenience_multimedia" 
                                                                {{ old('section') == 'convenience_multimedia' ? 'selected' : '' }}>
                                                                Convenience & Multimedia
                                                            </option>
                                                        </select>

                                                        @error('section')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                        <!-- Title -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                                            @error('title')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <!-- Value -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Value</label>
                                                            <textarea name="value" class="form-control" rows="3">{{ old('value') }}</textarea>
                                                            @error('value')
                                                                <small class="text-danger">{{ $message }}</small>
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
                                        <th style="width: 15px;">Section</th>
                                        <th>Title</th>
                                        <th>Value</th>
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($specifications as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <!-- SECTION -->
                                            <td>{{ $item->section }}</td>
                                            <!-- TITLE -->
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->value }}</td>
                                            <td class="text-center">
                                                <!-- Edit -->
                                                <a href="{{ route('specifications.edit', [$product->slug, $item->id]) }}" 
                                                class="btn btn-icon btn-outline-primary">
                                                        <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <!-- Delete -->
                                                <button class="btn btn-icon btn-outline-danger"
                                                    onclick="confirmDeleteSpecification('{{ $product->slug }}', '{{ $item->id }}', '{{ $item->title }}')"
                                                    title="Hapus">
                                                <i class="bx bx-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Data Kosong</td>
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
    function confirmDeleteSpecification(slug, id, title) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `"${title}" akan dihapus secara permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/product/${slug}/specifications/${id}`;
            }
        });
    }
</script>



@include('sweetalert::alert')
@endsection
