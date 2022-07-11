<?php

namespace App\Services;

class FileCompressionService
{
    // COMPRESSION FEATURE
    public static function compressImage($source, $destination, $quality)
    {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);
        imagejpeg($image, $destination, $quality);
    }

    public static function compressImageToCustomExt($source, $path, $filename, $ext)
    {
        // set custom file name
        $filenameAfterProcess = $filename.'.'.$ext;

        // create raw image
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        }
        elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        }
        elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        } elseif ($info['mime'] == 'image/webp') {
            $source->move($path, $filenameAfterProcess);
            return $filenameAfterProcess;
        }

        // resize process
        $imageSize = getImageSize($source);
        $imageWidth = $imageSize[0];
        $imageHeight = $imageSize[1];
        // if resolution more than 1080p
        if($imageWidth >= 960) {
            $DESIRED_WIDTH = 960;
        } else {
            $DESIRED_WIDTH = $imageWidth;
        }
        $proportionalHeight = round(($DESIRED_WIDTH * $imageHeight) / $imageWidth);
        $resizedImage = imageCreateTrueColor($DESIRED_WIDTH, $proportionalHeight);
        imageCopyResampled($resizedImage, $image, 0, 0, 0, 0, $DESIRED_WIDTH+1, $proportionalHeight+1, $imageWidth, $imageHeight);

        // check resolution to decided quality compress
        if($DESIRED_WIDTH >= 960 && $source->getSize() > 500000) {
            $quality = 40;
        } elseif($DESIRED_WIDTH >= 960 && $source->getSize() >= 100000) {
            $quality = 80;
        } else {
            $quality = 85;
        }

        // convert, compress & export image to path
        if($ext == 'webp') {
            imagewebp($resizedImage, $path.'/'.$filenameAfterProcess, $quality);
        } elseif($ext == 'jpg') {
            imagejpeg($resizedImage, $path.'/'.$filenameAfterProcess, $quality);
        }

        // clear junk image
        imageDestroy($image);
        imageDestroy($resizedImage);

        return $filenameAfterProcess;
    }
}
