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
            /* background-color: white; */
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
            /* margin-left: 20px; */
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
            /* padding: 12px 0; */
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

        .nav-item:hover {
            color: var(--light-green);
        }

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
        }

        /* Liked state */
        .btn-action.liked {
            background-color: #e6f0ff;
            border: 1px solid rgba(26, 115, 232, 0.15);
        }

        .btn-action.liked i {
            color: #1a73e8;
        }

        /* Toast notification */
        .toast-notify {
            position: fixed;
            top: 72px;
            right: 16px;
            background: rgba(0,0,0,0.8);
            color: #fff;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            z-index: 9999;
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity 0.18s ease, transform 0.18s ease;
        }

        .toast-notify.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Simple share menu (fallback) */
        .share-menu {
            position: absolute;
            background: #fff;
            border: 1px solid #eee;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            padding: 8px;
            border-radius: 8px;
            z-index: 9998;
            display: flex;
            gap: 8px;
        }

        .share-menu button {
            padding: 8px 10px;
            border-radius: 6px;
            border: none;
            background: #f7f7f7;
            cursor: pointer;
        }

        .header {
            height: 56px;
            /* tinggi header */
        }
    </style>
    <div class="container">
        <div class="header ">
            <div class="container header-container">
                <a href="{{ route('newss.show') }}" class="back-btn-img">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
                </a>
                <div class="header-title">Detail News</div>
            </div>
        </div>
        {{-- <div class="header">
            <a href="{{ route('newss.show') }}" class="back-btn">←</a>

            <div class="header-title absolute-center">Detail News</div>
        </div> --}}

        <div class="article-content">
            <h1 class="article-title"> {{ $news->title }}</h1>
            <div class="article-meta">
                <span>By <a href="#" class="author-link">{{ $news->author }}</a></span>
                <span>•</span>
                <span>Published: {{ \Carbon\Carbon::parse($news->published_at)->format('M d, Y') }}</span>
            </div>
            <div class="action-buttons mb-3">
                <button type="button" class="btn-action btn-like" onclick="handleLike(event, {{ $news->id }})" title="Like this article">
                    <i class="bx bx-like"></i>
                </button>

                <button type="button" class="btn-action btn-share" onclick="handleShare(event, {!! json_encode(route('newssdetail.show', $news->slug)) !!}, {!! json_encode($news->title) !!})" title="Share this article">
                    <i class="bx bx-share-alt"></i>
                </button>
            </div>






            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="Rivian R1T" class="article-image">

            <div class="article-body">
                {!! $news->content !!}
            </div>
        </div>
    </div>

    <script>
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
            t._timeout = setTimeout(() => t.classList.remove('show'), 1800);
        }

        function handleLike(event, newsId) {
            event.preventDefault();
            event.stopPropagation();

            const btn = event.currentTarget || event.target.closest('.btn-action');
            if (!btn) return;

            const key = 'liked_' + newsId;
            const isLiked = localStorage.getItem(key) === '1';

            if (isLiked) {
                localStorage.removeItem(key);
                btn.classList.remove('liked');
                showToast('Removed like');
            } else {
                localStorage.setItem(key, '1');
                btn.classList.add('liked');
                showToast('Added to likes');
            }

            // Optional: send to server
            // fetch(`/api/news/${newsId}/like`, { method: 'POST' });
        }

        function handleShare(event, url, title) {
            event.preventDefault();
            event.stopPropagation();

            // url may be absolute (route()) or relative
            const fullUrl = (/^https?:\/\//i.test(url)) ? url : (window.location.origin + url);

            if (navigator.share) {
                navigator.share({
                    title: title || 'OKEEV News',
                    text: title || '',
                    url: fullUrl
                }).catch(() => {
                    // fallback
                    openShareFallback(fullUrl, title);
                });
            } else {
                openShareFallback(fullUrl, title);
            }
        }

        function openShareFallback(fullUrl, title) {
            // Small inline fallback chooser: WhatsApp, Telegram, Copy
            const menu = document.createElement('div');
            menu.className = 'share-menu';

            const waBtn = document.createElement('button');
            waBtn.textContent = 'WhatsApp';
            waBtn.onclick = () => {
                const waUrl = 'https://wa.me/?text=' + encodeURIComponent((title ? title + '\n' : '') + fullUrl);
                window.open(waUrl, '_blank');
                document.body.removeChild(menu);
            };

            const tgBtn = document.createElement('button');
            tgBtn.textContent = 'Telegram';
            tgBtn.onclick = () => {
                const tgUrl = 'https://t.me/share/url?url=' + encodeURIComponent(fullUrl) + '&text=' + encodeURIComponent(title || '');
                window.open(tgUrl, '_blank');
                document.body.removeChild(menu);
            };

            const copyBtn = document.createElement('button');
            copyBtn.textContent = 'Copy Link';
            copyBtn.onclick = () => {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(fullUrl).then(() => showToast('Link copied'));
                } else {
                    const ta = document.createElement('textarea');
                    ta.value = fullUrl;
                    document.body.appendChild(ta);
                    ta.select();
                    try { document.execCommand('copy'); showToast('Link copied'); } catch { alert(fullUrl); }
                    document.body.removeChild(ta);
                }
                if (menu.parentNode) document.body.removeChild(menu);
            };

            const closeBtn = document.createElement('button');
            closeBtn.textContent = 'Close';
            closeBtn.onclick = () => { if (menu.parentNode) document.body.removeChild(menu); };

            menu.appendChild(waBtn);
            menu.appendChild(tgBtn);
            menu.appendChild(copyBtn);
            menu.appendChild(closeBtn);

            // place menu near top-right for simplicity
            menu.style.top = (window.scrollY + 90) + 'px';
            menu.style.right = '16px';
            menu.style.position = 'fixed';

            document.body.appendChild(menu);
        }
    </script>
@endsection
