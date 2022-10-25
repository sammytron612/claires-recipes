<div>
    <div>
        <div class="form-group text-center mt-5">
            <label for="choice"><h5>Choice&nbsp</h5></label>
            <select wire:model="selection" class="custom-select w-25" name="" id="choice">
                <option value="null" selected>Select one</option>
                <option value="1">Ingredients</option>
                <option value="2">Cuisine</option>
                <option value="3">Diet</option>
                <option value="4">Course</option>
                <option value="5">Method</option>
            </select>
        </div>
     </div>

     <section x-cloak x-data="{ visible : @entangle('visible') }" class="mt-5">
         <div class="form-inline" x-show="visible">
            <label style="font-weight: 700" class="h4 text-orange mr-1" for="search">Search:</label>
            <input oninput="search(this.value)" type="search" class="w-100 w-md-25 form-control" id="search">
            <div class="d-none d-md-block input-group-append">
                <span class="input-group-text"><i class="py-1 fa fa-search"></i></span>
            </div>
         </div>
         @if($categories)
         <table class="table table-striped table-inverse table-responsive mt-2">
             <thead class="thead-inverse">
                 <tr>
                     <th>id</th>
                     <th class="w-50">Title</th>
                     <th class="w-50 text-truncate">Description</th>
                     <th class="">Action</th>
                 </tr>
                 </thead>
                 <tbody>

                        @foreach($categories as $category)
                            <tr>
                                <td class="align-middle">{{ $category->id }}</td>
                                <td class="align-middle weight700">{{ $category->title }}</td>
                                <td class="align-middle">{{ $category->description }}</td>
                                <td class="align-middle"><button wire:click="editHashtag({{ $category->id }})" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal">Edit</button></td>
                                <td class="align-middle"><button wire:click="destroyHashtag({{ $category->id }})" class="btn btn-sm btn-danger">Delete</button></td>
                            </tr>
                        @endforeach

                 </tbody>
        </table>
        <div class="mypagination">
            {{ $categories->links() }}
        </div>
        @endif
     </section>


     <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data"  wire:submit.prevent="updateHashtag">
                    <div class="modal-header">
                        <h5 id="title" class="weight900 modal-title">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-5">
                        @if ($updatedImage)
                            <label class="weight700">Preview:</label>
                            <div wire:loading wire:target="updatedImage">Uploading...</div>
                            <img style="height:100%; max-height:250px" class="border border-dark img-responsive w-100" src="{{ $updatedImage->temporaryUrl() }}">
                        @else
                            @if($editImage)
                                <img style="height:100%; max-height:250px" class="border border-dark img-responsive w-100" src="{{ asset('storage/' . $editImage ) }}">
                                <label class="weight700">Image</h5></label>
                            @endif
                        @endif
                        <div class="custom-file mt-2">
                            <input wire:model.defer="updatedImage" type="file" class="custom-file-input @error('updatedImage') border border-danger @enderror w-100"  id="editImage">
                            <label class="custom-file-label" for="photo">Choose file</label>
                            @error('updatedImage') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-2 form-group">
                            <label class="weight700" for="title">Title</label>
                            <input wire:model.defer="editTitle" class="form-control @error('title') border border-danger @enderror w-100" type="text" id="editTitle">
                            @error('editTitle') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="weight700" for="desc">Description</label>
                            <textarea wire:model.defer="editDescription" class="form-control @error('description') border border-danger @enderror w-100" rows="5" type="text" id="editDesc"></textarea>
                            @error('editDescription') <span class="text-danger">{{ $message }}</span> @enderror
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
function search(searchTerm)
     {
         if(searchTerm.length > 2)
        {
            @this.set('searchTerm', searchTerm)
        }
        else
        {
            searchTerm = ""
            @this.set('searchTerm',searchTerm)
        }
     }

document.addEventListener('DOMContentLoaded', function () {

Livewire.on('hideModalEdit', () => {
    $('#editModal').modal('hide')

})
    })

</script>
