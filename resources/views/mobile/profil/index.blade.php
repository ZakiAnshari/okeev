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

        /* Modal Styling */
        .modal-content {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: 1px solid #f0f0f0;
            padding: 16px;
        }

        .modal-title {
            font-weight: 600;
            color: var(--dark-bg);
            font-size: 18px;
        }

        .modal-body {
            padding: 24px 16px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #1DCDFE;
            box-shadow: 0 0 0 3px rgba(29, 205, 254, 0.1);
        }

        .modal-footer {
            border-top: 1px solid #f0f0f0;
            padding: 16px;
            display: flex;
            gap: 8px;
        }

        .modal-footer .btn {
            border-radius: 8px;
            padding: 8px 16px;
        }

        .btn-primary {
            background-color: #1DCDFE;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--dark-bg);
        }

        .btn-secondary {
            background-color: #37474f;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #263238;
        }

        /* Error styling */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
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
                        <img src="{{ Auth::user()->image_provile
                            ? asset('storage/' . Auth::user()->image_provile)
                            : asset('front_end/assets/images/hero/mobil.png') }}"
                            alt="Profile">
                    </div>

                    <div class="profile-info">
                        <h2 class="mb-1">{{ $user->first_name }}</h2>
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
                        <p class="mb-0">{{ $user->city }}</p>
                    </div>

                </div>




                <div class="button-group">
                    <button class="btn btn-edit" style="border-radius: 20px" data-bs-toggle="modal"
                        data-bs-target="#editProfileModal">
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

        <!-- Edit Profile Modal -->
        @auth
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profilestorem.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        id="first_name" name="first_name"
                                        value="{{ old('first_name', Auth::user()->first_name ?? '') }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact</label>
                                    <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                        id="contact" name="contact" value="{{ old('contact', Auth::user()->contact ?? '') }}"
                                        required>
                                    @error('contact')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City / Address</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        id="city" name="city" value="{{ old('city', Auth::user()->city ?? '') }}">
                                    @error('city')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image_provile" class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control @error('image_provile') is-invalid @enderror"
                                        id="image_provile" name="image_provile" accept="image/*">
                                    <small class="text-muted">Leave blank if you don't want to change</small>

                                    {{-- Preview hasil kompres --}}
                                    <div id="preview-wrapper" style="display:none; margin-top:10px;">
                                        <img id="preview-img"
                                            style="max-width:120px; border-radius:8px; border:1px solid #ddd;">
                                        <div id="compress-info" style="font-size:12px; color:#888; margin-top:4px;"></div>
                                    </div>

                                    {{-- Input hidden yang dikirim ke server --}}
                                    <input type="hidden" name="image_provile_compressed" id="image_provile_compressed">

                                    @error('image_provile')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <script>
                                    document.getElementById('image_provile').addEventListener('change', function(e) {
                                        const file = e.target.files[0];
                                        if (!file) return;

                                        const MAX_SIZE_KB = 500; // target maksimal ukuran (KB)
                                        const MAX_WIDTH = 800; // maksimal lebar (px)
                                        const QUALITY = 0.8; // kualitas jpeg (0.0 - 1.0)

                                        const originalKB = (file.size / 1024).toFixed(1);

                                        const reader = new FileReader();
                                        reader.onload = function(event) {
                                            const img = new Image();
                                            img.onload = function() {
                                                // Hitung ukuran baru
                                                let width = img.width;
                                                let height = img.height;

                                                if (width > MAX_WIDTH) {
                                                    height = Math.round((height * MAX_WIDTH) / width);
                                                    width = MAX_WIDTH;
                                                }

                                                // Gambar ke canvas
                                                const canvas = document.createElement('canvas');
                                                canvas.width = width;
                                                canvas.height = height;
                                                const ctx = canvas.getContext('2d');
                                                ctx.drawImage(img, 0, 0, width, height);

                                                // Kompres dengan turunkan quality sampai target tercapai
                                                let quality = QUALITY;
                                                let base64 = canvas.toDataURL('image/jpeg', quality);
                                                let compressedKB = (base64.length * 0.75 / 1024).toFixed(1);

                                                while (compressedKB > MAX_SIZE_KB && quality > 0.1) {
                                                    quality -= 0.05;
                                                    base64 = canvas.toDataURL('image/jpeg', quality);
                                                    compressedKB = (base64.length * 0.75 / 1024).toFixed(1);
                                                }

                                                // Simpan ke input hidden
                                                document.getElementById('image_provile_compressed').value = base64;

                                                // Tampilkan preview
                                                document.getElementById('preview-img').src = base64;
                                                document.getElementById('preview-wrapper').style.display = 'block';
                                                document.getElementById('compress-info').textContent =
                                                    `Sebelum: ${originalKB} KB → Sesudah: ${compressedKB} KB`;
                                            };
                                            img.src = event.target.result;
                                        };
                                        reader.readAsDataURL(file);
                                    });
                                </script>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endauth


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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
