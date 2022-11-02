
@extends('layouts.app', ['image'=> "fb2e60213d4b9e175f23e08bbc8ed01f.jpg", 'title' => 'Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])


@section('content')
<div class="container-fluid">
    @if (session('error'))
                    <div class="alert alert-danger text-center">
                      {{ session('error') }}
                    </div>
    @endif
   @include('includes.search')

    <div class="mt-4">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @foreach($recipes as $recipe)
              <div class="carousel-item @if($loop->first)  {{ 'active' }} @endif" >
                <img class="d-block w-100" style="object-fit: cover; height: 60vh" src="{{ asset('storage/' . $recipe->image) }}" alt="First slide">
                <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
                    
                    <a href ="{{ route('recipe', ['id'=>$recipe->id, 'slug'=>$recipe->slug]) }}" class="stretched-link"></a>
                    <h3 style="font-family: 'Pacifico', cursive; background: rgba(204, 204, 204, 0.8);" class="border border-dark text-dark p-3">{{ $recipe->title }}</h3>
                </div>
              </div>
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>


<section>
    <div class="container p-5 bg-white">
            <x-breadcrumb/>
        <div class="mb-5">
            <h3 class="mt-5 pb-5">Hello and welcome to Claire's recipes!</h3>
                <p>Thank you so much for stopping by the site! If you are new to Claire's Recipes,
                    the one thing you should know about us is that we are obsessed with creating
                    scratch cooking recipes that you will love.</p>

                <p>There are two things we think about when deciding if a recipe is good enough to go on the site.</p>

                <p>First, <strong>does it work?</strong> Does the dish make us smile inside and out? Do we want to eat the whole batch by ourselves?
                Second, <strong>if the dish tastes great, is it worth the effort?</strong> Do we want to make it again (and again and again)?</p>

                <p>This is what we strive for—recipes you can rely on to work every time and be worth your time, effort, and money to make!</p>

                <p>Our goal is to encourage people to cook at home, and to make the process of feeding your family and loved ones less intimidating and more enjoyable.
                Our recipes are all tested in our own home kitchens, usually several times.</p>
            </p>
        </div>
        <hr>
	<x-season-comp />
        <hr>
        <div class="row mt-5">
            <h2>Our top 10</h2>
            <div class="mt-2 row justify-content-center row-cols-1 row-cols-sm-2 row-cols-md-3">
                @foreach($top10 as $recipe)
                <div class="col d-flex align-items-stretch">
                <div class="p-1 m-1 mb-5 w-75 w-sm-100 shadow card">
                    <a href="{{ route('recipe', ['id'=>$recipe->id, 'slug'=> $recipe->slug]) }}" data-toggle="popover" data-placement="right"
                        title="{{ $recipe->description }}" class="stretched-link">
                        <div class="">
                            <img class="card-img-top" src="{{ asset('storage/' . $recipe->image) }}" alt="Card image cap">
                        </div>
                    </a>
                    <div class="card-body h-auto">
                        <h5 class="weight700 text-teal">{{ $recipe->title }}
                            @auth
                                @foreach($favourites as $fav)
                                    @if($recipe->id == $fav->recipe_id)<span><i class="text-danger fa far fa-heart"></i></span>@endif
                                @endforeach
                            @endauth
                        <x-rating-system rating="{{ $recipe->rating }}"></x-rating-system>
                        <small class="weight700 text-dark-teal">By {{ $recipe->user->name }}</small>
                    </div>
                    <div class="d-flex align-items-center p-2">
                        @if($recipe->cooking_time)
                            <i class="text-primary fa fa-clock"></i><span class="weight700">&nbsp{{ $recipe->cooking_time }}&nbspmins</span>

                        @endif

                        @if(count($recipe->commentRecipe))
                            <div class="weight700 ml-auto text-teal">{{ count($recipe->commentRecipe) }}&nbspReviews</div>
                        @else
                            <div class="weight700 ml-auto text-teal">No Reviews</div>
                        @endif
                    </div>
                </div>
                </div>
                @endforeach
            </div>
        </div>

    <hr>

    <h3 class="py-2 text-center text-md-left">How to's</h3>



</section>


@endsection
