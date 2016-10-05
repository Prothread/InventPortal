<?php
/**
 * Created by PhpStorm.
 * User: Gijs
 * Date: 29-Sep-16
 * Time: 11:47
 */

$imageFileName = new ImageController();
$imageId = $imageFileName->getNewId();

$error = 0;

if (isset($_FILES['myFile'])) {
    $error = 0;

    $myFile = $_FILES['myFile'];
    $fileCount = count($myFile["name"]);

    $images = array();

    for ($i = 0; $i < $fileCount; $i++) {

        $test = $myFile['name'][$i];
        $test1 = $myFile['tmp_name'][$i];


        $target_dir = "../app/uploads/";
        $target_file = $target_dir . $test;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (file_exists($target_file)) {
            $error = 1;
            echo $test . $imageId ." already exists!";
            ?><br/><?php
        }

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

            $target_dir = "../app/uploads/";
            $target_file = $target_dir . $test;

                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                if (move_uploaded_file($test1, $target_file)) {
                    array_push($images, $test);

                    echo "The file " . $test . " has been uploaded."; ?><br /><?php
                    echo '<img style="width:300px; height: auto;" src="../app/uploads/' . $test . '">';
                    ?>

                    <p>
                        Name: <?= $myFile["name"][$i] ?><br>
                        Type: <?= $myFile["type"][$i] ?><br>
                        Size: <?= $myFile["size"][$i] ?><br>
                        Error: <?= $myFile["error"][$i] ?><br>
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
        $content = "Beste " . $_POST['mailname'] .
            "<br/><br/>" . "This is the HTML message body <b>in bold!</b>" . "<br /><br />" .

            $_POST['additionalcontent'] .

            "<br /><br />" . "Here is the link to get you your product: " . "<a href='http://localhost/InventPortal/public/index.php?page=verify&email=$to&key=$token'>Link</a> " .

            "<br /> <br />Met vriendelijke groet, <br />" . $_POST['fromname'];;
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

        $mailinfo = [
            'title' => $_POST['title'],
            'sender' => $_POST['fromname'],
            'description' => $_POST['additionalcontent'],
            'name' => $_POST['mailname'],
            'email' => $_POST['mailto'],
            'token' => $token,
            'imgname' => $dbimages,
            'images' => $dbimages,
            'datum' => date('d-m-Y'),
            'verified' => $_POST['verified']
        ];

//Check if mail is sent :
        if (!$mailer->send()) {
           // header('Location: index.php?page=phpmail');
            echo 'Error sending mail : ' . $mailer->ErrorInfo;
        } else {
            //If mail is send, create data and send it to the database
            $mymail->create($mailinfo);
            //header('Location: index.php?page=uploading');
        }
    }
}
