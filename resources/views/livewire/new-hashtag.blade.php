<div x-data="{ modal : false}">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 justify-center max-w-4xl mx-auto">
        <button wire:click="setCategory('ingredient')" @click="modal = true" type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors text-center">New ingredient</button>
        <button wire:click="setCategory('cuisine')" @click="modal = true" type="button" class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-3 px-6 rounded-lg transition-colors text-center">New cuisine</button>
        <button wire:click="setCategory('diet')" @click="modal = true" type="button" class="bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 px-6 rounded-lg transition-colors text-center">New diet</button>
        <button wire:click="setCategory('course')" @click="modal = true" type="button" class="bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition-colors text-center">New course</button>
        <button wire:click="setCategory('method')" @click="modal = true" type="button" class="bg-cyan-600 hover:bg-cyan-700 text-white font-medium py-3 px-6 rounded-lg transition-colors text-center">New method</button>
    </div>

    
    <!-- Modal -->
    <div x-show="modal" x-transition.opacity.duration.300ms class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <!-- Backdrop -->
            <div x-show="modal" x-transition.opacity.duration.300ms @click="modal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>
            
            <!-- Modal Content -->
            <div x-show="modal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                <form enctype="multipart/form-data" wire:submit.prevent="storeHashtag">
                    <!-- Modal Header -->
                    <div class="bg-white px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">New {{ ucfirst($category ?? 'Category') }}</h3>
                            <button @click="modal = false; $wire.resetForm()" type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="bg-white px-6 py-6 space-y-4">
                        @if ($image)
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Preview:</label>
                                <div wire:loading wire:target="image" class="flex items-center text-blue-600 text-sm mb-2">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Uploading...
                                </div>
                                <img wire:loading.remove wire:target="image" class="w-full h-auto max-h-64 object-cover border border-gray-300 rounded-md" src="{{ $image->temporaryUrl() }}" alt="Preview">
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Image</label>
                            <input wire:model="image" type="file" accept="image/*" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror" id="photo">
                            @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" for="title">Title</label>
                            <input wire:model.live.debounce.300ms="title" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" type="text" id="title" placeholder="Enter category title...">
                            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" for="desc">Description</label>
                            <textarea wire:model.live.debounce.300ms="description" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror" rows="5" id="desc" placeholder="Enter category description..."></textarea>
                            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                        <button @click="modal = false; $wire.resetForm()" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-md transition-colors" wire:loading.attr="disabled">Close</button>
                        <button type="submit" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors disabled:opacity-50" wire:loading.attr="disabled" wire:target="storeHashtag">
                            <svg wire:loading wire:target="storeHashtag" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="storeHashtag">Save</span>
                            <span wire:loading wire:target="storeHashtag">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('hideModal', () => {
            // Close modal by setting Alpine data to false
            const component = document.querySelector('[x-data*="modal"]');
            if (component && component.__x) {
                component.__x.$data.modal = false;
            }
        });
    });
    </script>
</div>
