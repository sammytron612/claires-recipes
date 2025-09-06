@extends('layouts.app', ['noFollow' => false, 'title' => 'Claires Recipes - ' . $category->title, 'description' => $category->title])
@section('content')
    @include('includes.search')

    <div class="w-full mt-4 flex h-full items-center justify-center relative">
        <div class="relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/' . $category->image) }}" alt="{{$category->title}}">
        </div>
        <!-- Title Overlay -->
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="max-w-7xl mx-auto flex items-center justify-center">
                <div class="rounded-lg p-6 shadow-lg" style="background: rgba(0,0,0,0.40);">
                    <h2 class="text-3xl md:text-4xl font-bold text-white text-center hover:text-gray-200 transition-colors">
                        {{ $category->title }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="text-lg py-5 w-3/4 mx-auto">
        <p>{{ $category->description }}</p>
    </div>

    <div class="container mx-auto px-3 py-3 bg-white">


        <div class="flex justify-center flex-wrap py-2 w-full gap-2">
            <a href="{{ route($url, ['slug' => $category->slug]) }} " rel="nofollow" class="inline-block mt-1 px-4 py-2 border border-teal-500 text-teal-500 rounded-full hover:bg-teal-50 transition-colors" wire:navigate><h5 class="pt-1">Reset</h5></a>
            <a href="{{ route($url, ['slug' => $category->slug, 'sort' => 'created_at']) }}" rel="nofollow" class="@if(str_contains(url()->current(), '/created_at')) bg-teal-500 text-white @else border border-teal-500 text-teal-500 hover:bg-teal-50 @endif mt-1 px-4 py-2 rounded-full transition-colors" aria-label="Most Recent" wire:navigate><h5 class="pt-1">Recent</h5></a>
            <a href="{{ route($url, ['slug' => $category->slug, 'sort' => 'rating']) }}" rel="nofollow" class="@if(str_contains(url()->current(), '/rating')) bg-teal-500 text-white @else border border-teal-500 text-teal-500 hover:bg-teal-50 @endif px-4 py-2 mt-1 rounded-full transition-colors" wire:navigate><h5 class="pt-1" aria-label="Highest Rated">Highest rated</h5></a>
            <a href="{{ route($url, ['slug' => $category->slug, 'sort' => 'views']) }}" rel="nofollow" class="@if(str_contains(url()->current(), '/views')) bg-teal-500 text-white @else border border-teal-500 text-teal-500 hover:bg-teal-50 @endif px-4 py-2 mt-1 rounded-full transition-colors" wire:navigate  ><h5 class="pt-1" aria-label="Most Viewed">Most viewed</h5></a>
        </div>
        
        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center px-5 md:px-16">
            @foreach($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @endforeach
        </div>
        
        <div class="flex justify-center mt-8 px-4">
            <div class="w-full max-w-4xl">
                {{ $recipes->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

@endsection
