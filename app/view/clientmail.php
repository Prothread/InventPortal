<?php
#PROCESSES MAIL FUNCTION

if ($user->getPermission($permgroup, 'CAN_CREATE_CLIENT') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
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
    $subject = "Accountgegevens Madalco-portaal";

    $link = $admin['Host'] . "/index.php?page=resetpassword&email=$email&token=$passtoken";

    $header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                        <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                            <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                        </div>
                    </div> ';
    $content = $header . "  <br/><br/>" . "Geachte " . $_POST['companyname'] . "," .

        " <br/><br/>" . $myuser . " heeft voor u het account <b> " . $_POST['name'] . "</b> " . " aangemaakt, hieronder uw gegevens:<br /><br />" .
        "<b>E-mailadres: </b>" .
        $_POST['email'] . '<br/>' .

        "<b>Wachtwoord: </b>" .
        $token .

        "<br /><br />" . "U kunt " . "<a href='$link'>hier</a> " . "uw wachtwoord veranderen." .

        "<br /><br />Met vriendelijke groet, <br />" . "Madalco Media" .
        "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";

    $altcontent = "Geachte leden van " . $_POST['companyname'] . "," .
        " <br/><br/>" . $myuser . " heeft voor U het account: <b>" . $_POST['name'] . "</b>" . "aangemaakt met de volgende informatie:<br /><br />" .
        "<b>Email: </b>" .
        $_POST['email'] . '<br />' .

        "<b>Wachtwoord: </b>" .
        $token .

        "<br /><br />" . "U kunt hier: " . "$link " . "uw wachtwoord veranderen." .

        "<br /> <br />Met vriendelijke groet, <br />" . "Madalco Media" .
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

    $userinfo = [
        'name' => strip_tags($naam),
        'email' => strip_tags($email),
        'password' => $token,
        'bedrijfsnaam' => strip_tags($bedrijfsnaam),
        'adres' => strip_tags($adres),
        'postcode' => strip_tags($postcode),
        'plaats' => strip_tags($plaats),
        'permgroup' => $rechten
    ];

    if ($_POST['altmail']) {
        $altmail = mysqli_real_escape_string($mysqli, $_POST['altmail']);
        $userinfo = [
            'name' => strip_tags($naam),
            'email' => strip_tags($email),
            'altmail' => strip_tags($altmail),
            'password' => $token,
            'bedrijfsnaam' => strip_tags($bedrijfsnaam),
            'adres' => strip_tags($adres),
            'postcode' => strip_tags($postcode),
            'plaats' => strip_tags($plaats),
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
        $block->Redirect('index.php');
        echo 'Error sending mail : ' . $mailer->ErrorInfo;
    } else {
        //If mail is send, create data and send it to the database
        $user->create($userinfo);

        $user->newPassword($email, $passtoken);

        if ($rechten >= 2) {
            $block->Redirect('index.php?page=manageusers');
        } else {
            $block->Redirect('index.php?page=manageclients');
        }

        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'Nieuwe klant is aangemaakt';
        echo json_encode($response);
    }

} else {
    $response = array();
    $response['status'] = 'error';
    $response['message'] = 'Deze mail is al in gebruik';
    echo json_encode($response);

    $block->Redirect('index.php?page=newclient');
    Session::flash('error', 'Deze mail is al in gebruik');
}
