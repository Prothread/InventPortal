<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if ($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1) {

} else {
    $block->Redirect('index.php?page=showuserprofile');
}

$mail = new MailController();
$uploads = new BlockController();

if ($_POST['filter'] == 'openproeven') {
    $verified = '0, 1';
    $_SESSION['uploads'] = $uploads->getOlderUploads($verified, true);
    $_SESSION['updateopenmails'] = true;
}

if ($_POST['filter'] == 'goedeproeven') {
    $_SESSION['uploads'] = $uploads->getAccordedUploads();
}
if ($_POST['filter'] == 'afgekeurdeproeven') {
    $_SESSION['uploads'] = $uploads->getDeclinedUploads();
}