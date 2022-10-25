<?php

namespace App\Http\Helpers;
use App\Models\HashIngredient;
use App\Models\HashCuisine;
use App\Models\HashDiet;
use App\Models\HashCourse;
use App\Models\HashMethod;
use App\Models\Recipe;
use App\Models\IngredientList;
use App\Models\Ingredient;

class SimilarRecipe
{

    public $array = null;

    private function total($recipes)
    {
        foreach($recipes as $recipe)
        {
            $this->array[] = $recipe->recipe_id;
        }
    }

    public function similar($hashIngredients,$hashDiets,$hashMethods,$hashCuisines,$hashCourses, $id)
    {


        $ingredients = $hashIngredients->pluck('ingredient');
        $cuisines = $hashCuisines->pluck('cuisine');
        $courses = $hashCourses->pluck('course');
        $diets = $hashDiets->pluck('diet');
        $methods = $hashMethods->pluck('ingredient');

        $courseMatch1 = HashCourse::select('recipe_id')->whereIn('course', $courses)
                            ->where('recipe_id', '<>', $id)
                            ->get();

        if($courseMatch1->isNotEmpty())
        {
            $matchIngAndCourse = HashIngredient::select('recipe_id')
                                ->whereIn('ingredient', $ingredients)
                                ->whereIn('recipe_id', ($courseMatch1->pluck('recipe_id')))
                                ->where('recipe_id', '<>', $id)
                                ->groupBy('recipe_id')
                                ->havingRaw('count(*) >= 1')
                                ->get();


        }

        $cuisineMatch1 = HashCuisine::select('recipe_id')->whereIn('cuisine', $cuisines)
                            ->where('recipe_id', '<>', $id)
                            ->get();


        if($cuisineMatch1->isNotEmpty())
            {
                $matchIngAndCuisine = HashIngredient::select('recipe_id')
                                //->whereIn('ingredient', $ingredients)
                                ->whereIn('recipe_id', ($cuisineMatch1->pluck('recipe_id')))
                                ->where('recipe_id', '<>', $id)
                                ->groupBy('recipe_id')
                                ->havingRaw('count(*) >= 1')
                                ->get();
            }


        $dietMatch1 = HashDiet::select('recipe_id')->whereIn('diet', $diets)
                            ->where('recipe_id', '<>', $id)
                            ->get();

        if($dietMatch1->isNotEmpty())
            {
                $matchIngAndDiet = HashIngredient::select('recipe_id')
                                ->whereIn('ingredient', $ingredients)
                                ->whereIn('recipe_id', ($dietMatch1->pluck('recipe_id')))
                                ->where('recipe_id', '<>', $id)
                                ->groupBy('recipe_id')
                                ->havingRaw('count(*) >= 1')
                                ->get();
            }

        $methodMatch1 = HashMethod::select('recipe_id')->whereIn('method', $methods)
                            ->where('recipe_id', '<>', $id)
                            ->get();

        if($methodMatch1->isNotEmpty())
            {
                $matchIngAndDiet = HashIngredient::select('recipe_id')
                            ->whereIn('ingredient', $ingredients)
                            ->whereIn('recipe_id', ($methodMatch1->pluck('recipe_id')))
                            ->where('recipe_id', '<>', $id)
                            ->groupBy('recipe_id')
                            ->havingRaw('count(*) >= 1')
                            ->get();
            }



        $ingredientMatch1 = HashIngredient::select('recipe_id')->whereIn('ingredient', $ingredients)
            ->where('recipe_id', '<>', $id)
            ->groupBy('recipe_id')
            ->havingRaw('count(*) >= 1')
            ->get();
/*
        $ingredientMatch2 = collect();
        foreach($ingredients as $ingredient)
            {
                $ing = Ingredient::find($ingredient);
                $title = strtolower($ing->title);


                $ingredientMatch = IngredientList::select('recipe_id')->where('list', 'like' , '%' . $title . '%')
                ->where('recipe_id', '<>', $id)
                ->groupBy('recipe_id')
                ->havingRaw('count(*) >= 1')
                ->get();

                if(count($ingredientMatch))
                {
                    $ingredientMatch2->push($ingredientMatch);
                }

            }

*/
        if(isset($matchIngAndCourse))
        {
            $this->total($matchIngAndCourse);
        }
        else
        {
            $this->total($courseMatch1);
        }

        if(isset($matchIngAndCuisine))
        {
            $this->total($matchIngAndCuisine);
        }
        else
        {
            $this->total($courseMatch1);
        }

        if(isset($matchIngAndDiet))
        {
            $this->total($matchIngAndDiet);
        }
        else
        {
            $this->total($dietMatch1);
        }

        if(isset($matchIngAndMethod))
        {
            $this->total($methodMatch1);
        }
        else
        {
            $this->total($courseMatch1);
        }


        $this->total($ingredientMatch1);
/*
	foreach($ingredientMatch2 as $ingredients)
	{
	  $this->total($ingredients);
	}

*/


        if($this->array == null)
        {
            $recipes = Recipe::select('id')
            ->inRandomOrder()
            ->limit(4)
            ->get();
        }
        else
        {
            $new = array_count_values($this->array);
            asort($new);
            $new1 = array_reverse($new, true);
            while($element = current($new1)) {
                $recipes[] =  key($new1);
                next($new1);
            }
            $recipes = array_slice($recipes, 0, 4);
        }


        ;

        return $recipes;
    }
}
