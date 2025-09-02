@php
    // Generate structured data for recipe
    $ingredients = $recipe->ingredientList->map(function($ingredient) {
        return $ingredient->ingredient->name ?? $ingredient->name;
    })->filter()->values()->toArray();
    
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

<div class="w-full px-8 md:px-16 lg:px-32">
@include('includes.search')
</div>

<div class="max-w-7xl mx-auto px-3 bg-white mt-3 pb-5 px-8 md:px-16 lg:px-32">
    <div class="flex items-center justify-between py-3">
        <div class="flex items-center">
            <img class="inline-block w-12 h-12 rounded-full ml-2" src="{{ asset('storage/' . $recipe->User->avatar) }}" alt="{{$recipe->User->name}}">
            <span class="font-bold ml-2 text-teal-600">By {{ $recipe->User->name }}</span>
        </div>

        <div class="flex items-center space-x-2">
            @if($recipe->attachment)
                @livewire('download-recipe',['recipe' => $recipe->id])
            @else
            <div onclick="CreatePDFfromHTML()" class="shadow border rounded btn py-1 px-3 bg-white hover:bg-gray-50 cursor-pointer">
                <i class="text-blue-500 fas fa-save"></i>
            </div>
            @endif
            
            @auth
            @livewire('favourite', ['recipe' => $recipe->id])
            @endAuth
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="w-full">
            <img class="border border-gray-800 w-full rounded-lg object-cover" src="{{ asset('storage/'. $recipe->image) }}" alt="{{$recipe->title}}">
        </div>
        <div class="mt-4 md:mt-0">
            <h3 class="text-2xl font-bold">{{ $recipe->title }}</h3>
            <div id="stars">
                @livewire('rating-component',['recipe' => $recipe])
            </div>

            <div class="mt-1">
                @livewire('comment-counter',['recipe' => $recipe])
            </div>
            @if($recipe->cooking_time)
            <div class="mt-2 flex items-center">
                <i class="text-blue-500 fa fa-clock"></i><span class="font-bold ml-1">{{ $recipe->cooking_time }} mins</span>
            </div>
            @endif
            <div class="mt-3 text-blue-600 flex items-center flex-wrap gap-2">

                    @foreach($recipe->HashIngredient as $h_ingredient)
                        <a href="{{ route('ingredient', $h_ingredient->ingredients->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_ingredient->ingredients->title }}</a>
                    @endforeach

                    @foreach($recipe->HashCuisine as $h_cuisine)
                        <a href="{{ route('cuisine', $h_cuisine->CuisineTitle->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_cuisine->CuisineTitle->title }}</a>
                    @endforeach

                    @foreach($recipe->HashDiet as $h_diet)
                        <a href="{{ route('diet', $h_diet->DietTitle->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_diet->DietTitle->title }}</a>
                    @endforeach

                    @foreach($recipe->HashCourse as $h_course)
                        <a href="{{ route('course', $h_course->CourseTitle->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_course->CourseTitle->title }}</a>
                    @endforeach

                    @foreach($recipe->HashMethod as $h_method)
                        <a href="{{ route('method', $h_method->MethodTitle->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_method->MethodTitle->title }}</a>
                    @endforeach
            </div>

            <p class="mt-3 font-italic">{{ $recipe->description }}</p>
            <h6 class="my-2"><i class="fa fa-lg fa-share-alt" aria-hidden="true"></i><span class="ml-2 weight700 text-teal">Share this</span></h6>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}&display=popup" target="_blank" aria-label="Facebook"><i style="color:#3b5998" class="fab fa-2x fa-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?text=Im cooking {{ $recipe->title }}&url={{ Request::fullUrl() }}" target="_blank" aria-label="Twitter"><i style="color:dodgerblue" class="fab fa-2x fa-twitter"></i></a>
            <a class="info" target="_blank" data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url={{ Request::fullUrl()}}; &media={{ asset('storage/'. $recipe->image) }}&description={{ $recipe->title }}" data-pin-custom="true" aria-label="Pinterest"><i style="color:crimson" class="fab fa-2x fa-pinterest"></i></i></a>
        </div>
    </div>
    <br>
    <br>
    <hr>
    @livewire('nutrition', ['recipeId' => $recipe->id])
    <hr>

    @isset($recipe->recipeMethod->description)
    <div id="method" class="p-5">
        <div id="recipe-method" class="w-full">
             <div id="title" class="hidden text-center text-2xl">{{ $recipe->title }}</div>
            {!! $recipe->recipeMethod->description !!}
        </div>
    </div>
    @endisset
    <br>
    <hr>
    <h5 class="my-5 font-bold text-left text-teal-600">Like this? Then  we are sure you will also like these:</h5>
    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 justify-center">
        @foreach($similarRecipes as $similarRecipe)
            <div class="flex mt-2 relative">
                <a href="{{ route('recipe',['id' => $similarRecipe->id,'slug' => $similarRecipe->slug]) }}" class="absolute inset-0 z-10" aria-label="{{$similarRecipe->title}}"></a>
                <div class="shadow-md bg-white rounded-lg p-0 w-full flex flex-col">
                    <div style="overflow-y:hidden" class="flex flex-col h-auto text-xl px-2 pt-3">
                        <div class="text-center text-teal-600">{{ $similarRecipe->title }}</div>
                    </div>
                    <div class="pb-2 h-auto p-4 flex-1 block mb-2">
                        <div>{{ $similarRecipe->description }}</div>
                    </div>
                    <img class="my-height mt-1 w-full object-cover rounded-b-lg" src="{{ asset('storage/'. $similarRecipe->image) }}" alt="{{ $similarRecipe->title }}">
                </div>
            </div>
        @endforeach
    </div>
    <br>
    <hr>
    @livewire('comments',['recipe' => $recipe])
</div>

<script>

function CreatePDFfromHTML() {
    $('#title').removeClass('hidden').addClass('block')
    var HTML_Width = $("#method").width();
    var HTML_Height = $("#method").height() * 1.3;
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 1);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#method")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) {
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        $('#title').removeClass('d-block')
        pdf.save("{{ $recipe->title }}");

    });
}


document.addEventListener('DOMContentLoaded', function () {


    $(function () {
        $(".txt").focus(function () {
            $('#starRating').removeClass('invisible')
            $('.txt').animate({
                height: '6rem',
                },
               "slow"
            )
        });
    });
});



</script>
@endsection


