<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ingredient;
use App\Models\IngredientList;
use Livewire\WithPagination;




class RecipeBuilder extends Component
{
    public $wireIngredients = [];
    public $searchTerm;
    public $isVisible = false;
    public $recipes = array();
    public $limit = 20;
    public $ingredients = [];
    public $nothing = false;
    protected $paginationTheme = 'bootstrap';

    use WithPagination;


    public function render()
    {

        if ($this->searchTerm != '')
            {
                $searchTerm = '%' . $this->searchTerm . '%';
                $this->wireIngredients = Ingredient::where('title', 'like', $searchTerm)->limit(4)->get();
            }
            else
            {
                $searchTerm = 'NULL';
                $this->isVisible = false;
            }



            if($this->wireIngredients)
                {
                    $this->isVisible = true;
                }
            else
                {
                    $this->isVisible = false;
                }

        return view('livewire.recipe-builder');
    }

    public function getRecipes()
    {
        if(count($this->ingredients) > 0)
        {
            foreach($this->ingredients as $ingredient)
                {
                    $title = rtrim($ingredient['title'], 's');
                    $title = strtolower($title);
                    $condition[] = array('list', 'like', '%'.$title.'%');
                }


                $this->recipes = IngredientList::where($condition)->limit($this->limit)->get();

                if(!count($this->recipes))
                {
                    $this->nothing = true;
                }
                else
                {
                    $this->nothing = false;
                }
        }
        else
        {
            $this->recipes = [];
        }

    }

    public function removeIngredient($id)
    {

        foreach($this->ingredients as $k => $ingredient)
        {
            if($ingredient['id'] == $id)
            {
                unset($this->ingredients[$k]);
            }
        }

	$this->limit = 20;

        if(count($this->ingredients) < 1)
        {
            $this->recipes = [];
        }
        else
        {
            $this->getRecipes();
        }



    }


    public function addIngredient(Ingredient $wireIngredient)
    {


        array_push($this->ingredients, $wireIngredient->toArray());

        $this->searchTerm = '';
        $this->wireIngredients = '';
        $this->isVisible = false;
	$this->limit = 20;
        $this->emit('clearSearch');

        $this->getRecipes();


    }

    public function viewMore()
    {
        $this->limit = $this->limit + 20;
        $this->getRecipes();
    }
}
