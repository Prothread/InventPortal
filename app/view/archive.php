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
    $get_filled_info = $uploads->getArchiveUploads();
}
?>
<div class="container">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <table style="width:100%">
                    <tr>
                        <th style="text-align: left;">
                            <p class="NameText" style="font-weight: normal;"><?= TEXT_ARCHIVE ?></p>
                        </th>
                        <th id="filters" style="text-align: right;">

                            <a href="?page=useroverview">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                    <span class="btn-label"><i
                                            class="glyphicon glyphicon-list-alt"></i></span> <?= BUTTON_MYOVERVIEW ?>
                                </button>
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
                        <?= LEGEND ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><img alt="Gezien" style="width: 50px; height: 50px;" src="icons/gezien.png"> ->
                            <?= TEXT_SEEN ?>
                        </li>
                        <li><img alt="Uploaded" src="icons/uploaded.png"> -> <?= TEXT_UPLOADED ?></li>
                        <li><img alt="Geaccepteerd" src="icons/akkoord.png"> -> <?= TEXT_ACCORDED ?></li>
                        <li><img alt="Geweigerd" src="icons/geweigerd.png"> -> <?= TEXT_DECLINED ?></li>
                    </ul>
                </div>

                <?php if (isset($get_filled_info) && $get_filled_info !== null) { ?>
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>

                            <th style="display:none">ID</th>
                            <th><?= TABLE_TITLE ?></th>
                            <th><?= TEXT_SENDER ?></th>
                            <th><?= TEXT_CLIENT ?></th>
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
                            class="glyphicon glyphicon-remove-circle"></span> Er zijn nog geen proeven in de archive
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
            url: "?page=changearchivefilter",
            data: dataString,
            cache: false,
            success: function (result) {
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
            url: "?page=changearchivefilter",
            data: dataString,
            cache: false,
            success: function (result) {
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
            url: "?page=changearchivefilter",
            data: dataString,
            cache: false,
            success: function (result) {
                location.reload();
            }
        });

        event.preventDefault();
    });
</script>