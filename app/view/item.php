<?php
#INDIVIDUAL ITEM PAGE

$session = new Session();
$uploads = new BlockController();

$id = $_GET['id'];
$id = $session->clean($id);

//Check verified images
$verimages = array();

$upload = $uploads->getUploadById($id);

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

                        <?php
                        $imgcount = 0;
                        foreach ($uploadedimages as $img) {
                            $imgcount++;
                            ?>
                            <div id="imgakkoord" style="float:left;">
                                <div style="border:0; width: 250px; height: 320px;">
                                    <!--
                                        <img id="myimage" style="pointer-events: none;" height="410" width="300" border="20px solid white" src="<?php echo DIR_IMAGE.$img['images'];?>" />
                                        <div style="position:relative; left: 28px; top: -304px; width:150px;">
                                            <img style="pointer-events: none;z-index:5;" src="css/watermerk.png" width=250 height=200>
                                        </div>
                                        -->

                                    <a href="#img<?= $imgcount ?>">
                                        <div id="thumbnail2" style="background: url('css/proef.png') repeat, url(<?= DIR_IMAGE . $img['images']; ?>) no-repeat; background-size: 45%, cover;
                                            background-position: 0%, 50%;"></div>
                                    </a>
                                </div>
                                <br />

                                <?php
                                if(isset($img['id'])) {

                                    $isverified = $image_controller->getImageVerify($img['id']);

                                    if($isverified['verify'] == 1) { ?>
                                        <div id="akkoord" class="alert alert-success" style="text-align: center;" role="alert"><span class="glyphicon glyphicon-ok-circle"></span> Akkoord</div>
                                    <?php }

                                    if($isverified['verify'] == 2) {?>
                                        <div id="weiger" class="alert alert-danger" style="text-align: center;" role="alert"><span class="glyphicon glyphicon-remove-circle"></span> Geweigerd</div>
                                    <?php }

                                    if($isverified['verify'] == 3) {?>
                                        <div id="weiger" class="alert alert-info" style="background-color:lightgrey; color:grey; text-align: center;" role="alert"><span class="glyphicon glyphicon-remove-circle"></span> Gewijzigd</div>
                                    <?php }

                                    if($isverified['verify'] == 0) {?>
                                        <div id="weiger" class="alert alert-info" style="text-align: center;" role="alert"><span class="glyphicon glyphicon-remove-circle"></span> Niet beoordeeld</div>
                                    <?php }

                                    array_push($verimages, $isverified['verify']);

                                }?>

                            </div>
                            <a href="#_" class="lightbox" id="img<?=$imgcount ?>">
                                <div id="lighter" class="w3-animate-opacity">
                                    <div id="thumbnail2" style=" background: url('css/proef.png') repeat center, url(<?= DIR_IMAGE . $img['images']; ?>) no-repeat center;
                                        background-size: 13%, contain;
                                        max-width: 100%;
                                        height:100%; "></div>
                                </div>
                            </a>
                        <?php }
                        ?>

                        <div style="clear: both;"></div>
                        <?php if(in_array(2, $verimages) || in_array(0, $verimages)) { ?>
                            <label>Onderwerp<span style="color:#bc2d4c">*</span></label>
                            <input type="text" name="title" size="50" value="<?= $upload['onderwerp']?>">&emsp;&emsp;
                            <br>
                            <br>
                            <label>Verstuurder<span style="color:#bc2d4c">*</span></label>
                            <input type="text" name="fromname" size="50" value="<?= $upload['verstuurder']?>">
                        <?php }
                        else { ?>
                            <label>Verstuurder<span style="color:#bc2d4c">*</span></label>
                            <input disabled type="text" name="fromname" size="50" value="<?= $upload['verstuurder']?>">
                            <br>
                            <br>
                            <label>Onderwerp<span style="color:#bc2d4c">*</span></label>
                            <input disabled type="text" name="title" size="50" value="<?= $upload['onderwerp']?>">&emsp;&emsp;
                        <?php } ?>

                        <br>

                        <?php if(in_array(2, $verimages) || in_array(0, $verimages)) { ?>
                            <br>
                            <fieldset style="clear:both">
                                <label class="fileContainer">Nieuwe Bestand(en) uploaden*
                                    <input type="file" name="myFile[]" id="imgInp" multiple onchange="loadFile(event);">
                                </label>
                                <br>
                                <img src="http://i67.tinypic.com/mtxpbl.jpg" class="preview" id="preview" alt="">
                            </fieldset>

                            <label>Beschrijving<span style="color:#bc2d4c">*</span></label>
                            <input class="Description2" size="50" name="additionalcontent" value="<?= $upload['beschrijving']?>">
                            <br><br><br>
                            <label>Naam klant<span style="color:#bc2d4c">*</span></label>
                            <input type="text" name="mailname" size="50" value="<?= $upload['naam']?>">&emsp;&emsp;
                            <br>
                            <br>
                            <label>E-mailadres klant<span style="color:#bc2d4c">*</span></label>
                            <input type="email" name="mailto" size="50" value="<?= $upload['email']?>">

                            <input type="hidden" name="frommail" id="MailFrom" value="<?= $upload['onderwerp']?>">
                            <br><br>

                            <input type="submit" name="submit" size="50" value="Versturen">
                            <br>
                        <?php }
                        else {
                            ?>
                            <div style="clear:both"></div>
                            <br />
                            <label disabled="disabled" style="width:50px;">Beschrijving<span style="color:#bc2d4c">*</span></label>

                            <input disabled="disabled" size="50" class="TaDescription" name="additionalcontent" value="<?= $upload['beschrijving']?>">
                            <br><br>

                            <label>Naam klant<span style="color:#bc2d4c">*</span></label>
                            <input disabled="disabled" type="text" name="mailname" size="50" value="<?= $upload['naam']?>">&emsp;&emsp;
                            <br><br>
                            <label>E-mailadres klant<span style="color:#bc2d4c">*</span></label>
                            <input disabled="disabled" type="email" name="mailto" size="50" value="<?= $upload['email']?>">

                            <input disabled="disabled" type="hidden" name="frommail" id="MailFrom" value="<?= $upload['onderwerp']?>">
                            <br><br>

                            <table>
                                <thead>
                                <td>Downloads:</td>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php foreach($uploadedimages as $img) { ?>
                                        <td style="float:left;margin-right:10px;">
                                            <div class="btn-group">
                                                <button type="button" id="downloadimagedd" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <div class="imagedownload" style="background:url(<?= DIR_IMAGE . $img['images'] ?>); background-size: cover;"> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="index.php?page=download&file=<?= DIR_IMAGE . $img['images']; ?>">Download</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    <?php }?>
                                </tr>
                                </tbody>
                            </table>
                        <?php } ?>
                        <div style="clear:both"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>