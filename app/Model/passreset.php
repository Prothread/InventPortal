<?php
#PAGINA VOOR PASSWORD RESET PHP CODE

if (isset($_SESSION['resetemail']) && isset($_SESSION['token'])) {
    $mysqli = mysqli_connect();
    $user = new UserController();
} else {
    echo TEXT_ERROR_OCCURED;
    return false;
}

//set validation error flag as false
$error = false;

$passforget = $_SESSION['token'];
$getbyemail = $user->getUserByEmail($_SESSION['resetemail']);
$dbpass = $getbyemail['paswoordvergeten'];

if ($getbyemail !== null) {

    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $cpassword = mysqli_real_escape_string($mysqli, $_POST['cpassword']);

    if (strlen($password) < 6) {
        $error = true;
        $block->Redirect($_SERVER['HTTP_REFERER']);
        Session::flash('error', TEXT_MINIMAL_LENGTH_6);
    }

    if ($cpassword !== $password) {
        $error = true;
        $block->Redirect($_SERVER['HTTP_REFERER']);
        Session::flash('error', TEXT_PASSWORDS_DONT_MATCH);
    }

    if ($passforget !== $dbpass) {
        $error = true;
        $block->Redirect($_SERVER['HTTP_REFERER']);
        Session::flash('error', TEXT_ERROR_OCCURED);
    }

    if (!$error) {
        $user->resetPassword($_SESSION['resetemail'], $_SESSION['token'], $cpassword);
        unset($_SESSION['resetemail']);
        unset($_SESSION['token']);

        $block->Redirect('index.php');
        Session::flash('message', TEXT_PASSWORD_CHANGED);
    }

}