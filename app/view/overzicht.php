<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1){

} else {
    header('Location: index.php?page=gebruikersoverzicht');
}

$uploads = new BlockController();

$get_filled_info = $uploads->getUploads();

?>
<div class="container">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <table style="width:100%">
                    <tr>
                        <th style="text-align: left;"><p class="NameText" style="font-weight: normal;">Overzicht</p></th>
                        <th style="text-align: right;">

                            <a href="?page=gebruikersoverzicht">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                    <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Mijn overzicht</button>
                            </a>

                        </th>
                    </tr>
                </table>
                <hr>

                <table id="myTable" class="table table-striped" >
                    <thead>
                    <tr>
                        <?php if($get_filled_info !== null) {?>
                        <th style="display:none">ID</th>
                        <th>Onderwerp</th>
                        <th>Verstuurder</th>
                        <th>Naam</th>
                        <th id="date">Datum</th>
                        <th>Status</th>
                        <?php }
                        else {?>
                            <th></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($get_filled_info !== null) {
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
                                             src="public/icons/gezien.png">
                                    <?php } elseif ($upload['verified'] == 2) { ?>
                                        <img alt="Geaccepteerd" src="public/icons/akkoord.png">
                                    <?php } elseif ($upload['verified'] == 3) { ?>
                                        <img alt="Geweigerd" src="public/icons/geweigerd.png">
                                    <?php } else { ?>
                                        <img alt="Uploaded" src="public/icons/uploaded.png">
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }
                    }
                    else {?>
                        <td>Er zijn nog geen proeven aangemaakt</td>
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