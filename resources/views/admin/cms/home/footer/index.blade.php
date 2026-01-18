@extends('layout.admin')
@section('title', 'Footer')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between align-items-center my-4">

            <h4 class="fw-bold d-flex align-items-center mb-0">
                <i class="bx bx-layout me-3 text-primary" style="font-size: 1.5rem;"></i>
                <span>Master Footer</span>
            </h4>

        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form id="footerForm" action="{{ route('cms.home.footer.update') }}" method="post">
                        @csrf
                        <div class="mb-4">
                        <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1 ">
                            First Footer Description *

                        </span>
                        <div class="col-md-12">

                            <textarea name="description" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('description', $footer->description ?? '') }}</textarea>
                            @error('description')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-0">
                        <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1 ">
                            Second Contact *
                        </span>

                        <div class="row">
                            <!-- Email -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-envelope"></i>
                                        </span>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Masukkan email" value="{{ old('email', $footer->email ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Handphone -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="handphone" class="form-label">Handphone</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-phone"></i>
                                        </span>
                                        <input type="text" name="handphone" id="handphone" class="form-control"
                                            placeholder="Masukkan nomor handphone" value="{{ old('handphone', $footer->handphone ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Lokasi -->
                            <div class="col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-map"></i>
                                        </span>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control"
                                            placeholder="Masukkan lokasi" value="{{ old('lokasi', $footer->lokasi ?? '') }}" required>
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
                            const form = document.getElementById('footerForm');
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


    </div>
    
@endsection
