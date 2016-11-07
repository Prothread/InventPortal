<?php
#SETTINGS PAGE

if($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

if (isset($_FILES['fileToUpload'])) {
    $error = 0;

    $myFile = $_FILES['fileToUpload'];
    $fileCount = count($myFile["name"]);

        $test = $myFile['name'];
        $test1 = $myFile['tmp_name'];

        $target_dir = DIR_PUBLIC;
        $target_file = $target_dir . $test;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
            $error = 1;
            echo "Sorry, only JPG, JPEG, PNG, PDF & GIF files are allowed.";
            ?><br/><?php
        }

        if ($myFile["size"] > 10485760) {
            $error = 1;
            echo $test . " File too big!";
            ?><br/><?php
        }

        if ($error == 0) {

            $unique_name = preg_replace('/\s+/', '-', $test);
            $uniqfile = $target_dir . $unique_name;

            if (move_uploaded_file($test1, $uniqfile)) {
                echo "The file " . $test . " has been uploaded."; ?><br/><?php
                echo '<img style="width:300px; height: auto;" src="../public/css/' . $unique_name . '">';
            }

            $settingsarray = [
                'SMTP' => $_POST['smtp'],
                'Email' => $_POST['email'],
                'Logo' => $unique_name,
                'Header' => $_POST['headerkleur']
            ];

            $settings->updateSettings($settingsarray);

        }

}