<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 29-Sep-16
 * Time: 12:47
 */


/*
$fileCount = count($_FILES['myFile']["name"]);
for ($i = 0; $i < $fileCount; $i++) {


    $uploadOk = 1;


// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["myFile"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           // echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
           // echo '<img src="../app/uploads/'.basename($_FILES["fileToUpload"]["name"]).'">';




        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
*/

if (isset($_FILES['myFile'])) {
    $myFile = $_FILES['myFile'];
    $fileCount = count($myFile["name"]);
    for ($i = 0; $i < $fileCount; $i++) {

        $test = $myFile['name'][$i];
        $test1 = $myFile['tmp_name'][$i];

            $target_dir = "../app/uploads/";
            $target_file = $target_dir . $test;
        if (!file_exists($target_file)) {
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            if (move_uploaded_file($test1, $target_file)) {

                echo "The file " . $test . " has been uploaded.";
                echo '<img src="../app/uploads/' . $test . '">';
                ?>

                <p>File #<?= $i + 1 ?>:</p>
                <p>
                    Name: <?= $myFile["name"][$i] ?><br>
                    Temporary file: <?= $myFile["tmp_name"][$i] ?><br>
                    Type: <?= $myFile["type"][$i] ?><br>
                    Size: <?= $myFile["size"][$i] ?><br>
                    Error: <?= $myFile["error"][$i] ?><br>
                </p>
                <?php
            }
        }
    }
}