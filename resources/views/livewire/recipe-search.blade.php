<div class="relative text-center">
    <div class="flex flex-col md:flex-row items-center gap-2">
        <label class="font-bold text-lg text-orange-500" for="search">find a recipe:</label>
        <div class="relative w-full md:w-auto">
            <input 
                oninput="search(this.value)" 
                type="search" 
                class="w-full md:w-96 px-4 py-2 border border-gray-300 rounded-l-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                id="search"
                placeholder="Search recipes..."
            >
            <div class="hidden md:block absolute inset-y-0 right-0">
                <span class="flex items-center justify-center px-3 bg-gray-100 border border-l-0 border-gray-300 rounded-r-md">
                    <i class="fa fa-search text-gray-500"></i>
                </span>
            </div>
        </div>
    </div>
    
    <div x-cloak x-data="{ visible : @entangle('isVisible').defer }">
        <div 
            id="dropdown" 
            x-show="visible" 
            class="absolute z-50 left-0 md:left-auto md:right-0 top-full mt-2 min-w-full md:min-w-[430px] bg-white border border-gray-200 rounded-md shadow-lg p-2"
        >
            @if(count($WireRecipes) > 0)
                <div class="italic text-left text-orange-500 font-medium mb-2">In recipes</div>
                <ul class="space-y-1 text-left">
                    @foreach($WireRecipes as $WireRecipe)
                    <li>
                        <a class="flex items-center p-2 hover:bg-gray-50 rounded-md transition-colors" 
                           href="{{ route('recipe',['id'=> $WireRecipe->id, 'slug'=>$WireRecipe->slug]) }}">
                            <img style="height:50px" class="w-12 h-12 object-cover rounded" src="{{ asset('storage/' . $WireRecipe->image) }}" alt="{{ $WireRecipe->title }}">
                            <span class="ml-2 flex-1 truncate max-w-[260px]">{{ $WireRecipe->title }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            @endif

            @if(count($WireCuisines) > 0)
                <div class="italic text-left text-orange-500 font-medium mb-2 mt-4">In cuisines</div>
                <ul class="space-y-1 text-left">
                    @foreach($WireCuisines as $WireCuisine)
                    <li>
                        <a class="flex items-center p-2 hover:bg-gray-50 rounded-md transition-colors" 
                           href="{{ route('cuisine',$WireCuisine->slug) }}">
                            <img style="height:50px" class="w-12 h-12 object-cover rounded" src="{{ asset('storage/' . $WireCuisine->image) }}" alt="{{ $WireCuisine->title }}">
                            <span class="ml-2 flex-1 truncate max-w-[260px]">{{ $WireCuisine->title }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            @endif

            @if(count($WireIngredients) > 0)
                <div class="italic text-left text-orange-500 font-medium mb-2 mt-4">In ingredients</div>
                <ul class="space-y-1 text-left">
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
</div>

