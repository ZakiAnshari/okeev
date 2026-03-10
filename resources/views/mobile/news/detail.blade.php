@extends('layout.mobile.app')
@section('title', 'Detail')
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
            background-color: white;
            min-height: 100vh;
            padding-top: 0px !important;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            min-height: 100vh;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            background-color: white;
            border-bottom: 1px solid #e0e0e0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            height: 56px;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            position: relative;
        }

        .back-btn-img {
            position: absolute;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
        }

        .back-icon {
            width: 24px;
            height: 24px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .article-content {
            padding: 20px;
            margin-top: 56px;
        }

        .article-title {
            font-size: 22px;
            font-weight: 700;
            color: #333;
            line-height: 1.4;
            margin-bottom: 16px;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #666;
        }

        .author-link {
            color: var(--light-green);
            text-decoration: none;
            font-weight: 500;
        }

        .author-link:hover {
            text-decoration: underline;
        }

        .article-image {
            width: 100%;
            height: auto;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .article-body {
            font-size: 15px;
            line-height: 1.8;
            color: #333;
        }

        .article-body p {
            margin-bottom: 16px;
        }

        .article-body h3 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-top: 24px;
            margin-bottom: 12px;
        }

        .article-body ul {
            margin-bottom: 16px;
        }

        .article-body li {
            margin-bottom: 8px;
        }

        .highlight-text {
            color: var(--light-green);
            font-weight: 600;
        }

        .link-text {
            color: var(--primary-blue);
            text-decoration: none;
        }

        .link-text:hover {
            text-decoration: underline;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 200;
        }

        .bottom-nav-container {
            max-width: 480px;
            margin: 0 auto;
            display: flex;
            justify-content: space-around;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 8px 16px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #999;
        }

        .nav-item:hover,
        .nav-item.active {
            color: var(--light-green);
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            margin-bottom: 4px;
        }

        .nav-label {
            font-size: 11px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 16px;
        }

        .btn-action {
            width: 140px;
            height: 48px;
            background-color: #f2f2f2;
            border: none;
            border-radius: 8px;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-action:hover {
            background-color: #e0e0e0;
        }

        .btn-action:active {
            transform: scale(0.97);
        }

        .btn-action i {
            font-size: 22px;
            color: #9e9e9e;
            pointer-events: none;
            /* Agar klik tidak landing di icon, tapi di button */
        }

        /* Like aktif */
        .btn-action.liked {
            background-color: #e6f0ff;
            border: 1px solid rgba(26, 115, 232, 0.15);
        }

        .btn-action.liked i {
            color: #1a73e8;
        }

        /* Toast */
        .toast-notify {
            position: fixed;
            top: 72px;
            right: 16px;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            z-index: 9999;
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity 0.18s ease, transform 0.18s ease;
            pointer-events: none;
        }

        .toast-notify.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Share Menu */
        .share-menu {
            position: fixed;
            top: 100px;
            right: 20px;
            background: #fff;
            border: 1px solid #eee;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
            padding: 8px;
            border-radius: 10px;
            z-index: 9998;
            display: flex;
            flex-direction: column;
            gap: 6px;
            min-width: 160px;
        }

        .share-menu button {
            padding: 10px 14px;
            border-radius: 6px;
            border: none;
            background: #f7f7f7;
            cursor: pointer;
            text-align: left;
            font-size: 14px;
            transition: background 0.15s;
        }

        .share-menu button:hover {
            background: #ebebeb;
        }
    </style>

    <div class="container">
        <div class="header">
            <div class=" header-container">
                <a href="{{ route('newss.show') }}" class="back-btn-img">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
                </a>
                <div class="header-title">Detail News</div>
            </div>
        </div>

        <div class="article-content">
            <h1 class="article-title">{{ $news->title }}</h1>

            <div class="article-meta">
                <span>By <a href="#" class="author-link">{{ $news->author }}</a></span>
                <span>•</span>
                <span>Published: {{ \Carbon\Carbon::parse($news->published_at)->format('M d, Y') }}</span>
            </div>

            <div class="action-buttons mb-3">
                <button type="button" class="btn-action btn-like" data-id="{{ $news->id }}" title="Like this article">
                    <i class="bx bx-like"></i>
                </button>

                <button type="button" class="btn-action btn-share" data-url="{{ route('newssdetail.show', $news->slug) }}"
                    data-title="{{ $news->title }}" title="Share this article">
                    <i class="bx bx-share-alt"></i>
                </button>
            </div>

            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" class="article-image">

            <div class="article-body">
                {!! $news->content !!}
            </div>
        </div>
    </div>

    <script>
        // =============================================
        // TOAST
        // =============================================
        function showToast(message) {
            let t = document.querySelector('.toast-notify');
            if (!t) {
                t = document.createElement('div');
                t.className = 'toast-notify';
                document.body.appendChild(t);
            }
            t.textContent = message;
            t.classList.add('show');
            clearTimeout(t._timeout);
            t._timeout = setTimeout(() => t.classList.remove('show'), 2000);
        }

        // =============================================
        // SATU event listener untuk semua klik
        // =============================================
        document.addEventListener('click', function(e) {

            // --- LIKE ---
            const likeBtn = e.target.closest('.btn-like');
            if (likeBtn) {
                e.preventDefault();
                e.stopPropagation();

                const newsId = likeBtn.dataset.id;
                if (!newsId) {
                    console.warn('btn-like tidak punya data-id');
                    return;
                }

                const key = 'liked_' + newsId;
                const isLiked = localStorage.getItem(key) === '1';

                if (isLiked) {
                    localStorage.removeItem(key);
                    likeBtn.classList.remove('liked');
                    showToast('Like dibatalkan.');
                } else {
                    localStorage.setItem(key, '1');
                    likeBtn.classList.add('liked');
                    showToast('❤️ Kamu menyukai artikel ini!');
                }
                return;
            }

            // --- SHARE ---
            const shareBtn = e.target.closest('.btn-share');
            if (shareBtn) {
                e.preventDefault();
                e.stopPropagation();

                const url = shareBtn.dataset.url;
                const title = shareBtn.dataset.title;
                if (!url) {
                    console.warn('btn-share tidak punya data-url');
                    return;
                }

                if (navigator.share) {
                    navigator.share({
                            title: title,
                            text: title,
                            url: url
                        })
                        .catch(() => openShareMenu(url, title));
                } else {
                    openShareMenu(url, title);
                }
                return;
            }
        });

        function openShareMenu(url, title) {
            const old = document.querySelector('.share-menu');
            if (old) old.remove();

            const menu = document.createElement('div');
            menu.className = 'share-menu';

            const items = [{
                    label: '📱 WhatsApp',
                    action: () => window.open('https://wa.me/?text=' + encodeURIComponent((title ? title + '\n' : '') +
                        url), '_blank')
                },
                {
                    label: '✈️ Telegram',
                    action: () => window.open('https://t.me/share/url?url=' + encodeURIComponent(url) + '&text=' +
                        encodeURIComponent(title || ''), '_blank')
                },
                {
                    label: '📋 Salin Link',
                    action: () => {
                        if (navigator.clipboard) {
                            navigator.clipboard.writeText(url).then(() => showToast('Link berhasil disalin!'));
                        } else {
                            const ta = document.createElement('textarea');
                            ta.value = url;
                            document.body.appendChild(ta);
                            ta.select();
                            try {
                                document.execCommand('copy');
                                showToast('Link berhasil disalin!');
                            } catch {}
                            document.body.removeChild(ta);
                        }
                    }
                },
                {
                    label: '✕ Tutup',
                    action: null
                }
            ];

            items.forEach(item => {
                const b = document.createElement('button');
                b.textContent = item.label;
                b.onclick = (e) => {
                    e.stopPropagation();
                    if (item.action) item.action();
                    menu.remove();
                };
                menu.appendChild(b);
            });

            document.body.appendChild(menu);

            setTimeout(() => {
                document.addEventListener('click', function closeMenu(e) {
                    if (!menu.contains(e.target)) {
                        menu.remove();
                        document.removeEventListener('click', closeMenu);
                    }
                });
            }, 100);
        }

        // =============================================
        // INIT — restore state like saat halaman load
        // =============================================
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-like[data-id]').forEach(btn => {
                if (localStorage.getItem('liked_' + btn.dataset.id) === '1') {
                    btn.classList.add('liked');
                }
            });
        });
    </script>
@endsection
