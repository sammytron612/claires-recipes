<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use App\Models\Recipe;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function index()
    {
        $body = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
            . '<sitemap><loc>'.$this->esc(route('sitemap.recipes')).'</loc></sitemap>'
            . '<sitemap><loc>'.$this->esc(route('sitemap.blog')).'</loc></sitemap>'
            . '<sitemap><loc>'.$this->esc(route('sitemap.pages')).'</loc></sitemap>'
            . '</sitemapindex>';

        return $this->xmlResponse($body);
    }

    public function recipes()
    {
        $recipes = Recipe::select('id', 'title', 'slug', 'description', 'image', 'updated_at')
            ->orderBy('id')
            ->get();

        $body = '';

        foreach ($recipes as $recipe) {
            if (blank($recipe->slug)) {
                continue;
            }

            $body .= '<url>'
                .'<loc>'.$this->esc(route('recipe.slug', $recipe->slug)).'</loc>'
                .($recipe->updated_at ? '<lastmod>'.$recipe->updated_at->format('c').'</lastmod>' : '')
                .'<changefreq>monthly</changefreq>'
                .'<priority>0.8</priority>';

            if ($recipe->image) {
                $body .= '<image:image>'
                    .'<image:loc>'.$this->esc($this->imageUrl($recipe->image)).'</image:loc>'
                    .'<image:title>'.$this->esc($recipe->title).'</image:title>'
                    .($recipe->description ? '<image:caption>'.$this->esc($recipe->description).'</image:caption>' : '')
                    .'</image:image>';
            }

            $body .= '</url>';
        }

        return $this->xmlResponse(
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
            .' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'
            .$body
            .'</urlset>'
        );
    }

    public function blog()
    {
        $articles = BlogArticle::select('id', 'title', 'slug', 'main_image', 'updated_at')
            ->orderBy('id')
            ->get();

        $body = '';

        foreach ($articles as $article) {
            if (blank($article->slug)) {
                continue;
            }

            $body .= '<url>'
                .'<loc>'.$this->esc(route('blog.show', ['id' => $article->id, 'slug' => $article->slug])).'</loc>'
                .($article->updated_at ? '<lastmod>'.$article->updated_at->format('c').'</lastmod>' : '')
                .'<changefreq>monthly</changefreq>'
                .'<priority>0.7</priority>';

            if ($article->main_image) {
                $body .= '<image:image>'
                    .'<image:loc>'.$this->esc($this->imageUrl($article->main_image)).'</image:loc>'
                    .'<image:title>'.$this->esc($article->title).'</image:title>'
                    .'</image:image>';
            }

            $body .= '</url>';
        }

        return $this->xmlResponse(
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
            .' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'
            .$body
            .'</urlset>'
        );
    }

    public function pages()
    {
        $urls = [
            [url('/'), 'weekly', '1.0'],
            [route('blog.index'), 'weekly', '0.9'],
            [route('recipe-builder'), 'monthly', '0.8'],
            [route('categories'), 'monthly', '0.7'],
            [route('special-diet'), 'monthly', '0.7'],
        ];

        $body = '';

        foreach ($urls as [$loc, $changefreq, $priority]) {
            $body .= '<url>'
                .'<loc>'.$this->esc($loc).'</loc>'
                .'<changefreq>'.$changefreq.'</changefreq>'
                .'<priority>'.$priority.'</priority>'
                .'</url>';
        }

        return $this->xmlResponse('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.$body.'</urlset>');
    }

    /**
     * Build the XML response.
     *
     * The declaration is prepended in PHP rather than written in a Blade view:
     * a literal "<?xml" in a compiled view is parsed as a PHP short open tag
     * when short_open_tag=On, which caused the sitemap routes to 500.
     */
    private function xmlResponse(string $body)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".$body;

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    private function imageUrl(string $image): string
    {
        if (Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        return Str::startsWith($image, ['storage/', '/storage/'])
            ? asset(ltrim($image, '/'))
            : asset('storage/'.ltrim($image, '/'));
    }

    private function esc(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
