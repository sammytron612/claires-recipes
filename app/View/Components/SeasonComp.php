<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\Seasonal;

class SeasonComp extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $seasonal = Seasonal::with(['recipe.user', 'recipe.commentRecipe'])
            ->inRandomOrder()
            ->limit(4)
            ->get();
        return view('components.season-comp',compact(['seasonal']));
    }
}
