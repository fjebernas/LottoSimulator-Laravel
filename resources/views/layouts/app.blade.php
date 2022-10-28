<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lotto Simulator') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- CSS bootstrap --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    {{-- custom css for all pages --}}
    <link rel="stylesheet" href="/css/common.css">
    {{-- custom CSS per page --}}
    @yield('customcss')

    {{-- custom js for all pages --}}
    <script src="/js/common.js" type="module"></script>
    {{-- custom js --}}
    @yield('customjs')
</head>
<body>
    <span class="d-none" id="toast-data-holder" 
        data-msg="
            @if (session('notification') !== null)
                {{ session('notification')['message'] }}
            @endif
        "
        data-type="
            @if (session('notification') !== null)
                {{ session('notification')['type'] }}
            @endif
        ">
    </span>
    <div id="app" class="d-flex flex-column">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand fs-3" href="{{ url('/') }}">
                    {{ config('app.name', 'Lotto Simulator') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto fs-5">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="/records/leaderboards">🏆Leaderboards</a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

        <main class="py-5">
            <div class="container-md d-flex flex-column">
                @yield('content')
            </div>
        </main>

        <footer class="pb-2 mb-0 mt-auto text-center">
            <hr>
            <div class="d-flex justify-content-center flex-wrap pt-1">
                <p class="text-muted p-0 m-0">&copy; 2022 Developed by Francis Bernas.</p>
                <p class="text-muted p-0 m-0">&nbsp; This is a simulation of "lotto" game. This is made only to practice my webdev skills.</p>
            </div>
            <p class="text-muted p-0 mt-2">Lotto 6/42, Mega Lotto 6/45, Ultra Lotto 6/58 & Swertres are registered trademark of PSCO. I do not own them.</p>
        </footer>
    </div>
</body>
</html>
