<?php
#DASHBOARD PAGE LAAT RECENTE ITEMS ZIEN

if ($user->getPermission($permgroup, 'CAN_SHOW_HOME') == 1) {

} else {
    $block->Redirect('index.php?page=userdashboard');
}

$uploads = new BlockController();
$get_all_items = $uploads->getUploads();
$get_filled_info = $uploads->getLastSixUploads();

$users = new UserController();
$get_user_info = $users->getAllUsersByPerm(1);

$namearray = [];
$percentarray = [];
if ($get_user_info !== null) {
    foreach ($get_user_info as $user) {
        $useruploadcount = $uploads->getAllUserUploadsCount($user['id']);
        $userverifiedcount = $uploads->getAllUserUploadsCountByVerified($user['id']);
        if ($useruploadcount["COUNT('id')"] > 0) {
            $percent = round(($userverifiedcount["COUNT('id')"] / $useruploadcount["COUNT('id')"]) * 100);
        } else {
            $percent = '0';
        }
        $singleName = explode(' ', trim($user['naam']));
        $user['naam'] = $singleName[0];
        $percentarray[$user['naam']] = $percent;
        array_push($namearray, $user['naam']);
    }
    arsort($percentarray);


    array_values($percentarray);

    if (count($percentarray) <= 4) {
        $count = count($percentarray);
    } else {
        $count = 4;
    }

    $i = 0;
    while ($i < $count) {
        if (array_key_exists($namearray[$i], $percentarray)) {
            ${'p' . $i} = array_values($percentarray)[$i];
            ${'u' . $i} = array_keys($percentarray)[$i];
        }
        $i++;
    }
}

if ($get_filled_info == null) {
    echo '<div id="NoMail" class="alert alert-info">Er zijn nog geen proeven of offertes geüpload</div>';
    return false;
}

$items = new MailController();

$get_items_openstaand = $items->getUserMailByStatus(0);
$get_items_bekeken = $items->getUserMailByStatus(1);
$get_items_geweigerd = $items->getUserMailByStatus(3);
$get_items_geaccepteerd = $items->getUserMailByStatus(2);

$total_accept_weiger = $get_items_geaccepteerd['COUNT(status)'] + $get_items_geweigerd['COUNT(status)'];
$total_items = $get_items_geaccepteerd['COUNT(status)'] + $get_items_geweigerd['COUNT(status)'] + $get_items_openstaand['COUNT(status)'] + $get_items_bekeken['COUNT(status)'];
$open_items = $get_items_openstaand['COUNT(status)'];

$_SESSION['geaccepteerd_percent'] = $get_items_geaccepteerd['COUNT(status)'];
$_SESSION['geweigerd_percent'] = $get_items_geweigerd['COUNT(status)'];
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText"><?= TEXT_HOME ?></p>
                <hr size="1">
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="well widgetwell">
                        <div class="caption">
                            <div class="widget-header bg-success"></div>
                            <div class="widget-body text-center">
                                <div id="chartHolder">
                                    <p style="text-align: center;"><?= TEXT_DIAGRAM ?></p>
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
                            <div class="widget-body text-center">
                                <p style="text-align: center;"><?= TEXT_ASSIGNMENTS ?></p>
                                <div class="counter overzichtcount" data-count="<?= $open_items ?>">0</div>
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
                                <p style="text-align: center;"><?= TEXT_DIAGRAM_PERCENTAGE ?></p>
                                <?php if (isset($p0) && $p0 !== '0') { ?>
                                    <div class="skillbar clearfix" data-percent="<?= $p0 ?>%">
                                        <div class="skillbar-title"
                                             style="visibility: hidden;position: relative;"></div>
                                        <div class="skillbar-text"><?= $u0 ?></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent"><?= $p0 ?>%</div>
                                    </div> <!-- End Skill Bar -->
                                <?php } else { ?>
                                    <div class="skillbar clearfix " data-percent="0>%">
                                        <div class="skillbar-title"
                                             style="visibility: hidden;position: relative;"></div>
                                        <div style="position: absolute; color: black; left: 6%; top: 16%;"></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent">0%</div>
                                    </div> <!-- End Skill Bar -->
                                <?php } ?>

                                <?php if (isset($p1) && $p1 !== '0') { ?>
                                    <div class="skillbar clearfix" data-percent="<?= $p1 ?>%">
                                        <div class="skillbar-title"
                                             style="visibility: hidden;position: relative;"></div>
                                        <div class="skillbar-text"><?= $u1 ?></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent"><?= $p1 ?>%</div>
                                    </div> <!-- End Skill Bar -->
                                <?php } else { ?>
                                    <div class="skillbar clearfix" data-percent="0%">
                                        <div class="skillbar-title"
                                             style="visibility: hidden;position: relative;"></div>
                                        <div style="position: absolute; color: black; left: 6%; top: 16%;"></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent">0%</div>
                                    </div> <!-- End Skill Bar -->
                                <?php } ?>

                                <?php if (isset($p2) && $p2 !== '0') { ?>
                                    <div class="skillbar clearfix" data-percent="<?= $p2 ?>%">
                                        <div class="skillbar-title"
                                             style="visibility: hidden;position: relative;"></div>
                                        <div class="skillbar-text"><?= $u2 ?></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent"><?= $p2 ?>%</div>
                                    </div> <!-- End Skill Bar -->
                                <?php } else { ?>
                                    <div class="skillbar clearfix" data-percent="0%">
                                        <div class="skillbar-title"
                                             style="visibility: hidden;position: relative;"></div>
                                        <div style="position: absolute; color: black; left: 6%; top: 16%;"></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent">0%</div>
                                    </div> <!-- End Skill Bar -->
                                <?php } ?>

                                <?php if (isset($p3) && $p3 !== '0') { ?>

                                    <div class="skillbar clearfix " data-percent="<?= $p3 ?>%">
                                        <div class="skillbar-title"
                                             style="visibility: hidden;position: relative;"></div>
                                        <div class="skillbar-text"><?= $u3 ?></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent"><?= $p3 ?>%</div>
                                    </div> <!-- End Skill Bar -->
                                <?php } else { ?>
                                    <div class="skillbar clearfix " data-percent="0%">
                                        <div class="skillbar-title"
                                             style="visibility: hidden;position: relative;"></div>
                                        <div style="position: absolute; color: black; left: 6%; top: 16%;"></div>
                                        <div class="skillbar-bar" style="background: #a625b3;"></div>
                                        <div class="skill-bar-percent">0%</div>
                                    </div> <!-- End Skill Bar -->
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($get_filled_info !== null) {
                foreach ($get_filled_info as $upload) { ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="well widgetwell">
                                <div class="caption">
                                    <div class="widget-header bg-success"></div>
                                    <div class="widget-body text-center">
                                        <img alt="Profile Picture" class="widget-img img-circle img-border"
                                             src="css/madalco.png">
                                        <h3><a href="?page=item&id=<?= $upload['id'] ?>"><?= $upload['onderwerp'] ?></a>
                                        </h3>
                                        <p><?= TEXT_SENDER ?>:
                                            <?php
                                            $usr = $users->getUserById($upload['verstuurder']);
                                            echo $usr['naam'];
                                            ?>
                                        </p>
                                        <p><?= TEXT_ASSIGNFOR ?>:
                                            <?php
                                            $usr = $users->getUserById($upload['naam']);
                                            echo $usr['naam'];
                                            ?>
                                        </p>
                                        <p><?= TEXT_DATE ?>: <?= date("d-m-Y", strtotime($upload['datum'])); ?></p>
                                        <p><?= TEXT_PROGRESS ?>: <?php if ($upload['verified'] == 1) { ?></p>
                                        <p><span style="Color: #bb2c4c"><?= TEXT_SEEN ?></span></p>
                                        <?php } else if ($upload['verified'] == 2) { ?>
                                            <p><span style="Color: #bb2c4c"><?= TEXT_ACCORDED ?></span></p>
                                        <?php } else if ($upload['verified'] == 3) { ?>
                                            <p><span style="Color: #bb2c4c"><?= TEXT_DECLINED ?></span></p>
                                        <?php } else { ?>
                                            <p><span style="Color: #bb2c4c"><?= TEXT_UPLOADED ?></span></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                ?>
                <tr>
                    <div class="alert alert-danger" role="alert">Er is nog geen item om weer te geven. Voeg een item toe
                        op de uploadpagina.
                    </div>
                </tr>
                <?php
            }
            ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
