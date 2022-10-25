<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HashMethod extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'hash_methods';
    protected $fillable = ['method','recipe_id'];


    public function MethodTitle()
    {
        return $this->hasOne(Method::class,'id','method');
    }

    public function recipes()
    {
        return $this->hasOne(Recipe::class,'id','recipe_id');
    }
}
