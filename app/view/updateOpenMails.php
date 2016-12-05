<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 22-Nov-16
 * Time: 16:01
 */

if($user->getPermission($permgroup, 'CAN_UPLOAD') == 1){

}
else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$mail = new MailController();
$uploads = new BlockController();

$verified = '0, 1';
$get_filled_info = $uploads->getOlderUploads($verified, true);

foreach($get_filled_info as $get_info) {

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

        /* Create phpmailer and add the image to the mail */
        $mailer = new PHPMailer();
        $mailer->addEmbeddedImage(DIR_PUBLIC . $admin['Logo'], "HeaderImage", "Logo.png");

            /* TO, SUBJECT, CONTENT */
            $to = $email; //The 'To' field
            $subject = $title;

            $header = ' <div id="header" style="background: ' . $admin['Header'] . '">
                            <div id="MenuSide">
                                <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                            </div>
                        </div> ';
            $content = $header . "  <br/><br/>" . "Geachte " . $name . "," .
                " <br/><br/>" . "Uw proef staat te wachten op goedkeuring in het <b>Madalco Portaal!</b>" . "<br /><br />" .
                "<b>Titel van uw proef:</b>" .
                $title . "<br />" .

                "<b>Beschrijving van uw proef:</b> " .
                $description .

                "<br /><br />" . "U kunt uw proef " . "<a href='http://localhost/InventPortal/public/index.php?page=verify&id=$imageId&key=$token'>hier</a> " . "goedkeuren." .

                "<br /> <br />Met vriendelijke groet, <br />" . $sender . " </br>Madalco Media";
            $altcontent = "Geachte " . $name . "," .
                " <br/><br/>" . "Uw proef staat te wachten op goedkeuring in het <b>Madalco Portaal!</b>" . "<br /><br />" .
                "<b>Titel van uw proef:</b>" .
                $title . "<br />" .

                "<b>Beschrijving van uw proef:</b> " .
                $description .

                "<br /><br />" . "U kunt uw proef " . "hier: http://localhost/InventPortal/public/index.php?page=verify&id=$imageId&key=$token " . "goedkeuren." .

                "<br /> <br />Met vriendelijke groet, <br />" . $sender . " </br>Madalco Media";;

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
                //echo 'Error sending mail : ' . $mailer->ErrorInfo;
                Session::flash('error', $mailer->ErrorInfo);
            } else {
                //If mail is send, create data and send it to the database
                $mail->update($mailinfo);
                $mailer->send();
            }


}
$block->Redirect('index.php');