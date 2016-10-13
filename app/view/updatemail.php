<?php

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

    $content = "<img alt='MadalcoHeader' src='http://i68.tinypic.com/dw5a9f.png'>" . "  <br/><br/>" . "Geachte " . $_POST['fromname'] . "," .
        " <br/><br/>" . $_POST['name'] . " heeft uw proef: " . $_POST['keuring'] . "." . "<br /><br />" .
        "<b>Titel van uw proef: </b>" .
        $_POST['title'] .

        "<br /><br />" . "U kunt uw proef " . "<a href='http://localhost/InventPortal/public/index.php?page=dashboard&$myid'>hier</a> " . "bekijken." .

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
        'name' => strip_tags($_POST['name']),
        'answer' => strip_tags($_POST['answer']),
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
        header('Location: index.php?page=phpmail');
        echo 'Error sending mail : ' . $mailer->ErrorInfo;
    } else {
        //If mail is send, create data and send it to the database
        $mymail->update($mailinfo);
        //var_dump($mymail);
    }

