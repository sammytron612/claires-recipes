<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HashIngredient;
use App\Models\Ingredient;
use App\Models\HashDiet;
use App\Models\Diet;
use App\Models\HashCourse;
use App\Models\Course;
use App\Models\HashCuisine;
use App\Models\Cuisine;
use App\Models\HashMethod;
use App\Models\Method;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Http\Services\IngredientService;
use App\Http\Helpers\CheckIngredients;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
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

    public function recipeIndex()
    {
        $recipes = Recipe::with(['ingredients', 'methods', 'courses', 'cuisines', 'diets'])
                         ->orderBy('created_at', 'desc')
                         ->paginate(20);
        
        return view('admin.recipe-index', compact('recipes'));
    }

    public function storeRecipe(Request $request)
    {
        // Validation rules for recipe creation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cooking_time' => 'required|integer|min:1',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'method' => 'nullable|string',
            'wireIngredients' => 'array',
            'wireCuisines' => 'nullable|array',
            'wireDiets' => 'nullable|array',
            'wireCourses' => 'array',
            'wireMethods' => 'nullable|array',
        ]);

   
            // Handle file uploads
            $imagePath = null;
            if ($request->hasFile('photo')) {
                $imagePath = $request->file('photo')->store('recipes', 'public');
            }

            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('attachments', 'public');
            }

        // Create the recipe
        $recipe = Recipe::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'cooking_time' => $validated['cooking_time'],
            'image' => $imagePath,
            'attachment' => $attachmentPath,
            'author' => auth()->id(),
            'slug' => \Str::slug($validated['title']),
        ]);
        

        // Handle manual recipe method
        if ($request->has('check') && $validated['method']) {
            $recipe->recipeMethod()->create([
                'description' => $validated['method']
            ]);
            $ingredients = [];
            $ingredientService = new IngredientService();
            $ingredients = $ingredientService->extract($request->input('method'));
            $checkIngredients = new CheckIngredients();
            $checkIngredients->check($ingredients);
        }

        // Attach relationships
        if (!empty($validated['wireIngredients'])) {
            foreach ($validated['wireIngredients'] as $ingredientId) {
                
                HashIngredient::create(['recipe_id' => $recipe->id, 'ingredient' => $ingredientId]);
                
            }
        }
        if (!empty($validated['wireCuisines'])) {
            foreach ($validated['wireCuisines'] as $cuisineId) {
                HashCuisine::create(['recipe_id' => $recipe->id, 'cuisine' => $cuisineId]);
            }
        }
        if (!empty($validated['wireDiets'])) {
            foreach ($validated['wireDiets'] as $dietId) {
                HashDiet::create(['recipe_id' => $recipe->id, 'diet' => $dietId]);
            }
        }
        if (!empty($validated['wireCourses'])) {
            foreach ($validated['wireCourses'] as $courseId) {
                HashCourse::create(['recipe_id' => $recipe->id, 'course' => $courseId]);
            }
        }
        if (!empty($validated['wireMethods'])) {
            foreach ($validated['wireMethods'] as $methodId) {
                HashMethod::create(['recipe_id' => $recipe->id, 'method' => $methodId]);
            }
        }
        if (!empty($ingredients)) {
            $recipe->recipeIngredients()->create([
                'recipeid' => $recipe->id,
                'ingredients' => $ingredients
            ]);
        }


        return redirect()->route('admin.new-recipe')->with('status', 'Recipe created successfully!');
    }
}
