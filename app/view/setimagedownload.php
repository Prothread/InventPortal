<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 21-Nov-16
 * Time: 10:32
 */

$mysqli = mysqli_connect();
$id = mysqli_real_escape_string($mysqli, $_POST['id'] );
$vote = mysqli_real_escape_string($mysqli, $_POST['vote'] );

$image = new ImageController();
$image->setDownloadable($id, $vote);