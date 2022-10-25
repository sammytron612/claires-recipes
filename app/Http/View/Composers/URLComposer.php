<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class URLComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $url;


    public function __construct()
    {
        // Dependencies are automatically resolved by the service container...
        $this->url =  url()->current();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $temp = explode('/', $this->url);
        if(str_contains(end($temp),'-'))
        {
            $last = end($temp);
            $temp = explode('-',$last);
            array_pop($temp);
            $metaTitle = implode(" ",$temp);
        }
        else
        {
            $metaTitle = end($temp);
        }


        $view->with('metaTitle', $metaTitle);
    }
}
