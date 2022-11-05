<div x-data="{shown: false}">
    <h5>Nutritional Info(100g)&nbsp<button @click="shown = !shown" class="btn btn-small btn-teal" aria-label="Expand Nutrition Info">
        <i class="fas fa-plus"></i></i></button>
    </h5>
    <div x-cloak x-show="shown">
        <ul class="list-unstyled">
        @foreach($ingredients as $ingredient)
            <div x-data="{nutrition: false}">
                <li>{{ ucfirst($ingredient) }}&nbsp<button @click="$wire.getNutrition('{{ $ingredient }}'); nutrition = !nutrition" class="btn" aria-label="Expand"><i class="fas fa-plus"></i></i></button>
                    <div @click.away="nutrition = !nutrition" x-show="nutrition" class="">
			@isset($nutritionList[0])
                        @if($nutritionList[0] !== "none")
                        <ul class="list-unstyled">
                            <li><span class="text-teal">Fat</span> - {{ $nutritionList[0] }} &nbspGrams</li>
                            <li><span class="text-teal">Fibre</span> - {{ $nutritionList[1] }} &nbspGrams</li>
                            <li><span class="text-teal">Carbohydrate</span> - {{ $nutritionList[2] }} &nbspGrams</li>
                            <li><span class="text-teal">Protein</span> - {{ $nutritionList[3] }} &nbspGrams</li>
                            <li><span class="text-teal">Calories</span> - {{ $nutritionList[4] }}</li>
                        </ul>
                        @else
                            <span class="text-teal">No information available</span>
                        @endif       
			@endisset             
		     </div>
                </li>
            </div>
        @endforeach
        </ul>
    </div>
</div>