<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1){

} else {
    header('Location: index.php?page=gebruikersoverzicht');
}

$mail = new MailController();
$uploads = new BlockController();

$verified = '0, 1';
$get_filled_info = $uploads->getOlderUploads($verified);
?>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nieuw item</h4>
            </div>
            <div class="modal-body">
                <br>

                <div class="fetched-data"></div>

            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '?page=item2', //Here you will fetch records
                data :  'rowid='+ rowid, //Pass $id
                success : function(data){
                    $('.fetched-data').html(data);//Show fetched data from database
                }
            });
        });
    });
</script>

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
                                    <a href="#myModal" data-toggle="modal" data-id="<?= $upload['id']?>" href="#upl<?= $upload['id']?>"><?= $upload['onderwerp'] ?></a>
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
                        <td>U heeft nog geen proeven geaccordeerd</td>
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

