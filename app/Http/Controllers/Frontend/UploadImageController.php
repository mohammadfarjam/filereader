<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Buglinjo\LaravelWebp\Facades\Webp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Inline\Element\Image;
use Symfony\Component\Console\Input\Input;

class UploadImageController extends Controller
{
    public static function convertToNativePath($path) {
        $path = str_replace("\\", "/", $path);
        $path = str_replace("/", DIRECTORY_SEPARATOR, $path);

        return $path;
    }

    public function upload_image(Request $request)
    {
//        try {
            $uploadedfiles = $request->file('file');
            if (!empty($uploadedfiles)){
                foreach ($uploadedfiles as $uploadedfile){
                    $filename = $uploadedfile->getClientOriginalName();
                    $extension = $uploadedfile->getClientOriginalExtension();
                    $user_id=Auth::user()->id;
                    while (strlen($filename) <= 8) {
                        $filename = "0".$filename;
                    }
                    if ($extension == 'tif' || $extension == 'tiff') {
                        $res = $uploadedfile->storeAs('public/photos/'.$user_id,$filename);
                        $mainFile = UploadImageController::convertToNativePath(storage_path("app/" . $res));
                        $jpgFile = $mainFile . ".jpg";
                        $cmd = "C:\\xampp\\htdocs\\FileReader\\ImageMagick\\magick.exe " . $mainFile . " " . $jpgFile;
                        exec($cmd);

                        return response([
                            'preview_name' => $filename . ".jpg",
                            'photo_name' => $filename ,
                            'ext' => $extension,
                        ]);
                    }else{
                        $uploadedfile->storeAs('public/photos/'.$user_id,$filename);
                        return response([
                            'preview_name' => $filename,
                            'photo_name' => $filename ,
                            'ext' => $extension,
                        ]);

                    }
                }
//            return  Storage::files('public/photos/'.$user_id,$filename);


            }
//        }catch(\Exception $e){
//            alert($e);
//        }


    }
}









//                if ($extension == 'txt') {
//                    $address = 'C:\\xampp\\htdocs\\FileReader\\storage\\app\\public\\photos\\'.Auth::user()->id .'\\clase.txt';
//
//                    if (file_exists( $address)) {
//                        $file = fopen($address,'r');
//                        $read = fread($file,filesize($address));
//                        $clase = $read;
//                    }else{
//                        $clase = null;
//                    }
//                } else {
//                    $clase = null;
//                }
//        $res = Storage::disk('local')->putFileAs('public/photos', $uploadedfile,$filename);
//        $res = $uploadedfile->storeAs('public/photos/',$filename);
