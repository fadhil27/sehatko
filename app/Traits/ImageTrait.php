<?php

namespace App\Traits;
use File;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    public function uploadImage($request, $directory, $column){
        $extension = $request->file($column)->getClientOriginalExtension();
        $filenamestore = $column.time().'.'.$extension;
        $request->file($column)->storeAs('public/'.$directory,$filenamestore);
        return $filenamestore;
    }

    public function updateImage($request, $model, $directory, $column){
        File::delete('storage/'. $directory . '/' .$model);

        $extension = $request->file($column)->getClientOriginalExtension();
        $filenamestore = time().'.'.$extension;
        $request->file($column)->storeAs('public/'.$directory,$filenamestore);
        return $filenamestore;
    }

    public function deleteImage($model, $directory){
        File::delete('storage/'. $directory . '/' .$model);
    }
}