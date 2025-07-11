@extends('backend.layouts.main', ['title' => __('pages.create')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">{{ __('pages.create') }}</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{ route('dashboard') }}"><i class="icon-home"></i></a>
                        </li>
                        <li class="separator"><i class="icon-arrow-right"></i></li>
                        <li class="nav-item"><a href="{{ route('pages.index') }}">{{ __('pages.title') }}</a></li>
                        <li class="separator"><i class="icon-arrow-right"></i></li>
                        <li class="nav-item"><a href="#">{{ __('pages.create') }}</a></li>
                    </ul>
                </div>
            </div>

            <form method="POST" action="{{ route('pages.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">{{ __('pages.title_column') }}</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">{{ __('pages.slug') }}</label>
                                    <input type="text" id="slug-display" class="form-control" value="{{ old('slug') }}"
                                        readonly>
                                    <input type="hidden" name="slug" id="slug" value="{{ old('slug') }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">{{ __('pages.content') }}</label>
                                    <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">{{ __('pages.status') }}</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="aktif">{{ __('pages.active') }}</option>
                                        <option value="nonaktif">{{ __('pages.inactive') }}</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('pages.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Sertakan skrip TinyMCE untuk editor teks -->
    <script src="{{ asset('backend/tinymce/tinymce.min.js') }}"></script>
    <script>
        const baseURL = "{{ url('/') }}/";

        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            document.getElementById('slug-display').value = baseURL + slug;
            document.getElementById('slug').value = slug;
        });

        tinymce.init({
            selector: '#editor',
            height: 500,
            menubar: 'file edit view insert format tools table help',
            plugins: [
                'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | removeformat | table link image media | code fullscreen preview',
            toolbar_mode: 'sliding',
            content_css: [
                'https://www.tiny.cloud/css/codepen.min.css'
            ],
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    let route_prefix = "{{ url('cms-opd-ternate-filemanager') }}";
                    window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');
                    window.SetUrl = function(items) {
                        let file_url = items[0].url;
                        callback(file_url, {
                            alt: items[0].name
                        });
                    };
                }
            },

            setup: function(editor) {
                editor.on('NodeChange', function(e) {
                    // Periksa apakah elemen yang diubah adalah gambar
                    if (e.element && e.element.nodeName === 'IMG') {
                        e.element.style.maxWidth =
                            '100%'; // Batasi lebar maksimum gambar ke 100% kontainer
                        e.element.style.height = 'auto'; // Pastikan aspek rasio terjaga
                    }
                });
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    </script>
@endsection
