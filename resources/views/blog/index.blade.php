@extends('layouts.app', ['image'=> "fb2e60213d4b9e175f23e08bbc8ed01f.jpg", 'title' => 'Blog | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')

    <x-header title="Blog" />
    <div class="w-full flex h-full items-center justify-center">
        <div class="relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/cuisine1232.jpg') }}" alt="">
        </div>
        <div class="absolute flex h-full items-center justify-center">
            <h3 style="background: rgba(204, 204, 204, 0.8);font-family: 'Pacifico', cursive;" class="border border-gray-800 text-gray-800 p-2 md:p-5">Blog</h3>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-5 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-center mb-5">
            @foreach($articles as $article)
            <div x-data class="">
                <div class="shadow-lg bg-white rounded-lg overflow-hidden mt-3 w-full p-0 relative">
                    <img style="height:220px !important" class="w-full object-cover" src="{{$article->main_image}}" alt="Card image cap">
                    <div class="p-4">
                        <p class="text-gray-900 font-medium mb-2">{{$article->title}}</p>
                        <small class="text-gray-700">By <span class="text-teal-600">{{$article->articleAuthor->name}}</span></small>
                        <small class="text-gray-700 block">Date <span class="text-teal-600">{{ \Carbon\Carbon::parse($article->created_at)->format('d M Y')}}</span></small>
                        <a href='{{url("post/{$article->id}/{$article->slug}")}}' class="absolute inset-0"></a>
                        <div class="flex justify-between items-center mt-3">
                            <button class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-1 px-3 rounded text-sm">Go there</button>
                            @can('isAdmin')
                            <a href='{{url("post/view/{$article->id}")}}' class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm relative z-10">Edit</a>
                            @endcan
                        </div>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection