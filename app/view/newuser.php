<?php
#PAGE FOR CREATING CLIENTS

if($user->getPermission($permgroup, 'CAN_CREATE_CLIENT') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Nieuwe gebruiker</p>
                <br>


                <form action="?page=clientmail" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <fieldset>

                        <p class="ClientFormText">Namen</p>
                        <hr size="1">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Naam</label>
                            <div class="col-md-4">
                                <input required class="form-control input-md" id="textinput" type="text" name="name" size="50" placeholder="Naam">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Bedrijfsnaam</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" type="text" name="companyname" size="50" placeholder="Bedrijfsnaam">
                            </div>
                        </div>

                        <p class="ClientFormText">Contactgegevens</p>
                        <hr size="1">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">E-mail</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" required type="email" name="email" size="50" placeholder="E-mailadres">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Adres</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" type="text" name="companyadress" size="50" placeholder="Adres">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Postcode</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" type="text" name="postcode" size="50" placeholder="Postcode">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Plaats</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" type="text" name="plaats" size="50" placeholder="Plaats">
                            </div>
                        </div>

                        <br />

                        <?php if($user->getPermission($permgroup, 'CAN_EDIT_USER') == '1') { ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Rechten:</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="rechten" required>
                                        <?php if($userinfo['permgroup'] == '1') {?>
                                            <option selected="selected">Klant</option>
                                        <?php } else { ?>
                                            <option>Klant</option>
                                        <?php } ?>

                                        <?php if($userinfo['permgroup'] == '2') {?>
                                            <option selected="selected">Gebruiker</option>
                                        <?php } else { ?>
                                            <option>Gebruiker</option>
                                        <?php } ?>

                                        <?php if($userinfo['permgroup'] == '3') {?>
                                            <option selected="selected">Beheerder</option>
                                        <?php } else { ?>
                                            <option>Beheerder</option>
                                        <?php } ?>

                                        <?php if($userinfo['permgroup'] == '4') {?>
                                            <option selected="selected">Admin</option>
                                        <?php } else { ?>
                                            <option>Admin</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } else {?>
                            <input class="form-control" value="<?= $userinfo['permgroup'] ?>" type="hidden" readonly name="rechten">
                        <?php } ?>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"></label>
                            <div class="col-md-4">
                                <input class="btn btn-primary btn-success" name="submit"  style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c" type="submit" value="Aanmaken">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

