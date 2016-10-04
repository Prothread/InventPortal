<?php
/**
 * Created by PhpStorm.
 * User: Gijs
 * Date: 29-Sep-16
 * Time: 11:47
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