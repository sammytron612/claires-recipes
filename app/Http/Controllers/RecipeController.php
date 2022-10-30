<?php

namespace App\Http\Controllers;


use App\Models\Recipe;
use App\Models\HashIngredient;
use App\Models\HashCuisine;
use App\Models\HashCourse;
use App\Models\HashDiet;
use App\Models\HashMethod;
use App\Models\Comment;
use App\Http\Helpers\SimilarRecipe;
use App\Http\Helpers\ParsePdf;
use Illuminate\Http\Request;
use App\Models\RecipeMethod;
use App\Http\Helpers\IngredientJson;
use App\Models\IngredientList;
use Auth;
use Illuminate\Support\Str;



class RecipeController extends Controller
{
    public function show($id,$slug)
    {

        dd(Str::slug('duck', '-'));
     

        /*$recipes = Recipe::all();

        foreach($recipes as $recipe)
        {
            $title=$recipe->title;

            $slug = Str::slug($title, '-');
            
            $recipe->slug = $slug;
            $recipe->save();

        }*/


        $recipe = Recipe::where('id',$id)->with('HashIngredient','HashDiet','HashMethod','HashCuisine','HashCourse','commentRecipe')->first();

        $recipe->views ++;
        $recipe->save();



        //$hashIngredient = HashIngredient::where('recipe_id', $recipe->id)->get();

        //$hashDiet = HashDiet::where('recipe_id', $recipe->id)->get();

        //$hashMethod = HashMethod::where('recipe_id', $recipe->id)->get();

        //$hashCuisine = HashCuisine::where('recipe_id', $recipe->id)->get();

        //$hashCourse = HashCourse::where('recipe_id', $recipe->id)->get();

        //$comments = Comment::where('recipe_id', $recipe->id)->get();

        $algorithm = new SimilarRecipe;

        $similarRecipes = $algorithm->similar($recipe->HashIngredient,$recipe->HashDiet, $recipe->HashMethod, $recipe->HashCuisine, $recipe->HashCourse, $id);
    

         $similarRecipes = Recipe::whereIn('id',$similarRecipes)->get();
        

        return view('recipe.show',compact(['recipe','similarRecipes']));

    }

    public function search($searchTerm, $sort=null)
    {
        $search = '%' . $searchTerm . '%';

        if($sort == 'created_at')
        {
            $data = Recipe::select('recipe.id')
                ->join('hash_ingredients','hash_ingredients.recipe_id','=','recipe.id')
                ->where('recipe.title', 'like',$search)
                ->orWhereIn('hash_ingredients.ingredient', function ($query) use ($search) {
                    $query->select('id')->from('ingredient')->where('title','like',$search);
                })->distinct('recipe_id')->get();

            $id = [];

            foreach($data as $s)
                {
                    $id[] =  $s->id;
                }
            $recipes = Recipe::whereIn('id', $id)->orderBy('created_at','desc')->paginate(12);
        }
        elseif($sort == 'views')
        {
            $data = Recipe::select('recipe.id')
                ->join('hash_ingredients','hash_ingredients.recipe_id','=','recipe.id')
                ->where('recipe.title', 'like',$search)
                ->orWhereIn('hash_ingredients.ingredient', function ($query) use ($search) {
                    $query->select('id')->from('ingredient')->where('title','like',$search);
                })->distinct('recipe_id')->get();

                $id = [];

                foreach($data as $s)
                    {
                        $id[] =  $s->id;
                    }
                $recipes = Recipe::whereIn('id', $id)->orderBy('views','desc')->paginate(12);
        }
        elseif($sort == 'rating')
        {
            $data = Recipe::select('recipe.id')
            ->join('hash_ingredients','hash_ingredients.recipe_id','=','recipe.id')
            ->where('recipe.title', 'like',$search)
            ->orWhereIn('hash_ingredients.ingredient', function ($query) use ($search) {
                $query->select('id')->from('ingredient')->where('title','like',$search);
            })->distinct('recipe_id')->get();

            $id = [];

            foreach($data as $s)
                {
                    $id[] =  $s->id;
                }
            $recipes = Recipe::whereIn('id', $id)->orderBy('rating','desc')->paginate(12);
        }
        else
        {
            $data = Recipe::select('recipe.id')
                ->join('hash_ingredients','hash_ingredients.recipe_id','=','recipe.id')
                ->where('recipe.title', 'like',$search)
                ->orWhereIn('hash_ingredients.ingredient', function ($query) use ($search) {
                    $query->select('id')->from('ingredient')->where('title','like',$search);
                })->distinct('recipe_id')->get();

                $id = [];

                foreach($data as $s)
                    {
                        $id[] =  $s->id;
                    }
                $recipes = Recipe::whereIn('id', $id)->paginate(12);

        }
        //dd($recipes);

        $url = "home/recipe/search/";


        return view('recipe.search',compact(['recipes', 'searchTerm', 'url']));
    }



    public function store(Request $request)
    {


        if($request->check)
        {

            $request->validate([
            'title' =>  'required',
            'description' => 'required',
            'cookingTime' => 'numeric',
            'method' => 'required',
            'photo' => 'required|image|max:1024']); // 1MB Max])
        }
        else
        {
            $request->validate([
                'title' =>  'required',
                'description' => 'required',
                'attachment' => 'required',
                'cookingTime' => 'numeric',
                'photo' => 'required|image|max:1024', // 1MB Max
            ]);
        }

        if(!$request->check)
        {
            $attach = md5($request->attachment . microtime()).'.'.$request->attachment->extension();
        }
        else
        {
            $attach = Null;
        }

        $pic = md5($request->photo . microtime()).'.'.$request->photo->extension();

        $recipe = ['title' =>  $request->title,
                'description' => $request->description,
                'author' => Auth::user()->id,
                'attachment' => $attach,
                'image' => $pic,
                'cooking_time' => $request->cooking_time,
            ];


        $id = Recipe::create($recipe)->id;

        $slug = $slug = Str::slug($recipe->title, '-');

        Recipe::where('id', $id)->update(['slug' => $slug]);

        if($request->check)
        {

            $newMethod = new RecipeMethod;
            $newMethod->description = $request->method;

            ##### new ingredient list #####
            $IngredientJson = new IngredientJson;

            $json = strtolower($IngredientJson->toJson($request->method));

            $data = ['recipe_id' => $id,
                    'list' => $json
                                    ];

            IngredientList::create($data);

            $newMethod->recipe_id = $id;
            $newMethod->save();
        }

        $request->photo->storeAs('public', $pic);

        if(!$request->check)
        {

            $request->attachment->storeAs('public',$attach);
            //$parsePdf = new ParsePdf;
            //$foo = $parsePdf->parse($attach);

        }



        if($request->has('wireIngredients'))
        {
            foreach($request->wireIngredients as $ingredient)
            {
            if($ingredient == 0){break;}
                    $hash = new HashIngredient();
                    $hash->ingredient = $ingredient;
                    $hash->recipe_id = $id;
                    $hash->save();
                }
        }


        if($request->has('wireCuisines'))
        {
            foreach($request->wireCuisines as $cuisine)
            {
                $hash = new HashCuisine();
                $hash->cuisine = $cuisine;
                $hash->recipe_id = $id;
                $hash->save();
            }
        }

        if($request->has('wireDiets'))
        {
            foreach($request->wireDiets as $diet)
            {
                $hash = new HashDiet();
                $hash->diet = $diet;
                $hash->recipe_id = $id;
                $hash->save();
            }
        }

        if($request->has('wireCourses'))
        {
            foreach($request->wireCourses as $course)
            {
                $hash = new HashCourse();
                $hash->Course = $course;
                $hash->recipe_id = $id;
                $hash->save();
            }
        }

        if($request->has('wireMethods'))
        {
            foreach($request->wireMethods as $method)
            {
                $hash = new HashMethod();
                $hash->method = $method;
                $hash->recipe_id = $id;
                $hash->save();
            }
        }

        return redirect()->back()->with('status', 'Recipe created');;

    }

}
