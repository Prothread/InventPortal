<?php

if(isset($_SESSION['usr_id'])) {
    header("Location: index.php");
}

$user = new UserController();

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {

    /*$name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);*/

    $name = ( $_POST['name'] );
    $email = ( $_POST['email'] );
    $password = ( $_POST['password'] );
    $cpassword = ($_POST['cpassword'] );
    
    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Voer een geldig e-mailadres in.";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Het paswoord moet minimaal 6 tekens bevatten.";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "De ingevoerde wachtwoorden komen niet overeen.";
    }
    if (!$error) {

        $userinfo = [
            'name' => $name,
            'email' => $email,
            'password' => $cpassword
        ];

        if($user->create($userinfo)) {
            $successmsg = "Succesvol geregistreerd! <a href='index.php'>Klik hier om in te loggen.</a>";
        }
        else {
            $errormsg = "Er is een probleem opgetreden tijdens het registeren, probeer het later opnieuw.";
        }

        /*if(mysqli_query($con, "INSERT INTO users(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
            $successmsg = "Succesvol geregistreerd! <a href='index.php'>Klik hier om in te loggen.</a>";
        } else {
            $errormsg = "Er is een probleem opgetreden tijdens het registeren, probeer het later opnieuw.";
        }*/
    }
}
?>
    <div id="h">
      <div class="logo">Login Systeem</div>
      <div class="social hidden-xs">

      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 centered">
              <form role="form" method="post" name="signupform">
                <fieldset>
                    <legend>Nieuw account</legend>

                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" name="name" placeholder="Volledige naam" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">E-mail</label>
                        <input type="text" name="email" placeholder="E-mail" required value="<?php if($error) echo $email; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Wachtwoord</label>
                        <input type="password" name="password" placeholder="Wachtwoord" required class="form-control" />
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Herhaal wachtwoord</label>
                        <input type="password" name="cpassword" placeholder="Herhaal wachtwoord" required class="form-control" />
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="signup" value="Aanmaken" class="btn btn-primary" />
                    </div>
                </fieldset>
              </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        <br />
        Al een account? <a href="index.php">Log hier in!</a>
        </div>
    </div>
</div>
          </div>
        </div><!--/row-->
      </div><!--/container-->
    </div><!-- /H -->