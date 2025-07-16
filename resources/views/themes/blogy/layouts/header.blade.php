<div id="top-banner" class="w-100 text-center">
    <a href="/" target="_blank">
        <img src="{{ asset('assets/banner.jpg') }}" alt="Banner Promosi" class="img-fluid w-100">
    </a>
</div>
<header id="header" class="header position-relative">
    <div class="container-fluid container-xl position-relative">
        <div class="top-row d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-end">
                <img src="{{ asset('storage/' . $site_logo->value) }}" alt="Logo">
                <h1 class="sitename">{{ $site_name->value ?? 'themes/Blogy' }}</h1>

            </a>
            <div class="d-none d-md-flex align-items-center">
                <i class="bi bi-clock me-1"></i>
                {{ \Carbon\Carbon::now()->setTimezone('Asia/Jayapura')->locale(app()->getLocale())->translatedFormat('l, d F Y • H:i') }}
                WIT
            </div>


        </div>
    </div>

    <div class="nav-wrap">
        <div class="container d-flex justify-content-center position-relative">
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}"
                            class="{{ request()->is('/') ? 'active' : '' }}">{{ __('frontend/home.home') }}</a></li>
                    @foreach ($menus as $menu)
                        @foreach ($menu->items as $item)
                            <li class="{{ $item->children->isNotEmpty() ? 'dropdown' : '' }}">
                                <a href="{{ $item->page
                                    ? route('pages.show', $item->page->slug)
                                    : ($item->post
                                        ? route('posts.show', $item->post->slug)
                                        : ($item->category
                                            ? route('categories.show', $item->category->slug)
                                            : $item->url)) }}"
                                    class="{{ Request::url() == url($item->url) ? 'active' : '' }}">
                                    {{ $item->label }}
                                    @if ($item->children->isNotEmpty())
                                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                                    @endif
                                </a>

                                @if ($item->children->isNotEmpty())
                                    <ul>
                                        @foreach ($item->children as $child)
                                            <li class="{{ $child->children->isNotEmpty() ? 'dropdown' : '' }}">
                                                <a
                                                    href="{{ $child->page
                                                        ? route('pages.show', $child->page->slug)
                                                        : ($child->post
                                                            ? route('posts.show', $child->post->slug)
                                                            : ($child->category
                                                                ? route('categories.show', $child->category->slug)
                                                                : $child->url)) }}">
                                                    {{ $child->label }}
                                                    @if ($child->children->isNotEmpty())
                                                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                                                    @endif
                                                </a>

                                                @if ($child->children->isNotEmpty())
                                                    <ul>
                                                        @foreach ($child->children as $subchild)
                                                            <li>
                                                                <a
                                                                    href="{{ $subchild->page
                                                                        ? route('pages.show', $subchild->page->slug)
                                                                        : ($subchild->post
                                                                            ? route('posts.show', $subchild->post->slug)
                                                                            : ($subchild->category
                                                                                ? route('categories.show', $subchild->category->slug)
                                                                                : $subchild->url)) }}">
                                                                    {{ $subchild->label }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endforeach
                    <li><a href="{{ route('galleries.front') }}">{{ __('frontend/home.galleries') }}</a></li>
                    <li class="dropdown">
                        <a href="#">
                            <img src="{{ asset('assets/' . app()->getLocale() . '.png') }}" alt="flag"
                                class="me-2" width="20">
                            {{ strtoupper(app()->getLocale()) }}
                            <i class="bi bi-chevron-down toggle-dropdown ms-1"></i>
                        </a>
                        <ul>
                            <li>
                                <a class="d-flex align-items-center {{ app()->getLocale() == 'id' ? 'active-nav' : '' }}"
                                    href="{{ route('lang.switch', ['lang' => 'id']) }}">
                                    <img src="{{ asset('assets/id.png') }}" alt="Indonesian" class="me-2"
                                        width="20">
                                    Indonesia
                                </a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center {{ app()->getLocale() == 'en' ? 'active-nav' : '' }}"
                                    href="{{ route('lang.switch', ['lang' => 'en']) }}">
                                    <img src="{{ asset('assets/en.png') }}" alt="English" class="me-2"
                                        width="20">
                                    English
                                </a>
                            </li>
                        </ul>
                    </li>


                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>

</header>
