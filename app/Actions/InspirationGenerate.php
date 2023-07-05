<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class InspirationGenerate {
    public static function createAndSaveImage(string $limit): string {
        $imgData = json_decode(file_get_contents("https://nekos.best/api/v2/waifu"));
        $url = $imgData->results[0]->url;

        $info = pathinfo($url);
        $contents = file_get_contents($url);
        $file = '/tmp/' . $info['basename'];
        file_put_contents($file, $contents);

        $img = imagecreatefrompng($file);

        $txt = json_decode(file_get_contents("https://animechan.xyz/api/random"))->quote;
        $fontFile = "./Roboto.ttf";
        $fontSize = imagesx($img)/$limit*1.5;
        $fontColor = imagecolorallocate($img, 255, 0, 0);

        imagettftext($img, $fontSize, 0, 0, $fontSize, $fontColor, $fontFile, substr($txt, 0, $limit));

        imagepng($img, $file);

        $uploaded_file = new UploadedFile($file, $info['basename']);
        
        return Storage::disk("public")->put('images', $uploaded_file);
    }
}