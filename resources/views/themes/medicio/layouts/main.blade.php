<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @if (Request::is('/'))
        <!-- Primary Meta Tags -->
        <title>{{ $seo_title }}</title>
        <meta name="description" content="{{ $seo_description }}">
        <meta name="keywords" content="{{ $seo_keywords }}">
        <!-- Other head elements -->
        {{-- <title>{{ $site_name->value }}</title>
        <meta name="title" content="{{ $site_name->value }}">
        <meta name="description"
            content="{{ $seo_description }} Memiliki 8 fakultas dengan 40+ program studi dalam bidang sains, teknologi, sosial & humaniora.">
        <meta name="keywords"
            content="Kota Ternate, unkhair, kampus ternate, universitas negeri ternate, ptn ternate, kuliah di ternate, fakultas unkhair, pendaftaran unkhair, beasiswa unkhair, biaya kuliah unkhair, pmb unkhair, jalur masuk unkhair, akreditasi unkhair, jurusan unkhair, program studi unkhair"> --}}
        <meta name="robots" content="index, follow">
        <meta name="language" content="Indonesia">
        <meta name="author" content="Kota Ternate">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('') }}">
        <meta property="og:title" content="{{ $site_name->value }}">
        <meta property="og:description" content="{{ $seo_description }}">
        <meta property="og:image" content="{{ asset('storage/' . $site_logo->value) }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url('') }}">
        <meta property="twitter:title" content="{{ $site_name->value }}">
        <meta property="twitter:description" content="{{ $seo_description }}">
        <meta property="twitter:image" content="{{ asset('storage/' . $site_logo->value) }}">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url('') }}">

        <!-- Additional Meta Tags -->
        <meta name="geo.region" content="ID-MA" />
        <meta name="geo.placename" content="Ternate" />
        <meta name="geo.position" content="0.7714;127.3771" />
        <meta name="ICBM" content="0.7714, 127.3771" />

        <!-- Cache Control -->
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
    @endif

    {{-- <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('favicon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="{{ asset('favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('favicon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="{{ asset('favicon/apple-touch-icon-152x152.png') }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-128.png') }}" sizes="128x128" /> --}}
    <link rel="icon" href="{{ asset('storage/' . $site_logo->value) }}" type="image/png">

    <!-- Microsoft Tiles -->
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('favicon/mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('favicon/mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ asset('favicon/mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ asset('favicon/mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('favicon/mstile-310x310.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('themes/medicio/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/medicio/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/medicio/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/medicio/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/medicio/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/medicio/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('themes/medicio/assets/css/main.css') }}" rel="stylesheet">

    {{-- css --}}
    @stack('styles')
    <style>
        /* Pastikan dropdown tampil di bawah, tidak keluar ke kanan */
        .navmenu li.dropdown ul {
            position: absolute;
            left: 0;
            top: 100%;
            min-width: 200px;
            z-index: 999;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            border-radius: 4px;
        }

        /* Untuk dropdown bahasa khusus agar tidak overflow ke kanan */
        .navmenu>ul>li.dropdown>ul {
            right: 0;
            left: auto;
        }

        /* Dropdown item style */
        .navmenu li.dropdown ul li {
            position: relative;
            white-space: nowrap;
        }

        .navmenu li.dropdown ul li a {
            padding: 8px 20px;
            display: block;
            color: #000;
            background-color: transparent;
        }

        .navmenu li.dropdown ul li a:hover {
            background-color: #f5f5f5;
        }

        /* Pastikan tidak terpotong */
        .navmenu {
            overflow: visible;
            position: relative;
        }

        .navmenu>ul>li:last-child.dropdown>ul {
            right: 0;
            left: auto;
        }
    </style>
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body class="index-page">

    {{-- header --}}
    @include('themes/medicio/layouts/header')

    <main class="main">



        {{-- main --}}
        @yield('main')



    </main>

    {{-- footer --}}
    <footer id="footer" class="footer light-background">


        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ $site_name->value }}
                    {{ date('Y') }}</strong> <span>All
                    Rights Reserved</span>
            </p>

        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('themes/medicio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/medicio/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('themes/medicio/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('themes/medicio/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('themes/medicio/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('themes/medicio/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('themes/medicio/assets/js/main.js') }}"></script>

</body>

</html>
