@extends('layouts.app')

@section('content')
    @include('includes.search')

    <div class="col-12 mt-4 d-flex h-100 align-items-center justify-content-center">
        <div class="position-relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/' . $recipes[0]->image) }}">
        </div>
        <div style="" class="position-absolute d-flex h-100 align-items-center justify-content-center">
            <h3 style="background: rgba(204, 204, 204, 0.8);" class=" border border-dark text-dark p-2 p-md-5">Searched recipes</h3>
        </div>
    </div>


    <div class="container px-3 py-3 bg-white">
        <h5 class="text-center py-2">Recipes based on your search term '{{ $searchTerm }}'</h5>
        <div class="d-flex justify-content-center row py-2 col-12">
            <a href="{{ url($url . $searchTerm) }} " class="btn mr-2 btn-outline-teal rounded-pill"><h5 class="pt-1">Reset</h5></a>
            <a href="{{ url($url . $searchTerm. '/created_at') }}" class="@if(str_contains(url()->current(), '/created_at')) ? btn-teal text-white  : '' @endif btn-outline-teal btn mr-2 rounded-pill"><h5 class="pt-1">Recent</h5></a>
            <a href="{{ url($url . $searchTerm . '/rating') }}" class="@if(str_contains(url()->current(), '/rating')) ? btn-teal text-white : '' @endif btn mr-2  btn-outline-teal rounded-pill"><h5 class="pt-1">Highest rated</h5></a>
            <a href="{{ url($url . $searchTerm . '/views') }}" class="@if(str_contains(url()->current(), '/views')) ? btn-teal text-white : '' @endif btn mr-2 btn-outline-teal rounded-pill"><h5 class="pt-1">Most viewed</h5></a>
        </div>
        <div class="mt-3 px-5 p-md-0 row row-cols-1 d-flex justify-content-around row-cols-md-3 row-cols-lg-4">
                @foreach($recipes as $recipe)
                    <div class="p-1 d-flex align-items-stretch col card m-1 mb-5 shadow">
                        <a href="{{ route('recipe',$recipe->slug) }}" data-toggle="popover" data-placement="right"
                            title="{{ $recipe->description }}" class="stretched-link">
                            <div class="">
                                <img class="card-img-top" src="{{ asset('storage/' . $recipe->image) }}" alt="Card image cap">
                            </div>
                        </a>
                        <div class="card-body">
                            <h5 class="weight700 text-teal">{{ $recipe->title }}</h5>
                            <x-rating-system rating="{{ $recipe->rating }}"></x-rating-system>
                            <small class="weight700 text-dark-teal">By {{ $recipe->user->name }}</small>
                        </div>
                        <div class="d-flex align-items-center p-2">
                            @if($recipe->cooking_time)
                                <i class="text-primary fa fa-clock"></i><span class="weight700">&nbsp{{ $recipe->cooking_time }}&nbspmins</span>
                            @endif
                            @if(count($recipe->comment))
                                <div class="weight700 ml-auto text-teal">{{ count($recipe->comment) }}&nbspReviews</div>
                            @else
                                <div class="weight700 ml-auto text-teal">No Reviews</div>
                            @endif
                        </div>
                    </div>
                @endforeach
        </div>
        <div class="d-flex justify-content-center">
        {{ $recipes->links() }}
        </div>
    </div>


    <script>
        $(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        });
    });
        </script>
@endsection
