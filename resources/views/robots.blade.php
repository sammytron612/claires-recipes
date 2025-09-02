User-agent: *
Allow: /

# Sitemap
Sitemap: {{ url('/sitemap.xml') }}

# Block admin areas
Disallow: /admin/
Disallow: /profile/
Disallow: /login
Disallow: /register

# Allow important pages
Allow: /
Allow: /blog
Allow: /recipe-builder
Allow: /recipe/
Allow: /post/

# Crawl delay
Crawl-delay: 1
