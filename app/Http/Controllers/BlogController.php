<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogArticle;
use App\Models\BlogBody;
use Illuminate\Support\Str;
use App\Http\Traits\ImageUpload;
use Storage;

class BlogController extends Controller
{
    use ImageUpload;

    public function postArticle(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'body' => 'required'

        ]);

        $file = $request->file('image');
 
        $path = $this->upload($file);

        $slug = Str::slug($request->title);

        $article = BlogArticle::create(['title' => $request->title,
                                        'main_image' => $path,
                                        'author' => $request->user()->id,
                                        'slug' => $slug                             
    ]);

        BlogBody::create(['body' => $request->body, 'ArticleId' => $article->id]);

       
        return redirect()->back()->with('message',"Success");
    }

    public function update(request $request, BlogArticle $BlogArticle)
    {
        $BlogArticle->title = $request->title;
        $slug = Str::slug($request->title);

        if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $path = $this->upload($file);
                $BlogArticle->main_image = $path;
            }
 
        $BlogArticle->slug = $slug;
        $BlogArticle->save();
        $BlogArticle->postBody->body = $request->body;
        $BlogArticle->postBody->save();

        return redirect()->route('blog.index');


    }

   
}

