<div class="bg-white text-center">
    <div class="flex justify-center ml-2 sm:ml-0 relative z-10 top-8">
        @livewire('recipe-search')
    </div>
</div>

<div class="mt-6 text-xl flex flex-wrap justify-center items-center gap-2 relative z-0">
    <div class="font-bold text-orange-500 text-center mr-2 w-full md:w-auto">Browse recipes:</div>
    
    <div class="text-center bg-white p-2 min-w-[120px]">
        <a class="block w-full text-teal-600 font-bold hover:bg-gray-100 transition-colors py-2 px-3" href="{{ route('category','special-diet' )}}" wire:navigate>Diet</a>
    </div>

    <div class="text-center bg-white p-2 min-w-[120px]">
        <a class="block w-full text-teal-600 font-bold hover:bg-gray-100 transition-colors py-2 px-3" href="{{ route('category','ingredient' )}}" wire:navigate>Ingredients</a>
    </div>
    
    <div class="text-center bg-white p-2 min-w-[120px]">
        <a class="block w-full text-teal-600 font-bold hover:bg-gray-100 transition-colors py-2 px-3" href="{{ route('category','course' )}}" wire:navigate>Course</a>
    </div>
    
    <div class="text-center bg-white p-2 min-w-[120px]">
        <a class="block w-full text-teal-600 font-bold hover:bg-gray-100 transition-colors py-2 px-3" href="{{ route('category','cuisine' )}}" wire:navigate>Cuisine</a>
    </div>
</div>

