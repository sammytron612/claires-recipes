<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Planner extends Model
{

    public $timestamps = false;
    protected $primaryKey = 'planner_id';
    protected $fillable = ['user_id','day','recipe_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

}
