<div class="mt-2">
    <div class="text-center">
        <h2 class="text-2xl font-bold">{{ Auth::user()->name }}</h2>
        @can('isAdmin')<h2 class="text-lg text-gray-600">Role: {{ Auth::user()->role }}</h2>@endcan
    </div>
    
    @if (!$errors->any())
        @if ($avatar)
            <div class="text-center mt-4">
                <label class="font-bold block mb-2">Avatar Preview:</label>
                <div wire:loading wire:target="photo" class="text-blue-500">Uploading...</div>
                <img 
                    style="object-fit: cover; max-height:300px;" 
                    class="w-3/4 md:w-1/4 border border-gray-800 rounded-lg mx-auto" 
                    src="{{ $avatar->temporaryUrl() }}"
                    alt="Avatar Preview"
                >
            </div>
        @endif
    @endif

    @if(Auth::user()->avatar && !$uploaded)
    <div class="text-center mt-4">
        <label class="font-bold block mb-2">Avatar</label>
        <img 
            class="w-3/4 md:w-1/4 border border-gray-800 rounded-lg mx-auto" 
            src="{{ asset('storage/' . Auth::user()->avatar) }}"
            alt="Current Avatar"
        >
    </div>
    @else
    <div class="text-center mt-4">
        <label class="font-bold block mb-2">Avatar</label>
        <img 
            class="w-3/4 md:w-1/4 border border-gray-800 rounded-lg mx-auto" 
            src="{{ asset('storage/stock.jpg') }}"
            alt="Default Avatar"
        >
    </div>
    @endif
    
    <div class="w-full max-w-md mx-auto mt-4 mb-5">
        <label class="font-bold block mb-2">Image upload</label>
        <div class="space-y-2">
            <input 
                wire:model.defer="avatar" 
                name="avatar" 
                type="file" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('avatar') border-red-500 @enderror"  
                id="avatar"
                accept="image/*"
            >
            @error('avatar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <button 
                wire:click="uploadAvatar({{ Auth::user()->id }})" 
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors"
            >
                Upload
            </button>
        </div>
    </div>
    
    <div class="mt-8 flex justify-center">
        <button 
            onclick="confirm('Are you sure you want to delete your profile?') || event.stopImmediatePropagation()" 
            wire:click="destroy" 
            class="w-full max-w-md bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition-colors"
        >
            Delete my profile
        </button>
    </div>
</div>


