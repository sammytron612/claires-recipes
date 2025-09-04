<div>
    <h2 class="mt-5 text-2xl font-bold">Some of our Favourites</h2>
    
    <div class="mt-4">
        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 items-center justify-center gap-4">
            @foreach($seasonal as $seasonalItem)
                <x-recipe-card :recipe="$seasonalItem->recipe" />
            @endforeach
        </div>
    </div>
</div>
