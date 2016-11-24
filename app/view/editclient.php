<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 18-Oct-16
 * Time: 16:08
 */

#PAGE FOR UPDATING CLIENTS

if($user->getPermission($permgroup, 'CAN_EDIT_CLIENT') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$mysqli = mysqli_connect();

$client = new UserController();
$id = $_GET['id'];

$myclient = $client->getUserById($id);
if($user->getPermission($permgroup, 'CAN_EDIT_CLIENT') == 1 && $userinfo['permgroup'] == 1){

}
else if($user->getPermission($permgroup, 'CAN_EDIT_USER') == 1 && $userinfo['permgroup'] !== 1) {

}
else {
    return 'U heeft geen rechten om dit te doen';
}

if(isset($_POST['submit'])){

    $naam = mysqli_real_escape_string( $mysqli, $_POST['showname']);
    $email = mysqli_real_escape_string( $mysqli, $_POST['email']);
    $bedrijfsnaam = mysqli_real_escape_string( $mysqli, $_POST['companyname']);
    $adres = mysqli_real_escape_string( $mysqli, $_POST['companyadress']);
    $postcode = mysqli_real_escape_string( $mysqli, $_POST['postcode']);
    $plaats = mysqli_real_escape_string( $mysqli, $_POST['plaats']);
    $rechten = mysqli_real_escape_string($mysqli, $_POST['rechten']);

    //Generate a random string.
    $token = openssl_random_pseudo_bytes(8);
    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    $clientinfo = [
        'id' => intval($_POST['id']),
        'name' => strip_tags( $naam ),
        'email' => strip_tags( $email ),
        'password' => $token,
        'bedrijfsnaam' => strip_tags( $bedrijfsnaam ),
        'adres' => strip_tags( $adres ),
        'postcode' => strip_tags( $postcode ),
        'plaats' => strip_tags( $plaats ),
        'permgroup' => $rechten
    ];

    $client->update($clientinfo);
    header('Location: index.php?page=dashboard');

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

                        <p class="ClientFormText">Namen</p>
                        <hr size="1">

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Naam</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" required type="text" name="showname" size="50" value="<?= $myclient['naam']; ?>">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Bedrijfsnaam</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" required type="text" name="companyname" size="50" value="<?= $myclient['bedrijfsnaam']; ?>">
                            </div>
                        </div>

                        <p class="ClientFormText">Contactgegevens</p>
                        <hr size="1">

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">E-mail</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" required type="email" name="email" size="50" value="<?= $myclient['email']; ?>">
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Adres</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" required type="text" name="companyadress" size="50" value="<?= $myclient['adres']; ?>">
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Postcode</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" required type="text" name="postcode" size="50" value="<?= $myclient['postcode']; ?>">
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Plaats</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" required type="text" name="plaats" size="50" value="<?= $myclient['plaats']; ?>">
                            </div>
                        </div>

                        <?php if($user->getPermission($permgroup, 'CAN_EDIT_USER')) { ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Rechtgroepen</label>
                                <div class="col-md-4">
                                    <label class="col-md-2 control-label" for="textinput">Klant: 1</label>
                                    <label class="col-sm-3 control-label" for="textinput">Gebruiker: 2</label>
                                    <label class="col-sm-3 control-label" for="textinput">Beheerder: 3</label>
                                    <label class="col-sm-3 control-label" for="textinput">Admin: 4</label>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($user->getPermission($permgroup, 'CAN_EDIT_USER')) { ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Rechten:</label>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?= $userinfo['permgroup'] ?>" type="text" name="rechten">
                                </div>
                            </div>
                        <?php } else {?>
                            <input class="form-control" value="<?= $userinfo['permgroup'] ?>" type="hidden" name="rechten">
                        <?php } ?>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"></label>
                            <div class="col-md-4">
                                <input class="btn btn-primary btn-success" name="submit"  style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c" type="submit" value="Opslaan">
                            </div>
                        </div>
                    </fieldset>
                </form>


