<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ingredient;

class SelectIngredients extends Component
{
    public $search = '';
    public $selectedIngredients = [];
    public $availableIngredients = [];
    public $showDropdown = false;
    public $wireIngredients = []; // This will be bound to the form

    public function mount($selected = [])
    {
        $this->selectedIngredients = $selected;
        $this->updateWireIngredients();
    }

    public function updatedSearch()
    {
        $this->searchIngredients();
    }

    public function searchIngredients()
    {
        if (strlen($this->search) >= 2) {
            $selectedIds = collect($this->selectedIngredients)->pluck('id')->toArray();
            
            $this->availableIngredients = Ingredient::where('title', 'like', '%' . $this->search . '%')
                ->whereNotIn('id', $selectedIds)
                ->take(10)
                ->get()
                ->toArray();
            $this->showDropdown = true;
        } else {
            $this->availableIngredients = [];
            $this->showDropdown = false;
        }
    }

    public function selectIngredient($ingredientId)
    {
        $ingredient = Ingredient::find($ingredientId);
        
        if ($ingredient) {
            $selectedIds = collect($this->selectedIngredients)->pluck('id')->toArray();
            
            if (!in_array($ingredientId, $selectedIds)) {
                $this->selectedIngredients[] = $ingredient->toArray();
                $this->updateWireIngredients();
            }
        }
        
        $this->search = '';
        $this->availableIngredients = [];
        $this->showDropdown = false;
    }

    public function removeIngredient($index)
    {
        array_splice($this->selectedIngredients, $index, 1);
        $this->updateWireIngredients();
    }

    public function updateWireIngredients()
    {
        // Update wireIngredients array with just the IDs
        $this->wireIngredients = collect($this->selectedIngredients)->pluck('id')->toArray();
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.select-ingredients');
    }
}
?>