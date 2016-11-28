<?php
#PAGE FOR CREATING CLIENTS

$user = new UserController();
$mysqli = mysqli_connect();

$userinfo = $user->getUserById($_SESSION['usr_id']);
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 profile">
                <div class="container">
                    <table style="width:100%">
                        <tr>
                            <th style="text-align: left;"><p class="NameText" style="font-weight: normal;">Uw profiel</p></th>
                            <th style="text-align: right;">
                                <a href="?page=gebruikersoverzicht">
                                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                        <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span>  Mijn overzicht</button>
                                </a>

                                <a href="?page=editprofiel">
                                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Wijzig profiel</button>
                                </a>

                                <a href="?page=newpassword">
                                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                        <span class="btn-label"><i class="glyphicon glyphicon-lock"></i></span>Wijzig wachtwoord</button>
                                </a>

                            </th>
                        </tr>
                    </table>
                    <hr>

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="<?= DIR_IMG . $userinfo['profimg'] ?>" width="150px" height="150px;" class="avatar img-circle" alt="avatar">
                            </div>
                        </div>

                        <!-- edit form column -->
                        <div class="col-md-9 personal-info">
                            <form class="form-horizontal" role="form" action="?page=editingprofile" enctype="multipart/form-data" method="post">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" for="textinput">Logo uploaden</label>
                                    <div class="col-md-4">
                                        <label for="file-upload" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i> Uploaden
                                        </label>
                                        <input type="file" name="fileToUpload" class="imgInp btn btn-primary btn-success" id="file-upload">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label" for="textinput">Geselecteerd bestand</label>
                                    <div class="col-md-4">
                                        <div id="fileList"></div>

                                        <output id="list"></output>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Naam</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['naam'] ?>" type="text" name="naam">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Bedrijfsnaam:</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['bedrijfsnaam'] ?>" type="text" name="bedrijfsnaam">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Email:</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['email'] ?>" type="text" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Adres:</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['adres'] ?>" type="text" name="adres">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Postcode:</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" size="6" value="<?= $userinfo['postcode'] ?>" type="text" name="postcode">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Plaats:</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" value="<?= $userinfo['plaats'] ?>" type="text" name="plaats">
                                    </div>
                                </div>

                                <?php if($user->getPermission($permgroup, 'CAN_EDIT_USER')) { ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label" for="textinput">Rechtgroepen</label>
                                    <div class="col-lg-8">
                                        <label class="col-md-2 control-label" for="textinput">Klant: 1</label>
                                        <label class="col-sm-3 control-label" for="textinput">Gebruiker: 2</label>
                                        <label class="col-sm-3 control-label" for="textinput">Beheerder: 3</label>
                                        <label class="col-sm-3 control-label" for="textinput">Admin: 4</label>
                                    </div>
                                </div>
                                <?php } ?>

                                <?php if($user->getPermission($permgroup, 'CAN_EDIT_USER')) { ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Rechten:</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" value="<?= $userinfo['permgroup'] ?>" type="text" name="rechten">
                                        </div>
                                    </div>
                                <?php } else {?>
                                    <input class="form-control" value="<?= $userinfo['permgroup'] ?>" type="hidden" name="rechten">
                                <?php } ?>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-md-4">
                                        <input class="btn btn-primary btn-success" name="submit"  style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c" type="submit" value="Opslaan">
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

