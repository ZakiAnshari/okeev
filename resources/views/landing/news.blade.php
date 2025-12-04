@extends('layout.user')
@section('title', 'news')
@section('content')
    <br><br><br><br>
    <section class="py-5" style="background:#f6f7f9;">
        <div class="container">

            <!-- Title -->
            <h2 class="text-center fw-bold mb-5" style="color:#30445C;">News</h2>

            <div class="row g-4">

                <!-- Item News -->
                @for ($i = 0; $i < 8; $i++)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card shadow-sm border-0 rounded-4 h-100">

                            <!-- Image wrapper -->
                            <div class="ratio ratio-16x9 rounded-top-4 overflow-hidden">
                                <img src="{{ asset('/front_end/assets/images/news.png') }}" class="w-100 h-100"
                                    style="object-fit:contain;">
                            </div>
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3" style="color:#1a2a3a;">
                                    Rivian’s Quad-Motor R1T Can Outrun Corvettes
                                </h6>
                                <div class="d-flex justify-content-between align-items-center text-muted"
                                    style="font-size:14px;">
                                    <span>Nov 28, 2025</span>
                                    <div class="d-flex gap-3">
                                        <i class="bi bi-share"></i>
                                        <i class="bi bi-bookmark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor

            </div>

        </div>
    </section>

@endsection
