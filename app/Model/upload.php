<?php
#VERWERKT UPLOAD PROCESS

if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

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
var_dump($client);

$usr = $user->getUserById($_SESSION['usr_id']);
$sender = $usr['naam'];

if ($client['altmail']) {
    $email = $client['altmail'];
} else {
    $email = $client['email'];
}

$comment = mysqli_real_escape_string($mysqli, $_POST['interncomment']);
$commentgroep = mysqli_real_escape_string($mysqli, $_POST['commentgroep']);
$extracomment = mysqli_real_escape_string($mysqli, $_POST['extracomment']);

$imageFileName = new ImageController();
$block = new BlockController();

if (isset($_POST['id'])) {
    $imageId = $_POST['id'];
} else {
    $dbmail = new DbMail();

    if ($dbmail->getIncrement()) {
        $imageId = $dbmail->getIncrement();
    } else {
        $imageId = $imageFileName->getNewId();
        $imageId = $imageId + 1;
    }
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

        if ($myFile["size"][$i] > 15728640) {
            $error = 1;
            header('Location: index.php?page=uploadoverview');
            Session::flash('message', TEXT_UPLOADED_FILE_TOO_BIG);
        }

        if ($error == 0) {

            $unique_name = pathinfo($test, PATHINFO_FILENAME) . "_" . ($imageId) . '.' . $imageFileType;
            $unique_name = preg_replace('/\s+/', '-', $unique_name);
            $uniqfile = $target_dir . $unique_name;

            if (file_exists($uniqfile)) {
                $uniq = pathinfo($uniqfile);
                $unique_name = $uniq['filename'] . "-1" . '.' . $uniq['extension'];
                $uniqfile = $target_dir . $unique_name;
            }


            if (move_uploaded_file($test1, $uniqfile)) {
                array_push($unique_names, $unique_name);
            }

            $updir = $target_dir;
            $img = $unique_name;

            if (file_exists($updir . $img)) {

                $thumbnail_width = 100;
                $thumbnail_height = 100;
                $thumb_beforeword = "thumb_";
                $arr_image_details = getimagesize("$updir" . "$img"); // pass id to thumb name
                $original_width = $arr_image_details[0];
                $original_height = $arr_image_details[1];

                if ($original_width > $original_height) {
                    $new_width = $thumbnail_width;
                    $new_height = intval($original_height * $new_width / $original_width);
                } else {
                    $new_height = $thumbnail_height;
                    $new_width = intval($original_width * $new_height / $original_height);
                }

                $dest_x = intval(($thumbnail_width - $new_width) / 2);
                $dest_y = intval(($thumbnail_height - $new_height) / 2);

                if ($arr_image_details[2] == IMAGETYPE_GIF) {
                    $imgt = "ImageGIF";
                    $imgcreatefrom = "ImageCreateFromGIF";
                }

                if ($arr_image_details[2] == IMAGETYPE_JPEG) {
                    $imgt = "ImageJPEG";
                    $imgcreatefrom = "ImageCreateFromJPEG";
                }

                if ($arr_image_details[2] == IMAGETYPE_PNG) {
                    $imgt = "ImagePNG";
                    $imgcreatefrom = "ImageCreateFromPNG";
                }

                if ($imgt) {
                    $old_image = $imgcreatefrom("$updir" . "$img");
                    $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
                    $white = imagecolorallocate($new_image, 255, 255, 255);
                    imagefill($new_image, 0, 0, $white);
                    imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
                    $imgt($new_image, "$updir" . "$thumb_beforeword" . "$img");
                }

            }

        }

    }

    foreach ($unique_names as $image) {
        $Directory = "../app/uploads/";
        $fullPath = $Directory . $image;

        if (file_exists($fullPath)) {
            true;
        } else {
            echo '<div class="alert alert_error">' . TEXT_FILES_UPLOAD_ERROR . '</div>';
            return false;
        }
    }

}

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

    if (isset($_POST['submit'])) {

        /* Create phpmailer and add the image to the mail */
        $mailer = new PHPMailer();
        $mailer->addEmbeddedImage(DIR_PUBLIC . $admin['Logo'], "HeaderImage", "Logo.png");

        /* TO, SUBJECT, CONTENT */
        $to = $email; //The 'To' field
        $subject = $title;

        $link = $admin['Host'] . "/index.php?page=verify&id=$imageId&key=$token";

        function printImages($uploadedimage, $link, $hosturl)
        {
            $html = '';
            $i = 0;
            foreach ($uploadedimage as $image) {
                $html .= "<a href='$link'><img src='$hosturl/index.php?page=image&img=thumb_$image' style='width: auto;height: 70px;'></a>";
                $i++;
            }
            return $html;
        }

        if ($client['lang']) {
            include_once DIR_VIEW . $client['lang'] . '_mail_proef.php';
        } else {
            include_once DIR_VIEW . 'en' . '_mail_proef.php';
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
        $mailer->FromName = $sender; //Optional
        $mailer->addAddress($to);  // Add a recipient
        //if(isset($_POST['secondEmailAdress'])) {

        //}

//Subject - Body :
        $mailer->Subject = $subject;
        $mailer->Body = $content;
        $mailer->isHTML(true); //Mail body contains HTML tags
        $mailer->AltBody = $altcontent;

//Saving mail information

        $uniqdbimages = implode(", ", $unique_names);

        if (isset($_POST['id'])) {
            $myid = $_POST['id'];
            if ($extracomment !== null && $extracomment !== '' && $comment !== null && $comment !== '') {
                $mailinfo = [
                    'id' => intval($myid),
                    'title' => strip_tags($title),
                    'sender' => intval($_SESSION['usr_id']),
                    'description' => strip_tags($description),
                    'name' => intval($clientid),
                    'email' => strip_tags($to),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0,
                    'comment' => $comment,
                    'commentgroep' => $commentgroep,
                    'extracomment' => $extracomment
                ];
            }
            else if ($comment !== null && $comment !== '') {
                    $mailinfo = [
                        'id' => intval($myid),
                        'title' => strip_tags($title),
                        'sender' => intval($_SESSION['usr_id']),
                        'description' => strip_tags($description),
                        'name' => intval($clientid),
                        'email' => strip_tags($to),
                        'token' => $token,
                        'images' => strip_tags($uniqdbimages),
                        'datum' => date('Y-m-d'),
                        'verified' => 0,
                        'comment' => $comment,
                        'commentgroep' => $commentgroep
                    ];
            } else if($extracomment !== null && $extracomment !== ''){
                $mailinfo = [
                    'id' => intval($myid),
                    'title' => strip_tags($title),
                    'sender' => intval($_SESSION['usr_id']),
                    'description' => strip_tags($description),
                    'name' => intval($clientid),
                    'email' => strip_tags($to),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0,
                    'extracomment' => $extracomment
                ];
            }else{
                $mailinfo = [
                    'id' => intval($myid),
                    'title' => strip_tags($title),
                    'sender' => intval($_SESSION['usr_id']),
                    'description' => strip_tags($description),
                    'name' => intval($clientid),
                    'email' => strip_tags($to),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0
                ];
            }
        } else {
            if ($extracomment !== null && $extracomment !== '' && $comment !== null && $comment !== '') {
                $mailinfo = [
                    'clientid' => intval($clientid),
                    'title' => strip_tags($title),
                    'sender' => intval($_SESSION['usr_id']),
                    'description' => strip_tags($description),
                    'name' => intval($clientid),
                    'email' => strip_tags($to),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0,
                    'comment' => $comment,
                    'commentgroep' => $commentgroep,
                    'extracomment' => $extracomment
                ];
            }
            else if ($comment !== null && $comment !== '') {
                $mailinfo = [
                    'clientid' => intval($clientid),
                    'title' => strip_tags($title),
                    'sender' => intval($_SESSION['usr_id']),
                    'description' => strip_tags($description),
                    'name' => intval($clientid),
                    'email' => strip_tags($to),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0,
                    'comment' => $comment,
                    'commentgroep' => $commentgroep
                ];
            } else if($extracomment !== null && $extracomment !== ''){
                $mailinfo = [
                    'clientid' => intval($clientid),
                    'title' => strip_tags($title),
                    'sender' => intval($_SESSION['usr_id']),
                    'description' => strip_tags($description),
                    'name' => intval($clientid),
                    'email' => strip_tags($to),
                    'token' => $token,
                    'images' => strip_tags($uniqdbimages),
                    'datum' => date('Y-m-d'),
                    'verified' => 0,
                    'extracomment' => $extracomment
                ];
            }else{
                $mailinfo = [
                    'clientid' => intval($clientid),
                    'title' => strip_tags($title),
                    'sender' => intval($_SESSION['usr_id']),
                    'description' => strip_tags($description),
                    'name' => intval($clientid),
                    'email' => strip_tags($to),
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
            Session::flash('error', $mailer->ErrorInfo);
        } else {
            //If mail is send, create data and send it to the database
            if (isset($_POST['id'])) {
                $mymail->update($mailinfo);
            } else {
                $mymail->create($mailinfo);
            }
            unset($_SESSION['clientid']);

            $block->Redirect('index.php?page=overview');
            Session::flash('message', TEXT_FILE_UPLOADED);
        }
    }
}
