<?php

namespace App\Http\Controllers;

use App\Models\HashCourse;
use App\Models\Course;

class CourseController extends Controller
{
    public function show($slug, $sort = null)
    {
       
        $temp = explode('-',$slug);
        $id = end($temp);

        if($sort == 'created_at')
        {
            $recipes = HashCourse::where('course',$id)
            ->join('recipe','hash_courses.recipe_id','=','recipe.id')
            ->orderBy('created_at','desc')
            ->paginate(12);


        }
        elseif($sort == 'views')
        {
            $recipes = HashCourse::where('course',$id)
            ->join('recipe','hash_courses.recipe_id','=','recipe.id')
            ->orderBy('views','desc')
            ->paginate(12);
        }
        elseif($sort == 'rating')
        {
            $recipes = HashCourse::where('course',$id)
            ->join('recipe','hash_courses.recipe_id','=','recipe.id')
            ->orderBy('rating','desc')
            ->paginate(12);
        }
        else
        {
            $recipes = HashCourse::where('course',$id)
            ->join('recipe','hash_courses.recipe_id','=','recipe.id')
	    ->orderBy('title')
            ->paginate(12);
            
        }


        $url = "course";
        $category = Course::find($id);
     

        return view('categories', compact(['recipes','category','url']));
    }
}
