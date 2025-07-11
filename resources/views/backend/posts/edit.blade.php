@extends('backend.layouts.main', ['title' => __('edit_posts.title_page')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">{{ __('edit_posts.title_page') }}</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{ route('dashboard') }}">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator"><i class="icon-arrow-right"></i></li>
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}">{{ __('edit_posts.breadcrumb.posts') }}</a>
                        </li>
                        <li class="separator"><i class="icon-arrow-right"></i></li>
                        <li class="nav-item">
                            <a href="#">{{ __('edit_posts.breadcrumb.edit') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <form method="POST" action="{{ route('posts.update', $post->slug) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- LEFT --}}
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                {{-- Title --}}
                                <div class="mb-3">
                                    <label for="title" class="form-label">{{ __('edit_posts.form.title') }}</label>
                                    <input type="text" name="title" id="title"
                                        value="{{ old('title', $post->title) }}" class="form-control" required>
                                </div>

                                {{-- Slug --}}
                                <div class="mb-3">
                                    <label for="slug" class="form-label">{{ __('edit_posts.form.slug') }}</label>
                                    <input type="text" id="slug-display" class="form-control"
                                        value="{{ old('slug', $post->slug) }}" readonly>
                                    <input type="hidden" name="slug" id="slug"
                                        value="{{ old('slug', $post->slug) }}">
                                </div>

                                {{-- Content --}}
                                <div class="mb-3">
                                    <label for="content" class="form-label">{{ __('edit_posts.form.content') }}</label>
                                    <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content', $post->content) }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('edit_posts.form.save') }}</button>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT --}}
                    <div class="col-md-3">
                        {{-- Image --}}
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label">{{ __('edit_posts.form.image') }}</label>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="image" id="fileUrl"
                                        value="{{ old('image', $post->image) }}"
                                        class="form-control @error('image') is-invalid @enderror" readonly>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="openFileManager()">{{ __('edit_posts.form.select_image') }}</button>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <img id="imagePreview" src="{{ asset(old('image', $post->image)) }}"
                                    style="max-width: 100%; display: {{ old('image', $post->image) ? 'block' : 'none' }};">
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="card">
                            <div class="card-body">
                                <label for="category_id" class="form-label">{{ __('edit_posts.form.category') }}</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" disabled>{{ __('edit_posts.form.select_category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label">{{ __('edit_posts.form.status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="draft" {{ $post->status->value === 'draft' ? 'selected' : '' }}>
                                        {{ __('edit_posts.status.draft') }}</option>
                                    <option value="published" {{ $post->status->value === 'published' ? 'selected' : '' }}>
                                        {{ __('edit_posts.status.published') }}</option>
                                    <option value="trashed" {{ $post->status->value === 'trashed' ? 'selected' : '' }}>
                                        {{ __('edit_posts.status.trashed') }}</option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Comments --}}
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label">{{ __('edit_posts.form.comments') }}</label>
                                <small class="text-muted">{{ __('edit_posts.form.comments_hint') }}</small>
                                <div class="d-flex mt-2">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="comments_is_active"
                                            value="1"
                                            {{ old('comments_is_active', $post->comments_is_active) == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ __('edit_posts.option.active') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="comments_is_active"
                                            value="0"
                                            {{ old('comments_is_active', $post->comments_is_active) == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ __('edit_posts.option.inactive') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Featured --}}
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label">{{ __('edit_posts.form.featured') }}</label>
                                <small class="text-muted">{{ __('edit_posts.form.featured_hint') }}</small>
                                <div class="d-flex mt-2">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="is_featured" value="1"
                                            {{ old('is_featured', $post->is_featured) == '1' ? 'checked' : '' }}
                                            {{ !$canBeFeatured ? 'disabled' : '' }}>
                                        <label class="form-check-label">{{ __('edit_posts.option.active') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_featured" value="0"
                                            {{ old('is_featured', $post->is_featured) == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ __('edit_posts.option.inactive') }}</label>
                                    </div>
                                </div>
                                @if (!$canBeFeatured)
                                    <small class="text-muted">{{ __('edit_posts.option.featured_limit') }}</small>
                                @endif
                            </div>
                        </div>

                        {{-- Banner --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                <label class="form-label">{{ __('edit_posts.form.banner') }}</label>
                                <small class="text-muted">{{ __('edit_posts.form.banner_hint') }}</small>
                                <div class="d-flex mt-2">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="is_banner" value="1"
                                            {{ old('is_banner', $post->is_banner) == '1' ? 'checked' : '' }}
                                            {{ !$canBeBanner ? 'disabled' : '' }}>
                                        <label class="form-check-label">{{ __('edit_posts.option.active') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_banner" value="0"
                                            {{ old('is_banner', $post->is_banner) == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ __('edit_posts.option.inactive') }}</label>
                                    </div>
                                </div>
                                @if (!$canBeBanner)
                                    <small class="text-muted">{{ __('edit_posts.option.banner_limit') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TinyMCE --}}
    <script src="{{ asset('backend/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value.toLowerCase().trim().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(
                /-+/g, '-');
            const base = "{{ url('/') }}/posts/";
            document.getElementById('slug-display').value = base + title;
            document.getElementById('slug').value = title;
        });

        function openFileManager() {
            const route_prefix = "{{ url('cms-opd-ternate-filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');
        }

        window.SetUrl = function(items) {
            if (items.length > 0) {
                let file_url = items[0].url;
                document.getElementById('fileUrl').value = file_url;
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = file_url;
                imagePreview.style.display = 'block';
            }
        };

        tinymce.init({
            selector: '#editor',
            height: 500,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | numlist bullist | removeformat | link image media | code fullscreen preview',
            toolbar_mode: 'sliding',
            file_picker_callback: function(callback, value, meta) {
                const route_prefix = "{{ url('cms-opd-ternate-filemanager') }}";
                window.open(route_prefix + '?type=' + meta.filetype, 'FileManager', 'width=800,height=600');
                window.SetUrl = function(items) {
                    let file_url = items[0].url;
                    callback(file_url, {
                        alt: items[0].name
                    });
                };
            },
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    </script>
@endsection
