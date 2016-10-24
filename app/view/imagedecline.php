<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 10-Oct-16
 * Time: 13:35
 */

$imgcontrol = new ImageController();
$session = new Session();

if(isset($_GET['page'])) {

    $_GET['page'] = $session->cleantonumber($_GET['page']);

    if (isset($_GET['page']) == 'imageverify') {

        //$imgcontrol->ImageDecline($_GET['img']);
        $session->ImageVerify($_GET['img'], 2);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}