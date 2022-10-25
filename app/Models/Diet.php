<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $table = 'diet';
    public $timestamps = false;
    protected $fillable = ['title','description','slug','image'];

    public function hashtag()
    {
        return $this->belongsTo(HashDiet::class);
    }
}
