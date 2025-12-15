@extends('layout.admin')
@section('title', 'Dashboard')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4">
            <!-- ====== CARD UTAMA DASHBOARD ====== -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="card-body">
                                <h4 class="card-title text-primary">
                                    Halo {{ Auth::user()->role->name }}, Selamat Datang 🎉
                                </h4>
                                <p class="mb-4">
                                    You have done 72% more sales today. Check your new badge in your profile.
                                </p>
                                <a href="" class="btn btn-sm btn-outline-primary">
                                    Lihat Data
                                </a>
                            </div>
                        </div>
                        <div class="col-md-5 text-center">
                            <img src="{{ asset('/backend/assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <!-- CATEGORY -->
                    <div class="col-lg-6 col-md-12 col-6 mb-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center gap-3">

                                    <!-- ICON -->
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="
                                            width:48px;
                                            height:48px;
                                            border-radius:14px;
                                            background:#F3EFFF;
                                            border:1px solid rgba(111,66,193,0.25);
                                            box-shadow:0 6px 14px rgba(111,66,193,0.25);
                                            flex-shrink:0;
                                        ">
                                        <i class="bx bx-category" style="font-size:26px;color:#6F42C1;"></i>
                                    </div>

                                    <!-- TEXT -->
                                    <div>
                                        <span class="text-muted fw-semibold d-block" style="font-size:13px;">
                                            Category
                                        </span>
                                        <h5 class="fw-bold mb-0" style="color:#2E2E3A;">
                                            {{ $category_count }}
                                        </h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BRAND -->
                    <div class="col-lg-6 col-md-12 col-6 mb-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center gap-3">

                                    <!-- ICON -->
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="
                                        width:48px;
                                        height:48px;
                                        border-radius:14px;
                                        background:#EAF2FF;
                                        border:1px solid rgba(13,110,253,0.25);
                                        box-shadow:0 6px 14px rgba(13,110,253,0.25);
                                        flex-shrink:0;
                                    ">
                                        <i class="bx bx-purchase-tag" style="font-size:26px;color:#0D6EFD;"></i>
                                    </div>

                                    <!-- TEXT -->
                                    <div>
                                        <span class="text-muted fw-semibold d-block" style="font-size:13px;">
                                            Brand
                                        </span>
                                        <h5 class="fw-bold mb-0" style="color:#2E2E3A;">
                                            {{ $brand_count }}
                                        </h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PRODUCT -->
                    <div class="col-lg-6 col-md-12 col-6 mb-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center gap-3">

                                    <!-- ICON -->
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="
                                        width:48px;
                                        height:48px;
                                        border-radius:14px;
                                        background:#EAF7F1;
                                        border:1px solid rgba(25,135,84,0.25);
                                        box-shadow:0 6px 14px rgba(25,135,84,0.25);
                                        flex-shrink:0;
                                    ">
                                        <i class="bx bx-package" style="font-size:26px;color:#198754;"></i>
                                    </div>

                                    <!-- TEXT -->
                                    <div>
                                        <span class="text-muted fw-semibold d-block" style="font-size:13px;">
                                            Product
                                        </span>
                                        <h5 class="fw-bold mb-0" style="color:#2E2E3A;">
                                            {{ $product_count }}
                                        </h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- USER -->
                    <div class="col-lg-6 col-md-12 col-6 mb-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center gap-3">

                                    <!-- ICON -->
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="
                                        width:48px;
                                        height:48px;
                                        border-radius:14px;
                                        background:#FFF6DF;
                                        border:1px solid rgba(255,193,7,0.35);
                                        box-shadow:0 6px 14px rgba(255,193,7,0.25);
                                        flex-shrink:0;
                                    ">
                                        <i class="bx bx-user" style="font-size:26px;color:#FFC107;"></i>
                                    </div>

                                    <!-- TEXT -->
                                    <div>
                                        <span class="text-muted fw-semibold d-block" style="font-size:13px;">
                                            User
                                        </span>
                                        <h5 class="fw-bold mb-0" style="color:#2E2E3A;">
                                            {{ $user_count }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
