<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\HashMethod;

class MethodController extends Controller
{
    public function show($slug, $sort=null)
    {
        $temp = explode('-',$slug);
        $id = end($temp);

        if($sort == 'created_at')
        {
            $recipes = HashMethod::where('hash_methods.method',$id)
            ->join('recipe','hash_methods.recipe_id','=','recipe.id')
            ->orderBy('created_at','desc')
            ->paginate(12);


        }
        elseif($sort == 'views')
        {
            $recipes = HashMethod::where('hash_methods.method',$id)
            ->join('recipe','hash_methods.recipe_id','=','recipe.id')
            ->orderBy('views','desc')
            ->paginate(12);
        }
        elseif($sort == 'rating')
        {
            $recipes = HashMethod::where('hash_methods.method',$id)
            ->join('recipe','hash_methods.recipe_id','=','recipe.id')
            ->orderBy('rating','desc')
            ->paginate(12);
        }
        else
        {
            $recipes = HashMethod::where('hash_methods.method',$id)
            ->join('recipe','hash_methods.recipe_id','=','recipe.id')
 	    ->orderBy('title')
            ->paginate(12);
        }


        $url = "/home/method/";
        $category = Method::find($id);

        return view('categories', compact(['recipes','category','url']));
    }
}
