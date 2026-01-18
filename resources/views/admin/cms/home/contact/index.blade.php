@extends('layout.admin')
@section('title', 'Contact')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between align-items-center my-4">

            <h4 class="fw-bold d-flex align-items-center mb-0">
                <i class="bx bx-phone-call me-3 text-primary" style="font-size: 1.5rem;"></i>
                <span>Master Contact</span>
            </h4>

        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form id="contactForm" action="{{ route('cms.home.contact.update') }}" method="post">
                        @csrf
                        <div class="mb-4">
                        <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1 ">
                            First Contact Description *

                        </span>
                        <div class="col-md-12">

                            <textarea name="description" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('description', $contact->description ?? '') }}</textarea>
                            @error('description')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-0">
                        <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1 ">
                            Second Contact Social Media *

                        </span>

                        <div class="row">
                            <!-- Instagram -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bxl-instagram"></i>
                                        </span>
                                        <input type="text" name="instagram" id="instagram" class="form-control"
                                            placeholder="Username / Link Instagram" value="{{ old('instagram', $contact->instagram ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- TikTok -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tiktok" class="form-label">TikTok</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bxl-tiktok"></i>
                                        </span>
                                        <input type="text" name="tiktok" id="tiktok" class="form-control"
                                            placeholder="Username / Link TikTok" value="{{ old('tiktok', $contact->tiktok ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- X (Twitter) -->
                            <div class="col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="x" class="form-label">X (Twitter)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bxl-twitter"></i>
                                        </span>
                                        <input type="text" name="x" id="x" class="form-control"
                                            placeholder="Username / Link X" value="{{ old('x', $contact->x ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2  mt-4">
                            <button type="button" id="resetBtn" class="btn btn-outline-secondary d-flex align-items-center">
                                <i class="bx bx-reset me-2"></i>
                                <span>Reset</span>
                            </button>

                            <button type="submit" class="btn btn-outline-success d-flex align-items-center">
                                <i class="bx bx-save "></i>
                                <span>Save Changes</span>
                            </button>
                        </div>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const resetBtn = document.getElementById('resetBtn');
                            const form = document.getElementById('contactForm');
                            if (!resetBtn || !form) return;
                            resetBtn.addEventListener('click', function () {
                                form.querySelectorAll('input, textarea, select').forEach(function (el) {
                                    if (el.type === 'checkbox' || el.type === 'radio') {
                                        el.checked = false;
                                    } else {
                                        el.value = '';
                                    }
                                });
                            });
                        });
                    </script>

                    </div>
                </div>
            </div>
        </div>


    </div>
    @include('sweetalert::alert')
@endsection
