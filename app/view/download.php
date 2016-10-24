<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 21-Oct-16
 * Time: 15:21
 */

$session =  new Session();

/*
// What we'll be outputting
header('Content-type: image/jpeg');

// It will be called:
header('Content-Disposition: attachment; filename="downloaded.jpg"');

// The PDF source is in original.pdf
readfile('4k_22.jpg');
*/

$file = $_GET['file'];

download_file($file);

function download_file( $fullPath ){

    // Must be fresh start
    if( headers_sent() )
        die('Headers Sent');

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
        die('File Not Found');

}