<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice - {{ $order->no_transaction }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Clean print layout */
        body { background: #fff; color: #222; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
        .invoice-print { max-width: 900px; margin: 24px auto; }
        .card { border: none; box-shadow: none; }
        .table-borderless th, .table-borderless td { border: 0; }
        @media print {
            .no-print { display: none !important; }
            body { margin: 0; }
        }
    </style>
</head>
<body>

<div class="invoice-print">
    <div class="card">
        <div class="card-body px-4 py-4">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('/front_end/assets/images/logo_okeev.png') }}" alt="Okeev" height="34">
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">STATUS :</small><br>
                        <span class="fw-bold text-success">{{ strtoupper($order->status) }}</span>
                    </div>
                </div>

                <div class="text-end">
                    <div class="fw-bold">INVOICE</div>
                    <div class="text-success fw-semibold">{{ $order->no_transaction }}</div>
                </div>
            </div>

            {{-- INFO --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="fw-bold text-uppercase mb-1">DITERBITKAN ATAS NAMA</div>
                    <table class="table table-borderless table-sm mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted text-start p-0" style="width:40%">Penjual</td>
                                <td class="px-2 text-center" style="width:5%">:</td>
                                <td><strong>Okeev</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <div class="fw-bold text-uppercase mb-1">UNTUK</div>
                    <table class="table table-borderless table-sm mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted text-start p-0" style="width:40%">Pembeli</td>
                                <td class="px-2 text-center" style="width:5%">:</td>
                                <td><strong>{{ $order->user->first_name }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted text-start p-0">Tanggal Pembelian</td>
                                <td class="px-2 text-center">:</td>
                                <td><strong>{{ $order->created_at->format('d F Y') }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted text-start align-top p-0">Alamat Pengiriman</td>
                                <td class="px-2 text-center align-top">:</td>
                                <td>
                                    <strong>{{ $order->user->first_name }}</strong> ({{ $order->user->contact }})<br>
                                    {{ $order->user->city ?? '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TABLE --}}
            <table class="table table-borderless align-middle mt-4">
                <thead class="border-bottom">
                    <tr class="text-uppercase small text-muted">
                        <th>Info Produk</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Harga Satuan</th>
                        <th class="text-end">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong class="text-success">{{ $order->model_name ?? optional($order->product)->model_name }}</strong>
                        </td>
                        <td class="text-center">{{ $order->qty }}</td>
                        <td class="text-end">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                        <td class="text-end">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- TOTAL --}}
            <div class="d-flex justify-content-end mt-4">
                <table class="table table-borderless w-auto">
                    <tr>
                        <td class="text-end">Total Harga Barang</td>
                        <td class="text-end fw-semibold">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-end">Total Belanja</td>
                        <td class="text-end fw-semibold">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-top">
                        <td class="text-end fw-bold">Total Tagihan</td>
                        <td class="text-end fw-bold fs-5">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            {{-- BUTTON --}}
            <div class="text-end mt-4 no-print">
                <button class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer-fill me-1"></i> Cetak Invoice</button>
            </div>

        </div>
    </div>
</div>

</body>
</html>
