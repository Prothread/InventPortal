<?php
#DASHBOARD PAGE LAAT RECENTE ITEMS ZIEN

$uploads = new BlockController();
$get_filled_info = $uploads->getLastSixUploads();

$items = new MailController();
$get_items_openstaand = $items->getUserMailByStatus(0);
$get_items_geweigerd = $items->getUserMailByStatus(3);
$get_items_geaccepteerd = $items->getUserMailByStatus(2);

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
                        <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 60%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-ok-sign"></span>  Geaccepteerd &nbsp;&nbsp;<span class="badge"><?= $get_items_geaccepteerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 25%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-remove-sign"></span>  Geweigerd &nbsp;&nbsp;<span class="badge"><?= $get_items_geweigerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 15%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-question-sign"></span>  Openstaand &nbsp;&nbsp;<span class="badge"><?= $get_items_openstaand['COUNT(status)'] ?></span></a>
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
                        <td class="alert alert-danger" role="alert">Er zijn nog geen items. Voeg een item toe op de upload pagina.</td>
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
