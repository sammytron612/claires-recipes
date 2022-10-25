<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Models\HashCuisine;


class CuisineController extends Controller
{
    public function show($slug, $sort=null)
    {
        $temp = explode('-',$slug);
        $id = end($temp);

        if($sort == 'created_at')
        {
            $recipes = HashCuisine::where('cuisine',$id)
            ->join('recipe','hash_cuisines.recipe_id','=','recipe.id')
            ->orderBy('created_at','desc')
            ->paginate(12);


        }
        elseif($sort == 'views')
        {
            $recipes = HashCuisine::where('cuisine',$id)
            ->join('recipe','hash_cuisines.recipe_id','=','recipe.id')
            ->orderBy('views','desc')
            ->paginate(12);
        }
        elseif($sort == 'rating')
        {
            $recipes = HashCuisine::where('cuisine',$id)
            ->join('recipe','hash_cuisines.recipe_id','=','recipe.id')
            ->orderBy('rating','desc')
            ->paginate(12);
        }
        else
        {
            $recipes = HashCuisine::where('cuisine',$id)
            ->join('recipe','hash_cuisines.recipe_id','=','recipe.id')
	    ->orderBy('title')
            ->paginate(12);
        }


        $url = "/home/cuisine/";
        $category = Cuisine::find($id);

        return view('categories', compact(['recipes','category','url']));

    }
}
