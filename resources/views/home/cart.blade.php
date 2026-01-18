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
                            data-price="{{ $item->product->price }}" data-color-id="{{ $item->color_id }}" data-slug="{{ $item->product->slug }}" data-color-name="{{ $item->color_name ?? optional($item->color)->name ?? '' }}">

                            <div class="d-flex align-items-center gap-3">

                                <input type="checkbox" class="form-check-input product-check" checked
                                    style="width:22px;height:22px;">

                                <div class="d-flex flex-column align-items-center">
                                    <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                        style="width:80px;height:80px;object-fit:contain;">
                                    @if (!empty($item->color))
                                        @if (!empty($item->color->image) && file_exists(public_path('storage/' . $item->color->image)))
                                        @elseif(!empty($item->color->hex))
                                            <div
                                                style="width:28px;height:28px;border-radius:50%;margin-top:6px;border:1px solid #eee;background:{{ $item->color->hex }}">
                                            </div>
                                        @endif
                                    @elseif(!empty($item->color_name))
                                        <div class="small text-secondary mt-2">{{ $item->color_name }}</div>
                                    @endif
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="fw-bold text-primary mb-1">
                                        {{ $item->product->name }}
                                        @if(!empty($item->product->model_name))
                                            <div class="small text-secondary">{{ $item->product->model_name }}</div>
                                        @endif
                                    </h6>
                                    @if (!empty($item->color_name))
                                        <div class="small text-secondary mb-1">Warna:
                                            <strong>{{ $item->color_name }}</strong></div>
                                    @endif
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
                            // Simple cart UI calculations: total price and count
                            function formatRupiah(num) {
                                return 'Rp ' + Number(num).toLocaleString('id-ID');
                            }

                            function recalcCart() {
                                let total = 0;
                                let count = 0;
                                document.querySelectorAll('.product-item').forEach(item => {
                                    const checkbox = item.querySelector('.product-check');
                                    if (!checkbox || !checkbox.checked) return;

                                    const price = parseInt(item.getAttribute('data-price')) || 0;
                                    const qtyEl = item.querySelector('.qty');
                                    const qty = parseInt(qtyEl ? qtyEl.textContent.trim() : '1') || 1;
                                    total += price * qty;
                                    count += qty;
                                });

                                document.getElementById('totalPrice').textContent = formatRupiah(total);
                                const buyBtn = document.getElementById('buyBtn');
                                buyBtn.textContent = `BUY (${count})`;
                            }

                            document.addEventListener('click', function(e) {
                                if (e.target.matches('.plus-btn')) {
                                    const card = e.target.closest('.product-item');
                                    const qtyEl = card.querySelector('.qty');
                                    qtyEl.textContent = parseInt(qtyEl.textContent) + 1;
                                    recalcCart();
                                    // optionally send AJAX to backend to increment
                                }

                                if (e.target.matches('.minus-btn')) {
                                    const card = e.target.closest('.product-item');
                                    const qtyEl = card.querySelector('.qty');
                                    const current = parseInt(qtyEl.textContent);
                                    if (current > 1) qtyEl.textContent = current - 1;
                                    recalcCart();
                                }

                                if (e.target.matches('.remove-btn')) {
                                    const card = e.target.closest('.product-item');
                                    card.remove();
                                    recalcCart();
                                }
                            });

                            document.getElementById('selectAll').addEventListener('change', function() {
                                const checked = this.checked;
                                document.querySelectorAll('.product-check').forEach(ch => ch.checked = checked);
                                recalcCart();
                            });

                            document.addEventListener('change', function(e) {
                                if (e.target.matches('.product-check')) recalcCart();
                            });

                            // initial calculation
                            recalcCart();
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

    <script>
        document.getElementById('buyBtn').addEventListener('click', async function() {
            const checkedIds = [];
            document.querySelectorAll('.product-item').forEach(item => {
                const cb = item.querySelector('.product-check');
                if (!cb || !cb.checked) return;
                checkedIds.push(parseInt(item.getAttribute('data-id')));
            });

            if (checkedIds.length === 0) {
                alert('Pilih produk terlebih dahulu');
                return;
            }

            const csrf = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const res = await fetch("{{ route('order.invoice.cart') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ cart_ids: checkedIds })
                });

                if (!res.ok) {
                    const err = await res.json().catch(() => ({}));
                    alert(err.error || 'Gagal membuat invoice');
                    return;
                }

                const data = await res.json();
                if (data.invoice_url) {
                    window.location.href = data.invoice_url;
                } else {
                    alert('Invoice URL tidak ditemukan');
                }
            } catch (e) {
                console.error(e);
                alert('Gagal menghubungi server');
            }
        });
    </script>

@endsection
