<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Method;
use App\Models\Diet;
use App\Models\Course;
use App\Models\Cuisine;
use App\Models\RecipeMethod;


class RecipeSearch extends Component
{

    public $searchTerm = '';
    public $isVisible = false;
    public $WireRecipes;
    public $WireCuisines;
    public $WireIngredients;
    public $WireMethods;
    public $WireDiets;
    public $WireCourses;

    public function updatedSearchTerm()
    {
        if (strlen($this->searchTerm) < 3) {
            $this->isVisible = false;
        }
    }


    public function render()
    {
        $this->WireRecipes = collect();
        $this->WireCuisines = collect();
        $this->WireIngredients = collect();
        $this->WireDiets = collect();
        $this->WireCourses = collect();
       

        if (strlen($this->searchTerm) >= 3) {
            $searchTerm = '%' . $this->searchTerm . '%';
            
            $this->WireRecipes = Recipe::with('recipeMethod')
                ->where(function($query) use ($searchTerm) {
                    $query->where('title', 'like', $searchTerm)
                          ->orWhereHas('recipeMethod', function($q) use ($searchTerm) {
                              $q->where('description', 'like', $searchTerm);
                          });
                })
                ->limit(5)
                ->get();
            $this->WireCuisines = Cuisine::where('title', 'like', $searchTerm)->limit(2)->get();
            $this->WireIngredients = Ingredient::where('title', 'like', $searchTerm)->limit(4)->get();
            $this->WireDiets = Diet::where('title', 'like', $searchTerm)->limit(2)->get();
            $this->WireCourses = Course::where('title', 'like', $searchTerm)->limit(2)->get();
          

            $this->isVisible = $this->WireRecipes->isNotEmpty() || 
                             $this->WireCuisines->isNotEmpty() || 
                             $this->WireIngredients->isNotEmpty() || 
                             $this->WireDiets->isNotEmpty() || 
                             $this->WireCourses->isNotEmpty();
        } else {
            $this->isVisible = false;
        }

        return view('livewire.recipe-search', [
            'WireRecipes' => $this->WireRecipes,
            'WireCuisines' => $this->WireCuisines,
            'WireIngredients' => $this->WireIngredients,
            'WireDiets' => $this->WireDiets,
            'WireCourses' => $this->WireCourses,
            'searchTerm' => $this->searchTerm,
        ]);
    }

}
