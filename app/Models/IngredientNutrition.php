<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class IngredientNutrition extends Model
{
    protected $table = 'ingredient_nutrition';
    public $timestamps = false;
    protected $fillable = ['ingredient','nutrition'];

    public function ingredient()
    {
        return $this->belongsTo(ngredient::class);
    }
}
