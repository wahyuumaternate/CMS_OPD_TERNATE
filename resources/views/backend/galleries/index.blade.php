@extends('backend.layouts.main', ['title' => __('galleries.title')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">{{ __('galleries.all') }}</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('galleries.create') }}" class="btn btn-label-info btn-round me-2">
                        <i class="fa fa-plus"></i> {{ __('galleries.add') }}
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('galleries.image') }}</th>
                                            <th>{{ __('galleries.name') }}</th>
                                            <th>{{ __('galleries.status') }}</th>
                                            <th>{{ __('galleries.created_at') }}</th>
                                            <th>{{ __('galleries.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleries as $gallery)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($gallery->image)
                                                        <img src="{{ $gallery->image }}" alt="{{ $gallery->name }}"
                                                            class="img-fluid" style="max-height: 50px;">
                                                    @else
                                                        <span>{{ __('galleries.no_image') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $gallery->name }}</td>
                                                <td>
                                                    @if ($gallery->status === 'active')
                                                        <span
                                                            class="badge badge-success">{{ __('galleries.active') }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger">{{ __('galleries.inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $gallery->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ route('galleries.edit', $gallery->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $gallery->id }}"
                                                        action="{{ route('galleries.destroy', $gallery->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $gallery->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
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
@endsection
