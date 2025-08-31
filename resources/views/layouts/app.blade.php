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
        <nav id="my-nav" class="py-3 text-base sticky top-0 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 shadow-lg backdrop-blur-sm md:block z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center">
                    <!-- Logo/Brand -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/home') }}" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-orange-500 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-white hidden sm:block" style="font-family: 'Pacifico', cursive;">Claire's Recipes</span>
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <button 
                        type="button" 
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-colors"
                        onclick="toggleMobileMenu()"
                        aria-label="{{ __('Toggle navigation') }}"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:block">
                        <div class="flex items-center justify-between space-x-8">
                            <!-- Left Side Of Navbar -->
                            <ul class="flex space-x-1">
                                <li><a class="text-white hover:text-teal-300 px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 font-medium {{ Request::is('home') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{ url('/home') }}" aria-label="Home">Home</a></li>
                                <li><a class="text-white hover:text-teal-300 px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 font-medium {{ Request::is('recipe-builder') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{ route('recipe-builder') }}" aria-label="Recipe Builder">Recipe Builder</a></li>
                                <li><a class="text-white hover:text-teal-300 px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 font-medium {{ Request::is('recipe*') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{ route('recipe.index') }}" aria-label="Ingredients Index">Ingredients</a></li>
                                <li><a class="text-white hover:text-teal-300 px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 font-medium {{ Request::is('blog*') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{route('blog.index')}}" aria-label="Blog">Blog</a></li>
                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="flex items-center space-x-2">
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li>
                                            <a class="text-white hover:text-teal-300 px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 font-medium" href="{{ route('login') }}" aria-label="Login">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li>
                                            <a class="bg-gradient-to-r from-teal-500 to-orange-500 text-white px-6 py-2 rounded-lg hover:from-teal-600 hover:to-orange-600 transition-all duration-200 font-medium shadow-lg" href="{{ route('register') }}" aria-label="Register">{{ __('Register') }}</a>
                                        </li>
                                    @endif

                                @else
                                    <!-- Search Icon -->
                                    <li>
                                        <button class="text-white hover:text-teal-300 p-2 rounded-lg hover:bg-white/10 transition-all duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                            </svg>
                                        </button>
                                    </li>
                                    
                                    <!-- Notifications -->
                                    <li>
                                        <button class="text-white hover:text-teal-300 p-2 rounded-lg hover:bg-white/10 transition-all duration-200 relative">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                            </svg>
                                            <span class="absolute -top-1 -right-1 h-4 w-4 bg-orange-500 rounded-full text-xs flex items-center justify-center text-white">3</span>
                                        </button>
                                    </li>

                                    <!-- User Dropdown -->
                                    <li class="relative" x-data="{ open: false }">
                                        <button 
                                            @click="open = !open" 
                                            class="flex items-center space-x-2 text-white hover:text-teal-300 px-3 py-2 rounded-lg hover:bg-white/10 transition-all duration-200"
                                            aria-haspopup="true" 
                                            :aria-expanded="open"
                                        >
                                            <div class="w-8 h-8 bg-gradient-to-br from-teal-400 to-orange-500 rounded-full flex items-center justify-center">
                                                <span class="text-sm font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                            </div>
                                            <span class="font-medium hidden lg:block">{{ Auth::user()->name }}</span>
                                            <svg class="ml-1 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>

                                        <div 
                                            x-show="open" 
                                            @click.away="open = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-100"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg py-2 z-50 border border-gray-200"
                                        >
                                            <!-- User Info Header -->
                                            <div class="px-4 py-3 border-b border-gray-200">
                                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                                <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                            </div>

                                            @can('isAdmin')
                                                <a class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors" href="{{ route('admin.index') }}">
                                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    Admin Dashboard
                                                </a>
                                            @endcan
                                            
                                            @livewire('fav-count')

                                            <a class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors" href="{{ route('profile.planner') }}" aria-label="My Planner">
                                                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                My Planner
                                            </a>

                                            <a class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors" href="{{ route('profile.profile') }}" aria-label="Profile">
                                                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                My Profile
                                            </a>

                                            <div class="border-t border-gray-200 my-1"></div>

                                            <a class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors" href="{{ route('logout') }}" aria-label="Logout"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <svg class="w-4 h-4 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                </svg>
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
                    <div id="mobile-menu" class="hidden md:hidden bg-gray-800/95 backdrop-blur-sm">
                        <div class="px-4 pt-4 pb-6 space-y-2">
                            <!-- Mobile Navigation Links -->
                            <div class="space-y-1">
                                <a class="text-white hover:text-teal-300 hover:bg-white/10 block px-4 py-3 rounded-lg transition-all duration-200 font-medium {{ Request::is('home') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{ url('/home') }}" aria-label="Home">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        <span>Home</span>
                                    </div>
                                </a>
                                
                                <a class="text-white hover:text-teal-300 hover:bg-white/10 block px-4 py-3 rounded-lg transition-all duration-200 font-medium {{ Request::is('recipe-builder') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{ route('recipe-builder') }}" aria-label="Recipe Builder">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                        </svg>
                                        <span>Recipe Builder</span>
                                    </div>
                                </a>
                                
                                <a class="text-white hover:text-teal-300 hover:bg-white/10 block px-4 py-3 rounded-lg transition-all duration-200 font-medium {{ Request::is('recipe*') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{ route('recipe.index') }}" aria-label="Recipe Index">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                        <span>Recipes</span>
                                    </div>
                                </a>
                                
                                <a class="text-white hover:text-teal-300 hover:bg-white/10 block px-4 py-3 rounded-lg transition-all duration-200 font-medium {{ Request::is('blog*') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{route('blog.index')}}" aria-label="Blog">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        <span>Blog</span>
                                    </div>
                                </a>
                            </div>
                            
                            @guest
                                <div class="border-t border-gray-600 pt-4 mt-4 space-y-1">
                                    @if (Route::has('login'))
                                        <a class="text-white hover:text-teal-300 hover:bg-white/10 block px-4 py-3 rounded-lg transition-all duration-200 font-medium" href="{{ route('login') }}" aria-label="Login">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                                </svg>
                                                <span>{{ __('Login') }}</span>
                                            </div>
                                        </a>
                                    @endif
                                    @if (Route::has('register'))
                                        <a class="bg-gradient-to-r from-teal-500 to-orange-500 text-white block px-4 py-3 rounded-lg transition-all duration-200 font-medium" href="{{ route('register') }}" aria-label="Register">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                                </svg>
                                                <span>{{ __('Register') }}</span>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="border-t border-gray-600 pt-4 mt-4">
                                    <!-- User info -->
                                    <div class="flex items-center space-x-3 px-4 py-3 text-white">
                                        <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-orange-500 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <div class="font-medium">{{ Auth::user()->name }}</div>
                                            <div class="text-gray-300 text-sm">{{ Auth::user()->email }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-1 mt-3">
                                        @can('isAdmin')
                                            <a class="text-white hover:text-teal-300 hover:bg-white/10 block px-4 py-3 rounded-lg transition-all duration-200" href="{{ route('admin.index') }}">
                                                <div class="flex items-center space-x-3">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <span>Admin</span>
                                                </div>
                                            </a>
                                        @endcan
                                        
                                        <a class="text-white hover:text-teal-300 hover:bg-white/10 block px-4 py-3 rounded-lg transition-all duration-200" href="{{ route('profile.planner') }}" aria-label="My Planner">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <span>My Planner</span>
                                            </div>
                                        </a>
                                        
                                        <a class="text-white hover:text-teal-300 hover:bg-white/10 block px-4 py-3 rounded-lg transition-all duration-200" href="{{ route('profile.profile') }}" aria-label="Profile">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                <span>My Profile</span>
                                            </div>
                                        </a>
                                        
                                        <a class="text-red-300 hover:text-red-100 hover:bg-red-500/20 block px-4 py-3 rounded-lg transition-all duration-200" href="{{ route('logout') }}" aria-label="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                </svg>
                                                <span>{{ __('Logout') }}</span>
                                            </div>
                                        </a>
                                    </div>
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
