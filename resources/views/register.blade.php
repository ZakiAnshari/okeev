<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/backend/assets/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('/backend/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/backend/assets/') }}../assets/js/config.js"></script>
    <style>
        * {
            font-family: 'Oxanium', sans-serif !important;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="app-brand justify-content-center"
                            style="display: flex; flex-direction: column; align-items: center; margin: 15px;">
                            <a href="/" class="app-brand-link gap-2" style="text-align: center;">
                                <div
                                    style="display: flex; justify-content: center; align-items: center; width: 180px; height: 62px;">
                                    <img src="{{ asset('/front_end/assets/images/logo_okeev.png') }}" alt="App Logo"
                                        style="object-fit: contain; width: 100%; height: 100%;">
                                </div>
                            </a>
                            <p class="mb-4"
                                style="text-align: center; margin-top: 2px; font-weight: 500; font-size: 15px;">
                                Create your account
                            </p>
                        </div>
                        <!-- /Logo -->

                        @if ($errors->any())
                            <div class="alert alert-danger mb-3" style="border-radius: 8px;">
                                <strong>❌ Registrasi Gagal!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger mb-3" style="border-radius: 8px;">
                                <strong>❌ Error: </strong>{{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success mb-3" style="border-radius: 8px;">
                                <strong>✅ {{ session('success') }}</strong>
                            </div>
                        @endif

                        <form action="{{ route('register-store') }}" method="POST" class="mb-3 needs-validation" novalidate>
                            @csrf

                            <!-- First Name -->
                            <div class="mb-3">
                                <label for="first_name" class="form-label">
                                    <span>First Name <span class="text-danger">*</span></span>
                                </label>

                                <input type="text" id="first_name" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name') }}" placeholder="Enter your first name"
                                    style="background:#30445C;color:#fff;border:1px solid #30445C;" required />

                                @error('first_name')
                                    <div class="invalid-feedback d-block" style="color: #ff6b6b;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <!-- Second Name -->
                            <div class="mb-3">
                                <label for="second_name" class="form-label d-flex justify-content-between">
                                    <span>Second Name</span>
                                </label>

                                <input type="text" id="second_name" name="second_name"
                                    class="form-control @error('second_name') is-invalid @enderror"
                                    value="{{ old('second_name') }}" placeholder="Enter your second name"
                                    style="background:#30445C;color:#fff;border:1px solid #30445C;" required />

                                @error('second_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Contact -->
                            <div class="mb-3">
                                <label for="contact" class="form-label d-flex justify-content-between">
                                    <span>Telp</span>
                                </label>

                                <input type="text" id="contact" name="contact"
                                    class="form-control @error('contact') is-invalid @enderror"
                                    placeholder="08xxxxxxxxxx" value="{{ old('contact') }}"
                                    style="background:#30445C;color:#fff;border:1px solid #30445C;" required />

                                @error('contact')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label d-flex justify-content-between">
                                    <span>Email</span>
                                </label>

                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter your email" value="{{ old('email') }}"
                                    style="background:#30445C;color:#fff;border:1px solid #30445C;" required />

                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- City -->
                            <div class="mb-3">
                                <label for="city" class="form-label d-flex justify-content-between">
                                    <span>City</span>
                                </label>

                                <textarea id="city" name="city" rows="3" class="form-control @error('city') is-invalid @enderror"
                                    placeholder="Enter your city" style="background:#30445C;color:#fff;border:1px solid #30445C;" required>{{ old('city') }}</textarea>

                                @error('city')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Jenis Kelamin -->
                            <div class="mb-3">
                                <label class="form-label d-flex justify-content-between">
                                    <span>Jenis Kelamin</span>
                                </label>

                                <select name="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                    style="background:#30445C;color:#fff;border:1px solid #30445C;" required>
                                    <option value="" disabled {{ !old('jenis_kelamin') ? 'selected' : '' }}>-- Pilih --</option>
                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>

                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3 form-password-toggle">
                                <label for="password" class="form-label d-flex justify-content-between">
                                    <span>Password</span>
                                </label>

                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password minimal 6 karakter" aria-describedby="toggle-password"
                                        style="background:#30445C;color:#fff;border:1px solid #30445C;" required />

                                    <span class="input-group-text cursor-pointer" id="toggle-password"
                                        style="background:#30445C;color:#fff;border:1px solid #30445C;">
                                        <i class="bx bx-hide"></i>
                                    </span>

                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- Password Confirmation -->
                            <div class="mb-3 form-password-toggle">
                                <label for="password_confirmation" class="form-label d-flex justify-content-between">
                                    <span>Confirm Password</span>
                                </label>

                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Ulangi password"
                                        aria-describedby="toggle-password-confirm"
                                        style="background:#30445C;color:#fff;border:1px solid #30445C;" required />

                                    <span class="input-group-text cursor-pointer" id="toggle-password-confirm"
                                        style="background:#30445C;color:#fff;border:1px solid #30445C;">
                                        <i class="bx bx-hide"></i>
                                    </span>
                                </div>

                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Terms -->


                            <!-- Submit -->
                            <button type="submit" class="btn d-grid w-100" id="submitBtn"
                                style="background:linear-gradient(94.57deg,#1DCDFE -0.65%,#35F5C6 135.25%);border:none;border-radius:50px;color:#30445C;font-weight:700;">
                                REGISTER
                            </button>
                        </form>

                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="/login"><span>Login</span></a>
                        </p>
                    </div>

                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    @include('sweetalert::alert')

    <style>
        /* HILANGKAN ICON PASSWORD BAWAAN BROWSER (Chrome / Edge) */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        input[type="password"]::-webkit-credentials-auto-fill-button {
            visibility: hidden;
            display: none !important;
        }

        input[type="password"]::-webkit-textfield-decoration-container {
            display: none;
        }
    </style>
    <script>
        // Pastikan DOM sudah fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Register form initialized');

            // Password toggle functionality
            const passwordToggles = document.querySelectorAll('.form-password-toggle .input-group-text');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');

                    if (input) {
                        if (input.type === 'password') {
                            input.type = 'text';
                            icon.classList.remove('bx-hide');
                            icon.classList.add('bx-show');
                        } else {
                            input.type = 'password';
                            icon.classList.remove('bx-show');
                            icon.classList.add('bx-hide');
                        }
                    }
                });
            });

            // Form submission handler
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submitBtn');
            let isSubmitting = false;

            if (form && submitBtn) {
                form.addEventListener('submit', function(e) {
                    console.log('Form submit event triggered');
                    
                    // Prevent double submission
                    if (isSubmitting) {
                        console.log('Submission already in progress, preventing double submit');
                        e.preventDefault();
                        return false;
                    }

                    const password = document.getElementById('password');
                    const passwordConfirm = document.getElementById('password_confirmation');

                    // Validasi password match SEBELUM submit
                    if (password && passwordConfirm) {
                        if (password.value !== passwordConfirm.value) {
                            console.log('Password mismatch detected');
                            e.preventDefault();
                            alert('❌ Password dan konfirmasi password tidak cocok!');
                            passwordConfirm.classList.add('is-invalid');
                            passwordConfirm.focus();
                            return false;
                        }
                    }

                    // Set loading state
                    isSubmitting = true;
                    submitBtn.disabled = true;
                    const originalText = submitBtn.textContent;
                    submitBtn.innerHTML = 'Loading...';

                    console.log('Form is being submitted with following data:');
                    const formData = new FormData(form);
                    for (let [key, value] of formData) {
                        if (key !== 'password' && key !== 'password_confirmation') {
                            console.log(key + ':', value);
                        }
                    }

                    // Form akan submit secara normal ke server
                    // Jika ada error validation, page akan refresh dengan error messages
                });
            } else {
                console.error('Form or submit button not found!');
            }
        });
    </script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('/backend/assets/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('/backend/assets/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
