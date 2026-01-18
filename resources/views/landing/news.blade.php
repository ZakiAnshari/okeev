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
                                        <i class="bi bi-share share-btn" style="cursor:pointer;" data-url="{{ route('News.detail', $item->slug) }}" data-title="{{ $item->title }}"></i>
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

    <!-- Share modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bagikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="d-flex justify-content-around mb-3">
                        <a id="share-whatsapp" class="btn btn-outline-success" target="_blank" rel="noopener"><i class="bi bi-whatsapp me-1"></i>WhatsApp</a>
                        <a id="share-twitter" class="btn btn-outline-info" target="_blank" rel="noopener"><i class="bi bi-twitter me-1"></i>Twitter</a>
                    </div>
                    <div class="d-flex justify-content-around mb-3">
                        <a id="share-facebook" class="btn btn-outline-primary" target="_blank" rel="noopener"><i class="bi bi-facebook me-1"></i>Facebook</a>
                        <a id="share-linkedin" class="btn btn-outline-secondary" target="_blank" rel="noopener"><i class="bi bi-linkedin me-1"></i>LinkedIn</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button id="share-copy-btn" class="btn btn-sm btn-outline-dark"><i class="bi bi-clipboard me-1"></i>Copy Link</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SHARE BUTTON: supports Web Share API or fallback to modal with social links + copy
        document.querySelectorAll('.share-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const url = this.dataset.url || window.location.href;
                const title = this.dataset.title || document.title;

                if (navigator.share) {
                    navigator.share({ title: title, url: url }).catch(() => {});
                    return;
                }

                // populate modal links
                const encoded = encodeURIComponent(url);
                const encodedTitle = encodeURIComponent(title);
                document.getElementById('share-whatsapp').href = `https://wa.me/?text=${encodedTitle}%20-%20${encoded}`;
                document.getElementById('share-twitter').href = `https://twitter.com/intent/tweet?text=${encodedTitle}&url=${encoded}`;
                document.getElementById('share-facebook').href = `https://www.facebook.com/sharer/sharer.php?u=${encoded}`;
                document.getElementById('share-linkedin').href = `https://www.linkedin.com/sharing/share-offsite/?url=${encoded}`;

                // show modal
                const modalEl = document.getElementById('shareModal');
                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // copy handler
                const copyBtn = document.getElementById('share-copy-btn');
                copyBtn.onclick = function() {
                        if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(url).then(() => {
                            Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Link disalin ke clipboard', timer: 1400, showConfirmButton: false });
                            // close modal
                            try { bootstrap.Modal.getInstance(document.getElementById('shareModal')).hide(); } catch(e){}
                        }).catch(() => {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal menyalin link' });
                        });
                    } else {
                        // fallback
                        const ta = document.createElement('textarea');
                        ta.value = url;
                        document.body.appendChild(ta);
                        ta.select();
                        try { document.execCommand('copy'); Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Link disalin ke clipboard', timer: 1400, showConfirmButton: false }); } catch(e){ Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal menyalin link' }); }
                        ta.remove();
                    }
                };
            });
        });

        // BOOKMARK BUTTON
        document.querySelectorAll('.bookmark-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('bi-bookmark');
                this.classList.toggle('bi-bookmark-fill');
            });
        });
    </script>

@endsection
