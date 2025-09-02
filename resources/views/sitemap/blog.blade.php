<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($articles as $article)
    <url>
        <loc>{{ route('blog.show', ['id' => $article->id, 'slug' => $article->slug]) }}</loc>
        <lastmod>{{ $article->updated_at->toISOString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
        <image:image>
            <image:loc>{{ $article->main_image }}</image:loc>
            <image:title>{{ $article->title }}</image:title>
        </image:image>
    </url>
    @endforeach
</urlset>
