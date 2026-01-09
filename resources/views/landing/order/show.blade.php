@extends('layout.user')
@section('title', 'Order-Now')
@section('content')

    <br><br><br><br>
    <section class="py-5">
        <div class="container">

            <!-- Back -->
            <a href="/" class="text-decoration-none d-flex align-items-center mb-4">
                <i class="bx bx-arrow-back me-2"></i> Order Now
            </a>

            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-8">
                    <div class="card shadow-sm p-4 rounded-4">
                        <div class="d-flex flex-column flex-md-row gap-3 align-items-start">

                            <!-- IMAGE -->
                            <div class="product-image-box">
                                @if ($product->colors->isNotEmpty() && $product->colors->first()->image)
                                    <img src="{{ asset('storage/' . $product->colors->first()->image) }}"
                                        class="img-fluid car-preview" id="car-preview" alt="Car"
                                        style="max-height: 320px; width: auto;">
                                @else
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid car-preview"
                                        id="car-preview" alt="Thumbnail" style="max-height: 395px; object-fit: contain;">
                                @endif
                            </div>


                            <!-- TEXT + PRICE + COLORS -->
                            <div class="flex-grow-1">

                                <h5 class="fw-bold mb-1">{{ $product->model_name }}</h5>

                                <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                                    <h5 class="fw-bold text-danger mb-0" id="total-price"
                                        data-price="{{ $product->price }}">
                                        {{ formatRupiah($product->price) }}
                                    </h5>

                                    <!-- Counter -->
                                    <div class="d-flex align-items-center border rounded px-2 py-1"
                                        style="gap: 10px; min-width: 90px; justify-content: center;">
                                        <button class="btn p-0 fw-bold btn-minus" style="font-size: 20px;">-</button>
                                        <span class="fw-bold" id="qty">1</span>
                                        <button class="btn p-0 fw-bold btn-plus" style="font-size: 20px;">+</button>
                                    </div>
                                </div>


                                <hr>

                                <p class="fw-bolder mb-2">Pilih Warna</p>
                                <div class="d-flex flex-wrap gap-2 gap-md-3 justify-content-center">
                                    @forelse($product->colors as $index => $color)
                                        <div class="color-circle {{ $index === 0 ? 'active' : '' }}"
                                            data-index="{{ $index }}" data-name="{{ $color->name }}"
                                            data-image="{{ asset('storage/' . $color->image) }}"
                                            style="background: linear-gradient(to bottom, #000 50%, {{ $color->hex }} 50%);">
                                        </div>
                                    @empty
                                        <p class="text-muted"></p>
                                    @endforelse
                                </div>



                            </div>
                        </div>

                    </div>
                </div>

                <style>
                    .product-image-box {
                        width: 200px;
                        height: 165px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: #f8f9fa;
                        border-radius: 12px;
                        flex-shrink: 0;
                        overflow: hidden;
                    }

                    .product-image {
                        height: 100%;
                        width: auto;
                        object-fit: contain;
                    }

                    .color-circle {
                        width: 45px;
                        height: 45px;
                        border-radius: 50%;
                        border: 1px solid #ddd;
                        cursor: pointer;
                        transition: .25s;
                    }

                    .color-circle:hover {
                        transform: scale(1.15);
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    }

                    /* ---------- RESPONSIVE HP ---------- */
                    @media (max-width: 576px) {

                        .product-image-box {
                            width: 100% !important;
                            height: auto !important;
                        }

                        .product-image {
                            width: 100% !important;
                            height: auto !important;
                            object-fit: contain;
                        }
                    }
                </style>



                <!-- RIGHT SIDE -->
                <div class="col-lg-4">
                    <div class="card  shadow-sm p-4 rounded-4">

                        <!-- Payment Title -->
                        {{-- <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-bold mb-0">Payment Methods</h6>
                            <a href="#" class="small text-decoration-none">See all</a>
                        </div>

                        <!-- Payment List -->
                        <div class="list-group mb-4">

                            @foreach ([['img' => 'Group.png', 'name' => 'BCA Virtual Account'], ['img' => 'Group (1).png', 'name' => 'Mandiri Virtual Account'], ['img' => 'BRIVA-BRI 1.png', 'name' => 'BRI Virtual Account'], ['img' => 'Logo-CIMB-Niaga-Linkqu 1.png', 'name' => 'CIMB Virtual Account']] as $key => $bank)
                                <label
                                    class="list-group-item d-flex align-items-center justify-content-between border-0 payment-item">

                                    <div class="d-flex align-items-center gap-3">
                                        <div class="brand-box">
                                            <img src="{{ asset('front_end/assets/images/' . $bank['img']) }}"
                                                class="brand-img" alt="Bank Logo">
                                        </div>

                                        <span class="fw-semibold">{{ $bank['name'] }}</span>
                                    </div>

                                    <label class="custom-radio">
                                        <input type="radio" name="pay" {{ $key === 0 ? 'checked' : '' }}>
                                        <span></span>
                                    </label>

                                </label>
                            @endforeach

                        </div> --}}

                        {{-- <hr> --}}

                        <!-- Summary -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span id="summary-label">Total price (1 item)</span>
                                <span id="summary-price" style="font-weight: 900; letter-spacing: 1px; color: #00B0E5;">
                                    {{ formatRupiah($product->price) }}
                                </span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span>Service Fee</span>
                                <span class="fw-semibold" id="service-fee">Rp 2.000</span>
                            </div>
                        </div>

                        <hr>

                        <!-- Total Bill -->
                        <div class="d-flex justify-content-between fw-semibold fs-6 mb-3">
                            <span>Total Bill</span>
                            <span id="total-bill" style="font-weight: 900; letter-spacing: 1px; color: #00B0E5;">
                                {{ formatRupiah($product->price + 2000) }}
                            </span>
                        </div>


                        <!-- Payment Button -->
                        <div class="bf-actions">

                            <form action="/order-invoice/{{ $product->slug }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="qty" id="qty_input" value="1">

                                <input type="hidden" name="color" id="color"
                                    value="{{ $product->colors->first()->name }}">

                                <input type="hidden" name="price" id="price" value="{{ $product->price }}">
                                <input type="hidden" name="grand_total" id="grand_total"
                                    value="{{ $product->grand_total }}">

                                <button type="submit" class="btn btn-info text-white w-100 py-2 rounded-pill">
                                    Payment
                                </button>
                            </form>
                        </div>





                    </div>
                </div>

            </div>

        </div>
    </section>

    <style>
        .product-card {
            padding: 16px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        /* IMAGE */
        .product-image-box {
            width: 80px;
            height: 80px;
            background: #f9fafb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
        }

        .product-image-box img {
            max-width: 178px !important;
            max-height: 100px;
            object-fit: contain;
        }

        /* DROPDOWN OFFSET */
        .shipping-options {
            margin-left: calc(80px + 16px);
            /* PENTING */
            max-width: 260px;
        }

        .form-select {
            font-size: 14px;
            border-radius: 8px;
        }

        .shipping-card,
        .product-card {
            padding: 16px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .location-icon {
            color: #ef4444;
            font-size: 18px;
            margin-top: 3px;
        }

        .product-image-box {
            width: 80px;
            height: 80px;
            background: #f9fafb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
        }

        .product-image-box img {
            max-width: 70px;
            max-height: 70px;
            object-fit: contain;
        }

        .shipping-options {
            max-width: 260px;
            /* INI YANG BIKIN POSISI SAMA */
        }

        .form-select {
            font-size: 14px;
            border-radius: 8px;
        }

        .custom-radio {
            position: relative;
            display: inline-block;
            width: 24px;
            /* ukuran lingkaran luar */
            height: 24px;
        }

        .custom-radio input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .custom-radio span {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid #00B0E5;
            /* warna border */
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .custom-radio span::after {
            content: "";
            width: 12px;
            /* lingkaran dalam */
            height: 12px;
            background-color: #00B0E5;
            /* warna lingkaran tengah */
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .custom-radio input:checked+span::after {
            opacity: 1;
        }

        .product-image-box {
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
        }

        .product-image {
            height: 100%;
            width: auto;
            object-fit: contain;
        }
    </style>

    <style>
        /* PRODUCT IMAGE */
        .product-image-box {
            width: 160px;
            height: 110px;
            background: #f8f8f8;
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* COLOR CIRCLE */
        .color-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: .25s;
        }

        .color-circle:hover {
            transform: scale(1.15);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* PAYMENT LIST */
        .payment-item {
            border-radius: 14px;
            background: #fff;
            padding: 14px 16px;
            margin-bottom: 10px;
        }

        .brand-box {
            width: 60px;
            height: 60px;
            /* background: #f5f5f5; */
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .brand-img {
            max-height: 30px;
        }

        .radio-lg {
            transform: scale(1.2);
        }
    </style>

    {{-- SCRIPT UNTUK GANTI WARNA --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const preview = document.getElementById('car-preview');
            const colors = document.querySelectorAll('.color-circle');

            colors.forEach(color => {
                color.addEventListener('click', function() {

                    // ganti image
                    const image = this.dataset.image;
                    if (image) {
                        preview.src = image;
                    }

                    // toggle active
                    colors.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>

    {{-- SCRIPT UNTUK MENAMBAH DAN MENGURAGI HARGA  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ===== CONFIG =====
            const unitPrice = {{ $product->price }};
            const serviceFee = 2000;

            // ===== ELEMENT =====
            const qtyEl = document.getElementById('qty');
            const priceEl = document.getElementById('total-price');

            const summaryLabel = document.getElementById('summary-label');
            const summaryPrice = document.getElementById('summary-price');
            const totalBillEl = document.getElementById('total-bill');

            const btnPlus = document.querySelector('.btn-plus');
            const btnMinus = document.querySelector('.btn-minus');

            // ===== STATE =====
            let qty = 1;

            // ===== HELPERS =====
            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(number);
            }

            // ===== UPDATE UI =====
            function updateAll() {
                const subtotal = unitPrice * qty;
                const totalBill = subtotal + serviceFee;

                qtyEl.textContent = qty;
                priceEl.textContent = formatRupiah(subtotal);

                summaryLabel.textContent = `Total price (${qty} item${qty > 1 ? 's' : ''})`;
                summaryPrice.textContent = formatRupiah(subtotal);
                totalBillEl.textContent = formatRupiah(totalBill);
            }

            // ===== EVENTS =====
            btnPlus.addEventListener('click', function() {
                qty++;
                updateAll();
            });

            btnMinus.addEventListener('click', function() {
                if (qty > 1) {
                    qty--;
                    updateAll();
                }
            });

            // ===== INIT =====
            updateAll();

        });
    </script>

    {{-- JQUERY --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
    </script>
    <script>
        function count(){
            var price = $('#qty').val()
            var qtty = $('#color').val()
            var price = $('#price').val()
            var grand_total = price * qty
            $('#grand_total').val(grand_total)
        }

        $(document).on('keyup mouseup','#price', function(){
            count()
        });
    </script> --}}
    {{-- SCRIPT UNTUK WARNA --}}
    <script>
        document.querySelectorAll('.color-circle').forEach(circle => {
            circle.addEventListener('click', function() {

                // hapus active dari semua
                document.querySelectorAll('.color-circle')
                    .forEach(c => c.classList.remove('active'));

                // set active ke yang diklik
                this.classList.add('active');

                // ambil nama warna
                const colorName = this.dataset.name;

                // set ke input hidden
                document.getElementById('color').value = colorName;

                console.log('Selected color:', colorName);
            });
        });
    </script>
    <script>
        let qty = 1;

        const qtySpan = document.getElementById('qty'); // span
        const qtyInput = document.getElementById('qty_input'); // hidden input

        document.querySelector('.btn-plus').addEventListener('click', function() {
            qty++;
            qtySpan.textContent = qty;
            qtyInput.value = qty;
        });

        document.querySelector('.btn-minus').addEventListener('click', function() {
            if (qty > 1) {
                qty--;
                qtySpan.textContent = qty;
                qtyInput.value = qty;
            }
        });
    </script>

@endsection
