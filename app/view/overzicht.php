<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 08:52
 */

$uploads = new BlockController();
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
                    <?php foreach($uploads->getUploads() as $upload) {?>
                        <tr>
                            <td>
                                <?= $upload['id']?>
                                Er zijn nog geen items. Voeg eerst een item toe via de upload pagina.
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
                    <?php }?>
                    </tbody>
                </table>
                <hr size="1">
            </div>
        </div>
    </div>
</div>