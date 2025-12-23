@extends('layout.user')
@section('title', 'cart')
@section('content')

    <br><br><br><br>
    {{-- <div class="container py-5">

            <!-- Back -->
            {{-- <a href="/order-now" class="text-decoration-none d-flex align-items-center mb-4">
                <i class="bx bx-arrow-back me-2"></i> Payment
            </a> --}}
    {{-- 
            <div class="d-flex justify-content-center">

                {{-- <div class="payment-card shadow-sm rounded-4 w-100" style="max-width: 480px;">
                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex gap-3">
                            <div class="icon-circle">
                                <i class="bx bx-time"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold">Bayar sebelum</h6>
                                <small class="text-muted">
                                    {{ $order->created_at->addHours(2)->format('d M Y, H:i') }} WIB
                                </small>
                            </div>
                        </div>

                        <div class="countdown-badge">
                            <i class="bx bx-time me-1"></i>
                            <span id="countdown">--:--:--</span>
                        </div>
                    </div>
                    <hr>

                    <!-- VA -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <small class="text-muted">Nomor Virtual Account</small>
                            <div class="fw-semibold">{{ $order->external_id }}</div>
                        </div>
                        {{-- 
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="bank-logo"
                            alt="BCA"> --}}
    {{-- </div> --}}
    <div class="container py-5">

        <!-- Back -->
        <a href="/order-now" class="text-decoration-none d-flex align-items-center mb-4">
            <i class="bx bx-arrow-back me-2"></i> Payment
        </a>

        <div class="d-flex justify-content-center">
            <div class="payment-card shadow-sm rounded-4 w-100" style="max-width: 480px;">

                <!-- HEADER -->
                @if ($order->status === 'Completed')
                    <div class="p-3 rounded bg-success-subtle text-success d-flex align-items-center gap-2">
                        <i class="bx bx-check-circle fs-4"></i>
                        <div>
                            <strong>Pembayaran sudah diterima</strong><br>
                            <small>Pesanan kamu sedang kami proses</small>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex gap-3">
                            <div class="icon-circle">
                                <i class="bx bx-time"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold">Bayar sebelum</h6>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($order->expired_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
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


                <hr>

                <!-- VIRTUAL ACCOUNT -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <small class="text-muted">Nomor Virtual Account</small>
                        <div class="fw-semibold">
                            {{ $order->external_id }}
                        </div>
                    </div>
                </div>

                <!-- MODEL & STATUS -->
                @php
                    $statusClass = match ($order->status) {
                        'pending' => 'bg-warning text-dark',
                        'paid' => 'bg-success',
                        'expired' => 'bg-danger',
                        default => 'bg-secondary',
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
                        <a href="{{ $order->invoice_url }}" target="_blank" class="btn btn-primary flex-fill">
                            Bayar Sekarang
                        </a>
                    @endif


                    <button class="btn btn-outline-primary flex-fill" data-bs-toggle="modal" data-bs-target="#statusModal">
                        Cek Status
                    </button>
                    <!-- STATUS MODAL -->
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

                </div>

            </div>
        </div>
    </div>

    <!-- TOTAL -->

    {{-- </div> --}}
    {{-- </div>  --}}
    {{-- </div>  --}}
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
            padding: 24px;
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
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.getElementById('countdown');
            const expiredAt = new Date("{{ $order->created_at->addHours(2)->toIso8601String() }}");

            function tick() {
                const now = new Date();
                let diff = Math.floor((expiredAt - now) / 1000);
                if (diff <= 0) {
                    el.textContent = 'Expired';
                    return;
                }

                const h = String(Math.floor(diff / 3600)).padStart(2, '0');
                const m = String(Math.floor((diff % 3600) / 60)).padStart(2, '0');
                const s = String(diff % 60).padStart(2, '0');

                el.textContent = `${h}:${m}:${s}`;
            }

            tick();
            setInterval(tick, 1000);
        });
    </script>

@endsection
