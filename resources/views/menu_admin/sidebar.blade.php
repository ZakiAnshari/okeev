<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand justify-content-center">
        <a href="index.html" class="app-brand-link gap-2">
            <div style="display: flex; justify-content: center; align-items: center; width: 100px; height: 88px;">
                <img src="{{ asset('/front_end/assets/images/logo_okeev.png') }}" alt="App Logo"
                    style="object-fit: contain;">
            </div>
        </a>
    </div>

    <!-- Digital Clock -->
    <div id="digital-clock" class="text-center my-2"></div>

    <div class="menu-inner-shadow"></div>

    @php
        $newOrdersCount = \App\Models\Order::where('status_transaksi', 'new')->count();
    @endphp

    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('slider') ? 'active' : '' }}">
            <a href="/slider" class="menu-link">
                <i class="menu-icon tf-icons bx bx-images"></i>
                <div data-i18n="Analytics">Slider</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('category*') ? 'active' : '' }}">
            <a href="/category" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Brand"> Category</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('brands*') ? 'active' : '' }}">
            <a href="/brands" class="menu-link">
                <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                <div data-i18n="Brand"> Brand</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('product*') ? 'active' : '' }}">
            <a href="/product" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Brand">Product</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('orders*') ? 'active' : '' }}">
            <a href="/orders" class="menu-link d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="menu-icon tf-icons bx bx-receipt"></i>
                    <div class="ms-2" data-i18n="Test Drive Booking">Orders</div>
                </div>
                @if($newOrdersCount > 0)
                    <span class="badge bg-danger" style="border-radius:6px; min-width:28px; padding:0.25rem 0.45rem; text-align:center;">{{ $newOrdersCount }}</span>
                @endif
            </a>
        </li>


        <li class="menu-item {{ Request::is('test-drive*') ? 'active' : '' }}">
            <a href="/test-drive" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                <div data-i18n="Test Drive Booking">Test Drive</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('news*') ? 'active' : '' }}">
            <a href="/news" class="menu-link position-relative">
                <i class="menu-icon tf-icons bx bxs-news"></i>
                <div data-i18n="News">News</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('Contact*') ? 'active' : '' }}">
            <a href="/Contact" class="menu-link position-relative">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Contact">Messages</div>
            </a>
        </li>

        {{-- User --}}
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Hak Akses</span></li>

        <li class="menu-item {{ Request::is('user*') ? 'active' : '' }}">
            <a href="/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">User</div>
            </a>
        </li>
    </ul>
</aside>
