@php
    // Generate structured data for blog article
    $structuredData = [
        "@context" => "https://schema.org",
        "@type" => "BlogPosting",
        "headline" => $BlogArticle->title,
        "description" => Str::limit(strip_tags($body->body), 155),
        "image" => [$BlogArticle->main_image],
        "author" => [
            "@type" => "Person",
            "name" => $BlogArticle->articleAuthor->name
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => "Claire's Recipes",
            "logo" => [
                "@type" => "ImageObject",
                "url" => asset('storage/fb2e60213d4b9e175f23e08bbc8ed01f.jpg')
            ]
        ],
        "datePublished" => $BlogArticle->created_at->toISOString(),
        "dateModified" => $BlogArticle->updated_at->toISOString(),
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => url()->current()
        ]
    ];
    
    $keywords = collect([
        $BlogArticle->title,
        'blog',
        'cooking',
        'recipes',
        'food'
    ])->filter()->implode(', ');
@endphp

@extends('layouts.app', [
    'image' => $BlogArticle->main_image, 
    'title' => 'Claire\'s Recipes Blog - ' . $BlogArticle->title, 
    'description' => Str::limit(strip_tags($body->body), 155),
    'keywords' => $keywords,
    'ogType' => 'article',
    'structuredData' => '<script type="application/ld+json">' . json_encode($structuredData, JSON_UNESCAPED_SLASHES) . '</script>'
])

@section('content')

    <x-header title="Blog" />
    
    <div class="max-w-7xl mx-auto bg-white pb-5 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="text-center">
                <img class="w-full rounded-lg shadow-md" src="{{url($BlogArticle->main_image)}}"/>
            </div>
            <div class="flex items-center">
                <h1 style="font-family: 'Pacifico', cursive;" class="mx-auto mt-5 text-3xl md:text-4xl text-gray-800">{{$BlogArticle->title}}</h1>
            </div>
        </div>
        <div class="mt-8 text-left prose max-w-none">
            @php echo $body->body @endphp
        </div>
    </div>
@endsection