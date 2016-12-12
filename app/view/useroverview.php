<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if($user->getPermission($permgroup, 'CAN_SHOW_USEROVERZICHT') == 1){

}
else {
    $block->Redirect('index.php');
    if(isset($_SESSION['usr_id'])) {
        Session::flash('error', 'U heeft hier geen rechten voor.');
    }
    else {
        Session::flash('message', 'U bent nog niet ingelogd');
    }
}

$uploads = new BlockController();
$items = new MailController();
$user = new UserController();

if(isset($_SESSION['useruploads'])) {
    $getAllUserItems = $_SESSION['useruploads'];
}
else {
    $userid = $_SESSION['usr_id'];
    $myuser = $user->getUserById($_SESSION['usr_id']);

    if ($myuser['permgroup'] == '1') {
        $clientID = $_SESSION['usr_id'];
        $getAllUserItems = $items->getUserMailByUserId($userid, null, null, $clientID);
    }
    else {
        $getAllUserItems = $items->getUserMailByUserId($userid);
    }

}
?>

<div class="container">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <table style="width:100%">
                <tr>
                    <th style="text-align: left;"><p class="NameText" style="font-weight: normal;">Uw overzicht</p></th>

                    <th style="text-align: right;">

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
            <br />
            <div class="row">

                <?php if(isset ($getAllUserItems) && $getAllUserItems !== null ) {?>
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
                        foreach ($getAllUserItems as $upload) { ?>
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
                        <?php } ?>
                    </tbody>
                </table>
                <?php }
                else { ?>
                    <div id="weiger" class="alert alert-info" style="text-align: center;" role="alert"><span class="glyphicon glyphicon-remove-circle"></span> U heeft nog niks geüpload of geaccordeerd</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
//Unset sessions
unset($_SESSION['useruploads']);
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
            url: "?page=changefilter2",
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
            url: "?page=changefilter2",
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