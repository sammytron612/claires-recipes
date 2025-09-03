<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredients extends Model
{
    protected $table = 'recipe_ingredients';
    protected $primaryKey = 'recipeid';
    public $incrementing = false;
    public $timestamps = false;
    protected $casts = [
        'ingredients' => 'array',
    ];
    protected $fillable = ['ingredients','recipeid'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipeid');
    }
}
