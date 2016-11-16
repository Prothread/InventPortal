<?php
#PAGINA VOOR PASSWORD RESET PHP CODE

if(isset($_SESSION['resetemail']) && isset($_SESSION['token'])) {
    $mysqli = mysqli_connect();
    $user = new UserController();
}
else {
    echo 'Er is iets misgegaan';
    return false;
}

//set validation error flag as false
$error = false;

$passforget = $_SESSION['token'];
$getbyemail = $user->getUserByEmail($_SESSION['resetemail']);
$dbpass = $getbyemail['paswoordvergeten'];

if($getbyemail !== null) {

    $password = mysqli_real_escape_string( $mysqli, $_POST['password'] );
    $cpassword = mysqli_real_escape_string( $mysqli, $_POST['cpassword'] );

    if(strlen($password) < 6) {
        $error = true;
        echo "Het paswoord moet minimaal 6 tekens bevatten. \n";
    }

    if($cpassword !== $password){
        $error = true;
        echo "De ingevulde nieuwe wachtwoorden komen niet overeen \n";
    }

    if($passforget !== $dbpass) {
        $error = true;
        echo "Er is iets misgegaan \n";
    }

    if(!$error) {
        $user->resetPassword($_SESSION['resetemail'], $_SESSION['token'], $cpassword);
        unset($_SESSION['resetemail']);
        unset($_SESSION['token']);

        header('Location: index.php');
        Session::flash('message', 'Uw wachwoord is succesvol veranderd');
    }

}