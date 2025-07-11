@extends('backend.layouts.main', ['title' => __('users.title')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">{{ __('users.all_users') }}</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <button class="btn btn-label-info btn-round me-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fa fa-plus"></i> {{ __('users.add_user') }}
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="usersTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('users.name') }}</th>
                                            <th>{{ __('users.email') }}</th>
                                            <th>{{ __('users.role') }}</th>
                                            <th>{{ __('users.created_at') }}</th>
                                            <th>{{ __('users.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            @if ($user->id != 1)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->is_admin ? __('users.admin') : __('users.user') }}</td>
                                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#editUserModal" data-id="{{ $user->id }}"
                                                            data-name="{{ $user->name }}"
                                                            data-email="{{ $user->email }}"
                                                            data-role="{{ $user->is_admin }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="POST" style="display:inline;"
                                                            id="delete-form-{{ $user->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $user->id }})">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
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

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">{{ __('users.add_user') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="{{ __('users.close') }}"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="addName" class="form-label">{{ __('users.name') }}</label>
                            <input type="text" class="form-control" id="addName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">{{ __('users.email') }}</label>
                            <input type="email" class="form-control" id="addEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="addRole" class="form-label">{{ __('users.role') }}</label>
                            <select class="form-select" id="addRole" name="is_admin" required>
                                <option value="0">{{ __('users.user') }}</option>
                                <option value="1">{{ __('users.admin') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">{{ __('users.password') }}</label>
                            <input type="password" class="form-control" id="addPassword" name="password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('users.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('users.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">{{ __('users.update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="{{ __('users.close') }}"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editUserForm">

                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editName" class="form-label">{{ __('users.name') }}</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">{{ __('users.email') }}</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">{{ __('users.role') }}</label>
                            <select class="form-select" id="editRole" name="is_admin" required>
                                <option value="0">{{ __('users.user') }}</option>
                                <option value="1">{{ __('users.admin') }}</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('users.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('users.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#editUserModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');
            var userName = button.data('name');
            var userEmail = button.data('email');
            var userRole = button.data('role');

            var modal = $(this);
            modal.find('#editUserId').val(userId);
            modal.find('#editName').val(userName);
            modal.find('#editEmail').val(userEmail);
            modal.find('#editRole').val(userRole);

            var actionUrl = "{{ route('users.update', ['user' => ':id']) }}";
            actionUrl = actionUrl.replace(':id', userId);
            modal.find('#editUserForm').attr('action', actionUrl);
        });
    </script>
@endpush
