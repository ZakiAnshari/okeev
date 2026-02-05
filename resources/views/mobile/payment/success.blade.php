@extends('layout.mobile.app')
@section('title', 'Payment Success')
@section('content')
    <style>
        body {
            padding-top: 0px !important;
        }
    </style>
    <div class="mobile-header">
        <!-- HEADER -->
        <div class="container header-container d-flex align-items-center py-3">
            <a href="{{ route('mobile.home') }}" class="back-btn-img me-3">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="mobile-header-title fw-semibold fs-5">Pembayaran Berhasil</div>
        </div>
    </div>
    <br><br>
    <div class="container py-4">
        <div class="d-flex justify-content-center">
            <div class="payment-card shadow-sm w-100" style="max-width:480px">

                <!-- Success Icon -->
                <div class="text-center mb-4">
                    <div style="width: 80px; height: 80px; margin: 0 auto; background: #d4edda; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-check-circle" style="font-size: 48px; color: #28a745;"></i>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-success">Pembayaran Berhasil!</h4>
                    <p class="text-muted small">Pesanan Anda sedang kami proses</p>
                </div>

                <!-- Order Details -->
                <div class="mb-4">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="text-muted small">No. Transaksi</div>
                            <div class="fw-semibold" style="font-size: 12px;">{{ $order->external_id }}</div>
                        </div>
                        <div class="col-6 text-end">
                            <div class="text-muted small">Total Bayar</div>
                            <div class="fw-semibold text-primary">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Info Message -->
                <div class="bg-light p-3 rounded mb-4">
                    <p class="small mb-0">Terima kasih telah melakukan pembayaran. Tim kami akan segera memproses pesanan Anda.</p>
                </div>

                <!-- Action Button -->
                <a href="{{ route('mobile.home') }}" class="btn btn-primary w-100 rounded-3">
                    Kembali ke Beranda
                </a>

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
