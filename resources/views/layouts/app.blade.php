<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">--}}

    <!-- Scripts -->
{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-67dcdfd2.css') }}" />
    <script type="module" src="{{ asset('build/assets/app-7757a2cf.js') }}"></script>
    @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('currency') }}">{{ __('Currencies') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('setting') }}">{{ __('Setting') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin') }}">{{ __('Admins') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.edit', Auth::id()) }}">
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @hasSection('content')
                @yield('content')
            @endif
            @if( isset($slot))
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    {{ $title ?? __('Dashboard') }}
                                    @if(isset($addRoute) and $addRoute != "" )
                                        <a href="{{ $addRoute }}" class="btn btn-success float-end mx-3">Add New {{ $title ?? 'Item' }}</a>
                                    @endif
                                    @if(isset($backRoute) and $backRoute != "" )
                                        <a href="{{ $backRoute }}" class="btn btn-outline-dark float-end mx-3">Return back</a>
                                    @endif
                                </div>
                                <div class="card-body">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center text-muted">
                    Developed By <a href="https://erfanebrahimi.ir" class="btn p-0 text-muted" target="_blank">Erfan Ebrahimi</a>
                </div>
            </div>
        </div>
    </div>
    <script defer src="{{ asset('alpinejs.js') }}"></script>
    @livewireScripts
</body>
</html>
