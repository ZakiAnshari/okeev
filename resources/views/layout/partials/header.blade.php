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
                                @php
                                    use App\Models\Category;

                                    if (!isset($categoriesPosition1)) {
                                        $categoriesPosition1 = Category::with('brands')
                                            ->where('category_position_id', 1)
                                            ->orderBy('name_category', 'asc')
                                            ->get();
                                    }

                                    if (!isset($categoriesPosition2)) {
                                        $categoriesPosition2 = Category::with('brands')
                                            ->where('category_position_id', 2)
                                            ->orderBy('name_category', 'asc')
                                            ->get();
                                    }

                                    if (!isset($categoriesPosition3)) {
                                        $categoriesPosition3 = Category::with('brands')
                                            ->whereIn('category_position_id', [3, 4])
                                            ->orderBy('name_category', 'asc')
                                            ->get();
                                    }

                                    $vehicleSlugs = collect($categoriesPosition1)
                                        ->flatMap(function ($cat) {
                                            return $cat->brands ?? collect();
                                        })
                                        ->pluck('slug')
                                        ->toArray();
                                @endphp
                                <li
                                    class="nav-item dropdown position-static 
                                    {{ in_array(request()->route('slug'), $vehicleSlugs) ? 'active' : '' }}">

                                    <a class="dd-menu collapsed" href="#" id="megaVehicle" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Vehicle
                                        {{-- <i class='mx-1 bx bx-chevron-down'></i> --}}
                                    </a>


                                    <div class="dropdown-menu nv-vehicle-dropdown" aria-labelledby="megaVehicle">
                                        <div class="nv-vehicle-clip">
                                            <div class="nv-vehicle-scroll">
                                                @forelse ($categoriesPosition1 as $category)
                                                    <div class="nv-vehicle-category with-divider">
                                                        <h6 class="nv-vehicle-title">
                                                            {{ $category->name_category }}
                                                        </h6>

                                                        <div class="nv-vehicle-brand-grid">
                                                            @foreach ($category->brands->chunk(4) as $chunk)
                                                                <ul class="nv-vehicle-brand-col">
                                                                    @foreach ($chunk as $brand)
                                                                        <li>
                                                                            <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                                class="dropdown-item nv-vehicle-brand-item">
                                                                                {{ $brand->name_brand }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                @empty
                                                    <div class="nv-vehicle-empty">
                                                        <p class="text-muted mb-0">Kategori Vehicle belum tersedia.</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                @php
                                    $electricSlugs = $categoriesPosition2
                                        ->flatMap(fn($cat) => $cat->brands)
                                        ->pluck('slug')
                                        ->toArray();
                                @endphp
                                {{-- <li
                                    class="nav-item dropdown position-static
                                    {{ in_array(request()->route('slug'), $electricSlugs) ? 'active' : '' }}">

                                    <a class="dd-menu collapsed" href="#" id="megaElectric" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Electric
                                      
                                    </a>

                                    <div class="dropdown-menu nv-vehicle-dropdown" aria-labelledby="megaElectric">
                                        <div class="nv-vehicle-clip">
                                            <div class="nv-vehicle-scroll">

                                                @forelse ($categoriesPosition2 as $category)
                                                    <div class="nv-vehicle-category with-divider">
                                                        <h6 class="nv-vehicle-title">
                                                            {{ $category->name_category }}
                                                        </h6>

                                                        <div class="nv-vehicle-brand-grid">
                                                            @foreach ($category->brands->chunk(4) as $chunk)
                                                                <ul class="nv-vehicle-brand-col">
                                                                    @foreach ($chunk as $brand)
                                                                        <li>
                                                                            <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                                class="dropdown-item nv-vehicle-brand-item">
                                                                                {{ $brand->name_brand }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="nv-vehicle-empty">
                                                        <p class="text-muted mb-0">Electric belum tersedia.</p>
                                                    </div>
                                                @endforelse

                                            </div>
                                        </div>
                                    </div>
                                </li> --}}

                                <li
                                    class="nav-item dropdown position-static
                                    {{ request()->routeIs('landing.accessories*') ? 'active' : '' }}">

                                    <a class="dd-menu collapsed" href="#" id="megaAccessories" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Accessories
                                        {{-- <i class='mx-1 bx bx-chevron-down'></i> --}}
                                    </a>

                                    <div class="dropdown-menu nv-vehicle-dropdown" aria-labelledby="megaAccessories">
                                        <div class="nv-vehicle-clip">
                                            <div class="nv-vehicle-scroll">

                                                @forelse ($categoriesPosition3 as $category)
                                                    <div class="nv-vehicle-category with-divider">
                                                        <h6 class="nv-vehicle-title">
                                                            {{ $category->name_category }}
                                                        </h6>

                                                        <div class="nv-vehicle-brand-grid">
                                                            @foreach ($category->brands->chunk(4) as $chunk)
                                                                <ul class="nv-vehicle-brand-col">
                                                                    @foreach ($chunk as $brand)
                                                                        <li>
                                                                            <a href="{{ route('landing.cars', $brand->slug) }}"
                                                                                class="dropdown-item nv-vehicle-brand-item">
                                                                                {{ $brand->name_brand }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="nv-vehicle-empty">
                                                        <p class="text-muted mb-0">Accessories belum tersedia.</p>
                                                    </div>
                                                @endforelse

                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                                    <a href="/about">About</a>
                                </li>

                                <li class="nav-item {{ request()->is('News') ? 'active' : '' }}">
                                    <a href="/News">News</a>
                                </li>

                                <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                                    <a href="/contact">Contact</a>
                                </li>


                            </ul>
                            <div class="button add-list-button">
                                <div class="button-group">
                                    @guest
                                        <a href="/login" class="btn-login">
                                            <i class="bx bx-user me-2"></i> Login
                                        </a>
                                    @endguest

                                    {{-- <a href="#" class="btn-download">
                                                Download App   <i class="bx bx-download me-2 fs-4"></i>
                                            </a> --}}
                                </div>
                            </div>
                            {{-- SUDAH LOGIN --}}
                            <div class="topbar-wrapper">
                                @auth
                                    @php
                                        $notifOrders = [];
                                        $notifTestdrives = collect();
                                        $notifCount = 0;
                                        $ordersCount = 0;
                                        if (\Illuminate\Support\Facades\Auth::check()) {
                                            $notifOrders = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                // show recent orders that are not cancelled; include Completed so successful payments remain visible
                                                ->where(function($q) {
                                                    $q->whereIn('status', ['PENDING', 'Failed', 'Completed'])
                                                      ->orWhereIn('status_transaksi', ['PENDING', 'Failed', 'Completed']);
                                                })
                                                ->whereRaw("LOWER(COALESCE(status,'')) != 'cancelled'")
                                                ->whereRaw("LOWER(COALESCE(status_transaksi,'')) != 'cancelled'")
                                                ->with(['product.brand'])
                                                ->orderBy('created_at', 'desc')
                                                ->take(5)
                                                ->get();

                                            // Include recent Testdrive entries but only for the logged-in user
                                            $user = \Illuminate\Support\Facades\Auth::user();
                                            $notifTestdrivesQuery = \App\Models\Testdrive::query();
                                            if ($user) {
                                                $notifTestdrivesQuery->where(function ($q) use ($user) {
                                                    if (!empty($user->email)) {
                                                        $q->where('email', $user->email);
                                                    }
                                                    if (!empty($user->contact)) {
                                                        $q->orWhere('telp', $user->contact);
                                                    }
                                                });
                                            } else {
                                                // not authenticated -> no testdrive notifications
                                                $notifTestdrivesQuery->whereRaw('0 = 1');
                                            }

                                            $notifTestdrives = $notifTestdrivesQuery->latest()->take(5)->get();

                                            $notifCount = $notifOrders->count() + $notifTestdrives->count();

                                            // Total transactions/orders for this user (exclude cancelled)
                                            $ordersCount = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                ->whereRaw("LOWER(COALESCE(status,'')) != 'cancelled'")
                                                ->whereRaw("LOWER(COALESCE(status_transaksi,'')) != 'cancelled'")
                                                ->count();
                                        }
                                    @endphp

                                    <!-- Search -->
                                    <form action="{{ route('search.results') }}" method="get" class="search-box d-flex align-items-center" style="gap:8px;">
                                        <i class="bx bx-search"></i>
                                        <input style="background-color: #f5f5f7;" type="text" name="q" placeholder="Search" value="{{ request('q') }}" class="form-control" />
                                    </form>
                                    <!-- Icon Buttons -->
                                    <div class="icon-box">
                                        <a href="{{ route('cart') }}" class="icon-btn position-relative">
                                            <i class="bx bx-shopping-bag fs-3"></i>
                                            <span id="cartDot"
                                                class="position-absolute top-0 start-100 translate-middle bg-danger rounded-circle"
                                                style="width:10px;height:10px; display: {{ $cartCount > 0 ? 'inline-block' : 'none' }};">
                                            </span>
                                        </a>
                                        <a href="#" id="notifBtn" class="icon-btn position-relative">
                                            <i class="bx bx-bell fs-4"></i>
                                            @if ($notifCount > 0)
                                                <span class="badge bg-danger position-absolute top-0 end-0"
                                                    style="font-size:10px; min-width:18px; height:18px; border-radius:9px; display:flex; align-items:center; justify-content:center;">
                                                    {{ $notifCount }}
                                                </span>
                                            @endif
                                        </a>

                                        <div id="notifModal" class="notif-modal">

                                            <div class="notif-tabs">
                                                <div class="tab active" data-target="notifContent">
                                                    Notification <span class="dot">{{ $notifCount }}</span>
                                                </div>
                                                <div class="tab" data-target="transContent">
                                                    Transaction <span class="dot">{{ $ordersCount }}</span>
                                                </div>
                                            </div>

                                            <div class="notif-content show" id="notifContent">
                                                @if ($notifCount === 0)
                                                    <div class="p-3 text-center text-muted">Tidak ada notifikasi.</div>
                                                @else
                                                    @foreach ($notifOrders as $n)
                                                        <a href="{{ route('payment.va', $n->id) }}"
                                                            class="text-decoration-none text-body" data-order-id="{{ $n->id }}">
                                                            <div class="item">
                                                                @php
                                                                    $iconClass = 'bg-danger';
                                                                    $iconName = 'bx-dollar-circle';
                                                                    if (strtolower($n->status) === 'pending') {
                                                                        $iconClass = 'bg-warning';
                                                                    } elseif (
                                                                        strtolower($n->status) === 'completed' ||
                                                                        strtolower($n->status) === 'paid'
                                                                    ) {
                                                                        $iconClass = 'bg-success';
                                                                        $iconName = 'bx-check-circle';
                                                                    }
                                                                @endphp

                                                                <div class="icon {{ $iconClass }}">
                                                                    <i class="bx {{ $iconName }}"></i>
                                                                </div>
                                                                <div>
                                                                    @php
                                                                        $notifLabel = 'ORDER';
                                                                        $st = strtolower($n->status_transaksi ?? $n->status ?? '');
                                                                        if ($st === 'being_sent') {
                                                                            $notifLabel = 'BEING SENT';
                                                                        } elseif ($st === 'processing') {
                                                                            $notifLabel = 'PROCESS';
                                                                        } elseif ($st === 'to_the_location') {
                                                                            $notifLabel = 'Location';
                                                                        } elseif (in_array($st, ['completed', 'paid'])) {
                                                                            $notifLabel = 'ORDER';
                                                                        }
                                                                    @endphp
                                                                    <div class="title">
                                                                        {{ $notifLabel }}
                                                                        <span>{{ $n->created_at->diffForHumans() }}</span>
                                                                    </div>

                                                                    <p>
                                                                        {{ Str::limit('Pesanan ' . $n->model_name . ' - ' . $n->qty . ' item. Total Rp ' . number_format($n->grand_total, 0, ',', '.'), 90) }}
                                                                    </p>
                                                                    <a
                                                                        href="{{ route('payment.va', $n->id) }}">Details...</a>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <hr>
                                                    @endforeach

                                                    {{-- Render recent Test Drive notifications dynamically --}}
                                                    @foreach ($notifTestdrives as $t)
                                                        <div class="item">
                                                            <div class="icon bg-info">
                                                                <i class="bx bx-car"></i>
                                                            </div>
                                                            <div>
                                                                <div class="title">
                                                                    TEST DRIVE
                                                                    <span>{{ optional($t->created_at)->diffForHumans() }}</span>
                                                                </div>
                                                                <p>
                                                                    {{ Str::limit(($t->first_name ?? 'User') . ' requested a test drive' . (optional($t->product)->model_name ? ' - ' . optional($t->product)->model_name : ''), 90) }}
                                                                </p>

                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @endforeach
                                                @endif

                                            </div>

                                            <div class="notif-content" id="transContent">

                                                <!-- PURCHASE TITLE -->
                                                <div class="trans-title">Purchase</div>

                                                <!-- STEPS -->
                                                @php
                                                    $userOrdersForCounts = \App\Models\Order::where('user_id', auth()->id() ?? 0)->get();
                                                    $statusCounts = $userOrdersForCounts->groupBy(function ($o) {
                                                        return strtolower($o->status_transaksi ?? $o->status ?? 'unknown');
                                                    })->map->count()->toArray();
                                                @endphp
                                                <div class="trans-steps">
                                                    <div class="step active" data-status="pending">
                                                        <div class="step-icon">
                                                            <i class="bx bx-time"></i>
                                                            @if(($statusCounts['pending'] ?? 0) > 0)
                                                                <span class="step-dot">{{ $statusCounts['pending'] }}</span>
                                                            @endif
                                                        </div>
                                                        <span>Waiting for<br>Confirmation</span>
                                                    </div>

                                                    <div class="step" data-status="processing">
                                                        <div class="step-icon">
                                                            <i class="bx bx-refresh"></i>
                                                            @if(($statusCounts['processing'] ?? 0) > 0)
                                                                <span class="step-dot">{{ $statusCounts['processing'] }}</span>
                                                            @endif
                                                        </div>
                                                        <span>Process</span>
                                                    </div>

                                                    <div class="step" data-status="being_sent">
                                                        <div class="step-icon">
                                                            <i class="bx bxs-truck"></i>
                                                            @if(($statusCounts['being_sent'] ?? 0) > 0)
                                                                <span class="step-dot">{{ $statusCounts['being_sent'] }}</span>
                                                            @endif
                                                        </div>
                                                        <span>Being<br>sent</span>
                                                    </div>


                                                    <div class="step" data-status="to_the_location">
                                                        <div class="step-icon">
                                                            <i class="bx bx-map"></i>
                                                            @if(($statusCounts['to_the_location'] ?? 0) > 0)
                                                                <span class="step-dot">{{ $statusCounts['to_the_location'] }}</span>
                                                            @endif
                                                        </div>
                                                        <span>to the<br>Location</span>
                                                    </div>

                                                </div>

                                                <hr>

                                                <!-- STATUS TITLE -->
                                                <div id="transStatusTitle" class="trans-status-title">Waiting For Confirmation</div>

                                                <!-- CARD -->
                                                @php
                                                    $orders = \App\Models\Order::where('user_id', auth()->id())
                                                        ->whereRaw("LOWER(COALESCE(status,'')) != 'cancelled'")
                                                        ->whereRaw("LOWER(COALESCE(status_transaksi,'')) != 'cancelled'")
                                                        ->latest()
                                                        ->get();
                                                @endphp

                                                <div id="transCardsContainer">
                                                @foreach ($orders as $item)
                                                    @php
                                                        $ts = strtolower($item->status_transaksi ?? $item->status ?? '');
                                                    @endphp
                                                    <a href="{{ route('payment.va', $item->id) }}" class="w-100 trans-card-link" data-status="{{ $ts }}" data-order-id="{{ $item->id }}">
                                                        <div class="trans-card mb-3" data-status="{{ $ts }}">
                                                            @if ($item->product && $item->product->colors->isNotEmpty() && $item->product->colors->first()->image)
                                                                <img src="{{ asset('storage/' . $item->product->colors->first()->image) }}"
                                                                    class="img-fluid car-preview" alt="Car"
                                                                    style="max-height: 320px; width: auto;">
                                                            @else
                                                                <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                                    class="img-fluid car-preview" alt="Thumbnail"
                                                                    style="max-height: 395px; object-fit: contain;">
                                                            @endif

                                                            <div class="trans-card-body">
                                                                <div class="trans-card-top">
                                                                    <span class="status">
                                                                        {{ ucfirst(strtolower($item->status)) }}
                                                                    </span>

                                                                    @if ($item->status !== 'Completed')
                                                                        <span class="time countdown"
                                                                            data-created="{{ $item->created_at->timestamp }}"
                                                                            data-duration="86400">
                                                                            --
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="product">
                                                                    {{ $item->model_name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                                </div>

                                            </div>


                                        </div>


                                        <!-- PROFILE -->
                                        <a href="{{ route('profil.show', optional(Auth::user())->slug ?? 'guest') }}"
                                            class="profile-box">
                                            <img src="{{ Auth::user() && Auth::user()->image_provile
                                                ? asset('storage/' . Auth::user()->image_provile)
                                                : asset('front_end/assets/images/Group 21.png') }}"
                                                class="header-profile-img" alt="Profile">
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

<style>
    .nv-vehicle-category {
        position: relative;
        padding-right: 20px;
        /* ruang untuk garis */
    }

    .nav-item.active>a {
        color: #35F5C6 !important;
    }

    .nv-vehicle-category::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 1px;
        /* ketebalan garis */
        height: 100%;
        background-color: #e0e0e0;
        /* warna garis */
    }

    .nv-vehicle-category:last-child::after {
        display: none;
    }

    .nv-vehicle-category::after {
        content: "";
        position: absolute;
        right: 0;

        top: 30px;
        /* 🔽 garis diturunkan */
        height: calc(100% - 36px);
        /* tinggi menyesuaikan */

        width: 1px;
        background-color: #e0e0e0;
    }

    .nv-vehicle-dropdown {
        width: 100%;
        padding: 50px;
        background-color: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(2px);
        border-radius: 2px;
        border: none;
    }

    /* Horizontal scroll container */
    .nv-vehicle-dropdown .nv-vehicle-scroll {
        display: flex;
        flex-wrap: nowrap;
        gap: 80px;
        overflow-x: auto;
        overflow-y: hidden;
        padding-bottom: 10px;
        scroll-behavior: smooth;
    }

    /* Scrollbar (optional) */
    .nv-vehicle-dropdown .nv-vehicle-scroll::-webkit-scrollbar {
        height: 6px;
    }

    .nv-vehicle-dropdown .nv-vehicle-scroll::-webkit-scrollbar-thumb {
        background: #d0d0d0;
        border-radius: 10px;
    }

    /* Category box */
    .nv-vehicle-dropdown .nv-vehicle-category {
        flex: 0 0 420px;

        /* padding: 20px 24px; */
        border-radius: 12px;

    }

    /* Category title */
    .nv-vehicle-dropdown .nv-vehicle-title {
        font-weight: 600;
        margin-bottom: 16px;
    }

    /* Brand grid */
    .nv-vehicle-dropdown .nv-vehicle-brand-grid {
        display: flex;
        gap: 24px;
    }

    /* Brand column */
    .nv-vehicle-dropdown .nv-vehicle-brand-col {
        list-style: none;
        padding: 0;
        margin: 0;
        min-width: 140px;
    }

    /* Brand item */
    .nv-vehicle-dropdown .nv-vehicle-brand-item {
        padding: 4px 0;
        font-weight: 400;
        color: #333;
        background: transparent;
    }

    .nv-vehicle-dropdown .nv-vehicle-brand-item:hover {
        color: #0d6efd;
        background: transparent;
    }

    /* Empty state */
    .nv-vehicle-dropdown .nv-vehicle-empty {
        width: 100%;
        text-align: center;
        padding: 32px;
    }

    .order-link {
        display: flex;
        justify-content: flex-end;
        /* 👉 mentok kanan */
        text-decoration: none;
    }

    .profile-box {
        display: flex;
        align-items: center;
    }

    .header-profile-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
        border: 2px solid #eee;
        transition: transform .2s ease, box-shadow .2s ease;
    }



    /* TRANSACTION TITLE */
    .trans-title {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 14px;
    }

    /* STEPS */
    .trans-steps {
        display: flex;
        justify-content: space-between;
        text-align: center;
        margin-bottom: 14px;
    }

    .step {
        font-size: 11px;
        color: #9aa5b1;
        width: 25%;
    }

    .step-icon {
        position: relative;
        width: 38px;
        height: 38px;
        margin: 0 auto 6px;
        border-radius: 50%;
        background: #f1f3f5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9aa5b1;
        font-size: 18px;
    }

    .step.active .step-icon {
        background: #e9fff7;
        color: #1dd1a1;
    }

    .step-dot {
        position: absolute;
        top: -3px;
        right: -3px;
        background: #ff3b30;
        color: #fff;
        font-size: 9px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step.active span {
        color: #1dd1a1;
        font-weight: 500;
    }

    /* STATUS TITLE */
    .trans-status-title {
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    /* CARD */
    .trans-card {
        display: flex;
        gap: 12px;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 10px;
        background: #fff;
    }

    .trans-card img {
        width: 70px;
        height: 45px;
        object-fit: cover;
        border-radius: 6px;
        background: #f5f5f5;
    }

    .trans-card-body {
        flex: 1;
    }

    .trans-card-top {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .status {
        color: #6c757d;
    }

    .time {
        color: #1dd1a1;
    }

    .product {
        font-size: 13px;
        font-weight: 500;
        color: #1dd1a1;
    }

    /* ICON CONTAINER – BULAT SEMPURNA */
    .icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        min-height: 44px;
        border-radius: 50%;
        background: #e9fff7;
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
    }

    /* ICON DI DALAM – CENTER & PROPORSIONAL */
    .icon i {
        font-size: 20px;
        line-height: 1;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1dd1a1;
    }

    /* HILANGKAN PENGARUH BG BOOTSTRAP */
    .bg-success,
    .bg-info {
        background: transparent !important;
    }

    /* CONTAINER */
    .notif-modal {
        position: absolute;
        top: 75px;
        right: 20px;
        width: 360px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .12);
        border: 1px solid #eee;
        font-family: 'Inter', sans-serif;
        z-index: 9999;
    }

    /* TABS HEADER */
    .notif-tabs {
        display: flex;
        border-bottom: 1px solid #eee;
    }

    .notif-tabs .tab {
        flex: 1;
        padding: 14px 0;
        text-align: center;
        font-size: 14px;
        font-weight: 500;
        color: #b5b5b5;
        cursor: pointer;
        position: relative;
    }

    .notif-tabs .tab.active {
        color: #1dd1a1;
    }

    .notif-tabs .tab.active::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 25%;
        width: 50%;
        height: 2px;
        background: #1dd1a1;
        border-radius: 10px;
    }

    /* RED BADGE */
    .dot {
        position: absolute;
        top: 8px;
        right: 35%;
        background: #ff3b30;
        color: #fff;
        font-size: 10px;
        padding: 1px 5px;
        border-radius: 50%;
    }

    /* CONTENT */
    .notif-content {
        display: none;
        padding: 14px 16px;
        max-height: 360px;
        /* limit height when many items */
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }

    .notif-content.show {
        display: block;
    }

    /* ITEM */
    .item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    /* ICON BULAT */
    .icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        background: #e8fff8;
        color: #1dd1a1;
    }

    .bg-success,
    .bg-info {
        background: #e8fff8 !important;
        color: #1dd1a1 !important;
    }

    /* TITLE */
    .title {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
    }

    .title span {
        font-size: 13px;
        font-weight: 500;
        color: #1dd1a1;
    }

    /* DESC */
    .item p {
        font-size: 13px;
        line-height: 1.5;
        color: #8a8a8a;
        margin: 6px 0 4px;
    }

    /* LINK */
    .item a {
        font-size: 13px;
        color: #1dd1a1;
        text-decoration: none;
    }

    /* HR */
    .notif-content hr {
        border: none;
        border-top: 1px solid #302d2d;
        margin: 14px 0;
    }

    /* EMPTY */
    .empty {
        text-align: center;
        padding: 30px 0;
        color: #aaa;
        font-size: 14px;
    }
</style>


<script>
    function nvVehicleScroll(direction) {
        const container = document.querySelector('.nv-vehicle-dropdown .nv-vehicle-scroll');
        if (!container) return;

        container.scrollBy({
            left: direction * 450,
            behavior: 'smooth'
        });
    }
</script>































<script>
    document.addEventListener('DOMContentLoaded', function() {

        const btn = document.getElementById('notifBtn');
        const modal = document.getElementById('notifModal');

        // 🔥 PAKSA SEMBUNYI SAAT PAGE LOAD / REFRESH
        modal.style.display = 'none';

        // toggle popup
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        });

        // klik luar nutup
        document.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // biar klik di dalam modal nggak nutup
        modal.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // tab switch
        document.querySelectorAll('.notif-tabs .tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.notif-tabs .tab').forEach(t => t.classList.remove(
                    'active'));
                document.querySelectorAll('.notif-content').forEach(c => c.classList.remove(
                    'show'));

                tab.classList.add('active');
                document.getElementById(tab.dataset.target).classList.add('show');
            });
        });

        // Transaction steps filtering (show trans-cards by status_transaksi)
        const steps = document.querySelectorAll('.trans-steps .step');
        const cardsContainer = document.getElementById('transCardsContainer');
        const cards = cardsContainer ? cardsContainer.querySelectorAll('.trans-card') : [];
        const statusTitle = document.getElementById('transStatusTitle');

        function statusLabelFromKey(key) {
            const map = {
                'pending': 'Waiting For Confirmation',
                'new': 'Waiting For Confirmation',
                'processing': 'Process',
                'being_sent': 'Being sent',
                'to_the_location': 'To the Location'
            };
            return map[key] || 'Transactions';
        }

        function filterByStatus(status) {
            if (!cardsContainer) return;
            let shown = 0;
            cards.forEach(c => {
                const s = (c.dataset.status || '').toLowerCase();
                if (!status || status === 'all' || s === status) {
                    c.parentElement.style.display = ''; // anchor wrapper
                    shown++;
                } else {
                    c.parentElement.style.display = 'none';
                }
            });

            statusTitle.textContent = statusLabelFromKey(status);
            if (shown === 0) {
                // show empty message
                if (!document.getElementById('transEmpty')) {
                    const empty = document.createElement('div');
                    empty.id = 'transEmpty';
                    empty.className = 'empty';
                    empty.textContent = 'Tidak ada transaksi untuk status ini.';
                    cardsContainer.appendChild(empty);
                }
            } else {
                const ex = document.getElementById('transEmpty');
                if (ex) ex.remove();
            }
        }

        steps.forEach(step => {
            step.addEventListener('click', function () {
                steps.forEach(s => s.classList.remove('active'));
                this.classList.add('active');
                const status = this.dataset.status || 'all';
                filterByStatus(status);
            });
        });

        // apply initial filter from the active step
        const activeStep = document.querySelector('.trans-steps .step.active');
        if (activeStep) {
            filterByStatus(activeStep.dataset.status || 'all');
        }

    });
</script>


{{-- script untuk hitngangan mundur pembayaran notifikasi --}}
<script>
    function startCountdown() {
        document.querySelectorAll('.countdown').forEach(el => {
            const createdAt = parseInt(el.dataset.created) * 1000;
            const duration = parseInt(el.dataset.duration) * 1000;
            const endTime = createdAt + duration;

            function update() {
                const now = Date.now();
                const diff = endTime - now;

                if (diff <= 0) {
                    el.innerText = 'Expired';
                    el.classList.add('text-danger');
                    return;
                }

                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff / (1000 * 60)) % 60);
                const seconds = Math.floor((diff / 1000) % 60);

                el.innerText =
                    `${hours.toString().padStart(2, '0')}:` +
                    `${minutes.toString().padStart(2, '0')}:` +
                    `${seconds.toString().padStart(2, '0')}`;
            }

            update();
            setInterval(update, 1000);
        });
    }

    document.addEventListener('DOMContentLoaded', startCountdown);
</script>
