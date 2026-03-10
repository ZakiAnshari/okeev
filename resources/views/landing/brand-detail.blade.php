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
                </button>

                <!-- Sort Dropdown -->
                <div class="sort-dropdown">
                    <form method="GET" action="{{ route('landing.cars', $brand->slug) }}" class="d-inline">
                        <!-- Preserve existing filters -->
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                        <input type="hidden" name="price" value="{{ request('price') }}">
                        <input type="hidden" name="battery" value="{{ request('battery') }}">
                        <input type="hidden" name="charging" value="{{ request('charging') }}">
                        <input type="hidden" name="drive_type" value="{{ request('drive_type') }}">
                        <input type="hidden" name="seats" value="{{ request('seats') }}">
                        <input type="hidden" name="miles" value="{{ request('miles') }}">

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


                            <!-- Filter Harga -->
                            <div class="col-lg-3 col-md-6">
                                <label for="price" class="form-label fw-semibold">Harga</label>
                                <input type="text" class="form-control form-control-sm" id="price" name="price"
                                    placeholder="0" value="{{ request('price') }}" inputmode="numeric"
                                    oninput="formatRupiah(this)">
                            </div>
                            <script>
                                function formatRupiah(input) {
                                    let angka = input.value.replace(/[^,\d]/g, '').toString();
                                    let split = angka.split(',');
                                    let sisa = split[0].length % 3;
                                    let rupiah = split[0].substr(0, sisa);
                                    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                    if (ribuan) {
                                        let separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }

                                    input.value = rupiah;
                                }
                            </script>

                            <!-- Filter Baterai (kWh) -->
                            <div class="col-lg-3 col-md-6">
                                <label for="battery" class="form-label fw-semibold">Baterai (kWh)</label>
                                <input type="number" class="form-control form-control-sm" id="battery" name="battery"
                                    placeholder="Cari berdasarkan kWh" step="1" value="{{ request('battery') }}">
                            </div>

                            <!-- Filter Charging (kW) -->
                            <div class="col-lg-3 col-md-6">
                                <label for="charging" class="form-label fw-semibold">Charging (kW)</label>
                                <input type="number" class="form-control form-control-sm" id="charging" name="charging"
                                    placeholder="Cari berdasarkan kW" step="1" value="{{ request('charging') }}">
                            </div>

                            <!-- Filter Drive Type -->
                            <div class="col-lg-3 col-md-6">
                                <label for="drive_type" class="form-label fw-semibold">Jenis Drive</label>
                                <select name="drive_type" id="drive_type" class="form-control form-control-sm">
                                    <option value="">-- Semua Drive Type --</option>
                                    <option value="FWD" {{ request('drive_type') == 'FWD' ? 'selected' : '' }}>
                                        FWD (Front-Wheel Drive)
                                    </option>
                                    <option value="RWD" {{ request('drive_type') == 'RWD' ? 'selected' : '' }}>
                                        RWD (Rear-Wheel Drive)
                                    </option>
                                    <option value="AWD" {{ request('drive_type') == 'AWD' ? 'selected' : '' }}>
                                        AWD (All-Wheel Drive)
                                    </option>
                                    <option value="Dual Motor"
                                        {{ request('drive_type') == 'Dual Motor' ? 'selected' : '' }}>
                                        Dual Motor Performance
                                    </option>
                                </select>
                            </div>

                            <!-- Filter Seats -->
                            <div class="col-lg-3 col-md-6">
                                <label for="seats" class="form-label fw-semibold">Jumlah Kursi</label>
                                <input type="number" class="form-control form-control-sm" id="seats" name="seats"
                                    placeholder="Cari berdasarkan kursi" step="1" value="{{ request('seats') }}">
                            </div>

                            <!-- Filter Miles -->
                            <div class="col-lg-3 col-md-6">
                                <label for="miles" class="form-label fw-semibold">Miles (Jarak Tempuh)</label>
                                <input type="number" class="form-control form-control-sm" id="miles" name="miles"
                                    placeholder="Cari berdasarkan miles" step="1" value="{{ request('miles') }}">
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 pt-2">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                                <a href="{{ route('landing.cars', $brand->slug) }}"
                                    class="btn btn-outline-secondary btn-sm ms-2">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
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

<script>
    // Format harga dengan separator titik
    const priceInput = document.getElementById('price');

    if (priceInput) {
        // Format initial value jika ada
        if (priceInput.value) {
            const cleanValue = priceInput.value.replace(/\D/g, '');
            priceInput.value = parseInt(cleanValue).toLocaleString('id-ID');
        }

        // Format ketika user mengetik
        priceInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // Hapus semua non-digit
            if (value) {
                // Simpan cursor position
                const cursorPos = this.selectionStart;
                this.value = parseInt(value).toLocaleString('id-ID');
            } else {
                this.value = '';
            }
        });

        // Hapus format sebelum submit
        const filterForm = priceInput.closest('form');
        if (filterForm) {
            filterForm.addEventListener('submit', function(e) {
                priceInput.value = priceInput.value.replace(/\D/g, '');
            });
        }
    }
</script>
