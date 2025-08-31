<div class="absolute -top-10 right-0">
    <button 
        wire:click="toggleFav" 
        class="bg-white font-bold shadow border border-gray-300 rounded px-3 py-1 text-gray-800 hover:shadow-md transition-shadow cursor-pointer"
    >
        <i class="fa @if($fav) fas text-red-500 @else far @endif fa-heart"></i>
    </button>
</div>
