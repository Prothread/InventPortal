<?php
#ACCORDERING PAGINA

$upload = new BlockController();
$session = new Session();
$myupload = $upload->getUploadById($session->getMailId());
$imgarray = ( explode(", ", $myupload['uniquename']) );

$image_controller = new ImageController();
$uploadedimages = $image_controller->getImagebyMailID($myupload['id']);

?>


<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Productaccordering</p>
                <hr size="1">

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
                foreach ($uploadedimages as $img) {
                    //for($i = 0; $i <= $imgarray; $i++) { --> ophalen welke het is met $i en dit in de session zetten
                    ?>
                    <div id="imgakkoord" style="float:left;">
                        <div style="border:0; width: auto; height: 410px">
                            <img id="myimage" style="pointer-events: none;" height="410" width="300" border="20px solid white" src="<?php echo DIR_IMAGE.$img['images'];?>" />
                            <div style="position:relative; left: 28px; top: -304px; width:150px;">
                                <img style="pointer-events: none;z-index:5;" src="css/watermerk.png" width=250 height=200>
                            </div>
                        </div>
                        <br />
                        <div id="mybuttons">
                            <a href="?page=imageverify&img=<?= $img['id']; ?>"><button id="AccButton"href="?page=imageverify">Akkoord</button></a>
                            <a href="?page=imagedecline&img=<?= $img['id']; ?>"><button id="AccButton" href="?page=imageverify">Weiger</button></a>
                        </div>
                    </div>
                <?php }
                ?>

                <form class="UploadForm" action="#" style="clear:both;">
                    <br />
                    <label>Volledige naam<span style="color:#bc2d4c">*</span></label>
                    <input type="text" name="description" size="50" value="" required><br><br>

                    <label>Opmerking<span style="color:#bc2d4c">*</span></label>
                    <input type="text" name="description" size="50" value="" required><br><br>

                    <label id="Voorwaarden">Ik heb de <a href="index.php?page=conditions"><span style="color:#bc2d4c">algemene voorwaarden</span></a> gelezen en ga hiermee akkoord</label><input type="checkbox" name="yeahright" required>
                    <br>
                    <br>
                    <input type="submit" value="Akkoord!" >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" value="Weiger">
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