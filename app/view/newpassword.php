<?php

$mysqli = mysqli_connect();
$user = new UserController();

//set validation error flag as false
$error = false;


//check if form is submitted
if (isset($_POST['newpassword'])) {

    $id = $_SESSION['usr_id'];
    $myuser = $user->getUserById($id);

    $password = mysqli_real_escape_string( $mysqli, $_POST['password'] );
    $oldhash = $myuser['paswoord'];

    $cpassword = mysqli_real_escape_string( $mysqli, $_POST['cpassword'] );
    $newcpassword = mysqli_real_escape_string( $mysqli, $_POST['newcpassword'] );

    //name can contain only alpha characters and space
    if(strlen($cpassword) < 6) {
        $error = true;
        $password_error = "Het paswoord moet minimaal 6 tekens bevatten.";
    }

    if($oldhash !== hash('sha256', $password)){
        $error = true;
        $password_error = "Het ingevulde huidige wachtwoord komt niet overeen.";
    }

    if($cpassword !== $newcpassword){
        $error = true;
        $password_error = "De ingevulde nieuwe wachtwoorden komen niet overeen";
    }

    if (!$error) {

        $npassword = hash('sha256', $cpassword);

        if($user->updateUser($id, $npassword)) {
            $successmsg = "Wachtwoord succesvol gewijzigd!";
        }
        else {
            $errormsg = "Er is een probleem opgetreden tijdens het veranderen van uw wachwoord, probeer het later opnieuw.";
        }

    }
}
?>

    <div id="h">
      <div class="social hidden-xs">

      </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 centered">
                    <form role="form" method="post" name="signupform">
                        <fieldset>
                        <br>
                            <div class="form-group">
                                <label for="name">Huidig wachtwoord</label>
                                <input type="password" name="password" placeholder="Wachtwoord" required class="form-control" />
                                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="name">Nieuw wachtwoord</label>
                                <input type="password" id="password" name="cpassword" placeholder="Nieuw wachtwoord" required class="form-control" />
                                <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="name">Herhaal nieuw wachtwoord</label>
                                <input type="password" name="newcpassword" placeholder="Nieuw wachtwoord" required class="form-control" />
                                <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                            </div>
                            <br>
                            <p style="font-size: 16px;">De sterkte van uw gekozen wachtwoord</p>
                            <div class="progress progress-striped active">
                              <div id="jak_pstrength" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" name="newpassword" value="Aanpassen" class="btn btn-primary" />
                            </div>
                        </fieldset>
                    </form>
                    <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
                    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
                </div>
            </div>
        </div>
</div>
<script src="../public/js/jquery-1.10.2.js"></script>
<script src="../public/js/bootstrap.min.js"></script>
          </div>
        </div><!--/row-->
      </div><!--/container-->
    </div><!-- /H -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../public/js/jquery.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>
    <script src="../public/js/retina-1.1.0.js"></script>
  </body>
</html>