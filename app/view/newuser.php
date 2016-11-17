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

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Rechtgroepen</label>
                            <div class="col-md-4">
                                <label class="col-sm-3 control-label" for="textinput">Klant: 1</label>
                                <label class="col-sm-3 control-label" for="textinput">Gebruiker: 2</label>
                                <label class="col-sm-3 control-label" for="textinput">Beheerder: 3</label>
                                <label class="col-sm-3 control-label" for="textinput">Admin: 4</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Rechtgroep</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" type="text" name="permgroup" size="50" value="2" placeholder="Rechtgroep">
                            </div>
                        </div>

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

