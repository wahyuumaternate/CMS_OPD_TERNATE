@extends('themes.blogy.layouts.main')

@section('main')
    <section id="blog-hero" class="blog-hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="blog-grid">

                @foreach ($banner->take(1) as $post)
                    <article class="blog-item featured" data-aos="fade-up">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid" />
                        <div class="blog-content">
                            <div class="post-meta">
                                <span class="date">{{ $post->created_at->translatedFormat('M. jS, Y') }}</span>
                                <span
                                    class="category">{{ $post->category->name ?? __('frontend/home.default.category') }}</span>
                            </div>
                            <h2 class="post-title">
                                <a href="{{ route('posts.show', $post->slug) }}" title="{{ $post->title }}">
                                    {{ Str::limit($post->title, 80) }}
                                </a>
                            </h2>
                        </div>
                    </article>
                @endforeach

                @foreach ($banner->skip(1)->take(1) as $p)
                    <article class="blog-item" data-aos="fade-up" data-aos-delay="{{ ($p->id + 1) * 100 }}">
                        <img src="{{ $p->image }}" alt="{{ $p->title }}" class="img-fluid" />
                        <div class="blog-content">
                            <div class="post-meta">
                                <span class="date">{{ $p->created_at->translatedFormat('M. jS, Y') }}</span>
                                <span
                                    class="category">{{ $p->category->name ?? __('frontend/home.default.category') }}</span>
                            </div>
                            <h3 class="post-title">
                                <a href="{{ route('posts.show', $p->slug) }}" title="{{ $p->title }}">
                                    {{ Str::limit($p->title, 70) }}
                                </a>
                            </h3>
                        </div>
                    </article>
                @endforeach

            </div>
        </div>
    </section>

    <section id="latest-posts" class="latest-posts section">
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ __('frontend/home.featured.title') }}</h2>
            <div>
                <span>{{ __('frontend/home.featured.subtitle') }}</span>
                <span class="description-title">{{ __('frontend/home.featured.description') }}</span>
            </div>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @foreach ($beritaUtama->take(4) as $utama)
                    <div class="col-lg-4">
                        <article>
                            <div class="post-img">
                                <img src="{{ $utama->image }}" alt="{{ $utama->title }}" class="img-fluid" />
                            </div>

                            <p class="post-category">{{ $utama->category->name ?? __('frontend/home.default.category') }}
                            </p>

                            <h2 class="title">
                                <a href="{{ route('posts.show', $utama->slug) }}">{{ Str::limit($utama->title, 80) }}</a>
                            </h2>

                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-author">Author :
                                        {{ $utama->author ?? __('frontend/home.default.author') }}</p>
                                    <p class="post-date">
                                        <time datetime="{{ $utama->created_at->toDateString() }}">
                                            {{ $utama->created_at->translatedFormat('M. jS, Y') }}
                                        </time>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="latest-posts" class="latest-posts section">
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ __('frontend/home.latest.title') }}</h2>
            <div>
                <span>{{ __('frontend/home.latest.subtitle') }}</span>
                <span class="description-title">{{ __('frontend/home.latest.description') }}</span>
            </div>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-lg-4">
                        <article>
                            <div class="post-img">
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid" />
                            </div>

                            <p class="post-category">{{ $post->category->name ?? __('frontend/home.default.category') }}
                            </p>

                            <h2 class="title">
                                <a href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 80) }}</a>
                            </h2>

                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-author">Author :
                                        {{ $post->author ?? __('frontend/home.default.author') }}</p>
                                    <p class="post-date">
                                        <time datetime="{{ $post->created_at->toDateString() }}">
                                            {{ $post->created_at->translatedFormat('M. jS, Y') }}
                                        </time>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if ($pengumumanPosts->count() > 0)
        <section id="category-section" class="category-section section">
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ __('frontend/home.announcements.title') }}</h2>
                <div>
                    <span>{{ __('frontend/home.announcements.subtitle') }}</span>
                    <span class="description-title">{{ __('frontend/home.announcements.description') }}</span>
                </div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    @foreach ($pengumumanPosts->take(6) as $post)
                        <div class="col-xl-4 col-lg-6">
                            <article class="list-post">
                                <div class="post-img">
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid"
                                        loading="lazy" />
                                </div>

                                <div class="post-content">
                                    <div class="category-meta">
                                        <span
                                            class="post-category">{{ $post->category->name ?? __('frontend/home.default.category') }}</span>
                                    </div>

                                    <h3 class="title">
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            {{ Str::limit($post->title, 80, '...') }}
                                        </a>
                                    </h3>

                                    <div class="post-meta">
                                        <span class="post-date">
                                            {{ $post->created_at->translatedFormat('M. jS, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
