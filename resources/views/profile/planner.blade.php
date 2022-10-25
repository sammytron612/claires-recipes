@extends('layouts.app')

@section('content')

<x-header title="My planner"/>
<div class="container bg-white">
    <x-breadcrumb />
    <div>
        @livewire('my-planner')
    </div>
</div>
@endsection
