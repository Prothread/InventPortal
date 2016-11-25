<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1){

} else {
    header('Location: index.php?page=gebruikersoverzicht');
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
                            <a href="?page=gebruikersoverzicht" id="updateopenmails">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Update alle Open proeven <span id="days">(5 < dagen)</span></button>
                            </a>
                            <?php  } ?>

                            <a href="?page=gebruikersoverzicht">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Mijn overzicht</button>
                            </a>
                            <a id="filteropen" href="?page=gebruikersoverzicht">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Open proeven </button>
                            </a>

                            <a id="filtergoed" href="?page=gebruikersoverzicht">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Geakkordeerde proeven</button>
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
<?php
    //Unset sessions
    unset($_SESSION['uploads']);
    unset($_SESSION['updateopenmails']);
?>

<script>
    $(document).ready(function(){
        $('#myTable').dataTable({
            "order": [[ 0, "desc" ]]
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
                //$('#container').load("?page=overzicht " + '#container');
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
                //$('#container').load("?page=overzicht " + '#container');
                location.reload();
            }
        });

        event.preventDefault();
    });
</script>