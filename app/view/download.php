<?php
#PROCESSES DOWNLOAD

$session = new Session();

    $file = $_GET['file'];

    $image = new ImageController();
    $myimage = $image->getImageByName($file);

    if (substr($file, -3) == 'pdf') {
        $block->Redirect('app/uploads/' . $file);
    }

    if ($myimage['downloadable'] == '1') {
        true;
    } else {
        $block->Redirect('index.php');
        Session::flash('error', 'De afbeelding kan nog niet gedownload worden.');
        return false;
    }
    if ($user->getPermission($permgroup, 'CAN_ACCORD') == 1 && $myimage['downloadable'] == '1') {

    } else if ($user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1 && $myimage['downloadable'] == '1') {

    } else {
        $block->Redirect('index.php');
        Session::flash('error', 'U heeft hier geen rechten voor.');
    }

    download_file($file);

    function download_file($Path)
    {
        // Must be fresh start
        if (headers_sent()) {
            $fullPath = DIR_IMAGE . $Path;

            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);

            if (file_exists($fullPath)) {
                // Determine Content Type
                switch ($ext) {
                    case "pdf":
                        echo '<a href="' . 'app/uploads/' . $Path . '">PDF openen</a>';
                        echo '<object data="app/uploads/' . $Path . '" type="application/pdf" style="width:400px; height:600px"><embed data="app/uploads/' . $Path . '" type="application/pdf"></object>';
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

            ob_start();
            imagepng($im);
            $contents = ob_get_contents();
            ob_end_clean();

            $dataUri = 'data:image/' . 'png' . ';base64,' . base64_encode($contents);
            echo '<img src="' . $dataUri . '">';
            echo '<br />';
            echo 'U kan de foto opslaan met rechtermuisklik (op de foto) + "Afbeelding opslaan als"';
            return true;
        }
        $fullPath = DIR_IMAGE . $Path;

        // Required for some browsers
        if (ini_get('zlib.output_compression'))
            ini_set('zlib.output_compression', 'Off');

        // File Exists?
        if (file_exists($fullPath)) {

            // Parse Info / Get Extension
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);

            // Determine Content Type
            switch ($ext) {
                case "pdf":
                    $ctype = "application/pdf";
                    break;
                //case "zip": $ctype="application/zip"; break;
                case "gif":
                    $ctype = "image/gif";
                    break;
                case "png":
                    $ctype = "image/png";
                    break;
                case "jpeg":
                case "jpg":
                    $ctype = "image/jpg";
                    break;
                default:
                    $ctype = "application/force-download";
            }

            header("Pragma: public"); // required
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false); // required for certain browsers
            header("Content-Type: $ctype");
            header("Content-Disposition: attachment; filename=\"" . basename($fullPath) . "\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . $fsize);
            ob_clean();
            flush();
            readfile($fullPath);

        } else {
            die('<div class="alert alert-danger" role="alert">Het bestand dat u probeerde te downloaden kan niet worden gevonden.</div>');
        }
    }
