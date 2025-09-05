<?php
namespace App\Http\Services;

use App\Models\RecipeIngredients;

class IngredientService
{
   
    public function extract($method)
    {
        $ingredients = [];
        if ($method) {
                $html = str_replace(['\\/', '\\r', '\\n', '\\u{A0}'], ['/', '', '', ' '], $method);
                if (preg_match_all('/<a[^>]*>(.*?)<\/a>/is', $html, $matches)) {
                    foreach ($matches[1] as $ingredient) {
                        $ingredients[] = trim(html_entity_decode($ingredient));
                    }
                }
            }

        return $ingredients;

    }
}
?>