<?php
#VERWERKT UPLOAD PROCESS

if($user->getPermission($permgroup, 'CAN_UPLOAD') == 1){

}
else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$mysqli = mysqli_connect();

$title = mysqli_real_escape_string($mysqli, $_POST['title']);
$sender = mysqli_real_escape_string($mysqli, $_POST['fromname']);
$description = mysqli_real_escape_string($mysqli, $_POST['additionalcontent']);

if(isset($_SESSION['clientid'])) {
    $clientid = $_SESSION['clientid'];
}
else {
    $clientid = mysqli_real_escape_string($mysqli, $_POST['client']);
}
$client = $user->getUserById($clientid);

$name = mysqli_real_escape_string($mysqli, $client['naam']);

if($client['altmail'] == '') {
    $email = $client['email'];
}else{
    $email = $client['altmail'];
}

$comment = mysqli_real_escape_string($mysqli, $_POST['interncomment']);
$commentgroep = mysqli_real_escape_string($mysqli, $_POST['commentgroep']);

$imageFileName = new ImageController();
$block = new BlockController();

if(isset($_POST['id'])) {
    $imageId = $_POST['id'];
} else {
    $imageId = $imageFileName->getNewId();
    $imageId =  $imageId + 1;
}

$error = 0;

if (isset($_FILES['myFile'])) {
    $error = 0;

    $myFile = $_FILES['myFile'];
    $fileCount = count($myFile["name"]);

    $images = array();
    $unique_names = array();

    for ($i = 0; $i < $fileCount; $i++) {

        $test = $myFile['name'][$i];
        $test1 = $myFile['tmp_name'][$i];

        $target_dir = "../app/uploads/";
        $target_file = $target_dir . $test;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        /*
        if (file_exists($target_file)) {
            $error = 1;
            echo $test ." already exists!";
            ?><br/><?php
        }
        */

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
            $error = 1;
        }

        if ($myFile["size"][$i] > 10485760) {
            $error = 1;
            header('Location: index.php?page=uploadoverview');
            Session::flash('message', 'Het geüploade bestand is te groot');
        }

        if ($error == 0) {

            $unique_name = pathinfo($test, PATHINFO_FILENAME)."_".( $imageId ).'.'.$imageFileType;
            $unique_name = preg_replace('/\s+/', '-', $unique_name);
            $uniqfile = $target_dir . $unique_name;

            array_push($unique_names, $unique_name);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                if (move_uploaded_file($test1, $uniqfile)) {
                    array_push($images, $test);
                }

        }
        else {

        }
    }
}

if($error == 0) {
    $mymail = new MailController();

//Generate a random string.
    $token = openssl_random_pseudo_bytes(16);
//Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

//Load PHPMailer dependencies
    require_once DIR_MAILER . 'PHPMailerAutoload.php';
    require_once DIR_MAILER . 'class.phpmailer.php';
    require_once DIR_MAILER . 'class.smtp.php';

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

    if (isset($_POST['submit'])) {

        /* Create phpmailer and add the image to the mail */
        $mailer = new PHPMailer();
        $mailer->addEmbeddedImage(DIR_PUBLIC . $admin['Logo'], "HeaderImage", "Logo.png");

        /* TO, SUBJECT, CONTENT */
        $to = $email; //The 'To' field
        $subject = $title;
        $header = ' <div id="header" style="background: ' . $admin['Header'] . '">
                        <div id="MenuSide">
                            <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                        </div>
                    </div> ';
        $content = $header . "  <br/><br/>" . "Geachte " . $name . "," .
            " <br/><br/>" . "Uw proef staat te wachten op goedkeuring in het <b>Madalco Portaal!</b>" . "<br /><br />" .
            "<b>Titel van uw proef:</b>".
            $title . "<br />" .

            "<b>Beschrijving van uw proef:</b> " .
            $description.

            "<br /><br />" . "U kunt uw proef " . "<a href='http://localhost/InventPortal/public/index.php?page=verify&id=$imageId&key=$token'>hier</a> " . "goedkeuren." .

            "<br /> <br />Met vriendelijke groet, <br />" . $sender . " </br>Madalco Media";
        $altcontent = "Geachte " . $name . "," .
            " <br/><br/>" . "Uw proef staat te wachten op goedkeuring in het <b>Madalco Portaal!</b>" . "<br /><br />" .
            "<b>Titel van uw proef:</b>".
            $title . "<br />" .

            "<b>Beschrijving van uw proef:</b> " .
            $description.

            "<br /><br />" . "U kunt uw proef " . "hier: http://localhost/InventPortal/public/index.php?page=verify&id=$imageId&key=$token " . "goedkeuren." .

            "<br /> <br />Met vriendelijke groet, <br />" . $sender . " </br>Madalco Media";;

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
        $mailer->AddReplyTo($_POST['frommail'], $sender);
        $mailer->From = $crendentials['email'];
        $mailer->FromName = $sender; //Optional
        $mailer->addAddress($to);  // Add a recipient

//Subject - Body :
        $mailer->Subject = $subject;
        $mailer->Body = $content;
        $mailer->isHTML(true); //Mail body contains HTML tags
        $mailer->AltBody = $altcontent;

//Saving mail information

        $dbimages = implode(", ", $images);
        $uniqdbimages = implode(", ", $unique_names);

        if(isset($_POST['id'])) {
        $myid = $_POST['id'];
            if($comment !== null && $comment !== '') {
                $mailinfo = [
                    'id' => intval($myid),
                    'title' => strip_tags($title),
                    'sender' => strip_tags($sender),
                    'description' => strip_tags($description),
                    'name' => strip_tags($name),
                    'email' => strip_tags($email),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0,
                    'comment' => $comment,
                    'commentgroep' => $commentgroep
                ];
            }
            else {
                $mailinfo = [
                    'id' => intval($myid),
                    'title' => strip_tags($title),
                    'sender' => strip_tags($sender),
                    'description' => strip_tags($description),
                    'name' => strip_tags($name),
                    'email' => strip_tags($email),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0
                ];
            }
        }
        else {
            if($comment !== null && $comment !== '') {
                $mailinfo = [
                    'title' => strip_tags($title),
                    'sender' => strip_tags($sender),
                    'description' => strip_tags($description),
                    'name' => strip_tags($name),
                    'email' => strip_tags($email),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0,
                    'comment' => $comment,
                    'commentgroep' => $commentgroep
                ];
            }
            else {
                $mailinfo = [
                    'title' => strip_tags($title),
                    'sender' => strip_tags($sender),
                    'description' => strip_tags($description),
                    'name' => strip_tags($name),
                    'email' => strip_tags($email),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0
                ];
            }
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
            $block->Redirect('index.php?page=phpmail');
            //echo 'Error sending mail : ' . $mailer->ErrorInfo;
            Session::flash('error', $mailer->ErrorInfo);
        } else {
            //If mail is send, create data and send it to the database
            if(isset( $_POST['id'] )) {
                $mymail->update($mailinfo);
                $mailer->send();
            }
            else {
                $mymail->create($mailinfo);
            }

            $block->Redirect('index.php?page=overview');
            Session::flash('message', 'Uw bestanden zijn geüpload.');
        }
    }
}
