<div class="mt-2">
    <div class="text-center">
        <h2>{{ Auth::user()->name }}</h2>
        @can('isAdmin')<h2>Role:{{ Auth::user()->role }}</h2>@endcan
    </div>
    @if (!$errors->any())
        @if ($avatar)
            <div class="text-center">
                <label class="weight700">Avatar Preview:</label>
                <br>
                <div wire:loading wire:target="photo">Uploading...</div>
                <img style="object-fit: cover; max-height:300px;" class="w-75 w-md-25 border border-dark img-responsive" src="{{ $avatar->temporaryUrl() }}">
            </div>
        @endif
    @endif

    @if(Auth::user()->avatar && !$uploaded)
    <div class="text-center">
        <label class="weight700">Avatar</label>
        <br>
        <img class="w-75 w-md-25 border border-dark img-responsive" src="{{ asset('storage/' . Auth::user()->avatar) }}">
    </div>
    @else
    <div class="text-center">
        <label class="weight700">Avatar</label>
        <br>
        <img class="w-75 w-md-25 border border-dark img-responsive" src="{{ asset('storage/stock.jpg') }}">
    </div>
    @endif
    <div class="w-50 mx-auto mt-2 mb-5">
        <label class="weight700">Image upload</label>
        <div class="custom-file">
            <input wire:model.defer:="avatar" name="avatar" type="file" class="custom-file-input @error('avatar') border border-danger @enderror w-100"  id="avatar">
            <label class="custom-file-label" for="photo">Choose file</label>
            @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
            <button wire:click="uploadAvatar({{ Auth::user()->id }})" class="mt-2 btn btn-primary float-right">Upload</button>
        </div>
    </div>
    <div class="mt-5 d-flex justify-content-center">
        <button onclick="confirm('Are you sure you want to delete your profile?') || event.stopImmediatePropagation()" wire:click="destroy" class="btn w-50 btn-danger">Delete my profile</button>
    </div>
</div>


