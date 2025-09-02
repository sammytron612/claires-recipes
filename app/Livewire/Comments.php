<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Livewire\Attributes\On;

class Comments extends Component
{
    public $comments;
    public $recipe;

    public function render()
    {
        $this->comments = Comment::where('recipe_id', $this->recipe->id)->orderBy('created_at', 'desc')->get();
        return view('livewire.comments');
    }

    #[On('commentAdded')]
    public function newComment()
    {
        $this->comments = Comment::where('recipe_id', $this->recipe->id)->orderBy('created_at', 'desc')->get();
    }
}
