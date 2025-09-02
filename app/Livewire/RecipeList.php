<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Recipe;
use Livewire\WithPagination;


class RecipeList extends Component
{

    protected $recipes = null;
    public $searchTerm = "";

    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {

        $this->recipes = Recipe::where('title','like','%'.$this->searchTerm . '%')->orderBy('title')
                                ->paginate(20);

        return view('livewire.recipe-list',(['recipes' => $this->recipes]));
    }

    public function updatingSearchTerm()
    {
	$this->resetPage();
    }

}
