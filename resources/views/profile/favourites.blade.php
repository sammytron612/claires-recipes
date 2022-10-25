@extends('layouts.app')

@section('content')
<x-header class="w-100" title="My favourites"/>
<div class="container">
    <x-breadcrumb />
    <div>
        @livewire('favourite-planner')
    </div>
</div>
@endsection

