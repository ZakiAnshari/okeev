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
    <div id="digital-clock" class="text-center"></div>
    <br>
    <div class="menu-inner-shadow"></div>

    @php
        // Count distinct invoices (external_id) for new orders so multi-item invoices count as one
        $newOrdersCount = \App\Models\Order::whereRaw("LOWER(COALESCE(status_transaksi,'')) = 'new'")
            ->distinct('external_id')->count('external_id');

        // Count distinct invoices where payment is Completed but transaction status still pending/new
        $paidButUnprocessedCount = \App\Models\Order::whereRaw("LOWER(COALESCE(status,'')) = 'completed'")
            ->whereRaw("LOWER(COALESCE(status_transaksi,'')) IN ('pending','new')")
            ->distinct('external_id')->count('external_id');
    @endphp

    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">CMS</span></li>

        @php
            $manageContentActive =
                request()->routeIs('cms.*') || request()->routeIs('cms.home.hero.*') || Request::is('admin/content*');
        @endphp

        <li class="menu-item {{ $manageContentActive ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div>Manage Content</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('cms.home.hero.*') ? 'active' : '' }}">
                    <a href="{{ route('cms.home.hero.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-images"></i>
                        <div class="ms-2">Hero Content</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('cms.home.content.*') ? 'active' : '' }}">
                    <a href="{{ route('cms.home.content.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home"></i>
                        <div class="ms-2">Home</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('cms.home.about.*') ? 'active' : '' }}">
                    <a href="{{ route('cms.home.about.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-info-circle"></i>
                        <div class="ms-2">About</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('cms.home.contact.*') ? 'active' : '' }}">
                    <a href="{{ route('cms.home.contact.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-phone"></i>
                        <div class="ms-2">Contact</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('cms.home.footer.*') ? 'active' : '' }}">
                    <a href="{{ route('cms.home.footer.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-layout"></i>
                        <div class="ms-2">Footer</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">MANAGEMENT </span></li>


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
                    <div class="" data-i18n="Test Drive Booking">Orders</div>
                </div>
                @if ($newOrdersCount > 0)
                    <span class="badge bg-danger"
                        style="border-radius:6px; min-width:28px; padding:0.25rem 0.45rem; text-align:center;">{{ $newOrdersCount }}</span>
                @endif
                @if ($paidButUnprocessedCount > 0)
                    <span class="badge bg-success ms-1"
                        title="Pembayaran lunas tapi belum diproses"
                        style="border-radius:6px; min-width:28px; padding:0.25rem 0.45rem; text-align:center;">{{ $paidButUnprocessedCount }}</span>
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
