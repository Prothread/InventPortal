<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 21-Oct-16
 * Time: 15:21
 */

$session =  new Session();

if($user->getPermission($permgroup, 'CAN_ACCORD') == 1){

}
else if($user->getPermission($permgroup, 'CAN_EDIT_ACCORD')) {

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$file = $_GET['file'];

download_file($file);

function download_file( $Path ){

    // Must be fresh start
    if( headers_sent() ) {
        $fullPath = DIR_IMAGE . $Path;

        $path_parts = pathinfo($fullPath);
        $ext = strtolower($path_parts["extension"]);

        // Determine Content Type
        switch ($ext) {
            case "pdf":
                echo '<a href="' . 'app/uploads/' . $Path . '">Download PDF</a>';
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
// Get dimensions
        $imageWidth = imagesx($im);
        $imageHeight = imagesy($im);

        ob_start();
            imagepng($im);
            $contents = ob_get_contents();
        ob_end_clean();

        $dataUri = 'data:image/' . 'png' . ';base64,' . base64_encode($contents);
        echo '<img src="'. $dataUri .'">';
        echo '<br />';
        echo 'U can download the image by clicking with the right mouse button and then clicking "save image as"';
        return true;
    }
    $fullPath = DIR_PUBLIC . $Path;

    // Required for some browsers
    if(ini_get('zlib.output_compression'))
        ini_set('zlib.output_compression', 'Off');

    // File Exists?
    if( file_exists($fullPath) ){

        // Parse Info / Get Extension
        $fsize = filesize($fullPath);
        $path_parts = pathinfo($fullPath);
        $ext = strtolower($path_parts["extension"]);

        // Determine Content Type
        switch ($ext) {
            case "pdf": $ctype="application/pdf"; break;
            //case "zip": $ctype="application/zip"; break;
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "jpeg":
            case "jpg": $ctype="image/jpg"; break;
            default: $ctype="application/force-download";
        }

        header("Pragma: public"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); // required for certain browsers
        header("Content-Type: $ctype");
        header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" );
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".$fsize);
        ob_clean();
        flush();
        readfile( $fullPath );

    } else
        die('<div class="alert alert-danger" role="alert">Het bestand dat u probeerde te downloaden kan niet worden gevonden.</div>');
}