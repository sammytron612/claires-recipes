<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- sitemap -->
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ route('sitemap.index') }}">
    <!-- SEO Meta Tags -->
    
    <title>{{ $title ?? config('app.name', 'Claires Recipes') }}</title>
    <meta name="description" content="{{ $description ?? 'Discover delicious scratch cooking recipes tested in real home kitchens. Claire\'s Recipes offers tried and tested recipes for every occasion.' }}">
    <meta name="keywords" content="recipes, cooking, food, homemade, scratch cooking, kitchen, baking, {{ $keywords ?? 'dinner recipes, healthy cooking' }}">
    <meta name="author" content="Claire's Recipes">
    <meta name="robots" content="{{ isset($index) && $index ? 'index, ' : 'noindex, ' }}{{ isset($noFollow) && $noFollow ? 'nofollow' : 'follow' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? config('app.name', 'Claires Recipes') }}">
    <meta property="og:description" content="{{ $description ?? 'Discover delicious scratch cooking recipes tested in real home kitchens.' }}">
    <meta property="og:image" content="{{ isset($image) ? (str_starts_with($image, 'http') ? $image : asset('storage/' . $image)) : asset('storage/fb2e60213d4b9e175f23e08bbc8ed01f.jpg') }}">
    <meta property="og:site_name" content="Claire's Recipes">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $title ?? config('app.name', 'Claires Recipes') }}">
    <meta name="twitter:description" content="{{ $description ?? 'Discover delicious scratch cooking recipes tested in real home kitchens.' }}">
    <meta name="twitter:image" content="{{ isset($image) ? (str_starts_with($image, 'http') ? $image : asset('storage/' . $image)) : asset('storage/fb2e60213d4b9e175f23e08bbc8ed01f.jpg') }}">

    <!-- Additional SEO -->
    <meta name="theme-color" content="#14b8a6">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/apple-touch-icon.png') }}">

    <!-- JSON-LD Structured Data -->
    @if(isset($structuredData))
        {!! $structuredData !!}
    @else
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Claire's Recipes",
            "url": "{{ url('/') }}",
            "description": "Discover delicious scratch cooking recipes tested in real home kitchens. Claire's Recipes offers tried and tested recipes for every occasion.",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ url('/') }}/search?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
        </script>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" rel="preload">

 
    <style>
        .bg-custom {
            background: rgb(0,0,0);
            background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(137,137,139,1) 90%);
        }

        .recipe-ingredients__link {
            pointer-events:none;
        }

        .nav-opaque {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .nav-transparent {
            background: transparent;
        }
    </style>
</head>
<body style="background-color:#ffffff;">
    <div id="app">
<!-- Navigation -->
<nav id="navbar" class="fixed w-full top-0 z-50 transition-all duration-300 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-3 group">
                <a href="{{ url('/home') }}" class="flex items-center space-x-3" aria-label="Claire's Recipes Home" wire:navigate>
                    <!-- Simple Logo -->
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center group-hover:text-teal-700 transition-colors duration-200">
                        <svg class="w-8 h-8 text-teal-600 group-hover:text-teal-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41-6.88-6.88 1.37-1.37z"/>
                        </svg>
                    </div>
                    
                    <!-- Brand Text -->
                    <div>
                        <span class="text-xl font-bold text-teal-600 group-hover:text-teal-700 transition-colors duration-200">
                            Claire's Recipes
                        </span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-1">
                <a class="text-teal-800 hover:text-teal-700 hover:bg-gray-100 px-4 py-2 rounded-md transition-all duration-200 font-medium {{ Request::is('home') ? 'bg-gray-100 text-gray-800' : '' }}" href="{{ url('/home') }}" aria-label="Home" wire:navigate>
                    Home
                </a>
                
                <a class="text-teal-800 hover:text-teal-700 hover:bg-gray-100 px-4 py-2 rounded-md transition-all duration-200 font-medium {{ Request::is('recipe-builder') ? 'bg-gray-100 text-gray-800' : '' }}" href="{{ route('recipe-builder') }}" aria-label="Recipe Builder" wire:navigate>
                    Recipe Builder
                </a>
                
                <a class="text-teal-800 hover:text-teal-700 hover:bg-gray-100 px-4 py-2 rounded-md transition-all duration-200 font-medium {{ Request::is('blog*') ? 'bg-gray-100 text-gray-800' : '' }}" href="{{route('blog.index')}}" aria-label="Blog" wire:navigate>
                    Blog
                </a>
            </div>

            <!-- Right side: Mobile menu button + User Menu -->
            <div class="flex items-center space-x-2">
                <!-- Mobile Menu Button (Hamburger) -->
                <div class="md:hidden" x-data="{ mobileMenuOpen: false }">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="p-2 text-teal-600 hover:text-teal-700 hover:bg-gray-100 rounded-md transition-colors duration-200" 
                            aria-label="Toggle mobile menu">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Mobile Dropdown Menu -->
                    <div x-show="mobileMenuOpen" 
                         x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 scale-95" 
                         x-transition:enter-end="opacity-100 scale-100" 
                         x-transition:leave="transition ease-in duration-75" 
                         x-transition:leave-start="opacity-100 scale-100" 
                         x-transition:leave-end="opacity-0 scale-95" 
                         @click.away="mobileMenuOpen = false"
                         class="absolute top-full right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50" 
                         style="display: none;">
                        
                        <!-- Mobile Navigation Links -->
                        <div class="border-b border-gray-100 pb-2 mb-2">
                            <a href="{{ url('/home') }}" 
                               @click="mobileMenuOpen = false"
                               class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors {{ Request::is('home') ? 'bg-gray-50 text-teal-600' : '' }}" 
                               wire:navigate>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span class="font-medium">Home</span>
                            </a>
                            
                            <a href="{{ route('recipe-builder') }}" 
                               @click="mobileMenuOpen = false"
                               class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors {{ Request::is('recipe-builder') ? 'bg-gray-50 text-teal-600' : '' }}" 
                               wire:navigate>
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M7.5 2C6.119 2 5 3.119 5 4.5V6c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h1v2.5c0 .828.672 1.5 1.5 1.5S9 21.328 9 20.5V18h6v2.5c0 .828.672 1.5 1.5 1.5s1.5-.672 1.5-1.5V18h1c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2V4.5c0-1.381-1.119-2.5-2.5-2.5h-10zM7.5 4h9c.281 0 .5.219.5.5V6H7V4.5c0-.281.219-.5.5-.5zM5 8h14v8H5V8zm2 1v6h10V9H7z"/>
                                        <circle cx="12" cy="12" r="2"/>
                                </svg>
                                <span class="font-medium">Recipe Builder</span>
                            </a>
                            
                            <a href="{{ route('blog.index') }}" 
                               @click="mobileMenuOpen = false"
                               class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors {{ Request::is('blog*') ? 'bg-gray-50 text-teal-600' : '' }}" 
                               wire:navigate>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                                <span class="font-medium">Blog</span>
                            </a>
                        </div>

                        <!-- Guest Actions (only show when not authenticated) -->
                        @guest
                            <div class="px-4 py-2">
                                <p class="text-xs text-gray-500 mb-3">Get started with Claire's Recipes</p>
                                <div class="space-y-2">
                                    @if (Route::has('login'))
                                        <a href="{{ route('login') }}" 
                                           @click="mobileMenuOpen = false"
                                           class="block w-full text-center px-4 py-2 text-teal-700 border border-teal-600 rounded-md hover:bg-teal-50 transition-colors font-medium" 
                                           wire:navigate>
                                            Login
                                        </a>
                                    @endif
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" 
                                           @click="mobileMenuOpen = false"
                                           class="block w-full text-center px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors font-medium" 
                                           wire:navigate>
                                            Sign Up
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>

                <!-- User Menu (Desktop and Mobile) -->
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 text-gray-600 hover:text-gray-800 px-3 py-2 rounded-md hover:bg-gray-100 transition-all duration-200" aria-label="User menu">
                            <div class="w-8 h-8 bg-teal-700 rounded-full flex items-center justify-center">
                                <span class="text-sm font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden sm:block font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- User Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50" style="display: none;">
                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Menu Items -->
                            @can('isAdmin')
                                <a class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('admin.index') }}">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>Admin Panel</span>
                                </a>
                            @endcan
                            
                            <a class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('profile.planner') }}" aria-label="My Planner">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>My Planner</span>
                            </a>

                            @livewire('fav-count')
                            
                            <a class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('profile.profile') }}" aria-label="Profile">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>My Profile</span>
                            </a>
                            
                            <div class="border-t border-gray-100 mt-2 pt-2">
                                <a class="flex items-center space-x-3 px-4 py-3 text-red-600 hover:bg-red-50 transition-colors" href="{{ route('logout') }}" aria-label="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>{{ __('Logout') }}</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <!-- Guest Login/Register (Desktop Only) -->
                @guest
                    <div class="hidden md:flex items-center space-x-4">
                        @if (Route::has('login'))
                            <a class="text-teal-700 text-teal-800  px-2 sm:px-4 py-2 rounded-md border-teal-700 border-white border hover:bg-teal-50 hover:border-teal-200 transition-colors duration-200 font-medium text-sm" href="{{ route('login') }}" aria-label="Login" wire:navigate>
                                Login
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a class="bg-teal-600 text-white hover:text-teal-800 px-2 sm:px-4 py-2 rounded-md font-medium border-teal-700 border-white border hover:bg-teal-50 hover:border-teal-200 transition-colors duration-200 text-sm whitespace-nowrap" href="{{ route('register') }}" aria-label="Register" wire:navigate>
                                Sign Up
                            </a>
                        @endif
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

        <!-- Main Content with proper spacing for fixed navbar -->
        <main class="pt-20">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    
    
    

    
    <script>
        // Handle Alpine initialization after Livewire
        document.addEventListener('livewire:navigated', () => {
            console.log('Livewire navigated');
        });
    </script>

    <!-- Mobile menu toggle script -->
    <script>
        // Navbar opacity on scroll
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.pageYOffset > 50) {
                nav.classList.add('nav-opaque');
            } else {
                nav.classList.remove('nav-opaque');
            }
        });
    </script>
    @include('includes.footer')
</body>
</html>
