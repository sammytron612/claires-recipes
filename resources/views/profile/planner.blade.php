@extends('layouts.app', ['title' => 'Planner | Claires Recipes', 'description' => "Claires Recipes, tasty recipes tried and tested for everyone"])


@section('content')

<x-header title="My planner"/>
<div class="max-w-7xl mx-auto bg-white px-4">
    <x-breadcrumb />
    <div>
        @livewire('my-planner')
    </div>
</div>
@endsection
