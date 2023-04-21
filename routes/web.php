
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\BlogController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('home/privacy', function () {
    return view('privacy');});

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect'])->name('login.facebook');

Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

Route::get('/home/builder', function () {
    return view('recipe-builder');})->name('recipe-builder');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/home/recipe/{id}/{slug?}',[RecipeController::class, 'show'])->name('recipe');

Route::get('/home/index', [IndexController::class, 'index'])->name('recipe.index');

Route::get('/home/cuisine/{slug}/{sort?}',[CuisineController::class, 'show'])->name('cuisine');

Route::get('/home/special-diet/{slug}/{sort?}',[DietController::class, 'show'])->name('diet');

Route::get('/home/ingredient/{slug}/{sort?}',[IngredientController::class, 'show'])->name('ingredient');

Route::get('/home/method/{slug}/{sort?}',[MethodController::class, 'show'])->name('method');

Route::get('/home/course/{slug}/{sort?}',[CourseController::class, 'show'])->name('course');

Route::get('/home/admin', function () {
    return view('admin.index');})->name('admin.index')->middleware('auth','admin');

Route::get('/home/admin/new-recipe',[AdminController::class, 'newRecipe'])->name('admin.new-recipe')->middleware('auth','admin');

Route::get('/home/admin/new-hashtag',[AdminController::class, 'newHashtag'])->name('admin.new-hashtag')->middleware('auth','admin');

Route::get('/home/recipe/search/{query}/{sort?}',[RecipeController::class, 'search'])->name('recipe.search');

route::post('/recipe/save',[RecipeController::class, 'store'])->name('recipe.store')->middleware('auth','admin');

Route::get('/home/planner', function (){
    return view('profile.planner'); })->name('profile.planner')->middleware('auth');
Route::get('/home/favourites', function (){
    return view('profile.favourites'); })->name('profile.favourites')->middleware('auth');
Route::get('/home/profile', function (){
        return view('profile.profile'); })->name('profile.profile')->middleware('auth');

Route::get('/home/{choice}',[CategoryController::class, 'index'])->name('category');

Route::get('/home/admin/recipe/index', function (){
    return view('admin.recipe-index');})->name('admin.recipe-index')->middleware('auth','admin');

Route::get('/home/admin/recipe/edit/{id}',[EditController::class, 'edit'])->name('admin.recipe-edit')->middleware('auth','admin');
Route::delete('/home/admin/recipe/delete/{id}',[EditController::class, 'destroy'])->name('admin.recipe-delete')->middleware('auth','admin');
Route::post('/home/admin/recipe/update',[EditController::class, 'update'])->name('admin.recipe-update')->middleware('auth','admin');


Route::get('/blog',[BlogController::class, 'index'])->name('blog.index');

Auth::routes();

