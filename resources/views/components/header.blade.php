@props(['title'])
<div class="w-full">
    <div class="bg-white grid grid-cols-1 md:grid-cols-2 items-center py-2 gap-4">
        <div class="flex justify-center">
            <img 
                style="height:170px" 
                class="w-auto" 
                src="{{ asset('storage/claires-recipes.png') }}" 
                alt="Claire Logo"
            >
        </div>
        
        <div class="flex justify-center">
            <h1 class="font-pacifico text-3xl md:text-4xl text-center">{{ $title }}</h1>
        </div>
    </div>
</div>
