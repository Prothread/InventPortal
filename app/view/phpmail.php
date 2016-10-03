<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 29-Sep-16
 * Time: 13:15
 */

$mymail = new MailController();

//Generate a random string.
$token = openssl_random_pseudo_bytes(16);
//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

//Load PHPMailer dependencies
require_once DIR_MAILER.'/PHPMailerAutoload.php';
require_once DIR_MAILER.'/class.phpmailer.php';
require_once DIR_MAILER.'/class.smtp.php';

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

if( isset($_POST['submit'] ) ) {

    /* TO, SUBJECT, CONTENT */
    $to = $_POST['mailto']; //The 'To' field
    $subject = $_POST['title'];
    $content = "Beste " . $_POST['mailname'] .
        "<br/><br/>" . "This is the HTML message body <b>in bold!</b>" . "<br /><br />" .

        $_POST['additionalcontent'] .

        "<br /><br />" . "Here is the link to get you your product: " . "<a href='http://localhost/InventPortal/public/index.php?page=verify&email=$to&key=$token'>Link</a> " .

        "<br /> <br />Met vriendelijke groet, <br />" . $_POST['fromname'];
    ;
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
    $mailer->AddReplyTo($_POST['frommail'], $_POST['fromname']);
    $mailer->From = $crendentials['email'];
    $mailer->FromName = $_POST['fromname']; //Optional
    $mailer->addAddress($to);  // Add a recipient

//Subject - Body :
    $mailer->Subject = $subject;
    $mailer->Body = $content;
    $mailer->isHTML(true); //Mail body contains HTML tags
    $mailer->AltBody = $altcontent;

//Saving mail information
    $mailinfo = [
        'title' => $_POST['title'],
        'sender' => $_POST['fromname'],
        'description' => $_POST['additionalcontent'],
        'name' => $_POST['mailname'],
        'email' => $_POST['mailto'],
        'token' => $token,
        'verified' => $_POST['verified']
    ];

//Check if mail is sent :
    if (!$mailer->send()) {
        echo 'Error sending mail : ' . $mailer->ErrorInfo;
    } else {
        //If mail is send, create data and send it to the database
        $mymail->create($mailinfo);
    }
}

?>
    <div id="Mail">
        <form method="post">
            <span>Zender: </span>
            <input type="text" name="fromname" id="MailFromName" value="<?php if( isset($mailinfo['sender']) ){echo $mailinfo['sender'];}?>">

            <!-- <span>Zender e-mail: </span> -->
            <input type="hidden" name="frommail" id="MailFrom" value="<?php echo $crendentials['email']?>">

            <span>Title: </span>
            <input type="text" name="title" id="MailTitle" value="<?php if( isset($mailinfo['title']) ){echo $mailinfo['title'];}?>">

            <span>Extra omschrijving (opmerkingen): </span>
            <input type="text" name="additionalcontent" id="MailContent" value="<?php if( isset($mailinfo['description']) ){echo $mailinfo['description'];}?>">

            <span>Naam ontvanger: </span>
            <input type="text" name="mailname" id="MailName" value="<?php if( isset($mailinfo['name']) ){echo $mailinfo['name'];}?>">

            <span>Email ontvanger: </span>
            <input type="email" name="mailto" id="MailTo" value="<?php if( isset($mailinfo['email']) ){echo $mailinfo['email'];}?>">

            <input type="hidden" name="verified" value="0">

            <input type="submit" value="Submit mail" name="submit">
        </form>
    </div>

