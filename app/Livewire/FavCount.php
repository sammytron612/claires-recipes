<?php

namespace App\Livewire;

use Livewire\Component;
use Auth;
use Livewire\Attributes\On;


class FavCount extends Component
{
    public $favCounter;

    public function render()
    {

        $this->favCounter = count(Auth::user()->favourite);

        return view('livewire.fav-count');
    }

    #[On('IncreaseFavCount')]
    public function increaseFav()
    {
        $this->favCounter ++;
    }

    #[On('DecreaseFavCount')]
    public function decreaseFav()
    {
        $this->favCounter --;
    }
}
