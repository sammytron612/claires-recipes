<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @if(isset($noFollow))
        <meta name="robots" content="index,nofollow" />
    @else
        <meta name="robots" content="all" />
    @endif
   

    @isset($title)
        <title>{{$title}}</title>
        @if(isset($image))
            <meta property="og:image" content={{ asset('storage/'. $image) }}>
            <meta name="twitter:image" content="{{ asset('storage/'. $image) }}">
        @endif
       @if($description)
            <meta name="description" content="{{ $description }}">
            <meta content="{{$title}}" name="keywords">
       @endif
    
    @endisset
  



    @stack('styles')
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @livewireStyles
    @livewireScripts
    <style>
        .bg-custom {
            background: rgb(0,0,0);
            background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(137,137,139,1) 90%);
        }

        .recipe-ingredients__link {
            pointer-events:none;
        }

    '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'

.popover {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1060;
  display: block;
  max-width: 276px;
  font-family: "Nunito", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.6;
  text-align: left;
  text-align: start;
  text-decoration: none;
  text-shadow: none;
  text-transform: none;
  letter-spacing: normal;
  word-break: normal;
  word-spacing: normal;
  white-space: normal;
  line-break: auto;
  font-size: 0.7875rem;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 0.3rem;
  box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.2);
}

.popover .arrow {
  position: absolute;
  display: block;
  width: 1rem;
  height: 0.5rem;
  margin: 0 0.3rem;
}

.popover .arrow::before,
.popover .arrow::after {
  position: absolute;
  display: block;
  content: "";
  border-color: transparent;
  border-style: solid;
}

.bs-popover-top,
.bs-popover-auto[x-placement^=top] {
  margin-bottom: 0.5rem;
}

.bs-popover-top > .arrow,
.bs-popover-auto[x-placement^=top] > .arrow {
  bottom: calc(-0.5rem - 1px);
}

.bs-popover-top > .arrow::before,
.bs-popover-auto[x-placement^=top] > .arrow::before {
  bottom: 0;
  border-width: 0.5rem 0.5rem 0;
  border-top-color: rgba(0, 0, 0, 0.25);
}

.bs-popover-top > .arrow::after,
.bs-popover-auto[x-placement^=top] > .arrow::after {
  bottom: 1px;
  border-width: 0.5rem 0.5rem 0;
  border-top-color: #fff;
}

.bs-popover-right,
.bs-popover-auto[x-placement^=right] {
  margin-left: 0.5rem;
}

.bs-popover-right > .arrow,
.bs-popover-auto[x-placement^=right] > .arrow {
  left: calc(-0.5rem - 1px);
  width: 0.5rem;
  height: 1rem;
  margin: 0.3rem 0;
}

.bs-popover-right > .arrow::before,
.bs-popover-auto[x-placement^=right] > .arrow::before {
  left: 0;
  border-width: 0.5rem 0.5rem 0.5rem 0;
  border-right-color: rgba(0, 0, 0, 0.25);
}

.bs-popover-right > .arrow::after,
.bs-popover-auto[x-placement^=right] > .arrow::after {
  left: 1px;
  border-width: 0.5rem 0.5rem 0.5rem 0;
  border-right-color: #fff;
}

.bs-popover-bottom,
.bs-popover-auto[x-placement^=bottom] {
  margin-top: 0.5rem;
}

.bs-popover-bottom > .arrow,
.bs-popover-auto[x-placement^=bottom] > .arrow {
  top: calc(-0.5rem - 1px);
}

.bs-popover-bottom > .arrow::before,
.bs-popover-auto[x-placement^=bottom] > .arrow::before {
  top: 0;
  border-width: 0 0.5rem 0.5rem 0.5rem;
  border-bottom-color: rgba(0, 0, 0, 0.25);
}

.bs-popover-bottom > .arrow::after,
.bs-popover-auto[x-placement^=bottom] > .arrow::after {
  top: 1px;
  border-width: 0 0.5rem 0.5rem 0.5rem;
  border-bottom-color: #fff;
}

.bs-popover-bottom .popover-header::before,
.bs-popover-auto[x-placement^=bottom] .popover-header::before {
  position: absolute;
  top: 0;
  left: 50%;
  display: block;
  width: 1rem;
  margin-left: -0.5rem;
  content: "";
  border-bottom: 1px solid #f7f7f7;
}

.bs-popover-left,
.bs-popover-auto[x-placement^=left] {
  margin-right: 0.5rem;
}

.bs-popover-left > .arrow,
.bs-popover-auto[x-placement^=left] > .arrow {
  right: calc(-0.5rem - 1px);
  width: 0.5rem;
  height: 1rem;
  margin: 0.3rem 0;
}

.bs-popover-left > .arrow::before,
.bs-popover-auto[x-placement^=left] > .arrow::before {
  right: 0;
  border-width: 0.5rem 0 0.5rem 0.5rem;
  border-left-color: rgba(0, 0, 0, 0.25);
}

.bs-popover-left > .arrow::after,
.bs-popover-auto[x-placement^=left] > .arrow::after {
  right: 1px;
  border-width: 0.5rem 0 0.5rem 0.5rem;
  border-left-color: #fff;
}

.popover-header {
  padding: 0.5rem 0.75rem;
  margin-bottom: 0;
  font-size: 0.9rem;
  background-color: #f7f7f7;
  border-bottom: 1px solid #ebebeb;
  border-top-left-radius: calc(0.3rem - 1px);
  border-top-right-radius: calc(0.3rem - 1px);
}

.popover-header:empty {
  display: none;
}

.popover-body {
  padding: 0.5rem 0.75rem;
  color: #212529;
}

.pagination {
  display: flex;
  padding-left: 0;
  list-style: none;
  border-radius: 0.25rem;
}

.page-link {
  position: relative;
  display: block;
  padding: 0.5rem 0.75rem;
  margin-left: -1px;
  line-height: 1.25;
  color: #3490dc;
  background-color: #fff;
  border: 1px solid #dee2e6;
}

.page-link:hover {
  z-index: 2;
  color: #1d68a7;
  text-decoration: none;
  background-color: #e9ecef;
  border-color: #dee2e6;
}

.page-link:focus {
  z-index: 3;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
}

.page-item:first-child .page-link {
  margin-left: 0;
  border-top-left-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}

.page-item:last-child .page-link {
  border-top-right-radius: 0.25rem;
  border-bottom-right-radius: 0.25rem;
}

.page-item.active .page-link {
  z-index: 3;
  color: #fff;
  background-color: #3490dc;
  border-color: #3490dc;
}

.page-item.disabled .page-link {
  color: #6c757d;
  pointer-events: none;
  cursor: auto;
  background-color: #fff;
  border-color: #dee2e6;
}

.pagination-lg .page-link {
  padding: 0.75rem 1.5rem;
  font-size: 1.125rem;
  line-height: 1.5;
}

.pagination-lg .page-item:first-child .page-link {
  border-top-left-radius: 0.3rem;
  border-bottom-left-radius: 0.3rem;
}

.pagination-lg .page-item:last-child .page-link {
  border-top-right-radius: 0.3rem;
  border-bottom-right-radius: 0.3rem;
}

.pagination-sm .page-link {
  padding: 0.25rem 0.5rem;
  font-size: 0.7875rem;
  line-height: 1.5;
}

.pagination-sm .page-item:first-child .page-link {
  border-top-left-radius: 0.2rem;
  border-bottom-left-radius: 0.2rem;
}

.pagination-sm .page-item:last-child .page-link {
  border-top-right-radius: 0.2rem;
  border-bottom-right-radius: 0.2rem;
}


        

    </style>
</head>
<body class="flex flex-col min-h-screen font-merriweather">
    <div id="app">
        @if (Request::path() != 'login')
        <nav id="my-nav" class="py-2 text-base sticky top-0 bg-custom md:block z-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center">
                    <!-- Mobile menu button -->
                    <button 
                        type="button" 
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-gray-700 focus:outline-none"
                        onclick="toggleMobileMenu()"
                        aria-label="{{ __('Toggle navigation') }}"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:block w-full">
                        <div class="flex items-center justify-between">
                            <!-- Left Side Of Navbar -->
                            <ul class="flex space-x-0 md:space-x-5">
                                <li><a class="text-white hover:text-gray-200 px-3 py-2 transition-colors" href="{{ url('/home') }}" aria-label="Home">Home</a></li>
                                <li><a class="text-white hover:text-gray-200 px-3 py-2 transition-colors" href="{{ route('recipe-builder') }}" aria-label="Recipe Builder">Recipe builder</a></li>
                                <li><a class="text-white hover:text-gray-200 px-3 py-2 transition-colors" href="{{ route('recipe.index') }}" aria-label="Recipe Index">Recipe index</a></li>
                                <li><a class="text-white hover:text-gray-200 px-3 py-2 transition-colors" href="{{route('blog.index')}}" aria-label="Blog">Blog</a></li>
                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="flex items-center space-x-4">
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li>
                                            <a class="text-white hover:text-gray-200 px-3 py-2 transition-colors" href="{{ route('login') }}" aria-label="Login">{{ __('Login') }} </a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li>
                                            <a class="text-white hover:text-gray-200 px-3 py-2 transition-colors" href="{{ route('register') }}" aria-label="Register">{{ __('Register') }}</a>
                                        </li>
                                    @endif

                                @else
                                    <li class="relative" x-data="{ open: false }">
                                        <button 
                                            @click="open = !open" 
                                            class="text-white hover:text-gray-200 px-3 py-2 flex items-center transition-colors"
                                            aria-haspopup="true" 
                                            :aria-expanded="open"
                                        >
                                            {{ Auth::user()->name }}
                                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>

                                        <div 
                                            x-show="open" 
                                            @click.away="open = false"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                                        >
                                            @can('isAdmin')
                                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('admin.index') }}">
                                                Admin
                                                </a>
                                            @endcan
                                            @livewire('fav-count')

                                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile.planner') }}" aria-label="My Panner">
                                                My Planner
                                            </a>

                                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile.profile') }}" aria-label="Profile">
                                                My Profile
                                            </a>

                                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}" aria-label="Logout"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>

                    <!-- Mobile menu -->
                    <div id="mobile-menu" class="hidden md:hidden">
                        <div class="px-2 pt-2 pb-3 space-y-1">
                            <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{ url('/home') }}" aria-label="Home">Home</a>
                            <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{ route('recipe-builder') }}" aria-label="Recipe Builder">Recipe builder</a>
                            <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{ route('recipe.index') }}" aria-label="Recipe Index">Recipe index</a>
                            <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{route('blog.index')}}" aria-label="Blog">Blog</a>
                            
                            @guest
                                @if (Route::has('login'))
                                    <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{ route('login') }}" aria-label="Login">{{ __('Login') }}</a>
                                @endif
                                @if (Route::has('register'))
                                    <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{ route('register') }}" aria-label="Register">{{ __('Register') }}</a>
                                @endif
                            @else
                                <div class="border-t border-gray-600 pt-2">
                                    <div class="text-white px-3 py-2 font-medium">{{ Auth::user()->name }}</div>
                                    @can('isAdmin')
                                        <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{ route('admin.index') }}">Admin</a>
                                    @endcan
                                    <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{ route('profile.planner') }}" aria-label="My Planner">My Planner</a>
                                    <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{ route('profile.profile') }}" aria-label="Profile">My Profile</a>
                                    <a class="text-white hover:text-gray-200 block px-3 py-2 transition-colors" href="{{ route('logout') }}" aria-label="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        @endif

        <main class="flex-1">
            @yield('content')
        </main>
    </div>

    @if(!Request::is('login'))
        @include('includes.footer')
    @endif

    <script src="{{ mix('js/app.js') }}"></script>
    
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
    @stack('scripts')
    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('my-nav');
            if (window.pageYOffset > 50) {
                nav.classList.add('nav-opaque');
            } else {
                nav.classList.remove('nav-opaque');
            }
        });
    </script>
</body>
</html>
