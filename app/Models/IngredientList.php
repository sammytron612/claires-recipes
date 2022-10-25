<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientList extends Model
{
    protected $table = 'ingredient_lists';
    public $timestamps = false;
    protected $primaryKey = "list_id";


    protected $fillable = ['recipe_id','list'];

    public function recipes()
    {
        return $this->belongsTo(Recipe::class ,'recipe_id', 'id');
    }


}
