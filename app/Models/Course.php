<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';
    public $timestamps = false;
    protected $fillable = ['title','description','slug','image'];

    public function hashtag()
    {
        return $this->belongsTo(HashCourse::class);
    }
}

