@extends('layouts.app')

@section('content')
    @include('includes.search')

    <div class="w-full mt-4 flex h-full items-center justify-center">
        <div class="relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/' . $recipes[0]->image) }}" alt="{{$recipes[0]->title}}">
        </div>
        <div class="absolute flex h-full items-center justify-center">
            <h3 style="background: rgba(204, 204, 204, 0.8);" class="border border-gray-800 text-gray-800 p-2 md:p-5">Searched recipes</h3>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-3 py-3 bg-white">
        <h5 class="text-center py-2 text-lg">Recipes based on your search term '{{ $searchTerm }}'</h5>
        <div class="flex justify-center flex-wrap gap-2 py-2">
            <a href="{{ url($url . $searchTerm) }}" class="px-4 py-2 border border-teal-600 text-teal-600 rounded-full hover:bg-teal-50 transition-colors">
                <h5 class="text-base font-medium">Reset</h5>
            </a>
            <a href="{{ url($url . $searchTerm. '/created_at') }}" class="px-4 py-2 border border-teal-600 rounded-full transition-colors @if(str_contains(url()->current(), '/created_at')) bg-teal-600 text-white @else text-teal-600 hover:bg-teal-50 @endif">
                <h5 class="text-base font-medium">Recent</h5>
            </a>
            <a href="{{ url($url . $searchTerm . '/rating') }}" class="px-4 py-2 border border-teal-600 rounded-full transition-colors @if(str_contains(url()->current(), '/rating')) bg-teal-600 text-white @else text-teal-600 hover:bg-teal-50 @endif">
                <h5 class="text-base font-medium">Highest rated</h5>
            </a>
            <a href="{{ url($url . $searchTerm . '/views') }}" class="px-4 py-2 border border-teal-600 rounded-full transition-colors @if(str_contains(url()->current(), '/views')) bg-teal-600 text-white @else text-teal-600 hover:bg-teal-50 @endif">
                <h5 class="text-base font-medium">Most viewed</h5>
            </a>
        </div>
        <div class="mt-3 px-5 md:px-0 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @endforeach
        </div>
        <div class="flex justify-center">
            {{ $recipes->links() }}
        </div>
    </div>
@endsection
