@extends('layouts.app', ['title' => $category->title . ' | Claires Recipes', 'description' => $category->title])

@section('content')
    @include('includes.search')


    <div class="col-12 mt-4 d-flex h-100 align-items-center justify-content-center">
        <div class="position-relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/' . $category->image) }}">
        </div>
        <div class="position-absolute d-flex h-100 align-items-center justify-content-center">
            <h3 style="background: rgba(204, 204, 204, 0.8);font-family: 'Pacifico', cursive;" class="border border-dark text-dark p-2 p-md-5">{{ $category->title}}</h3>
        </div>
    </div>


    <div class="h5 py-5 w-75 mx-auto">
        <p>{{ $category->description }}</p>
    </div>

    <div class="container px-3 py-3 bg-white">

        <x-breadcrumb/>

        <div class="d-flex justify-content-center row py-2 col-12">
            <a href="{{ url($url . $category->slug) }} " class="btn mt-1 mr-2 btn-outline-teal rounded-pill"><h5 class="pt-1">Reset</h5></a>
            <a href="{{ url($url . $category->slug . '/created_at') }}" class="@if(str_contains(url()->current(), '/created_at')) ? btn-teal text-white  : '' @endif mt-1 btn-outline-teal btn mr-2 rounded-pill "><h5 class="pt-1">Recent</h5></a>
            <a href="{{ url($url . $category->slug . '/rating') }}" class="@if(str_contains(url()->current(), '/rating')) ? btn-teal text-white : '' @endif btn mr-2  mt-1 btn-outline-teal rounded-pill"><h5 class="pt-1">Highest rated</h5></a>
            <a href="{{ url($url . $category->slug . '/views') }}" class="@if(str_contains(url()->current(), '/views')) ? btn-teal text-white : '' @endif btn mr-2 mt-1 btn-outline-teal rounded-pill"><h5 class="pt-1">Most viewed</h5></a>
        </div>
        <div class="mt-3 px-5 p-md-0 row row-cols-1 d-flex justify-content-around row-cols-md-3 row-cols-lg-4">

                @foreach($recipes as $recipe)

                    <div class="p-1 d-flex align-items-stretch col card m-1 mb-5 shadow">
                        <a href="{{ route('recipe',$recipe->recipes->slug) }}" data-toggle="popover" data-placement="right"
                            title="{{ $recipe->recipes->description }}" class="stretched-link">

                            <div class="">
                                <img class="card-img-top" src="{{ asset('storage/' . $recipe->recipes->image) }}" alt="Card image cap">
                            </div>
                        </a>

                        <div class="card-body">
                            <h5 class="weight700 text-teal">{{ $recipe->recipes->title }}&nbsp
                                    @auth
                                        @foreach($recipe->recipes->User->favourite as $fav)
                                            @if ($fav->recipe_id == $recipe->id)
                                                <span><i class="text-danger fa far fa-heart"></i></span>
                                            @endif
                                        @endforeach
                                    @endauth
                            </h5>

                            <x-rating-system rating="{{ $recipe->rating }}"></x-rating-system>
                            <small class="weight700 text-dark-teal">By {{ $recipe->recipes->user->name }}</small>
                        </div>
                        <div class="d-flex align-items-center p-2">
                            @if($recipe->cooking_time)
                                <i class="text-primary fa fa-clock"></i><span class="weight700">&nbsp{{ $recipe->recipes->cooking_time }}&nbspmins</span>
                            @endif

                            @if($recipe->recipes->commentRecipe)
                                <div class="ml-auto text-teal">
                                   @if(count($recipe->recipes->commentRecipe) == 1)
                                        <span>1&nbspcomment</span>
                                   @elseif(count($recipe->recipes->commentRecipe) > 1)
                                        <span>{{ count($recipe->recipes->commentRecipe) }}&nbspcomments</span>
                                    @else
                                        <span>No comments</span>
                                   @endif
                                </div>
                            @else
                                <div class="weight700 ml-auto text-teal">No Reviews</div>
                            @endif
                        </div>
                    </div>
                @endforeach
        </div>
        <div class="pagination">
        {{ $recipes->links() }}
        </div>
    </div>


    <script>
       document.addEventListener('DOMContentLoaded', function () {
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        });
    });
        </script>
@endsection
