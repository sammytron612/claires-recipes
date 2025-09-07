@extends('layouts.app', [
    'image' => "fb2e60213d4b9e175f23e08bbc8ed01f.jpg", 
    'title' => 'Search Results for "' . $exactSearch . '" | Claires Recipes', 
    'description' => "Search results for " . $exactSearch . " - Find recipes, cuisines, ingredients and more at Claires Recipes"
])

@section('content')
@include('includes.search')

<div class="max-w-7xl mx-auto px-16 md:px-24 lg:px-32py-8">
    <!-- Search Header -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-teal-50 to-orange-50 rounded-xl p-6 shadow-lg border border-gray-100">
            <h1 class="text-center text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                Search Results for "<span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-orange-500">{{ $exactSearch }}</span>"
            </h1>
            <p class="text-gray-600">
                Found {{ $recipes->total() }} recipes and {{ $cuisines->count() + $ingredients->count() + $courses->count() + $methods->count() + $diets->count() }} other results
            </p>
        </div>
    </div>

    <!-- Recipes Section -->
    @if($recipes->count() > 0)
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41-6.88-6.88 1.37-1.37z"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-800">Recipes</h2>
                <span class="bg-teal-100 text-teal-800 text-sm font-medium px-3 py-1 rounded-full">{{ $recipes->total() }}</span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                @foreach($recipes as $recipe)
                    <x-recipe-card :recipe="$recipe" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $recipes->appends(request()->query())->links() }}
            </div>
        </div>
    @endif

    <!-- Other Categories -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Cuisines -->
        @if($cuisines->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">Cuisines</h3>
                    <span class="bg-orange-100 text-orange-800 text-sm font-medium px-2 py-1 rounded-full">{{ $cuisines->count() }}</span>
                </div>
                <div class="space-y-3">
                    @foreach($cuisines as $cuisine)
                        <a href="{{ route('cuisine', $cuisine->slug) }}" 
                           class="flex items-center p-3 hover:bg-orange-50 rounded-lg transition-colors duration-200 group">
                            <img class="w-12 h-12 object-cover rounded-lg mr-3" 
                                 src="{{ asset('storage/' . $cuisine->image) }}" 
                                 alt="{{ $cuisine->title }}">
                            <div>
                                <h4 class="font-medium text-gray-800 group-hover:text-orange-600">{{ $cuisine->title }}</h4>
                                <p class="text-gray-500 text-sm">Cuisine</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Ingredients -->
        @if($ingredients->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41-6.88-6.88 1.37-1.37z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">Ingredients</h3>
                    <span class="bg-green-100 text-green-800 text-sm font-medium px-2 py-1 rounded-full">{{ $ingredients->count() }}</span>
                </div>
                <div class="space-y-3">
                    @foreach($ingredients as $ingredient)
                        <a href="{{ route('ingredient', $ingredient->slug) }}" 
                           class="flex items-center p-3 hover:bg-green-50 rounded-lg transition-colors duration-200 group">
                            <img class="w-12 h-12 object-cover rounded-lg mr-3" 
                                 src="{{ asset('storage/' . $ingredient->image) }}" 
                                 alt="{{ $ingredient->title }}">
                            <div>
                                <h4 class="font-medium text-gray-800 group-hover:text-green-600">{{ $ingredient->title }}</h4>
                                <p class="text-gray-500 text-sm">Ingredient</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Courses -->
        @if($courses->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41-6.88-6.88 1.37-1.37z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">Courses</h3>
                    <span class="bg-purple-100 text-purple-800 text-sm font-medium px-2 py-1 rounded-full">{{ $courses->count() }}</span>
                </div>
                <div class="space-y-3">
                    @foreach($courses as $course)
                        <a href="{{ route('course', $course->slug) }}" 
                           class="flex items-center p-3 hover:bg-purple-50 rounded-lg transition-colors duration-200 group">
                            <img class="w-12 h-12 object-cover rounded-lg mr-3" 
                                 src="{{ asset('storage/' . $course->image) }}" 
                                 alt="{{ $course->title }}">
                            <div>
                                <h4 class="font-medium text-gray-800 group-hover:text-purple-600">{{ $course->title }}</h4>
                                <p class="text-gray-500 text-sm">Course</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Methods -->
        @if($methods->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41-6.88-6.88 1.37-1.37z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">Methods</h3>
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2 py-1 rounded-full">{{ $methods->count() }}</span>
                </div>
                <div class="space-y-3">
                    @foreach($methods as $method)
                        <a href="{{ route('method', $method->slug) }}" 
                           class="flex items-center p-3 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                            <img class="w-12 h-12 object-cover rounded-lg mr-3" 
                                 src="{{ asset('storage/' . $method->image) }}" 
                                 alt="{{ $method->title }}">
                            <div>
                                <h4 class="font-medium text-gray-800 group-hover:text-blue-600">{{ $method->title }}</h4>
                                <p class="text-gray-500 text-sm">Method</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Diets -->
        @if($diets->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41-6.88-6.88 1.37-1.37z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">Diets</h3>
                    <span class="bg-pink-100 text-pink-800 text-sm font-medium px-2 py-1 rounded-full">{{ $diets->count() }}</span>
                </div>
                <div class="space-y-3">
                    @foreach($diets as $diet)
                        <a href="{{ route('diet', $diet->slug) }}" 
                           class="flex items-center p-3 hover:bg-pink-50 rounded-lg transition-colors duration-200 group">
                            <img class="w-12 h-12 object-cover rounded-lg mr-3" 
                                 src="{{ asset('storage/' . $diet->image) }}" 
                                 alt="{{ $diet->title }}">
                            <div>
                                <h4 class="font-medium text-gray-800 group-hover:text-pink-600">{{ $diet->title }}</h4>
                                <p class="text-gray-500 text-sm">Diet</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- No Results -->
    @if($recipes->count() == 0 && $cuisines->count() == 0 && $ingredients->count() == 0 && $courses->count() == 0 && $methods->count() == 0 && $diets->count() == 0)
        <div class="text-center py-12">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-600 mb-2">No Results Found</h2>
            <p class="text-gray-500 mb-6">We couldn't find anything matching "{{ $exactSearch }}"</p>
            <a href="{{ route('home') }}" 
               class="inline-flex items-center bg-gradient-to-r from-teal-600 to-orange-500 text-white font-semibold px-6 py-3 rounded-full hover:from-teal-700 hover:to-orange-600 transition-all duration-200">
                Back to Home
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
        </div>
    @endif
</div>
@endsection
