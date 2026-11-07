{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($articles as $article)
        @continue(blank($article->slug))
    <url>
        <loc>{{ route('blog.show', ['id' => $article->id, 'slug' => $article->slug]) }}</loc>
        @if($article->updated_at)
        <lastmod>{{ $article->updated_at->format('c') }}</lastmod>
        @endif
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>

        @if($article->main_image)
        @php
            $imageUrl = $article->main_image;
            if (!\Illuminate\Support\Str::startsWith($imageUrl, ['http://', 'https://'])) {
                $imageUrl = \Illuminate\Support\Str::startsWith($imageUrl, ['storage/', '/storage/'])
                    ? asset(ltrim($imageUrl, '/'))
                    : asset('storage/' . ltrim($imageUrl, '/'));
            }
        @endphp
        <image:image>
            <image:loc>{{ $imageUrl }}</image:loc>
            <image:title>{{ $article->title }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach
</urlset>