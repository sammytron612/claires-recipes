<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Diet;
use App\Models\Course;
use App\Models\Cuisine;
use App\Models\HashIngredient;
use App\Models\HashCuisine;
use App\Models\HashCourse;
use App\Models\HashMethod;
use App\Models\HashDiet;
use App\Models\Method;
use App\Models\RecipeMethod;
use App\Models\Comment;
use App\Models\Favourites;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\IngredientJson;
use App\Models\IngredientList;


class EditController extends Controller
{

    public function recipeIndex()
    {
        
        return view('admin.edit-index');
    }

    public function edit($id)
    {

        $ingredients = Ingredient::all();
        $methods = Method::all();
        $diets = Diet::all();
        $courses = Course::all();
        $cuisines = Cuisine::all();
        $methods = Method::all();
        $recipe = Recipe::find($id);

        $hashIngredients = HashIngredient::where('recipe_id',$id)->get();
        $hashCuisines = HashCuisine::where('recipe_id',$id)->get();
        $hashCourses = HashCourse::where('recipe_id',$id)->get();
        $hashMethods = HashMethod::where('recipe_id',$id)->get();
        $hashDiets = HashDiet::where('recipe_id',$id)->get();


        return view('admin.edit-recipe',compact(['recipe','hashIngredients','hashCuisines','hashMethods','hashCourses','hashDiets',

        'ingredients','cuisines', 'methods','diets','courses','methods']));

    }

    public function update(Request $request)
    {
        if($request->check)
        {
            $request->validate([
                'title' =>  'required',
                'description' => 'required',
                'cookingTime' => 'numeric',
                'method' => 'required',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);
        }
        else
        {
            $request->validate([
                'title' =>  'required',
                'description' => 'required',
                'cooking_time' => 'numeric',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'attachment' => 'nullable|file|max:10240'
            ]);
        }

        $recipe = Recipe::find($request->recipeId);


        if(!$request->check)
        {
            if($request->hasFile('attachment'))
            {
                // Delete old attachment if exists
                if($recipe->attachment) {
                    Storage::delete('public/' . $recipe->attachment);
                }

                // Generate unique filename
                $attach = 'attachment_' . time() . '_' . uniqid() . '.' . $request->attachment->extension();

                // Store new attachment
                $request->attachment->storeAs('public', $attach);
                
                // Delete old recipe methods
                
                $recipe->attachment = $attach;
            }
        }
       
        if($request->hasFile('photo'))
        {
            // Generate unique filename with timestamp and random string
            $pic = 'recipe_' . time() . '_' . uniqid() . '.' . $request->photo->extension();

            // Delete old image if exists
            if($recipe->image) {
                try {
                    Storage::delete('public/' . $recipe->image);
                } catch (\Exception $e) {
                    // Log error but continue
                    \Log::warning('Failed to delete old image: ' . $e->getMessage());
                }
            }

            // Store new image
            $request->photo->storeAs('public', $pic);
            $recipe->image = $pic;
        }

        $recipe->title = $request->title;
        $recipe->slug = (str_replace(' ', '-', strtolower($request->title)));

        $recipe->description = $request->description;
        $recipe->cooking_time = $request->cooking_time;

        $recipe->save();



        RecipeMethod::where('recipe_id', $request->recipeId)->delete();
        $method = new RecipeMethod;
        $method->description = $request->method;
        $method->recipe_id = $request->recipeId;
        $method->save();

            

        

        HashIngredient::where('recipe_id', $request->recipeId)->delete();
        if($request->has('wireIngredients'))
        {

            foreach($request->wireIngredients as $ingredient)
            {
		if($ingredient == 0){break;}
                $hash = new HashIngredient();
                $hash->ingredient = $ingredient;
                $hash->recipe_id = $request->recipeId;
                $hash->save();
            }
        }

        HashCuisine::where('recipe_id', $request->recipeId)->delete();
        if($request->has('wireCuisines'))
        {

            foreach($request->wireCuisines as $cuisine)
            {
                $hash = new HashCuisine();
                $hash->cuisine = $cuisine;
                $hash->recipe_id = $request->recipeId;
                $hash->save();
            }
        }

        HashDiet::where('recipe_id', $request->recipeId)->delete();
        if($request->has('wireDiets'))
        {

            foreach($request->wireDiets as $diet)
            {
                $hash = new HashDiet();
                $hash->diet = $diet;
                $hash->recipe_id = $request->recipeId;
                $hash->save();
            }
        }

        HashCourse::where('recipe_id', $request->recipeId)->delete();
        if($request->has('wireCourses'))
        {

            foreach($request->wireCourses as $course)
            {
                $hash = new HashCourse();
                $hash->Course = $course;
                $hash->recipe_id = $request->recipeId;
                $hash->save();
            }
        }

        HashMethod::where('recipe_id', $request->recipeId)->delete();
        if($request->has('wireMethods'))
        {

            foreach($request->wireMethods as $method)
            {
                $hash = new HashMethod();
                $hash->method = $method;
                $hash->recipe_id = $request->recipeId;
                $hash->save();
            }
        }

        return redirect()->back()->with('status', 'Recipe updated');

    }

    public function destroy($id)
    {

        Recipe::find($id)->delete();
        Favourites::where('recipe_id',$id)->delete();
        HashMethod::where('recipe_id', $id)->delete();
        Comment::where('recipe_id',$id)->delete();
        HashCourse::where('recipe_id', $id)->delete();
        HashMethod::where('recipe_id', $id)->delete();
        HashCourse::where('recipe_id', $id)->delete();
        HashIngredient::where('recipe_id', $id)->delete();
        HashDiet::where('recipe_id', $id)->delete();
        RecipeMethod::where('recipe_id', $id)->delete();
        IngredientList::where('recipe_id', $id)->delete();


        return redirect('/home/admin')->with('status', 'Recipe deleted');
    }
}
