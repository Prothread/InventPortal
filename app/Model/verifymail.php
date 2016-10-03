<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 03-Oct-16
 * Time: 14:50
 */

$_GET['page'];
var_dump($_GET['page']);
$sql = 'SELECT * FROM `mail` WHERE `email` = "kevin.herdershof@hotmail.com" && `key` = "49f362299b4eb5156017cbc6412a429b"';