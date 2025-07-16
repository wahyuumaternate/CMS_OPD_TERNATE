@extends('themes.blogy.layouts.main', ['title' => $query])

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container d-flex justify-content-between align-items-center">
                <h2>{{ __('frontend/search.title') }}</h2>
                <ol>
                    <li><a href="{{ url('/') }}">{{ __('frontend/search.breadcrumb_home') }}</a></li>
                    <li>{{ __('frontend/search.breadcrumb_search', ['query' => $query]) }}</li>
                </ol>
            </div>
        </section>

        <!-- ======= Search Results Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">

                    <!-- Hasil pencarian -->
                    <div class="col-lg-8 entries">

                        @if ($posts->count() > 0 || $pages->count() > 0)

                            @if ($posts->count() > 0)
                                <div class="section-header mb-4">
                                    <h3>{{ __('frontend/search.posts') }}</h3>
                                </div>

                                @foreach ($posts as $post)
                                    <article class="entry d-flex flex-column">
                                        @if ($post->image)
                                            <div class="entry-img">
                                                <a href="{{ route('posts.show', $post->slug) }}">
                                                    <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                                        class="img-fluid rounded" style="height: 200px; object-fit: cover;">
                                                </a>
                                            </div>
                                        @endif

                                        <h2 class="entry-title mt-3">
                                            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h2>

                                        <div class="entry-content">
                                            <p>{{ Str::limit(strip_tags($post->content), 200) }}</p>
                                        </div>
                                    </article>
                                @endforeach

                                <div class="pagination mt-4">
                                    {{ $posts->appends(['q' => $query])->links() }}
                                </div>
                            @endif

                            @if ($pages->count() > 0)
                                <div class="section-header mt-5 mb-4">
                                    <h3>{{ __('frontend/search.pages') }}</h3>
                                </div>

                                @foreach ($pages as $page)
                                    <article class="entry d-flex flex-column">
                                        @if ($page->image)
                                            <div class="entry-img">
                                                <a href="{{ route('pages.show', $page->slug) }}">
                                                    <img src="{{ $page->image }}" alt="{{ $page->title }}"
                                                        class="img-fluid rounded" style="height: 200px; object-fit: cover;">
                                                </a>
                                            </div>
                                        @endif

                                        <h2 class="entry-title mt-3">
                                            <a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a>
                                        </h2>

                                        <div class="entry-content">
                                            <p>{{ Str::limit(strip_tags($page->content), 200) }}</p>
                                        </div>
                                    </article>
                                @endforeach

                                <div class="pagination mt-4">
                                    {{ $pages->appends(['q' => $query])->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center p-5 bg-light rounded shadow-sm">
                                <h3 class="text-dark mb-3">{{ __('frontend/search.not_found_title') }}</h3>
                                <p class="text-muted">{{ __('frontend/search.not_found_description') }}</p>
                            </div>
                        @endif

                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        @include('themes.blogy.layouts.sidebar')
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
