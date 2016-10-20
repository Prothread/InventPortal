<?php
#MANAGE CLIENTS PAGE

$clients = new ClientController();

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = 10;

$count = $clients->countBlocks();
$get_filled_info = $clients->getAllClients($limit, $offset);
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

                        <?php foreach($get_filled_info as $client) {?>
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

                <ul class="pagination">
                    <?php for ( $i = 0; $i < ceil( $count / $limit ); $i++ ) : ?>
                        <li>
                            <a href="<?= "index.php?page=manageclients&offset=". $limit * $i ?>"> <?= ( $i + 1 ) ?> </a>
                        </li>
                    <?php endfor; ?>
                </ul>

            </div>
        </div>
    </div>
</div>