@extends('layout.user')
@section('title', 'Home')
@section('content')
  <!-- Wallpaper Section -->
    <section class="wallpaper-section position-relative ">
        <img src="{{ asset('front_end/assets/images/backgroundwuing.png') }}" 
             alt="Wallpaper" 
             class="wallpaper-img">

        <div class="container">
            <div class="logo-left">
                <img src="{{ asset('front_end/assets/images/logowuling.png') }}" 
                        alt="Logo" 
                        class="logo-img">
            </div>
        </div>
    </section>

    <!-- Vehicle List -->
    <section>
        <div class="container">
            <h4 class="mb-4">Mobil yang tersedia</h4>
            <div class="row">
                @forelse($products as $product)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="vehicle-card rounded shadow-sm h-100" 
                        style="border: 1px solid #F1F1F1 !important;">
                        <!-- Image -->
                        <div class="vehicle-img-wrapper"
                                style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%);
                                    border-radius: 4px 4px 0 0;">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                    class="vehicle-img w-100 p-4" 
                                    alt="{{ $product->model_name}}">
                        </div>
                        <!-- Detail -->
                        <div class="card-body p-3 bg-white rounded-bottom">
                            <h6 class="fw-semibold text-dark mb-0">{{ $product->brand }}</h6>
                            <p class="fw-bold text-secondary small mb-1">{{ $product->model_name }}</p>

                            <hr class="my-2">

                            <!-- Icons -->
                            <div class="d-flex justify-content-between text-center mb-2">
                                <div class="icon-box flex-fill d-flex flex-column align-items-center">
                                    <img src="{{ asset('front_end/assets/images/3.png') }}" width="22" class="mb-1">
                                    <p style="font-weight: 600;"class="small text-black mb-0 fw-semibold">{{ $product->miles }} Miles</p>
                                </div>

                                <div class="icon-box flex-fill d-flex flex-column align-items-center">
                                    <img src="{{ asset('front_end/assets/images/2.png') }}" width="23" class="mb-1">
                                    <p style="font-weight: 600;" class="small text-black mb-0 fw-semibold">{{ $product->type }}</p>
                                </div>

                                <div class="icon-box flex-fill d-flex flex-column align-items-center">
                                    <img src="{{ asset('front_end/assets/images/1.png') }}" width="21" class="mb-1">
                                    <p style="font-weight: 600;" class="small text-black mb-0 fw-semibold">{{ $product->seats }} Seat</p>
                                </div>
                            </div>




                            <hr class="my-2">

                            <!-- Price & Detail Link -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="fw-bold text-danger mb-0">
                                    IDR {{ number_format($product->regular_price, 0, ',', '.') }}
                                </p>

                                <a href="{{ route('landing.product', ['brandSlug' => Str::slug($product->brand), 'productSlug' => $product->slug]) }}" 
                                class="text-decoration-none fw-semibold d-flex align-items-center"
                                style="color: #30445C !important;">
                                    Detail
                                    <img src="{{ asset('front_end/assets/images/icon.png') }}" 
                                        width="10" class="mb-1 ms-2"> <!-- pakai ms-2 untuk margin kiri agar rapi -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="text-center">Tidak ada produk untuk brand ini.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
