<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;


class FavCount extends Component
{
    public $favCounter;

    protected $listeners = ['IncreaseFavCount' => 'increaseFav', 'DecreaseFavCount' => 'decreaseFav'];

    public function render()
    {

        $this->favCounter = count(Auth::user()->favourite);

        return view('livewire.fav-count');
    }

    public function increaseFav()
    {
        $this->favCounter ++;
    }

    public function decreaseFav()
    {
        $this->favCounter --;
    }
}
