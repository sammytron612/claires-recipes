@extends('layouts.app')

@section('content')
<div class="container-fluid bg-white">
    <x-header title="Recipe builder"/>
</div>
<div class="container bg-white">
    <x-breadcrumb/>
    <div class="mt-5">
    	@livewire('recipe-builder')
    </div>
</div>
@endsection
