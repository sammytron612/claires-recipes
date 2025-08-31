<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $url;


    public function __construct()
    {
        $this->url = url()->current();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {

        if($this->url == url('/')){$this->url = url('/') . "/home";}

        $urlParts = explode('/', $this->url);

        if (end($urlParts) == 'views' || end($urlParts) == 'rating' || end($urlParts) == 'created_at')
         {
            array_pop($urlParts);
         }

        $segments = [];

        $i = count($urlParts) - 1;

        while ($i >= 0 && $urlParts[$i] != 'home') {
            $segments[] = $urlParts[$i];
            $i--;
        }
        
        // Add 'home' if we found it
        if ($i >= 0 && $urlParts[$i] == 'home') {
            $segments[] = $urlParts[$i];
        }

        $segments = array_reverse($segments);


        return view('components.breadcrumb', compact(['segments']));
    }
}
