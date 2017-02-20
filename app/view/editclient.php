<?php
#PAGE FOR UPDATING CLIENTS

$mysqli = mysqli_connect();
$session = new Session();

$client = new UserController();
$id = $_GET['id'];
$id = $session->cleantonumber($id);

$myclient = $client->getUserById($id);
if ($user->getPermission($permgroup, 'CAN_EDIT_CLIENT') == 1 && $myclient['permgroup'] == 1) {

} else if ($user->getPermission($permgroup, 'CAN_EDIT_USER') == 1 && $myclient['permgroup'] !== 1) {

} else {
    echo TEXT_CANT_EDIT_USER;
    return false;
}


if (isset($_POST['submit'])) {

    $naam = mysqli_real_escape_string($mysqli, $_POST['showname']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $altmail = mysqli_real_escape_string($mysqli, $_POST['altmail']);
    $bedrijfsnaam = mysqli_real_escape_string($mysqli, $_POST['companyname']);
    $adres = mysqli_real_escape_string($mysqli, $_POST['companyadress']);
    $postcode = mysqli_real_escape_string($mysqli, $_POST['postcode']);
    $plaats = mysqli_real_escape_string($mysqli, $_POST['plaats']);
    $lang = mysqli_real_escape_string($mysqli, $_POST['lang']);
    if(isset($_POST['rechten']) && $_POST['rechten']) {
        $rechten = mysqli_real_escape_string($mysqli, $_POST['rechten']);
    }
    $active = mysqli_real_escape_string($mysqli, $_POST['active']);

    //Generate a random string.
    $token = openssl_random_pseudo_bytes(8);
    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    $clientinfo = [
        'id' => intval($_POST['id']),
        'name' => strip_tags($naam),
        'email' => strip_tags($email),
        'altmail' => strip_tags($altmail),
        'bedrijfsnaam' => strip_tags($bedrijfsnaam),
        'adres' => strip_tags($adres),
        'postcode' => strip_tags($postcode),
        'plaats' => strip_tags($plaats),
        'lang' => strip_tags($lang),
        'active' => $active
    ];
    if(isset($rechten) && $rechten) {
        $clientinfo['permgroup'] = $rechten;
    }

    if (isset($_FILES['fileToUpload'])) {
        $error = 0;

        $myFile = $_FILES['fileToUpload'];
        $fileCount = count($myFile["name"]);

        $test = $myFile['name'];
        $test1 = $myFile['tmp_name'];

        $target_dir = DIR_IMG;
        $target_file = $target_dir . $test;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
            $error = 1;
        }

        if ($myFile["size"] > 10485760) {
            $error = 1;
            echo $test . '<div class="alert alert-danger" role="alert">' . TEXT_UPLOADED_FILE_TOO_BIG . '!</div>';
            return false;
        }

        if ($error == 0) {

            $unique_name = preg_replace('/\s+/', '-', $test);
            $uniqfile = $target_dir . $unique_name;

            if (move_uploaded_file($test1, $uniqfile)) {
                $clientinfo['profimg'] = $unique_name;
            }

        }

    }

    $client->update($clientinfo);
    $block->Redirect('index.php?page=dashboard');
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText"><?= TEXT_EDIT_USER ?></p>
                <br>

                <form method="post" enctype="multipart/form-data" class="form-horizontal">
                    <fieldset>

                        <input type="hidden" name="id" value="<?= $myclient['id']; ?>">

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="textinput"><?= TEXT_UPLOAD_LOGO ?></label>
                            <div class="col-md-4">
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> <?= BUTTON_UPLOAD ?>
                                </label>
                                <input type="file" name="fileToUpload" class="imgInp btn btn-primary btn-success"
                                       id="file-upload">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="textinput"><?= TEXT_SELECTED_LOGO ?></label>
                            <div class="col-md-4">
                                <div id="fileList"></div>

                                <output id="list"></output>
                            </div>
                        </div>

                        <p class="ClientFormText"><?= TEXT_NAMES ?></p>
                        <hr size="1">

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_NAME ?><span
                                    style="color:#dd2c4c">*</span></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" required type="text"
                                       name="showname" size="50" value="<?= $myclient['naam']; ?>">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_COMPANY_NAME ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" type="text"
                                       name="companyname" size="50" value="<?= $myclient['bedrijfsnaam']; ?>">
                            </div>
                        </div>

                        <p class="ClientFormText"><?= TEXT_CONTACT_DETAILS ?></p>
                        <hr size="1">

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_EMAIL ?><span
                                    style="color:#dd2c4c">*</span></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" required type="email"
                                       name="email" size="50" value="<?= $myclient['email']; ?>">
                            </div>
                        </div>

                        <br/>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_ALTERNATIVE_EMAIL ?></label>
                            <div class="col-md-4">
                                <span style="font-size:15px"><?= TEXT_ALTERNATIVE_EMAIL_INFO ?></span>
                                <input class="form-control input-md" id="textinput" maxlength="60" type="email"
                                       name="altmail" placeholder="E-mailadres">
                            </div>
                        </div>
                        <br/>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_ADRESS ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" type="text"
                                       name="companyadress" size="50" value="<?= $myclient['adres']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_POSTALCODE ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="8" type="text"
                                       name="postcode" size="50" value="<?= $myclient['postcode']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_CITY ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" type="text"
                                       name="plaats" size="50" value="<?= $myclient['plaats']; ?>">
                            </div>
                        </div>

                        <?php if($user->getPermission($permgroup, 'CAN_CHANGE_USER_LANGUAGE')) {?>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_LANGUAGE ?></label>
                            <div class="col-md-4">
                                <select class="form-control" name="lang" required>
                                    <?php if($myclient['lang'] == 'en') {?>
                                    <option value="<?= $myclient['lang'] ?>" selected>English</option>
                                    <?php } else {?>
                                    <option value="en">English</option>
                                    <?php } ?>

                                    <?php if($myclient['lang'] == 'nl') {?>
                                        <option value="<?= $myclient['lang'] ?>" selected>Nederlands</option>
                                    <?php } else {?>
                                    <option value="nl">Nederlands</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if ($user->getPermission($permgroup, 'CAN_EDIT_USER') == '1' && $user->getPermission($myclient['permgroup'], 'CAN_BE_EDITED') == '1') { ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label"><?= TEXT_PERMISSION ?><span
                                        style="color:#dd2c4c">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control" name="rechten" required>
                                        <?php if ($myclient['permgroup'] == '1') { ?>
                                            <option value="1" selected="selected"><?= TEXT_IS_CLIENT ?></option>
                                        <?php } else { ?>
                                            <option value="1"><?= TEXT_IS_CLIENT ?></option>
                                        <?php } ?>

                                        <?php if ($myclient['permgroup'] == '2') { ?>
                                            <option value="2" selected="selected"><?= TEXT_IS_USER ?></option>
                                        <?php } else { ?>
                                            <option value="2"><?= TEXT_IS_USER ?></option>
                                        <?php } ?>

                                        <?php if ($myclient['permgroup'] == '3') { ?>
                                            <option value="3" selected="selected"><?= TEXT_IS_ACCOUNTANT ?></option>
                                        <?php } else { ?>
                                            <option value="3"><?= TEXT_IS_ACCOUNTANT ?></option>
                                        <?php } ?>

                                        <?php if ($myclient['permgroup'] == '4') { ?>
                                            <option value="4" selected="selected"><?= TEXT_IS_ADMIN ?></option>
                                        <?php } else { ?>
                                            <option value="4"><?= TEXT_IS_ADMIN ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_ACTIVE ?></label>
                            <div class="col-md-4">
                                <select class="form-control" name="active">
                                    <option value="1" <?php if($myclient['active'] == '1') { echo 'selected'; } ?>>Actief</option>
                                    <option value="0" <?php if($myclient['active'] == '0') { echo 'selected'; } ?>>Inactief</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"></label>
                            <div class="col-md-4">
                                <input class="btn btn-primary btn-success" name="submit"
                                       style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c"
                                       type="submit" value="<?= BUTTON_SAVE ?>">
                            </div>
                        </div>
                    </fieldset>
                </form>


