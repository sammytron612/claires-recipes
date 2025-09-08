@extends('layouts.app', ['noFollow' => true, 'index' => false, 'title' => 'Claires Recipes - Ingredients', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')
    @include('includes.search')

    <div class="relative mt-4">
        <img class="w-full h-96 object-cover" src="{{ asset('storage/ingredients1232.jpg') }}" alt="Ingredients">
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

    <div class="container mx-auto px-4 py-6 bg-white">
    

        <div class="mt-6">
            @php
                // Group ingredients by first letter
                $groupedIngredients = $returns->groupBy(function($item) {
                    return strtoupper(substr($item->title, 0, 1));
                });
                
                // Split into 3 columns
                $letters = $groupedIngredients->keys()->sort();
                $totalLetters = $letters->count();
                $perColumn = ceil($totalLetters / 3);
                
                $columns = [
                    $letters->slice(0, $perColumn),
                    $letters->slice($perColumn, $perColumn), 
                    $letters->slice($perColumn * 2)
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($columns as $columnIndex => $columnLetters)
                    <div class="space-y-6">
                        @foreach($columnLetters as $letter)
                            @if(isset($groupedIngredients[$letter]))
                                <div>
                                    <h2 class="text-3xl font-bold text-teal-600 mb-3 border-b-2 border-teal-200 pb-1">{{ $letter }}</h2>
                                    <div class="space-y-2">
                                        @foreach($groupedIngredients[$letter] as $ingredient)
                                            <a href="{{ url('/ingredient/' . $ingredient->slug) }}" 
                                               class="block text-lg text-gray-700 hover:text-teal-600 hover:bg-gray-50 p-2 rounded transition-colors duration-200"
                                               data-toggle="tooltip" 
                                               data-placement="right"
                                               title="View recipes with {{ $ingredient->title }}" wire:navigate>
                                                {{ $ingredient->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize tooltips if using Bootstrap (optional)
            if (typeof $ !== 'undefined' && $.fn.tooltip) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    </script>

@endsection
