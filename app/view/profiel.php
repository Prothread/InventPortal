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
            <th style="text-align: left;"><p class="NameText" style="font-weight: normal;">Uw profiel</p></th>
            <th style="text-align: right;">
            
                <a href="?page=gebruikersoverzicht">
                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                    <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Mijn overzicht</button>
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

<?php if ($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1) { ?>
<div class="col-lg-12 profile">

<div class="container">
    <p class="NameText">Admin-instellingen</p>
    <hr>

    <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">

          
          <input class="form-control" type="file">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
      <form method="post" enctype="multipart/form-data" class="form-horizontal" action="?page=settingsupload">
            <div class="form-group">
              <label class="col-lg-3 control-label" for="textinput">SMTP-adres</label>
              <div class="col-md-4">
                  <input class="form-control input-md" id="textinput" required type="text" name="smtp" size="50" value="<?= $admin['SMTP'] ?>">
              </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="textinput">E-mailadres</label>
                <div class="col-md-4">
                    <input class="form-control input-md" id="textinput" required type="text" name="email" size="50" value="<?= $admin['Email'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="textinput">Logo uploaden</label>
                <div class="col-md-4">
                    <label for="file-upload" class="custom-file-upload">
                        <i class="fa fa-cloud-upload"></i> Uploaden
                    </label>
                    <input required type="file" name="fileToUpload" class="imgInp btn btn-primary btn-success" id="file-upload">
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
                <label class="col-lg-3 control-label" for="textinput">Achtergrondkleur header</label>
                <div class="col-md-4">
                    <input class="form-control input-md" id="textinput" required type="text" name="headerkleur" size="50" value="<?= $admin['Header'] ?>">
                </div>
            </div>

                <div class="form-group">
                <label class="col-lg-3 control-label" for="textinput"></label>
                <div class="col-md-4">
                    <input class="btn btn-primary btn-success" name="submit" style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #bb2c4c" type="submit" value="Opslaan">
                </div>
            </div>

              <span></span>
            </div>
          </div>
        </form>
      </div>
  </div>
        <?php } ?>
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

