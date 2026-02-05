@extends('layout.mobile.app')
@section('title', 'Notifikasi')
@section('content')

    <style>
        body {
            padding-top: 64px;
            /* ⬅️ sesuaikan dengan tinggi header */
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 64px;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            /* Safari */

            z-index: 999;
            border-bottom: 1px solid #eee;
            border-radius: 0 0 16px 16px;

            /* Transisi halus */
            transition: box-shadow 0.3s ease, backdrop-filter 0.3s ease, background-color 0.3s ease;
        }

        /* Aktif saat scroll */
        .header.header-scrolled {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.85);
        }


        .header-container {
            width: 100%;
            display: flex;
            align-items: center;
            padding: 0 16px;
            position: relative;
        }

        .back-btn-img {
            display: flex;
            align-items: center;
            z-index: 2;
        }

        .back-icon {
            width: 22px;
            height: auto;
        }

        .header-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
            font-weight: 600;
            color: #30445C;
            white-space: nowrap;
        }
    </style>


    <div class="header ">
        <div class="container header-container">
            <a href="{{ route('mobile.home') }}" class="back-btn-img">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="header-title">Cart</div>
        </div>
    </div>





    <div class="container py-4">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <div class="container pb-5">
            <div class="cart-card mb-3">

                <!-- Select all -->
                <div class="d-flex align-items-center ">
                    <label class="check-wrapper select-all">
                        <input class="check-input" type="checkbox" checked>
                        <span class="check-box"></span>
                    </label>
                    <span class="fw-medium ms-2">select all products</span>
                </div>



            </div>
            @if(isset($cartItems) && $cartItems->isNotEmpty())
                @foreach($cartItems as $item)
                    <div class="cart-item d-flex align-items-center" data-cart-id="{{ $item->id }}" data-price="{{ $item->product->price ?? 0 }}" data-qty="{{ $item->quantity }}">
                        <label class="check-wrapper">
                            <input class="check-input cart-check" type="checkbox" checked>
                            <span class="check-box"></span>
                        </label>

                        <div class="item-left d-flex flex-column align-items-start me-3">
                            <img src="{{ $item->product->thumbnail ? asset('storage/' . $item->product->thumbnail) : ($item->product->image ?? 'https://via.placeholder.com/90x70') }}" class="product-img" alt="product">
                            <div class="price-text mt-2">
                                Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="ms-0 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small class="text-muted d-block" style="font-size: 12px">{{ strtoupper($item->status ?? 'Menunggu Pembayaran') }}</small>
                                    <div class="fw-semibold text-primary product-title" style="font-size: 12px">
                                        {{ $item->product->model_name ?? $item->product->name }}
                                    </div>
                                    @if(!empty($item->color_name))
                                        <div class="small">Warna: {{ $item->color_name }}</div>
                                    @endif
                                </div>

                            </div>

                            <div class="d-flex justify-content-start align-items-center mt-3">
                                <div class="qty-box">
                                    <button class="qty-btn" data-action="decrease" data-id="{{ $item->id }}">−</button>
                                    <span class="qty-number">{{ $item->quantity }}</span>
                                    <button class="qty-btn" data-action="increase" data-id="{{ $item->id }}">+</button>
                                </div>
                                <button class="row-close-btn" data-id="{{ $item->id }}" title="Hapus">✕</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">Keranjang kosong.</div>
            @endif
        </div>

    </div>



    <style>
        .cart-card {
            background: #fff;
            border-radius: 14px;
            padding: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            max-width: 420px;
            margin: auto;
        }

        .cart-item {
            border-radius: 12px;
            padding: 12px;
            background: #ffffff;
            border: 1px solid rgba(25, 195, 125, 0.06);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.03);
            gap: 12px;
            position: relative;
            padding-left: 56px;
            /* space for absolute checkbox */
        }

        .product-img {
            width: 90px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #f0f0f0;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .qty-box {
            display: flex;
            align-items: center;
            border: 1px solid #19c37d;
            border-radius: 20px;
            padding: 2px 10px;
        }

        .qty-btn {
            background: none;
            border: none;
            font-size: 18px;
            color: #19c37d;
            width: 24px;
        }

        .qty-number {
            font-weight: 600;
            margin: 0 8px;
        }

        .price-text {
            color: #e53935;
            font-weight: 700;
        }

        /* Custom square checkbox */
        .check-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Keep the select-all checkbox inline (not absolute) */
        .check-wrapper.select-all {
            position: static;
            margin: 0;
        }

        /* Position item checkboxes inside cart items */
        .cart-item .check-wrapper {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 3;
            margin: 0;
        }

        .check-wrapper .check-input {
            display: none;
        }

        .check-box {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            border: 2px solid #19c37d;
            display: inline-block;
            background: #fff;
            position: relative;
        }

        .check-wrapper .check-input:checked+.check-box {
            background: #19c37d;
        }

        .check-box::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 4px;
            width: 8px;
            height: 14px;
            border: solid #fff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            opacity: 0;
        }

        .check-wrapper .check-input:checked+.check-box::after {
            opacity: 1;
        }

        .product-title {
            max-width: 180px;
        }

        /* Footer wrapper styles */
        .bf-wrapper {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ffffff;
            padding: 25px 16px;
            border-radius: 20px 20px 0 0;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.15);
            z-index: 100;
        }

        .bf-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            max-width: 420px;
            margin: 0 auto;
        }

        .bf-left {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .bf-left .check-wrapper {
            position: static;
        }

        .bf-left .check-box {
            background: #19c37d;
            border-color: #19c37d;
            width: 24px;
            height: 24px;
        }

        .bf-left .check-box::after {
            opacity: 1;
            left: 5px;
            top: 2px;
            width: 6px;
            height: 12px;
        }

        .bf-all-text {
            color: #ffffff;
            font-weight: 600;
            font-size: 13px;
        }

        .bf-middle {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .bf-total-label {
            color: #888888;
            font-size: 11px;
        }

        .bf-total-price {
            color: #e53935;
            font-weight: 700;
            font-size: 16px;
        }

        .bf-btn-buy {
            background: #0099ff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 10px 24px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.3s;
            flex-shrink: 0;
        }

        /* .bf-btn-buy:hover {
            background: #0077cc;
        } */

        .bf-btn-buy {
            padding: 12px 28px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #00DAD7, #006BE5);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .bf-btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 107, 229, 0.35);
        }
        .bf-btn-cancel {
            background: #e53935;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .bf-btn-cancel:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(229, 57, 53, 0.25); }

        /* per-row close button */
        .row-close-btn {
            position: absolute;
            top: 8px;
            right: 12px;
            background: rgba(0,0,0,0.04);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 16px;
            cursor: pointer;
        }
        .row-close-btn:hover { background: rgba(229,57,53,0.08); color: #e53935; }
    </style>

    <div class="bf-wrapper">
        <div class="bf-content">
            <div class="bf-middle">
                <span class="bf-total-label">Total</span>
                <span class="bf-total-price">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
            </div>
            <div style="display:flex;gap:8px;align-items:center;">
                <button id="checkoutBtn" class="bf-btn-buy">BUY</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkoutBtn = document.getElementById('checkoutBtn');
        const totalEl = document.querySelector('.bf-total-price');

        function formatRp(value) {
            return 'Rp ' + (Number(value) || 0).toLocaleString('id-ID');
        }

        function recalcTotal() {
            const checked = Array.from(document.querySelectorAll('.cart-check')).filter(i => i.checked);
            let sum = 0;
            checked.forEach(cb => {
                const row = cb.closest('[data-cart-id]');
                if (!row) return;
                const price = Number(row.dataset.price || 0);
                const qtyEl = row.querySelector('.qty-number');
                const qty = Number(qtyEl ? qtyEl.textContent.trim() : row.dataset.qty || 0);
                sum += price * qty;
            });
            totalEl.textContent = formatRp(sum);
            return sum;
        }

        // initial calc
        recalcTotal();

        checkoutBtn && checkoutBtn.addEventListener('click', async function () {
            const checked = Array.from(document.querySelectorAll('.cart-check'))
                .filter(i => i.checked)
                .map(i => i.closest('[data-cart-id]').dataset.cartId);

            if (!checked.length) {
                Swal.fire('Info', 'Pilih minimal 1 produk untuk checkout', 'info');
                return;
            }

            try {
                const res = await fetch("{{ route('mobile.order.invoice.cart') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ cart_ids: checked })
                });
                const data = await res.json();
                if (res.ok && data.invoice_url) {
                    window.location.href = data.invoice_url;
                } else {
                    Swal.fire('Error', data.error || 'Gagal membuat invoice', 'error');
                }
            } catch (err) {
                Swal.fire('Error', err.message || 'Gagal menghubungi server', 'error');
            }
        });

        // select-all handling (top + footer) and sync with individual items
        const selectAllInputs = Array.from(document.querySelectorAll('.check-wrapper.select-all .check-input'));

        function setAllChecked(checked) {
            document.querySelectorAll('.cart-check').forEach(cb => cb.checked = checked);
            selectAllInputs.forEach(s => s.checked = checked);
        }

        selectAllInputs.forEach(s => {
            s.addEventListener('change', (e) => {
                setAllChecked(e.target.checked);
                recalcTotal();
            });
        });

        // Keep select-all checkboxes in sync when individual items change
        function syncSelectAllState() {
            const checks = Array.from(document.querySelectorAll('.cart-check'));
            if (!checks.length) return;
            const allChecked = checks.every(c => c.checked);
            selectAllInputs.forEach(s => s.checked = allChecked);
        }

        document.querySelectorAll('.cart-check').forEach(ch => ch.addEventListener('change', function () { syncSelectAllState(); recalcTotal(); }));

        // simple qty handlers (calls web endpoints)
        document.querySelectorAll('[data-action]').forEach(btn => {
            btn.addEventListener('click', async function () {
                const action = this.dataset.action;
                const id = this.dataset.id;
                const url = action === 'increase' ? '/cart/increase' : '/cart/decrease';
                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ id })
                    });
                    const json = await res.json();
                    if (json.qty !== undefined) {
                        // update qty on page
                        const el = document.querySelector('[data-cart-id="' + id + '"] .qty-number');
                        if (el) el.textContent = json.qty;
                        const row = document.querySelector('[data-cart-id="' + id + '"]');
                        if (row) row.dataset.qty = json.qty;
                        // recalc total without reload
                        recalcTotal();
                    }
                } catch (e) {
                    console.error(e);
                }
            });
        });

        // Close (delete) selected cart items
        const closeBtn = document.getElementById('closeBtn');
        closeBtn && closeBtn.addEventListener('click', async function () {
            const checked = Array.from(document.querySelectorAll('.cart-check'))
                .filter(i => i.checked)
                .map(i => i.closest('[data-cart-id]').dataset.cartId);

            if (!checked.length) {
                Swal.fire('Info', 'Pilih minimal 1 produk untuk dihapus', 'info');
                return;
            }

            const confirm = await Swal.fire({
                title: 'Batalkan pesanan?',
                text: 'Produk yang dipilih akan dihapus dari keranjang.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            });

            if (!confirm.isConfirmed) return;

            try {
                const promises = checked.map(id => fetch('/cart/' + id, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
                }));

                const results = await Promise.all(promises);
                const ok = results.every(r => r.ok);
                if (ok) {
                    Swal.fire('Berhasil', 'Produk terhapus dari keranjang.', 'success');
                    // remove rows from DOM and recalc
                    checked.forEach(id => {
                        const row = document.querySelector('[data-cart-id="' + id + '"]');
                        if (row) row.remove();
                    });
                    recalcTotal();
                    // update cart badge in layout if present
                    const badge = document.querySelector('.cart-badge');
                    if (badge) {
                        // try to fetch new count
                        fetch('/cart')
                            .then(() => location.reload())
                            .catch(() => location.reload());
                    }
                } else {
                    Swal.fire('Gagal', 'Beberapa item gagal dihapus. Silakan coba lagi.', 'error');
                }
            } catch (err) {
                Swal.fire('Error', err.message || 'Terjadi kesalahan', 'error');
            }
        });

        // per-row close (delete single item)
        document.querySelectorAll('.row-close-btn').forEach(btn => {
            btn.addEventListener('click', async function () {
                const id = this.dataset.id;
                const confirmed = await Swal.fire({
                    title: 'Hapus item?',
                    text: 'Item ini akan dihapus dari keranjang.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                });

                if (!confirmed.isConfirmed) return;

                try {
                    const res = await fetch('/cart/' + id, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
                    });
                    if (res.ok) {
                        const row = document.querySelector('[data-cart-id="' + id + '"]');
                        if (row) row.remove();
                        recalcTotal();
                        Swal.fire('Terhapus', 'Item berhasil dihapus.', 'success');
                        // refresh badge or reload to keep counts consistent
                        const badge = document.querySelector('.cart-badge');
                        if (badge) { location.reload(); }
                    } else {
                        Swal.fire('Gagal', 'Gagal menghapus item.', 'error');
                    }
                } catch (err) {
                    Swal.fire('Error', err.message || 'Terjadi kesalahan', 'error');
                }
            });
        });
    });
</script>
@endpush
