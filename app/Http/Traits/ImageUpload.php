<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use Storage;

trait ImageUpload
{
    public function upload($file)
    {
        $fileName = time() . $file->getClientOriginalName();
        $path = $file->storeAs('public',$fileName);

        $path = Storage::url($path);
        
        echo json_encode(['location' => $path]);

        return $path;

    }
}