<div x-data="{ editModal: false }">
    <!-- Category Selection -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-center gap-4">
            <label for="choice" class="text-lg font-semibold text-gray-700">Choose Category:</label>
            <select wire:model.live="selection" class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white" name="" id="choice">
                <option value="">Select one</option>
                <option value="1">Ingredients</option>
                <option value="2">Cuisine</option>
                <option value="3">Diet</option>
                <option value="4">Course</option>
                <option value="5">Method</option>
            </select>
        </div>
    </div>


    <!-- Table Section -->
    <section class="mt-6">
        <!-- Loading indicator -->
        <div wire:loading class="flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <span class="ml-2 text-gray-600">Loading...</span>
        </div>

        <!-- Search Bar -->
        @if($visible)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6" wire:loading.remove>
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <label class="text-lg font-semibold text-orange-600" for="search">Search:</label>
                <div class="flex-1 max-w-md relative">
                    <input wire:model.live.debounce.300ms="searchTerm" type="search" class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="search" placeholder="Search categories...">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($categories && $categories->count() > 0 && $visible)
        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden" wire:loading.remove>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $category->title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 max-w-xs truncate">{{ $category->description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button wire:click="editHashtag({{ $category->id }})" class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors disabled:opacity-50" wire:loading.attr="disabled" wire:target="editHashtag({{ $category->id }})">
                                            <svg wire:loading.remove wire:target="editHashtag({{ $category->id }})" class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <svg wire:loading wire:target="editHashtag({{ $category->id }})" class="animate-spin w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button wire:click="destroyHashtag({{ $category->id }})" onclick="return confirm('Are you sure you want to delete this item?')" class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors disabled:opacity-50" wire:loading.attr="disabled" wire:target="destroyHashtag({{ $category->id }})">
                                            <svg wire:loading.remove wire:target="destroyHashtag({{ $category->id }})" class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            <svg wire:loading wire:target="destroyHashtag({{ $category->id }})" class="animate-spin w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No categories found</h3>
                                    <p class="mt-1 text-sm text-gray-500">No data available for this category type.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($categories && method_exists($categories, 'hasPages') && $categories->hasPages() && $visible)
            <div class="mt-6 flex justify-center">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 px-4 py-3">
                    {{ $categories->links() }}
                </div>
            </div>
        @endif
        @elseif($visible)
        <!-- Show when visible but no categories -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            <div class="text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No data found</h3>
                <p class="mt-1 text-sm text-gray-500">This category type appears to be empty.</p>
            </div>
        </div>
        @endif
    </section>

    <!-- Edit Modal -->
    @if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <!-- Backdrop -->
            <div wire:click="$set('showEditModal', false)" class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>
            
            <!-- Modal Content -->
            <div class="relative inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                <form enctype="multipart/form-data" wire:submit.prevent="updateHashtag">
                    <!-- Modal Header -->
                    <div class="bg-white px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Edit Category</h3>
                            <button wire:click="$set('showEditModal', false)" type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="bg-white px-6 py-6 space-y-4">
                        @if ($updatedImage)
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Preview:</label>
                                <div wire:loading wire:target="updatedImage" class="flex items-center text-blue-600 text-sm mb-2">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Uploading...
                                </div>
                                <img wire:loading.remove wire:target="updatedImage" class="w-full h-auto max-h-64 object-cover border border-gray-300 rounded-md" src="{{ $updatedImage->temporaryUrl() }}" alt="Preview">
                            </div>
                        @else
                            @if($editImage)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Current Image:</label>
                                    <img class="w-full h-auto max-h-64 object-cover border border-gray-300 rounded-md" src="{{ asset('storage/' . $editImage ) }}" alt="Current Image">
                                </div>
                            @endif
                        @endif
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Update Image</label>
                            <input wire:model.blur="updatedImage" type="file" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('updatedImage') border-red-500 @enderror" id="editImage">
                            @error('updatedImage') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" for="editTitle">Title</label>
                            <input wire:model.blur="editTitle" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('editTitle') border-red-500 @enderror" type="text" id="editTitle">
                            @error('editTitle') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" for="editDesc">Description</label>
                            <textarea wire:model.blur="editDescription" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('editDescription') border-red-500 @enderror" rows="5" id="editDesc"></textarea>
                            @error('editDescription') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                        <button wire:click="$set('showEditModal', false)" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-md transition-colors" wire:loading.attr="disabled">Close</button>
                        <button type="submit" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors disabled:opacity-50" wire:loading.attr="disabled" wire:target="updateHashtag">
                            <svg wire:loading wire:target="updateHashtag" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 718-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="updateHashtag">Save Changes</span>
                            <span wire:loading wire:target="updateHashtag">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
