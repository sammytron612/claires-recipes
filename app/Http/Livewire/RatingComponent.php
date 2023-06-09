<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Recipe;


class RatingComponent extends Component
{
    public $rating = 0;
    public $recipe;

    protected $listeners = ['commentAdded' => 'rating'];

    public function render()
    {
        $rating = round(Comment::where('recipe_id', $this->recipe->id)->Where('rating','<>', 0)->avg('rating'));
        $this->rating = $rating;

        return view('livewire.rating-component');
    }

    public function rating()
    {
        $rating = round(Comment::where('recipe_id', $this->recipe->id)->Where('rating','<>', 0)->avg('rating'));
        $recipe = Recipe::find($this->recipe->id);
        $recipe->rating = $rating;
        $recipe->save();

        $this->rating = round($rating);
        $this->recipe->$rating = $rating;
    }
}
