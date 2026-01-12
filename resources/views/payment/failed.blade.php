@extends('layout.user')
@section('title', 'payment failed')
@section('content')
    <div class="container py-5 mt-5">
        <div class="d-flex justify-content-center">
            <div class="payment-card shadow-sm rounded-4 w-100" style="max-width: 480px;">
                <div class="p-3 rounded bg-danger-subtle text-danger d-flex align-items-center gap-2 payment-success-header justify-content-center">
                    <i class="bx bx-x-circle fs-4"></i>
                    <div>
                        <strong>Pembayaran Gagal</strong><br>
                        <small>Pembayaran gagal atau dibatalkan. Silahkan coba lagi.</small>
                    </div>
                </div>

                <div class="p-4">
                    <p class="mb-3">Payment reference: {{ $order->external_id ?? '-' }}</p>
                    <p class="mb-0">Status: {{ $order->status ?? 'Failed' }}</p>

                    <div class="mt-4">
                        <a href="{{ route('cart') }}" class="btn btn-outline-primary">Kembali ke Keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')

    @if(!empty($showFailedAlert))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                try {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Pembayaran Gagal',
                            text: 'Pembayaran gagal atau dibatalkan. Silahkan coba lagi.',
                            confirmButtonText: 'OK'
                        });
                    } else if (typeof swal === 'function') {
                        swal('Pembayaran Gagal', 'Pembayaran gagal atau dibatalkan. Silahkan coba lagi.', 'error');
                    }
                } catch (e) {
                    console.error('SweetAlert show failed', e);
                }
            });
        </script>
    @endif
@endsection
