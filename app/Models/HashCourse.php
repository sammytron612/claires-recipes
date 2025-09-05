<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HashCourse extends Model
{
    protected $fillable = ['recipe_id', 'course'];

    public $timestamps = false;

    public function CourseTitle()
    {
        return $this->hasOne(Course::class,'id','course');
    }

    public function recipes()
    {
        return $this->hasOne(Recipe::class,'id','recipe_id');
    }
}
