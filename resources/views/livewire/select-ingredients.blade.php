<div class="relative">
    <!-- Hidden inputs for form submission -->
    @foreach($wireIngredients as $index => $ingredientId)
        <input type="hidden" name="wireIngredients[{{ $index }}]" value="{{ $ingredientId }}">
    @endforeach

    <!-- Search Input -->
    <div class="relative">
        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="Search ingredients..." 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        >
        
        <!-- Search Icon -->
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Dropdown with Available Ingredients -->
    @if($showDropdown && count($availableIngredients) > 0)
        <div class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
            @foreach($availableIngredients as $ingredient)
                <div 
                    wire:click="selectIngredient({{ $ingredient['id'] }})"
                    class="px-4 py-2 cursor-pointer hover:bg-blue-50 flex items-center space-x-3 border-b border-gray-100 last:border-b-0"
                >
                    @if(isset($ingredient['image']) && $ingredient['image'])
                        <img src="{{ asset('storage/' . $ingredient['image']) }}" 
                             alt="{{ $ingredient['title'] }}" 
                             class="w-8 h-8 rounded-full object-cover">
                    @else
                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="text-xs text-gray-500">{{ substr($ingredient['title'], 0, 1) }}</span>
                        </div>
                    @endif
                    <span class="text-gray-800">{{ $ingredient['title'] }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Selected Ingredients -->
    @if(count($selectedIngredients) > 0)
        <div class="mt-4">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Selected Ingredients:</h4>
            <div class="flex flex-wrap gap-2">
                @foreach($selectedIngredients as $index => $ingredient)
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                        @if(isset($ingredient['image']) && $ingredient['image'])
                            <img src="{{ asset('storage/' . $ingredient['image']) }}" 
                                 alt="{{ $ingredient['title'] }}" 
                                 class="w-4 h-4 rounded-full object-cover mr-2">
                        @endif
                        <span>{{ $ingredient['title'] }}</span>
                        <button 
                            wire:click="removeIngredient({{ $index }})"
                            class="ml-2 text-blue-600 hover:text-blue-800"
                            type="button"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Click outside to close dropdown -->
    @if($showDropdown)
        <div class="fixed inset-0 z-40" wire:click="hideDropdown"></div>
    @endif
</div>