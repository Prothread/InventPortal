<?php
#VERWERKT UPLOAD PROCESS

$mysqli = mysqli_connect();

$title = mysqli_real_escape_string($mysqli, $_POST['title']);
$sender = mysqli_real_escape_string($mysqli, $_POST['fromname']);
$description = mysqli_real_escape_string($mysqli, $_POST['additionalcontent']);
$name = mysqli_real_escape_string($mysqli, $_POST['mailname']);
$email = mysqli_real_escape_string($mysqli, $_POST['mailto']);

$imageFileName = new ImageController();
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
            echo "Sorry, only JPG, JPEG, PNG, PDF & GIF files are allowed.";
            ?><br/><?php
        }

        if ($myFile["size"][$i] > 10485760) {
            $error = 1;
            echo $test . " File too big!";
            ?><br/><?php
        }

        if ($error == 0) {

            $unique_name = pathinfo($test, PATHINFO_FILENAME)."_".( $imageId ).'.'.$imageFileType;
            $uniqfile = $target_dir . $unique_name;

            array_push($unique_names, $unique_name);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                if (move_uploaded_file($test1, $uniqfile)) {
                    array_push($images, $test);
                    if($imageFileType == "pdf"){
                        echo "The file " . $test . " has been uploaded."; ?><br /><?php
                        ?>
                        <object data="<?= DIR_IMAGE.$unique_name ?>" type="application/pdf" width="700px" height="700px">
                            <embed src="<?= DIR_IMAGE.$unique_name ?>">
                            </embed>
                        </object>
                            <?php
                    }
                    else{
                        echo "The file " . $test . " has been uploaded."; ?><br /><?php
                        echo '<img style="width:300px; height: auto;" src="../app/uploads/' . $unique_name  . '">';
                    }
                    ?>

                    <p>
                        Name: <?= $myFile["name"][$i] ?><br>
                        Type: <?= $myFile["type"][$i] ?><br>
                        Size: <?= $myFile["size"][$i] ?><br>
                    </p>
                    <?php
                }

            } else {

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

    if (isset($_POST['submit'])) {

        /* TO, SUBJECT, CONTENT */
        $to = $email; //The 'To' field
        $subject = $title;
        $content = "<img alt='MadalcoHeader' src='http://i68.tinypic.com/dw5a9f.png'>"."  <br/><br/>" . "Geachte " . $name . "," .
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
            $mailinfo = [
                'id' => intval($myid),
                'title' => strip_tags($title),
                'sender' => strip_tags($sender),
                'description' => strip_tags($description),
                'name' => strip_tags($name),
                'email' => strip_tags($email),
                'token' => $token,
                'imgname' => strip_tags($dbimages),
                'images' => strip_tags($uniqdbimages),
                'datum' => date('Y-m-d'),
                'verified' => 0
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
                'imgname' => strip_tags($dbimages),
                'images' => strip_tags($uniqdbimages),
                'datum' => date('Y-m-d'),
                'verified' => 0
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
            header('Location: index.php?page=phpmail');
            echo 'Error sending mail : ' . $mailer->ErrorInfo;
        } else {
            //If mail is send, create data and send it to the database
            if(isset( $_POST['id'] )) {
                $mymail->update($mailinfo);
                $mailer->send();
            }
            else {
                $mymail->create($mailinfo);
            }

            header('Location: index.php?page=uploadoverzicht');
            Session::flash('error', 'Gebruiker bestaat niet.');
        }
    }
}
