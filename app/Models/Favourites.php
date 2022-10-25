<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{

    protected $table = 'favourites';
    protected $primaryKey = "fav_id";

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
