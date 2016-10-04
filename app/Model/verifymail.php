<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 03-Oct-16
 * Time: 14:50
 */

<<<<<<< HEAD
$_GET['page'];
var_dump($_GET['page']);
$sql = 'SELECT * FROM `mail` WHERE `email` = "kevin.herdershof@hotmail.com" && `key` = "49f362299b4eb5156017cbc6412a429b"';
=======
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
    $DbVerify->getVerified();
    var_dump($DbVerify->getVerified());
    //header('Location: index.php?page=dbverify');
}
else {
    echo 'Something went wrong!';
}
>>>>>>> 2112351d5305ecffc2c8edbcfb6118c0a5e84c62
