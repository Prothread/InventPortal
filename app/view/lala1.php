<?php

if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$user = new UserController();

$mysqli = mysqli_connect();

$title = mysqli_real_escape_string($mysqli, $_POST['title']);
$description = mysqli_real_escape_string($mysqli, $_POST['additionalcontent']);

if (isset($_SESSION['clientid'])) {
    $clientid = $_SESSION['clientid'];
} else {
    $clientid = mysqli_real_escape_string($mysqli, $_POST['client']);
}
$client = $user->getUserById($clientid);
$name = $client['naam'];

$usr = $user->getUserById($_SESSION['usr_id']);
$sender = $usr['naam'];

if ($client['altmail']) {
    $email = $client['altmail'];
} else {
    $email = $client['email'];
}

$comment = mysqli_real_escape_string($mysqli, $_POST['interncomment']);
$commentgroep = mysqli_real_escape_string($mysqli, $_POST['commentgroep']);

$imageFileName = new ImageController();
$block = new BlockController();

if (isset($_POST['id'])) {
    $imageId = $_POST['id'];
} else {
    $dbmail = new DbMail();

    if($dbmail->getIncrement()) {
        $imageId = $dbmail->getIncrement();
    }
    else {
        $imageId = $imageFileName->getNewId();
        $imageId = $imageId + 1;
    }
}

$unique_names = explode(", ", $_POST['files']);

$error = 0;
if ($error == 0) {
    $mymail = new MailController();

    //Generate a random string.
    $token = openssl_random_pseudo_bytes(16);
    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    //Load PHPMailer dependencies
    require_once DIR_MAILER . 'PHPMailerAutoload.php';
    require_once DIR_MAILER . 'class.phpmailer.php';
    require_once DIR_MAILER . 'class.smtp.php';

    //Load Mail account settings
    require_once DIR_MODEL . 'MailSettings.php';

    //if (isset($_POST['submit'])) {

    /* Create phpmailer and add the image to the mail */
    $mailer = new PHPMailer();
    $mailer->addEmbeddedImage(DIR_PUBLIC . $admin['Logo'], "HeaderImage", "Logo.png");

    /* TO, SUBJECT, CONTENT */
    $to = $email; //The 'To' field
    $subject = $title;

    $link = $admin['Host'] . "/index.php?page=verify&id=$imageId&key=$token";

    function printImages($uploadedimage, $link, $hosturl)  {
        $html = '';
        $i = 0;
        foreach($uploadedimage as $image) {
            $html .= "<a href='$link'><img src='$hosturl/index.php?page=image&img=thumb_$image' style='width: auto;height: 70px;'></a>";
            $i++;
        }
        return $html;
    }

    $header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                        <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                            <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                        </div>
                    </div> ';

    $content = $header . "  <br/><br/>" . "Geachte " . $name . "," .
        " <br/><br/>" . "Wij hebben voor U een digitale proefdruk gemaakt. <br /> Dit is te zien in het <b>Klantenportaal</b>." . "<br /><br />" .
        "<b>Onderwerp:</b> " .
        $title . "<br />" .

        "<b>Beschrijving:</b> " .
        $description .

        "<br /><br />" . "U kunt uw proef met de onderstaand link bekijken, accorderen of wijzigen" . "<br />" .
        "<a href='$link'>$title</a> " . "<br /><br />" .

        printImages($unique_names, $link, $admin['Host']) . "<br />" .

        "<br /> <br />Met vriendelijke groet, <br />" . $sender . " </br>Madalco Media" .
        "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";

    $altcontent = "Geachte " . $name . "," .
        " <br/><br/>" . "Uw proef staat te wachten op goedkeuring in het <b>Madalco Portaal!</b>" . "<br /><br />" .
        "<b>Onderwerp van uw proef:</b> " .
        $title . "<br />" .

        "<b>Beschrijving:</b> " .
        $description .

        "<br /><br />" . "U kunt uw proef " . "hier: $link " . "goedkeuren." .

        "<br /> <br />Met vriendelijke groet, <br />" . $sender . " </br>Madalco Media" .
        "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";

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

    $images = mysqli_real_escape_string($mysqli, $_POST['files']);

    $mailinfo = [
        'title' => strip_tags($title),
        'sender' => intval($_SESSION['usr_id']),
        'description' => strip_tags($description),
        'name' => intval($clientid),
        'email' => strip_tags($to),
        'token' => $token,
        'images' => strip_tags($images),
        'datum' => date('Y-m-d'),
        'verified' => 0
    ];

    if (isset($_POST['id'])) {
        $myid = mysqli_real_escape_string($mysqli, $_POST['id']);
        $mailinfo['id'] = intval($myid);
    }
    else {
        $mailinfo['clientid'] = intval($clientid);
    }

    if ($comment && $comment !== '') {
        $mailinfo['comment'] = $comment;
        $mailinfo['commentgroep'] = $commentgroep;
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
        $block->Redirect('index.php?page=uploadoverview');
        Session::flash('error', $mailer->ErrorInfo);
    }
    else {
        //If mail is send, create data and send it to the database
        if (isset($_POST['id'])) {
            $mymail->update($mailinfo);
        } else {
            $mymail->create($mailinfo);
        }
        unset($_SESSION['clientid']);
    }
}