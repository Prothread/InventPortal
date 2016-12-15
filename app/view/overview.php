<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1){

} else {
    $block->Redirect('index.php?page=useroverview');
}

$uploads = new BlockController();

if(isset($_SESSION['uploads'])) {
    $get_filled_info = $_SESSION['uploads'];
}
else {
    $get_filled_info = $uploads->getUploads();
}
?>
<div class="container">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <table style="width:100%">
                    <tr>
                        <th style="text-align: left;">
                            <p class="NameText" style="font-weight: normal;">Overzicht</p>
                        </th>
                        <th style="text-align: right;">

                            <?php if(isset($_SESSION['updateopenmails']) && $user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1){ ?>
                            <a data-toggle="modal" data-target="#updateOpenMails" href="#">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Update alle Open proeven <span id="days">( > 5 dagen )</span></button>
                            </a>
                            <?php  } ?>

                            <a href="?page=useroverview">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Mijn overzicht</button>
                            </a>
                            <a id="filteropen" href="#">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Open proeven <span id="days">( > 5 dagen )</span></button>
                            </a>

                            <a id="filtergoed" href="#">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Geakkordeerde proeven</button>
                            </a>

                        </th>
                    </tr>
                </table>
                <hr>

                <div class="btn-group show-on-hover">
                    <button style="width: 100px; background-color: #bb2c4c; color: white;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Legenda <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><img alt="Gezien" style="width: 50px; height: 50px;" src="public/icons/gezien.png"> -> Gezien</li>
                        <li><img alt="Uploaded" src="public/icons/uploaded.png"> -> Geüpload</li>
                        <li><img alt="Geaccepteerd" src="public/icons/akkoord.png"> -> Akkoord</li>
                        <li><img alt="Geweigerd" src="public/icons/geweigerd.png"> -> Geweigerd</li>
                    </ul>
                </div>

                <table id="myTable" class="table table-striped" >
                    <thead>
                    <tr>
                        <?php if($get_filled_info !== null) {?>
                        <th style="display:none">ID</th>
                        <th>Onderwerp</th>
                        <th>Verstuurder</th>
                        <th>Klant</th>
                        <th id="date">Datum</th>
                        <th>Status</th>
                        <?php }
                        else {?>
                            <th>Proeven</th>
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
                                        <img alt="Gezien" src="public/icons/gezien.png">
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
<?php
    //Unset sessions
    unset($_SESSION['uploads']);
    unset($_SESSION['updateopenmails']);
?>

<script>
    $(document).ready(function(){
        $('#myTable').dataTable({
            "order": [[ 0, "desc" ]],
            "deferRender": true
        });

    });

    var filter;

    $('#filteropen').on('click', function(event) {

        filter = 'openproeven';

        var dataString = $('#filteropen').serialize() + '&filter=' + filter;

        $.ajax({
            type: "POST",
            url: "?page=changefilter",
            data: dataString,
            cache: false,
            success: function(result){
                //$('#container').load("?page=overview " + '#container');
                location.reload();
            }
        });

        event.preventDefault();
    });

    $('#filtergoed').on('click', function(event) {

        filter = 'goedeproeven';

        var dataString = $('#filteropen').serialize() + '&filter=' + filter;

        $.ajax({
            type: "POST",
            url: "?page=changefilter",
            data: dataString,
            cache: false,
            success: function(result){
                //$('#container').load("?page=overview " + '#container');
                location.reload();
            }
        });

        event.preventDefault();
    });
</script>

<!-- Modal -->
<div class="modal fade" id="updateOpenMails" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div style="text-align: center;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update alle open mails</h4>
            </div>
            <div style="text-align: center;" class="modal-body">
                <br>

                <p> U staat op het punt om alle mails die langer dan <b>5 dagen</b> openstaan te versturen. <br/><br/>
                Weet u dit zeker?<br/><br/></p>
                <a class="abuttonmodal" href="?page=updateopenmails">Update open mails</a>

                <br/>
                <br/>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>