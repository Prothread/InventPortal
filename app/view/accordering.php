<?php
#ACCORDERING PAGINA

//TODO Mensen kunnen op de accorder pagina komen als ze niet ingelogd zijn
// Haal hierbij het email op en vergelijk het met een van de gebruikers en als het akkoord gaat bij het accorderen
// dat het bijgewerkt wordt bij de lijst van de geaccordeerde proeven/offertes van die gebruiker

//TODO niet verdergaan als nog niet alle images beoordeeld zijn

$upload = new BlockController();
$session = new Session();
$myupload = $upload->getUploadById($session->getMailId());
$imgarray = ( explode(", ", $myupload['uniquename']) );

$image_controller = new ImageController();
$uploadedimages = $image_controller->getImagebyMailID($myupload['id']);

$verifiedimages = array();

if (isset($_POST['submit'])) {

    foreach ($uploadedimages as $img) {
        $session->getImageVerify($img['id']);
        array_push($verifiedimages, $session->getImageVerify($img['id']));
    }

}

if (in_array(2, $verifiedimages)) {
    $verified = 3;
    $verifytext = "afgekeurd";
} else {
    $verified = 2;
    $verifytext = 'goedgekeurd';
}

if(in_array( 0, $verifiedimages)) {
    echo "You can't submit yet, because you haven't verified all images yet";
}
else {
    if(isset($_POST['submit'])) {

        foreach ($uploadedimages as $img) {
            $session->getImageVerify($img['id']);
            $image_controller->setImageVerify($img['id'], $session->getImageVerify($img['id']));
        }

    }
}
?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Productaccordering</p>
                <hr size="1">

                <!-- TODO Delete id-->
                <p> Tidjelijk id: <span style="color:#bc2d4c"><?= $myupload['id']; ?></span></p>

                <p> Onderwerp: <span style="color:#bc2d4c"><?= $myupload['onderwerp']; ?></span></p>

                <p> Verstuurder: <span style="color:#bc2d4c"><?= $myupload['verstuurder']?></span> </p>

                <p> Bestand(en):
                    <a href="#">
                    <span style="color:#bc2d4c">
                        <?= $myupload['imgname']?>
                    </span>
                    </a>
                </p>

                <p> Omschrijving: <span style="color:#bc2d4c"><?= $myupload['beschrijving']?></span> </p>

                <?php
                foreach ($uploadedimages as $img) { ?>
                    <div id="imgakkoord" style="float:left;">
                        <div style="border:0; width: auto; height: 410px">
                            <img id="myimage" style="pointer-events: none;" height="410" width="300" border="20px solid white" src="<?php echo DIR_IMAGE.$img['images'];?>" />
                            <div style="position:relative; left: 28px; top: -304px; width:150px;">
                                <img style="pointer-events: none;z-index:5;" src="css/watermerk.png" width=250 height=200>
                            </div>
                        </div>
                        <br />
                        <div id="mybuttons">
                            <a id="AccButtonA" href="?page=imageverify&img=<?= $img['id']; ?>"><button id="AccButton" onclick="VerifyAnswer()">Akkoord</button></a>
                            <a id="AccButtonA" href="?page=imagedecline&img=<?= $img['id']; ?>"><button id="AccButton" onclick="VerifyAnswer1()">Weiger</button></a>

                            <!--<button id="AccButtonB" onclick="VerifyAnswer()"></button>

                            <script>
                                var AccButtonA = document.getElementById('AccButtonA');
                                var AccButtonB = document.getElementById('AccButtonB');

                                function VerifyAnswer(){
                                    AccButtonA.style.background.opacity = 0.5;
                                    AccButtonB.style.display = "block";
                                }
                                function VerifyAnswer1() {
                                    AccButtonA.style.display = "block";
                                    AccButtonB.style.display = "none";
                                }
                            </script>-->

                        </div>
                    </div>
                <?php }
                ?>

                <form class="UploadForm" action="?page=updatemail" style="clear:both;" method="post" enctype="multipart/form-data">
                    <br />

                    <input type="hidden" name="id" value="<?= $myupload['id']; ?>">

                    <label>Opmerking<span style="color:#bc2d4c">*</span></label>
                    <input type="text" name="answer" size="50" required><br><br>

                    <input type="hidden" name="name" value="<?= $myupload['naam']; ?>">
                    <input type="hidden" name="title" value="<?= $myupload['onderwerp']; ?>">
                    <input type="hidden" name="verified" value="<?php if(isset($verified)){ echo $verified; }?>">
                    <input type="hidden" name="keuring" value="<?php if(isset($verified)) { echo $verifytext; }?>">

                    <input type="hidden" name="fromname" id="" value="Kevin Ernst">
                    <input type="hidden" name="mailto" id="" value="kevin.herdershof@hotmail.com">

                    <label id="Voorwaarden">Ik heb de <a href="index.php?page=conditions"><span style="color:#bc2d4c">algemene voorwaarden</span></a> gelezen en ga hiermee akkoord</label>
                    <input type="checkbox" name="yeahright" required>
                    <br><br>

                    <input type="submit" value="Verstuur!" >

                    <br><br>
                    <label>Uw IP-adres: <?PHP
                        echo ''.$_SERVER['REMOTE_ADDR'];
                        ?></label>
                </form>
                <br>
                <br>

            </div>
        </div>
    </div>