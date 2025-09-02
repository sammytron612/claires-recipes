<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Favourites;
use App\Models\Planner;
use Auth;
use Livewire\WithPagination;

class FavouritePlanner extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';
    protected $favourites;
    public $plannerEntries;

    public function render()
    {
        $this->favourites = Favourites::join('recipe','recipe.id','=','favourites.recipe_id')
                            ->orderBy('recipe.title')
                            ->where('user_id', Auth::user()->id)->paginate(12);

        $this->plannerEntries = Planner::where('user_id',Auth::user()->id)->get();


        return view('livewire.favourite-planner', ['favourites' => $this->favourites]);
    }

    public function destroy($id)
    {
        $fav = Favourites::find($id);

        $removes = Auth::user()->planner->where('recipe_id', $fav->recipe_id);
        foreach($removes as $id)
        {
            Planner::where('planner_id',$id->planner_id)->delete();
        }
        $fav->delete();

        $message = ['text' => 'Favourite removed','type' => 'success'];
        $this->dispatch('toast', $message);
        $this->dispatch('DecreaseFavCount');
    }

    public function AddPlanner($id)
    {
        $count = Planner::where('recipe_id',$id)->count();
        if ($count){return;}
        $new = new Planner;
        $new->recipe_id = $id;
        $new->user_id = Auth::user()->id;
        $new->save();
        $this->plannerEntries = Planner::where('user_id',Auth::user()->id)->get();

        $message = ['text' => 'Added to planner','type' => 'success'];
        $this->dispatch('toast', $message);

    }
    public function RemovePlanner($id)
    {
        Planner::where('planner_id',$id)->delete();

        $this->plannerEntries = Planner::where('user_id',Auth::user()->id)->get();
        $message = ['text' => 'Removed from planner','type' => 'success'];
        $this->dispatch('toast', $message);
    }
}
