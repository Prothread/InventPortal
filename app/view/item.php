
<?php
$uploads = new BlockController();
$id = $_GET['id'];
$upload = $uploads->getUploadById($id);
$imgarray = ( explode(", ", $upload['uniquename']) );
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
                            

                            <?php foreach($imgarray as $myimg) { ?>
                            <img width=400px; height=400px; src="<?= DIR_IMAGE.$myimg?>"/>
                            <?php } ?>


                            <br><br>
                            <fieldset>
                                <label class="fileContainer">Bestand uploaden*
                                    <input type="file" name="myFile[]" id="imgInp" multiple onchange="loadFile(event);">
                                </label>
                                <br>
                                <img class="preview" id="preview" alt="">
                            </fieldset><br>
                            
                            <label>Beschrijving<span style="color:#bc2d4c">*</span></label><br>

                            <input class="TaDescription" name="additionalcontent" value="<?= $upload['beschrijving']?>">
                            <br><br>

                            <label>Klant zoeken</label>
                            <input type="text" id="tags" name="suggestions" class="suggestionsinput" size="50" value="">
                            <br><br>

                            <div id="suggestions">
                                Klantensuggesties voor <span class="searchterm"></span>...
                            </div>
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