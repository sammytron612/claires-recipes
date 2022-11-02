<div class="bg-white row row-cols-1 row-cols-md-2 align-items-center py-2">
    <div class="d-flex justify-content-center col"><img style="height:170px" class="img-fluid" src="{{ asset('storage/claires-recipes.png') }}"></div>
    <div class="d-flex ml-2 ml-sm-0 justify-content-center col">@livewire('recipe-search')</div>
</div>
<div class="mt-3 row d-flex justify-content-center align-items-center">
        <div style="font-weight: 700;" class="mt-2 col-md-2 col-12 h4 text-orange text-center text-sm-center mr-2">Browse recipes:</div>
        <div style="width:120px; min-width:120px;" class="text-center mt-2 col-md-1 bg-white col-4 p-2 mr-2">
            <a class="stretched-link btn text-teal weight700 my-hover rounded-0" href="{{ route('category','special-diet' )}}">Diet</a>
        </div>

        <div style="width:120px; min-width:120px;" class="text-center mt-2 col-md-1 bg-white col-4 p-2 mr-2">
            <a class="stretched-link btn text-teal weight700 my-hover rounded-0" href="{{ route('category','ingredient' )}}">Ingredients</a>
        </div>
        <div style="width:120px; min-width:120px;" class="text-center mt-2 col-md-1 bg-white col-4 p-2 mr-2">
            <a class="stretched-link btn text-teal weight700 my-hover rounded-0" href="{{ route('category','course' )}}">Course</a>
        </div>
        <div style="width:120px; min-width:120px;" class="text-center mt-2 col-md-1 bg-white col-4 p-2 mr-2">
            <a class="stretched-link btn text-teal weight700 my-hover rounded-0" href="{{ route('category','cuisine' )}}">Cuisine</a>
        </div>
</div>

