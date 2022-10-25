<?php
namespace App\Http\Helpers;

use App\Http\Helpers\NewIngredient;

class IngredientJson
{
    public function toJson($ingredients)
    {

        $html = $ingredients;

        libxml_use_internal_errors(true);

        $xml = new \DOMDocument();


        $xml->loadHTML($html);

        libxml_clear_errors();

        $result = array();


        foreach($xml->getElementsByTagName('li') as $li) {

            foreach($li->getElementsByTagName('a') as $links){
                $result[] = $links->nodeValue;
            }
        }

        if(!$result)
        {
            foreach($xml->getElementsByTagName('p') as $li) {

                foreach($li->getElementsByTagName('a') as $links){
                    $result[] = $links->nodeValue;
                }
            }
        }

        $newIngredient = new NewIngredient;
        $newIngredient->Add($result);

        return json_encode($result);

    }


}
