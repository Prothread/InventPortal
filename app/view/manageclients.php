<?php
#MANAGE CLIENTS PAGE

$clients = new ClientController();
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Klantenbeheer</p>
                <hr size="1">
                <input type="text" size="50" id="TableInput" onkeyup="searchTable()" placeholder="Zoek een klant...">
                <br>
                <br>
                <a href="index.php?page=newclient"><div id="NewClientButton">Nieuwe klant</div></a>
                <table id="overzicht" class="sortable">
                    <br><br>
                    <thead>
                        <tr>
                            <th><b>Weergavenaam</b></th>
                            <th><b>Bedrijfsnaam</b></th>
                            <th><b>E-mailadres</b></th>
                            <th><b>Adres</b></th>
                            <th><b>Postcode</b></th>
                            <th><b>Plaats</b></th>
                            <th><b>Edit</b></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($clients->getAllClients() as $client) {?>
                            <tr>
                                <td>
                                    <?= $client['naam']; ?>
                                </td>
                                <td>
                                    <?= $client['bedrijfsnaam']; ?>
                                </td>
                                <td>
                                    <?= $client['email']; ?>
                                </td>
                                <td>
                                    <?= $client['adres']; ?>
                                </td>
                                <td>
                                    <?= $client['postcode']; ?>
                                </td>
                                <td>
                                    <?= $client['plaats']; ?>
                                </td>
                                <td>
                                    <?php $clientid = $client['id']; ?>
                                    <a href="?page=editclient&id=<?= $clientid ?>"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>