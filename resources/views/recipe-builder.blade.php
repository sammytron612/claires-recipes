@extends('layouts.app', ['noFollow' => false, 'title' => 'Claires Recipes - Recipe Builder', 'description' => "Search for Recipes on the ingredients you have."])

@section('content')

<div class="max-w-7xl mx-auto bg-white px-4">
   
    <div class="mt-5">
    	@livewire('recipe-builder')
    </div>
</div>
@endsection
