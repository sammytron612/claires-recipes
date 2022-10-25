@extends('layouts.app')

@section('content')

<x-header title="My profile"/>
<div class="container bg-white pt-1 pb-5">
    <x-breadcrumb />
    <div>
        @livewire('my-profile')
    </div>
</div>
@endsection
