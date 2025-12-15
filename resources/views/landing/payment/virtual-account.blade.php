@extends('layout.user')
@section('title', 'cart')
@section('content')

    <br><br><br><br>
    <div class="container">
        <!-- Back -->
        <br><br>
        <a href="/order-now" class="text-decoration-none d-flex align-items-center mb-4">
            <i class="bx bx-arrow-back me-2 "></i> Payment
        </a>

        <div class="d-flex justify-content-center align-items-start py-5">

            <div class="payment-card p-4 shadow-sm rounded-4" style="width: 100%; max-width: 480px;">

                <!-- HEADER -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-start">
                        <div class="icon-circle me-3">
                            <i class='bx bx-time'></i>
                        </div>

                        <div>
                            <h6 class="mb-1 fw-semibold">Bayar sebelum</h6>
                            <small class="text-muted">15 Des 2025, 13:12 WIB</small>
                        </div>
                    </div>

                    <div class="countdown-badge">
                        <i class='bx bx-time mx-1'></i>
                        <span id="countdown">23:52:37</span>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const countdownEl = document.getElementById('countdown');

                            // Set waktu target (contoh: 24 jam dari sekarang)
                            let targetTime = new Date();
                            targetTime.setHours(targetTime.getHours() + 24); // bisa diganti sesuai kebutuhan

                            function updateCountdown() {
                                const now = new Date();
                                let diff = Math.floor((targetTime - now) / 1000); // selisih dalam detik

                                if (diff < 0) diff = 0; // jika sudah habis

                                const hours = String(Math.floor(diff / 3600)).padStart(2, '0');
                                const minutes = String(Math.floor((diff % 3600) / 60)).padStart(2, '0');
                                const seconds = String(diff % 60).padStart(2, '0');

                                countdownEl.textContent = `${hours}:${minutes}:${seconds}`;
                            }

                            updateCountdown(); // tampilkan langsung saat load
                            setInterval(updateCountdown, 1000); // update tiap detik
                        });
                    </script>

                </div>

                <hr>

                <!-- VA NUMBER -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <small class="text-muted d-block">Nomor Virtual Account</small>
                        <span class="fw-semibold">8870857749566895</span>
                        <i class="bx bx-copy copy-icon ms-2"></i>
                    </div>


                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA"
                        class="bank-logo" style="height:30px;">
                </div>

                <!-- TOTAL -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <small class="text-muted d-block">Total Bayar</small>
                        <span class="fw-semibold">Rp 194.002.000</span>
                        <i class="bx bx-copy copy-icon ms-2"></i>
                    </div>

                    <a href="#" class="detail-link">Lihat Detail</a>
                </div>

                <hr>

                <!-- INFO -->
                <ul class="info-list" style="list-style: none; padding-left: 0;">
                    <li class="info-item d-flex align-items-start mb-2">
                        <span class="info-icon me-2">
                            <i class="bx bx-info-circle"></i>
                        </span>
                        <span>
                            <strong>Penting:</strong> Transfer Virtual Account hanya bisa dilakukan
                            dari bank yang kamu pilih
                        </span>
                    </li>

                    <li class="info-item d-flex align-items-start mb-2">
                        <span class="info-icon me-2">
                            <i class="bx bx-check-circle"></i>
                        </span>
                        <span>
                            Transaksi kamu baru akan diteruskan ke penjual setelah pembayaran
                            berhasil diverifikasi
                        </span>
                    </li>
                </ul>

                <!-- BUTTONS -->
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <button class="btn btn-outline-primary flex-fill">
                        Lihat Cara Bayar
                    </button>
                    <button class="btn btn-outline-primary flex-fill">
                        Cek Status Bayar
                    </button>
                </div>

            </div>
        </div>


        <style>
            .info-list .dot {
                display: inline-block;
                width: 10px;
                /* ukuran bulat */
                height: 10px;
                /* ukuran bulat */
                background-color: #00B0E5;
                /* warna bulat */
                border-radius: 50%;
                /* membuat bulat sempurna */
                margin-top: 5px;
                /* sejajarkan dengan teks */
                flex-shrink: 0;
            }

            .payment-card {
                border: 1px solid #e5e7eb;
                border-radius: 16px;
                padding: 20px;
                background: #fff;
                max-width: 700px;
            }

            /* ICON */
            .icon-circle {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: #e6f7ff;
                color: #0ea5e9;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
            }

            /* COUNTDOWN */
            .countdown-badge {
                background: #e6f7ff;
                color: #0284c7;
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 14px;
                white-space: nowrap;
            }

            /* BANK LOGO */
            .bank-logo {
                height: 28px;
            }

            /* COPY ICON */
            .copy-icon {
                color: #0ea5e9;
                cursor: pointer;
            }

            /* LINK */
            .detail-link {
                color: #0ea5e9;
                font-size: 14px;
                text-decoration: none;
            }

            /* INFO LIST */
            .info-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .info-list li {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                margin-bottom: 10px;
                font-size: 14px;
            }

            .info-list .dot {
                width: 10px;
                height: 10px;
                background: #0ea5e9;
                border-radius: 50%;
                margin-top: 6px;
            }
        </style>

    </div>
@endsection
