<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 26-Oct-16
 * Time: 13:41
 */

require_once DIR_MODEL . 'permissions.php';

$user = new UserController();
if($user->getPermission($permgroup, 'CAN_ACCORD') == 1){

}
else if($user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1) {

}
else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$imgcontrol = new ImageController();
$session = new Session();

if(isset($_GET['page'])) {

    $_GET['page'] = $session->clean($_GET['page']);
    $_GET['img'] = $session->cleantonumber( $_GET['img'] );

    if (isset($_GET['page']) == 'imagecancel') {

        //$imgcontrol->ImageDecline($_GET['img']);
        $session->ImageVerify($_GET['img'], 0);
        $block->Redirect($_SERVER['HTTP_REFERER']);
    }
}