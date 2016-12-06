<?php
#SETTINGS PAGE

if($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1){

}
else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Instellingen</p>
                <br>
                <br>
                <p class="ClientFormText">E-mailverkeer</p>
                <hr size="1">
                <form method="post" enctype="multipart/form-data" class="form-horizontal" action="?page=settingsupload">

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">SMTP-adres</label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="text" name="smtp" size="50" value="<?= $admin['SMTP'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">SMTP-port</label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="text" name="smtpport" size="50" value="<?= $admin['SMTPport'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">E-mailadres</label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="text" name="email" size="50" value="<?= $admin['Email'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">E-mailadres wachtwoord</label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="password" name="emailpassword" size="50" value="<?= $admin['Mailpass'] ?>">
                        </div>
                    </div>

                    <br>


                    <p class="ClientFormText">Stijlinstellingen</p>
                    <hr size="1">

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Logo uploaden</label>
                        <div class="col-md-4">
                            <label for="file-upload" class="custom-file-upload">
                                <i class="fa fa-cloud-upload"></i> Uploaden
                            </label>
                            <input type="file" name="fileToUpload" class="imgInp btn btn-primary btn-success" id="file-upload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Geselecteerd logo:</label>
                        <div class="col-md-4">
                            <div id="fileList"></div>

                            <output id="list"></output>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Achtergrondkleur header</label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="text" name="headerkleur" size="50" value="<?= $admin['Header'] ?>" placeholder="#dd2c4c/rgb(..,..,..)">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"></label>
                        <div class="col-md-4">
                            <input class="btn btn-primary btn-success" name="submit" style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #bb2c4c" type="submit" value="Opslaan">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
