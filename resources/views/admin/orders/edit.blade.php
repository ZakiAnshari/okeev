@extends('layout.admin')
@section('title', 'Edit-Order')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <!-- Tombol kembali -->
            <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="/orders">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                    </button>
                </a>

                <h4 class="fw-bold d-flex align-items-center my-4">
                    Order
                    <i class="bx bx-receipt mx-2 text-primary" style="font-size: 1.5rem;"></i>
                </h4>

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

                    <form action="{{ route('orders.update', $orders->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row justify-content-center">
                            <div class="col-lg-4 mb-3">
                                <label class="form-label d-block">Update Status Transaction</label>

                                @php
                                    $statusSource =
                                            old('status_transaksi') ??
                                            ($orders->status_transaksi ?? ($orders->status_transaction ?? ($orders->status ?? '')));
                                    $currentStatus = strtolower((string) $statusSource);
                                    $statusIcons = [
                                        'new' => 'bx bx-bell-plus',
                                        'processing' => 'bx bx-loader-circle',
                                        'being_sent' => 'bx bx-car',
                                        'to_the_location' => 'bx bx-map',
                                        'delivered' => 'bx bx-check-circle',
                                        'cancelled' => 'bx bx-x-circle',
                                    ];
                                    $statusClasses = [
                                        'new' => 'text-primary',
                                        'processing' => 'text-warning',
                                        'being_sent' => 'text-info',
                                        'to_the_location' => 'text-purple', // custom class nanti bisa dibuat di CSS
                                        'delivered' => 'text-success',
                                        'cancelled' => 'text-danger',
                                    ];
                                @endphp

                                <div class="input-group w-100">
                                    <span class="input-group-text" id="status-icon">
                                        <i
                                            class="{{ $statusIcons[$currentStatus] ?? 'bx bx-question-mark' }} {{ $statusClasses[$currentStatus] ?? '' }}"></i>
                                    </span>
                                    <select class="form-select" name="status_transaksi" id="status-select"
                                        aria-label="Status select">
                                        <option value="new" data-icon="bx bx-bell-plus" data-class="text-primary"
                                            {{ $currentStatus == 'new' ? 'selected' : '' }}>New</option>
                                        <option value="processing" data-icon="bx bx-loader-circle" data-class="text-warning"
                                            {{ $currentStatus == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="being_sent" data-icon="bx bx-car" data-class="text-info"
                                            {{ $currentStatus == 'being_sent' ? 'selected' : '' }}>Being Sent</option>
                                        <option value="to_the_location" data-icon="bx bx-map" data-class="text-purple"
                                            {{ $currentStatus == 'to_the_location' ? 'selected' : '' }}>Location</option>
                                        <option value="delivered" data-icon="bx bx-check-circle" data-class="text-success"
                                            {{ $currentStatus == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" data-icon="bx bx-x-circle" data-class="text-danger"
                                            {{ $currentStatus == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>


                            </div>
                        </div>



                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                    <hr>
                    <div class="row">


                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">No Transaksi</label>
                                <div class="form-control"
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    {{ $orders->no_transaction }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Waktu Pesan</label>
                                <div class="form-control"
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    {{ $orders->created_at->timezone('Asia/Jakarta')->format('d F Y, H:i') }} WIB
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Nama Pemesan</label>
                                <div class="form-control"
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    {{ $orders->user->first_name }}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">No Telp</label>
                                <div class="form-control"
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    {{ $orders->user->contact }}
                                </div>
                            </div>
                        </div>




                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="form-control"
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    {{ $orders->user->email }}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Model</label>
                                <div class="form-control"
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    {{ $orders->model_name }}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <div class="form-control"
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    {{ $orders->qty }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Color</label>
                                <div class="form-control"
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    {{ blank($orders->color) ? '-' : $orders->color }}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <div class="form-control"
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    Rp {{ number_format($orders->price, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Total</label>
                                <div class="form-control "
                                    style="background-color: #374151; color: #f9fafb; border: none; border-radius: 8px; padding: 12px; font-size: 14px;">
                                    Rp {{ number_format($orders->grand_total, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Payment Status</label>
                                <div
                                    class="form-control text-uppercase
                                            {{ $orders->status === 'PENDING' ? 'bg-warning text-white' : '' }}
                                            {{ $orders->status === 'Completed' ? 'bg-success text-white' : '' }}
                                        ">
                                    {{ $orders->status }}
                                </div>
                            </div>
                        </div>




                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control " rows="3" style="background-color: #374151; color: #f9fafb;" readonly>
{{ $orders->user->city }}
        </textarea>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('status-select');
            const iconEl = document.querySelector('#status-icon i');

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
        });
    </script>
    @include('sweetalert::alert')
@endsection
