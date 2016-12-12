<?php
#PROCESSES ALL IMAGE DOWNLOAD FUNCTION

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
$block->Redirect('?page=item&id=' . $_GET['id']);