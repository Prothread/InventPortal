<?php
#DELETES ITEM
if ($user->getPermission($permgroup, 'CAN_USE_ITEM_DELETE') == '1') {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$session = new Session();
$item = new MailController();
$mysqli = mysqli_connect();

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);
    $id = $session->cleantonumber($id);
} else {
    return 'Er is geen item gevonden';
}

$item->weigerItemByID($id);
$block->Redirect('index.php?page=item&id=' . $id);
Session::flash('info', TEXT_ITEM_EDITED);
