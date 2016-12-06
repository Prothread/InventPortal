<?php

$mysqli = mysqli_connect();

$user = new UserController();

//check if form is submitted
if (isset($_SESSION['usr_id'])) {
    $block->Redirect('Location: index.php');
}

$user = new UserController();

if(isset($_POST['submit'])) {
    //Generate a random string.
    $token = openssl_random_pseudo_bytes(16);

    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    $passforget = $token;

    $getbyemail = $user->getUserByEmail($_POST['email']);
    $email = $_POST['email'];
    var_dump($getbyemail);

    if($getbyemail !== null) {
        $user->passForget($_POST['email'], $token);

        $link = "http://localhost/InventPortal/index.php?page=resetpassword&email=$email&token=$token";
        $mymail = new MailController();

        //Load PHPMailer dependencies
        require_once DIR_MAILER . 'PHPMailerAutoload.php';
        require_once DIR_MAILER . 'class.phpmailer.php';
        require_once DIR_MAILER . 'class.smtp.php';

        require_once DIR_MODEL . 'MailSettings.php';

        if (isset($_POST['submit'])) {

            /* Create phpmailer and add the image to the mail */
            $mailer = new PHPMailer();

            $settings = new UserController();
            $admin = $settings->getAdminSettings();

            $mailer->addEmbeddedImage(DIR_PUBLIC . $admin['Logo'], "HeaderImage", "Logo.png");

            /* TO, SUBJECT, CONTENT */
            $to = $email; //The 'To' field
            $subject = "Aanvraag voor wachtwoord vergeten";

            $header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                            <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                                <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                            </div>
                        </div> ';
            $content = $header ."  <br/><br/>" . "Geachte " . $getbyemail['naam'] . "," .
                " <br/><br/>" . "Wachtwoord vergeten: " . "<br /><br />" .
                "<b>Link om uw wachtwoord te veranderen: </b>".
                "<a href='$link'>Link</a>" . "<br /><br />" .

                "Als U dit niet heeft aangevraagd, kunt U dit negeren, uw wachtwoord veranderen of dit aangeven bij de administrators " .

                "<br /> <br />Met vriendelijke groet, <br />" . " Madalco Media";
            $altcontent = "Geachte " . $getbyemail['naam'] . "," .
                " <br/><br/>" . "Wachtwoord vergeten: " . "<br /><br />" .
                "<b>Link om uw wachtwoord te veranderen: </b>".
                $link . "<br />" .

                "Als U dit niet heeft aangevraagd, kunt U dit negeren, uw wachtwoord veranderen of dit aangeven bij de administrators " .

                "<br /> <br />Met vriendelijke groet, <br />"  . " Madalco Media";;

//SMTP Configuration
            $mailer->isSMTP();
            $mailer->SMTPAuth = true; //We need to authenticate
            $mailer->Host = $smtp['host'];
            $mailer->Port = $smtp['port'];
            $mailer->Username = $smtp['username'];
            $mailer->Password = $smtp['password'];
            $mailer->SMTPSecure = $smtp['secure'];

//Now, send mail :
//From - To :
            $mailer->From = $crendentials['email'];
            $mailer->FromName = 'Madalco media'; //Optional
            $mailer->addAddress($to);  // Add a recipient

//Subject - Body :
            $mailer->Subject = $subject;
            $mailer->Body = $content;
            $mailer->isHTML(true); //Mail body contains HTML tags
            $mailer->AltBody = $altcontent;

//Saving mail information

            $mailer->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
//Check if mail is sent :
            if (!$mailer->send()) {
                $block->Redirect('index.php?page=phpmail');
                //echo 'Error sending mail : ' . $mailer->ErrorInfo;
                Session::flash('error', $mailer->ErrorInfo);
            } else {
                //If mail is send, create data and send it to the database
                $block->Redirect('index.php');
                Session::flash('message', 'Uw aanvraag is verstuurd.');
            }
        }


    }
    else {
        echo '<div class="alert alert-info">Gebruiker bestaat niet</div>';
    }

}
?>
     <div id="h">
      <div class="social hidden-xs">

      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 centered loginbar">
                <form role="form" method="post" name="loginform" action="?page=forgetpassword">
                <fieldset>
                    <img style="width: 254px; height: 256px;" src="img/madalco.png">
                    <br>
                    <br>
                        <label>Als u uw wachtwoord bent vergeten, vul dan hieronder uw e-mailadres in.</label>
                        <br />
                        <br />
                        <label for="name">E-mailadres</label>
                        <br />
                        <input type="text" name="email" placeholder="E-mailadres" required class="form-control" />
                        <br/>
                        <br />
                        <input type="submit" name="submit" value="Verstuur wachtwoord" class="btn btn-primary" />
                        <br />
                        <br />
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

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
          </div>

      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 centered">
          </div><!--/row-->
        </div><!--/container-->
      </div><!-- /H -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/retina-1.1.0.js"></script>
  </body>
</html>
