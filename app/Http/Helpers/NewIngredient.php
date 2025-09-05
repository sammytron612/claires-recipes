<?php
namespace App\Http\Helpers;

use App\Models\Ingredient;
use App\Models\IngredientNutrition;
use Illuminate\Support\Facades\Storage;


class NewIngredient
{
    public function add($missingIngredients)
    {
        foreach($missingIngredients as $ingredient)
        {
            
        
            $data = $this->getDescription($ingredient);
           

            $this->store($data, $ingredient);

        }

        return;
    }

    public function getDescription($ingredient)
    {

        $query = str_replace(' ', '%20', $ingredient);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://edamam-food-and-grocery-database.p.rapidapi.com/api/food-database/v2/parser?ingr=" . $query,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: edamam-food-and-grocery-database.p.rapidapi.com",
                "x-rapidapi-key: 02d05d32b1msh511374242b84889p14d840jsn0663553b41bd"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $text = (json_decode($response, true));
        }

        return $text;
    }


public function downloadImage($imageUrl, $ingredient)
{
    if (!$imageUrl) {
        return null;
    }

    try {
        // Create a filename based on the ingredient name
        $filename = strtolower(str_replace(' ', '-', $ingredient)) . '.jpg';
        
        // Download the image using cURL
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $imageUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        ]);
        
        $imageData = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        
        // Check if download was successful
        if ($httpCode === 200 && $imageData !== false) {
            // Store the image in the storage/app/public/ingredients directory
            $path = time() . $filename;
            Storage::disk('public')->put($path, $imageData);
            
            return $path;
        }
        
        return null;
        
    } catch (Exception $e) {
        // Log the error or handle it as needed
        return null;
    }
}

public function store($data, $ingredient)
{
   
    $ingredient_lower = strtolower($ingredient);
    $singular_form = $this->getSingularForm($ingredient);
    $plural_form = $this->getPluralForm($ingredient);
    $foodData = null;
   
    // Search through hints to find the best match
    foreach($data['hints'] as $hint) {
        if (isset($hint['food'])) {
            $label_lower = strtolower($hint['food']['label']);
            $knownAs_lower = strtolower($hint['food']['knownAs'] ?? '');
            
            // Check if ingredient contains label, label contains ingredient, or knownAs matches
            if (strpos($ingredient_lower, $label_lower) !== false || 
                strpos($label_lower, $ingredient_lower) !== false ||
                strpos($ingredient_lower, $knownAs_lower) !== false ||
                strpos($knownAs_lower, $ingredient_lower) !== false ||
                // Check singular form matches
                strpos($singular_form, $label_lower) !== false ||
                strpos($label_lower, $singular_form) !== false ||
                strpos($singular_form, $knownAs_lower) !== false ||
                strpos($knownAs_lower, $singular_form) !== false ||
                // Check plural form matches
                strpos($plural_form, $label_lower) !== false ||
                strpos($label_lower, $plural_form) !== false ||
                strpos($plural_form, $knownAs_lower) !== false ||
                strpos($knownAs_lower, $plural_form) !== false) {
                
                $foodData = $hint['food'];
                break;
            }
        }
    }
    
  
    // If no match found, use the first hint as fallback
    if (!$foodData && isset($data['hints'][0]['food'])) {
        $foodData = $data['hints'][0]['food'];
    }
    
    // Download the image if available
    $imagePath = null;
    if (isset($foodData['image'])) {
        $imagePath = $this->downloadImage($foodData['image'], $ingredient);
    }

    // Create the ingredient record
    $ingredients = Ingredient::create([
        'title' => ucfirst($ingredient),
        'slug' => strtolower(str_replace(' ', '-', $ingredient)),
        'description' => $foodData['label'] ?? null,
        'image' => $imagePath ?? "stock.jpg" // Store the local path instead of the URL
    ]);

    $ingredients->update(['slug' => (strtolower(str_replace(' ', '-', $ingredient)) . '-' . $ingredients->id)]);

    
    // Extract and save nutrients if available
    if (isset($foodData['nutrients'])) {
        $nutrients = $foodData['nutrients'];
        
        IngredientNutrition::create([
            'ingredient' => $ingredients->id,
            'nutrition' => json_encode([
                'ENERC_KCAL' => $nutrients['ENERC_KCAL'] ?? 0,
                'PROCNT' => $nutrients['PROCNT'] ?? 0,
                'FAT' => $nutrients['FAT'] ?? 0,
                'CHOCDF' => $nutrients['CHOCDF'] ?? 0,
                'FIBTG' => $nutrients['FIBTG'] ?? 0,
            ])
        ]);
    }
    dd('stop');

    return;
}
    public function getPluralForm($ingredient)
{
    $ingredient = strtolower($ingredient);
    
    // Common pluralization rules
    if (preg_match('/y$/', $ingredient)) {
        return preg_replace('/y$/', 'ies', $ingredient); // berry -> berries
    } elseif (preg_match('/f$/', $ingredient)) {
        return preg_replace('/f$/', 'ves', $ingredient); // leaf -> leaves
    } elseif (preg_match('/[sxz]$|[cs]h$/', $ingredient)) {
        return $ingredient . 'es'; // tomato -> tomatoes
    } else {
        return $ingredient . 's'; // carrot -> carrots
    }
}
}
