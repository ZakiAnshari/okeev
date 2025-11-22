@extends('layout.user')
@section('title', 'contact')
@section('content')

<section class="py-5 contact-section">
    <div class="container">
        <div class="row g-5 align-items-start">

            <!-- LEFT CONTENT -->
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3" style="color:#232b44; font-size: 42px;">Contact Us</h2>
                <p class="C sectmb-4" style="color:#6c748a;">
                    Lorem ipsum dolor sit amet consectetur. Id condimentum sed elit sagittis senectus feugiat.
                    Congue erat sem tincidunt nulla sed mattis. Velit et gravida sit.
                </p>

                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <i class="bx bxl-instagram" style="font-size: 24px; color:#00f2ea;"></i>
                        <span>okeev.ig</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <i class="bx bxl-tiktok" style="font-size: 24px; color:#00f2ea;"></i>
                        <span>okeev.tiktok</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <i class="bx bxl-xing" style="font-size: 24px; color:#00f2ea;"></i>
                        <span>okeev.x</span>
                    </li>
                </ul>
            </div>

            <!-- RIGHT FORM CARD -->
            <div class="col-lg-6">
                <div class="p-4 rounded-4 shadow"
                    style="background:#1e2a45; border-radius: 12px;">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="text-light mb-1">Name</label>
                            <input type="text" class="form-control custom-input" placeholder="Enter your name">
                        </div>

                        <div class="col-md-6">
                            <label class="text-light mb-1">Email</label>
                            <input type="email" class="form-control custom-input" placeholder="Enter your email">
                        </div>

                        <div class="col-md-6">
                            <label class="text-light mb-1">Phone</label>
                            <input type="text" class="form-control custom-input" placeholder="+62">
                        </div>

                        <div class="col-md-6">
                            <label class="text-light mb-1">Subject</label>
                            <input type="text" class="form-control custom-input" placeholder="Ex. Career">
                        </div>

                        <div class="col-12">
                            <label class="text-light mb-1">Message</label>
                            <textarea class="form-control custom-input" rows="4"
                                placeholder="Type your message here..."></textarea>
                        </div>

                        <div class="col-12 text-start mt-4">
                            <button class="btn px-4 py-2 w-auto"
                                style="
                                    background:#00f2ea;
                                    border:none;
                                    font-weight:600;
                                    border-radius:8px;">
                                Send message
                            </button>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .custom-input {
        background: #111a30 !important;
        border: none !important;
        color: #fff !important;
    }
    .custom-input::placeholder {
        color: #8a93a8 !important;
    }
    .custom-input:focus {
        box-shadow: 0 0 0 2px #00f2ea33 !important;
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 32px !important;
        }
    }

    .contact-section {
    margin-top: 150px;
    }

    @media (max-width: 576px) {
        .contact-section {
            margin-top: 50px;
        }
    }

</style>

@endsection
