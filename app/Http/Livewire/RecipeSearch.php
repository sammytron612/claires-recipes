<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Method;
use App\Models\Diet;
use App\Models\Course;
use App\Models\Cuisine;;


class RecipeSearch extends Component
{

    public $searchTerm;
    public $isVisible = false;
    protected $WireRecipes;
    public $WireCuisines;
    public $WireIngredients;
    public $WireMethods;
    public $WireDiets;
    public $WireCourses;
    public $count;


    public function render()
    {


        if ($this->searchTerm != '')
        {
        $searchTerm = '%' . $this->searchTerm . '%';
        $searchTerm1 = $this->searchTerm;
        }
        else
        {
            $searchTerm = 'NULL';
            $searchTerm1 = 'NULL';
            $this->isVisible = false;
        }


        $this->WireRecipes = Recipe::search($searchTerm1)->paginate(5);
        $this->WireCuisines = Cuisine::where('title', 'like', $searchTerm)->limit(2)->get();
        $this->WireIngredients = Ingredient::where('title', 'like', $searchTerm)->limit(4)->get();
        $this->WireDiets = Diet::where('title', 'like', $searchTerm)->limit(2)->get();
        $this->WireCourses = Course::where('title', 'like', $searchTerm)->limit(2)->get();

        $this->WireMethods = Method::where('title', 'like', $searchTerm)->limit(2)->get();

        if($this->WireRecipes->isNotEmpty())
            {
                $this->isVisible = true;
            }
        elseif($this->WireCuisines->isNotEmpty())
            {
                $this->isVisible = true;
            }
        elseif($this->WireIngredients->isNotEmpty())
            {
                $this->isVisible = true;
            }
        elseif($this->WireDiets->isNotEmpty())
            {
                $this->isVisible = true;
            }
        elseif($this->WireCourses->isNotEmpty())
            {
                $this->isVisible = true;
            }
        elseif($this->WireMethods->isNotEmpty())
            {
                $this->isVisible = true;
            }
        else
            {
                $this->isVisible = false;
            }

        return view('livewire.recipe-search', (['WireRecipes' => $this->WireRecipes]));

    }

}
