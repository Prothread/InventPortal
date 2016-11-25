<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 19-Oct-16
 * Time: 09:01
 */

if($user->getPermission($permgroup, 'CAN_CREATE_CLIENT') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$mysqli = mysqli_connect();

$user = new UserController();
$myuser = $_SESSION['usr_name'];

if(isset($_SESSION['usr_name'])) {
    $myuser = $_SESSION['usr_name'];
}
else if( isset($user) ) {
    $thisuser = $user->getUserById($session->getUserId());
    $myuser = $thisuser['naam'];
}
else {
    echo 'Admin';
}
$email = mysqli_real_escape_string( $mysqli, $_POST['email']);
$mailexist = $user->getUserByEmail($email);

if($mailexist = null || empty($mailexist)){


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
    $subject = "Accountgegevens Madalco-portaal";

    $content = "<img alt='MadalcoHeader' src='https://picoolio.net/images/2016/11/04/headerbgcc759.png'>" . "  <br/><br/>" . "Geachte " . $_POST['companyname'] . "," .

        " <br/><br/>" . $myuser . " heeft voor u het account <b> " . $_POST['name'] . "</b> " . " aangemaakt, hieronder uw gegevens:<br /><br />" .
        "<b>E-mailadres: </b>" .
        $_POST['email'] . '<br/>' .

        "<b>Wachtwoord: </b>" .
        $token .

        "<br /><br />" . "U kunt " . "<a href='http://localhost/InventPortal/public/index.php?page=login'>hier</a> " . "inloggen met de gegevens uit deze mail." .

        "<br /><br />Met vriendelijke groet, <br />" . "Madalco Media";

    $altcontent = "Geachte leden van " . $_POST['companyname'] . "," .
        " <br/><br/>" . $myuser . " heeft voor U het account: <b>" . $_POST['name'] . "</b>" . "aangemaakt met de volgende informatie:<br /><br />" .
        "<b>Email: </b>" .
        $_POST['email'] . '<br />' .

        "<b>Wachtwoord: </b>" .
        $token .

        "<br /><br />" . "U kunt " . "http://localhost/InventPortal/public/index.php?page=login " . "inloggen." .

        "<br /> <br />Met vriendelijke groet, <br />" . $myuser;

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
    $mailer->FromName = $myuser; //Optional
    $mailer->addAddress($to);  // Add a recipient

//Subject - Body :
    $mailer->Subject = $subject;
    $mailer->Body = $content;
    $mailer->isHTML(true); //Mail body contains HTML tags
    $mailer->AltBody = $altcontent;

//Saving mail information

    $naam = mysqli_real_escape_string( $mysqli, $_POST['name']);
    $email = mysqli_real_escape_string( $mysqli, $_POST['email']);
    $bedrijfsnaam = mysqli_real_escape_string( $mysqli, $_POST['companyname']);

    $adres = mysqli_real_escape_string( $mysqli, $_POST['companyadress']);
    $postcode = mysqli_real_escape_string( $mysqli, $_POST['postcode']);
    $plaats = mysqli_real_escape_string( $mysqli, $_POST['plaats']);
    $rechten = mysqli_real_escape_string( $mysqli, $_POST['rechten']);

    $userinfo = [
        'name' => strip_tags( $naam ),
        'email' => strip_tags( $email ),
        'password' => $token,
        'bedrijfsnaam' => strip_tags( $bedrijfsnaam ),
        'adres' => strip_tags( $adres ),
        'postcode' => strip_tags( $postcode ),
        'plaats' => strip_tags( $plaats ),
        'permgroup' => $rechten
    ];

    if($_POST['altmail']) {
        $altmail = mysqli_real_escape_string($mysqli, $_POST['altmail']);
        $userinfo = [
            'name' => strip_tags( $naam ),
            'email' => strip_tags( $email ),
            'altmail' => strip_tags( $altmail ),
            'password' => $token,
            'bedrijfsnaam' => strip_tags( $bedrijfsnaam ),
            'adres' => strip_tags( $adres ),
            'postcode' => strip_tags( $postcode ),
            'plaats' => strip_tags( $plaats ),
            'permgroup' => $rechten
        ];
    }

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
        $user->create($userinfo);
        //header('Location: index.php?page=manageclients');
    }

}else{
    header('Location: index.php?page=newclient');
    Session::flash('error', 'Deze mail is al in gebruik');
}
