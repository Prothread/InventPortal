<?php
#IMAGE

if (isset($_SESSION['usr_id']) || isset($_SESSION['accorduserid'])) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

ob_clean();
if (isset($_GET['img'])) {

    $session = new Session();

    $image = $_GET['img'];
    $image = strip_tags($image);

    $stamp = imagecreatefrompng(DIR_PUBLIC . 'proefer.png');

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

    list($width, $height) = getimagesize($fullPath);

    //Check if we have a big or a small image
    if ($width > 10000 || $height > 10000) {

        //Resize the image
        $newWidth = $width / 5;
        $newHeight = $height / 5;

        $image = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresized($image, $im, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);


        // Get dimensions
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);

        $logoWidth = imagesx($stamp);
        $logoHeight = imagesy($stamp);

        //White background?!
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $white);
    } else {

        // Get dimensions
        $imageWidth = imagesx($im);
        $imageHeight = imagesy($im);

        $logoWidth = imagesx($stamp);
        $logoHeight = imagesy($stamp);

        //White background?!
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $white);

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
    }

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
//// Paste the logo
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
    }
}
