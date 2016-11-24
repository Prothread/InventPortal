<?php 

#Pagina voor het updaten van een item voor het statusportaal

if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$status = new StatusController();

$mysqli = mysqli_connect();

$id = mysqli_real_escape_string($mysqli, $_POST['id']);
$naam = mysqli_real_escape_string($mysqli, $_POST['name']);
$onderwerp = mysqli_real_escape_string($mysqli, $_POST['onderwerp']);
$deadline = mysqli_real_escape_string($mysqli, $_POST['deadline']);
$category = mysqli_real_escape_string($mysqli, $_POST['category']);
$comment = mysqli_real_escape_string($mysqli, $_POST['comment']);

$statusinfo = [
	'id' => $id,
	'naam' => $naam,
	'onderwerp' => $onderwerp,
	'deadline' => $deadline,
	'category' => $category,
	'comment' => $comment
];

$status->update($statusinfo);
header('Location: index.php?page=statusportal');
?>