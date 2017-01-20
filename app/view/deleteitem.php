<?php
#DELETES ITEM
if ($user->getPermission($permgroup, 'CAN_USE_ITEM_DELETE') == '1') {

} else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
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

$item->deleteItemByID($id);
$item->deleteItemImageByID($id);
$block->Redirect('?page=overview');
Session::flash('message', 'Item is verwijderd.');
