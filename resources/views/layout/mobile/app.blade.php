<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OKEEV - Electric Vehicle Platform')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #213A94;
            --dark-bg: #30445C;
            --light-green: #35F5C6;
        }

        body {

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            padding-bottom: 80px;
            padding-top: 150px;
        }

        html {
            overflow-x: hidden;
            width: 100%;
        }

        .category-icon {
            width: 80px;
            /* ukuran icon */
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-icon-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        * {
            box-sizing: border-box;
            font-family: 'Oxanium', sans-serif;
        }

        .navbar-bottom {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* wrapper input */
        .search-wrapper {
            position: relative;
            flex: 1;
        }

        /* icon search */
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: var(--light-green);
            pointer-events: none;
        }

        /* input */
        .search-bar {
            width: 100%;
            height: 40px;
            padding-left: 38px;
            padding-right: 12px;
            border: 1px solid var(--light-green);

            font-size: 14px;
        }

        .search-bar::placeholder {
            color: var(--light-green);
        }

        /* Navbar */
        .navbar-custom {
            background: white;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            padding: 20px 0;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 500;
            border-radius: 0 0 18px 18px;
        }

        .navbar-custom .container {
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
            width: 100%;
        }

        .logo-icon {
            width: 80px;
            height: auto;
        }

        .logo-icon img {
            width: 150%;
            height: auto;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            /* ukuran icon bi-cart */
        }

        .icon-img {
            width: 1em;
            /* SAMA dengan icon font */
            height: 1em;
            object-fit: contain;
        }

        .search-bar {
            border: 1px solid var(--light-green);
            border-radius: 10px;
            /* padding: 8px 20px; */
            width: 100%;
        }

        .search-bar::placeholder {
            color: var(--light-green);
        }


        .icon-btn {
            border: 1px solid var(--light-green);
            width: 45px;
            height: 45px;
            min-width: 45px;
            min-height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
        }

        .navbar-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .navbar-bottom {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* Container untuk content */
        .content-container {
            padding-left: 20px;
            padding-right: 20px;
        }

        /* Category Buttons */
        .category-section {
            padding: 15px 0;
        }

        .category-btn {
            margin-left: 85px;
            background: transparent;
            border: none;
            padding: 0;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .category-icon {
            width: 70px;
            height: auto;
            /* background: #f0f0f0; */
            border-radius: 12px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .category-link {
            text-decoration: none;
            color: inherit;
        }


        /* .category-btn:hover .category-icon {
            background: var(--light-green);
        } */

        .category-icon svg {
            width: 32px;
            height: 62px;
            fill: var(--primary-blue);
        }

        .category-btn small {
            font-size: 11px;
            line-height: 1.3;
            word-wrap: break-word;
            color: #333;
        }

        /* Promo Banner */
        .promo-banner {
            background: linear-gradient(135deg, #e0e0e0 0%, #f5f5f5 100%);
            border-radius: 20px;
            padding: 0;
            margin: 20px 0;
            min-height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .promo-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 150px;
        }

        /* Main Text Section */
        .main-text-section {
            text-align: center;
            padding: 25px 15px;
        }

        .main-text-section h2 {
            color: var(--primary-blue);
            font-family: 'Oxanium', sans-serif;
            font-weight: 700;
            margin-bottom: 12px;
            font-size: 24px;
            line-height: 1.3;
        }

        .main-text-section p {
            font-size: 14px;
            line-height: 1.6;
            color: #666;
            margin: 0;
        }

        /* Slider */
        .slider-section {
            overflow-x: auto;
            padding: 20px 0;
            margin: 0 -20px;
            padding-left: 20px;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-blue) #e0e0e0;
            scroll-padding-left: 20px;
        }

        .slider-section::-webkit-scrollbar {
            height: 8px;
        }

        .slider-section::-webkit-scrollbar-track {
            background: #e0e0e0;
            border-radius: 10px;
        }

        .slider-section::-webkit-scrollbar-thumb {
            background: var(--primary-blue);
            border-radius: 10px;
        }

        .slider-container {
            display: flex;
            gap: 20px;
            padding: 10px 0;
            padding-right: 20px;
        }

        .slider-card {
            min-width: 300px;
            background: #f5f5f5;
            border-radius: 20px;
            overflow: hidden;
            flex-shrink: 0;
            position: relative;
            height: 150px;
        }

        .slider-card-short {
            min-width: 200px;
            background: #f5f5f5;
            border-radius: 20px;
            overflow: hidden;
            flex-shrink: 0;
            position: relative;
            height: 150px;
        }

        .slider-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .slider-card-overlay {
            position: absolute;
            bottom: 20px;
            left: 20px;
            z-index: 2;
        }

        .see-more-btn {
            background: rgba(0, 0, 0, 0.6) !important;
            backdrop-filter: blur(10px);
            color: white !important;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .see-more-btn:hover {
            background: rgba(0, 0, 0, 0.8) !important;
            color: white !important;
        }

        /* Why Choose Us */
        .why-choose-section {
            background: var(--dark-bg);
            color: white;
            padding: 50px 0;
            margin: 40px 0 0 0;
            position: relative;
        }

        .why-choose-section h3 {
            color: white;
            font-family: 'Oxanium', sans-serif;
            font-weight: 700;
            margin-bottom: 40px;
            font-size: 28px;
            text-align: center;
        }

        .features-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            text-align: left;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            min-width: 60px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .feature-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .feature-content {
            flex: 1;
        }

        .feature-title {
            color: var(--light-green);
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .feature-item p {
            color: white;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* Counting Section */
        .counting-section {
            padding: 40px 0;
            text-align: center;
        }

        .count-item h3 {
            color: var(--primary-blue);
            font-family: 'Oxanium', sans-serif;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .count-item p {
            font-size: 13px;
            color: #666;
        }

        .customer-profiles {
            display: flex;
            gap: -10px;
            align-items: center;
            margin: 10px;
        }

        .profile-img {
            width: 60px;
            height: 60px;
            background: #ddd;
            border-radius: 50%;
            border: 3px solid white;
            margin-left: -10px;
            overflow: hidden;
            min-width: 60px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-img:first-child {
            margin-left: 0;
        }

        .customer-text {
            margin-left: 20px;
        }

        .counting-section h4 {
            font-family: 'Oxanium', sans-serif;
            font-weight: 700;
            font-size: 18px;
        }

        .counting-section p {
            font-size: 13px;
            color: #666;
        }

        /* Collaboration */
        .collab-section {
            padding: 40px 0;
        }

        .collab-section h3 {
            font-family: 'Oxanium', sans-serif;
            font-weight: 700;
            font-size: 24px;
            margin: 20px;
        }

        .collab-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            margin: 25px;
        }

        .collab-tab {
            padding: 10px 30px;
            border: 2px solid var(--dark-bg);
            background: white;
            cursor: pointer;
            border-radius: 25px;
        }

        .collab-tab.active {
            background: var(--dark-bg);
            color: var(--light-green);
        }

        .brand-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 15px;
            margin: 20px 0;
            padding: 15px;
        }

        .brand-item {
            background: white;
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1;
        }

        .brand-logo {
            width: 80%;
            max-width: 90px;
            height: auto;
            object-fit: contain;
        }

        /* Most Searched */
        .most-searched-section {
            padding: 20px;
        }

        .most-searched-section h3 {
            font-family: 'Oxanium', sans-serif;
            font-weight: 700;
            font-size: 24px;
        }

        .strip-divider {
            height: 3px;
            background: linear-gradient(to right, var(--primary-blue), var(--light-green));
            margin: 20px 0;
        }

        .search-tabs {
            display: flex;
            gap: 15px;
            margin: 20px 0;
            border-bottom: 2px solid #ddd;
        }

        .search-tab {
            padding: 10px 20px;
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
        }

        .search-tab.active {
            color: var(--dark-bg);
            border-bottom: 3px solid var(--dark-bg);
            font-weight: bold;
        }

        /* Vehicle Card */
        .vehicle-card {
            display: block;
            background: white;
            border: 1px solid #ddd;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 20px;
            text-decoration: none;
            color: inherit;
            transition: 0.2s ease;
        }

        .vehicle-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .vehicle-img {
            display: flex;
            width: 100%;
            height: 220px;
            background: #f1f1f1;
            overflow: hidden;
            align-items: center;
            justify-content: center;
        }

        .car-img {
            width: 90%;
            height: auto;
            object-fit: contain;
            max-height: 180px;
        }

        .vehicle-info {
            padding: 20px;
        }

        .vehicle-specs {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            margin: 15px 0;
        }

        .spec-item {
            text-align: center;
        }

        .spec-icon svg {
            width: 22px;
            height: 22px;
            margin-bottom: 4px;
        }

        .spec-label {
            font-size: 12px;
            color: #666;
        }

        .vehicle-price {
            font-family: 'Oxanium', sans-serif;
            color: red;
            font-weight: bold;
            font-size: 18px;
        }

        /* Hotbar */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 200;
        }

        .bottom-nav-container {
            max-width: 480px;
            margin: 0 auto;
            display: flex;
            justify-content: space-around;
            padding: 12px 0;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 8px 16px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #999;
        }

        .nav-item:hover {
            color: var(--light-green);
        }

        .nav-item.active {
            color: var(--light-green);
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            margin-bottom: 4px;
        }

        .nav-label {
            font-size: 11px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
@yield('content')

<body>
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
