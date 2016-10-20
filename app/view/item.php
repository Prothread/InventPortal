<?php
#INDIVIDUAL ITEM PAGE

$uploads = new BlockController();
$id = $_GET['id'];
$upload = $uploads->getUploadById($id);
$imgarray = ( explode(", ", $upload['uniquename']) );

$image_controller = new ImageController();
$uploadedimages = $image_controller->getImagebyMailID($upload['id']);
?>

    <div id="Mail">
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="NameText">Aanpassen</p>
                        <hr size="1">
                        <form class="UploadForm" action="?page=uploading" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $upload['id']?>">&emsp;&emsp;
                            <label>Onderwerp<span style="color:#bc2d4c">*</span></label>
                            <input type="text" name="title" size="50" value="<?= $upload['onderwerp']?>">&emsp;&emsp;
                            <label>Verstuurder<span style="color:#bc2d4c">*</span></label>
                            <input type="text" name="fromname" size="35" value="<?= $upload['verstuurder']?>">
                            <br />

                            <?php foreach ($uploadedimages as $img) {
                            ?>
                            <div id="imgakkoord" style="float:left;">
                                <div style="border:0; width: auto; height: 410px">
                                    <img id="myimage" style="pointer-events: none;" height="410" width="300" border="20px solid white" src="<?php echo DIR_IMAGE.$img['images'];?>" />
                                    <div style="position:relative; left: 28px; top: -304px; width:150px;">
                                        <img style="pointer-events: none;z-index:5;" src="css/watermerk.png" width=250 height=200>
                                    </div>
                                </div>
                                <br />
                            </div>
                            <?php }
                            ?>

                            <br><br>
                            <fieldset style="clear:both">
                                <label class="fileContainer">Nieuwe Bestand(en) uploaden*
                                    <input type="file" name="myFile[]" id="imgInp" multiple onchange="loadFile(event);">
                                </label>
                                <br>
                                <img src="http://i67.tinypic.com/mtxpbl.jpg" class="preview" id="preview" alt="">
                            </fieldset><br>
                            
                            <label>Beschrijving<span style="color:#bc2d4c">*</span></label><br>

                            <input class="TaDescription" name="additionalcontent" value="<?= $upload['beschrijving']?>">
                            <br><br>

                            <label>Naam klant<span style="color:#bc2d4c">*</span></label>
                            <input type="text" name="mailname" size="50" value="<?= $upload['naam']?>">&emsp;&emsp;

                            <label>E-mailadres klant<span style="color:#bc2d4c">*</span></label>
                            <input type="email" name="mailto" size="50" value="<?= $upload['email']?>">

                            <input type="hidden" name="frommail" id="MailFrom" value="<?= $upload['onderwerp']?>">
                            <br><br>

                            <input type="submit" name="submit" size="50" value="submit mail">
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>