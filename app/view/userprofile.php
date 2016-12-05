<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if($user->getPermission($permgroup, 'CAN_SHOW_USEROVERZICHT') == 1){

} else {
    $block->Redirect('index.php?page=showuserprofile');
}

$uploads = new BlockController();
$items = new MailController();
$user = new UserController();

$userid = $_SESSION['usr_id'];
$myuser = $user->getUserById($_SESSION['usr_id']);
if($myuser['permgroup'] == '1') {
    $clientID = $_SESSION['usr_id'];
    $getAllUserItems = $items->getUserMailByUserId($userid, 0, 0, $clientID);
}
else {
    $getAllUserItems = $items->getUserMailByUserId($userid, 0, 0);
}
if($getAllUserItems !== null){
foreach($getAllUserItems as $UserItem) {
    $mail = $items->getMailById($UserItem['mailid']);
    $getMails[] = $mail;
}
}

?>

<div class="container">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <table style="width:100%">
                <tr>
                    <th style="text-align: left;"><p class="NameText" style="font-weight: normal;">Uw proeven</p></th>
                </tr>
            </table>
            <hr>
            <br />
            <div class="row">

                <?php if(isset ($getMails) && $getMails !== null ) {?>
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
                        foreach ($getMails as $upload) { ?>
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

<script>
    $(document).ready(function(){
        $('#myTable').dataTable({
            "order": [[ 0, "desc" ]],
            "deferRender": true
        });

    });
</script>