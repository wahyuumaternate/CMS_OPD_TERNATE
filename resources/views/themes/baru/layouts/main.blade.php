<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dinkes Kota Ternate' }}</title>

    <!-- Meta Tags -->
    <meta name="description" content="Dinas Kesehatan Kota Ternate - Melayani dengan Hati untuk Kesehatan Masyarakat">
    <meta name="keywords" content="dinkes, kesehatan, ternate, maluku utara, puskesmas">
    <meta name="author" content="Dinkes Kota Ternate">

    @stack('head')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #ffc107;
            --secondary-color: #ff8800;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --border-color: #dee2e6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #fff;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-1px);
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .bg-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        }

        .border-primary {
            border-color: var(--primary-color) !important;
        }

        /* Card Enhancement */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Navigation */
        .navbar {
            background: #fff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
        }

        /* Footer */
        footer {
            background: var(--dark-color);
            color: #fff;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    @include('themes.dinkes-theme.layouts.header')

    <main>
        @yield('hero')
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-warning">Dinkes Kota Ternate</h5>
                    <p>Dinas Kesehatan Kota Ternate berkomitmen untuk memberikan pelayanan kesehatan terbaik bagi
                        masyarakat.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-warning">Kontak</h6>
                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i> Jl. Raya Ternate, Maluku Utara</p>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i> (0921) 123456</p>
                    <p><i class="fas fa-envelope me-2"></i> info@dinkeskotternate.go.id</p>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Dinkes Kota Ternate. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
