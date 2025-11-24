<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand justify-content-center">
        <a href="index.html" class="app-brand-link gap-2">
            <div style="display: flex; justify-content: center; align-items: center; width: 100px; height: 88px;">
                <img src="{{ asset('/front_end/assets/images/logo_okeev.png') }}" alt="App Logo" style="object-fit: contain;">
            </div>
        </a>
    </div>

    <!-- Digital Clock -->
    <div id="digital-clock" class="text-center my-2"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('brands*') ? 'active' : '' }}">
            <a href="/brands" class="menu-link">
                <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                <div data-i18n="Brand"> Brand</div>
            </a>
        </li>

        {{-- <li class="menu-item {{ Request::is('category*') ? 'active' : '' }}">
            <a href="/category" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Brand"> Category</div>
            </a>
        </li> --}}

        <li class="menu-item {{ Request::is('product*') ? 'active' : '' }}">
            <a href="/product" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Brand">Product</div>
            </a>
        </li>



        <li class="menu-item {{ Request::is('cars*') ? 'active' : '' }}">
            <a href="/cars" class="menu-link">
                <i class="menu-icon tf-icons bx bx-car"></i>
                <div data-i18n="Analytics">Electric Cars</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('motorcycles*') ? 'active' : '' }}">
            <a href="/motorcycles" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cycling"></i>
                <div data-i18n="Analytics">Electric Motorcycles</div>
            </a>
        </li>

       

        <li class="menu-item {{ Request::is('test-drive-booking*') ? 'active' : '' }}">
            <a href="/test-drive-booking" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                <div data-i18n="Test Drive Booking">Test Drive Booking</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('contact*') ? 'active' : '' }}">
            <a href="/contact" class="menu-link position-relative">
                <i class="menu-icon tf-icons bx bx-envelope"></i>

                {{-- @if($unreadMessages > 0)
                    <span class="badge-notif">{{ $unreadMessages }}</span>
                @endif --}}

                <div data-i18n="Contact">Messages</div>
            </a>
        </li>
<style>
    .badge-notif {
    position: absolute;
    top: 2px;
    left: 22px;
    background: red;
    color: white;
    font-size: 10px;
    padding: 2px 5px;
    border-radius: 50%;
    min-width: 16px;
    height: 16px;
    display: flex;
    justify-content: center;
    align-items: center;
}

</style>


        {{-- User --}}
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Hak Akses</span></li>
        <li class="menu-item {{ Request::is('user*') ? 'active' : '' }}">
            <a href="/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-shield-alt-2"></i>
                <div data-i18n="Analytics">Admin</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('user*') ? 'active' : '' }}">
            <a href="/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">User</div>
            </a>
        </li>
    </ul>
</aside>
