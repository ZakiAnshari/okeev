@extends('layout.user')
@section('title', 'Home')
@section('content')
    <!-- Wallpaper Section -->
    <section class="wallpaper-section position-relative ">
        <img src="{{ asset('storage/' . $brand->wallpaper) }}" alt="Wallpaper" class="wallpaper-img">

        {{-- <div class="container">
            <div class="logo-left">
                <img src="{{ asset('front_end/assets/images/logowuling.png') }}" alt="Logo" class="logo-img">
            </div>
        </div> --}}
    </section>

    <!-- Filter Section -->
    <section class="filter-section py-3">
        <div class="container">
            <!-- Filter Toggle Button & Sort -->
            <div class="d-flex justify-content-between align-items-center mb-0 gap-2 flex-wrap">
                <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse"
                    data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                    <i class="bi bi-funnel"></i> Filter Produk
                    @php
                        $activeFilters = 0;
                        if (request('category_id')) {
                            $activeFilters++;
                        }
                        if (request('min_price') || request('max_price')) {
                            $activeFilters++;
                        }
                        if (request('min_km') || request('max_km')) {
                            $activeFilters++;
                        }
                        if (request('min_kwh') || request('max_kwh')) {
                            $activeFilters++;
                        }
                    @endphp
                    @if ($activeFilters > 0)
                        <span class="badge bg-danger ms-2">{{ $activeFilters }}</span>
                    @endif
                </button>

                <!-- Sort Dropdown -->
                <div class="sort-dropdown">
                    <form method="GET" action="{{ route('landing.cars', $brand->slug) }}" class="d-inline">
                        <!-- Preserve existing filters -->
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                        <input type="hidden" name="min_km" value="{{ request('min_km') }}">
                        <input type="hidden" name="max_km" value="{{ request('max_km') }}">
                        <input type="hidden" name="min_kwh" value="{{ request('min_kwh') }}">
                        <input type="hidden" name="max_kwh" value="{{ request('max_kwh') }}">

                        <select class="form-select form-select-sm" name="sort" onchange="this.form.submit()"
                            style="min-width: 220px;">
                            <option value="">Urutkan berdasarkan: Terkait</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                Harga Rendah ke Tinggi
                            </option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                Harga Tinggi ke Rendah
                            </option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                Terbaru
                            </option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Filter Form Collapse -->
            <div class="collapse mt-3" id="filterCollapse">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body">
                        <form method="GET" action="{{ route('landing.cars', $brand->slug) }}" class="row g-3">
                            <!-- Filter Jenis Tipe Mobil -->
                            {{-- <div class="col-lg-3 col-md-6">
                                <label for="category" class="form-label fw-semibold">Tipe</label>
                                <select class="form-select form-select-sm" id="category" name="category_id">
                                    <option value="">-- Semua Tipe --</option>
                                    @foreach ($productCategories as $cat)
                                        @if ($cat->brands && $cat->brands->count() > 0)
                                            <optgroup label="{{ $cat->name_category }}">
                                                @foreach ($cat->brands as $brandItem)
                                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                                        {{ $brandItem->name_brand }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @else
                                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name_category }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div> --}}

                            <!-- Filter Range Harga -->
                            <div class="col-lg-3 col-md-6">
                                <label for="min_price" class="form-label fw-semibold">Harga Minimum</label>
                                <input type="number" class="form-control form-control-sm" id="min_price" name="min_price"
                                    placeholder="0" step="1000000" value="{{ request('min_price') }}">
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label for="max_price" class="form-label fw-semibold">Harga Maksimal</label>
                                <input type="number" class="form-control form-control-sm" id="max_price" name="max_price"
                                    placeholder="999999999" step="1000000" value="{{ request('max_price') }}">
                            </div>

                            <!-- Filter Range KM -->
                            <div class="col-lg-3 col-md-6">
                                <label for="min_km" class="form-label fw-semibold">Jangkauan Minimum (KM)</label>
                                <input type="number" class="form-control form-control-sm" id="min_km" name="min_km"
                                    placeholder="0" step="10" value="{{ request('min_km') }}">
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label for="max_km" class="form-label fw-semibold">Jangkauan Maksimal (KM)</label>
                                <input type="number" class="form-control form-control-sm" id="max_km" name="max_km"
                                    placeholder="1000" step="10" value="{{ request('max_km') }}">
                            </div>

                            <!-- Filter Range kWh -->
                            <div class="col-lg-3 col-md-6">
                                <label for="min_kwh" class="form-label fw-semibold">Kap. Baterai Min (kWh)</label>
                                <input type="number" class="form-control form-control-sm" id="min_kwh" name="min_kwh"
                                    placeholder="0" step="1" value="{{ request('min_kwh') }}">
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label for="max_kwh" class="form-label fw-semibold">Kap. Baterai Max (kWh)</label>
                                <input type="number" class="form-control form-control-sm" id="max_kwh" name="max_kwh"
                                    placeholder="100" step="1" value="{{ request('max_kwh') }}">
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 pt-2">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                                <a href="{{ route('landing.cars', $brand->slug) }}"
                                    class="btn btn-outline-secondary btn-sm ms-2">
                                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($brand->category_position_id == 4)
        <div class="container my-5">
            <div class="row g-3">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm card-hover">
                            <div class="product-img-wrapper position-relative">
                                <span class="badge bg-info position-absolute top-0 start-0 m-2">
                                    {{ $product->brand->name_brand }}
                                </span>

                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                    class="d-block mx-auto img-fluid p-4" style="max-height: 230px; object-fit: contain;"
                                    alt="Thumbnail">
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h6 class="card-title mb-0 me-2 flex-grow-1">
                                        <a href="{{ route('landing.product', $product->slug) }}">
                                            {{ $product->model_name }}
                                        </a>
                                    </h6>

                                    <p class="fw-bold text-danger mb-0">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @endif
    @if ($brand->category_position_id == 1)
        <section>
            <div class="container">
                {{-- <h4 class="mb-4">Motor yang tersedia</h4> --}}
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            @if ($product->category_id == 1)
                                <div class="vehicle-card rounded shadow-sm h-100"
                                    style="border: 1px solid #F1F1F1 !important;">
                                    <!-- Image -->
                                    <div class="vehicle-img-wrapper"
                                        style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%);
                                    border-radius: 4px 4px 0 0;">
                                        <a href="{{ route('landing.product', $product->slug) }}">
                                            <div class="product-images">
                                                @if ($product->images())
                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                        class="d-block mx-auto img-fluid p-4"
                                                        style="max-height: 340px; object-fit: contain;" alt="Thumbnail">
                                                @else
                                                    <img src="{{ asset('path/to/default-image.jpg') }}" alt="No Image"
                                                        class="img-fluid mb-2 vehicle-img w-100 p-4">
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <!-- Detail -->
                                    <div class="card-body p-3 bg-white rounded-bottom">
                                        <h6 class="fw-semibold text-dark mb-0">{{ $product->brand->name_brand }}</h6>
                                        <p class="fw-bold text-secondary small mb-1">{{ $product->model_name }}</p>
                                        <hr>
                                        <!-- Icons -->
                                        <div class="text-center mb-2">

                                            <!-- Row 1 -->
                                            <div class="row mb-2">
                                                <!-- Range -->
                                                <div class="col-4 d-flex flex-column align-items-center">
                                                    <img src="{{ asset('front_end/assets/images/3.png') }}"
                                                        width="22" class="mb-2">
                                                    <p class="small text-black mb-0 fw-semibold">
                                                        {{ $product->miles }} Miles
                                                    </p>
                                                </div>

                                                <!-- Fuel -->
                                                <div class="col-4 d-flex flex-column align-items-center">
                                                    <img src="{{ asset('front_end/assets/images/2.png') }}"
                                                        width="23" class="mb-2">
                                                    <p class="small text-black mb-0 fw-semibold">
                                                        Electric
                                                    </p>
                                                </div>

                                                <!-- Seats -->
                                                <div class="col-4 d-flex flex-column align-items-center">
                                                    <img src="{{ asset('front_end/assets/images/1.png') }}"
                                                        width="21" class="mb-2">
                                                    <p class="small text-black mb-0 fw-semibold">
                                                        {{ $product->seats }} Seat
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- Row 2 -->
                                            <div class="row mt-lg-3">
                                                <!-- Battery -->
                                                <div class="col-4 d-flex flex-column align-items-center">
                                                    <i class="bi bi-battery-full fs-5 mb-1 text-success"></i>
                                                    <p class="small text-black mb-0 fw-semibold">
                                                        {{ $product->battery }} kWh
                                                    </p>
                                                </div>

                                                <!-- Charging -->
                                                <div class="col-4 d-flex flex-column align-items-center">
                                                    <i class="bi bi-ev-station fs-5 mb-1 text-warning"></i>
                                                    <p class="small text-black mb-0 fw-semibold">
                                                        {{ $product->charging }} kW
                                                    </p>
                                                </div>

                                                <!-- Drive Type -->
                                                <div class="col-4 d-flex flex-column align-items-center">
                                                    <i class="bi bi-car-front fs-5 mb-1 text-primary"></i>
                                                    <p class="small text-black mb-0 fw-semibold">
                                                        {{ $product->drive_type }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <!-- Price & Detail Link -->
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <p class="fw-bold text-danger mb-0">
                                                IDR {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                            <a href="{{ route('landing.product', $product->slug) }}"
                                                class="text-decoration-none fw-semibold d-flex align-items-center"
                                                style="color: #30445C !important;">
                                                Detail
                                                <img src="{{ asset('front_end/assets/images/icon.png') }}" width="10"
                                                    class="mb-1 ms-2">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($product->category_id == 2)
                                <div class="vehicle-card rounded shadow-sm h-100"
                                    style="border: 1px solid #F1F1F1 !important;">
                                    <!-- Image -->
                                    <div class="vehicle-img-wrapper"
                                        style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%);
                                    border-radius: 4px 4px 0 0;">
                                        <a href="{{ route('landing.product', $product->slug) }}">
                                            <div class="product-images">
                                                @if ($product->images())
                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                        class="d-block mx-auto img-fluid p-4"
                                                        style="max-height: 340px; object-fit: contain;" alt="Thumbnail">
                                                @else
                                                    <img src="{{ asset('path/to/default-image.jpg') }}" alt="No Image"
                                                        class="img-fluid mb-2 vehicle-img w-100 p-4">
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <!-- Detail -->
                                    <div class="card-body p-3 bg-white rounded-bottom">
                                        <h6 class="fw-semibold text-dark mb-0">{{ $product->brand->name_brand }}</h6>
                                        <p class="fw-bold text-secondary small mb-1">{{ $product->model_name }}</p>
                                        <hr>
                                        <!-- Icons -->
                                        <div class="text-center mb-2">

                                            <!-- Row 1 -->
                                            <div class="row mb-2">
                                                <!-- Range -->
                                                <div class="col-6 d-flex flex-column align-items-center">
                                                    <img src="{{ asset('front_end/assets/images/3.png') }}"
                                                        width="22" class="mb-2">
                                                    <p class="small text-black mb-0 fw-semibold">
                                                        {{ $product->miles }} Miles
                                                    </p>
                                                </div>

                                                <!-- Fuel -->
                                                <div class="col-6 d-flex flex-column align-items-center">
                                                    <img src="{{ asset('front_end/assets/images/2.png') }}"
                                                        width="23" class="mb-2">
                                                    <p class="small text-black mb-0 fw-semibold">
                                                        Electric
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <hr class="my-2">
                                        <!-- Price & Detail Link -->
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <p class="fw-bold text-danger mb-0">
                                                IDR {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                            <a href="{{ route('landing.product', $product->slug) }}"
                                                class="text-decoration-none fw-semibold d-flex align-items-center"
                                                style="color: #30445C !important;">
                                                Detail
                                                <img src="{{ asset('front_end/assets/images/icon.png') }}" width="10"
                                                    class="mb-1 ms-2">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-center">Tidak ada produk untuk brand ini.</p>
                    @endforelse
                    <br><br>
                </div>
            </div>
        </section>
    @endif




@endsection
