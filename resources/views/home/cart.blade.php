@extends('layout.user')
@section('title', 'Cart')
@section('content')

    <section class="py-5 mt-5">
        <div class="container">

            <a href="{{ url()->previous() }}" class="text-decoration-none text-dark d-inline-block mb-4">
                <i class="bx bx-arrow-back me-2"></i> Order Now
            </a>

            <div class="row g-4">

                <!-- LEFT -->
                <div class="col-lg-8">

                    <div class="p-3 rounded-3 d-flex align-items-center mb-4" style="background:#2e425c;color:white;">
                        <input type="checkbox" id="selectAll" class="form-check-input me-3" style="width:24px;height:24px;">
                        <label for="selectAll" class="fw-semibold">
                            Select all products
                        </label>
                    </div>

                    @forelse ($cartItems as $item)
                        <div class="card product-item rounded-4 p-3 mb-3" data-id="{{ $item->id }}"
                            data-price="{{ $item->product->price }}">

                            <div class="d-flex align-items-center gap-3">

                                <input type="checkbox" class="form-check-input product-check" checked
                                    style="width:22px;height:22px;">

                                <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                    style="width:80px;height:80px;object-fit:contain;">

                                <div class="flex-grow-1">
                                    <h6 class="fw-bold text-primary mb-1">
                                        {{ $item->product->name }}
                                    </h6>
                                    <span class="fw-bold text-danger">
                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <div class="qty-box">
                                        <button type="button" class="minus-btn">−</button>
                                        <span class="qty">{{ $item->quantity }}</span>
                                        <button type="button" class="plus-btn">+</button>
                                    </div>

                                    <button type="button" class="btn btn-danger btn-sm remove-btn">×</button>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5">
                            Keranjang masih kosong
                        </div>
                    @endforelse

                </div>

                <!-- RIGHT -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm p-4 rounded-4">
                        <h6 class="fw-bold mb-3">Shopping Summary</h6>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted fw-semibold">Total</span>
                            <span id="totalPrice" class="fw-bold text-danger fs-5">Rp 0</span>
                        </div>
                        <button id="buyBtn" class="btn w-100 text-white fw-bold py-3 rounded-pill"
                            style="background:linear-gradient(90deg,#09c6f9,#05a0f7,#04d4c3);">
                            BUY (0)
                        </button>

                        <script>
                            document.getElementById('buyBtn').addEventListener('click', function() {
                                window.location.href = "{{ route('checkout.show') }}";
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STYLE --}}
    <style>
        .product-item {
            border: 1px solid #f1f1f1;
            transition: .2s;
        }

        .product-item:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, .05);
        }

        .qty-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #e9f7ff;
            border-radius: 999px;
            padding: 6px 14px;
        }

        .qty-box button {
            background: none;
            border: none;
            font-size: 18px;
            font-weight: bold;
            color: #0dcaf0;
        }

        .qty {
            min-width: 20px;
            text-align: center;
        }

        .remove-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            border-radius: 50%;
        }
    </style>


@endsection
