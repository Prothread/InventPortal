<?php
/**
 * Created by PhpStorm.
 * User: Gijs
 * Date: 29-Sep-16
 * Time: 11:47
 */

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

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $error = 1;
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
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

                    echo "The file " . $test . " has been uploaded."; ?><br /><?php
                    echo '<img style="width:300px; height: auto;" src="../app/uploads/' . $unique_name . '">';
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
        $to = $_POST['mailto']; //The 'To' field
        $subject = $_POST['title'];
        $content = "<img alt='MadalcoHeader' src='http://i68.tinypic.com/dw5a9f.png'>"."  <br/><br/>" . "Geachte " . $_POST['mailname'] . "," .
            " <br/><br/>" . "Uw proef staat te wachten op goedkeuring in het <b>Madalco Portaal!</b>" . "<br /><br />" .
            "<b>Beschrijving van uw proef:</b> " .
            $_POST['additionalcontent'] .

            "<br /><br />" . "U kunt uw proef " . "<a href='http://localhost/InventPortal/public/index.php?page=verify&email=$to&key=$token'>hier</a> " . "goedkeuren." .

            "<br /> <br />Met vriendelijke groet, <br />" . $_POST['fromname'] . " </br>Madalco Media";;
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

        $dbimages = implode(", ", $images);
        $uniqdbimages = implode(", ", $unique_names);


        if(isset($_POST['id'])) {
        $myid = $_POST['id'];
            $mailinfo = [
                'id' => intval($myid),
                'title' => $_POST['title'],
                'sender' => $_POST['fromname'],
                'description' => $_POST['additionalcontent'],
                'name' => $_POST['mailname'],
                'email' => $_POST['mailto'],
                'token' => $token,
                'imgname' => $dbimages,
                'images' => $uniqdbimages,
                'datum' => date('Y-m-d'),
                'verified' => 0
            ];
        }
        else {
            $mailinfo = [
                'title' => strip_tags($_POST['title']),
                'sender' => strip_tags($_POST['fromname']),
                'description' => strip_tags($_POST['additionalcontent']),
                'name' => strip_tags($_POST['mailname']),
                'email' => strip_tags($_POST['mailto']),
                'token' => strip_tags($token),
                'imgname' => strip_tags($dbimages),
                'images' => strip_tags($uniqdbimages),
                'datum' => date('Y-m-d'),
                'verified' => 0
            ];
        }

//Check if mail is sent :
        if (!$mailer->send()) {
            header('Location: index.php?page=phpmail');
            echo 'Error sending mail : ' . $mailer->ErrorInfo;
        } else {
            //If mail is send, create data and send it to the database
            if(isset( $_POST['id'] )) {
                $mymail->update($mailinfo);
                $mailer->send();
                //var_dump($mymail);
            }
            else {
                $mymail->create($mailinfo);
                //var_dump($mymail);
            }

            //header('Location: index.php?page=uploading');
        }
    }
}
