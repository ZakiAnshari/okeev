@extends('layout.admin')
@section('title', 'Edit-Order')
@section('content')
    <style>
        /* Prevent layout shift when modals open/close by reserving scrollbar gutter */
        html {
            overflow-y: scroll;
            scrollbar-gutter: stable;
        }

        /* Prevent bootstrap from adding body padding which causes horizontal shift */
        body.modal-open {
            padding-right: 0 !important;
            margin-right: 0 !important;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <!-- Tombol kembali -->
            @php
                $statusSource =
                    old('status_transaksi') ??
                    ($orders->status_transaksi ?? ($orders->status_transaction ?? ($orders->status ?? '')));
                $currentStatus = str_replace(' ', '_', strtolower((string) $statusSource));
                $paymentStatus = strtoupper((string) ($orders->status ?? ''));
            @endphp
            <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                <div class="d-flex align-items-center">
                    <a class="mx-4 my-4" href="/orders">
                        <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                            data-bs-toggle="tooltip" title="Kembali">
                            <i class="bi bi-arrow-left fs-5 mx-1"></i>
                        </button>
                    </a>

                    <h4 class="fw-bold d-flex align-items-center ms-2 mb-0">
                        Order
                        <i class="bx bx-receipt mx-2 text-primary" style="font-size: 1.5rem;"></i>
                    </h4>
                </div>

                <div class="ms-auto me-4">
                    @if ($paymentStatus === 'PENDING')
                        <button class="btn btn-secondary" disabled>
                            <i class="bi bi-hourglass-split me-1"></i>
                            Confirm
                        </button>
                    @elseif ($paymentStatus === 'COMPLETED')
                        @if (!in_array($currentStatus, ['processing', 'being_sent', 'delivered', 'cancelled']))
                            <button type="button" id="confirm-btn" class="btn btn-success">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                Confirm
                            </button>
                        @else
                            <button class="btn btn-secondary" disabled>
                                <i class="bi bi-lock-fill me-2"></i>
                                Confirm
                            </button>
                        @endif
                    @endif

                    {{-- Print Invoice --}}
                    @if ($paymentStatus === 'COMPLETED')
                        <a href="{{ route('orders.print', $orders->id) }}" target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-printer-fill me-1"></i>
                            Cetak Invoice
                        </a>
                    @else
                        <button class="btn btn-outline-secondary" disabled>
                            <i class="bi bi-printer me-1"></i>
                            Cetak Invoice
                        </button>
                    @endif
                </div>



            </div>

            <div class="card-body">
                <div class="text-nowrap">

                    {{-- Error Validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <style>
                        .value-box {
                            background-color: #eceef1;
                            color: #000000;
                            border: none;
                            border-radius: 8px;
                            padding: 12px;
                            font-size: 14px;
                        }

                        .status-badge {
                            font-weight: 600;
                            padding: .45rem .6rem;
                            border-radius: .5rem;
                        }

                        .status-icon {
                            font-size: 1.25rem;
                            vertical-align: middle;
                        }

                        .detail-label {
                            font-size: .85rem;
                            color: #9ca3af;
                        }
                    </style>

                    <div class="row gy-3">
                        <div class="col-lg-8">
                            <div class="card mb-3" style="border-solid:2px black;">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Order Details</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="detail-label text-dark mb-2">No Transaksi</div>
                                            <div class="value-box">{{ $orders->no_transaction }}</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="detail-label  text-dark mb-2">Waktu Pesan</div>
                                            <div class="value-box">
                                                {{ $orders->created_at->timezone('Asia/Jakarta')->format('d F Y, H:i') }}
                                                WIB</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="detail-label  text-dark mb-2">Nama Pemesan</div>
                                            <div class="value-box">{{ $orders->user->first_name }}</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="detail-label text-dark mb-2">No Telp</div>
                                            <div class="value-box">{{ $orders->user->contact }}</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="detail-label text-dark mb-2">Email</div>
                                            <div class="value-box">{{ $orders->user->email }}</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="detail-label text-dark mb-2">Model</div>
                                            <div class="value-box">{{ $orders->model_name }}</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="detail-label text-dark mb-2">Quantity</div>
                                            <div class="value-box">{{ $orders->qty }}</div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="detail-label text-dark mb-2">Color</div>
                                            <div class="value-box">{{ blank($orders->color) ? '-' : $orders->color }}</div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="detail-label text-dark mb-2">Harga</div>
                                            <div class="value-box text-dark">Rp {{ number_format($orders->price, 0, ',', '.') }}
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <div class="detail-label">Address</div>
                                            <textarea class="form-control value-box text-dark" rows="3" readonly>{{ $orders->user->city }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            @php
                                $statusSource =
                                    old('status_transaksi') ??
                                    ($orders->status_transaksi ??
                                        ($orders->status_transaction ?? ($orders->status ?? '')));
                                // normalize status to snake-like lowercase (handles "Being Sent" vs "being_sent")
                                $currentStatus = str_replace(' ', '_', strtolower((string) $statusSource));
                                $statusIcons = [
                                    'processing' => 'bx bx-loader-circle',
                                    'being_sent' => 'bx bx-car',
                                    'to_the_location' => 'bx bx-map',
                                    'delivered' => 'bx bx-check-circle',
                                    'cancelled' => 'bx bx-x-circle',
                                ];
                                $statusClasses = [
                                    'processing' => 'text-warning',
                                    'being_sent' => 'text-info',
                                    'to_the_location' => 'text-purple',
                                    'delivered' => 'text-success',
                                    'cancelled' => 'text-danger',
                                ];
                            @endphp

                            @php $paymentStatus = strtoupper((string) ($orders->status ?? '')); @endphp
                            @if (in_array($paymentStatus, ['PENDING', 'COMPLETED']))
                                <form action="{{ route('orders.update', $orders->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex align-items-center justify-content-between">
                                                <span>Manage Status</span>
                                                <i class="bx bx-receipt text-primary" style="font-size:1.2rem"></i>
                                            </h5>

                                            <div class="mb-3">
                                                <label class="form-label">Current</label>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span id="status-icon" class="me-2"><i
                                                            class="{{ $statusIcons[$currentStatus] ?? 'bx bx-question-mark' }} {{ $statusClasses[$currentStatus] ?? '' }} status-icon"></i></span>
                                                    <span
                                                        class="status-badge {{ $statusClasses[$currentStatus] ?? 'text-muted' }}">{{ strtoupper($currentStatus ?: $orders->status) }}</span>
                                                </div>
                                            </div>

                                            @php
                                                $editableStatuses = ['processing', 'being_sent', 'to_the_location'];
                                            @endphp

                                            <div class="mb-3">
                                                <label class="form-label">Update Status</label>
                                                <select class="form-select" name="status_transaksi" id="status-select"
                                                    aria-label="Status select">
                                                    <option value="processing" data-icon="bx bx-loader-circle"
                                                        data-class="text-warning"
                                                        {{ $currentStatus == 'processing' ? 'selected' : '' }}>Processing
                                                    </option>
                                                    <option value="being_sent" data-icon="bx bx-car" data-class="text-info"
                                                        {{ $currentStatus == 'being_sent' ? 'selected' : '' }}>Being Sent
                                                    </option>
                                                    <option value="to_the_location" data-icon="bx bx-map"
                                                        data-class="text-purple"
                                                        {{ $currentStatus == 'to_the_location' ? 'selected' : '' }}>
                                                        Location</option>
                                                    <option value="delivered" data-icon="bx bx-check-circle"
                                                        data-class="text-success"
                                                        {{ $currentStatus == 'delivered' ? 'selected' : '' }}>Delivered
                                                    </option>
                                                    <option value="cancelled" data-icon="bx bx-x-circle"
                                                        data-class="text-danger"
                                                        {{ $currentStatus == 'cancelled' ? 'selected' : '' }}>Cancelled
                                                    </option>
                                                </select>
                                            </div>

                                            @if (in_array($currentStatus, $editableStatuses))
                                                <div class="d-flex gap-2">
                                                    <button type="submit" class="btn btn-primary w-100">Update
                                                        Status</button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Manage Status</h5>
                                        <div class="mb-3">
                                            <label class="form-label">Current</label>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="me-2"><i
                                                        class="{{ $statusIcons[$currentStatus] ?? 'bx bx-question-mark' }} {{ $statusClasses[$currentStatus] ?? '' }} status-icon"></i></span>
                                                <span
                                                    class="status-badge {{ $statusClasses[$currentStatus] ?? 'text-muted' }}">{{ strtoupper($currentStatus ?: $orders->status) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Summary</h6>
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="text-muted">Subtotal</div>
                                        <div>Rp {{ number_format($orders->price, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="text-muted">Quantity</div>
                                        <div>{{ $orders->qty }}</div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <div class="fw-bold">Total</div>
                                        <div class="fw-bold">Rp {{ number_format($orders->grand_total, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="detail-label">Payment Status</div>
                                        <div class="mt-1">
                                            <span
                                                class="badge {{ $orders->status === 'PENDING' ? 'bg-warning text-dark' : '' }} {{ $orders->status === 'Completed' ? 'bg-success' : '' }}">{{ $orders->status }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <hr>

                </div>
            </div>


        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('status-select');
            const iconEl = document.querySelector('#status-icon i');

            const confirmBtn = document.getElementById('confirm-btn');
            const form = document.querySelector('form[action*="orders/"]');

            function updateIcon() {
                const opt = select.selectedOptions[0];
                if (!opt) return;

                // ganti icon
                iconEl.className = opt.dataset.icon || 'bx bx-question-mark';

                // hapus semua text-* dulu
                iconEl.className = iconEl.className.replace(/\btext-\S+/g, '');

                // tambahkan class bootstrap baru
                iconEl.classList.add(opt.dataset.class || '');
            }

            select.addEventListener('change', updateIcon);
            updateIcon();

            // Confirm button: set status to 'processing' and submit
            if (confirmBtn) {
                confirmBtn.addEventListener('click', function() {
                    if (!select) return;
                    if (select.value === 'processing') {
                        // already processing, just submit
                        form.submit();
                        return;
                    }
                    // set to processing, trigger change so icon updates
                    select.value = 'processing';
                    select.dispatchEvent(new Event('change'));
                    // submit the form
                    form.submit();
                });
            }
        });
    </script>
    @include('sweetalert::alert')
@endsection
