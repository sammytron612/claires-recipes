@extends('layouts.app', ['noFollow' => true, 'title' => 'Recipe Builder | Claires Recipes', 'description' => "Search for Recipes on the ingredients you have."])

@section('content')
<div class="w-full bg-white">
    <x-header title="Recipe builder"/>
</div>
<div class="max-w-7xl mx-auto bg-white px-4">
    <x-breadcrumb/>
    <div class="mt-5">
    	@livewire('recipe-builder')
    </div>
</div>
@endsection
