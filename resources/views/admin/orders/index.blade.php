@extends('layout.admin')
@section('title', 'Product')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-category me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="text-muted fw-light me-1"></span> Orders
            </h4>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Table Data -->
                            <table id="ordersTable" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Status</th>

                                        <th>Harga</th>
                                        <th>Payment Status</th>
                                        <th style="text-align: center; padding:10px 10px;">Aksi</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->no_transaction }}</td>
                                            <td>
                                                {{ $order->created_at->timezone('Asia/Jakarta')->format('d-m-Y - ( H:i') }}
                                                WIB )
                                            </td>
                                            
                                            <td style="text-transform: uppercase;">
                                                {{ $order->status_transaksi }}
                                            </td>

                                            <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                                            <td style="width: 10px;">
                                                @php
                                                    $statusClasses = [
                                                        'PENDING' => 'bg-warning text-white',
                                                        'Completed' => 'bg-success text-white',
                                                        'cancelled' => 'bg-danger text-white',
                                                    ];
                                                @endphp
                                                <span
                                                    class="badge {{ $statusClasses[$order->status] ?? 'bg-secondary text-white' }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td style="text-align: center;padding:10px 10px;">
                                                <a href="{{ route('orders.edit', $order->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    Open
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#ordersTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                order: [
                    [1, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 5]
                }],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    },
                    zeroRecords: "Data tidak ditemukan"
                }
            });
        });
    </script>

    @include('sweetalert::alert')
@endsection
