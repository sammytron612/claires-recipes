<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Cuisine;
use App\Models\Course;
use App\Models\Method;
use App\Models\Diet;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    public function index()
    {

        if( !Cache::has( 'cacheIndex' ) )
        {
            $i = Ingredient::all();
            $ingredients = [];

            foreach($i as $ingredient)
            {
                $title = $ingredient->title;
                $query = '%"' . strtolower($title) . '"%';
                $slug = $ingredient->slug;
                $temp = DB::select("SELECT 'ingredient' as category, ? as title, ? as slug FROM ingredient_lists
                WHERE list like ?",[$title,$slug,$query]);

                if($temp){
                    array_push($ingredients, ['total' => count($temp),
                                    'category' => 'ingredient',
                                    'title' => $title,
                                    'slug' =>$slug]);
                }
            }


    /*     foreach($ingredients as $ingredient)
            {
                echo $ingredient[0]->total;
            }
            dd($ingredients);
            $ingredients = DB::select('SELECT count(*) as total,"ingredient" as category, ingredient.title as title ,ingredient.slug as slug FROM hash_ingredients
            join ingredient
            on (hash_ingredients.ingredient = ingredient.id)
            Group by hash_ingredients.ingredient');*/


            $courses = DB::select('SELECT count(*) as total,"course" as category, course.title as title ,course.slug as slug FROM hash_courses
            join course
            on (hash_courses.course = course.id)
            Group by hash_courses.course');


            $diets = DB::select('SELECT count(*) as total,"diet" as category, diet.title as title ,diet.slug as slug FROM hash_diets
            join diet
            on (hash_diets.diet = diet.id)
            Group by hash_diets.diet');

            $methods = DB::select('SELECT count(*) as total,"method" as category, method.title as title ,method.slug as slug FROM hash_methods
            join method
            on (hash_methods.method = method.id)
            Group by hash_methods.method');

            $cuisines = DB::select('SELECT count(*) as total,"cuisine" as category, cuisine.title as title ,cuisine.slug as slug FROM hash_cuisines
            join cuisine
            on (hash_cuisines.cuisine = cuisine.id)
            Group by hash_cuisines.cuisine');


            $index = array();

            foreach($ingredients as $ingredient)
            {
                $index[] = (object) $ingredient;
            }
            foreach($diets as $diet)
            {
                $index[] = $diet;
            }
            foreach($cuisines as $cuisine)
            {
                $index[] = $cuisine;
            }
            foreach($methods as $method)
            {
                $index[] = $method;
            }
            foreach($courses as $course)
            {
                $index[] = $course;
            }

            $title = array_column($index, 'title');

            array_multisort($title, SORT_ASC, $index);

            Cache::put( 'cacheIndex', $index, 86400 );
        }

    $index = Cache::get('cacheIndex');   

    return view('recipe.index', compact(['index']));

    }

    public function search($searchTerm)
    {
        // Decode URL encoded search term
        $searchTerm = urldecode($searchTerm);
        
        // Search for recipes
        $recipes = Recipe::with(['user', 'commentRecipe', 'recipeMethod'])
                        ->where(function($query) use ($searchTerm) {
                            $query->where('title', 'LIKE', '%' . $searchTerm . '%')
                                  ->orWhereHas('recipeMethod', function($q) use ($searchTerm) {
                                      $q->where('description', 'LIKE', '%' . $searchTerm . '%');
                                  });
                        })
                        ->paginate(12);

        // Search for cuisines
        $cuisines = Cuisine::where('title', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                          ->get();

        // Search for ingredients
        $ingredients = Ingredient::where('title', 'LIKE', '%' . $searchTerm . '%')
                                ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                                ->get();

        // Search for courses
        $courses = Course::where('title', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                        ->get();

        // Search for methods
        $methods = Method::where('title', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                        ->get();

        // Search for diets
        $diets = Diet::where('title', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                    ->get();

        return view('recipe.search-results', compact([
            'searchTerm', 
            'recipes', 
            'cuisines', 
            'ingredients', 
            'courses', 
            'methods', 
            'diets'
        ]));
    }
}
