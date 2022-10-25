<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Recipe extends Model
{
    use HasFactory,Searchable;


    protected $table = 'recipe';

    protected $fillable = ['title','description','method','slug','image','author','attachment','cooking_time'];

    public function SearchableAs()
    {
	return  'recipe_index';
    }

    public function rplanner()
    {
        return $this->hasMany(planner::class);
    }


    public function recipeMethod()
    {
        return $this->hasOne(RecipeMethod::class,'recipe_id','id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class,'user_id','id');
    }

    public function commentRecipe()
    {
        return $this->hasMany(Comment::class,'recipe_id','id');
    }

    public function season()
    {
        return $this->hasMany(Seasons::class,'id','recipe_id');
    }

    public function HashIngredient()
    {
        return $this->hasMany(HashIngredient::class,'recipe_id','id');
    }

    public function HashCuisine()
    {
        return $this->hasMany(HashCuisine::class,'recipe_id','id');
    }

    public function HashCourse()
    {
        return $this->hasMany(HashCourse::class,'recipe_id','id');
    }

    public function HashDiet()
    {
        return $this->hasMany(HashDiet::class,'recipe_id','id');
    }

    public function HashMethod()
    {
        return $this->hasMany(HashMethod::class,'recipe_id','id');
    }

    public function User()
    {
        return $this->belongsTo(User::class,'author','id');
    }

    public function favourite()
    {
        return $this->hasMany(Favourites::class);
    }

    public function ingredients()
    {
        return $this->hasOne(IngredientList::class, 'id', 'recipe_id');
    }



}
