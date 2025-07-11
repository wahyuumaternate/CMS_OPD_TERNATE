@extends('backend.layouts.main', ['title' => __('pages.title')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">{{ __('pages.all_pages') }}</h3>
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
                            <a href="#">{{ __('pages.all_pages') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('pages.create') }}" class="btn btn-label-info btn-round me-2">
                        <i class="fa fa-plus"></i> {{ __('pages.add') }}
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
                                            <th>{{ __('pages.title_column') }}</th>
                                            <th>{{ __('pages.slug') }}</th>
                                            <th>{{ __('pages.status') }}</th>
                                            <th>{{ __('pages.created_at') }}</th>
                                            <th>{{ __('pages.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pages as $page)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ route('pages.edit', $page->id) }}">{{ $page->title }}</a>
                                                </td>
                                                <td>{{ $page->slug }}</td>
                                                <td>
                                                    @if ($page->status === 'aktif')
                                                        <span class="badge badge-success">{{ __('pages.active') }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ __('pages.inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $page->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ route('pages.edit', $page->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $page->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <!-- Form Hapus -->
                                                    <form id="delete-form-{{ $page->id }}"
                                                        action="{{ route('pages.destroy', $page->id) }}" method="POST"
                                                        style="display: none;">
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
@endsection
