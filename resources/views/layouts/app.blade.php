<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height:100%;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="{{ config('APP_COMPANY') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="lang" content="{{ app()->getLocale() }}">

    <title>{{ config('app.name') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'node_modules/admin-lte/dist/js/adminlte.min.js?commonjs-entry'])
    @yield('css')
</head>
@php
    $userName = Auth::check() ? Auth::user()->name : '';
@endphp

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    @if (Auth::check())
        <div class="app-wrapper" id="app">
            <nav class="app-header navbar navbar-expand bg-body">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                                    class="fas fa-bars"></i> </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fa-solid fa-earth-americas"></i> {{ app()->getLocale() }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="/locale/en">
                                    English
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/locale/es">
                                    Español
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
                <div class="sidebar-brand">
                    <a href="/" class="brand-link">
                        <img src="https://i.ibb.co/yY2pKyT/salonesuvg-logo.png" alt="{{ config('app.name') }}"
                            class="brand-image">
                        <span class="brand-text fw-light">{{ config('app.name') }}</span>
                    </a>
                </div>

                <div class="sidebar-wrapper">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <span class="fa-stack text-primary">
                                <i class="fas fa-circle fa-stack-2x fa-inverse"></i>
                                <i class="fas fa-user fa-stack-1x"></i>
                            </span>
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ $userName }}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
                            {!! \Csgt\Utils\Menu::menu() !!}
                            <li class="nav-header">{{ Str::upper(trans_choice('User', 1)) }}</li>
                            <li class="nav-item">
                                <a href="/profile" class="nav-link">
                                    <i class="nav-icon fa fa-user"></i>{{ __('Profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <form action="/logout" method="post">
                                    {{ csrf_field() }}
                                    <a href='#' onclick='this.parentNode.submit(); return false;'
                                        class="nav-link">
                                        <i class="nav-icon fa fa-sign-out-alt"></i>
                                        <p>{{ __('Logout') }}</p>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </nav>

                </div>
            </aside>
            <main class="app-main">
                <br>
                <h1>Dashboard</h1>
                <iframe 
                    style="background: #F1F5F4;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);width: 78.5vw;height: 100vh;"  
                    src="https://charts.mongodb.com/charts-db-project-1-qqzhs/embed/dashboards?id=65daa048-d109-47e4-877f-19f06a1bdc84&theme=light&autoRefresh=true&maxDataAge=3600&showTitleAndDesc=false&scalingWidth=fixed&scalingHeight=fixed">
                </iframe>
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">@yield('title')</h3>
                            </div>
                            <div class="col-sm-6">
                                @yield('breadcrumb')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </main>
            <footer class="app-footer">
                <strong>Copyright &copy; {{ date('Y') == 2024 ? '2024' : '2024-' . date('Y') }} <a
                        href="{{ env('APP_COMPANY_URL') }}">{{ env('APP_COMPANY') }}</a>.</strong>
                {{ __('All rights reserved') }}
                <div class="float-right d-none d-sm-inline-block">
                    <b>ver.</b> {{ ENV('APP_VERSION') }}
                </div>
            </footer>
        </div>
    @else
        <style>
            html,
            body {
                height: 100% !important;
            }
        </style>
        <div class="row h-100 justify-content-center align-items-center">
            @yield('content')
        </div>
    @endif
    @yield('javascript')
    <script type="module">
        var a = document.querySelector(".nav-link.active");
        while (a) {
            if (a.className == "nav-item has-treeview") {
                a.getElementsByTagName("a")[0].classList.add("active");
                a.classList.add("menu-open");
            }
            a = a.parentNode;
        }

        @if (session()->has('message'))
            @if (session()->get('type') == 'danger')
                toastr.error('{{ session()->get('message') }}')
            @else
                toastr.{{ session()->get('type') }}(' {{ session()->get('message') }} ')
            @endif
        @endif
    </script>
</body>

</html>
