@extends('backend.layouts.main', ['title' => __('comments.edit_comment')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">{{ __('comments.edit_comment') }}</h3>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name">{{ __('comments.name') }}</label>
                            <input type="text" id="name" class="form-control"
                                value="{{ old('name', $comment->name) }}" disabled>
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email">{{ __('comments.email') }}</label>
                            <input type="email" id="email" class="form-control"
                                value="{{ old('email', $comment->email) }}" disabled>
                        </div>

                        <!-- Content -->
                        <div class="form-group mb-3">
                            <label for="content">{{ __('comments.content') }}</label>
                            <textarea id="content" class="form-control" rows="4" disabled>{{ old('content', $comment->content) }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status">{{ __('comments.status') }}</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="pending" {{ $comment->status === 'pending' ? 'selected' : '' }}>
                                    {{ __('comments.pending') }}
                                </option>
                                <option value="approved" {{ $comment->status === 'approved' ? 'selected' : '' }}>
                                    {{ __('comments.approved') }}
                                </option>
                                <option value="rejected" {{ $comment->status === 'rejected' ? 'selected' : '' }}>
                                    {{ __('comments.rejected') }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('comments.update_button') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
