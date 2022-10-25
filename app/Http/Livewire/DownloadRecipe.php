<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recipe;


class DownloadRecipe extends Component
{
    public $recipe;

    public function render()
    {
        return view('livewire.download-recipe');
    }

    public function download(Recipe $recipe)
    {

        if($recipe->attachment)
        {
            $url = public_path() . "storage/" . $recipe->attachment;
            $infoPath = pathinfo($url);
            $mime =  mime_content_type($url);
            $extension = $infoPath['extension'];

            $headers =[
                'Content-Description' => 'File Transfer',
                'Content-Type' => $mime,
            ];


            $fileName = $recipe->title . '.' . $extension;
            return response()->download('storage/' . $recipe->attachment, $fileName, $headers);
        }
        else
        {
            return;
        }

    }

}
