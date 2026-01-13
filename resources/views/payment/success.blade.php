@extends('layout.user')
@section('title', 'cart')
@section('content')

    <!-- 🛑 BLOCK AUTO-REFRESH AGGRESSIVE -->
    <script>
        // Immediate block reload BEFORE anything else
        window.location.reload = () => false;
        window.history.go = () => false;

        // Block form GET submissions
        document.addEventListener('submit', (e) => {
            if (e.target.method?.toUpperCase() === 'GET') {
                e.preventDefault();
            }
        }, true);

        // 🛑 Block iframe Xendit dari auto-reload
        window.addEventListener('load', () => {
            const iframes = document.querySelectorAll('iframe');
            iframes.forEach(iframe => {
                // Disable iframe interactions yang bisa trigger reload
                try {
                    if (iframe.contentWindow) {
                        iframe.contentWindow.location.reload = () => false;
                    }
                } catch (e) {
                    // Cross-origin, tidak bisa diakses
                }
            });
        });
    </script>



    <div class="container py-5 mt-5">

        <!-- Back -->
        {{-- <a href="/order-now" class="text-decoration-none d-flex align-items-center mb-4">
            <i class="bx bx-arrow-back me-2"></i> Payment
        </a> --}}

        <div class="d-flex justify-content-center">
            <div class="payment-card shadow-sm rounded-4 w-100" style="max-width: 480px;">

                <!-- HEADER -->
                @if ($order->status === 'Completed')
                    <div
                        class="p-3 rounded bg-success-subtle text-success d-flex align-items-center gap-2 payment-success-header justify-content-center">
                        <i class="bx bx-check-circle fs-4"></i>
                        <div>
                            <strong>Pembayaran sudah diterima</strong><br>
                            <small>Pesanan kamu sedang kami proses</small>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-between align-items-start mb-3 border border-1 rounded-3 p-3">
                        <div class="d-flex gap-3">
                            <div class="icon-circle">
                                <i class="bx bx-time"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold">Bayar sebelum</h6>
                                <small class="text-muted">
                                    {{ $order->created_at->copy()->addDay()->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                    WIB
                                </small>
                            </div>
                        </div>
                        <div class="countdown-badge">
                            <i class="bx bx-time me-1"></i>
                            <span id="countdown">--:--:--</span>
                        </div>
                    </div>
                @endif

                <!-- VIRTUAL ACCOUNT -->
                <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
                    <div>
                        <small class="text-muted">Nomor Virtual Account</small>
                        <div class="fw-semibold">
                            {{ $order->external_id }}
                        </div>
                    </div>
                </div>

                <!-- MODEL & STATUS -->
                @php
                    $status = strtolower($order->status ?? '');
                    $statusClass = match ($status) {
                        'pending' => 'bg-warning text-dark',
                        'failed' => 'bg-danger text-white',
                        'expired' => 'bg-danger text-white',
                        'paid', 'completed' => 'bg-success text-white',
                        default => 'bg-secondary text-white',
                    };
                @endphp

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <small class="text-muted">Produk / Model</small>
                        <div class="fw-semibold">
                            {{ $order->model_name }}
                        </div>
                    </div>

                    <div class="text-end">
                        <small class="text-muted">Status Pembayaran</small>
                        <div>
                            <span class="badge {{ $statusClass }}">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- TOTAL -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <small class="text-muted">Total Bayar</small>
                        <div class="fw-semibold">
                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                        </div>
                    </div>

                    <a href="#" class="detail-link">Lihat Detail</a>
                </div>

                <hr>

                <!-- INFO -->
                <ul class="info-list mb-0">
                    <li>
                        <i class="bx bx-info-circle"></i>
                        Transfer VA hanya bisa dilakukan dari bank yang dipilih
                    </li>
                    <li>
                        <i class="bx bx-check-circle"></i>
                        Dana diteruskan ke penjual setelah pembayaran diverifikasi
                    </li>
                </ul>

                <!-- ACTION -->
                <div class="d-flex gap-3 mt-4">
                    @if ($order->status !== 'Completed')
                        <a href="{{ $order->invoice_url }}" class="btn btn-primary flex-fill">
                            Bayar Sekarang
                        </a>

                        <form id="cancelForm" action="{{ route('order.cancel', $order->id) }}" method="POST" class="flex-fill ms-2" data-order-id="{{ $order->id }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">Batalkan Pesanan</button>
                        </form>
                    @else
                        <!-- Jika sudah Completed, tampilkan tombol lanjut saja -->
                        <a href="{{ route('landing') }}" class="btn btn-primary flex-fill">
                            Kembali ke Beranda
                        </a>
                    @endif
                </div>

                <!-- STATUS MODAL - HANYA UNTUK PENDING -->
                @if ($order->status !== 'Completed')
                    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 p-3">

                                <div class="modal-header">
                                    <h6 class="modal-title fw-semibold" id="statusModalLabel">
                                        Payment : {{ $order->external_id }}
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-0 d-flex flex-column" style="height: 80vh;">
                                    <!-- CONTENT -->
                                    <div class="flex-grow-1">
                                        <iframe src="{{ $order->invoice_url }}" frameborder="0"
                                            style="width:100%; height:100%;">
                                        </iframe>
                                    </div>

                                </div>



                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Tutup
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
    </div>

    <style>
        .modal-open {
            overflow: auto !important;
            padding-right: 0 !important;
        }


        /* ===== PAYMENT CARD ===== */
        .payment-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 28px 20px;
            max-width: 480px;
            margin: 0 auto;
            /* center horizontally */
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
        }

        /* Make sure card has comfortable side padding on small screens */
        @media (max-width: 576px) {
            .payment-card {
                padding-left: 16px;
                padding-right: 16px;
                border-radius: 12px;
            }
        }

        /* ===== ICON ===== */
        .icon-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #e6f7ff;
            color: #0ea5e9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        /* Success header styling */
        .payment-success-header {
            gap: 12px;
        }

        .payment-success-header i.bx {
            font-size: 34px !important;
            line-height: 1;
        }

        .payment-success-header>div {
            text-align: center;
        }

        /* Tambah border solid 1px untuk header success */
        .payment-success-header {
            border: 1px solid rgba(16, 185, 129, 0.15);
            padding: 14px;
        }

        /* ===== COUNTDOWN ===== */
        .countdown-badge {
            background: #e6f7ff;
            color: #0284c7;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 14px;
            white-space: nowrap;
            display: flex;
            align-items: center;
        }

        /* ===== BANK LOGO ===== */
        .bank-logo {
            height: 30px;
        }

        /* ===== LINK ===== */
        .detail-link {
            color: #0ea5e9;
            font-size: 14px;
            text-decoration: none;
        }

        .detail-link:hover {
            text-decoration: underline;
        }

        /* ===== INFO LIST ===== */
        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 14px;
        }

        .info-list li {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: flex-start;
        }

        .info-list i {
            color: #0ea5e9;
            font-size: 18px;
            margin-top: 2px;
        }

        /* ===== BUTTON ===== */
        .btn-primary {
            background: #0ea5e9;
            border: none;
        }

        .btn-primary:hover {
            background: #0284c7;
        }
    </style>

    <script>
        // 🛑 CEGAH AUTO-RELOAD YANG AGGRESSIVE
        (function blockRefresh() {
            // 1. Blokir reload
            window.location.reload = function() {
                console.log('🛑 Reload blocked');
                return false;
            };

            // 2. Blokir window.location assignment
            const originalLocationAssign = window.location.assign;
            window.location.assign = function(url) {
                if (url === window.location.href) {
                    console.log('🛑 Location assign blocked (same page)');
                    return;
                }
                return originalLocationAssign.call(window.location, url);
            };

            // 3. Blokir meta refresh
            const metas = document.querySelectorAll('meta[http-equiv="refresh"]');
            metas.forEach(meta => meta.remove());

            // 4. Override fetch untuk intercept auto-requests
            const originalFetch = window.fetch;
            window.fetch = function(...args) {
                const url = args[0];
                if (typeof url === 'string' && url.includes(window.location.pathname)) {
                    console.log('🛑 Fetch to same page blocked:', url);
                    return Promise.reject('Auto-fetch blocked');
                }
                return originalFetch.apply(this, args);
            };

            // 5. Stop semua interval yang suspicious
            const originalSetInterval = window.setInterval;
            let intervalId = 0;
            window.setInterval = function(callback, delay) {
                if (callback && typeof callback === 'function') {
                    const fnStr = callback.toString().toLowerCase();
                    if (fnStr.includes('reload') || fnStr.includes('location') || fnStr.includes('fetch')) {
                        console.log('🛑 Suspicious interval blocked');
                        return originalSetInterval(() => {}, 999999999);
                    }
                }
                return originalSetInterval.apply(this, arguments);
            };

            console.log('✅ Auto-refresh protection activated');
        })();

        document.addEventListener('DOMContentLoaded', () => {
            // 🔐 Jangan jalankan countdown jika sudah Completed
            @if ($order->status !== 'Completed')
                const el = document.getElementById('countdown');
                const expiredAt = new Date("{{ $order->created_at->addHours(2)->toIso8601String() }}");

                function tick() {
                    const now = new Date();
                    let diff = Math.floor((expiredAt - now) / 1000);
                    if (diff <= 0) {
                        el.textContent = 'Expired';
                        // Jangan perbarui halaman, tunggu webhook dari Xendit
                        return;
                    }

                    const h = String(Math.floor(diff / 3600)).padStart(2, '0');
                    const m = String(Math.floor((diff % 3600) / 60)).padStart(2, '0');
                    const s = String(diff % 60).padStart(2, '0');

                    el.textContent = `${h}:${m}:${s}`;
                }

                tick();
                setInterval(tick, 1000);
            @endif
        });
    </script>
    @include('sweetalert::alert')
    @if(!empty($showSuccessAlert))
        <script>
            (function showSuccess() {
                function fire() {
                    try {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil',
                            text: 'Pesanan Anda sedang diproses.',
                            confirmButtonText: 'OK'
                        });
                    } catch (e) {
                        if (typeof swal === 'function') {
                            try { swal('Pembayaran Berhasil', 'Pesanan Anda sedang diproses.', 'success'); } catch (e2) { console.error(e2); }
                        } else {
                            console.error('SweetAlert not available', e);
                        }
                    }
                }

                if (typeof Swal !== 'undefined' || typeof swal === 'function') {
                    document.addEventListener('DOMContentLoaded', fire);
                    return;
                }

                // Load CDN as fallback
                var s = document.createElement('script');
                s.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
                s.onload = function() {
                    document.addEventListener('DOMContentLoaded', fire);
                };
                s.onerror = function(err) { console.error('Failed to load SweetAlert2 CDN', err); };
                document.head.appendChild(s);
            })();
        </script>
    @endif

    <script>
        // Intercept cancel form to show SweetAlert confirmation and perform AJAX cancel
        function confirmCancel(event) {
            event.preventDefault();
            const form = event.target;

            const runCancel = () => {
                const tokenInput = form.querySelector('input[name="_token"]');
                const csrf = tokenInput ? tokenInput.value : '';
                const fd = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: fd
                }).then(async (res) => {
                    let json = {};
                    try { json = await res.json(); } catch (e) { /* ignore parse error */ }

                    if (res.ok) {
                        const msg = json.message || 'Pesanan dibatalkan.';
                        const redirect = json.redirect || '/home';
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({ icon: 'success', title: 'Berhasil', text: msg }).then(() => {
                                // Remove notification elements matching this order id
                                try {
                                    const orderId = form.dataset.orderId;
                                    if (orderId) {
                                        document.querySelectorAll('[data-order-id="' + orderId + '"]').forEach(el => el.remove());

                                        // Update small badges/counts in header
                                        const notifBtnBadge = document.querySelector('#notifBtn .badge');
                                        if (notifBtnBadge) {
                                            let v = parseInt(notifBtnBadge.textContent) || 0;
                                            v = Math.max(0, v - 1);
                                            if (v === 0) notifBtnBadge.remove(); else notifBtnBadge.textContent = v;
                                        }

                                        document.querySelectorAll('.notif-tabs .dot').forEach(d => {
                                            let n = parseInt(d.textContent) || 0;
                                            n = Math.max(0, n - 1);
                                            if (n === 0) d.remove(); else d.textContent = n;
                                        });
                                    }
                                } catch (e) { console.error(e); }

                                window.location.href = redirect;
                            });
                        } else {
                            try {
                                const orderId = form.dataset.orderId;
                                if (orderId) document.querySelectorAll('[data-order-id="' + orderId + '"]').forEach(el => el.remove());
                            } catch (e) { }
                            alert(msg);
                            window.location.href = redirect;
                        }
                        return;
                    }

                    const errMsg = (json && (json.message || json.error)) || 'Gagal membatalkan pesanan.';
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: errMsg });
                    } else {
                        alert(errMsg);
                    }
                }).catch((err) => {
                    console.error('Cancel request failed', err);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan. Silakan coba lagi.' });
                    } else {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            };

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Batalkan pesanan?',
                    text: 'Pesanan Anda akan dibatalkan dan status akan diubah menjadi Cancelled.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, batalkan',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) runCancel();
                });
            } else if (confirm('Batalkan pesanan?')) {
                runCancel();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            function attachCancelListener() {
                const f = document.getElementById('cancelForm');
                if (f) f.addEventListener('submit', confirmCancel);
            }

            if (typeof Swal !== 'undefined') {
                attachCancelListener();
            } else {
                const s = document.createElement('script');
                s.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
                s.onload = function() {
                    attachCancelListener();
                };
                s.onerror = function(err) {
                    console.error('Failed to load SweetAlert2 CDN', err);
                    // still attach fallback listener to keep functionality
                    attachCancelListener();
                };
                document.head.appendChild(s);
            }
        });
    </script>
@endsection
