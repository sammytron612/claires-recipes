@extends('layouts.app', ['image'=> "fb2e60213d4b9e175f23e08bbc8ed01f.jpg", 'title' => 'Blog | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')

    <x-header title="Blog" />
    <div class="col-12 d-flex h-100 align-items-center justify-content-center">
        <div class="position-relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/cuisine1232.jpg') }}" alt="">
        </div>
        <div class="position-absolute d-flex h-100 align-items-center justify-content-center">
            <h3 style="background: rgba(204, 204, 204, 0.8);font-family: 'Pacifico', cursive;" class="border border-dark text-dark p-2 p-md-5">Blog</h3>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gap-1 justify-content-center mb-5">
            @foreach($articles as $article)
            <div x-data class="col">
                <div class="shadow card mt-3 w-100 p-0">
                    <img style="height:220px !important" src="{{$article->main_image}}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{$article->title}}</p>
                        <small class="text-dark">By <span class="text-teal">{{$article->articleAuthor->name}}<span></small>
                        <small class="text-dark d-block">Date <span class="text-teal">{{ \Carbon\Carbon::parse($article->created_at)->format('d M Y')}}</span></small>
                        <a href='{{url("post/{$article->id}/{$article->slug}")}}' class="btn btn-teal stretched-link btn-sm mt-3">Go there</a>
                        @can('isAdmin')
                        <a href='{{url("post/view/{$article->id}")}}' class="float-right btn btn-primary stretched-link btn-sm mt-3">Edit</a>
                        @endcan
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection