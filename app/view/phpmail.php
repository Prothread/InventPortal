<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 29-Sep-16
 * Time: 13:15
 */

?>
<div id="Mail">
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="NameText">Uploaden</p>
                        <hr size="1">

                        <form class="UploadForm" action="?page=uploading" method="post" enctype="multipart/form-data">
                            <label>Onderwerp<span style="color:#bc2d4c">*</span></label>
                            <input required type="text" name="title" size="50" value="<?php if( isset($mailinfo['title']) ){echo $mailinfo['title'];}?>">&emsp;&emsp;<br><br>

                            <label>Verstuurder<span style="color:#bc2d4c">*</span>:</label>
                            <label>Testadmin</label>

                            <br><br>
                            <fieldset>
                                <label class="fileContainer">Bestand uploaden*
                                    <input required  type="file" name="myFile[]" id="imgInp" multiple onchange="loadFile(event);">
                                </label>
                                <br>
                                <div class="image-container">
                                <img class="preview" id="preview" width: "100%"; height: "100%"; src="http://i67.tinypic.com/mtxpbl.jpg">
                                </div>
                            </fieldset><br>

                            <label>Beschrijving<span style="color:#bc2d4c">*</span></label>

                            <input required class="TaDescription" name="additionalcontent" size="50" value="<?php if( isset($mailinfo['description']) ){echo $mailinfo['description'];}?>">
                            <br><br>

                            <label>Klant zoeken<span style="color:#bc2d4c">*</label>                             
                            <input type="text" id="tags" name="suggestions" class="suggestionsinput" size="50" value="">
                            <br><br>
                            <a href="index.php?page=newclient"><div id="NewClientButton">Nieuwe klant</div></a>
                            <br><br>

                            <div id="suggestions">
                                Klantensuggesties voor <span class="searchterm"></span>...
                            </div>
                            <br>

                            <input type="hidden" name="frommail" id="MailFrom" value="<?php if( isset($mailinfo['title']) ){ echo $mailinfo['email'];}?>">
                            <input type="hidden" name="mailto" id="" value="valckxj@outlook.com">
                            <input type="hidden" name="fromname" id="" value="Gijs van den Abeele">
                            <input type="hidden" name="mailname" id="" value="Jeffrey">
                            <br>

                            <input type="submit" name="submit" size="50" value="Versturen">
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

