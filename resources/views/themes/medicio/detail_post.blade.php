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
        /* Enhanced Article Content */
        .article-content {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .article-content:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* Image Container Enhancement */
        .article-image-container {
            position: relative;
            overflow: hidden;
            background: linear-gradient(45deg, #5db996, #4ca384);
        }

        .article-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.5s ease;
            border-radius: 0;
        }

        .article-image-container:hover .article-image {
            transform: scale(1.03);
        }

        /* Article Badges */
        .article-badges {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .article-badge {
            background: rgba(93, 185, 150, 0.9);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .badge-featured {
            background: rgba(76, 163, 132, 0.9);
        }

        .badge-banner {
            background: rgba(109, 201, 166, 0.9);
        }

        /* Article Meta Overlay */
        .article-meta-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 30px 20px 20px;
            display: flex;
            justify-content: space-between;
            align-items: end;
            flex-wrap: wrap;
            gap: 15px;
        }

        .meta-group {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 12px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        /* Title and Content Section */
        .article-title-section {
            padding: 30px;
            border-bottom: 1px solid #eee;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .article-meta-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .meta-left,
        .meta-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .article-meta-info .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #666;
            font-size: 14px;
            background: none;
            padding: 0;
            border-radius: 0;
        }

        .article-meta-info .meta-item i {
            color: #5db996;
        }

        .content {
            padding: 30px;
            font-size: 16px;
            line-height: 1.8;
            color: #444;
        }

        .content h1,
        .content h2,
        .content h3,
        .content h4,
        .content h5,
        .content h6 {
            color: #5db996;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .content p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            display: block;
        }

        /* Ensure all content images are responsive */
        .content figure,
        .content figure img {
            max-width: 100%;
            height: auto;
        }

        .content figure {
            margin: 20px 0;
            text-align: center;
        }

        .content figcaption {
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
            margin-top: 8px;
            text-align: center;
        }

        /* Handle TinyMCE specific image classes */
        .content .mce-object,
        .content .mce-preview-object {
            max-width: 100%;
            height: auto;
        }

        /* Responsive tables from TinyMCE */
        .content table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
            overflow-x: auto;
            display: block;
            white-space: nowrap;
        }

        .content table thead,
        .content table tbody,
        .content table tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .content table th,
        .content table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .content table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #5db996;
        }

        /* Responsive video embeds */
        .content iframe,
        .content video,
        .content embed,
        .content object {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }

        /* Responsive iframe container */
        .content .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            margin: 20px 0;
        }

        .content .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 8px;
        }

        .content blockquote {
            border-left: 4px solid #5db996;
            background: #f0fbf7;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
            font-style: italic;
        }

        /* Enhanced Share Section */
        .share-section {
            padding: 25px 30px;
            background: linear-gradient(135deg, #f0fbf7 0%, #e6f7f0 100%);
            border-top: 3px solid #5db996;
            margin: 0;
        }

        .share-title {
            font-size: 18px;
            font-weight: 600;
            color: #5db996;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .share-title::before {
            content: '🔗';
            font-size: 1.2em;
        }

        .share-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .share-btn {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            border-radius: 8px;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }

        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            color: #fff;
            text-decoration: none;
        }

        .share-btn i {
            margin-right: 8px;
            font-size: 16px;
        }

        .btn-facebook {
            background-color: #1877f2;
        }

        .btn-twitter {
            background-color: #1da1f2;
        }

        .btn-whatsapp {
            background-color: #25d366;
        }

        .btn-telegram {
            background-color: #0088cc;
        }

        .btn-copy {
            background-color: #6c757d;
        }

        .btn-copy.copied {
            background-color: #28a745;
        }

        /* Enhanced Comments Section */
        .comments-section {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .comments-section h3 {
            color: #5db996;
            font-weight: 700;
            border-bottom: 3px solid #5db996;
            padding-bottom: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comments-section h3::before {
            content: '💬';
            font-size: 1.2em;
        }

        .comment {
            background: linear-gradient(135deg, #f0fbf7 0%, #e6f7f0 100%);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #5db996;
            transition: all 0.3s ease;
        }

        .comment:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(93, 185, 150, 0.1);
        }

        .comment strong {
            color: #5db996;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .comment .text-muted {
            color: #6c757d !important;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .comment p {
            margin-bottom: 0;
            color: #444;
            line-height: 1.6;
        }

        /* Enhanced Comment Form */
        .comment-form {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 16px;
            padding: 30px;
            margin-top: 30px;
        }

        .comment-form h4 {
            color: #5db996;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comment-form h4::before {
            content: '✍️';
            font-size: 1.2em;
        }

        .form-group label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #5db996;
            box-shadow: 0 0 0 0.2rem rgba(93, 185, 150, 0.25);
            outline: none;
        }

        .btn-submit {
            background: linear-gradient(45deg, #5db996, #4ca384);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(93, 185, 150, 0.4);
            color: white;
        }

        /* Alert Enhancement */
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
        }

        /* Empty Comments State */
        .empty-comments {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .empty-comments i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .article-title-section {
                padding: 20px;
            }

            .article-title {
                font-size: 2rem;
            }

            .article-meta-info {
                flex-direction: column;
                align-items: start;
                gap: 10px;
            }

            .meta-left,
            .meta-right {
                gap: 15px;
            }

            .article-meta-overlay {
                padding: 20px 15px 15px;
                flex-direction: column;
                align-items: start;
                gap: 10px;
            }

            .content {
                padding: 20px;
            }

            .share-section {
                padding: 20px;
            }

            .share-buttons {
                justify-content: center;
                gap: 8px;
            }

            .share-btn {
                padding: 8px 12px;
                font-size: 13px;
            }

            .comments-section {
                padding: 20px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
@endpush

@section('main')
    <main id="main">
        <!-- Article Section -->
        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <article class="article-content fade-in-up">
                            <div class="article-image-container">
                                <img src="{{ $page->image }}" alt="{{ $page->title }}" class="article-image">

                                <!-- Article Badges -->
                                @if ($page->is_featured || $page->is_banner)
                                    <div class="article-badges">
                                        @if ($page->is_featured)
                                            <span class="article-badge badge-featured">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @endif
                                        @if ($page->is_banner)
                                            <span class="article-badge badge-banner">
                                                <i class="fas fa-flag"></i> Banner
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                {{-- <!-- Article Meta Overlay -->
                                <div class="article-meta-overlay">
                                    <div class="meta-group">
                                        <div class="meta-item">
                                            <i class="fas fa-user"></i>
                                            <span>{{ $page->author }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fas fa-calendar"></i>
                                            <span>{{ $page->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="meta-group">
                                        <div class="meta-item">
                                            <i class="fas fa-eye"></i>
                                            <span>{{ number_format($page->views) }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ ceil(str_word_count(strip_tags($page->content)) / 200) }} min</span>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <!-- Title Section -->
                            <div class="article-title-section">
                                <h1 class="article-title">{{ $page->title }}</h1>
                                <div class="article-meta-info">
                                    <div class="meta-left">
                                        <span class="meta-item">
                                            <i class="fas fa-user"></i>
                                            {{ $page->author }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-calendar"></i>
                                            {{ $page->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <div class="meta-right">
                                        <span class="meta-item">
                                            <i class="fas fa-eye"></i>
                                            {{ number_format($page->views) }} views
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-clock"></i>
                                            {{ ceil(str_word_count(strip_tags($page->content)) / 200) }} min read
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="content">
                                @if ($page->excerpt)
                                    <div class="article-excerpt"
                                        style="font-size: 1.1rem; color: #666; font-style: italic; margin-bottom: 25px; padding: 15px; background: #f0fbf7; border-radius: 8px; border-left: 4px solid #5db996;">
                                        {!! $page->excerpt !!}
                                    </div>
                                @endif

                                {!! $page->content !!}
                            </div>

                            <!-- Enhanced Share Section -->
                            <div class="share-section">
                                <h4 class="share-title">{{ __('frontend/post.share') }}</h4>
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                        target="_blank" class="share-btn btn-facebook">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($page->title) }}"
                                        target="_blank" class="share-btn btn-twitter">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' ' . request()->url()) }}"
                                        target="_blank" class="share-btn btn-whatsapp">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                    <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($page->title) }}"
                                        target="_blank" class="share-btn btn-telegram">
                                        <i class="fab fa-telegram"></i> Telegram
                                    </a>
                                    <button onclick="copyUrl()" class="share-btn btn-copy" id="copyBtn">
                                        <i class="fas fa-link"></i> Copy Link
                                    </button>
                                </div>
                            </div>
                        </article>

                        @if ($page->comments_is_active)
                            <div class="comments-section fade-in-up">
                                <h3>{{ __('frontend/post.comments_title', ['count' => $comments->count()]) }}</h3>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle"></i> {{ __('frontend/post.comment_success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if ($comments->count() > 0)
                                    <ul class="list-unstyled mt-4">
                                        @foreach ($comments as $comment)
                                            <li class="comment">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <strong>{{ $comment->name }}</strong>
                                                    <span class="text-muted small">
                                                        <i class="fas fa-clock"></i>
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                                <p>{{ $comment->content }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="empty-comments">
                                        <i class="fas fa-comments"></i>
                                        <p>No comments yet. Be the first to share your thoughts!</p>
                                    </div>
                                @endif

                                <div class="comment-form">
                                    <h4>{{ __('frontend/post.leave_comment') }}</h4>
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $page->id }}">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="name">{{ __('frontend/post.your_name') }} *</label>
                                                    <input type="text" name="name" id="name"
                                                        class="form-control" value="{{ old('name') }}" required>
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="email">{{ __('frontend/post.your_email') }} *</label>
                                                    <input type="email" name="email" id="email"
                                                        class="form-control" value="{{ old('email') }}" required>
                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="content">{{ __('frontend/post.your_comment') }} *</label>
                                            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                                            @error('content')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            {!! ReCaptcha::htmlScriptTagJsApi() !!}
                                            {!! ReCaptcha::htmlFormSnippet() !!}
                                            @error('g-recaptcha-response')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-submit">
                                            <i class="fas fa-paper-plane"></i> {{ __('frontend/post.submit') }}
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

    <script>
        function copyUrl() {
            const url = '{{ request()->url() }}';
            const btn = document.getElementById('copyBtn');

            navigator.clipboard.writeText(url).then(function() {
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                btn.classList.add('copied');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('copied');
                }, 2000);
            }).catch(function() {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = url;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                btn.classList.add('copied');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('copied');
                }, 2000);
            });
        }

        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

@endsection
