<?php
#PROCESSES MAIL FUNCTION
$user = new UserController();
$block = new BlockController();
include_once '../app/Model/permissions.php';

if ($user->getPermission($permgroup, 'CAN_CREATE_CLIENT') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$mysqli = mysqli_connect();

$myuser = mysqli_real_escape_string($mysqli, $_SESSION['usr_name']);

if (isset($_SESSION['usr_name'])) {
    $myuser = $_SESSION['usr_name'];
} else if (isset($user)) {
    $thisuser = $user->getUserById($session->getUserId());
    $myuser = mysqli_real_escape_string($mysqli, $thisuser['naam']);
} else {
    echo 'Admin';
}
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$mailexist = $user->getUserByEmail($email);

if ($mailexist == null || empty($mailexist)) {


    //Generate a random string.
        $token = openssl_random_pseudo_bytes(8);
    //Convert the binary data into hexadecimal representation.
        $token = bin2hex($token);

    //New token
    $passtoken = openssl_random_pseudo_bytes(8);
    $passtoken = bin2hex($token);

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
    if ($_POST['altmail']) {
        $altmail = mysqli_real_escape_string($mysqli, $_POST['altmail']);
        $to = $altmail;
    } else {
        $to = $email; //The 'To' field
    }


    $link = $admin['Host'] . "/index.php?page=resetpassword&email=$email&token=$passtoken";

    if($_POST['taal']) {
        include_once DIR_VIEW . $_POST['taal'] . '_mail_client.php';
    }
    else {
        include_once DIR_VIEW . 'en' . '_mail_client.php';
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
    $mailer->FromName = $myuser; //Optional
    $mailer->addAddress($to);  // Add a recipient

//Subject - Body :
    $mailer->Subject = $subject;
    $mailer->Body = $content;
    $mailer->isHTML(true); //Mail body contains HTML tags
    $mailer->AltBody = $altcontent;

//Saving mail information

    $naam = mysqli_real_escape_string($mysqli, $_POST['name']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $bedrijfsnaam = mysqli_real_escape_string($mysqli, $_POST['companyname']);

    $adres = mysqli_real_escape_string($mysqli, $_POST['companyadress']);
    $postcode = mysqli_real_escape_string($mysqli, $_POST['postcode']);
    $plaats = mysqli_real_escape_string($mysqli, $_POST['plaats']);
    $rechten = mysqli_real_escape_string($mysqli, $_POST['rechten']);
    if(isset($_POST['taal']) && $_POST['taal']) {
        $taal = mysqli_real_escape_string($mysqli, $_POST['taal']);
    }

    $userinfo = [
        'name' => strip_tags($naam),
        'email' => strip_tags($email),
        'password' => $token,
        'bedrijfsnaam' => strip_tags($bedrijfsnaam),
        'adres' => strip_tags($adres),
        'postcode' => strip_tags($postcode),
        'plaats' => strip_tags($plaats),
        'lang' => strip_tags($taal),
        'permgroup' => $rechten
    ];
    if(isset($taal) && $taal) {
        $userinfo1['lang'] = $taal;
    }

    if ($_POST['altmail']) {
        $altmail = mysqli_real_escape_string($mysqli, $_POST['altmail']);
        $userinfo['altmail'] = strip_tags($altmail);
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
        $block->Redirect('index.php');
        echo 'Error sending mail : ' . $mailer->ErrorInfo;
    } else {
        //If mail is send, create data and send it to the database
        $user->create($userinfo);

        $user->newPassword($email, $passtoken);

        /*if ($rechten >= 2) {
            $block->Redirect('index.php?page=manageusers');
        } else {
            $block->Redirect('index.php?page=manageclients');
        }*/

        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'Nieuwe klant is aangemaakt';
        echo json_encode($response);
    }

} else {
    $response = array();
    $response['status'] = 'error';
    $response['message'] = 'Deze mail is al in gebruik';

    //$block->Redirect('index.php?page=newclient');
    //Session::flash('error', TEXT_MAIL_USED);

    echo json_encode($response);
}
