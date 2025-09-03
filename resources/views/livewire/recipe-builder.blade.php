<div class="min-h-screen bg-gradient-to-br from-yellow-100 via-pink-100 to-teal-200">
    <!-- Simplified Header Section with Search -->
    <div class="bg-gradient-to-r from-orange-200 via-pink-100 to-teal-100 border-b-4 border-orange-300 shadow-lg relative">
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none" style="background: url('https://www.transparenttextures.com/patterns/food.png'); opacity:0.08;"></div>
        <div class="max-w-4xl mx-auto px-4 py-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-extrabold text-orange-500 drop-shadow mb-2 tracking-tight">
                    <i class="fas fa-blender mr-2 text-pink-400"></i> Recipe Builder
                </h1>
                <p class="text-lg text-teal-600 font-semibold">Find recipes based on ingredients you have at home</p>
            </div>
            
            <!-- Clean Search Section -->
            <div class="max-w-xl mx-auto">
                <label class="block text-sm font-medium text-gray-700 mb-3" for="search">
                    Search for ingredients:
                </label>
                <div class="relative">
                    <input 
                        wire:model.live.debounce.300ms="searchTerm"
                        type="search" 
                        class="w-full px-4 py-3 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" 
                        id="search"
                        placeholder="Type an ingredient... (e.g., chicken, tomato, cheese)"
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <i class="fa fa-search text-gray-400"></i>
                    </div>
                    <!-- Enhanced Dropdown -->
                    @if($isVisible)
                    <div 
                        id="dropdown" 
                        class="absolute z-50 top-full mt-1 bg-white rounded-xl shadow-2xl border border-gray-100 w-full left-0"
                    >
                        @if($wireIngredients)
                            <div class="p-4">
                                <div class="text-orange-600 font-bold text-sm uppercase tracking-wide mb-3 flex items-center">
                                    <i class="fas fa-carrot mr-2"></i>
                                    Available Ingredients
                                </div>
                                <ul class="space-y-2">
                                    @foreach($wireIngredients as $wireIngredient)
                                    <li>
                                        <button 
                                            wire:click="addIngredient({{ $wireIngredient }})" 
                                            class="flex items-center w-full p-3 hover:bg-gradient-to-r hover:from-orange-50 hover:to-pink-50 rounded-lg transition-all duration-200 group border border-transparent hover:border-orange-200"
                                        >
                                            <div class="relative">
                                                <img 
                                                    class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200 group-hover:border-orange-300 transition-colors" 
                                                    src="{{ asset('storage/' . $wireIngredient->image) }}" 
                                                    alt="{{ $wireIngredient->title }}"
                                                >
                                                <div class="absolute -top-1 -right-1 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <i class="fas fa-plus text-white text-xs"></i>
                                                </div>
                                            </div>
                                            <span class="ml-4 text-gray-800 font-medium group-hover:text-orange-700 transition-colors">{{ $wireIngredient->title }}</span>
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    @endif
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        
        <!-- Selected Ingredients Section -->
        @if($ingredients)
        <div class="mb-12">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-pink-500 mb-2 drop-shadow">
                    <i class="fas fa-shopping-basket text-orange-400 mr-2"></i>
                    Your Selected Ingredients
                </h2>
                <p class="text-gray-600">Click on any ingredient to remove it from your selection</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="bg-white rounded-2xl shadow-2xl border-4 border-orange-200 p-8">
                <div class="flex flex-wrap justify-center gap-4">
                    @foreach($ingredients as $ingredient)
                        <button 
                            wire:click="removeIngredient({{ $ingredient['id'] }})" 
                            class="group inline-flex items-center px-5 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 text-white rounded-full hover:from-red-400 hover:to-pink-500 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg"
                        >
                            <span class="font-medium">{{ $ingredient['title'] }}</span>
                            <div class="ml-3 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors">
                                <i class="fas fa-times text-xs"></i>
                            </div>
                        </button>
                    @endforeach

                    <div wire:loading.inline wire:target="addIngredient" class="flex items-center px-5 py-3">
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-orange-500"></div>
                        <span class="ml-2 text-gray-600 font-medium">Adding...</span>
                    </div>
                </div>
            </div>
        </div>
        @else
            @if(!$isVisible)
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gradient-to-br from-orange-400 to-pink-400 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-utensils text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Let's Create Something Delicious!</h3>
                    <p class="text-lg text-gray-600 mb-2">Start by searching for ingredients you have at home</p>
                    <p class="text-gray-500 italic">We'll find the perfect recipes for you ✨</p>
                </div>
            </div>
            @endif
        @endif


        <!-- Recipe Results Section -->
        @isset($recipes)
        @if(count($ingredients) > 1 && (count($recipes) == 0))
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-3">No Recipes Found</h3>
                <p class="text-gray-500">We couldn't find any recipes with that combination of ingredients. Try adding different ingredients or removing some to get more results.</p>
            </div>
        </div>
        @else
        
        <!-- Loading State -->
        <div wire:loading.inline wire:target="render" class="text-center py-12">
            <div class="inline-flex items-center px-6 py-4 bg-white rounded-xl shadow-lg border border-gray-100">
                <svg class="animate-spin -ml-1 mr-4 h-8 w-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-lg font-medium text-gray-700">Finding perfect recipes for you...</span>
            </div>
        </div>
        
        <!-- Recipes Grid -->
        @if($recipes)
        <div class="mb-8 mt-4">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-3">
                    <i class="fas fa-magic text-orange-500 mr-2"></i>
                    Recipes Made For You
                </h2>
                <p class="text-gray-600">{{ count($recipes) }} delicious recipe{{ count($recipes) > 1 ? 's' : '' }} found with your ingredients</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-8 md:px-16 lg:px-32">
                @foreach($recipes as $recipe)
                <x-recipe-card :recipe="$recipe->recipes" />
                @endforeach
            </div>
        </div>
        @endif
        @endif
        <!-- Load More Button -->
        @if(count($recipes) >= 20)
            <div class="text-center mt-12">
                <button wire:click="viewMore" class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-pink-500 hover:from-orange-600 hover:to-pink-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <span class="mr-2">Load More Recipes</span>
                    <i class="fas fa-chevron-down group-hover:translate-y-1 transition-transform"></i>
                </button>
            </div>
        @endif
        @endisset($recipes)

    </div>

</div>

