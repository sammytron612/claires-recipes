<?php

namespace App\\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Auth;

class AddComment extends Component
{
    public $comment;
    public $rating = 0;
    public $recipe;

    public function StoreComment()
    {

        $comment = new Comment;
        $comment->comment = $this->comment;
        $comment->user_id = Auth::user()->id;
        $comment->rating =$this->rating;
        $comment->recipe_id = $this->recipe->id;


        $message = ['text' => 'Comment added','type' => 'success'];

        $this->emit('toast', $message);
        $this->dispatchBrowserEvent('hide-button');

        $this->emit('commentAdded');
        //$this->emit('checkRating');
        $this->emit('IncreaseCommentCount');

        $comment->save();
        $this->reset('comment');

    }
    public function render()
    {
        return view('livewire.add-comment');
    }
}
