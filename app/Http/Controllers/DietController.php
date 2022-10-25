<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use App\Models\HashDiet;

class DietController extends Controller
{
    public function show($slug, $sort=null)
    {
        $temp = explode('-',$slug);
        $id = end($temp);

        if($sort == 'created_at')
        {
            $recipes = HashDiet::where('diet',$id)
            ->join('recipe','hash_diets.recipe_id','=','recipe.id')
            ->orderBy('created_at','desc')
            ->paginate(12);


        }
        elseif($sort == 'views')
        {
            $recipes = HashDiet::where('diet',$id)
            ->join('recipe','hash_diets.recipe_id','=','recipe.id')
            ->orderBy('views','desc')
            ->paginate(12);
        }
        elseif($sort == 'rating')
        {
            $recipes = HashDiet::where('diet',$id)
            ->join('recipe','hash_diets.recipe_id','=','recipe.id')
            ->orderBy('rating','desc')
            ->paginate(12);
        }
        else
        {
            $recipes = HashDiet::where('diet',$id)
            ->join('recipe','hash_diets.recipe_id','=','recipe.id')
	    ->orderBy('title')
            ->paginate(12);
        }


        $url = "/home/special-diet/";
        $category = Diet::find($id);

        return view('categories', compact(['recipes','category','url']));
    }
}
