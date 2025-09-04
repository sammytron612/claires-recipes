<div class="max-w-7xl mx-auto px-4 py-6">
    @if(!count($favourites))
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">No Favorite Recipes Yet</h2>
            <p class="text-gray-600 mb-6">Start adding recipes to your favorites to see them here!</p>
            <a href="{{ route('recipe.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Browse Recipes
            </a>
        </div>
    @else
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">My Favorite Recipes</h1>
            <p class="text-gray-600">Manage your favorite recipes and add them to your meal planner</p>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">In Planner</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($favourites as $fav)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <a href="{{ route('recipe', ['id' => $fav->id, 'slug' => $fav->slug]) }}" class="block">
                                    <img class="w-20 h-16 object-cover rounded-lg border border-gray-200 hover:border-gray-300 transition-colors" 
                                         src="{{ asset('storage/' . $fav->image) }}" 
                                         alt="{{ $fav->title }}"
                                         onerror="this.src='{{ asset('images/placeholder-recipe.jpg') }}'">
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('recipe', ['id' => $fav->id, 'slug' => $fav->slug]) }}" 
                                   class="font-medium text-gray-900 hover:text-blue-600 transition-colors">
                                    {{ $fav->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                {{ $fav->description }}
                            </td>
                            
                            @php $flag = false; $flag1 = false; $currentPlannerEntry = null; @endphp
                            @foreach($plannerEntries as $plannerEntry)
                                @if($fav->recipe_id == $plannerEntry->recipe_id)
                                    @php $flag1 = true; $currentPlannerEntry = $plannerEntry; @endphp
                                    @php $flag = true @endphp
                                @endif
                            @endforeach
                            
                            <td class="px-6 py-4">
                                @if($flag)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Yes
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        No
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <button wire:click.debounce.500ms="destroy({{ $fav->fav_id }})" 
                                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-xs font-medium rounded-md hover:bg-red-200 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        Remove from Favs
                                    </button>
                                    
                                    @if(!$flag)
                                        <button wire:click.debounce.500ms="AddPlanner({{ $fav->recipe_id }})" 
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-md hover:bg-blue-200 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                            </svg>
                                            Add to Planner
                                        </button>
                                    @else
                                        <button wire:click.debounce.500ms="RemovePlanner({{ $currentPlannerEntry->planner_id }})" 
                                                class="inline-flex items-center px-3 py-1.5 bg-orange-100 text-orange-700 text-xs font-medium rounded-md hover:bg-orange-200 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            Remove from Planner
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach($favourites as $fav)
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <div class="flex items-start space-x-4">
                        <a href="{{ route('recipe', ['id' => $fav->id, 'slug' => $fav->slug]) }}" class="flex-shrink-0">
                            <img class="w-20 h-16 object-cover rounded-lg border border-gray-200" 
                                 src="{{ asset('storage/' . $fav->image) }}" 
                                 alt="{{ $fav->title }}"
                                 onerror="this.src='{{ asset('images/placeholder-recipe.jpg') }}'">
                        </a>
                        
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-medium text-gray-900 truncate">
                                <a href="{{ route('recipe', ['id' => $fav->id, 'slug' => $fav->slug]) }}" 
                                   class="hover:text-blue-600 transition-colors">
                                    {{ $fav->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $fav->description }}</p>
                            
                            @php $flag = false; $flag1 = false; $currentPlannerEntry = null; @endphp
                            @foreach($plannerEntries as $plannerEntry)
                                @if($fav->recipe_id == $plannerEntry->recipe_id)
                                    @php $flag1 = true; $currentPlannerEntry = $plannerEntry; @endphp
                                    @php $flag = true @endphp
                                @endif
                            @endforeach
                            
                            <div class="mt-3 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                <div class="flex items-center space-x-2">
                                    @if($flag)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            In Planner
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex flex-col xs:flex-row items-stretch xs:items-center space-y-2 xs:space-y-0 xs:space-x-2">
                                    <button wire:click.debounce.500ms="destroy({{ $fav->fav_id }})" 
                                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-xs font-medium rounded-md hover:bg-red-200 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        Remove from Favs
                                    </button>
                                    
                                    @if(!$flag)
                                        <button wire:click.debounce.500ms="AddPlanner({{ $fav->recipe_id }})" 
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-md hover:bg-blue-200 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                            </svg>
                                            Add to Planner
                                        </button>
                                    @else
                                        <button wire:click.debounce.500ms="RemovePlanner({{ $currentPlannerEntry->planner_id }})" 
                                                class="inline-flex items-center px-3 py-1.5 bg-orange-100 text-orange-700 text-xs font-medium rounded-md hover:bg-orange-200 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            Remove from Planner
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6 bg-white rounded-lg shadow-sm p-4">
            {{ $favourites->links() }}
        </div>
    @endif
</div>
