<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Favourites;
use App\Models\Planner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        //$recipes = Recipe::with('HashDiet')->where('hash_diets.diet','<>','4')->limit(3)->get();

        $recipes = Recipe::whereDoesntHave('HashDiet')->inRandomOrder()->limit(10)->get();
       
        if(Auth::check()){$favourites = Favourites::where('user_id', Auth::user()->id)->get();}
        else {$favourites = null;}

        $r = rand(0,1);
        if($r)
        {$top10 = Recipe::orderBy('views','desc')->limit(12)->get();}
        else
        {$top10 = Recipe::orderBy('rating', 'desc')->limit(12)->get();}

        $url = "/home";
        return view('home', compact('recipes','top10', 'url','favourites'));
    }

    /**
     * Show the user's meal planner
     *
     * @return \Illuminate\Http\Response
     */
    public function planner()
    {
        
        return view('profile.planner');
    }

    /**
     * Show the user's profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function userProfile()
    {
        $user = Auth::user();
        $favourites = Favourites::where('user_id', $user->id)
                                ->with('recipe')
                                ->get();
        
        return view('profile.profile', compact('user', 'favourites'));
    }

    /**
     * Show the user's favourites page
     *
     * @return \Illuminate\Http\Response
     */
    public function favourites()
    {
        return view('profile.favourites');
    }
}
