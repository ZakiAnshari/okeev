@extends('layout.mobile.app')
@section('title', 'Order')
@section('content')
    <style>
        body {
            padding-top: 0px !important;
        }
    </style>

    <div class="mobile-header">

        <div class="container header-container">
            <a href="javascript:void(0)" class="back-btn-img" onclick="history.back()">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="mobile-header-title">CheckOut</div>
        </div>

    </div>

    <br>
    <div class="container my-4 mt-5">
        <img id="carImage"
            src="{{ $product->colors->first()->image ? asset('storage/' . $product->colors->first()->image) : asset('placeholder.png') }}"
            class="card-img-top mb-3 rounded" alt="Car Image">
        <div class=" p-3 shadow-sm" style="max-width: 350px;">
            <!-- Gambar Mobil -->


            <!-- Nama Produk -->
            <h5 class="card-title mb-2">{{ $product->model_name }}</h5>

            <!-- Harga dan Quantity -->
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-danger fw-bold fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</span>

                <div class="input-group" style="width: 110px;">
                    <button class="btn btn-outline-primary" type="button" id="qtyMinus">-</button>
                    <input type="text" class="form-control text-center" value="1" id="qtyInput">
                    <button class="btn btn-outline-primary" type="button" id="qtyPlus">+</button>
                </div>
            </div>
            <hr>
            <!-- Pilih Warna -->
            <div class="d-flex flex-column align-items-center custom-box ">
                <div class="d-flex flex-wrap justify-content-center gap-4 mb-3 mt-4">
                    @forelse($product->colors as $index => $color)
                        <div class="color-circle {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"
                            data-name="{{ $color->name }}" data-image="{{ asset('storage/' . $color->image) }}"
                            style="background: linear-gradient(to bottom, #000 50%, {{ $color->hex }} 50%); cursor: pointer;">
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada warna tersedia</p>
                    @endforelse
                </div>

                <!-- Nama warna -->
                <p class="fw-semibold fs-6 mt-2" id="color-name">{{ $product->colors->first()?->name ?? '' }}
                </p>
            </div>


        </div>
    </div>

    <script>
        // Ambil semua elemen warna
        document.querySelectorAll('.color-circle').forEach(circle => {
            circle.addEventListener('click', function() {
                const image = this.dataset.image; // ambil path gambar
                const colorName = this.dataset.name; // ambil nama warna

                // Update gambar mobil
                document.getElementById('carImage').src = image || '{{ asset('placeholder.png') }}';

                // Update nama warna
                document.getElementById('color-name').innerText = colorName;

                // Highlight warna yang aktif
                document.querySelectorAll('.color-circle').forEach(c => c.style.border = 'none');
                this.style.border = '2px solid #000';
            });
        });
    </script>



    <style>
        .color-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid #ccc;
            cursor: pointer;
            transition: transform 0.2s, border-color 0.2s;
        }

        .color-circle:hover {
            transform: scale(1.1);
            border-color: #000;
        }

        .color-circle.selected {
            border-color: #000;
            box-shadow: 0 0 0 2px #007bff;
        }
    </style>



    <div class="bf-wrapper d-flex justify-content-between align-items-center p-3 border rounded" style="max-width: 400px;">
        <!-- Price -->
        <div class="bf-price" style="display:inline;">
            <span class="bf-price-label">Price</span><br>
            <span class="bf-price-value">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        </div>

        <!-- Button -->
        <div class="bf-actions">
            <form action="{{ route('order.invoice', $product->slug) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="qty" id="qty_input" value="1">

                <input type="hidden" name="color" id="color" value="{{ $product->colors->first()->name }}">

                <input type="hidden" name="price" id="price" value="{{ $product->price }}">
                <input type="hidden" name="grand_total" id="grand_total" value="{{ $product->grand_total }}">

                <button type="submit" class="btn btn-info text-white w-100 py-2 rounded-pill">
                    Payment
                </button>
            </form>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
