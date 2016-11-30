<?php
if(isset($_POST['submit'])) {

    $mysqli = mysqli_connect();

    $id = $_SESSION['usr_id'];
    $naam = mysqli_real_escape_string($mysqli, $_POST['naam']);
    $bedrijfsnaam = mysqli_real_escape_string($mysqli, $_POST['bedrijfsnaam']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $adres = mysqli_real_escape_string($mysqli, $_POST['adres']);
    $postcode = mysqli_real_escape_string($mysqli, $_POST['postcode']);
    $plaats = mysqli_real_escape_string($mysqli, $_POST['plaats']);
    $rechten = mysqli_real_escape_string($mysqli, $_POST['rechten']);

    $userinfo1 = [
        'id' => $id,
        'name' => $naam,
        'bedrijfsnaam' => $bedrijfsnaam,
        'email' => $email,
        'adres' => $adres,
        'postcode' => $postcode,
        'plaats' => $plaats,
        'permgroup' => $rechten
    ];

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
            echo $test . '<div class="alert alert-danger" role="alert">Het meegestuurde bestand is te groot!</div>';
            ?><br/><?php
        }

        if ($error == 0) {

            $unique_name = preg_replace('/\s+/', '-', $test);
            $uniqfile = $target_dir . $unique_name;

            if (move_uploaded_file($test1, $uniqfile)) {

            }

            $userinfo1 = [
                'id' => $id,
                'profimg' => $unique_name,
                'name' => $naam,
                'bedrijfsnaam' => $bedrijfsnaam,
                'email' => $email,
                'adres' => $adres,
                'postcode' => $postcode,
                'plaats' => $plaats,
                'permgroup' => $rechten
            ];

        }

    }

    $user->update($userinfo1);
    header('Location: index.php?page=profile');
}