<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Favourites;
use Auth;

class Favourite extends Component
{
    public $fav;
    public $recipe;


    public function render()
    {
        // Only check favourites if user is authenticated
        if (Auth::check()) {
            $c = Favourites::where('user_id', Auth::user()->id)
                            ->where('recipe_id',$this->recipe)->get();
            if(count($c))
            {
                $this->fav = true;
            }
            else
            {
                $this->fav = false;
            }
        } else {
            $this->fav = false;
        }

        return view('livewire.favourite');
    }

    public function toggleFav()
    {
        // Only allow favouriting if user is authenticated
        if (!Auth::check()) {
            $message = ['text' => 'Please log in to add favourites', 'type' => 'error'];
            $this->dispatch('toast', $message);
            return;
        }

        if ($this->fav == false)
        {
            $this->fav = true;
            $fav = new Favourites;
            $fav->recipe_id = $this->recipe;
            $fav->user_id = Auth::user()->id;
            $fav->save();

            $message = ['text' => 'Favourite added','type' => 'success'];
            $this->dispatch('IncreaseFavCount');
            $this->dispatch('toast', $message);
        }
        else
        {
            $this->fav = false;
            Favourites::where('user_id', Auth::user()->id)
                    ->where('recipe_id', $this->recipe)->delete();

            $message = ['text' => 'Favourite removed','type' => 'success'];
            $this->dispatch('toast', $message);
            $this->dispatch('DecreaseFavCount');
        }

    }
}
