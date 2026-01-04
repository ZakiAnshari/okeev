@extends('layout.mobile.app')
@section('title', 'Detail')
@section('content')
    <style>
        body {
            padding-top: 0px !important;
        }
    </style>

    <div class="mobile-header">
        <div class="container header-container">
            <a href="javascript:history.back()" class="back-btn-img">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="mobile-header-title">Test Drive</div>
        </div>
    </div>
    <br>
    <div class="content-wrapper mt-5 container">
        <!-- Vehicle Image -->
        <div class="car-main-image-container">
            <img id="mainCarImage" src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->model_name }}"
                class="car-main-image mt-4" onclick="openModal()">
        </div>
        <p class="vehicle-name mt-3">{{ $product->model_name }}</p>


        <form action="{{ route('drive.store', $product->slug) }}" method="POST" class="form-grid">
            @csrf

            <!-- First Name -->
            <div class="td-group">
                <i class="bi bi-person td-icon"></i>
                <input type="text" name="first_name" class="form-control form-control-minimal" placeholder="First Name"
                    required>
            </div>

            <!-- Second Name -->
            <div class="td-group">
                <i class="bi bi-person td-icon"></i>
                <input type="text" name="second_name" class="form-control form-control-minimal" placeholder="Second Name"
                    required>
            </div>

            <!-- No. Telp -->
            <div class="td-group">
                <i class="bi bi-telephone td-icon"></i>
                <input type="tel" name="telp" class="form-control form-control-minimal" placeholder="No. Telp"
                    required>
            </div>

            <!-- Email -->
            <div class="td-group">
                <i class="bi bi-envelope td-icon"></i>
                <input type="email" name="email" class="form-control form-control-minimal" placeholder="Email" required>
            </div>

            <!-- City -->
            <div class="td-group select-group">
                <i class="bi bi-geo-alt td-icon"></i>
                <input type="text" name="city" class="form-control form-control-minimal" placeholder="City" required>
            </div>

            <!-- Dealer -->
            <div class="td-group select-group">
                <i class="bi bi-shop td-icon"></i>
                <select name="dealer" class="form-control form-control-minimal" required>
                    <option disabled selected>Choose Dealer</option>
                    <option value="jakarta_pusat">OKEEV Jakarta Pusat</option>
                    <option value="bandung">OKEEV Bandung</option>
                    <option value="surabaya">OKEEV Surabaya</option>
                </select>
                <i class="bi bi-chevron-right select-arrow"></i>
            </div>

            <!-- Submit -->
            <button type="submit" class="td-submit">
                Ready For Test Drive
            </button>

        </form>


    </div>
    <style>
        .form-control-minimal {
            border: none;
            border-bottom: 1px solid #cfcfcf;
            border-radius: 0;
            /* WAJIB */
            background: transparent;
            outline: none;
            box-shadow: none;
        }

        .td-form {
            padding: 15px;
        }

        .td-group {
            position: relative;
            margin-bottom: 22px;
        }

        .td-group input,
        .td-group select {
            width: 100%;
            border: none;
            border-bottom: 1.5px solid #bdbdbd;
            padding: 10px 36px 8px 30px;
            font-size: 14px;
            background: transparent;
            outline: none;
        }

        .td-group label {
            position: absolute;
            top: -6px;
            left: 30px;
            font-size: 12px;
            color: #666;
        }

        .td-icon {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #777;
        }

        /* Select */
        .select-group select {
            appearance: none;
            cursor: pointer;
        }

        .select-label {
            font-size: 12px;
            color: #666;
            display: block;
            margin-bottom: 6px;
        }

        .select-arrow {
            position: absolute;
            right: 0;
            top: 55%;
            transform: translateY(-50%);
            color: #777;
            font-size: 16px;
            pointer-events: none;
        }

        /* Submit Button */
        .td-submit {
            width: 100%;
            margin-top: 28px;
            padding: 12px;
            border: none;
            border-radius: 24px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(90deg, #00c6d7, #0072ff);
        }
    </style>
    @include('sweetalert::alert')
@endsection
