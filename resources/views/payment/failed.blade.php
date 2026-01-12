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
            (function showFailed() {
                function fire() {
                    try {
                        Swal.fire({
                            icon: 'error',
                            title: 'Pembayaran Gagal',
                            text: 'Pembayaran gagal atau dibatalkan. Silahkan coba lagi.',
                            confirmButtonText: 'OK'
                        });
                    } catch (e) {
                        if (typeof swal === 'function') {
                            try { swal('Pembayaran Gagal', 'Pembayaran gagal atau dibatalkan. Silahkan coba lagi.', 'error'); } catch (e2) { console.error(e2); }
                        } else {
                            console.error('SweetAlert not available', e);
                        }
                    }
                }

                if (typeof Swal !== 'undefined' || typeof swal === 'function') {
                    document.addEventListener('DOMContentLoaded', fire);
                    return;
                }

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
@endsection
