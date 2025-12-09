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

    @if (in_array($brand->category_id, [3, 4]))
        <div class="container my-4">
            <div class="d-flex gap-3 mb-4">

                <button type="button" class="btn btn-primary rounded-3 px-4 py-2 filter-btn" data-category="3">
                    Laptop
                </button>

                <button type="button" class="btn btn-primary rounded-3 px-4 py-2 filter-btn" data-category="4">
                    Handphone
                </button>

            </div>
            <style>
                .filter-btn {
                    background-color: #30445C;
                    border-color: #30445C;
                    color: white;
                    opacity: 0.6;
                    /* tombol default tampak tidak aktif */
                }

                .filter-btn.active {
                    opacity: 1;
                    background-color: #1f2f43;
                    /* warna aktif */
                    border-color: #1f2f43;
                }
            </style>

            <script>
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                    });
                });
            </script>

            <div class="row g-3" id="product-container">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 product-item" data-category="{{ $product->category_id }}">
                        <div class="card h-100 shadow-sm card-hover">
                            <div class="product-img-wrapper position-relative">
                                <span class="badge bg-info position-absolute top-0 start-0 m-2">
                                    {{ $product->brand->name_brand }}
                                </span>
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}" class="product-img"
                                    alt="Product Image">
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h6 class="card-title mb-0 me-2" style="flex: 1 1 auto;">
                                        <a href="{{ route('landing.product', $product->slug) }}">
                                            {{ $product->model_name }}
                                        </a>
                                    </h6>
                                    <p class="fw-bold text-danger mb-0 flex-shrink-0">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <script>
                const buttons = document.querySelectorAll('.filter-btn');
                const products = document.querySelectorAll('.product-item');

                // Fungsi filter
                function filterProducts(category) {
                    products.forEach(item => {
                        if (parseInt(item.dataset.category) === parseInt(category)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Highlight tombol aktif
                    buttons.forEach(btn => btn.classList.remove('btn-dark'));
                    buttons.forEach(btn => btn.classList.add('btn-outline-secondary'));
                    buttons.forEach(btn => {
                        if (parseInt(btn.dataset.category) === parseInt(category)) {
                            btn.classList.add('btn-dark');
                            btn.classList.remove('btn-outline-secondary');
                        }
                    });
                }

                // Inisialisasi awal: tampilkan category_id 3
                filterProducts(3);

                // Event listener tombol
                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        const category = button.dataset.category;
                        filterProducts(category);
                    });
                });
            </script>
        </div>
    @else
        <section>
            <div class="container">
                {{-- <h4 class="mb-4">Motor yang tersedia</h4> --}}
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            @if (in_array($product->category_id, [1, 2]))
                                <div class="vehicle-card rounded shadow-sm h-100"
                                    style="border: 1px solid #F1F1F1 !important;">
                                    <!-- Image -->
                                    <div class="vehicle-img-wrapper"
                                        style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%);
                                    border-radius: 4px 4px 0 0;">

                                        <div class="product-images">
                                            @if ($product->images->first())
                                                <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                                    alt="{{ $product->model_name }}"
                                                    class="img-fluid mb-2 vehicle-img w-100 p-4">
                                            @else
                                                <img src="{{ asset('path/to/default-image.jpg') }}" alt="No Image"
                                                    class="img-fluid mb-2 vehicle-img w-100 p-4">
                                            @endif
                                        </div>

                                    </div>
                                    <!-- Detail -->
                                    <div class="card-body p-3 bg-white rounded-bottom">
                                        <h6 class="fw-semibold text-dark mb-0">{{ $product->brand->name_brand }}</h6>
                                        <p class="fw-bold text-secondary small mb-1">{{ $product->model_name }}</p>
                                        <hr>
                                        <!-- Icons -->
                                        <div class="d-flex justify-content-between text-center mb-2">
                                            <div class="flex-fill d-flex flex-column align-items-center">
                                                <img src="{{ asset('front_end/assets/images/3.png') }}" width="22"
                                                    class="mb-1">
                                                <p style="font-weight: 600;"class="small text-black mb-0 fw-semibold">
                                                    {{ $product->miles }} Miles</p>
                                            </div>

                                            <div class="flex-fill d-flex flex-column align-items-center">
                                                <img src="{{ asset('front_end/assets/images/2.png') }}" width="23"
                                                    class="mb-1">
                                                <p style="font-weight: 600;" class="small text-black mb-0 fw-semibold">
                                                    Electric</p>
                                            </div>
                                            @if ($product->seats)
                                                <div class="flex-fill d-flex flex-column align-items-center">
                                                    <img src="{{ asset('front_end/assets/images/1.png') }}" width="21"
                                                        class="mb-1">
                                                    <p style="font-weight: 600;" class="small text-black mb-0 fw-semibold">
                                                        {{ $product->seats }} Seat
                                                    </p>
                                                </div>
                                            @endif
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
