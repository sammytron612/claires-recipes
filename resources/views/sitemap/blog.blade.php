<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($articles as $article)
    <url>
        <loc>{{ route('blog.show', ['id' => $article->id, 'slug' => $article->slug]) }}</loc>
        <lastmod>{{ $article->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
        
        @if($article->main_image)
        <image:image>
            @php
                // Ensure full URL for main image
                $imageUrl = $article->main_image;
                if (!str_starts_with($imageUrl, 'http')) {
                    // Handle storage URLs
                    if (str_starts_with($imageUrl, 'storage/')) {
                        $imageUrl = asset($imageUrl);
                    } elseif (str_starts_with($imageUrl, '/storage/')) {
                        $imageUrl = url($imageUrl);
                    } else {
                        $imageUrl = asset('storage/' . $imageUrl);
                    }
                }
            @endphp
            <image:loc>{{ $imageUrl }}</image:loc>
            <image:title>{{ $article->title }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach
</urlset>