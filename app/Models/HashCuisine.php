<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HashCuisine extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'hash_cuisines';

    protected $fillable = ['recipe_id', 'cuisine'];

    public function CuisineTitle()
    {
        return $this->hasOne(Cuisine::class,'id','cuisine');
    }

    public function recipes()
    {
        return $this->hasOne(Recipe::class,'id','recipe_id');
    }
}
