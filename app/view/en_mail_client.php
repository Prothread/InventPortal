<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 21-2-2017
 * Time: 15:14
 */

$subject = "User information Madalco-portaal";

$header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                        <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                            <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                        </div>
                    </div> ';
$content = $header . "  <br/><br/>" . "Dear " . $_POST['companyname'] . "," .

    " <br/><br/>" . $myuser . " has made the user: <b> " . $_POST['name'] . "</b> " . " for you , below is your user information:<br /><br />" .
    "<b>E-mailadres: </b>" .
    $_POST['email'] . '<br/>' .

    "<b>Password: </b>" .
    $token .

    "<br /><br />" . "You can change your password " . "<a href='$link'>here</a> " .

    "<br /><br />With kind regards, <br />" . "Madalco Media" .
    "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";

$altcontent = " Dear " . $_POST['companyname'] . "," .

    " <br/><br/>" . $myuser . " has made the user: <b> " . $_POST['name'] . "</b> " . " for you , below is your user information:<br /><br />" .
    "<b>E-mailadres: </b>" .
    $_POST['email'] . '<br/>' .

    "<b>Password: </b>" .
    $token .

    "<br /><br />" . "You can change your password " . "<a href='$link'>here</a> " .

    "<br /><br />With kind regards, <br />" . "Madalco Media" .
    "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";
