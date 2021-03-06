<?php
#PAGE FOR CREATING CLIENTS

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
                            <th style="text-align: left;"><p class="NameText" style="font-weight: normal;"><?= TEXT_EDIT_PROFILE ?></p></th>
                        </tr>
                    </table>
                    <hr>

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-3">
                            <div class="text-center">
                                <div style="background: url(<?= DIR_IMG . $userinfo['profimg'] ?>); background-size: cover; width: 200px; height: 200px; background-position: 50%; margin: 0 auto" class="avatar img-circle"></div>
                            </div>
                        </div>

                        <!-- edit form column -->
                        <div class="col-md-9 personal-info">
                            <form class="form-horizontal" role="form" action="?page=editingprofile"
                                  enctype="multipart/form-data" method="post">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" for="textinput"><?= TEXT_UPLOAD_LOGO ?></label>
                                    <div class="col-md-4">
                                        <label for="file-upload" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i> <?= BUTTON_UPLOAD ?>
                                        </label>
                                        <input type="file" name="fileToUpload"
                                               class="imgInp btn btn-primary btn-success" id="file-upload">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label" for="textinput"><?= TEXT_SELECTED_LOGO ?></label>
                                    <div class="col-md-4">
                                        <div id="fileList"></div>

                                        <output id="list"></output>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_NAME ?></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['naam'] ?>" type="text"
                                               name="naam">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_COMPANY_NAME?></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['bedrijfsnaam'] ?>" type="text"
                                               name="bedrijfsnaam">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_EMAIL ?></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['email'] ?>" type="text"
                                               name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_ALTERNATIVE_EMAIL ?></label>
                                    <div class="col-lg-8">
                                        <span style="font-size:15px">Mail voor contact</span>

                                        <input class="form-control" value="<?= $userinfo['altmail'] ?>" type="text"
                                               name="altmail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_ADRESS ?></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['adres'] ?>" type="text"
                                               name="adres">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_POSTALCODE ?></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" size="6" value="<?= $userinfo['postcode'] ?>"
                                               type="text" name="postcode">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_CITY ?></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['plaats'] ?>" type="text"
                                               name="plaats">
                                    </div>
                                </div>

                                <?php if ($user->getPermission($permgroup, 'CAN_EDIT_USER') == '1' && $user->getPermission($permgroup, 'CAN_BE_EDITED') == '1') { ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?= TEXT_PERMISSION ?></label>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="rechten" required>

                                                <?php foreach($user->getAllPermGroups() as $permission) { ?>
                                                    <option
                                                        value="<?= $permission['userperm']; ?>"
                                                        <?php if($userinfo['permgroup'] == $permission['userperm']) { echo 'selected'; } ?>><?= $permission['name'] ?></option>
                                                <?php } ?>


                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if($user->getPermission($permgroup, 'CAN_CHANGE_LANGUAGE')) { ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_LANGUAGE ?></label>
                                    <div class="col-lg-8">
                                        <select class="form-control" type="text" name="taal">
                                            <option value="nl" <?php if($userinfo['lang'] == 'nl') { echo 'selected'; } ?>>Nederlands</option>
                                            <option value="en" <?php if($userinfo['lang'] == 'en') { echo 'selected'; } ?>>English</option>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-md-4">
                                        <input class="btn btn-primary btn-success" name="submit"
                                               style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c"
                                               type="submit" value="<?= BUTTON_SAVE ?>">
                                    </div>
                                </div>

                                <span></span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

