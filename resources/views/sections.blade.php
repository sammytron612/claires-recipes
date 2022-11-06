@extends('layouts.app', ['noFollow' => true, 'title' => $caption . ' | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')
    @include('includes.search')

    <div class="col-12 mt-4 d-flex h-100 align-items-center justify-content-center">
        <div class="position-relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/' . $image) }}" alt="{{$caption}}">
        </div>
        <div style="" class="position-absolute d-flex h-100 align-items-center justify-content-center">
            <h3 style="font-family: 'Pacifico', cursive;background: rgba(204, 204, 204, 0.8);" class="text-capitalize border border-dark text-dark p-3">{{ $caption }}</h3>
        </div>
    </div>

    <div class="container px-3 py-3 bg-white">

        <x-breadcrumb/>

        <div class="mt-3 px-5 p-md-0 row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 d-flex justify-content-around row-cols-md-3 row-cols-lg-4">
            @foreach($returns as $return)
                <div class="col d-flex mt-2 align-items-stretch">
                    <a href="{{ route($route,$return->slug) }}" class="stretched-link"></a>
                    <div class="shadow card p-0 col w-50 w-sm-100">
                        <div style="overflow-y:hidden" class="d-flex flex-column h-auto h5 px-2 pt-3">
                            <div class="text-center text-teal">{{ $return->title }}</div>
                        </div>
                        @if($route == "cuisine")
                            <div style="min-height:180px;" class="d-none pb-2 h-auto card-body d-md-block mb-2">
                                <div>{{ $return->description }}</div>
                            </div>
                        @endif
                        @if($route == "course")
                            <div style="min-height:180px;" class="d-none pb-2 h-auto card-body d-md-block mb-2">
                                <div>{{ $return->description }}</div>
                            </div>
                        @endif
                        <img class="my-height mt-1 card-img-bottom w-100" src="{{ asset('storage/'. $return->image) }}" alt="{{$return->title}}">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination mt-5 d-flex justify-content-center">
        {{ $returns->links() }}
        </div>
    </div>



@endsection
