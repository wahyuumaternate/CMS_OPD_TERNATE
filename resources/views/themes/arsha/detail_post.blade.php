@extends('themes.arsha.layouts.main', ['title' => $page->title])

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

    <style>
        /* CRITICAL: Fix image overflow from TinyMCE */
        .content {
            overflow-x: hidden !important;
            word-wrap: break-word !important;
        }

        .content * {
            max-width: 100% !important;
            box-sizing: border-box !important;
        }

        .content img {
            max-width: 100% !important;
            width: 100% !important;
            height: auto !important;
            display: block !important;
            margin: 15px auto !important;
            border-radius: 5px;
        }

        .content figure {
            max-width: 100% !important;
            margin: 15px 0 !important;
            text-align: center !important;
        }

        .content figure img {
            max-width: 100% !important;
            width: 100% !important;
            height: auto !important;
        }

        .content table {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            display: block;
            white-space: nowrap;
        }

        .content iframe,
        .content video {
            max-width: 100% !important;
            height: auto;
        }

        /* Simple enhancements without breaking existing styles */
        .article {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .post-content {
            overflow: hidden !important;
            word-wrap: break-word !important;
        }

        .post-content *,
        .post-content img,
        .post-content figure,
        .post-content figure img,
        .post-content p img,
        .post-content div img {
            max-width: 100% !important;
            width: auto !important;
            height: auto !important;
            box-sizing: border-box !important;
        }

        /* Override semua inline style dari TinyMCE */
        .post-content img[style],
        .post-content img[width] {
            width: 100% !important;
            max-width: 100% !important;
            height: auto !important;
        }

        /* Table responsive */
        .post-content table {
            width: 100% !important;
            max-width: 100% !important;
            table-layout: auto !important;
            overflow-x: auto;
            display: block;
            white-space: nowrap;
        }

        .post-content iframe,
        .post-content video,
        .post-content embed,
        .post-content object {
            max-width: 100% !important;
            width: 100% !important;
            height: auto !important;
        }

        .article:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .article-content {
            padding: 30px;
        }

        .hero-img {
            position: relative;
            overflow: hidden;
        }

        .hero-img img {
            width: 100%;
            transition: transform 0.3s ease;
        }

        .hero-img:hover img {
            transform: scale(1.02);
        }

        .post-meta-enhanced {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #37517e;
        }

        .post-meta-enhanced .meta-item {
            display: inline-block;
            margin-right: 20px;
            color: #666;
            font-size: 14px;
        }

        .post-meta-enhanced .meta-item i {
            color: #37517e;
            margin-right: 5px;
        }

        .share-enhanced {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-top: 30px;
            text-align: center;
        }

        .share-enhanced h5 {
            color: #37517e;
            margin-bottom: 15px;
        }

        .share-btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 5px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        .share-facebook {
            background: #3b5998;
        }

        .share-twitter {
            background: #1da1f2;
        }

        .share-whatsapp {
            background: #25d366;
        }

        .share-instagram {
            background: #e4405f;
        }

        .comments-enhanced {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        background: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 15px;
        border-left: 4px solid #37517e;
        }

        .comments-enhanced .comment-item {
            color: #37517e;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .comments-enhanced .comment-date {
            color: #666;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .form-enhanced {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        margin-bottom: 20px;
        }

        .form-enhanced .form-group {
            color: #333;
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        .form-enhanced .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .form-enhanced .form-control:focus {
            border-color: #37517e;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(55, 81, 126, 0.25);
        }

        .btn-submit-enhanced {
            background: #37517e;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-submit-enhanced:hover {
            background: #2a3d63;
        }
    </style>
@endpush

@section('main')
    <main class="main">

        {{-- <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('posts.index') }}">Blog</a></li>
                        <li class="current">{{ Str::limit($page->title, 30) }}</li>
                    </ol>
                </nav>
                <h1>{{ $page->title }}</h1>
            </div>
        </div><!-- End Page Title --> --}}

        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Blog Details Section -->
                    <section id="blog-details" class="blog-details section">
                        <div class="container" data-aos="fade-up">

                            <article class="article">

                                <div class="hero-img" data-aos="zoom-in">
                                    <img src="{{ $page->image }}" alt="{{ $page->title }}" class="img-fluid"
                                        loading="lazy">
                                    <div class="meta-overlay">
                                        @if ($page->is_featured || $page->is_banner)
                                            <div style="margin-bottom: 10px;">
                                                @if ($page->is_featured)
                                                    <span class="category"
                                                        style="background: rgba(220, 53, 69, 0.9); margin-right: 5px;">
                                                        <i class="bi bi-star-fill"></i> Featured
                                                    </span>
                                                @endif
                                                @if ($page->is_banner)
                                                    <span class="category"
                                                        style="background: rgba(255, 193, 7, 0.9); color: #000;">
                                                        <i class="bi bi-flag-fill"></i> Banner
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                        @if (isset($page->category))
                                            <div class="meta-categories">
                                                <a href="{{ route('categories.show', $page->category->slug) }}"
                                                    class="category">
                                                    {{ $page->category->name }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                                    <div class="content-header">
                                        <h1 class="title">{{ $page->title }}</h1>

                                        <div class="author-info">
                                            <div class="author-details">
                                                <div class="info">
                                                    <h4>{{ $page->author }}</h4>
                                                </div>
                                            </div>
                                            <div class="post-meta">
                                                <span class="date">
                                                    <i class="bi bi-calendar3"></i>
                                                    {{ $page->created_at->format('M d, Y') }}
                                                </span>
                                                <span class="divider">•</span>
                                                <span class="comments">
                                                    <i class="bi bi-chat-text"></i>
                                                    {{ $comments->count() }} Comments
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enhanced Meta Info -->
                                    <div class="post-meta-enhanced">
                                        <div class="meta-item">
                                            <i class="bi bi-eye"></i>
                                            {{ number_format($page->views) }} views
                                        </div>
                                        <div class="meta-item">
                                            <i class="bi bi-clock"></i>
                                            {{ ceil(str_word_count(strip_tags($page->content)) / 200) }} min read
                                        </div>
                                        <div class="meta-item">
                                            <i class="bi bi-person"></i>
                                            {{ $page->author }}
                                        </div>
                                    </div>

                                    {{-- @if ($page->excerpt)
                                        <div
                                            style="background: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid #37517e; margin-bottom: 20px; font-style: italic; color: #666;">
                                            {{ $page->excerpt }}
                                        </div>
                                    @endif --}}

                                    <div class="content">
                                        {!! $page->content !!}
                                    </div>

                                    <!-- Enhanced Share Section -->
                                    <div class="share-enhanced ">
                                        <h5><i class="bi bi-share"></i> Share this article</h5>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('posts.show', $page->slug)) }}"
                                            target="_blank" class="share-btn share-facebook">
                                            <i class="bi bi-facebook"></i> Facebook
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', $page->slug)) }}&text={{ urlencode($page->title) }}"
                                            target="_blank" class="share-btn share-twitter">
                                            <i class="bi bi-twitter"></i> Twitter
                                        </a>
                                        <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' ' . route('posts.show', $page->slug)) }}"
                                            target="_blank" class="share-btn share-whatsapp">
                                            <i class="bi bi-whatsapp"></i> WhatsApp
                                        </a>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('posts.show', $page->slug)) }}"
                                            target="_blank" class="share-btn share-instagram">
                                            <i class="bi bi-linkedin"></i> LinkedIn
                                        </a>
                                        <button onclick="copyUrl()" class="share-btn"
                                            style="background: #6c757d; border: none; cursor: pointer;" id="copyBtn">
                                            <i class="bi bi-link-45deg"></i> Copy Link
                                        </button>
                                    </div>
                                </div>

                            </article>

                        </div>
                    </section><!-- /Blog Details Section -->

                    @if ($page->comments_is_active)
                        <!-- Blog Comments Section -->
                        <section id="blog-comments" class="blog-comments section">
                            <div class="container" data-aos="fade-up" data-aos-delay="100">
                                <div class="comments-enhanced">
                                    <h3
                                        style="color: #37517e; border-bottom: 2px solid #37517e; padding-bottom: 10px; margin-bottom: 25px;">
                                        <i class="bi bi-chat-text"></i> Comments ({{ $comments->count() }})
                                    </h3>

                                    @if (session('success'))
                                        <div class="alert alert-success" style="margin: 20px 0;">
                                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                                        </div>
                                    @endif

                                    @forelse ($comments as $comment)
                                        <div class="comment-item">
                                            <div class="comment-author">
                                                <i class="bi bi-person-circle"></i> {{ $comment->name }}
                                            </div>
                                            <div class="comment-date">
                                                <i class="bi bi-clock"></i> {{ $comment->created_at->diffForHumans() }}
                                            </div>
                                            <div class="comment-content">
                                                {{ $comment->content }}
                                            </div>
                                        </div>
                                    @empty
                                        <div style="text-align: center; padding: 40px 0; color: #666;">
                                            <i class="bi bi-chat-text"
                                                style="font-size: 3rem; margin-bottom: 15px; color: #dee2e6;"></i>
                                            <p>No comments yet. Be the first to comment!</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </section><!-- /Blog Comments Section -->

                        <!-- Blog Comment Form Section -->
                        <section id="blog-comment-form" class="blog-comment-form section">
                            <div class="container" data-aos="fade-up" data-aos-delay="100">
                                <div class="form-enhanced">
                                    <h3 style="color: #37517e; margin-bottom: 20px;">
                                        <i class="bi bi-pencil-square"></i> Leave a Comment
                                    </h3>
                                    <p style="color: #666; margin-bottom: 25px;">Your email address will not be published.
                                        Required fields are marked *</p>

                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $page->id }}">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Full Name *</label>
                                                    <input type="text" name="name" id="name"
                                                        class="form-control" placeholder="Your full name"
                                                        value="{{ old('name') }}" required>
                                                    @error('name')
                                                        <small style="color: #dc3545;">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email Address *</label>
                                                    <input type="email" name="email" id="email"
                                                        class="form-control" placeholder="Your email address"
                                                        value="{{ old('email') }}" required>
                                                    @error('email')
                                                        <small style="color: #dc3545;">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="comment">Your Comment *</label>
                                                    <textarea name="content" id="comment" rows="5" class="form-control"
                                                        placeholder="Write your comment here..." required>{{ old('content') }}</textarea>
                                                    @error('content')
                                                        <small style="color: #dc3545;">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    {!! ReCaptcha::htmlScriptTagJsApi() !!}
                                                    {!! ReCaptcha::htmlFormSnippet() !!}
                                                    @error('g-recaptcha-response')
                                                        <small style="color: #dc3545;">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 text-center mt-2">
                                                <button type="submit" class="btn-submit-enhanced">
                                                    <i class="bi bi-send"></i> Submit Comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section><!-- /Blog Comment Form Section -->
                    @endif
                </div>

                @include('themes.arsha.layouts.sidebar')

            </div>
        </div>

    </main>

    <script>
        function copyUrl() {
            const url = '{{ route('posts.show', $page->slug) }}';
            const btn = document.getElementById('copyBtn');

            navigator.clipboard.writeText(url).then(function() {
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check"></i> Copied!';
                btn.style.background = '#28a745';

                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.style.background = '#6c757d';
                }, 2000);
            }).catch(function() {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = url;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check"></i> Copied!';
                btn.style.background = '#28a745';

                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.style.background = '#6c757d';
                }, 2000);
            });
        }
    </script>
@endsection
