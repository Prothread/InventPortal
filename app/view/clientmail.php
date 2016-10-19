<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 19-Oct-16
 * Time: 09:01
 */

$user = new UserController();
$myuser = $_SESSION['usr_name'];

if(isset($myuser)) {
    $myuser = $_SESSION['usr_name'];
}
else if( $myuser ) {
    $thisuser = $user->getUserById($session->getUserId());
    $myuser = $thisuser['name'];
}
else {
    echo 'Admin';
}

$client = new ClientController();

//Generate a random string.
$token = openssl_random_pseudo_bytes(8);
//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

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
$to = $_POST['email']; //The 'To' field
$subject = "Madalco portal account gegevens";

$content = "<img alt='MadalcoHeader' src='http://i68.tinypic.com/dw5a9f.png'>" . "  <br/><br/>" . "Geachte " . $_POST['companyname'] . "," .
    " <br/><br/>" . $myuser . " heeft voor U het account: <b>" . $_POST['showname'] . "</b>." . "aangemaakt met de volgende informatie:<br /><br />" .
    "<b>Email: </b>" .
    $_POST['email'] . '<br/>' .

    "<b>Wachtwoord: </b>" .
    $token .

    "<br /><br />" . "U kunt " . "<a href='http://localhost/InventPortal/public/index.php?page=login'>hier</a> " . "inloggen." .

    "<br /> <br />Met vriendelijke groet, <br />" . "Madalco media";

$altcontent = "Geachte leden van " . $_POST['companyname'] . "," .
    " <br/><br/>" . $myuser['name'] . " heeft voor U het account: <b>" . $_POST['showname'] . "</b>" . "aangemaakt met de volgende informatie:<br /><br />" .
    "<b>Email: </b>" .
    $_POST['email'] . '<br />' .

    "<b>Wachtwoord: </b>" .
    $token .

    "<br /><br />" . "U kunt " . "http://localhost/InventPortal/public/index.php?page=login " . "inloggen." .

    "<br /> <br />Met vriendelijke groet, <br />" . $myuser['name'];

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
$mailer->FromName = $myuser['name']; //Optional
$mailer->addAddress($to);  // Add a recipient

//Subject - Body :
$mailer->Subject = $subject;
$mailer->Body = $content;
$mailer->isHTML(true); //Mail body contains HTML tags
$mailer->AltBody = $altcontent;

//Saving mail information

$clientinfo = [
    'naam' => strip_tags( $_POST['showname'] ),
    'email' => strip_tags( $_POST['email'] ),
    'password' => $token,
    'bedrijfsnaam' => strip_tags( $_POST['companyname'] ),
    'adres' => strip_tags( $_POST['companyadress'] ),
    'postcode' => strip_tags( $_POST['postcode'] ),
    'plaats' => strip_tags( $_POST['plaats'] )
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
    $client->newClient($clientinfo);
    echo 'Mail is verstuurd';
}