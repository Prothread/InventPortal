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

/*

if(isset($_GET['page'])) {

    $_GET['page'] = $session->clean( $_GET['page'] );

    if (isset($_GET['page']) == 'imageverify') {

        //$imgcontrol->ImageVerify($_GET['img']);
        $session->ImageVerify($_GET['img'], 1);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

*/
if($_POST) {
    $imgid = $_POST['img'];

    if ($_POST['vote'] == "Akkoord") {
        $verify = 1;
    } else if ($_POST['vote'] == "Weiger") {
        $verify = 2;
    }

    $session->ImageVerify($imgid, $verify);
}