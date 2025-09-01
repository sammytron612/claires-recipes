<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\DietController;
use App\Models\Recipe;
use App\Models\BlogArticle;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    $recipes = Recipe::where('featured', 1)->limit(6)->get();
    $top10 = Recipe::orderBy('rating', 'desc')->limit(10)->get();
    $favourites = [];
    
    // Get user favorites if authenticated
    if (auth()->check()) {
        $favourites = \App\Models\Favourites::where('user_id', auth()->id())->get();
    }
    
    return view('home', compact('recipes', 'top10', 'favourites'));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public recipe routes
Route::get('/recipe-builder', function () {
    return view('recipe-builder');
})->name('recipe-builder');

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipe.index');


// Recipe index/search route
Route::get('/recipe/index', [IndexController::class, 'index'])->name('recipe.search.index');

// Recipe search results route
Route::get('/home/recipe/search/{searchTerm}', [IndexController::class, 'search'])->name('recipe.search.results');

// Legacy recipe routes for compatibility with existing views
Route::get('/recipe/{id}/{slug}', [RecipeController::class, 'show'])->where('id', '[0-9]+')->name('recipe');
Route::get('/recipe/{slug}', function($slug) {
    // Try to find recipe by slug, fallback to treating it as ID
    $recipe = \App\Models\Recipe::where('slug', $slug)->first();
    if (!$recipe) {
        $recipe = \App\Models\Recipe::find($slug);
    }
    if (!$recipe) {
        abort(404);
    }
    return app(\App\Http\Controllers\RecipeController::class)->show($recipe->id);
})->name('recipe.slug');

Route::get('/recipe/{recipe}/print', [RecipeController::class, 'print'])->name('recipe.print');

// Categories

// Categories
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

// Individual category type routes with optional slug parameter (MUST come before /category/{choice})
Route::get('/special-diet/{slug?}', [CategoryController::class, 'index'])->defaults('choice', 'special-diet')->name('special-diet');


Route::get('/ingredient/{slug}/{sort?}', [IngredientController::class, 'show'])->name('ingredient');

Route::get('/course/{slug}/{sort?}', [CourseController::class, 'show'])->name('course');
Route::get('/diet/{slug}/{sort?}', [DietController::class, 'show'])->name('diet');
Route::get('/cuisine/{slug}/{sort?}', [CuisineController::class, 'show'])->name('cuisine');
Route::get('/method/{slug}/{sort?}', [MethodController::class, 'show'])->name('method');

// Generic category route (MUST come AFTER specific routes)
Route::get('/category/{choice}', [CategoryController::class, 'index'])->name('category');


// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{BlogArticle}', function ($BlogArticle) {
    $BlogArticle = BlogArticle::findOrFail($BlogArticle);
    $body = $BlogArticle->postBody;
    $tmp = explode('/', $BlogArticle->main_image);
    $image = end($tmp);
    
    return view('blog.show-post', ['body' => $body, 'image' => $image, 'BlogArticle' => $BlogArticle]);
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User profile routes
    Route::get('/profile/planner', [HomeController::class, 'planner'])->name('profile.planner');
    Route::get('/profile/profile', [HomeController::class, 'userProfile'])->name('profile.profile');
    
    // Admin routes
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        // Add other admin routes as needed
    });
});

require __DIR__.'/auth.php';
