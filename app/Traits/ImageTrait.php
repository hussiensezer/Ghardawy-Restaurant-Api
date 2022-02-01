<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    /**
     * Store Image And In Update Can Delete The Old One
     * @param  $photo -> Accept Request Of File
     * @param  $storageName -> the file in config -> file
     * @param  $fileName -> the file will stored in
     * @return string
     */
    public function imageStore ($photo,$storageName,$fileName) {

        $input_file =  $photo->getClientOriginalName();
        $file_Extensions =  $photo->getClientOriginalExtension();
        $hashPath = md5($input_file .  now()) . "." . $file_Extensions ;
        $dataPath = Storage::disk($storageName)->putFileAs($fileName, $photo, $hashPath);
        return $hashPath;
    }// End ImageStore

    /**
     * @param  $storageName -> the file in config -> file
     * @param  $fileName -> the file will stored in
     * @param  $deleteImageSource -> the name of image to delete from file
     * @return NULL
     */
    public function imageDestroy($storageName,$fileName,$deleteImageSource) {
        return  Storage::disk($storageName)->delete($fileName . '/' . $deleteImageSource);
    }

}
