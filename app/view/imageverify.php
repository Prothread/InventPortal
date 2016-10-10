<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 10-Oct-16
 * Time: 13:35
 */

$ugh = new ImageController();

function runMyFunction() {
    echo $_GET['img'];
}

if (isset($_GET['page']) == 'imageverify') {
    $ugh->ImageVerify($_GET['img']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    //var_dump($ugh->ImageVerify($_GET['img']));
}