<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 03-Oct-16
 * Time: 14:50
 */

$session = new Session();

$DbVerify = new DbVerify();

if(isset( $_GET['email'] ) ) {
    $verifyemail = $_GET['email'];
} else {
    echo "No e-mail returned. ";
}

if(isset( $_GET['key'] ) ) {
    $verifykey = $_GET['key'];
} else {
    echo "No key returned. ";
}

if( isset( $_GET['email'] ) && isset( $_GET['key'] ) ) {
    $getter = $DbVerify->getVerifiedById($verifyemail, $verifykey);
    $DbVerify->setVerifiedById($getter['id']);

    $session->setMailId( $getter['id'] );//

    //header('Location: index.php?page=accordering&id='.$getter['id']);
    header('Location: index.php?page=accordering');
}
else {
    echo 'Something went wrong!';
}