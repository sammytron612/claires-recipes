@extends('layouts.app', ['noFollow' => false, 'title' => 'Claires Recipes - Ingredients', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')
    @include('includes.search')

    <div class="relative mt-4">
        <img class="w-full h-96 object-cover" src="{{ asset('storage/ingredients1232.jfif') }}" alt="Ingredients">
        <div class="absolute inset-0 flex items-center justify-center">
            <h3 class="text-4xl font-bold text-dark bg-gray-200 bg-opacity-80 p-4 border border-gray-800 rounded" style="font-family: 'Pacifico', cursive;">{{ $caption }}</h3>
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
                                               title="View recipes with {{ $ingredient->title }}">
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
