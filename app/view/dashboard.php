<?php
#DASHBOARD PAGE LAAT RECENTE ITEMS ZIEN

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
    $openstaand_percent-=5;
}
if($geweigerd_percent==0){
    $openstaand_percent-=5;
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
                        <div class="progress-bar progress-bar-success progress-bar-striped active" style="min-width: 5%;width: <?= $geaccepteerd_percent ?>%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-ok-sign"></span>  <span class="badge"><?= $get_items_geaccepteerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" style="min-width: 5%;width: <?= $geweigerd_percent ?>%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-remove-sign"></span>  <span class="badge"><?= $get_items_geweigerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" style="min-width: 5%;width: <?= $openstaand_percent ?>%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-question-sign"></span>  <span class="badge"><?= $get_items_openstaand['COUNT(status)'] + $get_items_bekeken['COUNT(status)'] ?></span></a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" style="width: 95px;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span style="color: #bb2c4c;">Legenda </span> <span style="color: #bb2c4c" class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="glyphicon glyphicon-ok-sign"> Goedgekeurd</a></li>
                            <li><a href="#" class="glyphicon glyphicon-remove-sign"> Geweigerd</a></li>
                            <li><a href="#" class="glyphicon glyphicon-question-sign"> Open</a></li>
                        </ul>
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
