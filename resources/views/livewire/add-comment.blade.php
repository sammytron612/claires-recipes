<div x-data="{ 
    isVisible: false, 
    temp: 0, 
    rating: @entangle('rating')
}" class="mt-6 w-full max-w-2xl">
    <div id="starRating" class="flex items-center space-x-1 mb-4" x-show="isVisible">
        <span class="text-sm font-medium text-gray-700 mr-2">Rate this recipe:</span>
        <input class="hidden" :value="rating" type="number"/>
        <template x-for="item in [1,2,3,4,5]" :key="item">
            <span @mouseenter="temp = item"
                  @mouseleave="temp = rating"
                  @click="rating = item; console.log('Rating clicked:', item, 'Current rating:', rating)"
                  class="text-gray-300 cursor-pointer transition-colors duration-200 hover:scale-110 transform"
                  :class="{'text-yellow-400': (temp >= item || rating >= item)}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            </span>
        </template>
        <span class="text-sm text-gray-500 ml-2" x-show="rating > 0" x-text="`${rating} star${rating > 1 ? 's' : ''}`"></span>
    </div>

    <div x-on:show.window="isVisible = true"></div>
    <div x-on:hide-button.window="isVisible = false"></div>
    
    <div class="mt-4">
        <form wire:submit.prevent="StoreComment" class="space-y-4">
            <input type="hidden" wire:model="rating" :value="rating">
            <div class="relative">
                <textarea 
                    @click="$dispatch('show')" 
                    wire:model.defer="comment" 
                    id="MakeComment" 
                    class="w-full h-10 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent resize-none transition-all duration-200 ease-in-out" 
                    placeholder="Make a comment"
                    rows="1"></textarea>
            </div>
            
            <div x-show="isVisible" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                <button 
                    type="submit" 
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed">
                    <span wire:loading.remove>Submit Comment</span>
                    <span wire:loading class="flex items-center justify-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Submitting...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

