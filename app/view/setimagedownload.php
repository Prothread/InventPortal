<?php
#PAGE FOR DOWNLOADING IMAGE PROCESS

$mysqli = mysqli_connect();
$id = mysqli_real_escape_string($mysqli, $_POST['id']);
$id = substr($id, 3);
$vote = mysqli_real_escape_string($mysqli, $_POST['vote']);

if ($_GET['id']) {
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $id = substr($id, 3);
}
if ($_GET['vote']) {
    $vote = mysqli_real_escape_string($mysqli, $_POST['vote']);
}

$image = new ImageController();
$image->setDownloadable($id, $vote);