<?php
#DASHBOARD PAGE LAAT RECENTE ITEMS ZIEN

if($user->getPermission($permgroup, 'CAN_SHOW_HOME') == 1) {

}
else {
    header('Location: index.php?page=userdashboard');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$uploads = new BlockController();
$get_all_items = $uploads->getUploads();
$get_filled_info = $uploads->getLastSixUploads();

$users = new UserController();
$get_user_info = $users->getAllUsersByPerm(2);

$namearray=[];
$percentarray = [];
foreach($get_user_info as $user){
    $useruploadcount = $uploads->getAllUserUploadsCount($user['id']);
    $userverifiedcount = $uploads->getAllUserUploadsCountByVerified($user['id']);
    if($useruploadcount["COUNT('id')"] > 0){
        $percent=round(($userverifiedcount["COUNT('id')"]/$useruploadcount["COUNT('id')"])*100);
    }else{
        $percent='0';
    }
    $percentarray[$user['naam']] = $percent;
    array_push($namearray,$user['naam']);
}
arsort($percentarray);

array_values($percentarray);

if(count($percentarray) <= 4) {
    $count = count($percentarray);
} 
else {
    $count = 4;
}

$i=0;
while($i < $count) {
    if (array_key_exists($namearray[$i], $percentarray) ) {
        ${'p'.$i} = array_values($percentarray)[$i];
        ${'u'.$i} = array_keys($percentarray)[$i];
    }
    $i++;
}

if($get_filled_info == null) {
    echo '<div id="NoMail">Er zijn nog geen proeven of offertes geüpload</div>';
    return false;
}

$items = new MailController();

$get_items_openstaand = $items->getUserMailByStatus(0);
$get_items_bekeken = $items->getUserMailByStatus(1);
$get_items_geweigerd = $items->getUserMailByStatus(3);
$get_items_geaccepteerd = $items->getUserMailByStatus(2);

$total_accept_weiger = $get_items_geaccepteerd['COUNT(status)']+$get_items_geweigerd['COUNT(status)'];
$total_items = $get_items_geaccepteerd['COUNT(status)']+$get_items_geweigerd['COUNT(status)']+$get_items_openstaand['COUNT(status)']+$get_items_bekeken['COUNT(status)'];
$_SESSION['geaccepteerd_percent'] = $get_items_geaccepteerd['COUNT(status)'];
$_SESSION['geweigerd_percent'] = $get_items_geweigerd['COUNT(status)'];
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Home</p>
                <hr size="1">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="well widgetwell">
                            <div class="caption">
                                <div class="widget-header bg-success"></div>
                                <div class="widget-body text-center">
                                    <div>
                                        <p style="text-align: center;">Verschil akkoord & geweigerd</p>
                                        <canvas id="myChart" width="200" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div style="text-align: center;" class="well widgetwell">
                            <div class="caption">
                                <div class="widget-header bg-success"></div>
                                <div class="widget-body text-center">
                                    <div>
                                        <p style="text-align: center;">Totaal aantal opdrachten</p>
                                        <div class="counter overzichtcount" data-count="<?= $total_items ?>">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="well widgetwell">
                            <div class="caption">
                                <div class="widget-header bg-success"></div>
                                <div class="widget-body text-center">
                                    <p style="text-align: center;">Procent akkoord per persoon</p>

                                    <?php if(isset($u0) && isset($p0)) { ?>
                                    <div class="skillbar clearfix " data-percent="<?=$p0?>%">
                                        <div class="skillbar-title" style="background: #5c1863;"><span><?=$u0?></span></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent"><?=$p0?>%</div>
                                    </div> <!-- End Skill Bar -->
                                    <?php } else {?>
                                    <div class="skillbar clearfix " data-percent="0%">
                                        <div class="skillbar-title" style="background: #5c1863;"><span></span></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent">0%</div>
                                    </div> <!-- End Skill Bar -->
                                    <?php } ?>

                                    <?php if(isset($u1) && isset($p1)) { ?>
                                    <div class="skillbar clearfix " data-percent="<?=$p1?>%">
                                        <div class="skillbar-title" style="background: #b41236;"><span><?=$u1?></span></div>
                                        <div class="skillbar-bar" style="background: #ba2e4d;"></div>
                                        <div class="skill-bar-percent"><?=$p1?>%</div>
                                    </div> <!-- End Skill Bar -->
                                    <?php } else {?>
                                    <div class="skillbar clearfix " data-percent="0%">
                                        <div class="skillbar-title" style="background: #5c1863;"><span></span></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent">0%</div>
                                    </div> <!-- End Skill Bar -->
                                    <?php } ?>

                                    <?php if(isset($u2) && isset($p2)) { ?>
                                    <div class="skillbar clearfix " data-percent="<?=$p2?>%">
                                        <div class="skillbar-title" style="background: #b41236;"><span><?=$u2?></span></div>
                                        <div class="skillbar-bar" style="background: #ba2e4d;"></div>
                                        <div class="skill-bar-percent"><?=$p2?>%</div>
                                    </div> <!-- End Skill Bar -->
                                    <?php } else {?>
                                    <div class="skillbar clearfix " data-percent="0%">
                                        <div class="skillbar-title" style="background: #5c1863;"><span></span></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent">0%</div>
                                    </div> <!-- End Skill Bar -->
                                    <?php } ?>

                                    <?php if(isset($u3) && isset($p3)) { ?>
                                    <div class="skillbar clearfix " data-percent="<?= $p3 ?>%">
                                        <div class="skillbar-title" style="background: #822b8b;"><span><?=$u3?></span></div>
                                        <div class="skillbar-bar" style="background: #b340bf;"></div>
                                        <div class="skill-bar-percent"><?=$p3?>%</div>
                                    </div> <!-- End Skill Bar -->
                                    <?php } else {?>
                                    <div class="skillbar clearfix " data-percent="0%">
                                        <div class="skillbar-title" style="background: #5c1863;"><span></span></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent">0%</div>
                                    </div> <!-- End Skill Bar -->
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br><br><br>

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
                    <tr>
                        <div class="alert alert-danger" role="alert">Er is nog geen item om weer te geven. Voeg een item toe op de uploadpagina.</div>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                </table>
        </div>
    </div>
</div>
