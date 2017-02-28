<?php
#PAGE FOR SHOWING PROFILE

$user = new UserController();
$userinfo = $user->getUserById($_SESSION['usr_id']);
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 profile">
                <div class="container">
                    <table style="width:100%">
                        <tr>
                            <th style="text-align: left;"><p class="NameText"
                                                             style="font-weight: normal;"><?= TEXT_YOUR_PROFILE ?></p>
                            </th>
                            <th style="text-align: right;">

                                <a href="?page=useroverview">
                                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                        <span class="btn-label"><i
                                                class="glyphicon glyphicon-list-alt"></i></span> <?= BUTTON_MYOVERVIEW ?>
                                    </button>
                                </a>

                                <a href="?page=editprofile">
                                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                        <span class="btn-label"><i
                                                class="glyphicon glyphicon-pencil"></i></span><?= TEXT_EDIT_PROFILE ?>
                                    </button>
                                </a>

                                <a href="?page=newpassword">
                                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                        <span class="btn-label"><i
                                                class="glyphicon glyphicon-lock"></i></span><?= TEXT_EDIT_PASSWORD ?>
                                    </button>
                                </a>

                            </th>
                        </tr>
                    </table>
                    <hr>

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-3">
                            <div class="text-center">
                                <div
                                    style="background: url(<?= DIR_IMG . $userinfo['profimg'] ?>); background-size: cover; width: 200px; height: 200px; background-position: 50%; margin: 0 auto"
                                    class="avatar img-circle"></div>
                                <input class="form-control" type="file">
                            </div>
                        </div>

                        <!-- edit form column -->
                        <div class="col-md-9 personal-info">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_NAME ?></label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['naam'] ?>"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_COMPANY_NAME ?></label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['bedrijfsnaam'] ?>"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_EMAIL ?></label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['email'] ?>"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_ADRESS ?></label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['adres'] ?>"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_POSTALCODE ?></label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" size="6"
                                               value="<?= $userinfo['postcode'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_CITY ?></label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['plaats'] ?>"
                                               type="text">
                                    </div>
                                </div>

                                <?php if ($user->getPermission($permgroup, 'CAN_EDIT_USER') == '1') { ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?= TEXT_PERMISSION ?></label>
                                        <div class="col-lg-8">
                                            <input disabled class="form-control" value="<?= $mypermgroup ?>"
                                                   type="text">
                                        </div>
                                    </div>
                                <?php } ?>
                                <!--<div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <input disabled class="btn btn-primary" value="Opslaan" type="button">-->
                                <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <br/>


    </div>
    <hr>


</div>