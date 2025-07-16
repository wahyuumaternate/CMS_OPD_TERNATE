 <!-- Header -->
 <header class="header">
     <div class="nav-container">
         <!-- Top Row: Logo + Info -->
         <div class="header-top">
             <!-- Logo -->
             <div class="logo">
                 <div class="logo-icon">
                     <img src="{{ asset('storage/' . $site_logo->value) }}"
                         alt="Logo {{ $site_name->value ?? 'Dinas Kesehatan Ternate' }}" />
                 </div>
                 <span>{{ $site_name->value ?? 'DINAS KESEHATAN TERNATE' }}</span>
             </div>

             <!-- Header Info -->
             <div class="header-info">
                 <div class="clock-info">
                     <i class="bi bi-clock"></i>
                     <span id="currentTime"></span> WIT
                 </div>
                 <!-- Simple Hamburger Button -->
                 <div class="hamburger" onclick="toggleSidebar()">
                     <span></span>
                     <span></span>
                     <span></span>
                 </div>
             </div>
         </div>

         <!-- Bottom Row: Navigation -->
         <div class="header-bottom">
             <nav class="nav">
                 <ul class="nav-menu">
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
                                 style="width: 20px; margin-right: 8px;">
                             {{ strtoupper(app()->getLocale()) }}
                             <i class="bi bi-chevron-down toggle-dropdown"></i>
                         </a>
                         <ul>
                             <li>
                                 <a style="display: flex; align-items: center;"
                                     class="{{ app()->getLocale() == 'id' ? 'active' : '' }}"
                                     href="{{ route('lang.switch', ['lang' => 'id']) }}">
                                     <img src="{{ asset('assets/id.png') }}" alt="Indonesian"
                                         style="width: 20px; margin-right: 8px;">
                                     Indonesia
                                 </a>
                             </li>
                             <li>
                                 <a style="display: flex; align-items: center;"
                                     class="{{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                     href="{{ route('lang.switch', ['lang' => 'en']) }}">
                                     <img src="{{ asset('assets/en.png') }}" alt="English"
                                         style="width: 20px; margin-right: 8px;">
                                     English
                                 </a>
                             </li>
                         </ul>
                     </li>
                 </ul>
             </nav>
         </div>
     </div>
 </header>

 <!-- Mobile Overlay -->
 <div class="mobile-overlay" onclick="closeSidebar()"></div>

 <!-- Mobile Sidebar -->
 <div class="mobile-sidebar">
     <div class="sidebar-header">
         <div class="sidebar-logo">{{ Str::limit($site_name->value ?? 'DINKES TERNATE', 15) }}</div>
         <button class="close-btn" onclick="closeSidebar()">&times;</button>
     </div>

     <ul class="sidebar-menu">
         <li><a href="{{ url('/') }}"
                 class="{{ request()->is('/') ? 'active' : '' }}">{{ __('frontend/home.home') }}</a></li>

         @foreach ($menus as $menu)
             @foreach ($menu->items as $item)
                 <li class="{{ $item->children->isNotEmpty() ? 'sidebar-dropdown' : '' }}">
                     <a href="{{ $item->page
                         ? route('pages.show', $item->page->slug)
                         : ($item->post
                             ? route('posts.show', $item->post->slug)
                             : ($item->category
                                 ? route('categories.show', $item->category->slug)
                                 : $item->url)) }}"
                         class="{{ Request::url() == url($item->url) ? 'active' : '' }}"
                         @if ($item->children->isNotEmpty()) onclick="toggleDropdown(event, this)" @endif>
                         {{ $item->label }}
                     </a>

                     @if ($item->children->isNotEmpty())
                         <ul class="sidebar-submenu">
                             @foreach ($item->children as $child)
                                 <li class="{{ $child->children->isNotEmpty() ? 'sidebar-dropdown' : '' }}">
                                     <a href="{{ $child->page
                                         ? route('pages.show', $child->page->slug)
                                         : ($child->post
                                             ? route('posts.show', $child->post->slug)
                                             : ($child->category
                                                 ? route('categories.show', $child->category->slug)
                                                 : $child->url)) }}"
                                         @if ($child->children->isNotEmpty()) onclick="toggleDropdown(event, this)" @endif>
                                         {{ $child->label }}
                                     </a>

                                     @if ($child->children->isNotEmpty())
                                         <ul class="sidebar-submenu">
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

         <li class="sidebar-dropdown">
             <a href="#" onclick="toggleDropdown(event, this)">
                 <img src="{{ asset('assets/' . app()->getLocale() . '.png') }}" alt="flag"
                     style="width: 20px; margin-right: 8px;">
                 {{ strtoupper(app()->getLocale()) }}
             </a>
             <ul class="sidebar-submenu">
                 <li>
                     <a style="display: flex; align-items: center;"
                         class="{{ app()->getLocale() == 'id' ? 'active' : '' }}"
                         href="{{ route('lang.switch', ['lang' => 'id']) }}">
                         <img src="{{ asset('assets/id.png') }}" alt="Indonesian"
                             style="width: 20px; margin-right: 8px;">
                         Indonesia
                     </a>
                 </li>
                 <li>
                     <a style="display: flex; align-items: center;"
                         class="{{ app()->getLocale() == 'en' ? 'active' : '' }}"
                         href="{{ route('lang.switch', ['lang' => 'en']) }}">
                         <img src="{{ asset('assets/en.png') }}" alt="English"
                             style="width: 20px; margin-right: 8px;">
                         English
                     </a>
                 </li>
             </ul>
         </li>
     </ul>
 </div>
