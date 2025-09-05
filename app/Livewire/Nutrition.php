<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RecipeIngredients;
use App\Models\Ingredient;
use App\Models\IngredientNutrition;

class Nutrition extends Component
{
    public $recipeId;
    public $ingredients;
    public $nutritionList = [];

    public function render()
    {
        
        $ingredients = RecipeIngredients::where('recipeid', $this->recipeId)->limit(1)->get();
 
        $temp = ($ingredients[0]->ingredients);
        $to_remove = array('');
        $this->ingredients = array_unique(array_diff($temp, $to_remove));

        return view('livewire.nutrition',(['ingredients' => $this->ingredients]));
    }

    public function getNutrition($ingredient)
    {
        $ingredient = Ingredient::where('title', 'like', '%' . ucfirst($ingredient) . '%')->limit(1)->get();

	if(!$ingredient->isEmpty())
	{
        $temp = IngredientNutrition::where('ingredient',$ingredient[0]->id)->get();

        if(isset($temp[0]))
        {
            $temp = (json_decode($temp[0]->nutrition));
            $this->nutritionList[0] = $temp->FAT;
            $this->nutritionList[1] = $temp->FIBTG;
            $this->nutritionList[2] = $temp->CHOCDF;
            $this->nutritionList[3] = $temp->PROCNT;
            $this->nutritionList[4] = $temp->ENERC_KCAL;
        }
        else
        {
                $this->nutritionList[0] = "none";
            }
        }
        else
        {$this->nutritionList[0] = "none";}

    }
}
