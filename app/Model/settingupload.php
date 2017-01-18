<?php
#SETTINGS PAGE

if ($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$mysqli = mysqli_connect();
$smtp = mysqli_real_escape_string($mysqli, $_POST['smtp']);
$smtpport = mysqli_real_escape_string($mysqli, $_POST['smtpport']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$mailpass = mysqli_real_escape_string($mysqli, $_POST['emailpassword']);
$header = mysqli_real_escape_string($mysqli, $_POST['headerkleur']);
$host = mysqli_real_escape_string($mysqli, $_POST['host']);

$settingsarray = [
    'SMTP' => $smtp,
    'SMTPport' => $smtpport,
    'Email' => $email,
    'Mailpass' => $mailpass,
    'Header' => $header,
    'Host' => $host
];

if(isset($_POST['checker'])) {
    $contactemail = mysqli_real_escape_string($mysqli, $_POST['globalmail']);

    $settingsarray = [
        'SMTP' => $smtp,
        'SMTPport' => $smtpport,
        'Email' => $email,
        'Mailpass' => $mailpass,
        'Header' => $header,
        'Host' => $host,
        'globalmail' => 1,
        'contactmail' => $contactemail
    ];
}
else {
    $settingsarray = [
        'SMTP' => $smtp,
        'SMTPport' => $smtpport,
        'Email' => $email,
        'Mailpass' => $mailpass,
        'Header' => $header,
        'Host' => $host,
        'globalmail' => 0,
    ];
}

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
            'SMTPport' => $smtpport,
            'Email' => $email,
            'Mailpass' => $mailpass,
            'Logo' => mysqli_real_escape_string($mysqli, $unique_name),
            'Header' => $header
        ];

    }
}
$settings->updateSettings($settingsarray);
$block->Redirect('index.php?page=settings');