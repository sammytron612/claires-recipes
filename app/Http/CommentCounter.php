<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;


class CommentCounter extends Component
{

    public $commentCount;
    public $recipe;

    protected $listeners = ['IncreaseCommentCount' => 'CountIncrease'];

    public function render()
    {
        $this->commentCount = Comment::where('recipe_id', $this->recipe->id)->count();
        return view('livewire.comment-counter');
    }

    public function CountIncrease()
    {
        $this->commentCount ++;
    }
}
