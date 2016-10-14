<?php

if(isset($_SESSION['usr_id'])!="") {
    header("Location: index.php?page=dashboard");
}

$user = new UserController();

//check if form is submitted
if (isset($_POST['login'])) {

    //TODO --> mysqli_real_escape_string;

    $email = $_POST['email'];
    $password = $_POST['password'];

    $userinfo = [
        'email' => $email,
        'password' => $password
    ];

    if($row = mysqli_fetch_array( $user->getUser($userinfo) )) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];
    }
    else {
        $errormsg = "Verkeerde combinatie, probeer het opnieuw.";
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


                        <form role="form" method="post" name="loginform">
                <fieldset>
                    <img src="madalco.jpg">
                    
                        <label for="name">E-mailadres</label>
                        <input type="text" name="email" placeholder="E-mailadres" required class="form-control" />
                        <br/>
                        <label for="name">Wachtwoord</label>
                        <input type="password" name="password" placeholder="Wachtwoord" required class="form-control" />
                        <br />
                        <input type="submit" name="login" value="Inloggen" class="btn btn-primary" />
                        <br />
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        <br />
        Nog geen account? <a id="linktext" href="?page=register">Maak er hier een aan!</a>
        </div>
    </div>
</div>
          </div>
        </div><!--/row-->
      </div><!--/container-->
    </div><!-- /H -->