<?php

$upload = new BlockController();
$myupload = $upload->getUploadById($session->getMailId());

$image_controller = new ImageController();
$uploadedimages = $image_controller->getImagebyMailID($myupload['id']);

foreach ($uploadedimages as $img) {
    $session->getImageVerify($img['id']);
    $image_controller->setImageVerify($img['id'], $session->getImageVerify($img['id']));
}

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
    /* TO, SUBJECT, CONTENT */
    $to = $_POST['mailto']; //The 'To' field
    $subject = $_POST['title'];
    $myid = $_POST['id'];

    $content = "<img alt='MadalcoHeader' src='http://i68.tinypic.com/dw5a9f.png'>" . "  <br/><br/>" . "Geachte " . $_POST['verstuurder'] . "," .
        " <br/><br/>" . $_POST['name'] . " heeft uw proef <b>" . $_POST['keuring'] . "</b>." . "<br /><br />" .
        "<b>Titel van uw proef: </b>" .
        $_POST['title'] .

        "<br /><br />" . "U kunt uw proef " . "<a href='http://localhost/InventPortal/public/index.php?page=item&id=$myid'>hier</a> " . "bekijken." .

        "<br /> <br />Met vriendelijke groet, <br />" . $_POST['name'];
    $altcontent = "This is the content if the mailing system doesn't support a HMTL body";

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
    $mailer->FromName = $_POST['fromname']; //Optional
    $mailer->addAddress($to);  // Add a recipient

//Subject - Body :
    $mailer->Subject = $subject;
    $mailer->Body = $content;
    $mailer->isHTML(true); //Mail body contains HTML tags
    $mailer->AltBody = $altcontent;

//Saving mail information

    $myid = $_POST['id'];

    $mailinfo = [
        'id' => intval($myid),
        'answer' => strip_tags($_POST['answer']),
        'key' => strip_tags($_POST['UID']),
        'verified' => strip_tags($_POST['verified'])
    ];
    var_dump($mailinfo);

    $mailer->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
//Check if mail is sent :
    if (!$mailer->send()) {
        header('Location: index.php');
        echo 'Error sending mail : ' . $mailer->ErrorInfo;
    } else {
        //If mail is send, create data and send it to the database
        $mymail->update($mailinfo);
        echo 'Mail is verstuurd';
        var_dump($mymail);
    }

