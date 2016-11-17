<?php
#PAGE FOR SHOWING PROFILE

if($user->getPermission($permgroup, 'CAN_SHOW_USERS') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$user = new UserController();
$session = new Session();

$_GET['id'] = $session->clean($_GET['id']);

$userinfo = $user->getUserById($_GET['id']);
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 profile">
                <div class="container">
                    <table style="width:100%">
                        <tr>
                            <th style="text-align: left;"><p class="NameText" style="font-weight: normal;">Profiel: <?= $userinfo['naam'] ?></p></th>
                            <th style="text-align: right;">

                                <a href="?page=editclient&id=<?= $_GET['id'] ?>">
                                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Wijzig gebruiker</button>
                                </a>

                            </th>
                            </th>
                        </tr>
                    </table>
                    <hr>

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="<?= DIR_IMG . $userinfo['profimg'] ?>" width="150px" height="150px;" class="avatar img-circle" alt="avatar">

                                <input class="form-control" type="file">
                            </div>
                        </div>

                        <!-- edit form column -->
                        <div class="col-md-9 personal-info">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Naam</label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['naam'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Bedrijfsnaam:</label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['bedrijfsnaam'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Email:</label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['email'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Adres:</label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['adres'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Postcode:</label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" size="6" value="<?= $userinfo['postcode'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Plaats:</label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $userinfo['plaats'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Rechten:</label>
                                    <div class="col-lg-8">
                                        <input disabled class="form-control" value="<?= $permgroup ?>" type="text">
                                    </div>
                                </div>
                                <!--<div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <input disabled class="btn btn-primary" value="Opslaan" type="button">-->
                                <span></span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <br />
        <br />

    </div>
    <hr>



</div>
</div>
</fieldset>
</form>
</div>
</div>
</div>
</div>

