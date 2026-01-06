@extends('layout.mobile.app')
@section('title', 'Payment')
@section('content')
    <style>
        body {
            padding-top: 0px !important;
        }
    </style>
    <div class="mobile-header">
        <!-- HEADER -->
        <div class="container header-container d-flex align-items-center py-3">
            <a href="javascript:void(0)" class="back-btn-img me-3" onclick="history.back()">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="mobile-header-title fw-semibold fs-5">Payment</div>
        </div>
    </div>
    <br><br>
    <div class="container py-4">
        <div class="d-flex justify-content-center">
            <div class="payment-card shadow-sm w-100" style="max-width:480px">

                <!-- Header -->
                @if ($order->status === 'Completed')
                    <div class="p-3 rounded bg-success-subtle text-success d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-check-circle fs-4"></i>
                        <div>
                            <strong>Pembayaran sudah diterima</strong><br>
                            <small>Pesanan kamu sedang kami proses</small>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="icon-circle">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">Bayar sebelum</div>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($order->expired_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                    WIB
                                </small>
                            </div>
                        </div>

                        <div class="countdown-badge">
                            <i class="bi bi-clock-history me-1"></i>
                            <span id="countdown">--:--:--</span>
                        </div>
                        <script>
                            // SET WAKTU COUNTDOWN (dalam detik)
                            let duration = 24 * 60 * 60; // 24 jam

                            const countdownEl = document.getElementById('countdown');

                            function startCountdown() {
                                const timer = setInterval(() => {
                                    let hours = Math.floor(duration / 3600);
                                    let minutes = Math.floor((duration % 3600) / 60);
                                    let seconds = duration % 60;

                                    // Format 2 digit
                                    hours = String(hours).padStart(2, '0');
                                    minutes = String(minutes).padStart(2, '0');
                                    seconds = String(seconds).padStart(2, '0');

                                    countdownEl.textContent = `${hours}:${minutes}:${seconds}`;

                                    if (duration <= 0) {
                                        clearInterval(timer);
                                        countdownEl.textContent = '00:00:00';
                                    }

                                    duration--;
                                }, 1000);
                            }

                            startCountdown();
                        </script>

                    </div>
                @endif

                <hr>

                @php
                    $statusClass = match ($order->status) {
                        'pending' => 'bg-warning text-dark',
                        'paid', 'Completed' => 'bg-success',
                        'expired' => 'bg-danger',
                        default => 'bg-secondary',
                    };
                @endphp

                <!-- Content -->
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <div class="text-muted small">Nomor Virtual Account</div>
                        <div class="fw-semibold">
                            {{ $order->external_id }}
                        </div>
                    </div>

                    <div class="col-6 text-end">
                        <div class="text-muted small">Status Pembayaran</div>
                        <span class="badge {{ $statusClass }}">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>

                    <div class="col-6">
                        <div class="text-muted small">Produk / Model</div>
                        <div class="fw-semibold">
                            {{ $order->model_name }}
                        </div>
                    </div>

                    <div class="col-6 text-end">
                        <div class="text-muted small">Total Bayar</div>
                        <div class="fw-semibold text-primary">
                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                        </div>
                        <a href="#" class="small text-decoration-none">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <hr>

                <!-- Info -->
                <ul class="info-list mb-4">
                    <li>
                        <i class="bi bi-info-circle"></i>
                        Transfer VA hanya bisa dilakukan dari bank yang dipilih
                    </li>
                    <li>
                        <i class="bi bi-check-circle"></i>
                        Dana diteruskan ke penjual setelah pembayaran diverifikasi
                    </li>
                </ul>

                <!-- Action -->
                <div class="d-flex gap-3">
                    @if ($order->status !== 'Completed')
                        <a href="{{ $order->invoice_url }}" target="_blank" class="btn btn-primary flex-fill rounded-3">
                            Bayar Sekarang
                        </a>
                    @endif

                    <button class="btn btn-outline-primary flex-fill rounded-3" data-bs-toggle="modal"
                        data-bs-target="#statusModal">
                        Cek Status
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="statusModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4">

                            <div class="modal-header">
                                <h6 class="modal-title fw-semibold">
                                    Payment : {{ $order->external_id }}
                                </h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body p-0" style="height:80vh">
                                <iframe src="{{ $order->invoice_url }}" style="width:100%;height:100%"
                                    frameborder="0"></iframe>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">
                                    Tutup
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .payment-card {
            max-width: 480px;
            background: #fff;
            border-radius: 18px;
            padding: 20px;
        }

        .icon-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #eaf6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d6efd;
            font-size: 18px;
        }

        .countdown-badge {
            /* background: #eaf6ff; */
            color: #0d6efd;
            font-weight: 600;
            /* padding: 6px 12px; */
            border-radius: 999px;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            background: #6c757d;
            color: #fff;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            display: flex;
            align-items: start;
            gap: 10px;
            font-size: 14px;
            color: #6c757d
    </style>


@endsection
