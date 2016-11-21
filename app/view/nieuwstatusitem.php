<?php 

#Pagina voor het aanmaken van  een nieuw item voor het statusportaal

$status = new StatusController();

$statusinfo = [
	'naam' => $_POST['name'],
	'onderwerp' => $_POST['onderwerp'],
	'deadline' => $_POST['deadline'],
	'category' => $_POST['category']
]

$status->create($statusinfo);

?>
