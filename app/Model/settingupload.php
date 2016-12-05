<?php
#SETTINGS PAGE

if($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1){

}
else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$mysqli = mysqli_connect();
$smtp = mysqli_real_escape_string($mysqli, $_POST['smtp']);
$email =  mysqli_real_escape_string($mysqli, $_POST['email']);
$header =  mysqli_real_escape_string($mysqli, $_POST['headerkleur']);

$settingsarray = [
    'SMTP' => $smtp,
    'Email' => $email,
    'Header' => $header
];

$error = 0;
if (isset($_FILES['fileToUpload'])) {

    $myFile = $_FILES['fileToUpload'];
    $fileCount = count($myFile["name"]);

    $test = $myFile['name'];
    $test1 = $myFile['tmp_name'];

    $target_dir = DIR_PUBLIC;
    $target_file = $target_dir . $test;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
        $error = 1;
    }

    if ($myFile["size"] > 10485760) {
        $error = 1;
        $block->Redirect('index.php?page=settings');
        Session::flash('message', 'Het geüploade bestand is te groot');
    }

    if ($error == 0) {

        $unique_name = preg_replace('/\s+/', '-', $test);
        $uniqfile = $target_dir . $unique_name;

        if (move_uploaded_file($test1, $uniqfile)) {

        }

        $settingsarray = [
            'SMTP' => $smtp,
            'Email' => $email,
            'Logo' => mysqli_real_escape_string($mysqli, $unique_name),
            'Header' => $header
        ];

    }
}
$settings->updateSettings($settingsarray);
