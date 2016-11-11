<?php

$uploads = new BlockController();

$table = 'id';
$status = '';
$filter = 'DESC';

$get_filled_info = $uploads->getUploads($table, $filter, 0, 0, $status);

?>

<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<div class="container">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="NameText">Overzicht</p>
                    <hr size="1">

                </div>

                <table id="myTable" class="table table-striped" >
                    <thead>
                    <tr>
                        <th style="display:none">ID</th>
                        <th>Onderwerp</th>
                        <th>Verstuurder</th>
                        <th>Naam</th>
                        <th>Datum</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($get_filled_info as $upload) { ?>
                            <tr>
                                <td style="display:none">
                                    <?= $upload['id']; ?>
                                </td>
                                <td>
                                    <a href="?page=item&id=<?= $upload['id'] ?>"><?= $upload['onderwerp'] ?></a>
                                </td>
                                <td>
                                    <?= $upload['verstuurder'] ?>
                                </td>
                                <td>
                                    <?= $upload['naam'] ?>
                                </td>
                                <td>
                                    <?= date("d-m-Y", strtotime($upload['datum'])); ?>
                                </td>
                                <td>
                                    <span style="display:none" id="status"><?= $upload['verified']; ?></span>
                                    <?php if ($upload['verified'] == 1) { ?>
                                        <img alt="Gezien" style="width: 50px; height: 50px;"
                                             src="../public/icons/gezien.png">
                                    <?php } elseif ($upload['verified'] == 2) { ?>
                                        <img alt="Geaccepteerd" src="../public/icons/akkoord.png">
                                    <?php } elseif ($upload['verified'] == 3) { ?>
                                        <img alt="Geweigerd" src="../public/icons/geweigerd.png">
                                    <?php } else { ?>
                                        <img alt="Uploaded" src="../public/icons/uploaded.png">
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#myTable').dataTable({
            "order": [[ 0, "desc" ]]
        });

    });
</script>