@extends('themes.medicio.layouts.main')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="title" content="{{ $page->title }}">
    <meta name="description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta name="keywords" content="{{ implode(',', $page->tags ?? ['blog', 'post']) }}">
    <meta name="author" content="{{ $page->author ?? 'Admin' }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta property="og:image" content="{{ $page->image }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="Your Website Name">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta name="twitter:image" content="{{ $page->image }}">
@endpush

@push('styles')
    <style>
        .article-content {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .article-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .share-buttons {
            padding: 20px 0;
            border-top: 1px solid #eee;
            margin-top: 30px;
        }

        .share-buttons span {
            font-weight: 600;
            color: #333;
            margin-right: 15px;
        }

        .share-buttons a {
            margin-right: 10px;
            transition: opacity 0.3s ease;
        }

        .share-buttons a:hover {
            opacity: 0.8;
        }

        .comments-section {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .comment {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .comment strong {
            color: #5DB996;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #5DB996;
            box-shadow: 0 0 0 0.2rem rgba(255, 157, 35, 0.25);
        }

        .btn-submit {
            background: #5DB996;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            transition: background 0.3s ease;
        }

        .btn-submit:hover {
            background: #e88b15;
        }

        /* Breadcrumb styles */
        .breadcrumbs {
            background: #fff;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .breadcrumbs h2 {
            color: #5DB996;
            margin: 0;
        }

        .breadcrumbs ol {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .breadcrumbs ol li {
            display: inline-block;
        }

        .breadcrumbs ol li+li {
            padding-left: 10px;
        }

        .breadcrumbs ol li+li::before {
            display: inline-block;
            padding-right: 10px;
            color: #777;
            content: "/";
        }

        .breadcrumbs ol li a {
            color: #777;
            text-decoration: none;
        }

        .breadcrumbs ol li a:hover {
            color: #5DB996;
        }

        /* Alert styles */
        .alert-success {
            background-color: #e8f5e9;
            border-color: #c8e6c9;
            color: #2e7d32;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        /* Content styling */
        .content h1,
        .content h2,
        .content h3,
        .content h4,
        .content h5,
        .content h6 {
            color: #333;
            margin-bottom: 15px;
        }

        .content p {
            color: #666;
            line-height: 1.7;
            margin-bottom: 15px;
        }

        .content a {
            color: #5DB996;
            text-decoration: none;
        }

        .content a:hover {
            text-decoration: underline;
        }

        .share-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .share-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .share-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .share-btn {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .share-btn:hover {
            opacity: 0.5;
            color: #fff;
        }

        .share-btn i {
            margin-right: 8px;
        }

        .btn-facebook {
            background-color: #1877f2;
        }

        .btn-twitter {
            background-color: #000000;
        }

        .btn-whatsapp {
            background-color: #25d366;
        }

        .btn-telegram {
            background-color: #0088cc;
        }
    </style>
@endpush

@section('main')
    <main id="main">
        <!-- Breadcrumbs -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>{{ $page->title }}</h2>

                </div>
            </div>
        </section>

        <!-- Article Section -->
        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <article class="article-content">
                            <img src="{{ $page->image }}" alt="{{ $page->title }}" class="article-image">
                            <h2>{{ $page->title }}</h2>
                            <div class="content">
                                {!! $page->content !!}
                            </div>

                            <!-- Share Section -->
                            <div class="share-section mt-4">
                                <h4 class="share-title">{{ __('frontend/post.share') }}</h4>
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                        target="_blank" class="share-btn btn-facebook">
                                        <i class="bi bi-facebook"></i> Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($page->title) }}"
                                        target="_blank" class="share-btn btn-twitter">
                                        <i class="bi bi-twitter-x"></i> Twitter
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' ' . request()->url()) }}"
                                        target="_blank" class="share-btn btn-whatsapp">
                                        <i class="bi bi-whatsapp"></i> WhatsApp
                                    </a>
                                    <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($page->title) }}"
                                        target="_blank" class="share-btn btn-telegram">
                                        <i class="bi bi-telegram"></i> Telegram
                                    </a>
                                </div>
                            </div>
                        </article>

                        @if ($page->comments_is_active)
                            <div class="comments-section mt-5">
                                <h3>{{ __('frontend/post.comments_title', ['count' => $comments->count()]) }}</h3>

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ __('frontend/post.comment_success') }}
                                    </div>
                                @endif

                                <ul class="list-unstyled mt-4">
                                    @foreach ($comments as $comment)
                                        <li class="comment mb-4">
                                            <strong>{{ $comment->name }}</strong>
                                            <span class="text-muted d-block small">
                                                {{ $comment->created_at->format('F d, Y h:i A') }}
                                            </span>
                                            <p class="mt-2">{{ $comment->content }}</p>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="comment-form mt-5">
                                    <h4 class="mb-4">{{ __('frontend/post.leave_comment') }}</h4>
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $page->id }}">

                                        <div class="form-group mb-3">
                                            <label for="name">{{ __('frontend/post.your_name') }}</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="email">{{ __('frontend/post.your_email') }}</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="content">{{ __('frontend/post.your_comment') }}</label>
                                            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            {!! ReCaptcha::htmlScriptTagJsApi() !!}
                                            {!! ReCaptcha::htmlFormSnippet() !!}
                                            @error('g-recaptcha-response')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-submit">
                                            {{ __('frontend/post.submit') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        @include('themes.medicio.layouts.sidebar')
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
