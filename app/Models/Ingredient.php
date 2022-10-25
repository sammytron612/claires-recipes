<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    protected $table = 'ingredient';
    public $timestamps = false;
    protected $fillable = ['title','description','slug','image'];

    public function hashtag()
    {
        return $this->belongsTo(HashIngredient::class);
    }

    public function nutrition()
    {
        return $this->hasOne(IngredientNutrition::class);
    }
}
