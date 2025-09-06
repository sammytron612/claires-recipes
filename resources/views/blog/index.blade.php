@php
    // Generate structured data for blog listing
    $structuredData = [
        "@context" => "https://schema.org",
        "@type" => "Blog",
        "name" => "Claire's Recipes Blog",
        "description" => "Discover cooking tips, recipe inspiration, and culinary insights from Claire's kitchen. Learn new techniques and get inspired to cook at home.",
        "url" => url()->current(),
        "publisher" => [
            "@type" => "Organization",
            "name" => "Claire's Recipes",
            "logo" => [
                "@type" => "ImageObject",
                "url" => asset('storage/fb2e60213d4b9e175f23e08bbc8ed01f.jpg')
            ]
        ]
    ];
@endphp

@extends('layouts.app', [
    'image' => "fb2e60213d4b9e175f23e08bbc8ed01f.jpg", 
    'title' => 'Claire\'s RecipesBlog - Cooking Tips & Recipe Inspiration', 
    'description' => "Discover cooking tips, recipe inspiration, and culinary insights from Claire's kitchen. Learn new techniques and get inspired to cook delicious homemade meals.",
    'keywords' => 'cooking blog, recipe tips, cooking techniques, food blog, culinary inspiration, kitchen tips, cooking advice',
    'structuredData' => '<script type="application/ld+json">' . json_encode($structuredData, JSON_UNESCAPED_SLASHES) . '</script>'
])

@section('content')

    <!-- Title Section -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-700 text-white py-12 mb-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    Blog
                </h1>
                <p class="text-lg text-gray-200 max-w-2xl mx-auto font-bold">
                    Discover delicious recipes, cooking tips, and culinary inspiration from Claire's kitchen
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-5 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-center mb-5">
            @foreach($articles as $article)
            <div x-data class="">
                <div class="shadow-lg bg-white rounded-lg overflow-hidden mt-3 w-full p-0 relative">
                    <img style="height:220px !important" class="w-full object-cover" src="{{url($article->main_image)}}" alt="Card image cap">
                    <div class="p-4">
                        <p class="text-gray-900 font-medium mb-2">{{$article->title}}</p>
                        <small class="text-gray-700">By <span class="text-teal-600">{{$article->articleAuthor->name}}</span></small>
                        <small class="text-gray-700 block">Date <span class="text-teal-600">{{ \Carbon\Carbon::parse($article->created_at)->format('d M Y')}}</span></small>
                        <a href='{{ route("blog.show", ["id" => $article->id, "slug" => $article->slug]) }}' class="absolute inset-0"></a>
                        <div class="flex justify-between items-center mt-3">
                            <button class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-1 px-3 rounded text-sm">Go there</button>
                            @can('isAdmin')
                           
                            <a href='{{route('blog.edit', $article->id)}}' class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm relative z-10">Edit</a>
                            @endcan
                        </div>  
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination Links -->
        <div class="mt-8 flex justify-center">
            {{ $articles->links() }}
        </div>
    </div>
@endsection