<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeIngredients;

class TestController extends Controller
{
    // Example index method
    public function index()
    {
        dd("stop");
        $recipes = Recipe::with('recipeMethod')->get();
      
        foreach($recipes as $recipe) {
            $method = $recipe->recipeMethod;
            $ingredients = [];
            if ($method) {
                $html = str_replace(['\\/', '\\r', '\\n', '\\u{A0}'], ['/', '', '', ' '], $method);
                if (preg_match_all('/<a[^>]*>(.*?)<\/a>/is', $html, $matches)) {
                    foreach ($matches[1] as $ingredient) {
                        $ingredients[] = trim(html_entity_decode($ingredient));
                    }
                }
            }
            print($recipe->id . "\n");
            RecipeIngredients::updateOrCreate(
                ['recipeid' => $recipe->id],
                ['ingredients' => $ingredients]
            );

        }

        

        
        dd($ingredients); // This will show an array of all ingredient names
        return view('test');
    }
}
