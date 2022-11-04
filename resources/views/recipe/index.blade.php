@extends('layouts.app', ['noFollow' => true, 'title' => 'Recipe Index | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])


@section('content')

<x-header title="Recipe index"/>
<div class="container bg-white pl-25">
    <div class="pb-5">
        <x-breadcrumb/>

        <div class="mt-3 px-5 p-md-0">

                <div class="row row row-cols-1 row-cols-sm-2 row-cols-md-3 ">
                    <div class="col mt-2">
                    @foreach ($index as $return)


                            @if($loop->first)
                            <h1>
                                {{ ucfirst(substr($index[$loop->index]->title, 0, 1)) }}
                            </h1>
                            <div>
                                <a href="{{ route($return->category,$return->slug) }}"><h5>{{ $return->title }}</h5>
                                </a>({{ $return->total }})
                            </div>


                            @endif


                            @if(!$loop->first)
                                @php

                                    $current = ucfirst(substr($index[$loop->index-1]->title, 0, 1));
                                    $next = ucfirst(substr($index[$loop->index]->title, 0, 1));
                                @endphp

                                @if($current == $next)
                                    <div>
                                        <a href="{{ route($return->category,$return->slug) }}"><h5>{{ $return->title }}</h5>
                                        </a>({{ $return->total }})
                                    </div>

                                @else
                                </div><div class="col mt-2">
                                    <h1>{{ $next }}</h1>
                                    <div>
                                        <a href="{{ route($return->category,$return->slug) }}"><h5>{{ $index[$loop->index]->title }}</h5>
                                        </a>({{ $return->total }})
                                    </div>

                                @endif
                            @endif
                    @endforeach
                        </div>
                </div>

        </div>
    </div>
</div>
@endsection


