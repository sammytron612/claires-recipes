<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeMethod extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'recipe_method';
    protected $fillable = ['description', 'recipe_id'];

    public function recipeMethod()
    {
        return $this->belongsTo(Recipe::class,'id','recipe_id');
    }
}
