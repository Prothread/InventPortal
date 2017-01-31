<?php
if (isset($_POST['submit'])) {

    $mysqli = mysqli_connect();

    $id = $_SESSION['usr_id'];
    $naam = mysqli_real_escape_string($mysqli, $_POST['naam']);
    $bedrijfsnaam = mysqli_real_escape_string($mysqli, $_POST['bedrijfsnaam']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $altmail = mysqli_real_escape_string($mysqli, $_POST['altmail']);
    $adres = mysqli_real_escape_string($mysqli, $_POST['adres']);
    $postcode = mysqli_real_escape_string($mysqli, $_POST['postcode']);
    $plaats = mysqli_real_escape_string($mysqli, $_POST['plaats']);
    if(isset($_POST['rechten']) && $_POST['rechten']) {
        $rechten = mysqli_real_escape_string($mysqli, $_POST['rechten']);
    }

    $userinfo1 = [
        'id' => $id,
        'name' => $naam,
        'bedrijfsnaam' => $bedrijfsnaam,
        'email' => $email,
        'altmail' => $altmail,
        'adres' => $adres,
        'postcode' => $postcode,
        'plaats' => $plaats
    ];
    if(isset($rechten) && $rechten) {
        $userinfo1['permgroup'] = $rechten;
    }

    if (isset($_FILES['fileToUpload'])) {
        $error = 0;

        $myFile = $_FILES['fileToUpload'];
        $fileCount = count($myFile["name"]);

        $test = $myFile['name'];
        $test1 = $myFile['tmp_name'];

        $target_dir = DIR_IMG;
        $target_file = $target_dir . $test;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
            $error = 1;
        }

        if ($myFile["size"] > 10485760) {
            $error = 1;
            echo $test . '<div class="alert alert-danger" role="alert">' . TEXT_UPLOADED_FILE_TOO_BIG . '!</div>';
            return false;
        }

        if ($error == 0) {

            $unique_name = preg_replace('/\s+/', '-', $test);
            $uniqfile = $target_dir . $unique_name;

            if (move_uploaded_file($test1, $uniqfile)) {
                $userinfo1['profimg'] = $unique_name;
            }

        }

    }

    $user->update($userinfo1);
    $block->Redirect('index.php?page=profile');
}