<?php
#OVERZICHT PAGE VAN ALLE ITEMS
$uploads = new BlockController();

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$_SESSION['offset'] = $offset;
$limit = 10;

$count = $uploads->countBlocks();
$get_filled_info = $uploads->getUploads($limit, $offset);

?>


<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Overzicht</p>
                <hr size="1">
                <input type="text" size="50" id="TableInput" onkeyup="searchTable()" placeholder="Zoek een product...">
                <br>
                <br>
                <table id="overzicht" class="sortable">
                    <thead>
                    <tr>
                        <td><b>Onderwerp</b></td>
                        <td><b>Verstuurder</b></td>
                        <td><b>Naam klant</b></td>
                        <td><b>Datum</b></td>
                        <td><b>Status</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($get_filled_info !== null) {
                        foreach($get_filled_info as $upload) {?>
                            <tr>
                                <td>
                                    <a href="?page=item&id=<?=$upload['id']?>"><?= $upload['onderwerp']?></a>
                                </td>
                                <td>
                                    <?= $upload['verstuurder']?>
                                </td>
                                <td>
                                    <?= $upload['naam']?>
                                </td>
                                <td>
                                    <?= date("d-m-Y", strtotime($upload['datum']));?>
                                </td>
                                <td>
                                    <?php if ($upload['verified'] == 1) {?>
                                        <img alt="Gezien" style="width: 50px; height: 50px;" src="../public/icons/gezien.png">
                                    <?php } elseif ($upload['verified'] == 2) {?>
                                        <img alt="Geaccepteerd" src="../public/icons/akkoord.png">
                                    <?php } elseif ($upload['verified'] == 3) {?>
                                        <img alt="Geweigerd" src="../public/icons/geweigerd.png">
                                    <?php } else {?>
                                        <img alt="Uploaded" src="../public/icons/uploaded.png">
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }
                    }
                    else
                    {
                        ?>
                        <tr>

                            <div class="alert alert-danger" role="alert">Er zijn nog geen items. Voeg een item toe op de uploadpagina.</div>

                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <ul class="pagination">
                    <?php for ( $i = 0; $i < ceil( $count / $limit ); $i++ ) : ?>
                        <li>
                            <a href="<?= "index.php?page=overzicht&offset=". $limit * $i ?>"> <?= ( $i + 1 ) ?> </a>
                        </li>
                    <?php endfor; ?>
                </ul>
                <hr size="1">
            </div>
        </div>
    </div>
</div>