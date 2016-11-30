<?php 

if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$session = new Session();
$status = new StatusController();

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $id = $session->cleantonumber($id);
}
else {
  return 'Er is geen item gevonden';
}

$status->deleteItemByID($id);
header('Location: ?page=statusportal');
Session::flash('message', 'Item is verwijderd.');
?>