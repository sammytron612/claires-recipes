@extends('layouts.app', ['noFollow' => true, 'title' => 'Recipe Index | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')

<x-header title="Recipe index"/>
<div class="max-w-7xl mx-auto bg-white px-6">
    <div class="pb-5">
        <x-breadcrumb/>

        <div class="mt-3 px-5 md:px-0">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div class="mt-2">
                @foreach ($index as $return)
                    @if($loop->first)
                    <h1 class="text-3xl font-bold mb-4">
                        {{ ucfirst(substr($index[$loop->index]->title, 0, 1)) }}
                    </h1>
                    <div class="mb-2">
                        <a href="{{ route($return->category,$return->slug) }}" rel="nofollow" aria-label="{{$return->title}}" class="text-teal-600 hover:text-teal-800">
                            <h5 class="text-lg font-semibold">{{ $return->title }}</h5>
                        </a>
                        <span class="text-gray-600">({{ $return->total }})</span>
                    </div>
                    @endif

                    @if(!$loop->first)
                        @php
                            $current = ucfirst(substr($index[$loop->index-1]->title, 0, 1));
                            $next = ucfirst(substr($index[$loop->index]->title, 0, 1));
                        @endphp

                        @if($current == $next)
                            <div class="mb-2">
                                <a href="{{ route($return->category,$return->slug) }}" rel="nofollow" aria-label="{{$return->title}}" class="text-teal-600 hover:text-teal-800">
                                    <h5 class="text-lg font-semibold">{{ $return->title }}</h5>
                                </a>
                                <span class="text-gray-600">({{ $return->total }})</span>
                            </div>

                        @else
                        </div><div class="mt-2">
                            <h1 class="text-3xl font-bold mb-4">{{ $next }}</h1>
                            <div class="mb-2">
                                <a href="{{ route($return->category,$return->slug) }}" rel="nofollow" aria-label="{{$return->title}}" class="text-teal-600 hover:text-teal-800">
                                    <h5 class="text-lg font-semibold">{{ $index[$loop->index]->title }}</h5>
                                </a>
                                <span class="text-gray-600">({{ $return->total }})</span>
                            </div>

                                @endif
                            @endif
                    @endforeach
                        </div>
                </div>

        </div>
    </div>
</div>
@endsection


