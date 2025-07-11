@extends('themes.blogy.layouts.main', ['title' => $page->title])

@push('styles')
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

    <!-- Custom Styles -->
    <style>
        /* Enhanced Post Styles */
        .entry-single {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .entry-single:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .entry-img {
            position: relative;
            overflow: hidden;
            height: 400px;
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .entry-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            filter: brightness(0.9);
        }

        .entry-img:hover img {
            transform: scale(1.05);
            filter: brightness(1);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                    transparent 0%,
                    transparent 50%,
                    rgba(0, 0, 0, 0.7) 100%);
            pointer-events: none;
        }

        .post-badges {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .badge-custom {
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(10px);
            color: white;
            border: none;
            animation: pulse 2s infinite;
        }

        .badge-featured {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        }

        .badge-banner {
            background: linear-gradient(45deg, #feca57, #ff9ff3);
            box-shadow: 0 4px 15px rgba(254, 202, 87, 0.4);
        }

        .post-meta-enhanced {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            color: white;
            z-index: 10;
        }

        .post-meta-enhanced .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-right: 20px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 12px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            margin-bottom: 8px;
        }

        .entry-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin: 30px 0 20px;
            background: black;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            padding: 0 30px;
        }

        .entry-content {
            padding: 0 30px 30px;
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
        }

        .entry-content p {
            margin-bottom: 1.5rem;
        }

        /* Responsive Image Fix for TinyMCE Content */
        .entry-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            display: block;
        }

        /* Ensure all content images are responsive */
        .entry-content figure,
        .entry-content figure img {
            max-width: 100%;
            height: auto;
        }

        .entry-content figure {
            margin: 20px 0;
            text-align: center;
        }

        .entry-content figcaption {
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
            margin-top: 8px;
            text-align: center;
        }

        /* Handle TinyMCE specific image classes */
        .entry-content .mce-object,
        .entry-content .mce-preview-object {
            max-width: 100%;
            height: auto;
        }

        /* Responsive tables from TinyMCE */
        .entry-content table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
            overflow-x: auto;
            display: block;
            white-space: nowrap;
        }

        .entry-content table thead,
        .entry-content table tbody,
        .entry-content table tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .entry-content table th,
        .entry-content table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .entry-content table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #667eea;
        }

        /* Responsive video embeds */
        .entry-content iframe,
        .entry-content video,
        .entry-content embed,
        .entry-content object {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }

        /* Responsive iframe container */
        .entry-content .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            margin: 20px 0;
        }

        .entry-content .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 8px;
        }

        /* Content Enhancement */
        .entry-content h1,
        .entry-content h2,
        .entry-content h3,
        .entry-content h4,
        .entry-content h5,
        .entry-content h6 {
            color: #667eea;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .entry-content blockquote {
            border-left: 4px solid #667eea;
            background: #f8f9ff;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
            font-style: italic;
        }

        .entry-content a {
            color: #667eea;
            text-decoration: none;
        }

        .entry-content a:hover {
            text-decoration: underline;
        }

        .entry-footer {
            padding: 20px 30px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-top: 1px solid #dee2e6;
        }

        .social-icons-enhanced {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: white;
        }

        .social-icon:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .social-icon.facebook {
            background: linear-gradient(45deg, #3b5998, #8b9dc3);
        }

        .social-icon.twitter {
            background: linear-gradient(45deg, #1da1f2, #0d8bd9);
        }

        .social-icon.whatsapp {
            background: linear-gradient(45deg, #25d366, #128c7e);
        }

        .social-icon.instagram {
            background: linear-gradient(45deg, #f56040, #833ab4);
        }

        .social-icon img {
            width: 20px;
            height: 20px;
            filter: brightness(0) invert(1);
        }

        .blog-comments {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .comments-count {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comments-count::before {
            content: '💬';
            font-size: 1.2em;
        }

        .comment {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .comment:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .comment h5 {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .comment time {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .comment p {
            margin-top: 10px;
            margin-bottom: 0;
        }

        .reply-form {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
        }

        .reply-form h4 {
            color: #667eea;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .reply-form h4::before {
            content: '✍️';
            font-size: 1.2em;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-submit-enhanced {
            background: linear-gradient(45deg, #f56040, #833ab4);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit-enhanced:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .views-counter {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .reading-time {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .entry-title {
                font-size: 2rem;
                padding: 0 20px;
            }

            .entry-content {
                padding: 0 20px 20px;
            }

            .entry-footer {
                padding: 20px;
            }

            .social-icons-enhanced {
                justify-content: center;
            }

            /* Mobile responsive tables */
            .entry-content table {
                font-size: 12px;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@section('main')
    <main id="main">
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">

                    <div class="col-lg-8 entries">
                        <article class="entry entry-single fade-in">
                            <div class="entry-img">
                                <img src="{{ $page->image }}" alt="{{ $page->title }}" class="img-fluid">
                                <div class="image-overlay"></div>

                                <!-- Post Badges -->
                                <div class="post-badges">
                                    @if ($page->is_featured)
                                        <span class="badge-custom badge-featured">
                                            <i class="fas fa-star"></i> Featured
                                        </span>
                                    @endif
                                    @if ($page->is_banner)
                                        <span class="badge-custom badge-banner">
                                            <i class="fas fa-flag"></i> Banner
                                        </span>
                                    @endif
                                </div>

                                <!-- Post Meta in Image -->
                                <div class="post-meta-enhanced">
                                    <div class="views-counter">
                                        <i class="fas fa-eye"></i>
                                        {{ number_format($page->views) }} {{ __('views') }}
                                    </div>
                                    <div class="reading-time">
                                        <i class="fas fa-clock"></i>
                                        {{ ceil(str_word_count(strip_tags($page->content)) / 200) }} {{ __('min read') }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-user"></i>
                                        {{ $page->author }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        {{ $page->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>

                            <h2 class="entry-title">{{ $page->title }}</h2>

                            <!-- Excerpt if available -->
                            {{-- @if ($page->excerpt)
                                <div class="entry-excerpt"
                                    style="padding: 0 30px; font-size: 1.2rem; color: #666; font-style: italic; margin-bottom: 20px; padding: 15px 30px; background: #f8f9ff; border-radius: 8px; border-left: 4px solid #667eea;">
                                    {{ $page->excerpt }}
                                </div>
                            @endif --}}

                            <div class="entry-content">
                                {!! $page->content !!}
                            </div>

                            <div class="entry-footer">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div>
                                        <strong style="color: #667eea;">
                                            <i class="fas fa-share-alt"></i> {{ __('frontend/post.share') }}
                                        </strong>
                                    </div>
                                    <div class="social-icons-enhanced">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', $page->slug) }}"
                                            target="_blank" class="social-icon facebook" aria-label="Share on Facebook"
                                            title="Share on Facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url={{ route('posts.show', $page->slug) }}&text={{ urlencode($page->title) }}"
                                            target="_blank" class="social-icon twitter" aria-label="Share on Twitter"
                                            title="Share on Twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' - ' . route('posts.show', $page->slug)) }}"
                                            target="_blank" class="social-icon whatsapp" aria-label="Share on WhatsApp"
                                            title="Share on WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($page->title) }}"
                                            target="_blank" class="social-icon instagram" aria-label="Share on Telegram"
                                            title="Share on Telegram">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Copy URL Button -->
                                <div class="mt-3">
                                    <button onclick="copyToClipboard('{{ route('posts.show', $page->slug) }}')"
                                        class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-link"></i> {{ __('Copy Link') }}
                                    </button>
                                </div>
                            </div>
                        </article>

                        @if ($page->comments_is_active)
                            <div class="blog-comments fade-in">
                                <h4 class="comments-count">
                                    {{ __('frontend/post.comments_title', ['count' => $comments->count()]) }}
                                </h4>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle"></i> {{ __('frontend/post.comment_success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <ul class="comments list-unstyled">
                                    @forelse ($comments as $comment)
                                        <li class="comment">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5>
                                                        <i class="fas fa-user-circle"></i> {{ $comment->name }}
                                                    </h5>
                                                    <time datetime="{{ $comment->created_at }}" class="text-muted">
                                                        <i class="fas fa-clock"></i>
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </time>
                                                    <p class="mt-2">{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="text-center py-4">
                                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">{{ __('No comments yet. Be the first to comment!') }}
                                            </p>
                                        </li>
                                    @endforelse
                                </ul>

                                <div class="reply-form">
                                    <h4>{{ __('frontend/post.leave_comment') }}</h4>
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $page->id }}">
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <label class="form-label">{{ __('frontend/post.your_name') }}</label>
                                                <input name="name" type="text" class="form-control"
                                                    placeholder="{{ __('frontend/post.your_name') }}"
                                                    value="{{ old('name') }}" required>
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label class="form-label">{{ __('frontend/post.your_email') }}</label>
                                                <input name="email" type="email" class="form-control"
                                                    placeholder="{{ __('frontend/post.your_email') }}"
                                                    value="{{ old('email') }}" required>
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{ __('frontend/post.your_comment') }}</label>
                                            <textarea name="content" class="form-control" rows="4" placeholder="{{ __('frontend/post.your_comment') }}"
                                                required>{{ old('content') }}</textarea>
                                            @error('content')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            {!! ReCaptcha::htmlScriptTagJsApi() !!}
                                            {!! ReCaptcha::htmlFormSnippet() !!}
                                            @error('g-recaptcha-response')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-submit-enhanced">
                                            <i class="fas fa-paper-plane"></i> {{ __('frontend/post.submit') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        @include('themes.blogy.layouts.sidebar')
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show success message
                const btn = event.target.closest('button');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> {{ __('Copied!') }}';
                btn.classList.add('btn-success');
                btn.classList.remove('btn-outline-secondary');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-outline-secondary');
                }, 2000);
            });
        }

        // Add reading progress bar
        window.addEventListener('scroll', () => {
            const article = document.querySelector('.entry-content');
            if (article) {
                const articleTop = article.offsetTop;
                const articleHeight = article.offsetHeight;
                const scrollTop = window.pageYOffset;
                const windowHeight = window.innerHeight;

                const progress = Math.min(
                    Math.max((scrollTop - articleTop + windowHeight) / articleHeight, 0),
                    1
                );

                // You can add a progress bar here if needed
            }
        });
    </script>

@endsection
