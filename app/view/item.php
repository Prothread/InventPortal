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
                <p class="NameText">Item</p>
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
                    <?php $id = $_GET['id'] ?>
                    <?php foreach($uploads->getUploadById($_GET[$id]) as $upload) {?>
                        <tr>
                            <td>
                                <?= $upload['id']?>
                            </td>
                            <td>
                                <a href="?page=item"><?= $upload['onderwerp']?></a>
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
                    <?php break;}?>
                    </tbody>
                </table>
                <hr size="1">
            </div>
        </div>
    </div>
</div>
