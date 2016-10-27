<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 26-Oct-16
 * Time: 13:41
 */

$imgcontrol = new ImageController();
$session = new Session();

if(isset($_GET['page'])) {

    $_GET['page'] = $session->cleantonumber($_GET['page']);

    if (isset($_GET['page']) == 'imagecancel') {

        //$imgcontrol->ImageDecline($_GET['img']);
        $session->ImageVerify($_GET['img'], 0);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}