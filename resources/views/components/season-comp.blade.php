<div>
    <h2 class="mt-5">Some of our Favourites</h2>
    
    <div class="mt-5">
        <div class="mt-2 flex flex-wrap justify-center gap-4">
            @foreach($seasonal as $recipe)
                <div class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-xs relative 
                            md:w-[calc(50%-0.5rem)] lg:w-[calc(33.333%-0.67rem)]">
                    <a href="{{ route('recipe', ['id'=>$recipe->recipe_id, 'slug'=> $recipe->recipe->slug]) }}" 
                       class="absolute inset-0 z-10" aria-label="{{$recipe->recipe->title}}">
                    </a>
                    <div>
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $recipe->recipe->image) }}" alt="{{$recipe->recipe->title}}">
                    </div>
                    <div class="p-4">
                        <h5 class="font-bold text-teal-600 mb-2">{{ $recipe->recipe->title }}
                            @auth
                                @foreach($recipe->recipe->favourite as $fav)
                                    @if($recipe->recipe_id == $fav->recipe_id)<span><i class="text-red-500 fa far fa-heart"></i></span>@endif
                                @endforeach
                            @endauth
                        </h5>
                        <x-rating-system rating="{{ $recipe->recipe->rating }}"></x-rating-system>
                        <small class="font-bold text-teal-800 block mt-1">By {{ $recipe->recipe->user->name }}</small>
                    </div>
                    <div class="flex items-center justify-between p-4 pt-0">
                        @if($recipe->recipe->cooking_time)
                            <div class="flex items-center">
                                <i class="text-blue-500 fa fa-clock"></i>
                                <span class="font-bold ml-1">{{ $recipe->recipe->cooking_time }} mins</span>
                            </div>
                        @else
                            <div></div>
                        @endif

                        @if(count($recipe->recipe->commentRecipe))
                            <div class="font-bold text-teal-600">{{ count($recipe->recipe->commentRecipe) }} Reviews</div>
                        @else
                            <div class="font-bold text-teal-600">No Reviews</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
