<?php
#THE VERIFY IMGAGE PROCESS PAGE

require_once DIR_MODEL . 'permissions.php';

$user = new UserController();
if ($user->getPermission($permgroup, 'CAN_ACCORD') == 1) {

} else if ($user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$imgcontrol = new ImageController();
$session = new Session();

if ($_POST) {
    $imgid = $_POST['img'];

    if ($_POST['vote'] == BUTTON_ACCORD) {
        $verify = 1;
    } else if ($_POST['vote'] == BUTTON_DECLINE) {
        $verify = 2;
    }

    $session->ImageVerify($imgid, $verify);
}