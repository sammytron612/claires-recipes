<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Livewire\Attributes\On;


class CommentCounter extends Component
{

    public $commentCount;
    public $recipe;

    public function render()
    {
        $this->commentCount = Comment::where('recipe_id', $this->recipe->id)->count();
        return view('livewire.comment-counter');
    }

    #[On('IncreaseCommentCount')]
    public function CountIncrease()
    {
        $this->commentCount ++;
    }
}
