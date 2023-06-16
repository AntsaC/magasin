<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Mikalo - '.($title ?? '') }}</title>
    <link rel="stylesheet" href="{{ asset("dt/datatables.min.css") }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
@yield('style')
<div id="app">
    @auth
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="#" class="logo d-flex align-items-center">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Logo">
                    <span class="d-none d-lg-block">Mikalo</span>
                </a>
                <i id="toggle" class="fa fa-bars fa-lg"></i>
            </div><!-- End Logo -->
            <div class="w-100">
                <h5 class="mt-1 text-center fw-bold">{{ Auth::user()->is_admin() ? 'Central' : (Auth::user()->sale_point->location ?? '') }}</h5>
            </div>
            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
{{--                            <img alt="Profile" class="rounded-circle">--}}
                            <div data-initials="{{ Auth::user()->initial() }}">
                            </div>
                            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ Auth::user()->name }}</h6>
                                <span>{{ Auth::user()->role->name }}</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    <span>Sign Out</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header>
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                @include('layouts.'.strtolower(Auth::user()->role->abbr).'-nav')

            </ul>

        </aside>
    @endauth
    <main id="main" class="py-4 main">
        @yield('content')
    </main>
</div>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset("dt/datatables.min.js") }}"></script>
<script>
    $(document).ready(function () {
        $("#toggle").click(function (){
            $("body").toggleClass("toggle-sidebar")
        })
    })
</script>
@yield('js')
</body>
</html>
