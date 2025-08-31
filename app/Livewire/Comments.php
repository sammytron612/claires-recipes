<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class Comments extends Component
{
    public $comments;
    public $recipe;

    protected $listeners = ['commentAdded' => 'newComment'];

    public function render()
    {
        $this->comments = Comment::where('recipe_id', $this->recipe->id)->orderBy('created_at', 'desc')->get();
        return view('livewire.comments');
    }

    public function newComment()
    {
        $this->comments = Comment::where('recipe_id', $this->recipe->id)->orderBy('created_at', 'desc')->get();
    }
}
