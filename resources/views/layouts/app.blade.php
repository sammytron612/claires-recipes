<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @livewireStyles
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
        <!-- Enhanced Navigation -->
        <nav id="navbar" class="fixed w-full top-0 z-50 transition-all duration-300 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 shadow-lg" style="background: linear-gradient(135deg, #1f2937 0%, #374151 50%, #1f2937 100%);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo and Brand -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/home') }}" class="flex items-center space-x-3 group" aria-label="Claire's Recipes Home">
                            <!-- Enhanced Recipe Logo -->
                            <div class="relative w-14 h-14 transform group-hover:scale-110 transition-all duration-300">
                                <!-- Background Circle with Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-br from-teal-400 via-emerald-500 to-orange-500 rounded-full shadow-lg group-hover:shadow-xl transition-shadow duration-300"></div>
                                
                                <!-- Chef Hat & Utensils SVG -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white transform group-hover:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                        <!-- Chef Hat -->
                                        <path d="M8.5 4.5c0-1.38 1.12-2.5 2.5-2.5s2.5 1.12 2.5 2.5c1.38 0 2.5 1.12 2.5 2.5 0 .69-.28 1.31-.73 1.76.44.19.73.63.73 1.24v8c0 .55-.45 1-1 1H7c-.55 0-1-.45-1-1v-8c0-.61.29-1.05.73-1.24C6.28 8.31 6 7.69 6 7c0-1.38 1.12-2.5 2.5-2.5z"/>
                                        <!-- Spoon -->
                                        <path d="M18 7c-.55 0-1 .45-1 1v2c0 .55.45 1 1 1s1-.45 1-1V8c0-.55-.45-1-1-1z"/>
                                        <!-- Fork -->
                                        <path d="M20 6v1c0 .55.45 1 1 1s1-.45 1-1V6c0-.55-.45-1-1-1s-1 .45-1 1z"/>
                                    </svg>
                                </div>
                                
                                <!-- Decorative Sparkles -->
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-300 rounded-full opacity-80 group-hover:animate-pulse"></div>
                                <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-pink-300 rounded-full opacity-60 group-hover:animate-pulse" style="animation-delay: 0.5s;"></div>
                            </div>
                            
                            <!-- Brand Text -->
                            <div class="hidden md:block">
                                <h1 class="text-2xl font-bold bg-gradient-to-r from-teal-300 via-emerald-300 to-orange-300 bg-clip-text text-transparent group-hover:from-teal-200 group-hover:to-orange-200 transition-all duration-300" style="font-family: 'Pacifico', cursive;">
                                    Claire's Recipes
                                </h1>
                                <p class="text-xs text-gray-300 group-hover:text-gray-200 transition-colors duration-200 font-medium">
                                    🍳 Tested & Trusted Since Day One
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a class="text-white hover:text-teal-300 hover:bg-white/10 px-4 py-2 rounded-lg transition-all duration-200 font-medium {{ Request::is('home') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{ url('/home') }}" aria-label="Home">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span>Home</span>
                            </div>
                        </a>
                        
                        <a class="text-white hover:text-teal-300 hover:bg-white/10 px-4 py-2 rounded-lg transition-all duration-200 font-medium {{ Request::is('recipe-builder') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{ route('recipe-builder') }}" aria-label="Recipe Builder">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                                <span>Recipe Builder</span>
                            </div>
                          </a>
                        
                        <a class="text-white hover:text-teal-300 hover:bg-white/10 px-4 py-2 rounded-lg transition-all duration-200 font-medium {{ Request::is('blog*') ? 'bg-teal-500/20 text-teal-300' : '' }}" href="{{route('blog.index')}}" aria-label="Blog">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span>Blog</span>
                            </div>
                        </a>
                    </div>

                    <!-- Right side: Search, Notifications, User Menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Search Icon -->
                        <button class="text-white hover:text-teal-300 p-2 rounded-lg hover:bg-white/10 transition-all duration-200" aria-label="Search">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>

                        <!-- Notifications Icon -->
                        <button class="text-white hover:text-teal-300 p-2 rounded-lg hover:bg-white/10 transition-all duration-200 relative" aria-label="Notifications">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                        </button>

                        @guest
                            @if (Route::has('login'))
                                <a class="text-white hover:text-teal-300 px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 font-medium" href="{{ route('login') }}" aria-label="Login">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                        </svg>
                                        <span>{{ __('Login') }}</span>
                                    </div>
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a class="bg-gradient-to-r from-teal-500 to-orange-500 text-white px-4 py-2 rounded-lg font-medium hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200" href="{{ route('register') }}" aria-label="Register">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                        <span>{{ __('Register') }}</span>
                                    </div>
                                </a>
                            @endif
                        @else
                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center space-x-3 text-white hover:text-teal-300 px-3 py-2 rounded-lg hover:bg-white/10 transition-all duration-200" aria-label="User menu">
                                    <div class="w-8 h-8 bg-gradient-to-br from-teal-400 to-orange-500 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="hidden md:block font-medium">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50" style="display: none;">
                                    <!-- User Info -->
                                    <div class="px-4 py-3 border-b border-gray-100">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-orange-500 rounded-full flex items-center justify-center">
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
                                    
                                    <a class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('profile.profile') }}" aria-label="Profile">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span>My Profile</span>
                                    </a>
                                    
                                    <div class="border-t border-gray-100 mt-2 pt-2">
                                        <a class="flex items-center space-x-3 px-4 py-3 text-red-600 hover:bg-red-50 transition-colors" href="{{ route('logout') }}" aria-label="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            <span>{{ __('Logout') }}</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Favorites count (if applicable) -->
                            @livewire('fav-count')
                        @endguest

                        <!-- Mobile menu button -->
                        <button class="md:hidden text-white hover:text-teal-300 p-2" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
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
        </nav>

        <!-- Main Content with proper spacing for fixed navbar -->
        <main class="pt-20">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    
    @livewireScripts
    
    <script>
        // Handle Alpine initialization after Livewire
        document.addEventListener('livewire:navigated', () => {
            console.log('Livewire navigated');
        });
    </script>

    <!-- Mobile menu toggle script -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

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
</body>
</html>
