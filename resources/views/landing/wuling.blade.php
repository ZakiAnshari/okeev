@extends('layout.user')

@section('title', 'wuling')

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
                @foreach ([1,2,3,4,5,6,7] as $i)
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="vehicle-card rounded shadow-sm h-100" 
                                style="border: 1px solid #F1F1F1 !important;">

                            <!-- Image -->
                            <div class="vehicle-img-wrapper"
                                style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%);
                                        border-radius: 4px 4px 0 0;">
                                <img src="{{ asset('front_end/assets/images/card.png') }}" 
                                        class="vehicle-img w-100 p-3" 
                                        alt="Vehicle">
                            </div>

                            <!-- Detail -->
                            <div class="card-body p-3 bg-white rounded-bottom">
                                <h6 class="fw-semibold text-dark mb-0">Brand {{ $i }}</h6>
                                <p class="fw-bold text-secondary small mb-1">Model {{ $i }} Edition</p>

                                <hr class="my-2">

                                <!-- Icons -->
                                <div class="d-flex justify-content-between text-center mb-2">


                                    <div class="icon-box flex-fill">
                                        <img src="{{ asset('front_end/assets/images/3.png') }}" 
                                             width="22" 
                                             class="mb-1">
                                        <p class="small text-black mb-0">20 Miles</p>
                                    </div>
                                    

                                    <div class="icon-box flex-fill">
                                        <img src="{{ asset('front_end/assets/images/2.png') }}" 
                                             width="22" 
                                             class="mb-1">
                                        <p class="small text-black mb-0">400 km</p>
                                    </div>


                                    <div class="icon-box flex-fill">
                                        <img src="{{ asset('front_end/assets/images/1.png') }}" 
                                             width="22" 
                                             class="mb-1">
                                        <p class="small text-black mb-0">2 seat</p>
                                    </div>
                                </div>

                                <hr class="my-2">

                                <!-- Price & Detail Link -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <p class="fw-bold text-danger mb-0">
                                        IDR {{ number_format(500000000 * $i, 0, ',', '.') }}
                                    </p>

                                    <a href="/detailwuling" 
                                       class="text-decoration-none fw-semibold d-flex align-items-center"
                                       style="color:#30445C !important">
                                        Detail
                                        <img src="{{ asset('front_end/assets/images/icon.png') }}" 
                                             width="10" 
                                             class="mb-1 mx-2">
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
