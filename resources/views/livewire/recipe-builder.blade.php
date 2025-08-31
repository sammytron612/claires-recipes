<div>
    <div class="flex flex-col md:flex-row items-center py-2 gap-4 px-8 md:px-16">
        <div class="w-full md:w-2/12">
        </div>
        <div class="w-full relative">
            <label class="block font-bold text-lg text-orange-500 mb-2" for="search">find an ingredient:</label>
            <div class="relative">
                <input 
                    oninput="search(this.value)" 
                    type="search" 
                    class="w-full md:w-3/4 px-4 py-2 border border-gray-300 rounded-l-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    id="search"
                    placeholder="Search ingredients..."
                >
                <div class="hidden md:block absolute inset-y-0 right-0 md:right-1/4">
                    <span class="flex items-center justify-center px-3 bg-gray-100 border border-l-0 border-gray-300 rounded-r-md">
                        <i class="fa fa-search text-gray-500"></i>
                    </span>
                </div>
            </div>
            <div x-cloak x-data="{ visible : @entangle('isVisible').defer }">
                <div 
                    id="dropdown" 
                    x-show="visible" 
                    class="absolute z-50 top-full mt-2 bg-white border border-gray-200 rounded-md shadow-lg p-2 w-full md:w-3/4"
                >
                    @if($wireIngredients)
                        <div class="italic text-left text-orange-500 font-medium mb-2">Ingredients</div>
                        <ul class="space-y-1 text-left">
                            @foreach($wireIngredients as $wireIngredient)
                            <li>
                                <button 
                                    wire:click="addIngredient({{ $wireIngredient }})" 
                                    class="flex items-center w-full p-2 hover:bg-gray-50 rounded-md transition-colors text-left"
                                >
                                    <img 
                                        style="height:80px;width:80px;object-fit:cover" 
                                        class="rounded border" 
                                        src="{{ asset('storage/' . $wireIngredient->image) }}" 
                                        alt="{{ $wireIngredient->title }}"
                                    >
                                    <span class="ml-2 flex-1 truncate max-w-[260px]">{{ $wireIngredient->title }}</span>
                                </button>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div style="min-height:55vh" class="max-w-7xl mx-auto bg-white pb-5 py-2">
        @if($ingredients)
        <div class="flex justify-center mt-3">
            <div class="border-t border-b border-gray-300 text-gray-600 py-3 px-5">
                <div class="flex flex-wrap justify-center gap-2">
                    @foreach($ingredients as $ingredient)
                        <button 
                            wire:click="removeIngredient({{ $ingredient['id'] }})" 
                            class="inline-flex items-center px-4 py-2 bg-white border border-teal-600 text-teal-600 rounded-full hover:bg-teal-50 transition-colors"
                        >
                            {{ $ingredient['title'] }}
                            <i class="ml-2 text-red-500 fas fa-times"></i>
                        </button>
                    @endforeach

                    <div wire:loading.inline wire:target="addIngredient" class="flex items-center">
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500"></div>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="py-2" x-data="{ visible : @entangle('isVisible').defer }">
                <div x-show="!visible" class="text-center">
                    <h4 class="text-xl font-semibold text-teal-600 mb-2">Search the ingredients you have, and we do the rest</h4>
                    <h5 class="text-lg text-teal-500">Bon apetit....</h5>
                </div>
            </div>
        @endif


        @isset($recipes)
        @if(count($ingredients) > 1 && (count($recipes) == 0))
        <div class="flex items-center justify-center mt-2 min-h-32 gap-4">
            <h3 class="text-xl font-semibold text-gray-600">Looks like we have nothing to matches that combination</h3>
        </div>
        @else
        <div wire:loading.inline wire:target="render" class="text-center">
            <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-teal-500 transition ease-in-out duration-150">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Loading...
            </div>
        </div>
        <div class="mt-3 pb-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 justify-items-center px-5 md:px-24">
        @if($recipes)

                @foreach($recipes as $recipe)

                <div class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-xs relative flex flex-col">
                    <a href="{{ route('recipe',['id'=>$recipe->recipes->id, 'slug'=>$recipe->recipes->slug]) }}" 
                       class="absolute inset-0 z-10" aria-label="{{ $recipe->recipes->title }}">
                    </a>
                    <div>
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $recipe->recipes->image) }}" alt="{{$recipe->recipes->title}}">
                    </div>

                    <div class="p-4 flex-grow">
                        <h5 class="font-bold text-teal-600 mb-2">{{ $recipe->recipes->title }}
                                @auth
                                    @foreach($recipe->recipes->User->favourite as $fav)
                                        @if ($fav->recipe_id == $recipe->id)
                                            <span><i class="text-red-500 fa far fa-heart"></i></span>
                                        @endif
                                    @endforeach
                                @endauth
                        </h5>

                        <x-rating-system rating="{{ $recipe->rating }}"></x-rating-system>
                        <small class="font-bold text-teal-800 block mt-1">By {{ $recipe->recipes->user->name }}</small>
                    </div>
                    <div class="flex items-center justify-between p-4 pt-0">
                        @if($recipe->recipes->cooking_time)
                            <div class="flex items-center">
                                <i class="text-blue-500 fa fa-clock"></i>
                                <span class="font-bold ml-1">{{ $recipe->recipes->cooking_time }} mins</span>
                            </div>
                        @else
                            <div></div>
                        @endif

                        @if($recipe->recipes->commentRecipe)
                            <div class="text-teal-600 font-bold">
                               @if(count($recipe->recipes->commentRecipe) == 1)
                                    <span>1 comment</span>
                               @elseif(count($recipe->recipes->commentRecipe) > 1)
                                    <span>{{ count($recipe->recipes->commentRecipe) }} comments</span>
                                @else
                                    <span>No comments</span>
                               @endif
                            </div>
                        @else
                            <div class="font-bold text-teal-600">No Reviews</div>
                        @endif
                    </div>
                </div>
                @endforeach
        @endif
        @endif
	</div>
        @if(count($recipes) >= 20)
            <div class="text-center mt-2">
                <button wire:click="viewMore" class="px-8 py-3 w-full md:w-auto bg-teal-500 hover:bg-teal-600 text-white font-bold rounded transition-colors">View more</button>
            </div>
        @endif
        @endisset($recipes)



    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    
    Livewire.on('clearSearch', () => {
        $('#search').val('');
    
    })
        });
        function search(searchTerm)
        {
            if(searchTerm.length > 2)
           {
               @this.set('searchTerm', searchTerm);
            }
            else {
                //alert("kl")
                $('#dropdown').hide();
            }
        }
    
    
    </script>

</div>

