<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Okeev</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/front_end/assets/images/favicon.svg') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front_end/assets/css/main.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Oxanium', sans-serif !important;
        }

        body.swal2-shown {
            overflow-y: scroll !important;
            /* scroll tetap muncul */
            padding-right: 0 !important;
            /* hilangkan padding tambahan */
        }


        /* === BUTTON GROUP === */
        .menu-buttons {
            margin-left: 40px;
        }

        .button-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        @media (max-width: 768px) {
            .d-lg-none {
                display: flex !important;
                justify-content: start;
                align-items: center;
                gap: 10px;
                width: 100%;

                padding: 10px 0;
            }
        }

        @media (min-width: 769px) {
            .d-lg-none {
                display: none !important;
            }
        }

        .btn-login,
        .btn-download {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Oxanium', sans-serif;
            font-size: 17px !important;
            padding: 8px 20px;
            border-radius: 40px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: #2c3552;
            color: #fff !important;
        }

        .btn-login:hover {
            background-color: #464747;
        }

        /* .btn-download {
            background: linear-gradient(90deg, #00b4ff, #00fff0);
            color: #083b4c;
        } */

        /* .btn-download i {
            margin-left: 6px;
            font-size: 13px;
        }

        .btn-download:hover {
            filter: brightness(1.1);
        } */

        .header .navbar .mobile-menu-btn .toggler-icon {
            background-color: #000 !important;
        }

        .logo-header {
            max-width: 125px;
            /* ukuran default untuk layar besar */
            height: auto;
            transition: all 0.3s ease;
        }

        /* Ukuran menengah */
        @media (max-width: 992px) {
            .logo-header {
                max-width: 150px;
            }

        }

        /* Ukuran kecil (HP) */
        @media (max-width: 576px) {
            .logo-header {
                max-width: 110px;
            }
        }

        .dropdown-menu .dropdown-item {
            padding: 15px 0 !important;
        }

        /* Semua item warna hitam */
        .dropdown-menu .dropdown-item {
            color: #30445c !important;
            background-color: transparent !important;
        }

        /* Hanya item yang di-hover -> biru */
        .dropdown-menu .dropdown-item:hover {
            color: #0d6efd !important;
            /* biru bootstrap */
            background-color: transparent !important;
        }
        /* Make layout use flex column so footer stays at bottom */
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main.site-content {
            flex: 1 0 auto;
        }
    </style>

    <!-- 🛑 Auto-Refresh Block untuk halaman payment -->
    <script>
        if (window.location.pathname.includes('payment/success') || window.location.pathname.includes('payment/failed')) {
            window.location.reload = () => false;
            window.history.go = () => false;

            // Block auto-fetch polling
            const originalFetch = window.fetch;
            window.fetch = function(url, options) {
                if (typeof url === 'string' && (url.includes('payment/success') || url.includes('payment/failed'))) {
                    return Promise.reject('Auto-refresh blocked');
                }
                return originalFetch.apply(this, arguments);
            };
        }
    </script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- /End Preloader -->

    <!-- Start Header Area -->

    @include('layout.partials.header')

    <!-- End Header Area -->

    <main class="site-content">
        @yield('content')
    </main>

    @php
        $footer = \App\Models\HomeFooter::first();
    @endphp

    <footer style="background-color: #F9F9F9;" class="pt-5">
        <div class="container">
            <div class="row pb-4">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <a href="/">
                            <img src="{{ asset('front_end/assets/images/logo/logo.png') }}" alt="Logo">
                        </a>
                    </div>
                    <p class="text-secondary small">
                        @if($footer && $footer->description)
                            {!! nl2br(e($footer->description)) !!}
                        @else
                            Lorem ipsum dolor sit amet consectetur. Velit fermentum mi consectetur egestas in mauris. Enim
                            orci volutpat nullam ac sed dolor etiam nulla fringilla. Laoreet sagittis elementum elit ipsum
                            cras aenean malesuada.
                        @endif
                    </p>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-body">Vehicle</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-body">Accessories</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-body">About</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-body">News</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-body">Contact</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-envelope me-2"></i>
                            @if($footer && $footer->email)
                                <a href="mailto:{{ $footer->email }}" class="text-decoration-none text-body small">{{ $footer->email }}</a>
                            @else
                                <a href="mailto:okeev2025@gmail.com" class="text-decoration-none text-body small">okeev2025@gmail.com</a>
                            @endif
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-telephone me-2"></i>
                            <span class="text-body small">{{ $footer->handphone ?? '+62 5689 8546 253' }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-geo-alt me-2 mt-1"></i>
                            <span class="text-body small">{{ $footer->lokasi ?? 'Lorem ipsum dolor sit amet consectetur. Velit fermentum mi consectetur.' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-white text-center py-3" style="background-color: #30445C !important;">
            <div class="container">
                <p class="mb-0 small">Okeev {{ date('Y') }}</p>
            </div>
        </div>
    </footer>


    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="bx bx-chevron-up"></i>
    </a>


    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('/front_end/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/count-up.min.js') }}"></script>
    <script src="{{ asset('/front_end/assets/js/main.js') }}"></script>

    <script type="text/javascript">
        //====== counter up 
        var cu = new counterUp({
            start: 0,
            duration: 2000,
            intvalues: true,
            interval: 100,
            append: " ",
        });
        cu.start();
    </script>
    <script>
        // Ambil semua lingkaran warna
        const colorCircles = document.querySelectorAll('.color-circle');
        const carPreview = document.getElementById('car-preview'); // Gambar mobil
        const colorName = document.getElementById('color-name'); // Nama warna

        colorCircles.forEach(circle => {
            circle.addEventListener('click', function() {
                // Hapus active dari semua lingkaran
                colorCircles.forEach(c => c.classList.remove('active'));

                // Tambahkan active ke yang diklik
                this.classList.add('active');

                // Update nama warna
                colorName.textContent = this.dataset.name;

                // Update gambar mobil
                carPreview.src = this.dataset.image;
            });
        });
    </script>
</body>
@include('sweetalert::alert')


{{-- ini SCRIPT UNTUK MEMUNCULKAN TITIK DI KERANJANG --}}
<script>
    function showCartDot() {
        const dot = document.getElementById('cartDot');
        if (dot) dot.style.display = 'inline-block';
    }
</script>


{{-- Akhir ini SCRIPT UNTUK MEMUNCULKAN TITIK DI KERANJANG --}}


<!-- Tambahkan meta CSRF di <head> -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectAll = document.getElementById('selectAll');
        const totalPriceEl = document.getElementById('totalPrice');
        const buyBtn = document.getElementById('buyBtn');
        const cartCountEl = document.getElementById('cartCount');
        const cartDotEl = document.getElementById('cartDot');

        // Ambil CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        /* ===== HEADER ===== */
        function updateHeader(count) {
            if (cartCountEl) {
                cartCountEl.textContent = count;
                cartCountEl.style.display = count > 0 ? 'inline-block' : 'none';
            }
            if (cartDotEl) {
                cartDotEl.style.display = count > 0 ? 'inline-block' : 'none';
            }
        }

        /* ===== TOTAL ===== */
        function updateTotal() {
            let total = 0;
            let count = 0;

            document.querySelectorAll('.product-item').forEach(item => {
                const check = item.querySelector('.product-check');
                if (check && !check.checked) return;

                const qty = parseInt(item.querySelector('.qty').textContent) || 0;
                const price = parseInt(item.dataset.price) || 0;

                total += qty * price;
                count += qty;
            });

            if (totalPriceEl) totalPriceEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
            if (buyBtn) buyBtn.textContent = `BUY (${count})`;
        }

        /* ===== SELECT ALL ===== */
        selectAll?.addEventListener('change', function() {
            document.querySelectorAll('.product-check').forEach(cb => {
                cb.checked = this.checked;
            });
            updateTotal();
        });

        document.addEventListener('change', e => {
            if (!e.target.classList.contains('product-check')) return;

            const all = document.querySelectorAll('.product-check');
            const checked = document.querySelectorAll('.product-check:checked');
            if (selectAll) selectAll.checked = all.length === checked.length;
            updateTotal();
        });

        /* ===== PLUS / MINUS / REMOVE ===== */
        document.addEventListener('click', async e => {
            const btn = e.target.closest('.plus-btn, .minus-btn, .remove-btn');
            if (!btn) return;

            e.preventDefault();

            const item = btn.closest('.product-item');
            const id = item.dataset.id;
            const qtyEl = item.querySelector('.qty');

            let url = '';
            let method = 'POST';

            if (btn.classList.contains('plus-btn')) {
                url = '/cart/increase';
            }
            if (btn.classList.contains('minus-btn')) {
                if (parseInt(qtyEl.textContent) <= 1) return;
                url = '/cart/decrease';
            }
            if (btn.classList.contains('remove-btn')) {
                url = `/cart/${id}`;
                method = 'DELETE';
            }

            const res = await fetch(url, {
                method,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: method !== 'DELETE' ? JSON.stringify({
                    id
                }) : null
            });

            if (!res.ok) {
                console.error('Request failed');
                return;
            }

            const data = await res.json();

            if (btn.classList.contains('remove-btn')) {
                item.remove();
            } else {
                qtyEl.textContent = data.qty ?? qtyEl.textContent;
            }

            updateHeader(data.count ?? 0);
            updateTotal();
        });

        // Update total saat pertama load
        updateTotal();
    });
</script>

</html>
