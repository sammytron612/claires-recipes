<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use App\Models\Recipe;

class SitemapController extends Controller
{
    public function index()
    {
        return $this->xmlResponse('sitemap.index');
    }

    public function recipes()
    {
        $recipes = Recipe::select('id', 'title', 'slug', 'description', 'image', 'updated_at')
            ->orderBy('id')
            ->get();

        return $this->xmlResponse('sitemap.recipes', compact('recipes'));
    }

    public function blog()
    {
        $articles = BlogArticle::select('id', 'title', 'slug', 'main_image', 'updated_at')
            ->orderBy('id')
            ->get();

        return $this->xmlResponse('sitemap.blog', compact('articles'));
    }

    public function pages()
    {
        return $this->xmlResponse('sitemap.pages');
    }

    private function xmlResponse(string $view, array $data = [])
    {
        return response(view($view, $data)->render(), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
