<?php

if (isset($_FILES['myFile'])) {
    $error = 0;

    $myFile = $_FILES['myFile'];
    $fileCount = count($myFile["name"]);

    $images = array();
    $unique_names = array();

    for ($i = 0; $i < $fileCount; $i++) {

        $test = $myFile['name'][$i];
        $test1 = $myFile['tmp_name'][$i];

        $target_dir = "../app/uploads/";
        $target_file = $target_dir . $test;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        /*
        if (file_exists($target_file)) {
            $error = 1;
            echo $test ." already exists!";
            ?><br/><?php
        }
        */

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
            $error = 1;
        }

        if ($myFile["size"][$i] > 10485760) {
            $error = 1;
            header('Location: index.php?page=uploadoverview');
            Session::flash('message', 'Het geüploade bestand is te groot');
        }

        if ($error == 0) {
            $imageId = 1;
            $unique_name = pathinfo($test, PATHINFO_FILENAME) . "_" . ($imageId) . '.' . $imageFileType;
            $unique_name = preg_replace('/\s+/', '-', $unique_name);
            $uniqfile = $target_dir . $unique_name;

            if(file_exists($uniqfile)) {
                $uniq = pathinfo($uniqfile);
                $unique_name = $uniq['filename'] . "-1" . '.' . $uniq['extension'];
                $uniqfile = $target_dir . $unique_name;
            }

            array_push($unique_names, $unique_name);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            if (move_uploaded_file($test1, $uniqfile)) {
                array_push($images, $test);
            }

        } else {

        }
    }
}