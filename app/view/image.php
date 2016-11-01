<?php

ob_clean();
//header('Content-type: image/png');

if(isset($_GET['img'])) {
    $image = $_GET['img'];

    $stamp = imagecreatefrompng(DIR_PUBLIC . 'proef_groot.png');
    //$im = imagecreatefromjpeg(DIR_IMAGE . $image);

    $fullPath = DIR_IMAGE . $image;

    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);

    // Determine Content Type
    switch ($ext) {
        case "pdf":
            $ctype="application/pdf";
            break;
        //case "zip": $ctype="application/zip"; break;
        case "gif":
            $ctype="image/gif";
            break;
        case "png":
            $ctype="image/png";
            $im = imagecreatefrompng($fullPath);
            break;
        case "jpeg":
        case "jpg":
            $ctype="image/jpg";
            $im = imagecreatefromjpeg($fullPath);
        break;
        default:
            $ctype="application/force-download";
    }

// Get dimensions
    $imageWidth = imagesx($im);
    $imageHeight = imagesy($im);

    $logoWidth = imagesx($stamp);
    $logoHeight = imagesy($stamp);

//White background?!
    $image = imagecreatetruecolor($imageWidth, $imageHeight);
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $white);

// Paste the logo
    imagecopy(
// destination
        $image,
        // source
        $im,
        // destination x and y
        0, 0,
        // source x and y
        0, 0,
        // width and height of the area of the source to copy
        $imageWidth, $imageHeight
    );


//Get new dimensions
    $imgWidth = imagesx($image);
    $imgHeight = imagesy($image);

// Paste the logo
    imagecopy(
        // destination
        $image,
        // source
        $stamp,
        // destination x and y
        ($imageWidth - $logoWidth) /2, ($imageHeight - $logoHeight) /2,
        // source x and y
        0, 0,

        /*
        //Width and height wannabe
        $imgWidth/1.2, $imgHeight/1.2,
        */

        // width and height of the area of the source to copy
        $logoWidth, $logoHeight
    );

// Output and free memory
    header("Content-Type: $ctype");
    imagepng($image);
    imagedestroy($image);
}