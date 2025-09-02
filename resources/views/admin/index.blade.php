@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if (session('status'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center" role="alert">
    <strong>{{ session('status') }}</strong>
    <button type="button" class="float-right text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'" aria-label="Close">
      <span>&times;</span>
    </button>
</div>
@endif

<x-header title="Admin Menu" />

<div class="bg-white rounded-lg shadow-sm">
    <div class="pt-8 pb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border border-gray-200">
                <a href="{{ route('admin.new-recipe') }}" class="block p-6 text-center group">
                    <div class="flex flex-col items-center space-y-3">
                        <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center group-hover:bg-teal-200 transition-colors">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-semibold text-teal-700 group-hover:text-teal-800 transition-colors">Add a new recipe</h5>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border border-gray-200">
                <a href="{{ route('admin.recipe-index') }}" class="block p-6 text-center group">
                    <div class="flex flex-col items-center space-y-3">
                        <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center group-hover:bg-teal-200 transition-colors">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-semibold text-teal-700 group-hover:text-teal-800 transition-colors">Edit a recipe</h5>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border border-gray-200">
                <a href="{{ route('blog.new-article') }}" class="block p-6 text-center group">
                    <div class="flex flex-col items-center space-y-3">
                        <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center group-hover:bg-teal-200 transition-colors">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-semibold text-teal-700 group-hover:text-teal-800 transition-colors">New Blog Article</h5>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border border-gray-200">
                <a href="{{ route('admin.new-hashtag') }}" class="block p-6 text-center group">
                    <div class="flex flex-col items-center space-y-3">
                        <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center group-hover:bg-teal-200 transition-colors">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-semibold text-teal-700 group-hover:text-teal-800 transition-colors">Add a hashtag/Ingredient</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
