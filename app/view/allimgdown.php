<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 21-Nov-16
 * Time: 15:32
 */

$mysqli = mysqli_connect();
$session = new Session();

$id = mysqli_real_escape_string($mysqli, $_GET['id']);
$id = $session->cleantonumber($id);

$image_controller = new ImageController();
$uploadedimages = $image_controller->getImagebyMailID($id);

foreach($uploadedimages as $imgid) {
    $id = $imgid['id'];
    $vote = 1;
    $image_controller->setDownloadable($id, $vote);
}
header('Location: ?page=item&id=' . $_GET['id']);