<?php
#UPDATE MAIL PROCESS PAGE

require_once DIR_MODEL . 'permissions.php';

$mysqli = mysqli_connect();

$user = new UserController();
if ($user->getPermission($permgroup, 'CAN_ACCORD') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$upload = new BlockController();
$myupload = $upload->getUploadById($session->getMailId());

$image_controller = new ImageController();
$uploadedimages = $image_controller->getImagebyMailID($myupload['id']);

foreach ($uploadedimages as $img) {
    if (isset($_SESSION['img' . $img['id']])) {
        $imgver = $session->getImageVerify($img['id']);
    } else {
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

require_once DIR_MODEL . 'MailSettings.php';

/* Create phpmailer and add the image to the mail */
$mailer = new PHPMailer();
$mailer->addEmbeddedImage(DIR_PUBLIC . $admin['Logo'], "HeaderImage", "Logo.png");

/* TO, SUBJECT, CONTENT */
$to = $_SESSION['mailto']; //The 'To' field
$subject = $_SESSION['verifytext']. ': ' . $_POST['title'];

if (isset($_SESSION['accordid'])) {
    $myid = $_SESSION['accordid'];
} else {
    $myid = $_POST['id'];
}

$link = $admin['Host'] . "/index.php?page=item&id=$myid";

$usr = $user->getUserById($_POST['verstuurder']);
$usrname = $usr['naam'];

$clnt = $user->getUserById(intval($_POST['clientid']));
$clntname = $usr['naam'];

if($clnt['lang']) {
    include_once DIR_VIEW . $clnt['lang'] . '_mail_update.php';
}
else {
    include_once DIR_VIEW . 'en' . '_mail_update.php';
}

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

$answer = mysqli_real_escape_string($mysqli, $_POST['answer']);

$userip = $user->getUserIP();
$UID = date('d.m.Y-G.i.s') . '-' . $userip;

$verified = mysqli_real_escape_string($mysqli, $_SESSION['verified']);

$mailinfo = [
    'clientid' => intval($_POST['clientid']),
    'id' => intval($myid),
    'answer' => strip_tags($answer),
    'key' => $UID,
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
    $block->Redirect('index.php');
    echo 'Error sending mail : ' . $mailer->ErrorInfo;
} else {
    //If mail is send, create data and send it to the database
    $mymail->update($mailinfo);
    unset($_SESSION['accord']);
    unset($_SESSION['accordid']);
    unset($_SESSION['verified']);
    unset($_SESSION['verifytext']);
    unset($_SESSION['mailto']);
    unset($_SESSION['accorduserid']);
    unset($_SESSION['userid']);

    $block->Redirect('index.php');
    Session::flash('message', TEXT_ACCORD_SEND);
}
