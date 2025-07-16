<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal Dinas Kesehatan Kota Ternate</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('themes/retmu2/style.css') }}" />
    <style>
        /* Header Styles - DESKTOP (tidak diubah) */
        .header {
            background: #04164d !important;
            padding: 15px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            min-height: auto;
        }

        .header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100'><path d='M0,0 C300,100 700,0 1000,50 L1000,100 L0,100 Z' fill='rgba(255,255,255,0.1)'/></svg>") repeat-x;
            opacity: 0.3;
            z-index: 0;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }

        /* Top Row untuk Logo dan Info */
        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Bottom Row untuk Navigation */
        .header-bottom {
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }

        /* Logo Styles */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 18px;
            color: #fff;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
        }

        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Header Info (Clock, etc) */
        .header-info {
            display: flex;
            align-items: center;
            gap: 20px;
            color: #fff;
            font-size: 14px;
        }

        .header-info i {
            color: #f7ca44;
        }

        /* Navigation Menu - DESKTOP */
        .nav {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: center;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0;
            margin: 0;
            padding: 0;
            justify-content: center;
            width: 100%;
        }

        .nav-menu li {
            position: relative;
            margin: 2px 0;
        }

        .nav-menu>li>a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
            font-size: 14px;
        }

        .nav-menu>li>a:hover,
        .nav-menu>li>a.active {
            color: #f7ca44;
            background: rgba(255, 255, 255, 0.1);
        }

        /* Dropdown Styles - DESKTOP */
        .dropdown>a::after {
            content: '\f140';
            font-family: 'bootstrap-icons';
            margin-left: 5px;
            transition: transform 0.3s ease;
        }

        .dropdown:hover>a::after {
            transform: rotate(180deg);
        }

        /* Level 1 Dropdown - DESKTOP */
        .nav-menu li ul {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            background: #ffffff;
            list-style: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
            min-width: 220px;
            z-index: 999;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }

        .nav-menu li:nth-last-child(-n+2) ul {
            left: auto;
            right: 0;
        }

        .nav-menu li:hover>ul {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .nav-menu li ul::before {
            content: '';
            position: absolute;
            top: -15px;
            left: 0;
            right: 0;
            height: 15px;
            background: transparent;
        }

        .nav-menu li ul li {
            width: 100%;
            padding: 0;
            position: relative;
        }

        .nav-menu li ul li a {
            display: block;
            padding: 12px 20px;
            color: #04164d;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .nav-menu li ul li a:hover {
            background-color: #f8f9fa;
            color: #007bff;
            padding-left: 25px;
        }

        /* Level 2 Dropdown - DESKTOP */
        .nav-menu li ul li.dropdown>a::after {
            content: '\f285';
            font-family: 'bootstrap-icons';
            float: right;
            margin-top: 2px;
            transition: transform 0.3s ease;
        }

        .nav-menu li ul li.dropdown:hover>a::after {
            transform: rotate(90deg);
        }

        .nav-menu li ul li ul {
            top: 0;
            left: 100%;
            margin-left: 10px;
            min-width: 200px;
        }

        .nav-menu li:nth-last-child(-n+2) ul li ul {
            left: auto;
            right: 100%;
            margin-left: 0;
            margin-right: 10px;
        }

        .nav-menu li ul li ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: -15px;
            width: 15px;
            height: 100%;
            background: transparent;
        }

        .nav-menu li:nth-last-child(-n+2) ul li ul::before {
            left: auto;
            right: -15px;
        }

        /* Level 3 Dropdown - DESKTOP */
        .nav-menu li ul li ul li ul {
            top: 0;
            left: 100%;
            margin-left: 10px;
            min-width: 180px;
        }

        .nav-menu li:nth-last-child(-n+2) ul li ul li ul {
            left: auto;
            right: 100%;
            margin-left: 0;
            margin-right: 10px;
        }

        .nav-menu li ul li ul li ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: -15px;
            width: 15px;
            height: 100%;
            background: transparent;
        }

        .nav-menu li:nth-last-child(-n+2) ul li ul li ul::before {
            left: auto;
            right: -15px;
        }

        /* ================================ */
        /* MOBILE HAMBURGER BUTTON - SIMPLE */
        /* ================================ */
        .hamburger {
            display: none;
            width: 30px;
            height: 30px;
            cursor: pointer;
            position: relative;
            z-index: 10001;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background: white;
            margin: 5px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        /* Hamburger Animation */
        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        /* ================================ */
        /* MOBILE SIDEBAR */
        /* ================================ */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            right: -100%;
            width: 300px;
            height: 100vh;
            background: #04164d;
            z-index: 10000;
            transition: right 0.3s ease;
            overflow-y: auto;
        }

        .mobile-sidebar.open {
            right: 0;
        }

        /* Sidebar Header */
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-logo {
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .close-btn {
            color: white;
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 5px;
        }

        /* Sidebar Menu */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #f7ca44;
        }

        /* Dropdown dalam sidebar */
        .sidebar-dropdown {
            position: relative;
        }

        .sidebar-dropdown>a::after {
            content: '+';
            float: right;
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .sidebar-dropdown.active>a::after {
            transform: rotate(45deg);
        }

        .sidebar-submenu {
            max-height: 0;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.2);
            transition: max-height 0.3s ease;
        }

        .sidebar-dropdown.active .sidebar-submenu {
            max-height: 1000px;
        }

        .sidebar-submenu a {
            padding-left: 40px;
            font-size: 14px;
        }

        .sidebar-submenu .sidebar-submenu a {
            padding-left: 60px;
        }

        .sidebar-submenu .sidebar-submenu .sidebar-submenu a {
            padding-left: 80px;
        }

        /* Overlay */
        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Demo content */
        .demo-content {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .demo-content h1 {
            color: #04164d;
            margin-bottom: 20px;
        }

        .demo-content p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        /* ======================================= */
        /* RESPONSIVE STYLES */
        /* ======================================= */

        /* Desktop Styles (tidak diubah) */
        @media (max-width: 1200px) {
            .nav-container {
                padding: 0 15px;
            }

            .nav-menu>li>a {
                padding: 8px 12px;
                font-size: 13px;
            }

            .logo {
                font-size: 16px;
            }

            .nav-menu li ul {
                min-width: 200px;
            }
        }

        @media (max-width: 1024px) {
            .nav-menu>li>a {
                padding: 8px 10px;
                font-size: 12px;
            }

            .logo {
                font-size: 15px;
            }

            .header-info {
                font-size: 12px;
            }

            .nav-menu li ul {
                min-width: 180px;
            }
        }

        /* Mobile */
        @media (max-width: 768px) {
            .header {
                padding: 12px 0;
            }

            .nav-container {
                padding: 0 15px;
            }

            .logo {
                font-size: 14px;
            }

            .logo-icon {
                width: 35px;
                height: 35px;
            }

            /* Hide desktop nav */
            .nav {
                display: none;
            }

            /* Show hamburger */
            .hamburger {
                display: block;
            }

            body {
                padding-top: -75px;
            }

            /* Prevent scroll when sidebar open */
            body.no-scroll {
                overflow: hidden;
            }
        }

        @media (max-width: 480px) {
            .mobile-sidebar {
                width: 100%;
            }

            .logo {
                font-size: 12px;
            }

            .logo-icon {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>

<body>


    {{-- header --}}
    @include('themes.retmu2.layouts.header')
    {{-- hero --}}
    @include('themes.retmu2.layouts.hero')

    @yield('main')
    <script src="{{ asset('themes/retmu2/script.js') }}"></script>
    <script>
        // SIMPLE JAVASCRIPT - PASTI BERFUNGSI!

        function toggleSidebar() {
            console.log('Hamburger clicked!');
            const sidebar = document.querySelector('.mobile-sidebar');
            const overlay = document.querySelector('.mobile-overlay');
            const hamburger = document.querySelector('.hamburger');
            const body = document.body;

            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
            hamburger.classList.toggle('active');
            body.classList.toggle('no-scroll');

            console.log('Sidebar toggled, classes:', {
                sidebar: sidebar.classList.contains('open'),
                overlay: overlay.classList.contains('show'),
                hamburger: hamburger.classList.contains('active')
            });
        }

        function closeSidebar() {
            console.log('Closing sidebar...');
            const sidebar = document.querySelector('.mobile-sidebar');
            const overlay = document.querySelector('.mobile-overlay');
            const hamburger = document.querySelector('.hamburger');
            const body = document.body;

            sidebar.classList.remove('open');
            overlay.classList.remove('show');
            hamburger.classList.remove('active');
            body.classList.remove('no-scroll');
        }

        function toggleDropdown(event, element) {
            event.preventDefault();
            console.log('Dropdown clicked:', element.textContent);

            const parent = element.parentElement;
            const isActive = parent.classList.contains('active');

            // Close all other dropdowns at same level
            const siblings = parent.parentElement.children;
            for (let sibling of siblings) {
                if (sibling !== parent && sibling.classList.contains('sidebar-dropdown')) {
                    sibling.classList.remove('active');
                }
            }

            // Toggle current dropdown
            parent.classList.toggle('active');

            console.log('Dropdown toggled:', parent.classList.contains('active'));
        }

        // Close sidebar when window resized to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });

        console.log('Mobile sidebar script loaded successfully!');
    </script>

</body>

</html>
