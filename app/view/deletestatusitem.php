<?php
#DELETES ITEM

if($user->getPermission($permgroup, 'CAN_USE_STATUSPORTAL') == 1){

}
else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$session = new Session();
$status = new StatusController();
$mysqli = mysqli_connect();

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string( $mysqli, $_GET['id'] );
    $id = $session->cleantonumber($id);
}
else {
    return 'Er is geen item gevonden';
}

$status->deleteItemByID($id);
$block->Redirect('?page=statusportal');
Session::flash('message', 'Item is verwijderd.');
