<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if ($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1) {

} else {
    $block->Redirect('index.php?page=useroverview');
}

$uploads = new BlockController();

if (isset($_SESSION['uploads'])) {
    $get_filled_info = $_SESSION['uploads'];
} else {
    $get_filled_info = $uploads->getUploads();
}
if(isset($_SESSION['accorduserid'])) {
    $leclient = $user->getUserById($_SESSION['accorduserid']);
    $clientname = $leclient['naam'];
}
else {
    $leclient = $user->getUserById($_SESSION['usr_id']);
    $clientname = $leclient['naam'];
}
?>
<div class="container">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <table style="width:100%">
                    <tr>
                        <th class="filtermobiel" style="text-align: left;">
                            <p class="NameText" style="font-weight: normal;"><?= TEXT_OVERVIEW ?></p>
                        </th>

                        <th class="filtermobiel" id="filters">

                            <?php if (isset($_SESSION['updateopenmails']) && $user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1) { ?>
                                <a data-toggle="modal" data-target="#updateOpenMails" href="#">
                                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                        <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span>
                                        <?= BUTTON_SENDAGAIN ?> <span id="days"><?= BUTTON_5DAYS ?></span></button>
                                </a>
                            <?php } ?>

                            <a href="?page=useroverview">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton" >
                                    <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> <?= BUTTON_MYOVERVIEW ?>
                                </button>
                            </a>

                            <a id="filteropen" href="#">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                    <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> <?= BUTTON_DAYSOPEN ?> <span id="days"><?= BUTTON_5DAYS ?></span></button>
                            </a>

                            <a id="filtergoed" href="#">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                    <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span>
                                    <?= BUTTON_ACCORDED ?>
                                </button>
                            </a>

                            <a id="filterafgekeurd" href="#">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                    <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span>
                                    <?= BUTTON_DECLINED ?>
                                </button>
                            </a>

                        </th>
                    </tr>
                </table>
                <hr>

                <div class="btn-group show-on-hover">
                    <button style="width: 100px; background-color: #bb2c4c; color: white;" type="button"
                            class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <?= LEGEND ?><span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><img alt="Gezien" style="width: 50px; height: 50px;" src="icons/gezien.png"> ->
                            <?= TEXT_SEEN ?>
                        </li>
                        <li><img alt="Uploaded" src="icons/uploaded.png"> -> <?= TEXT_UPLOADED ?></li>
                        <li><img alt="Geaccepteerd" src="icons/akkoord.png"> -> <?= TEXT_ACCORDED ?></li>
                        <li><img alt="Geweigerd" src="icons/geweigerd.png"> -> <?= TEXT_DECLINED ?></li>
                    </ul>
                    <a href="?page=archive">
                        <button style="width: 100px; background-color: #bb2c4c; color: white;" type="button"
                                class="btn btn-default">
                            <i class="glyphicon glyphicon-folder-close"></i> Archive
                        </button>
                    </a>
                </div>

                <?php if (isset($get_filled_info) && $get_filled_info !== null) { ?>
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>

                            <th style="display:none">ID</th>
                            <th><?= TABLE_TITLE ?></th>
                            <th><?= TEXT_SENDER ?></th>
                            <th><?= TEXT_ASSIGNFOR ?></th>
                            <th id="date"><?= TEXT_DATE ?></th>
                            <th><?= TEXT_PROGRESS ?></th>
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
                                    <?php $usr = $user->getUserById($upload['verstuurder']); ?>
                                    <a href="?page=showuserprofile&id=<?= $usr['id'] ?>"><?= $usr['naam'] ?></a>
                                </td>
                                <td>
                                    <?php $clnt = $user->getUserById($upload['naam']); ?>
                                    <a href="?page=showuserprofile&id=<?= $clnt['id'] ?>"><?= $clnt['naam'] ?></a>
                                </td>
                                <td>
                                    <?= date("d-m-Y", strtotime($upload['datum'])); ?>
                                </td>
                                <td>
                                    <span style="display:none" id="status"><?= $upload['verified']; ?></span>
                                    <?php if ($upload['verified'] == 1) { ?>
                                        <img alt="Gezien" src="icons/gezien.png">
                                    <?php } elseif ($upload['verified'] == 2) { ?>
                                        <img alt="Geaccepteerd" src="icons/akkoord.png">
                                    <?php } elseif ($upload['verified'] == 3) { ?>
                                        <img alt="Geweigerd" src="icons/geweigerd.png">
                                    <?php } else { ?>
                                        <img alt="Uploaded" src="icons/uploaded.png">
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div id="weiger" class="alert alert-info" style="text-align: center;" role="alert"><span
                            class="glyphicon glyphicon-remove-circle"></span> U heeft nog niks geüpload of geaccordeerd
                    </div>
                <?php } ?>
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
    $(document).ready(function () {
        $('#myTable').dataTable({
            "order": [[0, "desc"]],
            "deferRender": true
        });

    });

    var filter;

    $('#filteropen').on('click', function (event) {

        filter = 'openproeven';

        var dataString = $('#filteropen').serialize() + '&filter=' + filter;

        $.ajax({
            type: "POST",
            url: "?page=changefilter",
            data: dataString,
            cache: false,
            success: function (result) {
                //$('#container').load("?page=overview " + '#container');
                location.reload();
            }
        });

        event.preventDefault();
    });

    $('#filtergoed').on('click', function (event) {

        filter = 'goedeproeven';

        var dataString = $('#filteropen').serialize() + '&filter=' + filter;

        $.ajax({
            type: "POST",
            url: "?page=changefilter",
            data: dataString,
            cache: false,
            success: function (result) {
                //$('#container').load("?page=overview " + '#container');
                location.reload();
            }
        });

        event.preventDefault();
    });
    $('#filterafgekeurd').on('click', function (event) {

        filter = 'afgekeurdeproeven';

        var dataString = $('#filterafgekeurd').serialize() + '&filter=' + filter;

        $.ajax({
            type: "POST",
            url: "?page=changefilter",
            data: dataString,
            cache: false,
            success: function (result) {
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