<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class InspirationGenerate {
    public static function createAndSaveImage(string $limit, string $tag): array {
        $imgData = json_decode(file_get_contents("https://api.waifu.im/search?included_tags=$tag&is_nsfw=false"));
        $url = $imgData->images[0]->url;
        $source = $imgData->images[0]->source;

        $info = pathinfo($url);
        $contents = file_get_contents($url);
        $file = '/tmp/' . $info['basename'];
        file_put_contents($file, $contents);

        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $img = ($extension == 'jpeg' || $extension == 'jpg') ? imagecreatefromjpeg($file) : imagecreatefrompng($file);

        $txt = substr(json_decode(file_get_contents("https://animechan.xyz/api/random"))->quote, 0, $limit);
        $fontFile = "./Roboto.ttf";
        $fontSize = imagesx($img)/$limit*1.5;
        $fontColor = imagecolorallocate($img, 255, 0, 0);

        imagettftext($img, $fontSize, 0, 0, $fontSize, $fontColor, $fontFile, $txt);

        imagepng($img, $file);

        $uploaded_file = new UploadedFile($file, $info['basename']);
        
        $imgPath = Storage::disk("public")->put('images', $uploaded_file);
        return [$imgPath, $txt, $source];
    }
}