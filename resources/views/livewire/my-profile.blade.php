<div class="max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-t-xl p-8 text-white">
        <div class="text-center">
            <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-white/20 flex items-center justify-center">
                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold mb-2">{{ Auth::user()->name }}</h1>
            @can('isAdmin')
                <div class="inline-flex items-center px-3 py-1 bg-teal-500 rounded-full text-sm font-medium">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/>
                    </svg>
                    {{ ucfirst(Auth::user()->role) }}
                </div>
            @endcan
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-b-xl shadow-lg p-8">
        <div class="grid md:grid-cols-2 gap-8">
            
            <!-- Avatar Section -->
            <div class="space-y-6">
                <div class="text-center">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                        </svg>
                        Profile Picture
                    </h2>
                    
                    <!-- Avatar Preview (when uploading) -->
                    @if (!$errors->any() && $avatar)
                        <div class="mb-4">
                            <div class="relative">
                                <div wire:loading wire:target="avatar" class="absolute inset-0 bg-white bg-opacity-75 rounded-xl flex items-center justify-center z-10">
                                    <div class="flex items-center space-x-2 text-teal-600">
                                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span class="font-medium">Uploading...</span>
                                    </div>
                                </div>
                                <img 
                                    class="w-48 h-48 object-cover rounded-xl border-4 border-teal-100 shadow-lg mx-auto"
                                    src="{{ $avatar->temporaryUrl() }}"
                                    alt="Avatar Preview"
                                >
                            </div>
                            <p class="text-sm text-gray-600 mt-2">Preview of your new profile picture</p>
                        </div>
                    @endif

                    <!-- Current Avatar -->
                    @if(!$avatar)
                        <div class="mb-6">
                            <img 
                                class="w-48 h-48 object-cover rounded-xl border-4 border-gray-200 shadow-lg mx-auto"
                                src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('storage/stock.jpg') }}"
                                alt="{{ Auth::user()->avatar ? 'Your Profile Picture' : 'Default Profile Picture' }}"
                            >
                            @if(!Auth::user()->avatar)
                                <p class="text-sm text-gray-500 mt-2">Using default profile picture</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Upload Section -->
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Update Profile Picture
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">
                                Choose Image
                            </label>
                            <input 
                                wire:model.defer="avatar" 
                                name="avatar" 
                                type="file" 
                                id="avatar"
                                accept="image/*"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors duration-200 @error('avatar') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            >
                            @error('avatar') 
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button 
                            wire:click="uploadAvatar({{ Auth::user()->id }})" 
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center space-x-2"
                            wire:loading.attr="disabled"
                            wire:target="uploadAvatar"
                        >
                            <span wire:loading.remove wire:target="uploadAvatar">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Upload New Picture
                            </span>
                            <span wire:loading wire:target="uploadAvatar" class="flex items-center">
                                <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Uploading...
                            </span>
                        </button>

                        <div class="text-xs text-gray-500 bg-blue-50 p-3 rounded-lg">
                            <p class="font-medium mb-1">📝 Image Requirements:</p>
                            <ul class="space-y-1">
                                <li>• Maximum file size: 2MB</li>
                                <li>• Supported formats: JPG, PNG, GIF</li>
                                <li>• Recommended: Square images (1:1 ratio)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-red-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"/>
                        </svg>
                        Danger Zone
                    </h3>
                    <p class="text-red-700 text-sm mb-4">
                        This action cannot be undone. This will permanently delete your account and remove all your data from our servers.
                    </p>
                    <button 
                        onclick="confirm('Are you sure you want to delete your profile? This action cannot be undone!') || event.stopImmediatePropagation()" 
                        wire:click="destroy" 
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center space-x-2 w-full"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span>Delete My Profile</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


