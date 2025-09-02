<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\BlogArticle;
use Carbon\Carbon;

class SitemapController extends Controller
{
    public function index()
    {
        $recipes = Recipe::select('id', 'slug', 'updated_at')->get();
        $blogArticles = BlogArticle::select('id', 'slug', 'updated_at')->get();
        
        $content = view('sitemap.index', compact('recipes', 'blogArticles'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
    
    public function recipes()
    {
        $recipes = Recipe::with(['User', 'commentRecipe'])
            ->select('id', 'title', 'slug', 'description', 'image', 'author', 'updated_at', 'created_at')
            ->get();
        
        $content = view('sitemap.recipes', compact('recipes'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
    
    public function blog()
    {
        $articles = BlogArticle::with('articleAuthor')
            ->select('id', 'title', 'slug', 'main_image', 'author', 'updated_at', 'created_at')
            ->get();
        
        $content = view('sitemap.blog', compact('articles'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
