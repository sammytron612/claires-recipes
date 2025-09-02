<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($recipes as $recipe)
    <url>
        <loc>{{ url('/recipe/' . $recipe->slug) }}</loc>
        <lastmod>{{ $recipe->updated_at->toISOString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
        <image:image>
            <image:loc>{{ asset('storage/' . $recipe->image) }}</image:loc>
            <image:title>{{ $recipe->title }}</image:title>
            <image:caption>{{ $recipe->description }}</image:caption>
        </image:image>
    </url>
    @endforeach
</urlset>
