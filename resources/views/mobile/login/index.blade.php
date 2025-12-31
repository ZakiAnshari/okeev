@extends('layout.mobile.app')
@section('title', 'login')
@section('content')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #00D4FF 0%, #00C4F0 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }

        .container {
            background: linear-gradient(180deg, rgba(29, 205, 254, 1), rgba(53, 245, 198, 1));

            width: 100%;
            max-width: 375px;
            min-height: 100vh;
            padding: 50px 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo h1 {
            color: white;
            font-size: 48px;
            font-weight: 700;
            letter-spacing: 3px;
        }

        .subtitle {
            color: white;
            font-size: 13px;
            /* margin-bottom: 25px; */
            font-weight: 400;
            /* text-align: center; */
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 16px 20px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            background: white;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }

        input::placeholder {
            color: #D3D3D3;
            font-weight: 400;
        }

        /* Wrapper input */
        .input-wrapper {
            position: relative;
            width: 100%;
        }

        /* Input */
        .input-wrapper input {
            width: 100%;
            height: 52px;
            /* KUNCI tinggi */
            padding: 16px 50px 16px 20px;
            /* ruang kanan utk icon */
            border: none;
            border-radius: 12px;
            font-size: 14px;
            background: white;
            color: #333;
            font-family: 'Poppins', sans-serif;
            outline: none;
        }

        /* Icon mata */
        .eye-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* SVG icon */
        .eye-icon svg {
            width: 20px;
            height: 20px;
            fill: #00C4F0;
        }


        .forgot-password {
            text-align: right;
            margin-top: 8px;
            margin-bottom: 20px;
        }

        .forgot-password a {
            color: white;
            font-size: 11px;
            text-decoration: none;
            font-weight: 400;
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
            background: #3D4F5C;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            /* margin-bottom: 20px; */
            text-decoration: none;
            display: block;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary:hover {
            background: #4A5D6B;
        }

        .divider {
            text-align: center;
            color: white;
            margin: 15px 0;
            font-size: 13px;
            font-weight: 400;
        }

        .btn-google {
            width: 100%;
            padding: 16px;
            background: white;
            color: #333;
            border: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        .btn-google:hover {
            background: #f8f8f8;
        }

        .footer-text {
            text-align: center;
            color: white;
            font-size: 12px;
            margin-top: 100px;
            font-weight: 400;
        }

        .footer-text a {
            color: white;
            font-weight: 600;
            text-decoration: none;
        }

        .eye-icon i {
            font-size: 20px;
            color: #00C4F0;
        }

        .eye-icon {
            background: transparent;
            border: none;
            outline: none;
            box-shadow: none;
            padding: 0;
        }

        /* Hilangkan garis saat focus / klik */
        .eye-icon:focus,
        .eye-icon:active {
            outline: none;
            box-shadow: none;
        }
    </style>

    <div class="container">
        <div class="logo">
            <h1>OKEEV</h1>
        </div>

        <p class="subtitle">Masuk ke akun Anda</p>

        <form action="{{ route('login') }}" method="POST" class="mb-3">
            @csrf

            <div class="form-group">
                <input type="text" placeholder="Username" name="username" value="{{ old('username') }}" required>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="password" id="password" placeholder="Kata Sandi" name="password" required>
                    <button type="button" class="eye-icon" onclick="togglePassword()">
                        <i id="eyeIcon" class="bx bx-show"></i>
                    </button>
                </div>
            </div>

            <div class="forgot-password">
                <a href="reset.html">Lupa kata sandi ?</a>
            </div>

            <button type="submit" class="btn-primary">Masuk</button>
        </form>

        <div class="divider">Atau masuk dengan</div>

        <a href="#" class="btn-google">
            <svg width="20" height="20" viewBox="0 0 20 20">
                <path fill="#4285F4"
                    d="M19.6 10.23c0-.82-.1-1.42-.25-2.05H10v3.72h5.5c-.15.96-.74 2.31-2.04 3.22v2.45h3.16c1.89-1.73 2.98-4.3 2.98-7.34z" />
                <path fill="#34A853"
                    d="M13.46 15.13c-.83.59-1.96 1-3.46 1-2.64 0-4.88-1.74-5.68-4.15H1.07v2.52C2.72 17.75 6.09 20 10 20c2.7 0 4.96-.89 6.62-2.42l-3.16-2.45z" />
                <path fill="#FBBC05"
                    d="M3.99 10c0-.69.12-1.35.32-1.97V5.51H1.07A9.973 9.973 0 000 10c0 1.61.39 3.14 1.07 4.49l3.24-2.52c-.2-.62-.32-1.28-.32-1.97z" />
                <path fill="#EA4335"
                    d="M10 3.88c1.88 0 3.13.81 3.85 1.48l2.84-2.76C14.96.99 12.7 0 10 0 6.09 0 2.72 2.25 1.07 5.51l3.24 2.52C5.12 5.62 7.36 3.88 10 3.88z" />
            </svg>
            Google
        </a>

        <p class="footer-text">Belum punya akun? <a href="register.html">Daftar</a></p>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bx-show', 'bx-hide');
            } else {
                input.type = 'password';
                icon.classList.replace('bx-hide', 'bx-show');
            }
        }
    </script>
    @include('sweetalert::alert')
    
@endsection
