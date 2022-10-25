<div class="position-relative text-center form-inline">
        <label style="font-weight: 700" class="h4 text-orange mr-1" for="search">find a recipe:</label>
        <input oninput="search(this.value)" type="search" class="w-100 w-md-50 form-control" id="search">
        <div class="d-none d-md-block input-group-append">
            <span class="input-group-text"><i class="py-1 fa fa-search"></i></span>
        </div>
        <div x-cloak x-data="{ visible : @entangle('isVisible').defer }">
            <div id="dropdown" x-show="visible" style="z-index:99; left:-25px; top:72px; min-width:430px;" class="bg-white w-100 border border-secondry p-2 position-absolute w-100">
                @if(count($WireRecipes) > 0)
                    <div class="font-italic text-left text-orange">In recipes</div>
                    <ul class="list-unstyled text-left list-group list-group-flush">
                        @foreach($WireRecipes as $WireRecipe)
                        <li><a class="btn text-left" href="{{ route('recipe',$WireRecipe->slug) }}"><img style="height:50px" class="img-thumbnail thumbnail" src="{{ asset('storage/' . $WireRecipe->image) }}" ><span style="width: 260px;" class="d-inline-block text-truncate ml-2">{{ $WireRecipe->title }} </span></a>
                        </li>
                        @endforeach
                    </ul>
                @endif

                @if(count($WireCuisines) > 0)
                    <div class="font-italic text-left text-orange">In cuisines</div>
                    <ul class="list-unstyled text-left">
                        @foreach($WireCuisines as $WireCuisine)
                        <li><a class="btn text-left" href="{{ route('cuisine',$WireCuisine->slug) }}"><img style="height:50px" class="img-thumbnail thumbnail" src="{{ asset('storage/' . $WireCuisine->image) }}" ><span span style="width: 260px;" class="d-inline-block text-truncate ml-2">{{ $WireCuisine->title }}</span></a></li>
                        @endforeach
                    </ul>
                @endif

                @if(count($WireIngredients) > 0)
                    <div class="font-italic text-left text-orange">In ingrdients</div>
                    <ul class="list-unstyled text-left">
                        @foreach($WireIngredients as $WireIngredient)
                        <li><a class="btn text-left" href="{{ route('ingredient',$WireIngredient->slug) }}"><img style="height:50px" class="img-thumbnail thumbnail" src="{{ asset('storage/'. $WireIngredient->image) }}" ><span span style="width: 260px;" class="d-inline-block text-truncate ml-2">{{ $WireIngredient->title }}</span></a></li>
                        @endforeach
                    </ul>
                @endif

                @if(count($WireCourses) > 0)
                    <div class="font-italic text-left text-orange">In coursess</div>
                    <ul class="list-unstyled text-left">
                        @foreach($WireCourses as $WireCourse)
                        <li><a class="btn text-left" href="{{ route('course',$WireCourse->slug) }}"><img style="height:50px"class="img-thumbnail thumbnail" src="{{ asset('storage/'. $WireCourse->image) }}" ><span span style="width: 260px;" class="d-inline-block text-truncate ml-2">{{ $WireCourse->title }}</span></a></li>
                        @endforeach
                    </ul>
                @endif

                @if(count($WireMethods) > 0)
                    <div class="font-italic text-left text-orange">In methods</div>
                    <ul class="list-unstyled text-left">
                        @foreach($WireMethods as $WireMethod)
                        <li><a class="btn text-left" href="{{ route('method',$WireMethod->slug) }}"><img style="height:50px" class="img-thumbnail thumbnail" src="{{ asset('storage/'. $WireMethod->image) }}" ><span style="width: 260px;" class="d-inline-block text-truncate ml-2">{{ $WireMethod->title }}</span></a></li>
                        @endforeach
                    </ul>
                @endif

                @if(count($WireDiets) > 0)
                    <div class="font-italic text-left text-orange">In diets</div>
                    <ul class="list-unstyled text-left">
                        @foreach($WireDiets as $WireDiet)
                        <li><a class="btn text-left" href="{{ route('diet',$WireDiet->slug) }}"><img style="height:50px" class="img-thumbnail thumbnail" src="{{ asset('storage/'. $WireDiet->image) }}" ><span style="width: 260px;" class="d-inline-block text-truncate ml-2">{{ $WireDiet->title }}</span></a></li>
                        @endforeach
                    </ul>
                @endif
                <hr>
                @if(count($WireRecipes) > 4)
                    <div class="text-center"><a href="{{ url('home/recipe/search/' . $searchTerm . '/views') }}"><h5>Show all</h5></a></div>
                @endif
            </div>
        </div>
</div>
<script>
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
