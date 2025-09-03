@extends('layouts.app')

@section('content')

<x-header title="My profile"/>
<div class="max-w-7xl mx-auto bg-white pt-1 pb-5 px-4">
   
    <div>
        @livewire('my-profile')
    </div>
</div>
@endsection
