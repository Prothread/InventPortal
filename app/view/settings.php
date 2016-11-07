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
                <form class="MailSettings" action="?page=settingsupload" method="post" enctype="multipart/form-data">
                    <label>SMTP-adres<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="smtp" size="50" value="<?= $admin['SMTP'] ?>">&emsp;&emsp;<br><br>

                    <label>E-mailadres <span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="email" size="50" value="<?= $admin['Email'] ?>">&emsp;&emsp;<br><br>

                    <br>
                    <p class="ClientFormText">Stijlinstellingen</p>
                    <hr size="1">

                    <label>Logo aanpassen</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <br>

                    <label>Achtergrondkleur header</label>
                    <input type="text" size="8" name="headerkleur" value="<?= $admin['Header'] ?>">
                    <br><br><br>
                    <input type="submit" name="submit" size="50" value="Opslaan">

                </form>
            </div>
        </div>
    </div>
</div>
