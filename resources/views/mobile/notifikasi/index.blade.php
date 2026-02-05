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
            <a href="#" class="back-btn-img" onclick="(function(){ if(window.history.length>1){ history.back(); } else { window.location='{{ route('mobile.home') }}'; } })(); return false;">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="header-title">Notification</div>
        </div>
    </div>


       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <div class="container py-4">
        <div class="">

            @if (($notifCount ?? 0) === 0)
                <div class="p-4 text-center text-muted">
                    <p>Tidak ada notifikasi.</p>
                </div>
            @else

                {{-- ORDER NOTIFICATIONS --}}
                @foreach ($notifOrders ?? [] as $n)
                    <a href="{{ route('payment.va', $n->id) }}" class="text-decoration-none text-body">
                        <div class="notification-item">
                            @php
                                $iconClass = 'bg-danger';
                                $iconName = 'bx-dollar-circle';
                                if (strtolower($n->status ?? '') === 'pending') {
                                    $iconClass = 'bg-warning';
                                } elseif (in_array(strtolower($n->status ?? ''), ['completed', 'paid'])) {
                                    $iconClass = 'bg-success';
                                    $iconName = 'bx-check-circle';
                                }
                            @endphp
                            <div class="icon-circle {{ $iconClass }}">
                                <i class="bx {{ $iconName }}"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                @php
                                    $notifLabel = 'ORDER';
                                    $st = strtolower($n->status_transaksi ?? $n->status ?? '');
                                    if ($st === 'being_sent') {
                                        $notifLabel = 'BEING SENT';
                                    } elseif ($st === 'processing') {
                                        $notifLabel = 'PROCESS';
                                    } elseif ($st === 'to_the_location') {
                                        $notifLabel = 'TO LOCATION';
                                    } elseif (in_array($st, ['completed', 'paid'])) {
                                        $notifLabel = 'COMPLETED';
                                    }
                                @endphp
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="fw-bold mb-1">{{ $notifLabel }}</h6>
                                    <small class="text-muted fw-semibold">{{ $n->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="text-muted mb-1 small">
                                    {{ Str::limit('Pesanan ' . $n->model_name . ' - ' . $n->qty . ' item. Total Rp ' . number_format($n->grand_total, 0, ',', '.'), 90) }}
                                </p>
                                <a href="{{ route('payment.va', $n->id) }}" class="details-link">Details...</a>
                            </div>
                        </div>
                    </a>
                    <hr>
                @endforeach

                {{-- TEST DRIVE NOTIFICATIONS --}}
                @foreach ($notifTestdrives ?? [] as $t)
                    <div class="notification-item">
                        <div class="icon-circle bg-info">
                            <i class="bx bx-car"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="fw-bold mb-1">TEST DRIVE</h6>
                                <small class="text-muted fw-semibold">{{ optional($t->created_at)->diffForHumans() }}</small>
                            </div>
                            <p class="text-muted mb-1 small">
                                {{ Str::limit(($t->first_name ?? 'User') . ' requested a test drive' . (optional($t->product)->model_name ? ' - ' . optional($t->product)->model_name : ''), 90) }}
                            </p>
                            <a href="#" class="details-link">Details...</a>
                        </div>
                    </div>
                    <hr>
                @endforeach

            @endif

        </div>
    </div>

    <style>
        .notification-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            max-width: 520px;
            margin: auto;
        }

        .notification-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            color: white;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-circle.bg-danger {
            background-color: #dc3545;
        }

        .icon-circle.bg-warning {
            background-color: #ffc107;
            color: #333;
        }

        .icon-circle.bg-success {
            background-color: #28a745;
        }

        .icon-circle.bg-info {
            background-color: #17a2b8;
        }

        .details-link {
            color: #19c37d;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
        }

        .details-link:hover {
            text-decoration: underline;
        }

        hr {
            margin: 16px 0;
            opacity: 0.15;
        }
    </style>





@endsection
