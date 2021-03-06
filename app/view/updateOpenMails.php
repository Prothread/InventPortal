<?php


if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$mail = new MailController();
$uploads = new BlockController();

$verified = '0, 1';
$get_filled_info = $uploads->getOlderUploads($verified, true);

if ($get_filled_info !== null && !empty($get_filled_info)) {
    foreach ($get_filled_info as $get_info) {

        //Generate a random string.
        $token = openssl_random_pseudo_bytes(16);
        //Convert the binary data into hexadecimal representation.
        $token = bin2hex($token);

        $imageId = $get_info['id'];

        $mailinfo = [
            'id' => $get_info['id'],
            'title' => $get_info['onderwerp'],
            'sender' => $get_info['verstuurder'],
            'description' => $get_info['beschrijving'],
            'name' => $get_info['naam'],
            'email' => $get_info['email'],
            'token' => $token,
            'datum' => date('Y-m-d'),
            'verified' => 0
        ];

        $mysqli = mysqli_connect();

        $title = mysqli_real_escape_string($mysqli, $get_info['onderwerp']);
        $sender = mysqli_real_escape_string($mysqli, $get_info['verstuurder']);
        $description = mysqli_real_escape_string($mysqli, $get_info['beschrijving']);
        $name = mysqli_real_escape_string($mysqli, $get_info['naam']);
        $email = mysqli_real_escape_string($mysqli, $get_info['email']);

        $mymail = new MailController();

        //Load PHPMailer dependencies
        require_once DIR_MAILER . 'PHPMailerAutoload.php';
        require_once DIR_MAILER . 'class.phpmailer.php';
        require_once DIR_MAILER . 'class.smtp.php';

        //Load Mail account settings
        require_once DIR_MODEL . 'MailSettings.php';


        /* Create phpmailer and add the image to the mail */
        $mailer = new PHPMailer();
        $mailer->addEmbeddedImage(DIR_PUBLIC . $admin['Logo'], "HeaderImage", "Logo.png");

        /* TO, SUBJECT, CONTENT */
        $to = $email; //The 'To' field
        $subject = $title;

        $link = $admin['Host'] . "/index.php?page=verify&id=$imageId&key=$token";

        $header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                        <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                            <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                        </div>
                    </div> ';
        $content = $header . "  <br/><br/>" . "Geachte " . $name . "," .
            " <br/><br/>" . "Uw proef staat te wachten op goedkeuring in het <b>Madalco Portaal!</b>" . "<br /><br />" .
            "<b>Titel van uw proef:</b>" .
            $title . "<br />" .

            "<b>Beschrijving van uw proef:</b> " .
            $description .

            "<br /><br />" . "U kunt uw proef " . "<a href='$link'>hier</a> " . "goedkeuren." .

            "<br /> <br />Met vriendelijke groet, <br />" . $sender . " </br>Madalco Media" .
            "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";

        $altcontent = "Geachte " . $name . "," .
            " <br/><br/>" . "Uw proef staat te wachten op goedkeuring in het <b>Madalco Portaal!</b>" . "<br /><br />" .
            "<b>Titel van uw proef:</b>" .
            $title . "<br />" .

            "<b>Beschrijving van uw proef:</b> " .
            $description .

            "<br /><br />" . "U kunt uw proef " . "hier: $link " . "goedkeuren." .

            "<br /> <br />Met vriendelijke groet, <br />" . $sender . " </br>Madalco Media" .
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
        $mailer->FromName = $sender; //Optional
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
            Session::flash('error', $mailer->ErrorInfo);
        } else {
            //If mail is send, create data and send it to the database
            $mail->update($mailinfo);
            $mailer->send();
        }


    }
    $block->Redirect('index.php?page=overview');
} else {
    $block->Redirect('index.php?page=overview');
    Session::flash('error', TEXT_NO_ASSIGNMENTS_5DAYS);
}