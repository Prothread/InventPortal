<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 12:43
 */

$upload = new BlockController();
//$myupload = $upload->getUploadById($_SESSION['id']);

$myupload = $upload->getUploadById($_GET['id']);

$imgarray = ( explode(", ", $myupload['imgname']) );

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

                <p> Bestand:
                    <a href="#">
                        <span style="color:#bc2d4c">
                            <?= $myupload['imgname']?>
                        </span>
                    </a>
                </p>

                <p> Omschrijving: <span style="color:#bc2d4c"><?= $myupload['beschrijving']?></span> </p>

                <div style="border:0; width: 259px; height: 459px">
                    <?php
                    foreach ($imgarray as $img) {?>
                        <img style="pointer-events: none;" height="410" width="250" src="<?= DIR_IMAGE.$img?>" />
                        <div style="position:relative; left: 0px; top: -300px; width:150px;">
                            <img style="pointer-events: none;" src="css/watermerk.png" width=250 height=200>
                        </div>
                    <?php }
                    ?>
                </div>

                <form class="UploadForm" action="#">
                    <label>Volledige naam<span style="color:#bc2d4c">*</span></label>
                    <input type="text" name="description" size="50" value="" required><br><br>

                    <label>Opmerking<span style="color:#bc2d4c">*</span></label>
                    <input type="text" name="description" size="50" value="" required><br><br>

                    <input type="checkbox" name="yeahright" required>
                    <label>Ik heb de <a href="#"><span style="color:#bc2d4c">algemene voorwaarden</span></a> gelezen en ga hiermee akkoord</label><br><br>
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
