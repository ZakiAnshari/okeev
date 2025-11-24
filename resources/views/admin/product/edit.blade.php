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
                                <label class="form-label">Category Type</label>
                                <select name="category" class="form-control">
                                    <option value="">-- Pilih Type --</option>
                                    <option value="cars" {{ old('category', $products->category) == 'cars' ? 'selected' : '' }}>Cars</option>
                                    <option value="motorcycles" {{ old('category', $products->category) == 'motorcycles' ? 'selected' : '' }}>Motorcycles</option>
                                </select>
                                @error('category') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <script>
                    document.addEventListener("DOMContentLoaded", function () {

                        const category = document.querySelector('select[name="category"]');
                        const seatsDiv = document.getElementById('seats_div');
                        const ccDiv = document.getElementById('cc_div');

                        function toggleFields() {
                            if (category.value === "cars") {
                                seatsDiv.style.display = "block";
                                ccDiv.style.display = "none";
                            } 
                            else if (category.value === "motorcycles") {
                                seatsDiv.style.display = "none";
                                ccDiv.style.display = "block";
                            } 
                            else {
                                seatsDiv.style.display = "none";
                                ccDiv.style.display = "none";
                            }
                        }

                        // jalankan saat halaman pertama kali dibuka
                        toggleFields();

                        // jalankan saat category diganti
                        category.addEventListener("change", toggleFields);
                    });
                    </script>


                            <!-- BRAND -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Brand</label>
                                <select name="brand" class="form-control">
                                    <option value="">-- Pilih Brand --</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->name_brand }}" 
                                            {{ old('brand', $products->brand) == $brand->name_brand ? 'selected' : '' }}>
                                            {{ $brand->name_brand }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand') 
                                    <small class="text-danger">{{ $message }}</small> 
                                @enderror
                            </div>


                            <!-- MODEL NAME -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Model Name</label>
                                <input type="text" name="model_name" class="form-control"
                                    value="{{ old('model_name', $products->model_name) }}">
                                @error('model_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- MILES -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Miles</label>
                                <input type="number" name="miles" class="form-control"
                                    value="{{ old('miles', $products->miles) }}">
                                @error('miles') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- TYPE -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-control">
                                    <option value="electric" {{ old('type', $products->type) == 'electric' ? 'selected' : '' }}>Electric</option>
                                    <option value="hybrid"   {{ old('type', $products->type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    <option value="fuel"     {{ old('type', $products->type) == 'fuel' ? 'selected' : '' }}>Fuel</option>
                                </select>
                                @error('type') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- SEATS -->

                            <div class="col-lg-6 mb-3" id="seats_div">
                                <label class="form-label">Seats</label>
                                <input type="number" name="seats" class="form-control" value="{{ old('seats', $products->seats) }}">
                            </div>

                            <div class="col-lg-6 mb-3" id="cc_div">
                                <label class="form-label">CC</label>
                                <input type="text" name="cc" class="form-control" value="{{ old('cc', $products->cc) }}">
                            </div>


                        

                            <!-- HARGA -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Harga</label>
                                <input type="text" name="regular_price" id="regular_price" class="form-control"
                                    value="{{ old('regular_price', $products->regular_price) }}">
                                @error('regular_price') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <script>
                    const regularPrice = document.getElementById('regular_price');

                    regularPrice.addEventListener('input', function(e) {
                        let value = this.value.replace(/\D/g, ''); // hapus semua selain angka
                        if(value) {
                            value = new Intl.NumberFormat('id-ID').format(value); // format ribuan pakai titik
                        }
                        this.value = value;
                    });
                    </script>


                            <!-- QUANTITY -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control"
                                    value="{{ old('quantity', $products->quantity) }}">
                                @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- STOCK -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Stock Status</label>
                                <select name="stock_status" class="form-control">
                                    <option value="in_stock"  {{ old('stock_status', $products->stock_status) == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                    <option value="out_of_stock" {{ old('stock_status', $products->stock_status) == 'out_of_stock' ? 'selected' : '' }}>Out Of Stock</option>
                                </select>
                                @error('stock_status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- FEATURED -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Featured</label>
                                <select name="featured" class="form-select">
                                    <option value="0" {{ old('featured', $products->featured) == 0 ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ old('featured', $products->featured) == 1 ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>

                            <!-- WALLPAPER -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Wallpaper Image</label>
                                <input type="file" name="image_wallpaper" class="form-control">
                                <div style="display: flex; justify-content: center; margin-top: 10px;">
                                        <img src="{{ asset('storage/' . $products->image_wallpaper) }}"
                                        style="width:90px;height:90px;margin-top:10px;border-radius:6px;">
                                </div>
                            </div>

                            <!-- MAIN IMAGE -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Main Image</label>
                                <input type="file" name="image" class="form-control">
                                <div style="display: flex; justify-content: center; margin-top: 10px;">
                                        <img src="{{ asset('storage/' . $products->image) }}"
                                        style="width:90px;height:90px;margin-top:10px;border-radius:6px;">
                                </div>
                            </div>

                            <!-- DETAIL 1 -->
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Detail Image 1</label>
                                <input type="file" name="image_detail_1" class="form-control">
                                <div style="display: flex; justify-content: center; margin-top: 10px;">
                                <img src="{{ asset('storage/' . $products->image_detail_1) }}"
                                        style="width:90px;height:90px;margin-top:10px;border-radius:6px;">
                                </div>
                            </div>

                            <!-- DETAIL 2 -->
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Detail Image 2</label>
                                <input type="file" name="image_detail_2" class="form-control">
                                <div style="display: flex; justify-content: center; margin-top: 10px;">
                                        <img src="{{ asset('storage/' . $products->image_detail_2) }}"
                                        style="width:90px;height:90px;margin-top:10px;border-radius:6px;">
                                </div>
                            </div>

                            <!-- DETAIL 3 -->
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Detail Image 3</label>
                                <input type="file" name="image_detail_3" class="form-control">

                                <div style="display: flex; justify-content: center; margin-top: 10px;">
                                    <img src="{{ asset('storage/' . $products->image_detail_3) }}"
                                        style="width:90px;height:90px;border-radius:6px;">
                                </div>
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
