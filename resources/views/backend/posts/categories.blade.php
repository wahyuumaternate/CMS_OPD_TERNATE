@extends('backend.layouts.main', ['title' => __('categories.title')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">{{ __('categories.heading') }}</h3>
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
                            <a href="{{ route('posts.index') }}">{{ __('categories.breadcrumb.posts') }}</a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">{{ __('categories.breadcrumb.categories') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="javascript:void(0);" class="btn btn-label-info btn-round me-2" data-bs-toggle="modal"
                        data-bs-target="#createCategoryModal">
                        <i class="fa fa-plus"></i> {{ __('categories.button.add') }}
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('categories.table.name') }}</th>
                                            <th>{{ __('categories.table.slug') }}</th>
                                            <th>{{ __('categories.table.created_at') }}</th>
                                            <th>{{ __('categories.table.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        onclick="editCategory({{ $category }})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $category->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $category->id }}"
                                                        action="{{ route('categories.destroy', $category->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('categories.modal.add_title') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('categories.form.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('categories.button.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('categories.button.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('categories.modal.edit_title') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">{{ __('categories.form.name') }}</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('categories.button.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('categories.button.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function editCategory(category) {
            document.getElementById('edit_name').value = category.name;
            document.getElementById('editCategoryForm').action = `/cms-unkhair/cp/posts/categories/all/${category.id}`;
            var editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            editModal.show();
        }
    </script>
@endpush
