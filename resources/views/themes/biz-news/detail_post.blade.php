@extends('themes.biz-news.layouts.main')

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
    <meta property="og:site_name" content="Dinkes Kota Ternate">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta name="twitter:image" content="{{ $page->image }}">

    <style>
        /* FORCE FIX untuk gambar TinyMCE - CSS paling kuat */
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

        /* Meta info yang lebih sederhana */
        .meta-info-simple {
            background: #fff3cd;
            padding: 12px 15px;
            border-left: 4px solid #ffc107;
            margin: 15px 0;
            font-size: 14px;
            border-radius: 4px;
        }

        .meta-info-simple .meta-item {
            display: inline-block;
            margin-right: 20px;
            color: #856404;
        }

        .meta-info-simple .meta-item i {
            color: #ffc107;
            margin-right: 5px;
            width: 12px;
            text-align: center;
        }

        /* Share buttons yang lebih baik */
        .share-simple {
            background: #f8f9fa;
            padding: 15px;
            border-top: 3px solid #ffc107;
            text-align: center;
            border-radius: 0 0 4px 4px;
        }

        .share-simple strong {
            color: #495057;
            margin-right: 15px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .btn-share {
            margin: 2px;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-share:hover {
            text-decoration: none;
            transform: translateY(-1px);
        }

        /* Comments yang lebih clean */
        .comment-simple {
            background: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #ffc107;
            margin-bottom: 15px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .comment-simple:hover {
            background: #e9ecef;
            transform: translateX(3px);
        }

        .comment-simple .comment-author {
            color: #495057;
            font-weight: 600;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .comment-simple .comment-date {
            color: #6c757d;
            font-size: 12px;
            margin-bottom: 8px;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }

        /* Form enhancement */
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .meta-info-simple .meta-item {
                display: block;
                margin-bottom: 5px;
                margin-right: 0;
            }

            .btn-share {
                margin-bottom: 5px;
                display: inline-block;
                width: auto;
            }
        }
    </style>
@endpush

@section('main')
    <!-- News With Sidebar Start -->
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="{{ $page->image }}" style="object-fit: cover;"
                            alt="{{ $page->title }}">
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                @if (isset($page->category))
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="{{ route('categories.show', $page->category->slug) }}">
                                        {{ $page->category->name }}
                                    </a>
                                @endif
                                <small class="text-muted">{{ $page->created_at->format('M d, Y') }}</small>
                            </div>
                            <h2 class="mb-3 text-secondary font-weight-bold">{{ $page->title }}</h2>

                            <!-- Enhanced Meta Info -->
                            <div class="meta-info-simple">
                                <div class="meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>{{ $page->author }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-eye"></i>
                                    <span>{{ number_format($page->views) }} views</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ ceil(str_word_count(strip_tags($page->content)) / 200) }} min read</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-comments"></i>
                                    <span>{{ $comments->count() }} comments</span>
                                </div>
                            </div>

                            <div class="post-content">
                                {!! $page->content !!}
                            </div>
                        </div>

                        <!-- Simple Share Buttons -->
                        <div class="share-simple">
                            <strong>Bagikan:</strong>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('posts.show', $page->slug)) }}"
                                target="_blank" class="btn btn-primary btn-share">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', $page->slug)) }}&text={{ urlencode($page->title) }}"
                                target="_blank" class="btn btn-info btn-share">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' ' . route('posts.show', $page->slug)) }}"
                                target="_blank" class="btn btn-success btn-share">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <button onclick="copyUrl()" class="btn btn-secondary btn-share" id="copyBtn">
                                <i class="fas fa-link"></i> Copy
                            </button>
                        </div>
                    </div>
                    <!-- News Detail End -->

                    @if ($page->comments_is_active)
                        <!-- Comment List Start -->
                        <div class="mb-3">
                            <div class="section-title mb-0">
                                <h4 class="m-0 text-uppercase font-weight-bold">{{ $comments->count() }} Komentar</h4>
                            </div>
                            <div class="bg-white border border-top-0 p-4">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @forelse ($comments as $comment)
                                    <div class="comment-simple">
                                        <div class="comment-author">
                                            <i class="fas fa-user-circle"></i>
                                            {{ $comment->name }}
                                        </div>
                                        <div class="comment-date">
                                            <i class="fas fa-clock"></i>
                                            {{ $comment->created_at->diffForHumans() }}
                                        </div>
                                        <p class="mt-2 mb-0">{{ $comment->content }}</p>
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <i class="fas fa-comments"></i>
                                        <p>Belum ada komentar. Jadilah yang pertama!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <!-- Comment List End -->

                        <!-- Comment Form Start -->
                        <div class="mb-3">
                            <div class="section-title mb-0">
                                <h4 class="m-0 text-uppercase font-weight-bold">Tinggalkan Komentar</h4>
                            </div>
                            <div class="bg-white border border-top-0 p-4">
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $page->id }}">

                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Nama *</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Nama anda" value="{{ old('name') }}" required>
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email anda" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="message">Komentar *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control" name="content"
                                            placeholder="Tulis komentar anda disini.." required>{{ old('content') }}</textarea>
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

                                    <div class="form-group mb-0">
                                        <input type="submit" value="Kirim Komentar"
                                            class="btn btn-primary font-weight-semi-bold py-2 px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Comment Form End -->
                    @endif
                </div>

                @include('themes.biz-news.layouts.sidebar')
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->

    <script>
        function copyUrl() {
            const url = '{{ route('posts.show', $page->slug) }}';
            const btn = document.getElementById('copyBtn');

            navigator.clipboard.writeText(url).then(function() {
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-success');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-secondary');
                }, 2000);
            }).catch(function() {
                // Fallback
                const textArea = document.createElement('textarea');
                textArea.value = url;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-success');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-secondary');
                }, 2000);
            });
        }
    </script>
@endsection
