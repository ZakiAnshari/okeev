@extends('layout.admin')
@section('title', 'Dashboard')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4">
        <!-- ====== CARD UTAMA DASHBOARD ====== -->
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="card-body">
                            <h4 class="card-title text-primary">
                                Halo {{ Auth::user()->role->name }}, selamat datang di Aplikasi Okeev 🎉
                            </h4>
                            <p class="mb-4">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident qui, minima illo inventore voluptatum quis?
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
    </div>
</div>

@include('sweetalert::alert')
@endsection
