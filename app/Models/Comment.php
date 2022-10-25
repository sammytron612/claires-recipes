<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id', 'comment', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTO(User::class,'user_id','id');
    }

    public function recipe()
    {
        return $this->belongsTO(Recipe::class,'recipe_id','id');
    }
}
