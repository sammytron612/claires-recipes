<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientList;


class IngredientController extends Controller
{
    public function show($slug, $sort=null)
    {


        $temp = explode('-',$slug);
        $id = end($temp);
        $query = "";
        for($i = 0; $i<count($temp)-1;$i++)
        {
            $query .= $temp[$i] . ' ';
        }
        $query = rtrim($query, " ");
	$query = rtrim($query, "s");

        if($sort == 'created_at')
        {
            $recipes = IngredientList::where('list', 'like', '%"'.$query.'%')
                ->join('recipe','ingredient_lists.recipe_id','=','recipe.id')
                ->orderBy('recipe.created_at','desc')
                ->paginate(12);
        }
        elseif($sort == 'views')
        {
            $recipes = IngredientList::where('list', 'like', '%"'.$query.'%')
                ->join('recipe','ingredient_lists.recipe_id','=','recipe.id')
                ->orderBy('views','desc')
                ->paginate(12);
        }
        elseif($sort == 'rating')
        {
            $recipes = IngredientList::where('list', 'like', '%"'.$query.'%')
                ->join('recipe','ingredient_lists.recipe_id','=','recipe.id')
                ->orderBy('rating','desc')
                ->paginate(12);
        }
        else
        {
            $recipes = IngredientList::where('list', 'like', '%"'.$query.'%')
                ->join('recipe','ingredient_lists.recipe_id','=','recipe.id')
                ->orderBy('recipe.created_at','desc')
                ->paginate(12);
        }



        $url = "/home/ingredient/";
        $category = Ingredient::find($id);
        $category->image = "ingredients1232.jfif";
        $image = "ingredients1232.jpg";

        return view('categories', compact(['recipes','category','url','image']));
    }
}
