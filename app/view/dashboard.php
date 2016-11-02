<?php
#DASHBOARD PAGE LAAT RECENTE ITEMS ZIEN

if($user->getPermission($permgroup, 'CAN_SHOW_HOME') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$uploads = new BlockController();
$get_filled_info = $uploads->getLastSixUploads();

$items = new MailController();
$get_items_openstaand = $items->getUserMailByStatus(0);
$get_items_bekeken = $items->getUserMailByStatus(1);
$get_items_geweigerd = $items->getUserMailByStatus(3);
$get_items_geaccepteerd = $items->getUserMailByStatus(2);
$allitems = $get_items_geaccepteerd['COUNT(status)']+$get_items_geweigerd['COUNT(status)']+$get_items_openstaand['COUNT(status)']+ $get_items_bekeken['COUNT(status)'];

$geaccepteerd_percent = ($get_items_geaccepteerd['COUNT(status)']/$allitems)*100;
$geweigerd_percent =  ($get_items_geweigerd['COUNT(status)']/$allitems)*100;
$openstaand_percent = 100-($geaccepteerd_percent+$geweigerd_percent);

if($geaccepteerd_percent==0){
    ?><style type="text/css">#geaccepteerd{  display:none;  }</style><?php
}
if($geweigerd_percent==0){
    ?><style type="text/css">#geweigerd{  display:none;  }</style><?php
}
if($openstaand_percent==0){
    ?><style type="text/css">#openstaand{  display:none;  }</style><?php
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Home</p>
                <hr size="1">
                <div class="well well-m">
                    <br>
                   <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: <?= $geaccepteerd_percent ?>%">
                            <a id="statusbartext" href="#" data-toggle="tooltip" title="Het aantal goedgekeurde items"><span id="geaccepteerd" class="glyphicon glyphicon-ok-sign"></span>  <span class="badge"><?= $get_items_geaccepteerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: <?= $geweigerd_percent ?>%">
                            <a id="statusbartext" href="#" data-toggle="tooltip" title="Het aantal afgekeurde items"><span id="geweigerd" class="glyphicon glyphicon-remove-sign"></span>  <span class="badge"><?= $get_items_geweigerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: <?= $openstaand_percent ?>%">
                            <a id="statusbartext" href="#" data-toggle="tooltip" title="In afwachting van"><span id="openstaand" class="glyphicon glyphicon-question-sign"></span>  <span class="badge"><?= $get_items_openstaand['COUNT(status)'] + $get_items_bekeken['COUNT(status)'] ?></span></a>
                        </div>
                    </div>
                </div>

                <br>
                <?php
                if($get_filled_info !== null) {
                    foreach ($get_filled_info as $upload) { ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h3><a href="?page=item&id=<?=$upload['id']?>"><?= $upload['onderwerp']?></a></h3>
                                    <p>Door: <?= $upload['verstuurder'] ?></p>
                                    <p>Klant: <?= $upload['naam'] ?></p>
                                    <p>Datum:  <?= date("d-m-Y", strtotime($upload['datum'])); ?></p>
                                    <p>Status: <?php if ($upload['verified'] == 1) {?>
                                    <p><span style="Color: #bb2c4c">Gezien</span></p>
                                    <?php } elseif ($upload['verified'] == 2) {?>
                                        <p><span style="Color: #bb2c4c">Geaccepteerd</span></p>
                                    <?php } elseif ($upload['verified'] == 3) {?>
                                        <p><span style="Color: #bb2c4c">Geweigerd</span></p>
                                    <?php } else {?>
                                    <p><span style="Color: #bb2c4c">Geüpload</span></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
                else
                {
                    ?>
                    <tr>
                        <div class="alert alert-danger" role="alert">Er is nog geen item om weer te geven. Voeg een item toe op de uploadpagina.</div>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                </table>
                <hr size="1">
            </div>
        </div>
    </div>
</div>
