@extends('layout.mobile.app')
@section('title', 'Profil')
@section('content')
    <style>
        :root {
            --primary-blue: #213A94;
            --dark-bg: #30445C;
            --light-green: #35F5C6;
        }


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            padding-top: 0px !important;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            background-color: white;
            min-height: 100vh;
        }

        .header {
            display: flex;
            align-items: center;
            padding: 16px;
            background-color: white;
            /* border-bottom: 1px solid #e0e0e0; */
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #333;
            padding: 8px;
            margin-right: 16px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .profile-section {
            padding: 24px 16px;
            text-align: left;
        }

        .profile-header {
            /* display: flex; */
            align-items: center;
            margin-bottom: 24px;
        }

        .profile-pic {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin-right: 16px;
            overflow: hidden;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info h2 {
            font-size: 20px;
            color: var(--dark-bg);
            margin-bottom: 4px;
        }

        .profile-info p {
            font-size: 14px;
            color: #666;
        }

        .contact-info {
            margin-bottom: 24px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            padding: 3px 0;
            color: #333;
            font-size: 15px;
        }

        .contact-item svg {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .phone-icon {
            color: var(--dark-bg);
        }

        .location-icon {
            color: #f44336;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 24px;
        }

        .btn {
            padding: 7px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: #1DCDFE;

            color: white;
        }

        .btn-edit:hover {
            background-color: var(--dark-bg);
        }

        .btn-logout {
            background-color: #37474f;
            color: white;
        }

        .btn-logout:hover {
            background-color: var(--dark-bg);
        }

        .btn svg {
            width: 18px;
            height: 18px;
            margin-right: 8px;
        }

        .menu-section {
            border-top: 8px solid #f5f5f5;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .menu-item:hover {
            background-color: #f9f9f9;
        }

        .menu-icon {
            width: 24px;
            height: 24px;
            background-color: #37474f;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
            font-size: 14px;
        }

        .menu-text {
            font-size: 15px;
            color: #333;
        }

        .success-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4caf50;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            display: none;
            z-index: 1000;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                top: -50px;
                opacity: 0;
            }

            to {
                top: 20px;
                opacity: 1;
            }
        }

        .success-message.show {
            display: block;
        }

        .header {
            position: relative;
            display: flex;
            align-items: center;
            height: 56px;
            padding: 0 16px;
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            z-index: 2;
        }

        .header-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
            font-weight: 600;
        }

        .menu-section a {
            text-decoration: none;
            color: inherit;
        }
    </style>
    <div class="container">
        <div class="header">
            <a href="{{ route('mobile.home') }}" class="back-btn">←</a>
            <div class="header-title">Profile</div>
        </div>


        @auth
            <div class="profile-section">
                <div class="profile-row mb-4">
                    @php
                        $user = auth()->user();
                    @endphp

                    <div class="profile-pic">
                        <img src="{{ $user->image_provile
                            ? asset('storage/' . $user->image_provile)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=667eea&color=fff' }}"
                            alt="Profile">
                    </div>

                    <div class="profile-info">
                        <h2 class="mb-1">{{ $user->name }}</h2>
                        <p class="mb-0">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="profile-info mb-3">

                    <div class="profile-info-item mb-2">
                        <img src="{{ asset('front_end/assets/images/logo/mobile/ic_baseline-phone.jpg') }}" alt="Phone"
                            class="profile-icon-img">
                        <p class="mb-0">{{ $user->contact }}</p>
                    </div>

                    <div class="profile-info-item">
                        <img src="{{ asset('front_end/assets/images/logo/mobile/gridicons_location.jpg') }}" alt="Location"
                            class="profile-icon-img">
                        <p class="mb-0">{{ $user->contact }}</p>
                    </div>

                </div>




                <div class="button-group">
                    <button class="btn btn-edit" style="border-radius: 20px" onclick="editProfile()">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                        </svg>
                        Edit
                    </button>

                    <form action="{{ route('mobile.logout') }}" method="POST" id="logout-form" style="display:inline;">
                        @csrf
                        <button type="button" class="btn btn-logout w-100" style="border-radius: 20px"
                            onclick="confirmLogout(event)">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9-2 2 2h8v-2H4V5z" />
                            </svg>
                            Log Out
                        </button>
                    </form>

                </div>
            </div>
        @endauth

        @guest
            <div class="okeev-welcome-bar">
                <div class="okeev-welcome-text">
                    Halo, Selamat datang di <strong>Okeev!</strong>
                </div>
                <a href="{{ route('login.index') }}" class="okeev-welcome-btn">
                    LOGIN
                </a>
            </div>
        @endguest


        <div class="menu-section">
            <a href="{{ route('about.show') }}">
                <div class="menu-item">
                    <div class="menu-icon">i</div>
                    <div class="menu-text">About OKEEV</div>
                </div>
            </a>

            <a href="{{ route('contact.index') }}">
                <div class="menu-item">
                    <svg class="phone-icon" fill="currentColor" viewBox="0 0 24 24"
                        style="width: 20px; height: 20px; margin-right: 12px; flex-shrink: 0;">
                        <path
                            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                    </svg>
                    <div class="menu-text">Contact OKEEV</div>
                </div>
            </a>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmLogout(event) {
            event.preventDefault(); // cegah submit default

            Swal.fire({
                title: 'Yakin ingin logout?',
                text: "Kamu akan keluar dari akun ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

    @include('sweetalert::alert')

@endsection
