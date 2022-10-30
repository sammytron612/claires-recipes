<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="robots" content="index, follow">
    <meta name=”robots” content=”noindex”>

    <meta name="robots" content="noindex,nofollow" />

    <meta name="robots" content="all" />

    @isset($title)
        <title>{{$title}}</title>
        <meta property="og:image" content={{ asset('storage/'. $image) }}>
        <meta name="twitter:image" content="{{ asset('storage/'. $image) }}">
       @if($description)
            <meta name="description" content="{{ $description }}">
            <meta content="{{$title}}" name="keywords">
       @endif
    
    @endisset
  



    @stack('styles')
    @livewireScripts
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">



    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @livewireStyles
    <style>

        .my-hover:hover
        {
            background-color: lightgray;
        }

        .nav-opaque
        {
            opacity: 0.5;
        }

        .bg-custom {
            background: rgb(0,0,0);
            background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(137,137,139,1) 90%);
        }

        .recipe-ingredients__link {
  pointer-events:none;
}


        

    </style>
</head>
<body class="d-flex flex-column h-100" style="font-family: Merriweather,serif;min-height:100vh">
    <div id="app">
        @if (Request::path() != 'login')
        <nav id="my-nav" class="py-2 h6 navbar sticky-top bg-custom navbar-expand-md navbar-dark">
            <div class="container">



                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link text-white" href="{{ url('/home') }}">Home</i>
                        </a>
                        </li>
                        <li class="ml-0 ml-md-5 nav-item">
                            <a class="nav-link text-white" href="{{ route('recipe-builder') }}">Recipe builder</a>
                        </li>
                        <li class="ml-0 ml-md-5 nav-item">
                            <a class="nav-link text-white" href="{{ route('recipe.index') }}">Recipe index</a>
                        </li>
                        <li class="ml-0 ml-md-5 nav-item">
                            <a class="nav-link text-white" href="">About</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="text-white nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="text-white nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="text-white nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @can('isAdmin')

                                            <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            Admin
                                            </a>

                                    @endcan
                                    @livewire('fav-count')

                                    <a class="dropdown-item" href="{{ route('profile.planner') }}">
                                        My Planner
                                    </a>

                                    <a class="dropdown-item" href="{{ route('profile.profile') }}">
                                        My Profile
                                    </a>

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
        @endif

        <main class="flex-shrink-0">
            @yield('content')
        </main>
    </div>


    @if(!Request::is('login'))
        @include('includes.footer')
    @endif


    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('scripts')
    <script>
        $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
            $('#my-nav').addClass('nav-opaque');
        } else {
            $('#my-nav').removeClass('nav-opaque');
        }
        });
    </script>
</body>
</html>
