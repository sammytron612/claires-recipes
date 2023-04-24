@extends('layouts.app', ['image'=> "{$image}", 'title' => 'Blog | Claires Recipes', 'description' => "{$BlogArticle->title}"])

@section('content')

    <x-header title="Blog" />
    
    <div class="container bg-white pb-5">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col text-center">
                <img class="w-100" src="{{$BlogArticle->main_image}}"/>
            </div>
            <div class="col d-flex align-items-center"><h1 style="font-family: 'Pacifico', cursive;" class="mx-auto mt-5">{{$BlogArticle->title}}</h1></div>
        </div>
        <div class="mt-5 text-left">
            @php echo $body->body @endphp
        </div>
    </div>
@endsection