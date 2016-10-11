<?php
#OVERZICHT PAGE VAN ALLE ITEMS
$uploads = new BlockController();
$get_filled_info = $uploads->getUploads();
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
                            <td><b>ID</b></td>
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
                        foreach($uploads->getUploads() as $upload) {?>
                            <tr>
                                <td>
                                    <?= $upload['id']?>
                                </td>
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
                                    <?= $upload['verified']?>
                                </td>
                            </tr>
                        <?php }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td>
                                Er zijn nog geen items. Voeg eerst een item toe via de upload pagina.
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <hr size="1">
            </div>
        </div>
    </div>
</div>