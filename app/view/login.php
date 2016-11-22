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
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <title>Inloggen</title>

    <!-- Bootstrap core CSS -->
    <link href="public/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="public/css/ionicons.min.css" rel="stylesheet">
    <link href="public/css/loginstyle.css" rel="stylesheet">


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="public/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

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
                        <a style="color: #fff;"href="index.php?page=forgetpassword">Wachtwoord vergeten?</a>
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
  </body>
</html>
