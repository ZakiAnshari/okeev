@extends('layout.admin')
@section('title', 'Dashboard')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <!-- Tombol kembali -->
        <div class="d-flex align-items-center border-bottom pb-2 mb-3">
            <a href="{{ route('technologies.index', $product->slug) }}" 
            class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center mx-4 my-4"
            data-bs-toggle="tooltip" 
            title="Kembali">
                <i class="bi bi-arrow-left fs-5 me-1"></i> Kembali
            </a>

            <h4 class="fw-bold d-flex align-items-center my-4">
                Edit Technology
                <i class="bx bx-cog mx-2 text-primary" style="font-size: 1.5rem;"></i>
            </h4>
        </div>

        <div class="card-body">
            <div class="text-nowrap">

                {{-- Tampilkan error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('technologies.update', [$product->slug, $technology->id]) }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label class="form-label">Nama Teknologi</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $technology->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $technology->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="image" class="form-control">

                        @if ($technology->image)
                            <img src="{{ asset('storage/' . $technology->image) }}" 
                                 width="120" class="mt-2 rounded" 
                                 style="cursor:pointer"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imagePreviewModal">
                        @endif
                    </div>

                    <!-- Modal Preview -->
                    <div class="modal fade" id="imagePreviewModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Preview Gambar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $technology->image) }}" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('technologies.index', $product->slug) }}" class="btn btn-outline-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


@include('sweetalert::alert')
@endsection
