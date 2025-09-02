<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('/sitemap/recipes.xml') }}</loc>
        <lastmod>{{ now()->toISOString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap/blog.xml') }}</loc>
        <lastmod>{{ now()->toISOString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap/pages.xml') }}</loc>
        <lastmod>{{ now()->toISOString() }}</lastmod>
    </sitemap>
</sitemapindex>
