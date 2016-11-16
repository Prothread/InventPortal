<?php
#PAGE FOR RESET PASSWORD

$user = new UserController();

//Generate a random string.
$token = openssl_random_pseudo_bytes(16);
//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

if(isset($_POST['submit'])) {
    $passforget = $token;

    $getbyemail = $user->getUserByEmail($_POST['email']);
    $email = $_POST['email'];

    if($getbyemail !== null) {
        $user->passForget($_POST['email'], $token);

        $link = "http://localhost/InventPortal/index.php?page=resetpassword&email=$email&token=$token";
        $mymail = new MailController();

            //Load PHPMailer dependencies
            require_once DIR_MAILER . '/PHPMailerAutoload.php';
            require_once DIR_MAILER . '/class.phpmailer.php';
            require_once DIR_MAILER . '/class.smtp.php';

            /* CONFIGURATION */
            $crendentials = array(
                'email' => 'nicle48@gmail.com',    //Your GMail adress
                'password' => 'Moneyhack1'         //Your GMail password
            );

            /* SPECIFIC TO GMAIL SMTP */
            $smtp = array(

                'host' => 'smtp.gmail.com',
                'port' => 587,
                'username' => $crendentials['email'],
                'password' => $crendentials['password'],
                'secure' => 'tls' //SSL or TLS

            );

            if (isset($_POST['submit'])) {

                /* TO, SUBJECT, CONTENT */
                $to = $email; //The 'To' field
                $subject = "Aanvraag voor wachtwoord vergeten";
                $content = "<img alt='MadalcoHeader' src='https://picoolio.net/images/2016/11/04/headerbgcc759.png'>"."  <br/><br/>" . "Geachte " . $getbyemail['naam'] . "," .
                    " <br/><br/>" . "Wachtwoord vergeten: " . "<br /><br />" .
                    "<b>Link om uw wachtwoord te veranderen: </b>".
                    "<a href='$link'>Link</a>" . "<br /><br />" .

                    "<b>Als U dit niet heeft aangevraagd, kunt U dit negeren of dit aangeven bij de administrators</b> " .

                    "<br /> <br />Met vriendelijke groet, <br />" . " Madalco Media";
                $altcontent = "Geachte " . $getbyemail['naam'] . "," .
                    " <br/><br/>" . "Wachtwoord vergeten: " . "<br /><br />" .
                    "<b>Link om uw wachtwoord te veranderen: </b>".
                    $link . "<br />" .

                    "Als U dit niet heeft aangevraagd, kunt U dit negeren of dit aangeven bij de administrators " .

                    "<br /> <br />Met vriendelijke groet, <br />"  . " Madalco Media";;

                $mailer = new PHPMailer();

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
                    header('Location: index.php?page=phpmail');
                    //echo 'Error sending mail : ' . $mailer->ErrorInfo;
                    Session::flash('error', $mailer->ErrorInfo);
                } else {
                    //If mail is send, create data and send it to the database
                    header('Location: index.php');
                    Session::flash('message', 'Uw aanvraag is verstuurd.');
                }
            }


    }

}
?>

<form action="?page=passwordforget" method="post">
    <input class="form-control input-md" id="textinput" type="text" name="email" placeholder="E-mail" >
    <input type="submit" name="submit" value="Versturen">
</form>