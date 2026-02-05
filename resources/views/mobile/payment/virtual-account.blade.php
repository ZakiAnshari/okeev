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

                <!-- Status Badge -->
                @php
                    $statusClass = match ($order->status) {
                        'pending' => 'bg-warning text-dark',
                        'paid', 'Completed' => 'bg-success',
                        'expired' => 'bg-danger',
                        default => 'bg-secondary',
                    };
                @endphp

                @if ($order->status === 'Completed')
                    <div class="p-3 rounded bg-success-subtle text-success d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-check-circle fs-4"></i>
                        <div>
                            <strong>Pembayaran sudah diterima</strong><br>
                            <small>Pesanan kamu sedang kami proses</small>
                        </div>
                    </div>
                @else
                    <div class="p-3 rounded bg-info-subtle text-info d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-info-circle fs-4"></i>
                        <div>
                            <strong>Menunggu Pembayaran</strong><br>
                            <small>Silakan lakukan pembayaran sekarang</small>
                        </div>
                    </div>
                @endif

                <hr>

                <!-- Content Info -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="text-muted small">Nomor Transaksi</div>
                        <div class="fw-semibold text-break">{{ $order->external_id }}</div>
                    </div>

                    <div class="col-6">
                        <div class="text-muted small">Produk / Model</div>
                        <div class="fw-semibold">{{ $order->model_name }}</div>
                    </div>

                    <div class="col-6 text-end">
                        <div class="text-muted small">Status</div>
                        <span class="badge {{ $statusClass }}">{{ strtoupper($order->status) }}</span>
                    </div>

                    <div class="col-6">
                        <div class="text-muted small">Jumlah</div>
                        <div class="fw-semibold">{{ $order->qty }} x</div>
                    </div>

                    <div class="col-6 text-end">
                        <div class="text-muted small">Total Bayar</div>
                        <div class="fw-semibold text-primary fs-5">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</div>
                    </div>
                </div>

                <hr>

                <!-- Info Pesan -->
                <div class="bg-light p-3 rounded mb-4" style="font-size: 13px;">
                    <ul class="mb-0 ps-3">
                        <li class="mb-2">Transfer VA hanya bisa dilakukan dari bank yang dipilih</li>
                        <li>Dana diteruskan ke penjual setelah pembayaran diverifikasi</li>
                    </ul>
                </div>

                <!-- Action Button -->
                <div class="d-grid gap-2">
                    @if ($order->status !== 'Completed')
                        <button type="button" onclick="openXenditPayment('{{ $order->invoice_url }}'); return false;" class="btn btn-primary rounded-3">
                            <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
                        </button>
                        <button type="button" onclick="confirmCancel()" class="btn btn-outline-danger rounded-3">
                            <i class="bi bi-x-circle me-2"></i> Batalkan Pesanan
                        </button>
                    @else
                        <a href="{{ route('mobile.home') }}" class="btn btn-secondary rounded-3">
                            <i class="bi bi-house me-2"></i> Kembali ke Beranda
                        </a>
                    @endif
                </div>

                <script>
                    function openXenditPayment(invoiceUrl) {
                        window.location.href = invoiceUrl;
                        return false;
                    }

                    function confirmCancel() {
                        Swal.fire({
                            title: 'Batalkan Pesanan?',
                            text: 'Pesanan Anda akan dibatalkan dan status akan diubah menjadi Cancelled.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, Batalkan',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cancelOrder();
                            }
                        });
                    }

                    function cancelOrder() {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route("mobile.order.cancel", $order->id) }}';
                        form.innerHTML = '@csrf';
                        document.body.appendChild(form);
                        form.submit();
                    }
                </script>

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
    </style>

@endsection
