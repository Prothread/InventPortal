<?php
#DASHBOARD PAGE LAAT RECENTE ITEMS ZIEN

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
$get_filled_info = $uploads->getLastSixUserUploads($_SESSION['usr_id']);

if($get_filled_info == null) {
    echo '<div id="NoMail" class="alert alert-info">Er zijn nog geen proeven of offertes geüpload</div>';
    return false;
}

$items = new MailController();
?>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Home</p>
                <hr size="1">
            </div>

            <br>
            <?php
            if($get_filled_info !== null) {
                foreach ($get_filled_info as $upload) { ?>

                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="well widgetwell">
                                <div class="caption">
                                    <div class="widget-header bg-success"></div>
                                    <div class="widget-body text-center">
                                        <img alt="Profile Picture" class="widget-img img-circle img-border" src="css/madalco.png">
                                        <h3><a href="?page=item&id=<?=$upload['id']?>"><?= $upload['onderwerp']?></a></h3>
                                        <p>Door:   <?= $upload['verstuurder'] ?></p>
                                        <p>Klant:  <?= $upload['naam'] ?></p>
                                        <p>Datum:  <?= date("d-m-Y", strtotime($upload['datum'])); ?></p>
                                        <p>Status: <?php if ($upload['verified'] == 1) {?></p>
                                        <p><span style="Color: #bb2c4c">Gezien</span></p>
                                        <?php } else if ($upload['verified'] == 2) {?>
                                            <p><span style="Color: #bb2c4c">Geaccepteerd</span></p>
                                        <?php } else if ($upload['verified'] == 3) {?>
                                            <p><span style="Color: #bb2c4c">Geweigerd</span></p>
                                        <?php } else {?>
                                            <p><span style="Color: #bb2c4c">Geüpload</span></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            }
            else
            {
                ?>
                <div
                    <div class="alert alert-danger" role="alert">Er is nog geen item om weer te geven. Voeg een item toe op de uploadpagina.</div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
