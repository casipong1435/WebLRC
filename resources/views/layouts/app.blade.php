<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="{{ asset('css/design.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Option 1: Include in HTML -->

    <link href="https://fonts.googleapis.com/css?family= Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script src="{{mix('js/app.js')}}"></script>
    <!-- Styles -->
    
    <!-- Font Awesome -->
    @livewireStyles()
</head>
<body>
     
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src="{{asset('image/lrc.png')}}" height="60" width="60" class="mx-1" style="border-radius: 50%">
                <a class="navbar-brand d-none d-sm-block" href="{{ url('/') }}">
                   TCGC Learning Resource Center
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon fs-6"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
    

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
                        <li class="nav-item mx-1">
                            <a class="nav-link {{Route::currentRouteName() == 'home' ? 'active disabled':''}}" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link {{Route::currentRouteName() == 'activity' ? 'active disabled':''}}" href="{{ route('activity') }}">{{ __('Activity') }}</a>
                        </li>

                        <li class="nav-item mx-2">
                            <a class="nav-link {{Route::currentRouteName() == 'account' ? 'active disabled':''}}" href="{{ route('account') }}">{{ __('Account') }}</a>
                        </li>

                            <li class="nav-item mx-2">
                                <a class="nav-link fw-bold text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} <span><i class="bi bi-power"></i></span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>  
            </div>
        </nav>

        <main class="py-4">
            
            @yield('content')
        </main>
    </div>
    @livewireScripts()
   
</body>
</html>
