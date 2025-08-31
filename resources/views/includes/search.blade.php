<div class="bg-white grid grid-cols-1 md:grid-cols-2 items-center py-2 gap-4">
    <div class="flex justify-center">
        <img style="height:170px" class="w-auto" src="{{ asset('storage/claires-recipes.png') }}" alt="Claires Site Logo">
    </div>
    <div class="flex justify-center ml-2 sm:ml-0">
        @livewire('recipe-search')
    </div>
</div>

<div class="mt-3 flex flex-wrap justify-center items-center gap-2">
    <div class="font-bold text-lg text-orange-500 text-center mr-2 w-full md:w-auto">Browse recipes:</div>
    
    <div class="text-center bg-white p-2 min-w-[120px]">
        <a class="block w-full text-teal-600 font-bold hover:bg-gray-100 transition-colors py-2 px-3" href="{{ route('category','special-diet' )}}">Diet</a>
    </div>

    <div class="text-center bg-white p-2 min-w-[120px]">
        <a class="block w-full text-teal-600 font-bold hover:bg-gray-100 transition-colors py-2 px-3" href="{{ route('category','ingredient' )}}">Ingredients</a>
    </div>
    
    <div class="text-center bg-white p-2 min-w-[120px]">
        <a class="block w-full text-teal-600 font-bold hover:bg-gray-100 transition-colors py-2 px-3" href="{{ route('category','course' )}}">Course</a>
    </div>
    
    <div class="text-center bg-white p-2 min-w-[120px]">
        <a class="block w-full text-teal-600 font-bold hover:bg-gray-100 transition-colors py-2 px-3" href="{{ route('category','cuisine' )}}">Cuisine</a>
    </div>
</div>

