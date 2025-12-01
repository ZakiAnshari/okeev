@extends('layout.admin')
@section('title', 'Edit-Detail')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <!-- Tombol kembali -->
            <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('product.show', $product->slug) }}?tab=detail">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                    </button>
                </a>

                <h4 class="fw-bold d-flex align-items-center my-4">
                    Edit Detail
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
                    <form action="{{ route('details.update', [$product->slug, $details->id]) }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label">Label</label>
                                        <input type="text" name="label" class="form-control"
                                            value="{{ old('label', $details->label) }}" required>
                                        @error('label')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-8 mb-3">
                                    <label class="form-label">Nilai</label>
                                    <textarea name="nilai" id="nilai-editor">{{ old('nilai', $details->nilai) }}</textarea>
                                    @error('nilai')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- CKEditor 5 CDN -->
                                <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#nilai-editor'))
                                        .catch(error => console.error(error));
                                </script>

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
