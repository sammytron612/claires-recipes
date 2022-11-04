<div>
    <h2 class="mt-5">Some of our Favourites</h2>
    
    <div class="row mt-5">
        <div class="mt-2 row row row-cols-1 row-cols-sm-2 row-cols-md-3 justify-content-center">
            @foreach($seasonal as $recipe)
            <div class="col d-flex justify-content-center align-items-stretch">
            <div class="p-1 m-1 mb-5 w-75 w-sm-100 shadow card">
                <a href="{{ route('recipe', ['id'=>$recipe->recipe_id, 'slug'=> $recipe->recipe->slug]) }}" data-toggle="popover" data-placement="right"
                    title="{{ $recipe->recipe->description }}" class="stretched-link">
                    <div class="">
                        <img class="card-img-top" src="{{ asset('storage/' . $recipe->recipe->image) }}" alt="Card image cap">
                    </div>
                </a>
                <div class="card-body h-auto">
                    <h5 class="weight700 text-teal">{{ $recipe->recipe->title }}
                        @auth
                            @foreach($recipe->recipe->favourite as $fav)
                                @if($recipe->recipe_id == $fav->recipe_id)<span><i class="text-danger fa far fa-heart"></i></span>@endif
                            @endforeach
                        @endauth
                    <x-rating-system rating="{{ $recipe->recipe->rating }}"></x-rating-system>
                    <small class="weight700 text-dark-teal">By {{ $recipe->recipe->user->name }}</small>
                </div>
                <div class="d-flex align-items-center p-2">
                    @if($recipe->recipe->cooking_time)
                        <i class="text-primary fa fa-clock"></i><span class="weight700">&nbsp{{ $recipe->recipe->cooking_time }}&nbspmins</span>
                    @endif

                    @if(count($recipe->recipe->commentRecipe))

                        <div class="weight700 ml-auto text-teal">{{ count($recipe->recipe->commentRecipe) }}&nbspReviews</div>
                    @else
                        <div class="weight700 ml-auto text-teal">No Reviews</div>
                    @endif
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
