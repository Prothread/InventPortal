<?php

require_once DIR_MODEL . 'permissions.php';

$user = new UserController();
if($user->getPermission($permgroup, 'CAN_ACCORD') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$mysqli = mysqli_connect();

$upload = new BlockController();
$myupload = $upload->getUploadById($session->getMailId());

$image_controller = new ImageController();
$uploadedimages = $image_controller->getImagebyMailID($myupload['id']);

foreach ($uploadedimages as $img) {
    if (isset($_SESSION['img' . $img['id']])) {
        $imgver = $session->getImageVerify($img['id']);
    }
    else {
        $imago = $image_controller->getImageVerify($img['id']);
        $imgver = $imago['verify'];
    }
    $image_controller->setImageVerify($img['id'], $imgver);
    unset($_SESSION['img' . $img['id']]);
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

    $content = "<img alt='MadalcoHeader' src='https://picoolio.net/images/2016/11/04/headerbgcc759.png'>" . "  <br/><br/>" . "Geachte " . $_POST['verstuurder'] . "," .
        " <br/><br/>" . $_POST['name'] . " heeft uw proef <b>" . $_SESSION['verifytext'] . "</b>." . "<br /><br />" .
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
    $answer = mysqli_real_escape_string( $mysqli, $_POST['answer']) ;
    $UID = mysqli_real_escape_string( $mysqli, $_POST['UID'] );
    $verified = mysqli_real_escape_string( $mysqli, $_SESSION['verified'] );

    $mailinfo = [
        'userid' => intval($_POST['userid']),
        'id' => intval($myid),
        'answer' => strip_tags($answer),
        'key' => strip_tags($UID),
        'verified' => strip_tags($verified)
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
        header('Location: index.php');
        echo 'Error sending mail : ' . $mailer->ErrorInfo;
    } else {
        //If mail is send, create data and send it to the database
        $mymail->update($mailinfo);
        unset($_SESSION['accord']);
        unset($_SESSION['verified']);
        unset($_SESSION['verifytext']);

        header('Location: index.php?page=accordering');
        Session::flash('message', 'De accordering is verstuurd');
    }
