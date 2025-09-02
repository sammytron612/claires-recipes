<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Diet;
use App\Models\Course;
use App\Models\Cuisine;
use App\Models\Method;
use App\Models\Recipe;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function editRecipe($id)
    {
        $recipe = Recipe::findOrFail($id);
        $ingredients = Ingredient::all();
        $methods = Method::all();
        $diets = Diet::all();
        $courses = Course::all();
        $cuisines = Cuisine::all();

        return view('admin.edit-recipe', compact('recipe', 'ingredients', 'cuisines', 'methods', 'diets', 'courses'));
    }

    public function newRecipe()
    {
        $ingredients = Ingredient::all();
        $methods = Method::all();
        $diets = Diet::all();
        $courses = Course::all();
        $cuisines = Cuisine::all();
        $methods = Method::all();

        return view('admin.new-recipe', compact(['ingredients','cuisines', 'methods','diets','courses','methods']));
    }

    public function newHashtag()
    {
        return view('admin.new-hashtag');
    }
}
