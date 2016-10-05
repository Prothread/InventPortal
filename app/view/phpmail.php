<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 29-Sep-16
 * Time: 13:15
 */

?>
    <div id="Mail">
        <form action="?page=uploading" method="post" enctype="multipart/form-data">



                <!-- Page Content -->
                <div id="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="NameText">Uploaden</p>
                                <hr size="1">
                                <form class="UploadForm" action="#">
                                    <label>Onderwerp<span style="color:#bc2d4c">*</span></label>
                                    <input type="text" name="title" size="50" value="<?php if( isset($mailinfo['title']) ){echo $mailinfo['title'];}?>">&emsp;&emsp;
                                    <label>Verstuurder<span style="color:#bc2d4c">*</span></label>
                                    <input type="text" name="fromname" size="35" value="<?php if( isset($mailinfo['sender']) ){echo $mailinfo['sender'];}?>">>
                                    <br><br>
                                    <fieldset>
                                        <label class="fileContainer">Bestand uploaden*
                                            <input type="file" name="myFile[]" id="imgInp" multiple onchange="loadFile(event);">
                                        </label>
                                        <br>
                                        <img class="preview" id="preview" alt="">
                                    </fieldset><br>
                                    <label>Beschrijving<span style="color:#bc2d4c">*</span></label><br>
                                </form>
                                <input class="TaDescription" name="additionalcontent" value="<?php if( isset($mailinfo['description']) ){echo $mailinfo['description'];}?>">
                                </input><br><br>
                                    <label>Klant zoeken</label>
                                    <input type="text" id="tags" name="suggestions" class="suggestionsinput" size="50" value="">
                                    <br><br>
                                    <div id="suggestions">
                                        Klantensuggesties voor <span class="searchterm"></span>...
                                    </div>
                                    <br><br>
                                    <label>Naam klant<span style="color:#bc2d4c">*</span></label>
                                    <input type="text" name="mailname" size="50" value="<?php if( isset($mailinfo['name']) ){echo $mailinfo['name'];}?>">&emsp;&emsp;
                                    <label>E-mailadres klant<span style="color:#bc2d4c">*</span></label>
                                    <input type="email" name="mailto" size="50" value="<?php if( isset($mailinfo['email']) ){echo $mailinfo['email'];}?>">
                                    <br>
                                    <br>
                                    <input type="submit" name="submit" size="50" value="submit mail">
                                    <br>
                                    <!-- <span>Zender e-mail: </span> -->
                                    <input type="hidden" name="frommail" id="MailFrom" value="<?php if( isset($mailinfo['title']) ){ echo $mailinfo['email'];}?>">
                            </div>
                        </div>
                    </div>
                </div>



            <span>Zender: </span>
            <input type="text" name="fromname" id="MailFromName" value="<?php if( isset($mailinfo['sender']) ){echo $mailinfo['sender'];}?>">

            <!-- <span>Zender e-mail: </span> -->
            <input type="hidden" name="frommail" id="MailFrom" value="<?php if( isset($mailinfo['title']) ){ echo $mailinfo['email'];}?>">

            <span>Title: </span>
            <input type="text" name="title" id="MailTitle" value="<?php if( isset($mailinfo['title']) ){echo $mailinfo['title'];}?>">

            <span>Extra omschrijving (opmerkingen): </span>
            <input type="text" name="additionalcontent" id="MailContent" value="<?php if( isset($mailinfo['description']) ){echo $mailinfo['description'];}?>">

            <span>Naam ontvanger: </span>
            <input type="text" name="mailname" id="MailName" value="<?php if( isset($mailinfo['name']) ){echo $mailinfo['name'];}?>">

            <span>Email ontvanger: </span>
            <input type="email" name="mailto" id="MailTo" value="<?php if( isset($mailinfo['email']) ){echo $mailinfo['email'];}?>">

            <input type="hidden" name="verified" value="0">

            <input type="file" name="myFile[]" id="myFile" multiple>

            <input type="submit" value="Submit mail" name="submit">
        </form>
    </div>

