<header class="header navbar-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">
                    <!-- Start Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <a href="/" class="d-inline-block">
                            <img src="{{ asset('front_end/assets/images/logo/logo.png') }}" alt="Logo"
                                class="img-fluid logo-header">
                        </a>
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">

                                <li class="nav-item dropdown position-static">
                                    <a class="dd-menu collapsed" href="#" id="megaVehicle" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Vehicle
                                    </a>
                                    <div class="dropdown-menu w-100 p-4" aria-labelledby="megaVehicle">

                                        <div class="row position-relative vehicle-divider">
                                            @forelse ($categoriesPosition1 as $category)
                                                <div class="col-lg-6 col-md-6 mb-4 p-5">
                                                    <!-- Header kategori -->
                                                    <h6 class="fw-bold mb-3">{{ $category->name_category }}</h6>
                                                    <!-- Grid brands per kategori -->
                                                    <div class="row">
                                                        @foreach ($category->brands->chunk(4) as $chunk)
                                                            <div class="col-6 col-md-4">
                                                                <ul class="list-unstyled">
                                                                    @foreach ($chunk as $brand)
                                                                        <li>
                                                                            <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                                class="dropdown-item brand-item">
                                                                                {{ $brand->name_brand }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-0">Kategori Vehicle belum tersedia.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <style>
                                            .brand-item {
                                                font-weight: normal !important;
                                            }

                                            .vehicle-divider {
                                                position: relative;
                                            }

                                            .vehicle-divider::before {
                                                content: "";
                                                position: absolute;
                                                top: 0;
                                                bottom: 0;
                                                /* Garis tetap di tengah, tapi diberi margin kiri & kanan */
                                                left: calc(50% - 1px);
                                                /* posisi tengah */
                                                width: 3px;
                                                background-color: #dcdcdc;
                                                /* Margin kiri–kanan garis */
                                                margin-left: -20px;
                                                margin-right: -20px;
                                            }

                                            .dropdown-menu {
                                                background-color: rgba(255, 255, 255, 0.85) !important;
                                                backdrop-filter: blur(4px);
                                                /* opsional biar lebih halus */
                                            }
                                        </style>


                                    </div>
                                </li>

                                <li class="nav-item dropdown position-static">
                                    <a class="dd-menu collapsed" href="#" id="megaElectric" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Electric
                                    </a>

                                    <div class="dropdown-menu w-100 p-4" aria-labelledby="megaElectric">

                                        <div class="row electric-divider">
                                            @forelse ($categoriesPosition2 as $category)
                                                <div class="col-lg-3 col-md-6 mb-4 p-3">
                                                    <h6 class="fw-bold mb-3">{{ $category->name_category }}</h6>
                                                    <div class="row">
                                                        @foreach ($category->brands->chunk(4) as $chunk)
                                                            @foreach ($chunk as $brand)
                                                                <div class="col-6 col-md-6">
                                                                    <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                        class="dropdown-item brand-item">
                                                                        {{ $brand->name_brand }}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-0">
                                                        Electric belum tersedia.</p>
                                                </div>
                                            @endforelse

                                        </div>
                                        <style>
                                            /* Hilangkan bold brand */
                                            .brand-item {
                                                font-weight: normal !important;
                                            }

                                            /* Garis pemisah setiap kategori */
                                            .electric-divider>div {
                                                border-right: 2px solid #dcdcdc;
                                            }

                                            /* Hilangkan garis di kolom terakhir */
                                            .electric-divider>div:last-child {
                                                border-right: none;
                                            }
                                        </style>


                                    </div>
                                </li>


                                <li class="nav-item dropdown position-static">
                                    <a style="padding: 35px 0px" class="nav-link dropdown-toggle" href="#"
                                        id="megaAccessories" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Accessories
                                    </a>

                                    <div class="dropdown-menu w-100 p-4" aria-labelledby="megaAccessories">
                                        <div class="row g-4 accessories-divider">
                                            @forelse ($categoriesPosition3 as $category)
                                                <div class="col-lg-3 col-md-6 mb-4 p-5">
                                                    <h6 class="fw-bold mb-3">{{ $category->name_category }}</h6>

                                                    <div class="row g-2">
                                                        @foreach ($category->brands->chunk(4) as $chunk)
                                                            @foreach ($chunk as $brand)
                                                                <div class="col-6 col-md-6">
                                                                    <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                        class="dropdown-item px-0 brand-item">
                                                                        {{ $brand->name_brand }}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-0">Accessories belum tersedia.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <style>
                                            /* Garis pemisah antar kategori */
                                            .accessories-divider>div {
                                                border-right: 2px solid #dcdcdc;
                                            }

                                            /* Hilangkan garis di kolom terakhir */
                                            .accessories-divider>div:last-child {
                                                border-right: none;
                                            }

                                            /* Hilangkan bold di brand */
                                            .brand-item {
                                                font-weight: normal !important;
                                            }
                                        </style>



                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a href="/about">About</a>
                                </li>

                                <li class="nav-item">
                                    <a href="/News">News</a>
                                </li>

                                <li class="nav-item">
                                    <a href="/contact">Contact</a>
                                </li>

                            </ul>
                            <div class="button add-list-button">
                                <div class="button-group">
                                    @guest
                                        <a href="/login" class="btn-login">Login</a>
                                    @endguest

                                    {{-- <a href="#" class="btn-download">
                                                Download App   <i class="bx bx-download me-2 fs-4"></i>
                                            </a> --}}
                                </div>
                            </div>
                            {{-- SUDAH LOGIN --}}
                            <div class="topbar-wrapper">
                                @auth
                                    <!-- Search -->
                                    <div class="search-box">
                                        <i class="bx bx-search"></i>
                                        <input type="text" placeholder="Search">
                                    </div>
                                    <!-- Icon Buttons -->
                                    <div class="icon-box">
                                        <a href="/cart" class="icon-btn position-relative">
                                            <i class="bx bx-shopping-bag fs-3"></i>

                                            <!-- Badge jumlah item -->
                                            <span id="cartCount"
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                style="font-size:12px;">
                                                0
                                            </span>
                                        </a>

                                        <a href="javascript:void(0)" class="icon-btn notif position-relative"
                                            data-bs-toggle="modal" data-bs-target="#notificationModal">

                                            <i class="bx bx-bell fs-4"></i>
                                            <span class="rounded-circle bg-danger position-absolute top-0 end-0 p-1"
                                                style="width:8px; height:8px;"></span>
                                        </a>


                                        <!-- PROFILE -->
                                        <a href="{{ route('profil.show', optional(Auth::user())->slug ?? 'guest') }}"
                                            class="profile-box">
                                            <img src="{{ asset('front_end/assets/images/Group 21.png') }}"
                                                alt="Profile">
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil cart dari localStorage atau buat baru
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const cartCountEl = document.getElementById('cartCount');
        const cartIcon = document.getElementById('cartIcon');

        // Update badge
        function updateCartBadge() {
            let totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
            cartCountEl.textContent = totalQty;
        }

        updateCartBadge();

        // Add to Cart click
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseInt(this.dataset.price);
                const image = this.dataset.image;

                // Cek apakah item sudah ada di cart
                let existing = cart.find(p => p.id == id);
                if (existing) {
                    existing.qty += 1;
                } else {
                    cart.push({
                        id,
                        name,
                        price,
                        image,
                        qty: 1
                    });
                }

                // Simpan ke localStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                // Update badge
                updateCartBadge();

                // SweetAlert notifikasi
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: `${name} berhasil ditambahkan ke keranjang`,
                    timer: 1200,
                    showConfirmButton: false
                });
            });
        });

        // Klik icon cart → tampilkan isi cart
        cartIcon.addEventListener('click', function(e) {
            e.preventDefault();

            if (cart.length === 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'Keranjang kosong',
                    text: 'Silakan tambahkan produk terlebih dahulu',
                    timer: 1500,
                    showConfirmButton: false
                });
                return;
            }

            let html = '<div style="text-align:left;">';
            cart.forEach(item => {
                html +=
                    `<p>${item.name} x ${item.qty} <strong>${formatRupiah(item.price * item.qty)}</strong></p>`;
            });
            html += '</div>';

            Swal.fire({
                title: 'Isi Keranjang',
                html: html,
                icon: 'info',
                showCloseButton: true
            });
        });

        // Fungsi format rupiah
        function formatRupiah(angka) {
            return "Rp " + angka.toLocaleString("id-ID");
        }
    });
</script>
