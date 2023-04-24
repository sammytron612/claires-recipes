<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ImageUpload;

use Storage;

class ImageController extends Controller
{
    use ImageUpload;

    public function imageUpload(Request $request)
    {
        $file = $request->file('file');

        $this->upload($file);

    }
}
