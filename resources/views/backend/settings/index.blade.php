@extends('backend.layouts.main', ['title' => __('settings.title')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-1 fs-3">{{ __('settings.title') }}</h3>
                    <p class="mb-0 text-muted">
                        {{ __('settings.current_version') }}: <strong>{{ $currentVersion }}</strong>
                    </p>
                </div>

                <div class="ms-md-auto py-2 py-md-0">
                    <form id="updateForm" action="{{ route('admin.update.app') }}" method="POST" class="mt-3">
                        @csrf
                        <button id="updateButton" type="submit" class="btn btn-warning d-flex align-items-center"
                            @if (version_compare($remoteVersion, $currentVersion, '<=')) disabled style="opacity: 0.5; cursor: not-allowed;" @endif>
                            <span class="spinner-border spinner-border-sm me-2 d-none" id="updateSpinner" role="status"
                                aria-hidden="true"></span>
                            @if (version_compare($remoteVersion, $currentVersion, '<='))
                                {{ __('settings.up_to_date') }}
                            @else
                                {{ __('settings.update_button', ['version' => $remoteVersion]) }}
                            @endif
                        </button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-secondary mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="site-tab" data-bs-toggle="pill" href="#site" role="tab"
                                aria-controls="site" aria-selected="true">
                                <i class="fa fa-globe me-2"></i> {{ __('settings.tabs.site') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="logo-tab" data-bs-toggle="pill" href="#logo" role="tab"
                                aria-controls="logo" aria-selected="false">
                                <i class="fa fa-image me-2"></i> {{ __('settings.tabs.logo') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="seo-tab" data-bs-toggle="pill" href="#seo" role="tab"
                                aria-controls="seo" aria-selected="false">
                                <i class="fa fa-search me-2"></i> {{ __('settings.tabs.seo') }}
                            </a>
                        </li>
                    </ul>

                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="pills-tabContent">

                            {{-- Site Settings --}}
                            <div class="tab-pane fade show active" id="site" role="tabpanel"
                                aria-labelledby="site-tab">
                                <h4 class="mb-3"><i class="fa fa-globe me-2"></i> {{ __('settings.sections.site') }}</h4>
                                <div class="mb-3">
                                    <label for="site_name" class="form-label">{{ __('settings.form.site_name') }}</label>
                                    <input type="text" class="form-control" id="site_name" name="site_name"
                                        value="{{ $settings['site_name'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="footer_text"
                                        class="form-label">{{ __('settings.form.footer_text') }}</label>
                                    <input type="text" class="form-control" id="footer_text" name="footer_text"
                                        value="{{ $settings['footer_text'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="app_url" class="form-label">{{ __('settings.form.app_url') }}</label>
                                    <input type="text" class="form-control" id="app_url" name="app_url"
                                        value="{{ $settings['app_url'] ?? '' }}">
                                </div>
                            </div>

                            {{-- Logo Settings --}}
                            <div class="tab-pane fade" id="logo" role="tabpanel" aria-labelledby="logo-tab">
                                <h4 class="mb-3"><i class="fa fa-image me-2"></i> {{ __('settings.sections.logo') }}</h4>
                                <div class="mb-3">
                                    <label for="site_logo" class="form-label">{{ __('settings.form.upload_logo') }}</label>
                                    <input type="file" class="form-control" id="site_logo" name="site_logo"
                                        accept="image/*">
                                    @if (isset($settings['site_logo']))
                                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo"
                                            class="mt-3" style="max-height: 100px;">
                                    @endif
                                </div>
                            </div>

                            {{-- SEO Settings --}}
                            <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                <h4 class="mb-3"><i class="fa fa-search me-2"></i> {{ __('settings.sections.seo') }}
                                </h4>
                                <div class="mb-3">
                                    <label for="seo_title" class="form-label">{{ __('settings.form.seo_title') }}</label>
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                        value="{{ $settings['seo_title'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="seo_description"
                                        class="form-label">{{ __('settings.form.seo_description') }}</label>
                                    <textarea class="form-control" id="seo_description" name="seo_description" rows="3">{{ $settings['seo_description'] ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="seo_keywords"
                                        class="form-label">{{ __('settings.form.seo_keywords') }}</label>
                                    <textarea class="form-control" id="seo_keywords" name="seo_keywords" rows="2">{{ $settings['seo_keywords'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-round">
                                {{ __('settings.save_button') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
