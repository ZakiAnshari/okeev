@extends('layout.admin')
@section('title', 'Edit')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <!-- Tombol kembali -->
        <div class="d-flex align-items-center border-bottom pb-2 mb-3">
            <a class="mx-4 my-4" href="{{ route('features.index', $product->slug) }}">
                <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                    data-bs-toggle="tooltip" title="Kembali">
                    <i class="bi bi-arrow-left fs-5 mx-1"></i>
                </button>
            </a>
            <h4 class="fw-bold d-flex align-items-center my-4">
                Edit color
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
                <form action="{{ route('colors.update', [$product->slug, $colors->id]) }}" 
                    method="POST" 
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Warna</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $colors->name) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Warna</label>
                                    <input 
                                        type="color" 
                                        name="hex" 
                                        id="colorPicker"
                                        class="form-control form-control-color"
                                        value="{{ old('hex', $colors->hex) }}"
                                        title="Pilih warna">

                                  
                                </div>
                        </div>
                      <div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Gambar</label>
        <input type="file" name="image" class="form-control" id="imageInput">

        <div class="mt-2">
            @if ($colors->image)
                <img id="imagePreview" src="{{ asset('storage/' . $colors->image) }}" 
                     class="rounded"
                     style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ccc; cursor: pointer;"
                     data-bs-toggle="modal" 
                     data-bs-target="#imagePreviewModal">
            @else
                <img id="imagePreview" src="#" alt="Preview" 
                     style="display:none; width: 150px; height: 150px; object-fit: cover; border: 1px solid #ccc; border-radius:5px;">
            @endif
        </div>
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


                   
                    </div>

                  

                    <!-- Modal Preview -->
                  

                   <div class="text-end mt-4">
                        <a href="{{ route('colors.index', $product->id) }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

 <script>
                        const picker = document.getElementById('colorPicker');
                        const preview = document.getElementById('colorPreview');

                        picker.addEventListener('input', function() {
                            preview.style.backgroundColor = this.value;
                        });
                    </script>
@include('sweetalert::alert')
@endsection
