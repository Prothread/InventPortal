<?php

$mysqli = mysqli_connect();

$user = new UserController();

$redirect = NULL;

//check if form is submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string( $mysqli, $_POST['email']);
    $password = mysqli_real_escape_string( $mysqli, $_POST['password']);

    $userinfo = [
        'email' => strip_tags($email),
        'password' => strip_tags($password)
    ];

    if($row = mysqli_fetch_array( $user->getUser($userinfo) )) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['naam'];
    }

    else {
        $errormsg = "Verkeerde combinatie, probeer het opnieuw.";
    }

    if(isset($_SESSION['usr_id'])!="") {
        if($_GET['page']) {
            header("Refresh:0");
        }
        else {
            header("Location: index.php?page=dashboard");
        }
    }

}
?>
  <?php if($session->exists('flash')) {
      foreach($session->get('flash') as $flash) {
          echo "<div class='alert alert_{$flash['type']}'>{$flash['message']}</div>";
      }
      $session->remove('flash');
  }?>

    <div id="h">
      <div class="social hidden-xs">

      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 centered loginbar" id="slide">


                        <form role="form" method="post" name="loginform">
                <fieldset>
                    <img style="width: 254px; height: 256px;" src="public/img/madalco.png" class="fade-in one">
                    <br>
                    <br>
                        <label for="name">E-mailadres</label>
                        <input type="text" name="email" placeholder="E-mailadres" required class="form-control" />
                        <br/>
                        <label for="name">Wachtwoord</label>
                        <input type="password" name="password" placeholder="Wachtwoord" required class="form-control" />
                        <br />
                        <input type="submit" name="login" value="Inloggen" class="btn btn-primary" />
                        <br />
                        <br />
                        <a style="color: #fff;" href="index.php?page=forgetpassword">Wachtwoord vergeten?</a>
                        <br/>
                        <br/>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        <br />
        </div>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
          </div>
        </div><!--/row-->
      </div><!--/container-->
    </div><!-- /H -->




      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 centered">


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/retina-1.1.0.js"></script>
