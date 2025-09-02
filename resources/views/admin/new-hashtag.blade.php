@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white py-8">
    @livewire('new-hashtag')
    @livewire('category-table')
</div>
@endsection
