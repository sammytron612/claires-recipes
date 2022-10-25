<div>
    <div class="form-inline">
        <label style="font-weight: 700" class="h4 text-orange mr-1" for="search">Search:</label>
        <input oninput="search(this.value)" type="search" class="w-100 w-md-25 form-control" id="search">
        <div class="d-none d-md-block input-group-append">
            <span class="input-group-text"><i class="py-1 fa fa-search"></i></span>
        </div>
     </div>
    <div class="mt-5 d-flex justify-content-center">
        <div class="w-100">
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th class="w-100">Title</th>
                        <th class="float-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recipes as $recipe)
                        <tr>
                            <td>{{ $recipe->title }}</td>
                            <td class="float-right">
                                <a href="{{ route('admin.recipe-edit', $recipe->id) }}" class="btn btn-info">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination">
        {{ $recipes->links() }}
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
</script>
