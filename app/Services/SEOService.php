<?php

namespace App\Services;

class SEOService
{
    public static function generateRecipeStructuredData($recipe)
    {
        $ingredients = [];
        if ($recipe->HashIngredient) {
            $ingredients = $recipe->HashIngredient->map(function($hashIngredient) {
                return $hashIngredient->ingredients ? $hashIngredient->ingredients->name : null;
            })->filter()->values()->toArray();
        }
        
        $instructions = [];
        if ($recipe->recipeMethod && $recipe->recipeMethod->method) {
            $methods = json_decode($recipe->recipeMethod->method, true);
            if (is_array($methods)) {
                foreach ($methods as $index => $method) {
                    $instructions[] = [
                        "@type" => "HowToStep",
                        "name" => "Step " . ($index + 1),
                        "text" => strip_tags($method['method'] ?? $method)
                    ];
                }
            }
        }
        
        $aggregateRating = null;
        if ($recipe->commentRecipe && $recipe->commentRecipe->count() > 0) {
            $avgRating = $recipe->commentRecipe->avg('rating');
            $ratingCount = $recipe->commentRecipe->where('rating', '>', 0)->count();
            
            if ($ratingCount > 0) {
                $aggregateRating = [
                    "@type" => "AggregateRating",
                    "ratingValue" => round($avgRating, 1),
                    "reviewCount" => $ratingCount,
                    "bestRating" => "5",
                    "worstRating" => "1"
                ];
            }
        }
        
        $structuredData = [
            "@context" => "https://schema.org/",
            "@type" => "Recipe",
            "name" => $recipe->title,
            "description" => $recipe->description,
            "image" => [asset('storage/' . $recipe->image)],
            "author" => [
                "@type" => "Person",
                "name" => $recipe->User->name
            ],
            "datePublished" => $recipe->created_at->toISOString(),
            "dateModified" => $recipe->updated_at->toISOString(),
            "prepTime" => $recipe->cooking_time ? "PT" . $recipe->cooking_time . "M" : null,
            "cookTime" => $recipe->cooking_time ? "PT" . $recipe->cooking_time . "M" : null,
            "totalTime" => $recipe->cooking_time ? "PT" . $recipe->cooking_time . "M" : null,
            "recipeCategory" => $recipe->Course ? $recipe->Course->name : "Main Course",
            "recipeCuisine" => $recipe->Cuisine ? $recipe->Cuisine->name : "International",
            "recipeYield" => "4 servings",
            "nutrition" => [
                "@type" => "NutritionInformation",
                "calories" => "Varies"
            ]
        ];
        
        if (!empty($ingredients)) {
            $structuredData["recipeIngredient"] = $ingredients;
        }
        
        if (!empty($instructions)) {
            $structuredData["recipeInstructions"] = $instructions;
        }
        
        if ($aggregateRating) {
            $structuredData["aggregateRating"] = $aggregateRating;
        }
        
        return $structuredData;
    }
    
    public static function generateBlogStructuredData($article, $body)
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $article->title,
            "description" => \Illuminate\Support\Str::limit(strip_tags($body->body), 155),
            "image" => [$article->main_image],
            "author" => [
                "@type" => "Person",
                "name" => $article->articleAuthor->name
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "Claire's Recipes",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => asset('storage/fb2e60213d4b9e175f23e08bbc8ed01f.jpg')
                ]
            ],
            "datePublished" => $article->created_at->toISOString(),
            "dateModified" => $article->updated_at->toISOString(),
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => url()->current()
            ]
        ];
    }
    
    public static function generateKeywords($title, $category = null, $cuisine = null, $additional = [])
    {
        $keywords = collect([$title, $category, $cuisine, 'recipe', 'cooking', 'homemade'])
            ->merge($additional)
            ->filter()
            ->unique()
            ->implode(', ');
        
        return $keywords;
    }
}
