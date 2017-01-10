<?php

if ($_GET['id']) {

    $userid = intval($_GET['id']);
    $userinfo = $user->getUserById($userid);

//Generate a random string.
    $token = openssl_random_pseudo_bytes(8);
//Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    $mymail = new MailController();

//Load PHPMailer dependencies
    require_once DIR_MAILER . '/PHPMailerAutoload.php';
    require_once DIR_MAILER . '/class.phpmailer.php';
    require_once DIR_MAILER . '/class.smtp.php';

    require_once DIR_MODEL . 'MailSettings.php';

    /* Create phpmailer and add the image to the mail */
    $mailer = new PHPMailer();
    $mailer->addEmbeddedImage(DIR_PUBLIC . $admin['Logo'], "HeaderImage", "Logo.png");

    /* TO, SUBJECT, CONTENT */
    if ($userinfo['altmail']) {
        $altmail = $userinfo['altmail'];
        $to = $altmail;
    } else {
        $email = $userinfo['email'];
        $to = $email; //The 'To' field
    }
    $subject = "Accountgegevens Madalco-portaal";

    $link = $admin['Host'] . "/index.php?page=login";

    $header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                        <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                            <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                        </div>
                    </div> ';
    $content = $header . "  <br/><br/>" . "Geachte " . $userinfo['naam'] . "," .

        " <br/><br/>" . $myuser . " heeft uw wachtwoord gereset, hieronder zijn uw gegevens:<br /><br />" .
        "<b>E-mailadres: </b>" .
        $to . '<br/>' .

        "<b>Wachtwoord: </b>" .
        $token .

        "<br /><br />" . "U kunt " . "<a href='$link'>hier</a> " . "inloggen met de gegevens uit deze mail." .

        "<br /><br />Met vriendelijke groet, <br />" . "Madalco Media" .
        "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";

    $altcontent = "Geachte " . $userinfo['naam'] . "," .
        " <br/><br/>" . $myuser . " heeft uw wachtwoord gereset, hieronder zijn uw gegevens:<br /><br />" .
        "<b>E-mailadres: </b>" .
        $to . '<br/>' .

        "<b>Wachtwoord: </b>" .
        $token .

        "<br /><br />" . "U kunt " . "$link " . "inloggen." .

        "<br /> <br />Met vriendelijke groet, <br />" . "Madalco Media" .
        "<br /> <br />Disclaimer: This is an automatically generated mail. Please do not reply to this email";

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
    $mailer->FromName = $myuser; //Optional
    $mailer->addAddress($to);  // Add a recipient

//Subject - Body :
    $mailer->Subject = $subject;
    $mailer->Body = $content;
    $mailer->isHTML(true); //Mail body contains HTML tags
    $mailer->AltBody = $altcontent;

//Saving mail information

    $newuserinfo = [
        'id' => $userid,
        'name' => $userinfo['naam'],
        'password' => $token,
    ];

    $mailer->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

//Check if mail is sent :
    if (!$mailer->send()) {
        $block->Redirect('index.php');
        echo 'Error sending mail : ' . $mailer->ErrorInfo;
    } else {
        //If mail is send, create data and send it to the database
        $user->update($newuserinfo);

        //$block->Redirect('index.php');
    }

}