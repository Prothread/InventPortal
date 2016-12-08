<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if($user->getPermission($permgroup, 'CAN_SHOW_USEROVERZICHT') == 1){

}
else {
    $block->Redirect('index.php');
}

$mail = new MailController();
$user = new UserController();

if($_POST['filter'] == 'openproeven') {
    $verified = '0, 1';

    $userid = $_SESSION['usr_id'];
    $myuser = $user->getUserById($_SESSION['usr_id']);
    if($myuser['permgroup'] == '1') {
        $clientID = $_SESSION['usr_id'];
        $_SESSION['useruploads'] = $mail->getUserMailByUserId($userid, 'datum', $verified, $clientID);
    }
    else {
        $_SESSION['useruploads'] = $mail->getUserMailByUserId($userid, 'datum', $verified);
    }

}

if($_POST['filter'] == 'goedeproeven') {
    $verified = '2';

    $userid = $_SESSION['usr_id'];
    $myuser = $user->getUserById($_SESSION['usr_id']);
    if($myuser['permgroup'] == '1') {
        $clientID = $_SESSION['usr_id'];
        $_SESSION['useruploads'] = $mail->getUserMailByUserId($userid, null, $verified, $clientID);
    }
    else {
        $_SESSION['useruploads'] = $mail->getUserMailByUserId($userid, null, $verified);
    }

}