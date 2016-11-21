<?php 

#Pagina voor het aanmaken van  een nieuw item voor het statusportaal

$status = new StatusController();

$mysqli = mysqli_connect();

$naam = mysqli_real_escape_string($mysqli, $_POST['name']);
$onderwerp = mysqli_real_escape_string($mysqli, $_POST['onderwerp']);
$deadline = mysqli_real_escape_string($mysqli, $_POST['deadline']);
$category = mysqli_real_escape_string($mysqli, $_POST['category']);

$statusinfo = [
	'naam' => $naam,
	'onderwerp' => $onderwerp,
	'deadline' => $deadline,
	'category' => $category
];

$status->create($statusinfo);
header('Location: index.php?page=statusportal');
?>