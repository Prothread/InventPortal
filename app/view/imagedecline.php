<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 10-Oct-16
 * Time: 14:48
 */

$ugh = new ImageController();

function runMyFunction() {
    echo $_GET['img'];
}

if (isset($_GET['page']) == 'imagedecline') {
    $ugh->ImageDecline($_GET['img']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    //var_dump($ugh->ImageVerify($_GET['img']));
}