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

