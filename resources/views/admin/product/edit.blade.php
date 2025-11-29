@extends('layout.admin')
@section('title', 'Edit')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <!-- Tombol kembali -->
        <div class="d-flex align-items-center border-bottom pb-2 mb-3">
            <!-- Tombol Kembali -->
            <a class="mx-4 my-4" href="{{ route('product.index') }}">
                <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                    data-bs-toggle="tooltip" title="Kembali">
                    <i class="bi bi-arrow-left fs-5 mx-1"></i>
                </button>
            </a>
            <!-- Judul Halaman -->
            <h4 class="fw-bold d-flex align-items-center my-4 ">
                <span class="text-muted fw-light me-1"></span> Edit Product 
                <i class="bx bx-car mx-2 text-primary" style="font-size: 1.5rem;"></i>
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
                <form action="{{ route('product.update', $products->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <!-- CATEGORY -->
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Category</label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option value="">-- Pilih Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $products->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- BRAND -->
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" class="form-control select2">
                                <option value="">-- Pilih Brand --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id', $products->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name_brand }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- MODEL NAME -->
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Model Name</label>
                            <input type="text" name="model_name" class="form-control"
                                value="{{ old('model_name', $products->model_name) }}">
                            @error('model_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- MILES -->
                        <div class="col-lg-6 mb-3" id="miles_div">
                            <label class="form-label">Miles</label>
                            <input type="number" name="miles" class="form-control"
                                value="{{ old('miles', $products->miles) }}">
                            @error('miles') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- SEATS -->
                        <div class="col-lg-6 mb-3" id="seats_div">
                            <label class="form-label">Seats</label>
                            <input type="number" name="seats" class="form-control"
                                value="{{ old('seats', $products->seats) }}">
                            @error('seats') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- PRICE -->
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" name="price" id="price" class="form-control rupiah"
                            value="{{ old('price', number_format($products->price, 0, ',', '.')) }}">

                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- STOCK STATUS -->
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Stock Status</label>
                            <select name="stock_status" class="form-control">
                                <option value="in_stock"  {{ old('stock_status', $products->stock_status) == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="out_of_stock" {{ old('stock_status', $products->stock_status) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                            @error('stock_status') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- FEATURED -->
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Featured</label>
                            <select name="featured" id="featured" class="form-control">
                                <option value="0" {{ old('featured', $products->featured) == 0 ? 'selected' : '' }}>Tidak</option>
                                <option value="1" {{ old('featured', $products->featured) == 1 ? 'selected' : '' }}>Ya (Featured)</option>
                            </select>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="col-12 mb-3" id="description_div">
                            <label class="form-label">Deskripsi Produk</label>
                            <textarea name="description" id="editor">{{ old('description', $products->description) }}</textarea>
                            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
                        <script>
                            ClassicEditor.create(document.querySelector('#editor'))
                                .catch(error => console.error(error));
                        </script>

                        <!-- MULTIPLE IMAGES -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Foto Produk (Multiple)</label>
                            <input type="file" name="images[]" class="form-control" multiple accept="image/*">

                            <div class="row g-2 mt-3">
                                @foreach($products->images as $img)
                                    <div class="col-3 col-sm-2 col-md-2">
                                        <div class="border rounded overflow-hidden">
                                            <img src="{{ asset('storage/' . $img->image) }}" 
                                                class="img-fluid" 
                                                style="height: 90px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <br>
                            <small class="text-muted d-block">Anda dapat memilih lebih dari 1 gambar.</small>
                            <small class="text-muted d-block">Jenis file yang diperbolehkan: <strong>PNG, JPG, JPEG</strong>.</small>
                            <small class="text-muted d-block">Ukuran file maksimal: <strong>2MB per gambar</
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="text-end mt-4">
                        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@include('sweetalert::alert')
@endsection
