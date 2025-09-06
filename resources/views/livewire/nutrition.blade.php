<div class="p-6" x-data="{shown: false}">
    @if($ingredients)
    <div class="mb-4">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"/>
            </svg>
            Nutritional Information
        </h3>
        <button 
            @click="shown = !shown" 
            class="flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200"
            aria-label="Toggle Nutrition Info"
        >
            <span x-show="!shown">Show Nutrition (per 100g)</span>
            <span x-show="shown">Hide Nutrition</span>
            <svg 
                class="w-4 h-4 transition-transform duration-200" 
                :class="{ 'rotate-180': shown }" 
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
    </div>

    <div 
        x-show="shown" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="space-y-3"
    >
        @foreach($ingredients as $ingredient)
            <div 
                class="bg-gray-50 hover:bg-gray-100 rounded-lg p-2 border border-gray-200 hover:border-gray-300 cursor-pointer transition-all duration-200 hover:shadow-md"
                x-data="{nutrition: false}"
                @click="$wire.getNutrition('{{ $ingredient }}'); nutrition = !nutrition"
            >
                <div class="flex items-center justify-between">
                    <h4 class="font-medium text-gray-800 capitalize">{{ $ingredient }}</h4>
                    <svg 
                        class="w-4 h-4 text-gray-500 transition-transform duration-200" 
                        :class="{ 'rotate-180': nutrition }" 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                
                <div 
                    x-show="nutrition" 
                    @click.away="nutrition = false"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="mt-4"
                >
                    @isset($nutritionList[0])
                        @if($nutritionList[0] !== "none")
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="flex items-center space-x-2 bg-white p-3 rounded border">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Fat</span>
                                    <p class="text-lg font-bold text-gray-800">{{ $nutritionList[0] }}g</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2 bg-white p-3 rounded border">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Fiber</span>
                                    <p class="text-lg font-bold text-gray-800">{{ $nutritionList[1] }}g</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2 bg-white p-3 rounded border">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Carbs</span>
                                    <p class="text-lg font-bold text-gray-800">{{ $nutritionList[2] }}g</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2 bg-white p-3 rounded border">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Protein</span>
                                    <p class="text-lg font-bold text-gray-800">{{ $nutritionList[3] }}g</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2 bg-white p-3 rounded border sm:col-span-2">
                                <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Calories</span>
                                    <p class="text-lg font-bold text-gray-800">{{ $nutritionList[4] }} kcal</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-yellow-800 font-medium">No nutritional information available for this ingredient</span>
                            </div>
                        </div>
                        @endif       
                    @endisset             
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>