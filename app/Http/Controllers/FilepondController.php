<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

/**
 * @property string $resizeImage
 */
class FilepondController extends Controller
{


    public function fileUpload(Request $req)
    {
      /*  $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
        ]);*/

        if ($req->file()) {
            $fileName = $req->file->getClientOriginalName();
            $fileModelName = time() . '_' . $req->file->getClientOriginalName();
            $filePath = $req->file('file')
            ->storeAs('uploads', $fileModelName);
            $resizeImage = resource_path()."/images/".$fileModelName;

            Image::load(storage_path()."\\app\\".$filePath)
                ->width(100)
                ->height(100)
                ->save($resizeImage);


            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $fileName,
                "test" => storage_path()."\\app\\".$filePath
            ]);
        }

        return response()->json([
            "success" => false,
            "message" => "File unsuccessfully uploaded",
        ]);

    }
}
