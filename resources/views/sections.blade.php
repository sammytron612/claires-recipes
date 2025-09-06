@extends('layouts.app', ['noFollow' => false, 'title' => $caption . ' | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')
    @include('includes.search')

    <div class="w-full mt-4 flex h-full items-center justify-center">
        <div class="relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/' . $image) }}" alt="{{$caption}}">
        </div>
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="max-w-7xl mx-auto flex items-center justify-center">
                <div class="rounded-lg p-6 shadow-lg" style="background: rgba(0,0,0,0.40);">
                    <h2 class="text-3xl md:text-4xl font-bold text-white text-center hover:text-gray-200 transition-colors">
                        {{ $caption }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-3 py-3 bg-white">

        <div class="mt-3 px-5 md:px-0 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 justify-items-center">
            @foreach($returns as $return)
                <div class="shadow-md bg-white rounded-lg w-full max-w-xs relative overflow-hidden">
                    <a href="{{ route($route,$return->slug) }}" class="absolute inset-0 z-10" aria-label="{{ $return->title }}" wire:navigate></a>
                    <div class="flex flex-col h-full">
                        <div class="flex flex-col h-auto text-lg px-2 pt-3">
                            <div class="text-center text-teal-600 font-semibold">{{ $return->title }}</div>
                        </div>
                        @if($route == "cuisine")
                            <div style="min-height:180px;" class="hidden md:block pb-2 h-auto p-6 mb-2 flex-grow">
                                <div class="text-sm text-gray-600">{{ $return->description }}</div>
                            </div>
                        @endif
                        @if($route == "course")
                            <div style="min-height:180px;" class="hidden md:block pb-2 h-auto p-6 mb-2 flex-grow">
                                <div class="text-sm text-gray-600">{{ $return->description }}</div>
                            </div>
                        @endif
                        <img class="mt-1 rounded-b-lg w-full h-48 object-cover" src="{{ asset('storage/'. $return->image) }}" alt="{{$return->title}}">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5 flex justify-center">
        {{ $returns->links() }}
        </div>
    </div>

@endsection
