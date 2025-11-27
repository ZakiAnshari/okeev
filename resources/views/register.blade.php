<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/backend/assets/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
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
            <div style="display: flex; justify-content: center; align-items: center; width: 180px; height: 62px;">
                <img src="{{ asset('/front_end/assets/images/logo_okeev.png') }}" alt="App Logo"
                    style="object-fit: contain; width: 100%; height: 100%;">
            </div>
        </a>
        <p class="mb-4" style="text-align: center; margin-top: 2px; font-weight: 500; font-size: 15px;">
            Create your account
        </p>
    </div>
    <!-- /Logo -->

    <form action="{{ route('register-store') }}" method="POST" class="mb-3">
    @csrf

    <!-- Nama -->
    <div class="mb-3">
        <label for="name" class="form-label d-flex justify-content-between">
            <span>Nama</span>
        </label>

        <input 
            type="text"
            id="name"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Enter your name"
            value="{{ old('name') }}"
            style="background:#30445C;color:#fff;border:1px solid #30445C;"
        />

        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Username -->
    <div class="mb-3">
        <label for="username" class="form-label d-flex justify-content-between">
            <span>Username</span>
        </label>

        <input 
            type="text"
            id="username"
            name="username"
            class="form-control @error('username') is-invalid @enderror"
            placeholder="Enter username"
            value="{{ old('username') }}"
            style="background:#30445C;color:#fff;border:1px solid #30445C;"
        />

        @error('username')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Contact -->
    <div class="mb-3">
        <label for="contact" class="form-label d-flex justify-content-between">
            <span>No. Telepon</span>
        </label>

        <input 
            type="text"
            id="contact"
            name="contact"
            class="form-control @error('contact') is-invalid @enderror"
            placeholder="08xxxxxxxxxx"
            value="{{ old('contact') }}"
            style="background:#30445C;color:#fff;border:1px solid #30445C;"
        />

        @error('contact')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label d-flex justify-content-between">
            <span>Email</span>
        </label>

        <input 
            type="text"
            id="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="Enter your email"
            value="{{ old('email') }}"
            style="background:#30445C;color:#fff;border:1px solid #30445C;"
        />

        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Jenis Kelamin -->
    <div class="mb-3">
        <label class="form-label d-flex justify-content-between">
            <span>Jenis Kelamin</span>
        </label>

        <select 
            name="jenis_kelamin" 
            class="form-control @error('jenis_kelamin') is-invalid @enderror"
            style="background:#30445C;color:#fff;border:1px solid #30445C;"
        >
            <option value="" disabled selected>-- Pilih --</option>
            <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
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
            <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="********"
                style="background:#30445C;color:#fff;border:1px solid #30445C;"
            />
            <span class="input-group-text cursor-pointer" style="background:#30445C;color:#fff;border:1px solid #30445C;">
                <i class="bx bx-hide"></i>
            </span>
        </div>

        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password Confirmation -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label d-flex justify-content-between">
            <span>Confirm Password</span>
        </label>

        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="form-control"
            placeholder="********"
            style="background:#30445C;color:#fff;border:1px solid #30445C;"
        />
    </div>

    <!-- Terms -->
    

    <!-- Submit -->
    <button class="btn d-grid w-100"
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
