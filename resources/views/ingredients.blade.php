@extends('layouts.app', ['noFollow' => true, 'title' => 'Ingredients | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')
    @include('includes.search')

    <div class="col-12 mt-4 d-flex h-100 align-items-center justify-content-center">
        <div class="position-relative">
            <img style="width:100vw; object-fit: cover; height:45vh"  src="{{ asset('storage/ingredients1232.jfif') }}">
        </div>
        <div style="" class="position-absolute d-flex h-100 align-items-center justify-content-center">
            <h3 style="font-family: 'Pacifico', cursive;background: rgba(204, 204, 204, 0.8);" class="text-capitalize border border-dark text-dark p-3">{{ $caption }}</h3>
        </div>
    </div>

    <div class="container px-3 py-3 bg-white">

        <x-breadcrumb/>

        <div class="mt-3 px-5 p-md-0">

                <div class="row row row-cols-1 row-cols-sm-2 row-cols-md-3 ">
                    <div class="col mt-2">
                    @foreach ($returns as $return)


                            @if($loop->first)
                            <h1>
                                {{ ucfirst(substr($returns[$loop->index]->title, 0, 1)) }}
                            </h1>
                            @endif


                            @if(!$loop->first)
                                @php

                                    $current = ucfirst(substr($returns[$loop->index-1]->title, 0, 1));
                                    $next = ucfirst(substr($returns[$loop->index]->title, 0, 1));
                                @endphp

                                @if($current == $next)

                                    <a class="d-block" href="{{  route($route,$return->slug) }}"
                                        data-toggle="popover" data-placement="right"
                                        data-img="{{ asset('storage/' . $return->image) }}"><h5>{{ $return->title }}</h5></a>

                                @else
                                </div><div class="col mt-2">
                                    <h1>{{ $next }}</h1>
                                    <a class="d-block" href="{{  route($route,$returns[$loop->index]->slug) }}"
                                        data-toggle="popover" data-placement="right"
                                        data-img="{{ asset('storage/' . $returns[$loop->index]->image) }}"><h5>{{ $returns[$loop->index]->title }}</h5>
                                    </a>

                                @endif
                            @endif
                    @endforeach
                        </div>
                </div>

        </div>
        
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('[data-toggle="popover"]').popover({
                html: true,
                trigger: 'hover',
                placement: 'bottom',
                content: function(){return '<img class="img-thumbnail" src="'+$(this).data('img') + '" />';}
         });

     });
         </script>


@endsection
