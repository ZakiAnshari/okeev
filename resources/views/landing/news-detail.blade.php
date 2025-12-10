@extends('layout.user')
@section('title', 'news-detail')
@section('content')
    <br><br>
    <section class="py-5 mt-5">
        <div class="container">

            <!-- Back Button -->
            <a href="/News" class="text-decoration-none mb-3 d-inline-block">
                ← Detail News
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

        </div>
    </section>

@endsection
