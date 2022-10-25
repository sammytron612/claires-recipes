<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use App\Models\Cuisine;
use App\Models\Course;
use App\Models\Ingredient;
use App\Models\Method;


class CategoryController extends Controller
{
    public function index($choice)
    {

        if($choice == 'special-diet')
        {
            $returns = Diet::orderBy('title')->paginate(12);
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
            $returns = Cuisine::orderBy('title')->paginate(12);
            $route = "cuisine";
            $caption = "Cusines";
            $image = "cuisine1232.jpg";
        }

        if($choice == 'course')
        {
            $returns = Course::orderBy('title')->paginate(12);
            $route = "course";
            $caption = "Courses";
            $image = "course1232.jpg";
        }

        if($choice == 'method')
        {
            $returns = Method::orderBy('title')->paginate(12);
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
}
