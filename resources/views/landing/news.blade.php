@extends('layout.user')
@section('title', 'news')
@section('content')
    <br><br>
    <section class="py-5 mt-5" style="background:#f6f7f9;">
        <!-- Title -->
        <h2 class="text-center fw-bold mb-5" style="color:#30445C;">News</h2>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="row g-4">
                @forelse($news->where('status', 'published') as $item)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <a href="{{ route('News.detail', $item->slug) }}">
                                <div class="rounded-top-4 overflow-hidden" style="height: 250px;">
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-100 h-100"
                                        style="object-fit: cover;">
                                </div>
                            </a>


                            <div class="card-body">
                                <a href="{{ route('News.detail', $item->slug) }}">
                                    <h6 class="fw-semibold mb-3" style="color:#1a2a3a;">
                                        {{ $item->title }}
                                    </h6>
                                </a>
                                <div class="d-flex justify-content-between align-items-center text-muted"
                                    style="font-size:14px;">
                                    <span>{{ \Carbon\Carbon::parse($item->published_at)->format('M d, Y') }}</span>

                                    <div class="d-flex gap-3">
                                        <i class="bi bi-share share-btn" style="cursor:pointer;"></i>
                                        <i class="bi bi-bookmark bookmark-btn" style="cursor:pointer;"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                @empty
                    <p class="text-center">Tidak ada News untuk Hari ini.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        // SHARE BUTTON
        document.querySelectorAll('.share-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const url = window.location.href;

                if (navigator.share) {
                    navigator.share({
                        title: "Bagikan Berita",
                        url: url
                    });
                } else {
                    navigator.clipboard.writeText(url);
                    alert("Link sudah disalin!");
                }
            });
        });

        // BOOKMARK BUTTON
        document.querySelectorAll('.bookmark-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle("bi-bookmark");
                this.classList.toggle("bi-bookmark-fill");
            });
        });
    </script>

@endsection
