<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 18-Oct-16
 * Time: 16:08
 */

#PAGE FOR UPDATING CLIENTS

$client = new ClientController();
$id = $_GET['id'];

$myclient = $client->getClientById($id);

if(isset($_POST['submit'])){

    //Generate a random string.
    $token = openssl_random_pseudo_bytes(8);
    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    $clientinfo = [
        'id' => intval($_POST['id']),
        'naam' => strip_tags( $_POST['showname'] ),
        'email' => strip_tags( $_POST['email'] ),
        'password' => $token,
        'bedrijfsnaam' => strip_tags( $_POST['companyname'] ),
        'adres' => strip_tags( $_POST['companyadress'] ),
        'postcode' => strip_tags( $_POST['postcode'] ),
        'plaats' => strip_tags( $_POST['plaats'] )
    ];

    $client->updateClient($clientinfo);

}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Klant bijwerken</p>
                <hr size="1">
                <br>
                <form class="NewClient" method="post" enctype="multipart/form-data">
                    <p class="ClientFormText">Namen</p>
                    <hr size="1">

                    <input type="hidden" name="id" value="<?= $myclient['id']; ?>">

                    <label>Naam klant<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="showname" size="50" value="<?= $myclient['naam']; ?>"><br><br>

                    <label>Bedrijfsnaam<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="companyname" size="50" value="<?= $myclient['bedrijfsnaam']; ?>"><br><br>

                    <p class="ClientFormText">Contactgegevens</p>
                    <hr size="1">
                    <label>E-mailadres<span style="color:#bc2d4c">*</span></label>
                    <input required type="email" name="email" size="50" value="<?= $myclient['email']; ?>" placeholder="voorbeeld@voorbeeld.nl"><br><br>

                    <label>Bedrijfsadres<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="companyadress" size="50" value="<?= $myclient['adres']; ?>"><br><br>

                    <label>Postcode<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="postcode" size="8" value="<?= $myclient['postcode']; ?>"><br><br>

                    <label>Plaats<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="plaats" size="50" value="<?= $myclient['plaats']; ?>"><br><br>

                    <br><br>
                    <input type="submit" name="submit" size="50" value="Versturen">
                </form
            </div>
        </div>
    </div>
</div>

