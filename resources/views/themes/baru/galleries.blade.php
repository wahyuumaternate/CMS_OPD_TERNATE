php
@extends('themes.dinkes-theme.layouts.main', ['title' => 'Galeri - Dinkes Kota Ternate'])

@section('content')
    <div class="container py-4">
        <!-- Page Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="display-4 fw-bold text-primary mb-3">
                        <i class="fas fa-images me-3"></i>Galeri Foto
                    </h1>
                    <p class="lead text-muted">Dokumentasi kegiatan dan program Dinkes Kota Ternate</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Gallery Grid -->
                <div class="row">
                    @php
                        $galleries = \App\Models\Galleries::latest()->paginate(12);
                    @endphp

                    @forelse($galleries as $gallery)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ $gallery->image }}" class="card-img-top" alt="{{ $gallery->title }}"
                                        style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">

                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-images me-1"></i>{{ $gallery->images_count ?? 1 }}
                                        </span>
                                    </div>

                                    <div
                                        class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-50 text-white p-2">
                                        <small>
                                            <i class="fas fa-calendar me-1"></i>{{ $gallery->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('galleries.show', $gallery->slug) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $gallery->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted">{{ Str::limit($gallery->description, 100) }}</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('galleries.show', $gallery->slug) }}"
                                            class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-eye me-1"></i>Lihat Galeri
                                        </a>
                                        <small class="text-muted">
                                            <i class="fas fa-eye me-1"></i>{{ number_format($gallery->views) }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-images fa-5x text-muted mb-4"></i>
                                <h3 class="text-muted">Belum Ada Galeri</h3>
                                <p class="text-muted">Galeri foto akan ditampilkan di sini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if ($galleries->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $galleries->links() }}
                    </div>
                @endif
            </div>

            @include('themes.dinkes-theme.layouts.sidebar')
        </div>
    </div>

    <style>
        .card:hover img {
            transform: scale(1.05);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection
