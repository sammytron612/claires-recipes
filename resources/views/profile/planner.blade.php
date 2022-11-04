@extends('layouts.app', ['title' => 'Planner | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])


@section('content')

<x-header title="My planner"/>
<div class="container bg-white">
    <x-breadcrumb />
    <div>
        @livewire('my-planner')
    </div>
</div>
@endsection
