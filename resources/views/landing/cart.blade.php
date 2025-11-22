@extends('layout.user')
@section('title', 'cart')
@section('content')

<br><br><br><br>

<section class="py-5">
    <div class="container">

        <!-- Back -->
        <a href="/detailwuling" class="text-decoration-none d-flex align-items-center mb-4">
            <i class="bx bx-arrow-back me-2"></i> Order Now
        </a>

        <div class="row g-4">

            <!-- LEFT SIDE -->
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 rounded-4">

            <div class="d-flex flex-column flex-md-row gap-3 align-items-start">

                <!-- IMAGE -->
                <div class="product-image-box">
                    <img src="{{ asset('front_end/assets/images/Pristine_White 1.png') }}"
                        class="product-image">
                </div>

                <!-- TEXT + PRICE + COLORS -->
                <div class="flex-grow-1">

                    <h5 class="fw-bold mb-1">New Air Ev Lite Long Range</h5>

                    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                        <h5 class="fw-bold text-danger mb-0">Rp 194.000.000</h5>

                        <!-- Counter -->
                        <div class="d-flex align-items-center border rounded px-2 py-1"
                            style="gap: 10px; min-width: 90px; justify-content: center;">
                            <button class="btn p-0 fw-bold" style="font-size: 20px;">-</button>
                            <span class="fw-bold">1</span>
                            <button class="btn p-0 fw-bold" style="font-size: 20px;">+</button>
                        </div>
                    </div>

                    <hr>

                    <p class="fw-semibold mb-2">Pilih Warna</p>

                    <div class="d-flex flex-wrap gap-2 gap-md-3">
                      <div class="color-circle" style="background: linear-gradient(#000 50%, #fff 50%);"></div>
                      <div class="color-circle" style="background: linear-gradient(#2f3a2f 50%, #d7e1d2 50%);"></div>
                      <div class="color-circle" style="background: linear-gradient(#000 50%, #ffd500 50%);"></div>
                      <div class="color-circle" style="background: linear-gradient(#000 50%, #d7b0a4 50%);"></div>
                      <div class="color-circle" style="background: linear-gradient(#000 50%, #c7cae8 50%);"></div>
                      <div class="color-circle" style="background: linear-gradient(#000 50%, #000 50%);"></div>
                  </div>


                </div>
            </div>

        </div>
      </div>

      <style>
          .product-image-box {
              width: 200px;
              height: 165px;
              display: flex;
              align-items: center;
              justify-content: center;
              background: #f8f9fa;
              border-radius: 12px;
              flex-shrink: 0;
              overflow: hidden;
          }

          .product-image {
              height: 100%;
              width: auto;
              object-fit: contain;
          }

          .color-circle {
              width: 45px;
              height: 45px;
              border-radius: 50%;
              border: 1px solid #ddd;
              cursor: pointer;
              transition: .25s;
          }

          .color-circle:hover {
              transform: scale(1.15);
              box-shadow: 0 4px 12px rgba(0,0,0,0.15);
          }

          /* ---------- RESPONSIVE HP ---------- */
          @media (max-width: 576px) {

              .product-image-box {
                  width: 100% !important;
                  height: auto !important;
              }

              .product-image {
                  width: 100% !important;
                  height: auto !important;
                  object-fit: contain;
              }
          }
      </style>



            <!-- RIGHT SIDE -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 rounded-4">

                    <!-- Payment Title -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-bold mb-0">Payment Methods</h6>
                        <a href="#" class="small text-decoration-none">See all</a>
                    </div>

                    <!-- Payment List -->
                    <div class="list-group mb-4">

                        @foreach([
                            ['img' => 'Group.png', 'name' => 'BCA Virtual Account'],
                            ['img' => 'Group (1).png', 'name' => 'Mandiri Virtual Account'],
                            ['img' => 'BRIVA-BRI 1.png', 'name' => 'BRI Virtual Account'],
                            ['img' => 'Logo-CIMB-Niaga-Linkqu 1.png', 'name' => 'CIMB Virtual Account'],
                        ] as $key => $bank)

                        <label class="list-group-item d-flex align-items-center justify-content-between border-0 payment-item">

                            <div class="d-flex align-items-center gap-3">
                                <div class="brand-box">
                                    <img src="{{ asset('front_end/assets/images/'.$bank['img']) }}"
                                         class="brand-img" alt="Bank Logo">
                                </div>

                                <span class="fw-semibold">{{ $bank['name'] }}</span>
                            </div>

                            <input type="radio" name="pay" {{ $key === 0 ? 'checked' : '' }} class="radio-lg">
                        </label>

                        @endforeach

                    </div>

                    <hr>

                    <!-- Summary -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Total price (1 item)</span>
                            <span class="fw-semibold">Rp 194.000.000</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Service Fee</span>
                            <span class="fw-semibold">Rp 2.000</span>
                        </div>
                    </div>

                    <hr>

                    <!-- Total Bill -->
                    <div class="d-flex justify-content-between fw-semibold fs-6 mb-3">
                        <span>Total Bill</span>
                        <span class="text-primary">Rp 194.002.000</span>
                    </div>

                    <!-- Payment Button -->
                    <button class="btn btn-info text-white w-100 py-2 rounded-pill">
                        Payment
                    </button>

                </div>
            </div>

        </div>

    </div>
</section>


<style>
/* PRODUCT IMAGE */
.product-image-box {
    width: 160px;
    height: 110px;
    background: #f8f8f8;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}
.product-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* COLOR CIRCLE */
.color-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    border: 1px solid #ddd;
    cursor: pointer;
    transition: .25s;
}
.color-circle:hover {
    transform: scale(1.15);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* PAYMENT LIST */
.payment-item {
    border-radius: 14px;
    background: #fff;
    padding: 14px 16px;
    margin-bottom: 10px;
}
.brand-box {
    width: 70px;
    height: 50px;
    background: #f5f5f5;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.brand-img {
    max-height: 30px;
}
.radio-lg {
    transform: scale(1.2);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .product-image-box {
        width: 130px;
        height: 90px;
    }
    .color-circle {
        width: 40px;
        height: 40px;
    }
}
</style>

@endsection
