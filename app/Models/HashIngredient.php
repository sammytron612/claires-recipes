<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HashIngredient extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'hash_ingredients';
    protected $fillable = ['ingredient','recipe_id'];

    public function ingredients()
    {
        return $this->hasOne(Ingredient::class,'id','ingredient');
    }

    public function recipes()
    {
        return $this->belongsTo(Recipe::class,'recipe_id','id');
    }


}
