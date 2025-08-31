
@extends('layouts.app', ['image'=> "fb2e60213d4b9e175f23e08bbc8ed01f.jpg", 'title' => 'Home | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])


@section('content')
<div class="max-w-full">
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-center">
            {{ session('error') }}
        </div>
    @endif
   @include('includes.search')

    <!-- Hero Section with Welcome Message -->
    <div class="relative">
        <!-- Welcome Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent z-20 flex items-center">
            <div class="max-w-7xl mx-auto px-8 text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 text-orange-500" style="font-family: 'Pacifico', cursive;">
                    Welcome to Claire's Recipes
                </h1>
                <p class="text-xl md:text-2xl mb-6 max-w-2xl font-bold text-teal-500">
                    Discover delicious, tested recipes that work every time
                </p>
                <button class="bg-teal-500 hover:bg-teal-600 text-white px-8 py-3 rounded-full text-lg font-semibold transition-colors shadow-lg">
                    Start Cooking
                </button>
            </div>
        </div>

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
        style="height: 60vh;">
            
            <!-- Carousel Items -->
            <div class="relative w-full h-full">
                @foreach($recipes as $index => $recipe)
                <div x-show="currentSlide === {{ $index }}" 
                     x-transition:enter="transition ease-in-out duration-500"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in-out duration-500"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform -translate-x-full"
                     class="absolute inset-0 w-full h-full"
                     style="display: none;"
                     x-show.transition="currentSlide === {{ $index }}">
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $recipe->image) }}" alt="{{$recipe->title}}">
                    
                </div>
                @endforeach
            </div>

            <!-- Navigation Arrows -->
            <button @click="prevSlide()" 
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all z-20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="sr-only">Previous</span>
            </button>
            
            <button @click="nextSlide()" 
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all z-20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="sr-only">Next</span>
            </button>

            <!-- Indicators -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
                @foreach($recipes as $index => $recipe)
                <button @click="currentSlide = {{ $index }}" 
                        :class="currentSlide === {{ $index }} ? 'bg-white' : 'bg-white bg-opacity-50'"
                        class="w-3 h-3 rounded-full transition-all hover:bg-opacity-75">
                </button>
                @endforeach
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Sections with Better Spacing -->
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto py-5 px-8 lg:px-24">
            <x-breadcrumb/>
        <div class="mb-8 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6" style="font-family: 'Pacifico', cursive;">
                Hello and welcome to Claire's Recipes!
            </h2>
            <div class="max-w-4xl mx-auto space-y-4 text-lg text-gray-600 leading-relaxed">
                <p>Thank you so much for stopping by the site! If you are new to Claire's Recipes,
                    the one thing you should know about us is that we are obsessed with creating
                    scratch cooking recipes that you will love.</p>

                <p>There are two things we think about when deciding if a recipe is good enough to go on the site.</p>

                <div class="grid md:grid-cols-2 gap-8 my-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-teal-600 mb-3">Does it work?</h3>
                        <p>Does the dish make us smile inside and out? Do we want to eat the whole batch by ourselves?</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-orange-500 mb-3">Is it worth the effort?</h3>
                        <p>If the dish tastes great, is it worth the effort? Do we want to make it again (and again and again)?</p>
                    </div>
                </div>

                <p class="font-semibold text-gray-800">This is what we strive for—recipes you can rely on to work every time and be worth your time, effort, and money to make!</p>

                <p>Our goal is to encourage people to cook at home, and to make the process of feeding your family and loved ones less intimidating and more enjoyable.
                Our recipes are all tested in our own home kitchens, usually several times.</p>
            </div>
        </div>
        
        <!-- Decorative Divider -->
        <div class="flex items-center justify-center my-12">
            <div class="flex-grow border-t border-gray-300"></div>
            <div class="px-6">
                <svg class="w-8 h-8 text-teal-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>
        
	<x-season-comp />
        
        <!-- Another Decorative Divider -->
        <div class="flex items-center justify-center my-12">
            <div class="flex-grow border-t border-gray-300"></div>
            <div class="px-6">
                <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>
        
        <div class="mt-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8" style="font-family: 'Pacifico', cursive;">Our Top 10 Favorites</h2>
            <div class="mt-2 flex flex-wrap justify-center gap-4">
                @foreach($top10 as $recipe)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-xs relative 
                                md:w-[calc(50%-0.5rem)] lg:w-[calc(33.333%-0.67rem)]">
                        <a href="{{ route('recipe', ['id'=>$recipe->id, 'slug'=> $recipe->slug]) }}" 
                           class="absolute inset-0 z-10" aria-label="{{$recipe->title}}">
                        </a>
                        <div>
                            <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $recipe->image) }}" alt="{{$recipe->title}}">
                        </div>
                        <div class="p-4">
                            <h5 class="font-bold text-teal-600 mb-2">{{ $recipe->title }}
                                @auth
                                    @foreach($favourites as $fav)
                                        @if($recipe->id == $fav->recipe_id)<span><i class="text-red-500 fa far fa-heart"></i></span>@endif
                                    @endforeach
                                @endauth
                            </h5>
                            <x-rating-system rating="{{ $recipe->rating }}"></x-rating-system>
                            <small class="font-bold text-teal-800 block mt-1">By {{ $recipe->user->name }}</small>
                        </div>
                        <div class="flex items-center justify-between p-4 pt-0">
                            @if($recipe->cooking_time)
                                <div class="flex items-center">
                                    <i class="text-blue-500 fa fa-clock"></i>
                                    <span class="font-bold ml-1">{{ $recipe->cooking_time }} mins</span>
                                </div>
                            @else
                                <div></div>
                            @endif

                            @if(count($recipe->commentRecipe))
                                <div class="font-bold text-teal-600">{{ count($recipe->commentRecipe) }} Reviews</div>
                            @else
                                <div class="font-bold text-teal-600">No Reviews</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    <hr>

</section>


@endsection
