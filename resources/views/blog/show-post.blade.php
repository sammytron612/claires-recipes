<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
    'index' => true,
    'noFollow' => true,
    'image' => $BlogArticle->main_image, 
    'title' => 'Claire\'s Recipes Blog - ' . $BlogArticle->title, 
    'description' => Str::limit(strip_tags($body->body), 155),
    'keywords' => $keywords,
    'ogType' => 'article',
    'structuredData' => '<script type="application/ld+json">' . json_encode($structuredData, JSON_UNESCAPED_SLASHES) . '</script>'
])

@section('content')
    <!-- Hero Header with Gradient Background -->
<div class="bg-gradient-to-r from-teal-700 to-teal-500 text-white">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
            {{ $BlogArticle->title }}
        </h1>
        
        <!-- Article Meta Information -->
        <div class="flex flex-wrap items-center space-x-6 text-teal-100">
            <div class="flex items-center space-x-2">
                @if($BlogArticle->articleAuthor->avatar)
                    <img class="w-10 h-10 rounded-full border-2 border-teal-300" 
                            src="{{ asset('storage/' . $BlogArticle->articleAuthor->avatar) }}" 
                            alt="{{ $BlogArticle->articleAuthor->name }}">
                @else
                    <div class="w-10 h-10 rounded-full bg-teal-500 flex items-center justify-center border-2 border-teal-300">
                        <span class="text-white font-semibold text-sm">
                            {{ substr($BlogArticle->articleAuthor->name, 0, 1) }}
                        </span>
                    </div>
                @endif
                <span class="font-medium">By {{ $BlogArticle->articleAuthor->name }}</span>
            </div>
            
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $BlogArticle->created_at->format('F j, Y') }}</span>
            </div>
            
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                <span>{{ ceil(str_word_count(strip_tags($body->body)) / 200) }} min read</span>
            </div>
        </div>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-6 gap-8">
        
        <!-- Main Content - Now spans 5 columns out of 6 -->
        <div class="lg:col-span-4">
            <!-- Featured Image -->
            <div class="mb-8">
                <div class="relative overflow-hidden rounded-xl shadow-lg">
                    <img class="w-full h-96 object-cover" 
                         src="{{ url($BlogArticle->main_image) }}" 
                         alt="{{ $BlogArticle->title }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
            </div>

            <!-- Article Content -->
            <article class="bg-white rounded-md shadow-sm p-10">
                <div class="prose prose-xl max-w-none w-full
                            prose-headings:text-gray-800 prose-headings:font-bold
                            prose-p:text-gray-600 prose-p:leading-relaxed prose-p:text-lg prose-p:max-w-none
                            prose-a:text-teal-600 prose-a:no-underline hover:prose-a:text-teal-700
                            prose-strong:text-gray-800
                            prose-ul:text-gray-600 prose-ol:text-gray-600 prose-ul:max-w-none prose-ol:max-w-none
                            prose-blockquote:border-teal-500 prose-blockquote:text-gray-700 prose-blockquote:max-w-none
                            prose-img:rounded-lg prose-img:shadow-md prose-img:max-w-none prose-img:w-full
                            prose-h1:max-w-none prose-h2:max-w-none prose-h3:max-w-none prose-h4:max-w-none
                            prose-table:max-w-none prose-table:w-full">
                    {!! $body->body !!}
                </div>
            </article>

            <!-- Article Footer -->
            <div class="mt-8 bg-white rounded-lg shadow-sm p-6">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600 font-medium">Share this article:</span>
                        
                        <!-- Social Share Buttons -->
                        <div class="flex items-center space-x-3">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($BlogArticle->title) }}" 
                               target="_blank"
                               class="flex items-center justify-center w-10 h-10 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank"
                               class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            
                            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode(url($BlogArticle->main_image)) }}&description={{ urlencode($BlogArticle->title) }}" 
                               target="_blank"
                               class="flex items-center justify-center w-10 h-10 bg-red-600 text-white rounded-full hover:bg-red-700 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.1.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.162-1.499-.69-2.436-2.888-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.357-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="mt-4 lg:mt-0 text-sm text-gray-500">
                        Last updated: {{ $BlogArticle->updated_at->format('M j, Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar - Spans 1 column out of 6 -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Author Card -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="text-center">
                    @if($BlogArticle->articleAuthor->avatar)
                        <img class="w-16 h-16 rounded-full mx-auto mb-3 border-4 border-teal-100" 
                             src="{{ asset('storage/' . $BlogArticle->articleAuthor->avatar) }}" 
                             alt="{{ $BlogArticle->articleAuthor->name }}">
                    @else
                        <div class="w-16 h-16 rounded-full bg-teal-500 flex items-center justify-center mx-auto mb-3 border-4 border-teal-100">
                            <span class="text-white font-bold text-lg">
                                {{ substr($BlogArticle->articleAuthor->name, 0, 1) }}
                            </span>
                        </div>
                    @endif
                    <h3 class="text-base font-bold text-gray-800 mb-1">{{ $BlogArticle->articleAuthor->name }}</h3>
                    <p class="text-gray-600 text-xs">Author</p>
                </div>
            </div>

            <!-- Quick Recipe Link -->
            <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-lg p-4 border border-teal-200 mb-4">
                <div class="text-center">
                    <div class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Recipes</h3>
                    <p class="text-gray-600 text-xs mb-3">Discover amazing recipes</p>
                    <a href="{{ route('home') }}" 
                       class="inline-block bg-teal-600 text-white px-4 py-1.5 rounded-lg hover:bg-teal-700 transition-colors text-sm font-medium">
                        Browse
                    </a>
                </div>
            </div>

            <!-- Newsletter Signup -->
            <div class="bg-white rounded-lg shadow-sm p-4 mt-4">
                <h3 class="text-base font-bold text-gray-800 mb-2">Stay Updated</h3>
                <p class="text-gray-600 text-xs mb-3">Get latest recipes delivered</p>
                <form class="space-y-2">
                    <input type="email" 
                           placeholder="Email" 
                           class="w-full px-3 mb-4 py-1.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    <button type="submit" 
                            class="w-full bg-teal-600 text-white py-1.5 rounded-lg hover:bg-teal-700 transition-colors text-sm font-medium">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection