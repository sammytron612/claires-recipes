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

    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            <div class="col">

                kjlkjljk
            </div>
        </div>
    </div>
@endsection