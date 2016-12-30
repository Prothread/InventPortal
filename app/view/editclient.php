<?php
#PAGE FOR UPDATING CLIENTS

if ($user->getPermission($permgroup, 'CAN_EDIT_CLIENT') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$mysqli = mysqli_connect();
$session = new Session();

$client = new UserController();
$id = $_GET['id'];
$id = $session->cleantonumber($id);

$myclient = $client->getUserById($id);
if ($user->getPermission($permgroup, 'CAN_EDIT_CLIENT') == 1 && $userinfo['permgroup'] == 1) {

} else if ($user->getPermission($permgroup, 'CAN_EDIT_USER') == 1 && $userinfo['permgroup'] !== 1) {

} else {
    return 'U heeft geen rechten om dit te doen';
}


if (isset($_POST['submit'])) {

    $naam = mysqli_real_escape_string($mysqli, $_POST['showname']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $altmail = mysqli_real_escape_string($mysqli, $_POST['altmail']);
    $bedrijfsnaam = mysqli_real_escape_string($mysqli, $_POST['companyname']);
    $adres = mysqli_real_escape_string($mysqli, $_POST['companyadress']);
    $postcode = mysqli_real_escape_string($mysqli, $_POST['postcode']);
    $plaats = mysqli_real_escape_string($mysqli, $_POST['plaats']);
    $rechten = mysqli_real_escape_string($mysqli, $_POST['rechten']);

    //Generate a random string.
    $token = openssl_random_pseudo_bytes(8);
    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    $clientinfo = [
        'id' => intval($_POST['id']),
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
            echo $test . '<div class="alert alert-danger" role="alert">Het meegestuurde bestand is te groot!</div>';
            ?><br/><?php
            return false;
        }

        if ($error == 0) {

            $unique_name = preg_replace('/\s+/', '-', $test);
            $uniqfile = $target_dir . $unique_name;

            if (move_uploaded_file($test1, $uniqfile)) {

            }

            $clientinfo = [
                'id' => intval($_POST['id']),
                'profimg' => $unique_name,
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

    }


    $client->update($clientinfo);
    $block->Redirect('index.php?page=dashboard');

}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">User bijwerken</p>
                <br>

                <form method="post" enctype="multipart/form-data" class="form-horizontal">
                    <fieldset>

                        <input type="hidden" name="id" value="<?= $myclient['id']; ?>">

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="textinput">Logo uploaden</label>
                            <div class="col-md-4">
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Uploaden
                                </label>
                                <input type="file" name="fileToUpload" class="imgInp btn btn-primary btn-success"
                                       id="file-upload">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="textinput">Geselecteerd bestand</label>
                            <div class="col-md-4">
                                <div id="fileList"></div>

                                <output id="list"></output>
                            </div>
                        </div>

                        <p class="ClientFormText">Namen</p>
                        <hr size="1">

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Naam<span
                                    style="color:#dd2c4c">*</span></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" required type="text"
                                       name="showname" size="50" value="<?= $myclient['naam']; ?>">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Bedrijfsnaam</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" type="text"
                                       name="companyname" size="50" value="<?= $myclient['bedrijfsnaam']; ?>">
                            </div>
                        </div>

                        <p class="ClientFormText">Contactgegevens</p>
                        <hr size="1">

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">E-mail<span
                                    style="color:#dd2c4c">*</span></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" required type="email"
                                       name="email" size="50" value="<?= $myclient['email']; ?>">
                            </div>
                        </div>

                        <br/>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Alt E-mail</label>
                            <div class="col-md-4">
                                <span style="font-size:15px">Alternatief email voor contact met de klant</span>
                                <input class="form-control input-md" id="textinput" maxlength="60" type="email"
                                       name="altmail" placeholder="E-mailadres">
                            </div>
                        </div>
                        <br/>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Adres</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" type="text"
                                       name="companyadress" size="50" value="<?= $myclient['adres']; ?>">
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Postcode</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="8" type="text"
                                       name="postcode" size="50" value="<?= $myclient['postcode']; ?>">
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Plaats</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" type="text"
                                       name="plaats" size="50" value="<?= $myclient['plaats']; ?>">
                            </div>
                        </div>

                        <?php if ($user->getPermission($permgroup, 'CAN_EDIT_USER') == '1') { ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Rechten<span
                                        style="color:#dd2c4c">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control" name="rechten" required>
                                        <?php if ($myclient['permgroup'] == '1') { ?>
                                            <option value="1" selected="selected">Klant</option>
                                        <?php } else { ?>
                                            <option value="1">Klant</option>
                                        <?php } ?>

                                        <?php if ($myclient['permgroup'] == '2') { ?>
                                            <option value="2" selected="selected">Gebruiker</option>
                                        <?php } else { ?>
                                            <option value="2">Gebruiker</option>
                                        <?php } ?>

                                        <?php if ($myclient['permgroup'] == '3') { ?>
                                            <option value="3" selected="selected">Beheerder</option>
                                        <?php } else { ?>
                                            <option value="3">Beheerder</option>
                                        <?php } ?>

                                        <?php if ($myclient['permgroup'] == '4') { ?>
                                            <option value="4" selected="selected">Admin</option>
                                        <?php } else { ?>
                                            <option value="4">Admin</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        <?php } else { ?>
                            <input class="form-control" value="<?= $userinfo['permgroup'] ?>" type="hidden"
                                   name="rechten">
                        <?php } ?>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"></label>
                            <div class="col-md-4">
                                <input class="btn btn-primary btn-success" name="submit"
                                       style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c"
                                       type="submit" value="Opslaan">
                            </div>
                        </div>
                    </fieldset>
                </form>


