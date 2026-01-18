@extends('layout.user')
@section('title', 'Search Results')
@section('content')
    <section style="padding-top:120px; padding-bottom:60px;">
        <div class="container py-5">
        {{-- <div class="search-box mb-4">
            <i class="bx bx-search"></i>
            <form action="{{ route('search.results') }}" method="get" style="display:flex; gap:8px;">
                <input type="text" name="q" value="{{ old('q', $q ?? '') }}" placeholder="Search" class="form-control" />
                <button class="btn btn-primary">Search</button>
            </form>
        </div> --}}

        <h3 class="mb-3">Hasil pencarian untuk "{{ $q }}"</h3>

        @if ($products->count())
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        @if (in_array($product->category_id, [1, 2]))
                            <div class="vehicle-card rounded shadow-sm h-100" style="border: 1px solid #F1F1F1 !important;">
                                <!-- Image -->
                                <div class="vehicle-img-wrapper" style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%); border-radius: 4px 4px 0 0;">
                                    <a href="{{ route('landing.product', $product->slug) }}">
                                        <div class="product-images">
                                            @if ($product->images && $product->images->isNotEmpty())
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="d-block mx-auto img-fluid p-4" style="max-height: 340px; object-fit: contain;" alt="Thumbnail">
                                            @else
                                                <img src="{{ asset('front_end/assets/images/default.jpg') }}" alt="No Image" class="img-fluid mb-2 vehicle-img w-100 p-4">
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <!-- Detail -->
                                <div class="card-body p-3 bg-white rounded-bottom">
                                    <h6 class="fw-semibold text-dark mb-0">{{ optional($product->brand)->name_brand }}</h6>
                                    <p class="fw-bold text-secondary small mb-1">{{ $product->model_name }}</p>
                                    <hr>
                                    <!-- Icons -->
                                    <div class="d-flex justify-content-between text-center mb-2">
                                        <div class="flex-fill d-flex flex-column align-items-center">
                                            <img src="{{ asset('front_end/assets/images/3.png') }}" width="22" class="mb-1">
                                            <p style="font-weight: 600;" class="small text-black mb-0 fw-semibold">{{ $product->miles }} Miles</p>
                                        </div>

                                        <div class="flex-fill d-flex flex-column align-items-center">
                                            <img src="{{ asset('front_end/assets/images/2.png') }}" width="23" class="mb-1">
                                            <p style="font-weight: 600;" class="small text-black mb-0 fw-semibold">Electric</p>
                                        </div>
                                        @if ($product->seats)
                                            <div class="flex-fill d-flex flex-column align-items-center">
                                                <img src="{{ asset('front_end/assets/images/1.png') }}" width="21" class="mb-1">
                                                <p style="font-weight: 600;" class="small text-black mb-0 fw-semibold">{{ $product->seats }} Seat</p>
                                            </div>
                                        @endif
                                    </div>
                                    <hr class="my-2">
                                    <!-- Price & Detail Link -->
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <p class="fw-bold text-danger mb-0">IDR {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <a href="{{ route('landing.product', $product->slug) }}" class="text-decoration-none fw-semibold d-flex align-items-center" style="color: #30445C !important;">
                                            Detail
                                            <img src="{{ asset('front_end/assets/images/icon.png') }}" width="10" class="mb-1 ms-2">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        @else
            <p class="text-muted">Tidak ada hasil.</p>
        @endif
    </div>
    </section>
@endsection
