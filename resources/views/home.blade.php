
@php
    // Generate structured data for home page
    $structuredData = [
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => "Claire's Recipes",
        "url" => url('/'),
        "description" => "Discover delicious scratch cooking recipes tested in real home kitchens. Claire's Recipes offers tried and tested recipes you can rely on to work every time.",
        "potentialAction" => [
            "@type" => "SearchAction",
            "target" => url('/') . "/search/{search_term_string}",
            "query-input" => "required search_term_string"
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => "Claire's Recipes",
            "logo" => [
                "@type" => "ImageObject",
                "url" => asset('storage/fb2e60213d4b9e175f23e08bbc8ed01f.jpg')
            ]
        ]
    ];
@endphp

@extends('layouts.app', [
    'image' => "fb2e60213d4b9e175f23e08bbc8ed01f.jpg", 
    'title' => 'Claire\'s Recipes - Tested Scratch Cooking Recipes You Can Trust', 
    'description' => "Discover delicious scratch cooking recipes tested in real home kitchens. Every recipe is tried multiple times to ensure it works perfectly and is worth your time and effort.",
    'keywords' => 'scratch cooking, tested recipes, homemade recipes, cooking from scratch, reliable recipes, home cooking, family recipes, kitchen tested',
    'structuredData' => '<script type="application/ld+json">' . json_encode($structuredData, JSON_UNESCAPED_SLASHES) . '</script>'
])


@section('content')
<main class="max-w-full">
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-center" role="alert">
            {{ session('error') }}
        </div>
    @endif
   @include('includes.search')

    <!-- Hero Section with Recipe Carousel -->
    <section class="relative" aria-label="Featured Recipes Carousel">
        <h1 class="sr-only">Claire's Recipes - Tested Scratch Cooking Recipes</h1>
        <!-- Carousel -->
        <div class="mt-4">
            <div x-data="{
            currentSlide: 0,
            slides: {{ count($recipes) }},
            autoPlay: true,
            autoPlayInterval: null,
            init() {
                this.startAutoPlay();
            },
            startAutoPlay() {
                if (this.autoPlay) {
                    this.autoPlayInterval = setInterval(() => {
                        this.nextSlide();
                    }, 5000);
                }
            },
            stopAutoPlay() {
                if (this.autoPlayInterval) {
                    clearInterval(this.autoPlayInterval);
                    this.autoPlayInterval = null;
                }
            },
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.slides;
            },
            prevSlide() {
                this.currentSlide = this.currentSlide === 0 ? this.slides - 1 : this.currentSlide - 1;
            }
        }" 
        @mouseenter="stopAutoPlay()" 
        @mouseleave="startAutoPlay()"
        class="relative overflow-hidden"
        style="height: 60vh;"
        role="region"
        aria-label="Recipe carousel">
            
            <!-- Carousel Items -->
            <div class="relative w-full h-full z-0">
                @foreach($recipes as $index => $recipe)
                <div x-show="currentSlide === {{ $index }}" 
                     x-transition:enter="transition ease-in-out duration-500"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in-out duration-500"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform -translate-x-full"
                     class="absolute inset-0 w-full h-full"
                     role="img"
                     aria-label="{{$recipe->title}}">
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $recipe->image) }}" alt="{{$recipe->title}} - Featured Recipe">
                    
                    <!-- Recipe Title Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <div class="max-w-7xl mx-auto flex items-center justify-center">
                            <div class="rounded-lg p-6 shadow-lg" style="background: rgba(0,0,0,0.40);">
                                <a href="{{ route('recipe', ['id' => $recipe->id, 'slug' => $recipe->slug]) }}" 
                                   class="block">
                                    <h2 class="text-3xl md:text-4xl font-bold text-white text-center hover:text-gray-200 transition-colors">
                                        {{ $recipe->title }}
                                    </h2>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation Arrows -->
            <button @click="prevSlide()" 
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all z-20"
                    aria-label="Previous recipe">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="sr-only">Previous</span>
            </button>
            
            <button @click="nextSlide()" 
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all z-20"
                    aria-label="Next recipe">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="sr-only">Next</span>
            </button>

            <!-- Indicators -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20" role="tablist" aria-label="Recipe indicators">
                @foreach($recipes as $index => $recipe)
                <button @click="currentSlide = {{ $index }}" 
                        :class="currentSlide === {{ $index }} ? 'bg-white' : 'bg-white bg-opacity-50'"
                        class="w-3 h-3 rounded-full transition-all hover:bg-opacity-75"
                        role="tab"
                        aria-label="Show recipe {{ $index + 1 }}"
                        :aria-selected="currentSlide === {{ $index }}">
                </button>
                @endforeach
            </div>
            </div>
        </div>
    </section>
</main>

<!-- Content Sections with Better Spacing -->
<section class="bg-gray-50 py-12" aria-label="About Claire's Recipes">
    <div class="max-w-7xl mx-auto py-5 px-8 lg:px-24">
          
        <header class="mb-8 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">
                Hello and welcome to Claire's Recipes!
            </h2>
            <div class="max-w-4xl mx-auto space-y-4 text-lg text-gray-600 leading-relaxed">
                <p>Thank you so much for stopping by the site! If you are new to Claire's Recipes,
                    the one thing you should know about us is that we are obsessed with creating
                    <strong>scratch cooking recipes</strong> that you will love.</p>

                <p>There are two things we think about when deciding if a recipe is good enough to go on the site.</p>

                <div class="grid md:grid-cols-2 gap-8 my-8">
                    <article class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-teal-600 mb-3">Does it work?</h3>
                        <p>Does the dish make us smile inside and out? Do we want to eat the whole batch by ourselves?</p>
                    </article>
                    <article class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-orange-500 mb-3">Is it worth the effort?</h3>
                        <p>If the dish tastes great, is it worth the effort? Do we want to make it again (and again and again)?</p>
                    </article>
                </div>

                <p class="font-semibold text-gray-800">This is what we strive for—<em>recipes you can rely on to work every time</em> and be worth your time, effort, and money to make!</p>

                <p>Our goal is to encourage people to cook at home, and to make the process of feeding your family and loved ones less intimidating and more enjoyable.
                Our recipes are all <strong>tested in our own home kitchens</strong>, usually several times.</p>
            </div>
        </header>
        
        <!-- Meal Planner Call-to-Action Section -->
        <section class="bg-gradient-to-r from-teal-100 to-orange-100 text-white rounded-xl p-8 mb-12 shadow-lg" aria-label="Meal Planner Signup">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-6">
                    <svg class="w-16 h-16 mx-auto text-teal-300/80" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold mb-4 text-black">Take the Stress Out of Meal Planning!</h3>
                <p class="text-xl mb-6 text-black/90">
                    Join Claire's Recipes community and get access to our exclusive meal planner. 
                    Plan your weekly meals with tested recipes, generate shopping lists, and make home cooking effortless.
                </p>
                <div class="space-y-4">
                    <div class="grid md:grid-cols-3 gap-4 text-sm mb-6">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5 text-black/90" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-black/90">Weekly meal plans</span>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5 text-black/90" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-black/90">Auto shopping lists</span>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5 text-black/90" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-black/90">Recipe favorites</span>
                        </div>
                    </div>
                    @guest
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('register') }}" 
                           class="bg-white text-teal-600 font-bold py-3 px-8 rounded-lg hover:bg-gray-50 transition-colors shadow-md">
                            Sign Up Free
                        </a>
                        <a href="{{ route('login') }}" 
                           class="text-gray-800 hover:text-gray-200 font-medium underline transition-colors">
                            Already have an account? Sign in
                        </a>
                    </div>
                    @else
                    <div class="flex justify-center">
                        <a href="{{ route('profile.planner') }}" 
                           class="bg-white text-teal-600 font-bold py-3 px-8 rounded-lg hover:bg-gray-50 transition-colors shadow-md">
                            Access Your Meal Planner
                        </a>
                    </div>
                    @endguest
                </div>
            </div>
        </section>
        
        <!--Divider -->
        <div class="flex items-center justify-center my-12" role="separator" aria-hidden="true">
            <div class="flex-grow border-t border-gray-300"></div>
            <div class="px-6">
                <svg class="w-8 h-8 text-teal-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>
        
	<x-season-comp />
        
        <!-- Top 10 Recipes Section -->
        <div class="flex items-center justify-center my-12" role="separator" aria-hidden="true">
            <div class="flex-grow border-t border-gray-300"></div>
            <div class="px-6">
                <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>
        
        <section class="mt-8" aria-label="Featured Recipes">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Our Highest Rated Recipes</h2>
            <div class="mt-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 items-center justify-center gap-4" role="list">
                @foreach($top10 as $recipe)
                    <div role="listitem">
                        <x-recipe-card :recipe="$recipe" />
                    </div>
                @endforeach
            </div>
        </section>

    <hr>

</section>


@endsection
