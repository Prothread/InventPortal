<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 03-Oct-16
 * Time: 14:50
 */

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
    //$sql = "SELECT * FROM `mail` WHERE `email` = '{$verifyemail}' && `key` = '{$verifykey}'";
    $DbVerify->setVerified($verifyemail, $verifykey);
    var_dump($DbVerify);
    //header('Location: index.php?page=dbverify');
}
else {
    echo 'Something went wrong!';
}