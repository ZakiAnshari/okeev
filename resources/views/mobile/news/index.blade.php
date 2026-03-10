@extends('layout.mobile.app')
@section('title', 'News')
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
            background-color: #f5f5f5;
            min-height: 100vh;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            /* background-color: white; */
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            padding: 16px;
        }

        .news-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .news-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-4px);
        }

        .news-image {
            width: 100%;
            height: 140px;
            overflow: hidden;
            background-color: #f0f0f0;
        }

        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .news-content {
            padding: 12px;
        }

        .news-title {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
        }

        .news-date {
            font-size: 11px;
            color: #999;
        }

        .news-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            color: #999;
            transition: color 0.3s ease;
        }

        .action-btn:hover {
            color: var(--light-green);
        }

        .action-btn svg {
            width: 16px;
            height: 16px;
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
    </style>
    <div class="container">
        <div class="header">
            <div class="header-title">News</div>
        </div>

        <div class="news-grid">
            <!-- News Cards -->
            @forelse($news->where('status', 'published') as $item)
                <a href="{{ route('newssdetail.show', $item->slug) }}" class="news-card">
                    <div class="news-image">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}">
                    </div>
                    <div class="news-content">
                        <div class="news-title">{{ $item->title }}</div>
                        <div class="news-footer">
                            <span
                                class="news-date">{{ \Carbon\Carbon::parse($item->published_at)->format('M d, Y') }}</span>
                            <div class="news-actions">
                                <button class="action-btn" onclick="shareNews(event, {{ $item->id }})"
                                    data-url="{{ route('News.detail', $item->slug) }}" data-title="{{ $item->title }}">
                                    <svg fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z" />
                                    </svg>
                                </button>
                                <button class="action-btn" onclick="bookmarkNews(event, {{ $item->id }})">
                                    <svg fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px; color: #999;">
                    <p>Tidak ada news untuk saat ini</p>
                </div>
            @endforelse
        </div>
    </div>
    <script>
        // ===== SHARE NEWS =====
        function shareNews(event, id) {
            event.stopPropagation();

            const btn = event.currentTarget;
            const url = btn.dataset.url;
            const title = btn.dataset.title;

            if (navigator.share) {
                // Web Share API (mobile/browser yang support)
                navigator.share({
                    title: title,
                    url: url
                }).catch(() => {});
            } else {
                // Fallback: copy link ke clipboard
                navigator.clipboard.writeText(url).then(() => {
                    showToast('Link berhasil disalin!');
                }).catch(() => {
                    // Fallback manual jika clipboard tidak support
                    const el = document.createElement('textarea');
                    el.value = url;
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);
                    showToast('Link berhasil disalin!');
                });
            }
        }

        // ===== BOOKMARK NEWS =====
        function bookmarkNews(event, id) {
            event.stopPropagation();

            const btn = event.currentTarget;
            const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
            const index = bookmarks.indexOf(id);

            if (index === -1) {
                // Belum di-bookmark → tambahkan
                bookmarks.push(id);
                localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
                btn.classList.add('bookmarked');
                showToast('Berita disimpan!');
            } else {
                // Sudah di-bookmark → hapus
                bookmarks.splice(index, 1);
                localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
                btn.classList.remove('bookmarked');
                showToast('Bookmark dihapus!');
            }
        }

        // ===== INIT BOOKMARK STATE (panggil saat halaman load) =====
        function initBookmarks() {
            const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
            document.querySelectorAll('[onclick^="bookmarkNews"]').forEach(btn => {
                const onclickAttr = btn.getAttribute('onclick');
                const idMatch = onclickAttr.match(/bookmarkNews\(event,\s*(\d+)\)/);
                if (idMatch) {
                    const id = parseInt(idMatch[1]);
                    if (bookmarks.includes(id)) {
                        btn.classList.add('bookmarked');
                    }
                }
            });
        }

        // ===== TOAST NOTIFICATION =====
        function showToast(message) {
            let toast = document.getElementById('toast-notif');
            if (!toast) {
                toast = document.createElement('div');
                toast.id = 'toast-notif';
                toast.style.cssText = `
            position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
            background: #333; color: #fff; padding: 10px 20px;
            border-radius: 8px; z-index: 9999; font-size: 14px;
            transition: opacity 0.3s ease;
        `;
                document.body.appendChild(toast);
            }
            toast.textContent = message;
            toast.style.opacity = '1';
            clearTimeout(toast._timeout);
            toast._timeout = setTimeout(() => toast.style.opacity = '0', 2500);
        }

        // Jalankan saat DOM siap
        document.addEventListener('DOMContentLoaded', initBookmarks);
    </script>
@endsection
