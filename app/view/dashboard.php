<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 29-Sep-16
 * Time: 12:47
 */

$uploads = new BlockController();
?>
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
                        <th><b>Onderwerp</b></th>
                        <th><b>Verstuurder</b></th>
                        <th><b>Naam klant</b></th>
                        <th><b>Datum</b></th>
                        <th><b>Status</b></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach($uploads->getLastThreeUploads() as $upload) {?>
                        <tr>
                            <td>
                                <?= $upload['onderwerp']?>
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
                    <?php }?>
                    </tbody>
                </table>
                <hr size="1">
            </div>
        </div>
    </div>
</div>
