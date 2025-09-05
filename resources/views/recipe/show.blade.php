@php
    // Generate structured data for recipe
    $ingredients = [];
    if ($recipe->HashIngredient) {
        $ingredients = $recipe->HashIngredient->map(function($hashIngredient) {
            return $hashIngredient->ingredients ? $hashIngredient->ingredients->name : null;
        })->filter()->values()->toArray();
    }
    
    $instructions = [];
    if ($recipe->recipeMethod && $recipe->recipeMethod->method) {
        $methods = json_decode($recipe->recipeMethod->method, true);
        if (is_array($methods)) {
            foreach ($methods as $index => $method) {
                $instructions[] = [
                    "@type" => "HowToStep",
                    "name" => "Step " . ($index + 1),
                    "text" => strip_tags($method['method'] ?? $method)
                ];
            }
        }
    }
    
    $aggregateRating = null;
    if ($recipe->commentRecipe && $recipe->commentRecipe->count() > 0) {
        $avgRating = $recipe->commentRecipe->avg('rating');
        $ratingCount = $recipe->commentRecipe->where('rating', '>', 0)->count();
        
        if ($ratingCount > 0) {
            $aggregateRating = [
                "@type" => "AggregateRating",
                "ratingValue" => round($avgRating, 1),
                "reviewCount" => $ratingCount,
                "bestRating" => "5",
                "worstRating" => "1"
            ];
        }
    }
    
    $structuredData = [
        "@context" => "https://schema.org/",
        "@type" => "Recipe",
        "name" => $recipe->title,
        "description" => $recipe->description,
        "image" => [asset('storage/' . $recipe->image)],
        "author" => [
            "@type" => "Person",
            "name" => $recipe->User->name
        ],
        "datePublished" => $recipe->created_at->toISOString(),
        "dateModified" => $recipe->updated_at->toISOString(),
        "prepTime" => $recipe->cooking_time ? "PT" . $recipe->cooking_time . "M" : null,
        "cookTime" => $recipe->cooking_time ? "PT" . $recipe->cooking_time . "M" : null,
        "totalTime" => $recipe->cooking_time ? "PT" . $recipe->cooking_time . "M" : null,
        "recipeCategory" => $recipe->Course ? $recipe->Course->name : "Main Course",
        "recipeCuisine" => $recipe->Cuisine ? $recipe->Cuisine->name : "International",
        "recipeYield" => "4 servings",
        "nutrition" => [
            "@type" => "NutritionInformation",
            "calories" => "Varies"
        ]
    ];
    
    if (!empty($ingredients)) {
        $structuredData["recipeIngredient"] = $ingredients;
    }
    
    if (!empty($instructions)) {
        $structuredData["recipeInstructions"] = $instructions;
    }
    
    if ($aggregateRating) {
        $structuredData["aggregateRating"] = $aggregateRating;
    }
    
    $keywords = collect([
        $recipe->title,
        $recipe->Course?->name,
        $recipe->Cuisine?->name,
        'recipe',
        'cooking',
        'homemade'
    ])->filter()->implode(', ');
@endphp

@extends('layouts.app', [
    'image' => $recipe->image, 
    'title' => $recipe->title . ' | Claire\'s Recipes', 
    'description' => Str::limit($recipe->description, 155),
    'keywords' => $keywords,
    'ogType' => 'article',
    'structuredData' => '<script type="application/ld+json">' . json_encode($structuredData, JSON_UNESCAPED_SLASHES) . '</script>'
])

@section('content')

<!-- Hero Section with Recipe Image -->
<div class="relative h-96 overflow-hidden">
    <img class="w-full h-full object-cover" src="{{ asset('storage/'. $recipe->image) }}" alt="{{$recipe->title}}">
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
    
    <!-- Recipe Title Overlay -->
    <div class="absolute bottom-0 left-0 right-0 p-8">
        <div class="max-w-7xl mx-auto flex items-center justify-center">
            <div class="rounded-lg p-6 shadow-lg" style="background: rgba(0,0,0,0.40);">
                <h1 class="text-4xl md:text-5xl font-bold text-white text-center">{{ $recipe->title }}</h1>
            </div>
        </div>
    </div>
</div>

<!-- Search Bar -->
<div class="bg-gray-50 py-4">
    <div class="max-w-7xl mx-auto px-4">
        @include('includes.search')
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 py-8">

    <!-- Recipe Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Main Content (Left Column) -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Recipe Info Card -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center space-x-6 text-gray-700">
                    <div class="flex items-center space-x-2">
                        <img class="w-10 h-10 rounded-full border-2 border-gray-200" src="{{ asset('storage/' . $recipe->User->avatar) }}" alt="{{$recipe->User->name}}">
                        <span class="font-medium">By {{ $recipe->User->name }}</span>
                    </div>
                    @if($recipe->cooking_time)
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $recipe->cooking_time }} mins</span>
                    </div>
                    @endif
                    @auth
                    @livewire('favourite', ['recipe' => $recipe->id])
                    @endAuth
                </div>
            </div>

             
            <!-- Description Card -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Recipe</h2>
                <p class="text-gray-600 leading-relaxed text-lg">{{ $recipe->description }}</p>
            </div>

            <!-- Recipe Header Actions -->
            <div class="flex flex-wrap items-center justify-between bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex items-center space-x-4">
                    <div id="stars">
                        @livewire('rating-component',['recipe' => $recipe])
                    </div>
                    <div class="text-gray-600">
                        @livewire('comment-counter',['recipe' => $recipe])
                    </div>
                </div>
                
                <div class="flex items-center space-x-3 mt-4 md:mt-0">
                    @if($recipe->attachment)
                        @livewire('download-recipe',['recipe' => $recipe->id])
                    @else
                    <button onclick="CreatePDFfromHTML()" class="flex items-center space-x-1 bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 text-sm rounded transition-colors">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        <span>Save PDF</span>
                    </button>
                    @endif
                    
                </div>
            </div>

            <!-- Tags Section -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Recipe Tags</h3>
                <div class="flex flex-wrap gap-2">
                    
                    @foreach($recipe->HashIngredient as $h_ingredient)
                       @if($h_ingredient->ingredients->slug)
                        <a href="{{ route('ingredient', $h_ingredient->ingredients->slug) }}" 
                           class="inline-flex items-center bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full hover:bg-green-200 transition-colors">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.94l1-4H9.03z" clip-rule="evenodd"/>
                            </svg>
                            {{ $h_ingredient->ingredients->title }}
                        </a>
                        @endif
                    @endforeach
                    

                    @foreach($recipe->HashCuisine as $h_cuisine)
                       @if($h_cuisine->CuisineTitle->slug)
                        <a href="{{ route('cuisine', $h_cuisine->CuisineTitle->slug) }}" 
                           class="inline-flex items-center bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full hover:bg-blue-200 transition-colors">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $h_cuisine->CuisineTitle->title }}
                        </a>
                        @endif
                    @endforeach

                    @foreach($recipe->HashDiet as $h_diet)
                       @if($h_diet->DietTitle->slug)
                        <a href="{{ route('diet', $h_diet->DietTitle->slug) }}" 
                           class="inline-flex items-center bg-purple-100 text-purple-800 text-sm font-medium px-3 py-1 rounded-full hover:bg-purple-200 transition-colors">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"/>
                            </svg>
                            {{ $h_diet->DietTitle->title }}
                        </a>
                        @endif
                    @endforeach

                    @foreach($recipe->HashCourse as $h_course)
                       @if($h_course->CourseTitle->slug)
                        <a href="{{ route('course', $h_course->CourseTitle->slug) }}" 
                           class="inline-flex items-center bg-orange-100 text-orange-800 text-sm font-medium px-3 py-1 rounded-full hover:bg-orange-200 transition-colors">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/>
                            </svg>
                            {{ $h_course->CourseTitle->title }}
                        </a>
                        @endif
                    @endforeach

                    @foreach($recipe->HashMethod as $h_method)
                       @if($h_method->MethodTitle->slug)
                        <a href="{{ route('method', $h_method->MethodTitle->slug) }}" 
                           class="inline-flex items-center bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-full hover:bg-red-200 transition-colors">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            {{ $h_method->MethodTitle->title }}
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Recipe Method -->
            @isset($recipe->recipeMethod->description)
            <div id="method" class="bg-white rounded-lg shadow-sm p-6">
                <div id="recipe-method" class="w-full">
                    <div id="title" class="hidden text-center text-3xl font-bold text-gray-800 mb-6">{{ $recipe->title }}</div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Instructions</h2>
                    <div class="prose prose-lg max-w-none">
                        {!! $recipe->recipeMethod->description !!}
                    </div>
                </div>
            </div>
            @endisset

        </div>

        <!-- Sidebar (Right Column) -->
        <div class="space-y-6">
            
            <!-- Social Sharing Card -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                    </svg>
                    Share this recipe
                </h3>
                <div class="flex space-x-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}&display=popup" 
                       target="_blank" 
                       class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                       aria-label="Share on Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=I'm cooking {{ $recipe->title }}&url={{ Request::fullUrl() }}" 
                       target="_blank" 
                       class="flex items-center justify-center w-12 h-12 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors"
                       aria-label="Share on Twitter"
                       style="font-size: 18px; font-weight: 900; font-family: Arial, sans-serif;">
                        X
                    </a>
                    <a href="https://www.pinterest.com/pin/create/button/?url={{ Request::fullUrl()}}&media={{ asset('storage/'. $recipe->image) }}&description={{ $recipe->title }}" 
                       target="_blank" 
                       class="flex items-center justify-center w-12 h-12 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                       aria-label="Share on Pinterest">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Nutrition Info -->
            <div class="bg-white rounded-lg shadow-sm">
                @livewire('nutrition', ['recipeId' => $recipe->id])
            </div>

        </div>
    </div>

    <!-- Similar Recipes Section -->
    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">You Might Also Like</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($similarRecipes as $similarRecipe)
                <a href="{{ route('recipe',['id' => $similarRecipe->id,'slug' => $similarRecipe->slug]) }}" 
                   class="group bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow block"
                   aria-label="View {{ $similarRecipe->title }}">
                    <div class="relative">
                        <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" 
                             src="{{ asset('storage/'. $similarRecipe->image) }}" 
                             alt="{{ $similarRecipe->title }}">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 group-hover:text-teal-600 transition-colors">
                            {{ $similarRecipe->title }}
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-2">{{ $similarRecipe->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Comments Section -->
    <div class="mt-12 bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Reviews & Comments</h2>
        @livewire('comments',['recipe' => $recipe])
    </div>

</div>

<script wire:ignore>

function CreatePDFfromHTML() {
    // Simple print function
    const printContent = document.getElementById('method').innerHTML;
    const printWindow = window.open('', '_blank');
    
    printWindow.document.write(`
        <html>
        <head>
            <title>{{ $recipe->title }} - Recipe</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
                h1, h2 { color: #333; }
                @media print {
                    body { margin: 0; }
                }
            </style>
        </head>
        <div>
            <h1>{{ $recipe->title }}</h1>
            <p><strong>By:</strong> {{ $recipe->User->name }}</p>
            @if($recipe->cooking_time)
            <p><strong>Cooking Time:</strong> {{ $recipe->cooking_time }} minutes</p>
            @endif
            <div>${printContent}</div>
        </div>
        </html>
    `);
    
    printWindow.document.close();
    printWindow.print();
}

</script>
@endsection


