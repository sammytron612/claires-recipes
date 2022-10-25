<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RatingSystem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $rating;


    public function __construct($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.rating-system');
    }
}
