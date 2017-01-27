<?php
#PAGE FOR UPDATING CLIENTS

$client = new UserController();
$mysqli = mysqli_connect();
$session = new Session();

$id = $_GET['id'];
$id = $session->cleantonumber($id);

$myclient = $client->getUserById($id);
$checkperms = $user->checkUserPerms($myclient['permgroup']);

if ($user->getPermission($permgroup, 'CAN_DELETE_CLIENT') == 1 && $myclient['permgroup'] == '1' && $checkperms['assignable'] == '1') {

}
else if ($user->getPermission($permgroup, 'CAN_DELETE_USER') == 1 && $myclient['permgroup'] !== '1' && $checkperms['assignable'] == '1') {

}
else {
    $block->Redirect($_SERVER['HTTP_REFERER']);
    Session::flash('error', TEXT_DELETE_USER);
    return false;
}
$user->delete($id);

if($myclient['permgroup'] == '1') {
    $block->Redirect('index.php?page=manageclients');
}
else {
    $block->Redirect('index.php?page=manageusers');
}