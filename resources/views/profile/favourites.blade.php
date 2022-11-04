@extends('layouts.app', ['title' => 'Favourites | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')
<x-header class="w-100" title="My favourites"/>
<div class="container">
    <x-breadcrumb />
    <div>
        @livewire('favourite-planner')
    </div>
</div>
@endsection

