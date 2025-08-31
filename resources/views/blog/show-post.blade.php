@extends('layouts.app', ['image'=> "{$image}", 'title' => 'Blog | Claires Recipes', 'description' => "{$BlogArticle->title}"])

@section('content')

    <x-header title="Blog" />
    
    <div class="max-w-7xl mx-auto bg-white pb-5 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="text-center">
                <img class="w-full rounded-lg shadow-md" src="{{$BlogArticle->main_image}}"/>
            </div>
            <div class="flex items-center">
                <h1 style="font-family: 'Pacifico', cursive;" class="mx-auto mt-5 text-3xl md:text-4xl text-gray-800">{{$BlogArticle->title}}</h1>
            </div>
        </div>
        <div class="mt-8 text-left prose max-w-none">
            @php echo $body->body @endphp
        </div>
    </div>
@endsection