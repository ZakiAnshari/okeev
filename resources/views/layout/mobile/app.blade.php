<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OKEEV - Electric Vehicle Platform')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front_end/assets/css/mobile.css') }}">

</head>

<body>
    @yield('content')
    <!-- CSS Mobile -->

    <!-- Hotbar -->
    <div class="bottom-nav">
        <div class="bottom-nav-container">
            <a href="{{ route('transaksi.show') }}"
                class="nav-item {{ request()->routeIs('transaksi.show') ? 'active' : '' }}">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                </svg>
                <span class="nav-label">Transaction</span>
            </a>

            <a href="{{ route('mobile.home') }}"
                class="nav-item {{ request()->routeIs('mobile.home', 'vehiclecard.show', 'vehiclecard.detail') ? 'active' : '' }}">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
                <span class="nav-label">Home</span>
            </a>

            <a href="{{ route('newss.show') }}"
                class="nav-item {{ request()->routeIs('newss.show', 'newssdetail.show') ? 'active' : '' }}">

                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                </svg>
                <span class="nav-label">News</span>
            </a>


            <a href="{{ route('profil.show') }}"
                class="nav-item {{ request()->routeIs('profil.show') ? 'active' : '' }}">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                </svg>
                <span class="nav-label">Profile</span>
            </a>

        </div>

    </div>

    <style>

    </style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showTab(tab) {
            document.getElementById('vehicle-brands').style.display = tab === 'vehicle' ? 'grid' : 'none';
            document.getElementById('electric-brands').style.display = tab === 'electric' ? 'grid' : 'none';

            document.querySelectorAll('.collab-tab').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
        }
        // SCRIPT TAMBAHAN — UNTUK TAB KATEGORI MOST SEARCHED
        document.addEventListener('DOMContentLoaded', () => {

            const searchTabs = document.querySelectorAll('.search-tab');

            searchTabs.forEach(tab => {
                tab.addEventListener('click', function() {

                    // Hilangkan kelas aktif di semua tab
                    searchTabs.forEach(t => t.classList.remove('active'));

                    // Tambah kelas aktif pada yang diklik
                    this.classList.add('active');

                    // Ambil kategori
                    const category = this.innerText.trim().toLowerCase();

                    // Nanti bisa diarahkan ke filter produk
                    console.log("Kategori dipilih:", category);
                });
            });

            // EVENT UNTUK BUTTON DETAILS — MENUJU HALAMAN DETAIL
            document.querySelectorAll('.details-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    window.location.href = `product-detail.html?id=${productId}`;
                });
            });

        });
    </script>
</body>

</html>
