<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HashDiet extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['recipe_id', 'diet'];

    public function DietTitle()
    {
        return $this->hasOne(Diet::class,'id','diet');
    }

    public function recipes()
    {
        return $this->hasOne(Recipe::class,'id','recipe_id');
    }
}
