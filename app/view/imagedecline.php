<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 10-Oct-16
 * Time: 13:35
 */

require_once DIR_MODEL . 'permissions.php';

$user = new UserController();
if($user->getPermission($permgroup, 'CAN_ACCORD') == 1){

}
else if($user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1) {

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$imgcontrol = new ImageController();
$session = new Session();

if(isset($_GET['page'])) {

    $_GET['page'] = $session->cleantonumber($_GET['page']);

    if (isset($_GET['page']) == 'imageverify') {

        //$imgcontrol->ImageDecline($_GET['img']);
        $session->ImageVerify($_GET['img'], 2);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}