<?php
namespace App\Http\Helpers;

use App\Models\Ingredient;
use App\Models\IngredientNutrition;
use Illuminate\Support\Facades\Storage;


class NewIngredient
{
    private function addtoDB($json, $id)
    {

        if(isset($json[0]['food']['image']))
        {
            //dd($json);
            $image = $json[0]['food']['image'];
            $ext = explode('.',$image);
            $name = md5($image . microtime()) . '.' . end($ext);

            $content = file_get_contents($image);

           Storage::disk('public')->put($name, $content);

        }
        else {$name = "stock.jpg";}


        if(isset($json[0]['food']['nutrients']))
        {
            $nutrition = json_encode($json[0]['food']['nutrients']);
            $data = ['ingredient' => $id,
                    'nutrition' => $nutrition];
            IngredientNutrition::create($data);
        }

        return $name;

    }


    private function getDescription($ingredient)
    {

        $temp = explode(' ',$ingredient);

        if(count($temp) == 1)
        {
            $query = $temp[0];

        }
        else
        {
            $query = "";
            for($i=0;$i<count($temp);$i++)
            {
                $query .= $temp[$i] . '%20';
            }
            $query = substr($query, 0, -3);

        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://edamam-food-and-grocery-database.p.rapidapi.com/parser?ingr=" . $query,
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


        return $text['parsed'];


    }

    public function Add($ingredients)
    {


        foreach($ingredients as $ingredient)
        {
            if(!$ingredient) {break;}

            $exists = Ingredient::where('title','like',$ingredient.'%')->exists();

            if(!$exists && $ingredient)
            {
                $data = ['title' => ucfirst($ingredient)];
                $slug = (str_replace(' ', '-', strtolower($ingredient)));
                $id = Ingredient::create($data)->id;

                $array = $this->getDescription($ingredient);

                $imageName = $this->addtoDB($array, $id);
                Ingredient::where('id', $id)->update(['slug' => $slug . '-' . $id, 'image' => $imageName]);


            }


        }


    }


}
