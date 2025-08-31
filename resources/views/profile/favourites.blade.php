@extends('layouts.app', ['title' => 'Favourites | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])

@section('content')
<x-header class="w-full" title="My favourites"/>
<div class="max-w-7xl mx-auto px-4">
    <x-breadcrumb />
    <div>
        @livewire('favourite-planner')
    </div>
</div>
@endsection

