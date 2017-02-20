<?php
#VERWERKT UPLOAD PROCESS

include_once DIR_MODEL . 'permissions.php';
$block = new BlockController();
$user = new UserController();

$db = new Database();
$mysqli = $db->getConnection();

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
$sender = $client['naam'];

$name = mysqli_real_escape_string($mysqli, $client['naam']);

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
    $imageId = $imageFileName->getNewId();
    $imageId = $imageId + 1;
}

$error = 0;

$unique_names = array();

if(!empty($_FILES)) {

    $targetDir = "../app/uploads/";
    $myFile = $_FILES['file'];
    $fileCount = count($myFile["name"]);

    $test = $myFile['name'];
    $test1 = $myFile['tmp_name'];
    $targetFile = $targetDir . $test;

    $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);


    $unique_name = pathinfo($test, PATHINFO_FILENAME) . "_" . ($imageId) . '.' . $imageFileType;
    $unique_name = preg_replace('/\s+/', '-', $unique_name);
    $uniqfile = $targetDir . $unique_name;

    if (file_exists($uniqfile)) {
        $uniq = pathinfo($uniqfile);
        $unique_name = $uniq['filename'] . "-1" . '.' . $uniq['extension'];
        $uniqfile = $targetDir . $unique_name;
    }

    if (move_uploaded_file($test1, $uniqfile)) {
        //array_push($_SESSION['unique_names'], $unique_name);

        echo $unique_name;

        $updir = $targetDir;
        $img = $unique_name;

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
die();