@extends('layout.admin')
@section('title', 'Specifications')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <!-- Tombol kembali -->
            <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('product.show', $product->slug) }}?tab=spesification">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                    </button>
                </a>
                <h4 class="fw-bold d-flex align-items-center my-4">
                    Edit Specification
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

                    <form action="{{ route('specifications.update', [$product->slug, $specifications->id]) }}"
                        method="POST">
                        @csrf
                        @method('POST')



                        {{-- TITLE --}}
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $specifications->title) }}" readonly>
                        </div>

                        {{-- LABEL --}}
                        <div class="mb-3">
                            <label class="form-label">Label</label>
                            <textarea name="label" class="form-control" rows="3" required>{{ old('label', $specifications->label) }}</textarea>

                            @error('label')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Value --}}
                        <div class="mb-3">
                            <label class="form-label">Nilai</label>
                            <textarea name="value" class="form-control" rows="3" required>{{ old('value', $specifications->value) }}</textarea>

                            @error('value')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="text-end mt-4">
                          
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>



    @include('sweetalert::alert')
@endsection
