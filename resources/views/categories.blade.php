@extends('layouts.app', ['noFollow' => true, 'title' => $category->title . ' | Claires Recipes', 'description' => $category->title])

@section('content')
    @include('includes.search')

    <div class="w-full mt-4 flex h-full items-center justify-center relative">
        <div class="relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/' . $category->image) }}" alt="{{$category->title}}">
        </div>
        <div class="absolute flex h-full items-center justify-center">
            <h3 style="background: rgba(204, 204, 204, 0.8);font-family: 'Pacifico', cursive;" class="border border-gray-800 text-gray-800 p-2 md:p-5">{{ $category->title}}</h3>
        </div>
    </div>

    <div class="text-lg py-5 w-3/4 mx-auto">
        <p>{{ $category->description }}</p>
    </div>

    <div class="container mx-auto px-3 py-3 bg-white">


        <div class="flex justify-center flex-wrap py-2 w-full gap-2">
            <a href="{{ route($url, ['slug' => $category->slug]) }} " rel="nofollow" class="inline-block mt-1 px-4 py-2 border border-teal-500 text-teal-500 rounded-full hover:bg-teal-50 transition-colors"><h5 class="pt-1">Reset</h5></a>
            <a href="{{ route($url, ['slug' => $category->slug, 'sort' => 'created_at']) }}" rel="nofollow" class="@if(str_contains(url()->current(), '/created_at')) bg-teal-500 text-white @else border border-teal-500 text-teal-500 hover:bg-teal-50 @endif mt-1 px-4 py-2 rounded-full transition-colors" aria-label="Most Recent"><h5 class="pt-1">Recent</h5></a>
            <a href="{{ route($url, ['slug' => $category->slug, 'sort' => 'rating']) }}" rel="nofollow" class="@if(str_contains(url()->current(), '/rating')) bg-teal-500 text-white @else border border-teal-500 text-teal-500 hover:bg-teal-50 @endif px-4 py-2 mt-1 rounded-full transition-colors"><h5 class="pt-1" aria-label="Highest Rated">Highest rated</h5></a>
            <a href="{{ route($url, ['slug' => $category->slug, 'sort' => 'views']) }}" rel="nofollow" class="@if(str_contains(url()->current(), '/views')) bg-teal-500 text-white @else border border-teal-500 text-teal-500 hover:bg-teal-50 @endif px-4 py-2 mt-1 rounded-full transition-colors"><h5 class="pt-1" aria-label="Most Viewed">Most viewed</h5></a>
        </div>
        
        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center px-5 md:px-16">
            @foreach($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @endforeach
        </div>
        
        <div class="flex justify-center mt-8">
            <div class="pagination-container">
                {{ $recipes->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

@endsection
