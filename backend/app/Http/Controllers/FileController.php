<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;

class FileController extends Controller
{
    public static function base64ToFile(String $fileBase64 = "file", String $fileName = "fileName", String $directoryName = "files")
    {
        $url = "";
        try {
            // Getting the extesion
            $ext = explode('/', explode(':', substr($fileBase64, 0, strpos($fileBase64, ';')))[1])[1];
            //Getting the data from the base64 string
            $fileArray = explode(',', $fileBase64);
            //Creating the name
            $path = "public/$directoryName/$fileName.$ext";
            //Storing the file
            Storage::put($path, base64_decode($fileArray[1]));
            //Getting the url to the file
            $url = Storage::url($path);
            // $clasificationPlace->icon_marker = $url;
        } catch (\Throwable $th) {
            // throw $th;
            $url = "";
        }

        return $url;
    }
    // public static function base64ToFile(String $fileBase64 = "file", String $fileName = "fileName", String $directoryName = "files")
    // {
    //     $url = "";
    //     try {
    //         // Getting the extesion
    //         $ext = explode('/', explode(':', substr($fileBase64, 0, strpos($fileBase64, ';')))[1])[1];
    //         //Getting the data from the base64 string
    //         $fileArray = explode(',', $fileBase64);
    //         //Creating the name
    //         $path = "storage/$directoryName/$fileName.$ext";
    //         //Storing the file
    //         Storage::put($path, base64_decode($fileArray[1]));
    //         //Getting the url to the file
    //         $url = Storage::url($path);
    //         // $clasificationPlace->icon_marker = $url;
    //     } catch (\Throwable $th) {
    //         // throw $th;
    //         // dd($th);
    //         $url = "";
    //     }

    //     return $url;
    // }

    /**
     * Verify that the file is an image
     */
    public static function verifyTypeImage($file)
    {
        try {
            $ext = explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];

            if ($ext == "svg+xml" || $ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg") {
                // dd($ext);
                return true;
            }
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public static function uploadPhoto(string $file, string $fileName, string $oldPhoto)
    {
        // dd($file, $fileName);
        try {
            // Getting the extesion
            $oldPhoto = str_replace('/storage/', '/app/public/', $oldPhoto);
            // dd(File::exists(storage_path().$oldPhoto), storage_path().$oldPhoto, storage_path());
            File::delete(storage_path() . $oldPhoto);
            $ext = explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
            if ($ext == 'svg+xml') {
                $ext = 'svg';
            }
            //Getting the data from the base64 string
            $file = explode(',', $file);
            //Creating the name
            $fileName = "storage/photos/$fileName.$ext";
            //Storing the file
            $file = Storage::put($fileName, base64_decode($file[1]));
            //Getting the url to the file
            $url = Storage::url($fileName);

            return $url;
        } catch (\Throwable $th) {
            throw $th;
            // return '/img/profile.svg';
        }
    }
}
