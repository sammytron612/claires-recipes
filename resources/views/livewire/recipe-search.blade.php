<div class="relative text-center mb-8">
    <!-- Enhanced Search Container -->
    <div class="bg-gradient-to-r from-teal-50 to-orange-50 rounded-xl p-6 shadow-lg border border-gray-100">
        <div class="flex flex-col md:flex-row items-center justify-center gap-4">
            <!-- Enhanced Label -->
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <label class="font-bold text-xl text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-orange-500" for="search">
                    Find Your Perfect Recipe, cuisine, diet or ingredient
                </label>
            </div>
            
            <!-- Enhanced Search Input Container -->
            <div class="relative w-full md:w-auto group">
                <div class="relative">
                    <input 
                        wire:model.live.debounce.300ms="searchTerm"
                        type="search" 
                        class="w-full md:w-96 px-5 py-3 pl-12 pr-12 text-gray-700 bg-white border-2 border-gray-200 rounded-full shadow-md focus:outline-none focus:ring-4 focus:ring-teal-200 focus:border-teal-400 transition-all duration-300 hover:shadow-lg placeholder-gray-400" 
                        id="search"
                        placeholder="Search for recipes, ingredients, cuisines..."
                    >
                    
                    <!-- Search Icon (Left) -->
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-teal-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <!-- Loading/Clear Icon (Right) -->
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <div wire:loading wire:target="searchTerm">
                            <svg class="animate-spin w-5 h-5 text-teal-500" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <div wire:loading.remove wire:target="searchTerm">
                            @if($searchTerm)
                                <button 
                                    wire:click="$set('searchTerm', '')"
                                    class="p-1 hover:bg-gray-100 rounded-full transition-colors duration-200"
                                    type="button"
                                >
                                    <svg class="w-4 h-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            @else
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Search Suggestions Hint -->
                <div class="text-xs text-gray-500 mt-2 text-center">
                    Try searching for "pasta", "chicken", "vegetarian" or any ingredient
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Dropdown Results -->
    <div x-data="{ visible: @entangle('isVisible') }" x-cloak>
        <div 
            id="dropdown" 
            x-show="visible" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="absolute z-50 left-1/2 transform -translate-x-1/2 top-full mt-4 w-full max-w-2xl bg-white border border-gray-200 rounded-2xl shadow-2xl overflow-hidden"
        >
            <div class="max-h-96 overflow-y-auto custom-scrollbar">
                @if(count($WireRecipes) > 0)
                    <div class="bg-gradient-to-r from-teal-50 to-teal-100 px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <h3 class="font-semibold text-teal-800 text-sm uppercase tracking-wide">Recipes</h3>
                            <span class="bg-teal-200 text-teal-800 text-xs font-medium px-2 py-1 rounded-full">{{ count($WireRecipes) }}</span>
                        </div>
                    </div>
                    <div class="p-2">
                        @foreach($WireRecipes as $WireRecipe)
                        <a href="{{ route('recipe',['id'=> $WireRecipe->id, 'slug'=>$WireRecipe->slug]) }}" 
                           class="flex items-center p-3 hover:bg-gradient-to-r hover:from-teal-50 hover:to-orange-50 rounded-lg transition-all duration-200 group border-b border-gray-50 last:border-b-0">
                            <div class="relative">
                                <img class="w-14 h-14 object-cover rounded-lg shadow-md group-hover:shadow-lg transition-shadow duration-200" 
                                     src="{{ asset('storage/' . $WireRecipe->image) }}" 
                                     alt="{{ $WireRecipe->title }}">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 rounded-lg transition-opacity duration-200"></div>
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <h4 class="text-gray-900 font-medium group-hover:text-teal-700 transition-colors duration-200 truncate">
                                    {{ $WireRecipe->title }}
                                </h4>
                                <p class="text-gray-500 text-sm">Recipe</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-teal-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                @endif

                @if(count($WireCuisines) > 0)
                    <div class="bg-gradient-to-r from-orange-50 to-orange-100 px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                            </svg>
                            <h3 class="font-semibold text-orange-800 text-sm uppercase tracking-wide">Cuisines</h3>
                            <span class="bg-orange-200 text-orange-800 text-xs font-medium px-2 py-1 rounded-full">{{ count($WireCuisines) }}</span>
                        </div>
                    </div>
                    <div class="p-2">
                        @foreach($WireCuisines as $WireCuisine)
                        <a href="{{ route('cuisine',$WireCuisine->slug) }}" 
                           class="flex items-center p-3 hover:bg-gradient-to-r hover:from-orange-50 hover:to-teal-50 rounded-lg transition-all duration-200 group border-b border-gray-50 last:border-b-0">
                            <div class="relative">
                                <img class="w-14 h-14 object-cover rounded-lg shadow-md group-hover:shadow-lg transition-shadow duration-200" 
                                     src="{{ asset('storage/' . $WireCuisine->image) }}" 
                                     alt="{{ $WireCuisine->title }}">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 rounded-lg transition-opacity duration-200"></div>
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <h4 class="text-gray-900 font-medium group-hover:text-orange-700 transition-colors duration-200 truncate">
                                    {{ $WireCuisine->title }}
                                </h4>
                                <p class="text-gray-500 text-sm">Cuisine</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                @endif

                @if(count($WireIngredients) > 0)
                    <div class="bg-gradient-to-r from-green-50 to-green-100 px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <h3 class="font-semibold text-green-800 text-sm uppercase tracking-wide">Ingredients</h3>
                            <span class="bg-green-200 text-green-800 text-xs font-medium px-2 py-1 rounded-full">{{ count($WireIngredients) }}</span>
                        </div>
                    </div>
                    <div class="p-2">
                        @foreach($WireIngredients as $WireIngredient)
                        <a href="{{ route('ingredient',$WireIngredient->slug) }}" 
                           class="flex items-center p-3 hover:bg-gradient-to-r hover:from-green-50 hover:to-teal-50 rounded-lg transition-all duration-200 group border-b border-gray-50 last:border-b-0">
                            <div class="relative">
                                <img class="w-14 h-14 object-cover rounded-lg shadow-md group-hover:shadow-lg transition-shadow duration-200" 
                                     src="{{ asset('storage/' . $WireIngredient->image) }}" 
                                     alt="{{ $WireIngredient->title }}">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 rounded-lg transition-opacity duration-200"></div>
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <h4 class="text-gray-900 font-medium group-hover:text-green-700 transition-colors duration-200 truncate">
                                    {{ $WireIngredient->title }}
                                </h4>
                                <p class="text-gray-500 text-sm">Ingredient</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-green-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                @endif

                @if(count($WireCourses) > 0)
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="font-semibold text-purple-800 text-sm uppercase tracking-wide">Courses</h3>
                            <span class="bg-purple-200 text-purple-800 text-xs font-medium px-2 py-1 rounded-full">{{ count($WireCourses) }}</span>
                        </div>
                    </div>
                    <div class="p-2">
                        @foreach($WireCourses as $WireCourse)
                        <a href="{{ route('course',$WireCourse->slug) }}" 
                           class="flex items-center p-3 hover:bg-gradient-to-r hover:from-purple-50 hover:to-teal-50 rounded-lg transition-all duration-200 group border-b border-gray-50 last:border-b-0">
                            <div class="relative">
                                <img class="w-14 h-14 object-cover rounded-lg shadow-md group-hover:shadow-lg transition-shadow duration-200" 
                                     src="{{ asset('storage/' . $WireCourse->image) }}" 
                                     alt="{{ $WireCourse->title }}">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 rounded-lg transition-opacity duration-200"></div>
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <h4 class="text-gray-900 font-medium group-hover:text-purple-700 transition-colors duration-200 truncate">
                                    {{ $WireCourse->title }}
                                </h4>
                                <p class="text-gray-500 text-sm">Course</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                @endif

                @if(count($WireDiets) > 0)
                    <div class="bg-gradient-to-r from-pink-50 to-pink-100 px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <h3 class="font-semibold text-pink-800 text-sm uppercase tracking-wide">Diets</h3>
                            <span class="bg-pink-200 text-pink-800 text-xs font-medium px-2 py-1 rounded-full">{{ count($WireDiets) }}</span>
                        </div>
                    </div>
                    <div class="p-2">
                        @foreach($WireDiets as $WireDiet)
                        <a href="{{ route('diet',$WireDiet->slug) }}" 
                           class="flex items-center p-3 hover:bg-gradient-to-r hover:from-pink-50 hover:to-teal-50 rounded-lg transition-all duration-200 group border-b border-gray-50 last:border-b-0">
                            <div class="relative">
                                <img class="w-14 h-14 object-cover rounded-lg shadow-md group-hover:shadow-lg transition-shadow duration-200" 
                                     src="{{ asset('storage/' . $WireDiet->image) }}" 
                                     alt="{{ $WireDiet->title }}">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 rounded-lg transition-opacity duration-200"></div>
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <h4 class="text-gray-900 font-medium group-hover:text-pink-700 transition-colors duration-200 truncate">
                                    {{ $WireDiet->title }}
                                </h4>
                                <p class="text-gray-500 text-sm">Diet</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-pink-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                @endif
            
                <!-- Footer Section -->
                @if(count($WireRecipes) > 4)
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-4 py-4 border-t border-gray-200">
                        <div class="text-center">
                            <a href="{{ url('/search/' . $searchTerm ) }}" 
                               class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-600 to-orange-500 text-white font-semibold px-6 py-3 rounded-full hover:from-teal-700 hover:to-orange-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Show All {{ count($WireRecipes) }}+ Results
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Custom Scrollbar Styles -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #14b8a6, #f97316);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #0f766e, #ea580c);
        }
        
        /* Enhanced focus states */
        #search:focus {
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        /* Subtle animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .search-result-item {
            animation: fadeInUp 0.3s ease-out;
        }
    </style>
</div>

