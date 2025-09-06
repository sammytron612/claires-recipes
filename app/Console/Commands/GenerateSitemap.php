<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\File;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate static sitemap files';

    public function handle()
    {
        $controller = new SitemapController();
        
        // Generate main sitemap
        $indexContent = $controller->index()->getContent();
        File::put(public_path('sitemap.xml'), $indexContent);
        
        // Generate recipes sitemap
        $recipesContent = $controller->recipes()->getContent();
        File::put(public_path('sitemap-recipes.xml'), $recipesContent);
        
        // Generate blog sitemap
        $blogContent = $controller->blog()->getContent();
        File::put(public_path('sitemap-blog.xml'), $blogContent);
        
        $this->info('Sitemaps generated successfully!');
    }
}
?>