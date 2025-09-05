<?php
namespace App\Http\Helpers;

use App\Http\Helpers\CheckIngredients;
use App\Models\Ingredient;

class CheckIngredients
{
    public function check($ingredients)
    {
        // Array to store ingredients that don't exist in the database
        $missingIngredients = [];
        
        // Loop through each ingredient in the input array
        foreach ($ingredients as $ingredient) {
            // Clean up the ingredient name (trim whitespace, capitalize first letter)
            $cleanIngredient = trim($ingredient);
            
            if (!empty($cleanIngredient)) {
                // Check if the ingredient exists in the Ingredient model
                $exists = Ingredient::where('title', ucfirst($cleanIngredient))->exists();
                
                // If it doesn't exist, add it to the missing ingredients array
                if (!$exists) {
                    $missingIngredients[] = $cleanIngredient;
                }
            }
        }

        $newIngredient = new NewIngredient;
        $newIngredient->add($missingIngredients);

       
        return;
    }


}
