<div>
        <div class="row align-items-center py-2">

            <div class="col-12 col-md-2">
            </div>
            <div class="col position-relative">
                    <label style="font-weight: 700" class="h4 text-orange mr-1" for="search">find an ingredient:</label>
                    <div class="position-relative form-inline">
                        <input oninput="search(this.value)" type="search" class="w-100 w-md-75 form-control" id="search">
                        <div class="d-none d-md-block input-group-append">
                            <span class="input-group-text"><i class="py-1 fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="" x-cloak x-data="{ visible : @entangle('isVisible').defer }">
                        <div id="dropdown" x-show="visible" style="z-index:99;top:80px;" class="bg-white border border-secondry p-2 position-absolute">
                            @if($wireIngredients)
                                <div class="font-italic text-left text-orange">Ingredients</div>
                                <ul class="list-unstyled text-left list-group list-group-flush">
                                    @foreach($wireIngredients as $wireIngredient)
                                    <li><button wire:click="addIngredient({{ $wireIngredient }})" class="btn text-left"><img style="height:80px;width:80px;object-fit:cover" class="img-thumbnail" src="{{ asset('storage/' . $wireIngredient->image) }}" ><span style="width: 260px;" class="d-inline-block text-truncate ml-2">{{ $wireIngredient->title }} </span></button>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                            </div>
                    </div>
            </div>

        </div>



    <div style="min-height:55vh" class="container bg-white pb-5 py-2">
        @if($ingredients)
        <div class="d-flex justify-content-center mt-3">
            <div  class="border-top border-bottom text-secondary w-auto py-3 px-5">
                <div class="row justify-content-center">
                    @foreach($ingredients as $ingredient)
                        <button wire:click="removeIngredient({{ $ingredient['id'] }})" class="shake btn btn-outline-teal rounded-pill mx-1 my-1">{{ $ingredient['title'] }}
                        <i class="ml-2 text-danger fas fa-times"></i></i></button>
                    @endforeach


                    <div wire:loading.inline wire:target="addIngredient">
                        <div class="">
                            <div class="spinner-border" role="status"></div>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="py-2" x-data="{ visible : @entangle('isVisible').defer }">
                <div x-show="!visible">
                    <h4 class="text-center text-teal">Search the ingredients you have, and we do the rest</h4>
                    <h5 class="text-center text-teal">Bon apetit....</h5>
                </div>
            </div>
        @endif


        @isset($recipes)
        @if(count($ingredients) > 1 && (count($recipes) == 0))
        <div class="h-100 d-flex align-items-center mt-2 justify-content-center">
            <h3>Looks like we have nothing to matches that combination</h3>
        </div>
        @else
        <div wire:loading.inline wire:target="render">
            loading...
        </div>
        <div class="mt-3 pb-5 px-5 p-md-0 row row-cols-1 row-cols-md-3 row-cols-lg-4  justify-content-center">
        @if($recipes)

                <div wire:loading.table wire:target="render">
                    <div class="justify-content-center ml-50">
                        <div class="spinner-border" role="status"></div>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                @foreach($recipes as $recipe)

                <div class="p-1 d-flex align-items-stretch col card m-1 mb-5 shadow">
                    <a href="{{ route('recipe',['id'=>$recipe->recipes->id, 'slug'=>$recipe->recipess->slug]) }}" class="stretched-link">
                        <div class="">
                            <img class="card-img-top" src="{{ asset('storage/' . $recipe->recipes->image) }}" alt="Card image cap">
                        </div>
                    </a>

                    <div class="card-body">
                        <h5 class="weight700 text-teal">{{ $recipe->recipes->title }}&nbsp
                                @auth
                                    @foreach($recipe->recipes->User->favourite as $fav)
                                        @if ($fav->recipe_id == $recipe->id)
                                            <span><i class="text-danger fa far fa-heart"></i></span>
                                        @endif
                                    @endforeach
                                @endauth
                        </h5>

                        <x-rating-system rating="{{ $recipe->rating }}"></x-rating-system>
                        <small class="weight700 text-dark-teal">By {{ $recipe->recipes->user->name }}</small>
                    </div>
                    <div class="d-flex align-items-center p-2">
                        @if($recipe->recipes->cooking_time)
                            <i class="text-primary fa fa-clock"></i><span class="weight700">&nbsp{{ $recipe->recipes->cooking_time }}&nbspmins</span>
                        @endif

                        @if($recipe->recipes->commentRecipe)
                            <div class="ml-auto text-teal">
                               @if(count($recipe->recipes->commentRecipe) == 1)
                                    <span>1&nbspcomment</span>
                               @elseif(count($recipe->recipes->commentRecipe) > 1)
                                    <span>{{ count($recipe->recipes->commentRecipe) }}&nbspcomments</span>
                                @else
                                    <span>No comments</span>
                               @endif
                            </div>
                        @else
                            <div class="weight700 ml-auto text-teal">No Reviews</div>
                        @endif
                    </div>
                </div>
                @endforeach
        @endif
        @endif
	</div>
        @if(count($recipes) >= 20)
            <div class="text-center mt-2">
                <button wire:click="viewMore" class="px-5 col-12 w-100 w-md-25 btn btn-teal">View more</button>
            </div>
        @endif
        @endisset($recipes)



    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    
    Livewire.on('clearSearch', () => {
        $('#search').val('');
    
    })
        });
        function search(searchTerm)
        {
            if(searchTerm.length > 2)
           {
               @this.set('searchTerm', searchTerm);
            }
            else {
                //alert("kl")
                $('#dropdown').hide();
            }
        }
    
    
    </script>

</div>

