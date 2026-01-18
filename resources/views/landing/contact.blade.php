@extends('layout.user')
@section('title', 'contact')
@section('content')

    <section class="py-5 contact-section">
        <div class="container">
            <div class="row g-5 align-items-start">
                <!-- LEFT CONTENT -->
                <div class="col-lg-6">
                    @php $homeContact = \App\Models\HomeContact::first(); @endphp
                    <h2 class="fw-bold mb-3" style="color:#232b44; font-size: 42px;">Contact Us</h2>
                    <p class="C sectmb-4 mb-4" style="color:#6c748a;">
                        @if($homeContact && $homeContact->description)
                            {!! nl2br(e($homeContact->description)) !!}
                        @else
                            Lorem ipsum dolor sit amet consectetur. Id condimentum sed elit sagittis senectus feugiat.
                            Congue erat sem tincidunt nulla sed mattis. Velit et gravida sit.
                        @endif
                    </p>

                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-center gap-2">
                            <i class="bx bxl-instagram" style="font-size: 24px; color:#00f2ea;"></i>
                            <span>{{ $homeContact->instagram ?? 'okeev.ig' }}</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center gap-2">
                            <i class="bx bxl-tiktok" style="font-size: 24px; color:#00f2ea;"></i>
                            <span>{{ $homeContact->tiktok ?? 'okeev.tiktok' }}</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center gap-2">
                            <i class="bx bxl-xing" style="font-size: 24px; color:#00f2ea;"></i>
                            <span>{{ $homeContact->x ?? 'okeev.x' }}</span>
                        </li>
                    </ul>
                </div>

                <!-- RIGHT FORM CARD -->
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 shadow" style="background:#1e2a45; border-radius: 12px;">
                        <form action="{{ url('contact-add') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                <div class="col-md-6 mb-3">
                                    <label class="text-light mb-1">Name</label>
                                    <input type="text" name="name" class="form-control custom-input"
                                        value="{{ old('name') }}" placeholder="Enter your name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="text-light mb-1">Email</label>
                                    <input type="email" name="email" class="form-control custom-input"
                                        value="{{ old('email') }}" placeholder="Enter your email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="text-light mb-1">Phone</label>
                                    <input type="text" name="phone" class="form-control custom-input"
                                        value="{{ old('phone') }}" placeholder="+62">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="text-light mb-1">Subject</label>
                                    <input type="text" name="subject" class="form-control custom-input"
                                        value="{{ old('subject') }}" placeholder="Ex. Career">
                                    @error('subject')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="text-light mb-1">Message</label>
                                    <textarea name="message" class="form-control custom-input" rows="4" placeholder="Type your message here...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12 text-start mt-4">
                                    <button type="submit" class="btn px-4 py-2 w-auto"
                                        style="background:#00f2ea;border:none;font-weight:600;border-radius:8px;">
                                        Send message
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- PETA --}}
    <!-- SECTION PETA -->
    <section class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <!-- Div Map -->
                    <div id="map" style="height: 450px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Koordinat dari Google Maps (Menara Astra)
        const lat = -6.2075383;
        const lng = 106.8219314;

        // Inisialisasi peta
        const map = L.map('map').setView([lat, lng], 17);

        // Tile Layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 29,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Marker
        L.marker([lat, lng])
            .addTo(map)
            .bindPopup('Menara Astra<br>Jakarta Pusat')
            .openPopup();
    </script>


@endsection
