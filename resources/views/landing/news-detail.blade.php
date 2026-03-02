@extends('layout.user')
@section('title', 'news-detail')
@section('content')
    <br><br>
    <section class="py-5 mt-5">
        <div class="container">

            <!-- Back Button -->
            <a href="/News" class="text-decoration-none mb-3 d-inline-block">
                <i class="bi bi-arrow-left me-1"></i> Detail News
            </a>

            <!-- Title -->
            <h2 class="fw-bold mb-3">
                {{ $news->title }}
            </h2>

            <!-- Author + Date -->
            <p class="text-muted">
                By <span class="text-primary">{{ $news->author }}</span>
                <span class="ms-2">Published: {{ \Carbon\Carbon::parse($news->published_at)->format('M d, Y') }}</span>
            </p>

            <!-- Image -->
            <div class="my-4">
                <img src="{{ asset('storage/' . $news->thumbnail) }}" class="img-fluid rounded-4 shadow-sm w-100"
                    style="height: 500px; object-fit: cover;">
            </div>

            <!-- Content -->
            <!-- Subtitle / Description -->
            <div class="content">
                {!! $news->content !!}
            </div>

            <style>
                .content {
                    line-height: 1.8;
                    font-size: 16px;
                    color: #333;
                }

                .content p {
                    margin-bottom: 1.5rem;
                    text-align: justify;
                }

                .content h1,
                .content h2,
                .content h3,
                .content h4,
                .content h5,
                .content h6 {
                    margin-top: 1.5rem;
                    margin-bottom: 1rem;
                    font-weight: 600;
                    color: #30445C;
                }

                .content ul,
                .content ol {
                    margin-bottom: 1.5rem;
                    margin-left: 2rem;
                }

                .content li {
                    margin-bottom: 0.5rem;
                }

                .content img {
                    max-width: 100%;
                    height: auto;
                    margin: 1.5rem 0;
                    border-radius: 8px;
                }

                .content blockquote {
                    margin-left: 2rem;
                    padding-left: 1rem;
                    border-left: 4px solid #30445C;
                    font-style: italic;
                    color: #666;
                    margin-bottom: 1.5rem;
                }

                .content table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 1.5rem;
                }

                .content table th,
                .content table td {
                    border: 1px solid #ddd;
                    padding: 0.75rem;
                    text-align: left;
                }

                .content table th {
                    background-color: #f8f9fa;
                    font-weight: 600;
                }
            </style>

        </div>
    </section>

@endsection
