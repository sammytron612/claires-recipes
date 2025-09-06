<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use App\Models\Cuisine;
use App\Models\Course;
use App\Models\Ingredient;
use App\Models\Method;
use App\Models\HashDiet;
use App\Models\HashCuisine;
use App\Models\HashCourse;
use App\Models\HashIngredient;
use App\Models\HashMethod;


class CategoryController extends Controller
{
    public function index($choice, $slug = null)
    {

        // If slug is provided, handle individual category page

        if($choice == 'special-diet')
        {
            $returns = Diet::orderBy('title')->paginate(20);
            $image = "diet1232.jpg";
            $caption = "Special diets";
            $route = "diet";
        }

        if($choice == 'ingredient')
        {
            $returns = Ingredient::orderBy('title')->get();
            $route = "ingredient";
            $caption = "Ingredients";
            $image = "ingredients1232.jpg";
        }

        if($choice == 'cuisine')
        {
            $returns = Cuisine::orderBy('title')->paginate(20);
            $route = "cuisine";
            $caption = "Cuisines";
            $image = "cuisine1232.jpg";
        }

        if($choice == 'course')
        {
            $returns = Course::orderBy('title')->paginate(20);
            $route = "course";
            $caption = "Courses";
            $image = "course1232.jpg";
        }

        if($choice == 'method')
        {
            $returns = Method::orderBy('title')->paginate(20);
            $route = "method";
            $caption = "Cooking methods";
            $image = "method1232.png";
        }


        if($choice == "ingredient")
        {
            $image = "ingredients1232.jpg";
            return view('ingredients',compact(['returns', 'route','image', 'caption']));
        }
        else
        {
            return view('sections',compact(['returns', 'route','image', 'caption']));
        }

    }

    public function show($choice, $slug)
    {
      
      
            $category = null;
            $recipes = collect();
         
            switch($choice) {
                case 'ingredient':
                    $category = Ingredient::where('slug', $slug)->firstOrFail();
                    
                    // Get recipes with this ingredient using a simpler approach
                    $hashIngredients = HashIngredient::where('ingredient', $category->id)->get();
                    $recipeIds = $hashIngredients->pluck('recipe_id');
                    $recipeData = \App\Models\Recipe::whereIn('id', $recipeIds)
                        ->with(['user', 'commentRecipe'])
                        ->paginate(12);
                    
                    // Transform to match expected structure
                    $recipes = $recipeData;
                    $recipes->getCollection()->transform(function ($recipe) {
                        // Create a wrapper object that matches the expected structure
                        return (object) [
                            'recipes' => $recipe,
                            'id' => $recipe->id
                        ];
                    });
                    
                    break;
                    
                case 'special-diet':
                    $category = Diet::where('slug', $slug)->firstOrFail();
                    $recipes = HashDiet::where('diet', $category->id)
                        ->with(['recipes.user', 'recipes.commentRecipe'])
                        ->paginate(12);
                    break;
                    
                case 'cuisine':
                    
                    $category = Cuisine::where('slug', $slug)->firstOrFail();
                    $recipes = HashCuisine::where('cuisine', $category->id)
                        ->with(['recipes.user', 'recipes.commentRecipe'])
                        ->paginate(12);
                    break;
                    
                case 'course':
                    $category = Course::where('slug', $slug)->firstOrFail();
                    $recipes = HashCourse::where('course', $category->id)
                        ->with(['recipes.user', 'recipes.commentRecipe'])
                        ->paginate(12);
                    break;
                    
                case 'method':
                    $category = Method::where('slug', $slug)->firstOrFail();
                    $recipes = HashMethod::where('method', $category->id)
                        ->with(['recipes.user', 'recipes.commentRecipe'])
                        ->paginate(12);
                    break;
                    
                default:
                    abort(404, "Invalid category choice: {$choice}");
            }
            
            $url = '/' . $choice . '/';
            
            return view('categories', compact('category', 'url', 'recipes'));
            
       
    }
}
