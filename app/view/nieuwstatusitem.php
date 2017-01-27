<?php
#PAGE FOR MAKING NEW STATUSPORTAL ITEM

if ($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$status = new StatusController();

$mysqli = mysqli_connect();

$naam = mysqli_real_escape_string($mysqli, $_POST['name']);
$onderwerp = mysqli_real_escape_string($mysqli, $_POST['onderwerp']);
$deadline = mysqli_real_escape_string($mysqli, $_POST['deadline']);
$category = mysqli_real_escape_string($mysqli, $_POST['category']);
$comment = mysqli_real_escape_string($mysqli, $_POST['comment']);

$statusinfo = [
    'naam' => $naam,
    'onderwerp' => $onderwerp,
    'deadline' => $deadline,
    'category' => $category,
    'comment' => $comment
];

$status->create($statusinfo);
$block->Redirect('index.php?page=statusportal');