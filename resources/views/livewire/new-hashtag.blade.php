<div x-data="{ modal : false}">
    <div class="row row-cols-3 row-cols-md-5 justify-content-center">
        <button wire:click="$set('category', 'ingredient')" type="button" class="btn btn-lg btn-primary m-1" data-toggle="modal" data-target="#modal">New ingredient</button>
        <button wire:click="$set('category', 'cuisine')" type="button" class="btn btn-lg btn-orange m-1" data-toggle="modal" data-target="#modal">New cuisine</button>
        <button wire:click="$set('category', 'diet')" type="button" class="btn btn-lg btn-teal m-1" data-toggle="modal" data-target="#modal">New diet</button>
        <button wire:click="$set('category', 'course')" type="button" class="btn btn-lg btn-crimson m-1" data-toggle="modal" data-target="#modal">New course</button>
        <button wire:click="$set('category', 'method')" type="button" class="btn btn-lg btn-info m-1" data-toggle="modal" data-target="#modal">New method</button>
    </div>
    @livewire('category-table')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data"  wire:submit.prevent="storeHashtag">
                    <div class="modal-header">
                        <h5 id="title" class="weight900 modal-title">New&nbsp {{ $category }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-5">
                        @if ($image)
                            <label class="weight700">Preview:</label>
                            <div wire:loading wire:target="image">Uploading...</div>
                            <img style="height:100%; max-height:250px" class="border border-dark img-responsive w-100" src="{{ $image->temporaryUrl() }}">
                        @endif

                        <label class="weight700">Image</h5></label>
                        <div class="custom-file">
                            <input wire:model.defer="image" type="file" class="custom-file-input @error('image') border border-danger @enderror w-100"  id="photo">
                            <label class="custom-file-label" for="photo">Choose file</label>
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-2 form-group">
                            <label class="weight700" for="title">Title</label>
                            <input wire:model.defer="title" class="form-control @error('title') border border-danger @enderror w-100" type="text" id="title">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="weight700" for="desc">Description</label>
                            <textarea wire:model.defer="description" class="form-control @error('description') border border-danger @enderror w-100" rows="5" type="text" id="desc"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>


    document.addEventListener('DOMContentLoaded', function () {

Livewire.on('hideModal', () => {
    $('#modal').modal('hide');

})
    });

</script>
