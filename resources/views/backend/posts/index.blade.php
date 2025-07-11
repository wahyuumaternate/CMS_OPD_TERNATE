@extends('backend.layouts.main', ['title' => __('posts.title')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <div class="page-header">
                        <h3 class="fw-bold mb-3 fs-3">{{ __('posts.title') }}</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="{{ route('dashboard') }}">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">{{ __('posts.all_posts') }}</a>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('posts.index') }}" class="me-2">
                        <i class="fa fa-list"></i> {{ __('posts.title') }} ({{ $totalPosts }})
                    </a>
                    @if ($hasTrashed)
                        <a href="{{ route('posts.index', ['status' => 'trashed']) }}">
                            <i class="fa fa-trash"></i> {{ __('posts.trash') }} ({{ $totalTrashed }})
                        </a>
                    @endif
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('posts.create') }}" class="btn btn-label-info btn-round me-2">
                        <i class="fa fa-plus"></i> {{ __('posts.add_post') }}
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="bulk-action-form" action="{{ route('posts.bulk_action') }}" method="POST">
                                @csrf
                                <div class="d-flex mb-3">
                                    <select id="bulkActionSelect" name="action" class="form-select me-2"
                                        style="width: 200px;">
                                        <option value="" disabled selected>{{ __('posts.bulk_action') }}</option>
                                        @if ($status !== 'trashed')
                                            <option value="publish">{{ __('posts.publish') }}</option>
                                            <option value="draft">{{ __('posts.draft') }}</option>
                                            <option value="trash">{{ __('posts.move_to_trash') }}</option>
                                        @else
                                            <option value="kembalikan">{{ __('posts.restore') }}</option>
                                            <option value="delete">{{ __('posts.delete_permanent') }}</option>
                                        @endif
                                    </select>
                                    <button type="button" id="applyAction"
                                        class="btn btn-primary">{{ __('posts.apply') }}</button>
                                </div>

                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all"></th>
                                                <th>{{ __('posts.judul') }}</th>
                                                <th>{{ __('posts.status') }}</th>
                                                <th>{{ __('posts.penulis') }}</th>
                                                <th>{{ __('posts.kategori') }}</th>
                                                <th>{{ __('posts.banner') }}</th>
                                                <th>{{ __('posts.featured') }}</th>
                                                <th>{{ __('posts.tanggal') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td><input type="checkbox" name="selected_posts[]"
                                                            value="{{ $post->id }}"></td>
                                                    <td>
                                                        @if ($post->deleted_at)
                                                            <span class="text-muted">{{ $post->title }}</span>
                                                        @else
                                                            <a
                                                                href="{{ route('posts.edit', $post->slug) }}">{{ $post->title }}</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (\App\Enums\PostStatus::isPublished($post->status))
                                                            <span class="badge badge-success">{{ $post->status }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ $post->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $post->author }}</td>
                                                    <td>
                                                        @foreach ($categories as $category)
                                                            @if ($category->id == $post->category_id)
                                                                {{ $category->name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if ($post->is_banner)
                                                            <span class="badge bg-success">{{ __('posts.active') }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-secondary">{{ __('posts.inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($post->is_featured)
                                                            <span class="badge bg-success">{{ __('posts.active') }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-secondary">{{ __('posts.inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $dates = \App\Helpers\DateHelper::formatDates(
                                                                $post->created_at,
                                                                $post->updated_at,
                                                                $post->deleted_at,
                                                            );
                                                        @endphp

                                                        @if (\App\Enums\PostStatus::isPublished($post->status))
                                                            <small>{{ __('posts.published_at') }}<br>{{ $dates['updatedAt'] }}</small>
                                                        @elseif (\App\Enums\PostStatus::isDraft($post->status))
                                                            <small>{{ __('posts.created_at') }}<br>{{ $dates['createdAt'] }}</small>
                                                        @else
                                                            <small>{{ __('posts.deleted_at') }}<br>{{ $dates['deletedAt'] }}</small>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const applyButton = document.getElementById('applyAction');

            if (applyButton) {
                applyButton.addEventListener('click', function() {
                    const selectedAction = document.getElementById('bulkActionSelect').value;

                    if (selectedAction === 'delete') {
                        Swal.fire({
                            title: @json(__('posts.confirm.title')),
                            text: @json(__('posts.confirm.text')),
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: @json(__('posts.confirm.yes')),
                            cancelButtonText: @json(__('posts.confirm.cancel'))
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('bulk-action-form').submit();
                            }
                        });
                    } else if (selectedAction) {
                        document.getElementById('bulk-action-form').submit();
                    } else {
                        Swal.fire({
                            title: @json(__('posts.bulk.select_action')),
                            text: @json(__('posts.bulk.select_action_info')),
                            icon: 'info',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }

            const selectAll = document.getElementById('select-all');
            if (selectAll) {
                selectAll.onclick = function() {
                    const checkboxes = document.querySelectorAll('input[name="selected_posts[]"]');
                    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                };
            }
        });
    </script>
@endpush
