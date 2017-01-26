<?php
#UPLOAD PAGE

if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}
$user = new UserController();
$userinfo = $user->getUserById($_SESSION['usr_id']);
?>
<div id="Mail">
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="NameText">Uploaden</p>
                    <hr size="1">



                </div>
            </div>
        </div>
    </div>