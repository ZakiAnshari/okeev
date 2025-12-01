@extends('layout.admin')
@section('title', 'Edit-Dimensi')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <!-- Tombol kembali -->
            <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('product.show', $product->slug) }}?tab=dimensi">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                    </button>
                </a>

                <h4 class="fw-bold d-flex align-items-center my-4">
                    Edit dimensi
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
                    <form action="{{ route('dimensis.update', [$product->slug, $dimensis->id]) }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Label</label>
                                        <input type="text" name="label" class="form-control"
                                            value="{{ old('label', $dimensis->label) }}" required>
                                        @error('label')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nilai</label>
                                        <input type="text" name="nilai" class="form-control"
                                            value="{{ old('nilai', $dimensis->nilai) }}" required>
                                        @error('nilai')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>


    @include('sweetalert::alert')
@endsection
