<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasonal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['recipe_id'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class,'recipe_id','id');
    }
}
