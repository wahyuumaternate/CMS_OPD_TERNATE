@extends('themes.zenblog.layouts.main')

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

    <!-- Enhanced ZenBlog Styles -->
    <style>
        /* Page Title Enhancement */
        .page-title {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            position: relative;
            overflow: hidden;
        }

        .page-title::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.3;
        }

        .page-title h1 {
            color: white;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .breadcrumbs {
            position: relative;
            z-index: 2;
        }

        .breadcrumbs ol li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .breadcrumbs ol li.current {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Article Enhancement */
        .article {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .article:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        /* Image Container */
        .article-image-container {
            position: relative;
            overflow: hidden;
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .article img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.5s ease;
            border-radius: 0;
        }

        .article-image-container:hover img {
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
            background: rgba(255, 107, 53, 0.9);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .badge-featured {
            background: rgba(247, 147, 30, 0.9);
        }

        .badge-banner {
            background: rgba(255, 140, 66, 0.9);
            color: white;
        }

        /* Article Meta */
        .article-meta {
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

        /* Title Section */
        .title-section {
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
        }

        .article-meta-info .meta-item i {
            color: #ff6b35;
        }

        /* Content Enhancement */
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
            color: #ff6b35;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .content p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .content img {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }

        .content blockquote {
            border-left: 4px solid #ff6b35;
            background: #fff8f4;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
            font-style: italic;
        }

        /* Enhanced Share Buttons */
        .share-buttons {
            background: linear-gradient(135deg, #fff8f4 0%, #ffeee6 100%);
            padding: 25px;
            border-radius: 12px;
            margin: 25px;
            border-top: 3px solid #ff6b35;
        }

        .share-buttons span {
            font-weight: 600;
            color: #ff6b35;
            margin-right: 15px;
            font-size: 16px;
        }

        .btn-social-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .btn-social-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .btn-social-icon:hover::before {
            left: 100%;
        }

        .btn-social-icon:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-facebook {
            background: linear-gradient(45deg, #3b5998, #4c70ba);
        }

        .btn-twitter {
            background: linear-gradient(45deg, #1da1f2, #0d8bd9);
        }

        .btn-whatsapp {
            background: linear-gradient(45deg, #25d366, #128c7e);
        }

        .btn-instagram {
            background: linear-gradient(45deg, #f56040, #833ab4);
        }

        .btn-social-icon img {
            filter: none;
            z-index: 2;
            position: relative;
        }

        /* Copy URL Button */
        .copy-url-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 10px;
        }

        .copy-url-btn:hover {
            background: #5a6268;
        }

        .copy-url-btn.copied {
            background: #28a745;
        }

        /* Comments Enhancement */
        .comments {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            margin-top: 30px;
        }

        .comments h3 {
            color: #ff6b35;
            font-weight: 700;
            border-bottom: 3px solid #ff6b35;
            padding-bottom: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comments h3::before {
            content: '💬';
            font-size: 1.2em;
        }

        .comment {
            background: linear-gradient(135deg, #fff8f4 0%, #ffeee6 100%);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #ff6b35;
            transition: all 0.3s ease;
            position: relative;
        }

        .comment:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.1);
        }

        .comment strong {
            color: #ff6b35;
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

        /* Comment Form Enhancement */
        .comment-form-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 16px;
            padding: 30px;
            margin-top: 30px;
        }

        .comment-form-section h4 {
            color: #ff6b35;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comment-form-section h4::before {
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
            border-color: #ff6b35;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
            outline: none;
        }

        .btn-submit {
            background: linear-gradient(45deg, #ff6b35, #f7931e);
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
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
            color: white;
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
            .title-section {
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

            .article-meta {
                padding: 20px 15px 15px;
                flex-direction: column;
                align-items: start;
                gap: 10px;
            }

            .meta-group {
                flex-wrap: wrap;
                gap: 8px;
            }

            .content {
                padding: 20px;
            }

            .share-buttons {
                padding: 20px;
                margin: 20px;
                text-align: center;
            }

            .share-buttons span {
                display: block;
                margin-bottom: 15px;
            }

            .comments {
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
    <main class="main">

        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Enhanced Blog Details Section -->
                    <section id="blog-details" class="blog-details section">
                        <div class="container">

                            <article class="article fade-in-up">
                                <div class="article-image-container">
                                    <img src="{{ $page->image }}" alt="{{ $page->title }}" class="img-fluid">

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

                                    <!-- Article Meta Overlay -->
                                    <div class="article-meta">
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
                                                <span>{{ ceil(str_word_count(strip_tags($page->content)) / 200) }}
                                                    min</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Title Section -->
                                <div class="title-section">
                                    <h1 class="article-title">{{ $page->title }}</h1>
                                </div>

                                <div class="content">
                                    @if ($page->excerpt)
                                        <div class="article-excerpt"
                                            style="font-size: 1.1rem; color: #666; font-style: italic; margin-bottom: 25px; padding: 15px; background: #fff8f4; border-radius: 8px; border-left: 4px solid #ff6b35;">
                                            {!! $page->excerpt !!}
                                        </div>
                                    @endif

                                    {!! $page->content !!}
                                </div><!-- End post content -->

                                <div class="share-buttons">
                                    <span><i class="fas fa-share-alt"></i> Share:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', $page->slug) }}"
                                        target="_blank" class="btn-social-icon btn-facebook" title="Share on Facebook">
                                        {{-- <img src="{{ asset('assets/facebook.svg') }}" alt="" width="40"> --}}
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ route('posts.show', $page->slug) }}&text={{ urlencode($page->title) }}"
                                        target="_blank" class="btn-social-icon btn-twitter" title="Share on Twitter">
                                        {{-- <img src="{{ asset('assets/x.svg') }}" alt="Twitter" width="20"> --}}
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' - ' . route('posts.show', $page->slug)) }}"
                                        target="_blank" class="btn-social-icon btn-whatsapp" title="Share on WhatsApp">
                                        <img src="{{ asset('assets/whatsapp.svg') }}" alt="WhatsApp" width="20">
                                    </a>
                                    <a href="https://www.instagram.com" target="_blank"
                                        class="btn-social-icon btn-instagram" title="Instagram">
                                        {{-- <img src="{{ asset('assets/instagram.svg') }}" alt="Instagram" width="20"> --}}
                                    </a>
                                    <button onclick="copyUrl()" class="copy-url-btn" id="copyBtn">
                                        <i class="fas fa-link"></i> Copy
                                    </button>
                                </div> <!-- End Share Buttons -->
                            </article>

                            @if ($page->comments_is_active)
                                <!-- Enhanced Comments Section -->
                                <section id="comments" class="comments section fade-in-up">
                                    <h3>
                                        Comments ({{ $comments->count() }})
                                    </h3>

                                    <!-- Success Message -->
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    <!-- Comments List -->
                                    @if ($comments->count() > 0)
                                        <div class="comments-list">
                                            @foreach ($comments as $comment)
                                                <div class="comment">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <strong>{{ $comment->name }}</strong>
                                                        <span class="text-muted small">
                                                            <i class="fas fa-clock"></i>
                                                            {{ $comment->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="empty-comments">
                                            <i class="fas fa-comments"></i>
                                            <p>No comments yet. Be the first to share your thoughts!</p>
                                        </div>
                                    @endif

                                    <!-- Enhanced Comment Form -->
                                    <div class="comment-form-section">
                                        <h4>Leave a Comment</h4>
                                        <form action="{{ route('comments.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $page->id }}">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="name">Name *</label>
                                                        <input type="text" name="name" id="name"
                                                            class="form-control" placeholder="Your Name"
                                                            value="{{ old('name') }}" required>
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="email">Email *</label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control" placeholder="Your Email"
                                                            value="{{ old('email') }}" required>
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="content">Comment *</label>
                                                <textarea name="content" id="content" class="form-control" rows="5"
                                                    placeholder="Write your comment here..." required>{{ old('content') }}</textarea>
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
                                                <i class="fas fa-paper-plane"></i> Submit Comment
                                            </button>
                                        </form>
                                    </div>
                                </section><!-- /Comments Section -->
                            @endif
                        </div>
                    </section><!-- /Blog Details Section -->

                </div>

                @include('themes.zenblog.layouts.sidebar')

            </div>
        </div>

    </main>

    <script>
        function copyUrl() {
            const url = '{{ route('posts.show', $page->slug) }}';
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

        // Reading progress indicator (optional)
        window.addEventListener('scroll', () => {
            const article = document.querySelector('.content');
            if (article) {
                const scrollTop = window.pageYOffset;
                const docHeight = document.body.scrollHeight - window.innerHeight;
                const progress = (scrollTop / docHeight) * 100;

                // You can create a progress bar here if needed
                // document.querySelector('.reading-progress').style.width = progress + '%';
            }
        });
    </script>

@endsection
