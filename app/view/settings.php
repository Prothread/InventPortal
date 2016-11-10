<?php
#SETTINGS PAGE

if($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1){

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
                <p class="NameText">Instellingen</p>
                <hr size="1">
                <p class="ClientFormText">E-mailverkeer</p>
                <hr size="1">
                <form method="post" enctype="multipart/form-data" class="form-horizontal" action="?page=settingsupload">

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">SMTP-adres</label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" required type="text" name="smtp" size="50" value="<?= $admin['SMTP'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">E-mailadres</label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" required type="text" name="email" size="50" value="<?= $admin['Email'] ?>">
                        </div>
                    </div>

                    <br>


                    <p class="ClientFormText">Stijlinstellingen</p>
                    <hr size="1">

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Bestand uploaden</label>
                        <div class="col-md-4">
                            <label for="file-upload" class="custom-file-upload">
                                <i class="fa fa-cloud-upload"></i> Uploaden
                            </label>
                            <input required type="file" name="fileToUpload" class="imgInp" id="file-upload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Geselecteerd bestand:</label>
                        <div class="col-md-4">
                            <div id="fileList"></div>

                            <output id="list"></output>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Achtergrondkleur header</label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" required type="text" name="headerkleur" size="50" value="<?= $admin['Header'] ?>">
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
