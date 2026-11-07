{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($recipes as $recipe)
        @continue(blank($recipe->slug))
    <url>
        <loc>{{ route('recipe.slug', $recipe->slug) }}</loc>
        @if($recipe->updated_at)
        <lastmod>{{ $recipe->updated_at->format('c') }}</lastmod>
        @endif
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
        @if($recipe->image)
        @php
            $imageUrl = $recipe->image;
            if (!\Illuminate\Support\Str::startsWith($imageUrl, ['http://', 'https://'])) {
                $imageUrl = \Illuminate\Support\Str::startsWith($imageUrl, ['storage/', '/storage/'])
                    ? asset(ltrim($imageUrl, '/'))
                    : asset('storage/' . ltrim($imageUrl, '/'));
            }
        @endphp
        <image:image>
            <image:loc>{{ $imageUrl }}</image:loc>
            <image:title>{{ $recipe->title }}</image:title>
            @if($recipe->description)
            <image:caption>{{ $recipe->description }}</image:caption>
            @endif
        </image:image>
        @endif
    </url>
    @endforeach
</urlset>
