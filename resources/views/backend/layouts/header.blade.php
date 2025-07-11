<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('backend/assets/img/logo-unkhair.png') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Centered Search Icon Trigger for Modal -->
            <div class="d-flex justify-content-center flex-grow-1">
                <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                        <div class="input-group search-input">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-search pe-1">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input type="text" placeholder="{{ __('messages.type_to_search') }}" class="fl">
                        </div>
                    </nav>
                </a>
            </div>

            <!-- Right Aligned User Profile Dropdown -->
            <ul class="navbar-nav align-items-center">

                <li class="nav-item">
                    <a class="btn btn-primary" href="/" target="_blank" role="button">
                        <i class="fa fa-globe me-1"></i> {{ __('messages.visit_website') }}
                    </a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="languageDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/' . app()->getLocale() . '.png') }}" alt="flag" class="me-2"
                            width="20">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center {{ app()->getLocale() == 'id' ? 'active-nav' : '' }}"
                                href="{{ route('lang.switch', ['lang' => 'id']) }}">
                                <img src="{{ asset('assets/id.png') }}" alt="Indonesian" class="me-2" width="20">
                                Indonesia
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center {{ app()->getLocale() == 'en' ? 'active-nav' : '' }}"
                                href="{{ route('lang.switch', ['lang' => 'en']) }}">
                                <img src="{{ asset('assets/en.png') }}" alt="English" class="me-2" width="20">
                                English
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item topbar-user dropdown hidden-caret">

                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ asset('backend/assets/img/profile-logo.png') }}" alt="..."
                                class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">{{ __('messages.hi') }}</span>
                            <span class="fw-bold">{{ explode(' ', auth()->user()->name)[0] }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ asset('backend/assets/img/profile-logo.png') }}"
                                            alt="image profile" class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ auth()->user()->name }}</h4>
                                        <p class="text-muted">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    {{ __('messages.account_setting') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('messages.logout') }}
                                    </a>
                                </form>
                            </li>
                        </div>
                    </ul>

                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">{{ __('messages.search') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control"
                        placeholder="{{ __('messages.type_to_search') }}" aria-label="Search" autocomplete="off"
                        autofocus>
                </div>

                <ul id="searchResults" class="list-group list-group-item-action">
                    <!-- Dynamic search results will appear here -->
                </ul>
                <!-- Helper text for keyboard shortcuts -->
                <div class="shortcut-helper text-muted mt-3 small mb-3">
                    {{ __('messages.press') }} <kbd>Enter</kbd> {{ __('messages.to_select') }},
                    <kbd>↑</kbd>/<kbd>↓</kbd> {{ __('messages.to_navigate') }},
                    <kbd>Esc</kbd> {{ __('messages.to_close') }}
                </div>



            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .modal-body {
            position: relative;
        }

        #searchInput {
            font-size: 16px;
            padding: 10px;
            border-radius: 6px;
        }

        #searchResults {
            max-height: 300px;
            overflow-y: auto;
            list-style-type: none;
            margin-top: 10px;
            padding: 0;
        }

        #searchResults .search-item {
            padding: 10px 15px;
            border-bottom: 1px solid #f1f1f1;
        }

        #searchResults .search-item a {
            text-decoration: none;
            color: #333;
            font-size: 15px;
            display: block;
        }

        #searchResults .search-item:hover {
            background-color: #f9f9f9;
        }

        #searchResults .list-group-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border: none;
            /* Remove borders for a cleaner look */
            border-bottom: 1px solid #e6e6e6;
            /* Divider between items */
        }

        #searchResults .list-group-item:last-child {
            border-bottom: none;
            /* Remove border for the last item */
        }

        #searchResults .list-group-item i {
            color: #007bff;
            /* Customize icon color */
        }

        #searchResults .list-group-item:hover {
            background-color: #f8f9fa;
            text-decoration: none;
            cursor: pointer;
        }

        #searchResults .list-group-item span {
            font-size: 15px;
            color: #333;
        }

        .shortcut-helper {
            font-size: 0.85em;
            color: #6c757d;
            /* Text-muted color */
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .shortcut-helper kbd {
            background-color: #e9ecef;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 0.85em;
            font-weight: 500;
        }
    </style>
@endpush

@push('scripts')
    <!-- JavaScript for Dynamic Search -->
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let query = this.value.trim();

            if (query.length > 0) {
                // Make an AJAX request to fetch search results
                fetch(`/search-menu?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        let searchResults = document.getElementById('searchResults');
                        searchResults.innerHTML = ''; // Clear previous results

                        if (data.length > 0) {
                            data.forEach(item => {
                                let a = document.createElement('a');
                                a.href = item.url;
                                a.classList.add('list-group-item', 'list-group-item-action', 'd-flex',
                                    'align-items-center', 'justify-content-between');

                                // Create icon element
                                let icon = document.createElement('i');
                                icon.style.color = '#007bff'; // Set color to blue
                                icon.classList.add('fa', 'fa-hashtag',
                                    'me-3'
                                ); // Icon style (e.g., hashtag) and margin adjustment
                                a.appendChild(icon);

                                // Create title text
                                let text = document.createElement('span');
                                text.textContent = item.name;
                                text.style.flex = '1';
                                a.appendChild(text);

                                searchResults.appendChild(a);
                            });
                        } else {
                            let noResults = document.createElement('div');
                            noResults.classList.add('list-group-item', 'list-group-item-action', 'disabled');
                            noResults.textContent = 'No results found';
                            searchResults.appendChild(noResults);
                        }
                    })
                    .catch(error => console.error('Error fetching search results:', error));
            } else {
                document.getElementById('searchResults').innerHTML = ''; // Clear results when query is empty
            }
        });

        document.getElementById('searchInput').addEventListener('keydown', function(e) {
            const results = document.querySelectorAll('#searchResults .list-group-item');
            let activeIndex = Array.from(results).findIndex(item => item.classList.contains('active'));

            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    if (activeIndex < results.length - 1) {
                        if (activeIndex >= 0) results[activeIndex].classList.remove('active');
                        results[activeIndex + 1].classList.add('active');
                    }
                    break;

                case 'ArrowUp':
                    e.preventDefault();
                    if (activeIndex > 0) {
                        results[activeIndex].classList.remove('active');
                        results[activeIndex - 1].classList.add('active');
                    }
                    break;

                case 'Enter':
                    e.preventDefault();
                    if (activeIndex >= 0) {
                        window.location.href = results[activeIndex].getAttribute('href');
                    }
                    break;

                case 'Escape':
                    const modal = bootstrap.Modal.getInstance(document.getElementById('searchModal'));
                    modal.hide();
                    break;
            }
        });

        document.getElementById('searchModal').addEventListener('shown.bs.modal', function() {
            document.getElementById('searchInput').focus();
        });
    </script>
@endpush
