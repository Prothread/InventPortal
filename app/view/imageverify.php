<?php

$imgcontrol = new ImageController();
$session = new Session();

if(isset($_GET['page'])) {

    $_GET['page'] = $session->cleantonumber( $_GET['page'] );

    if (isset($_GET['page']) == 'imageverify') {

        //$imgcontrol->ImageVerify($_GET['img']);
        $session->ImageVerify($_GET['img'], 1);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}