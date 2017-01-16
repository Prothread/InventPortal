<?php
#IMAGE

if (isset($_SESSION['usr_id']) || isset($_SESSION['accorduserid'])) {

}
else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

ob_clean();
//header('Content-type: image/png');
if (isset($_GET['img'])) {

    $session = new Session();

    $image = $_GET['img'];
    $image = strip_tags($image);

    $stamp = imagecreatefrompng(DIR_PUBLIC . 'proefer.png');
    //$im = imagecreatefromjpeg(DIR_IMAGE . $image);

    $fullPath = DIR_IMAGE . $image;

    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);

    // Determine Content Type
    if (file_exists($fullPath)) {
        switch ($ext) {
            case "pdf":
                $ctype = "application/pdf";
                $filename = 'Offerte.pdf'; /* Note: Always use .pdf at the end. */

                header('Content-type: application/pdf');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . filesize($fullPath));
                header('Accept-Ranges: bytes');

                readfile($fullPath);
                return true;
                break;
            //case "zip": $ctype="application/zip"; break;
            case "gif":
                $ctype = "image/gif";
                break;
            case "png":
                $ctype = "image/png";
                $im = imagecreatefrompng($fullPath);
                break;
            case "jpeg":
            case "jpg":
                $ctype = "image/jpg";
                $im = imagecreatefromjpeg($fullPath);
                break;
            default:
                $ctype = "application/force-download";
        }
    } else {
        echo 'Dit bestand bestaat niet';
        return false;
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

    if ($imgWidth < $logoWidth) {
        imagecopyresampled(
        // destination
            $image,
            // source
            $stamp,
            // destination x and y
            0, 0,
            // source x and y
            0, 0,


            //Width and height wannabe
            $imgWidth, $imgHeight,


            // width and height of the area of the source to copy
            $logoWidth, $logoHeight
        );
    } else {
// Paste the logo
        imagecopy(
        // destination
            $image,
            // source
            $stamp,
            // destination x and y
            ($imageWidth - $logoWidth) / 2, ($imageHeight - $logoHeight) / 2,
            // source x and y
            0, 0,

            // width and height of the area of the source to copy
            $logoWidth, $logoHeight
        );
    }

    if (!headers_sent()) {
// Output and free memory
        header("Content-Type: $ctype");
        imagepng($image);
        imagedestroy($image);
    } else {
        ob_start();
        imagepng($image);
        $contents = ob_get_contents();
        ob_end_clean();

        $dataUri = 'data:image/' . 'png' . ';base64,' . base64_encode($contents);
        echo '<img src="' . $dataUri . '">';

        //Display normal image:
        /*
            $type = pathinfo($fullPath, PATHINFO_EXTENSION);
            $data = file_get_contents($fullPath);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            echo '<img src="'. $base64 .'">';
        */
    }
}
