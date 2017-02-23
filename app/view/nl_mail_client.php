<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 21-2-2017
 * Time: 15:14
 */

$subject = "Accountgegevens Madalco-portaal";

$header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                        <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                            <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                        </div>
                    </div> ';
$content = $header . "  <br/><br/>" . "Geachte " . $_POST['companyname'] . "," .

    " <br/><br/>" . $myuser . " heeft voor u het account <b> " . $_POST['name'] . "</b> " . " aangemaakt, hieronder uw gegevens:<br /><br />" .
    "<b>E-mailadres: </b>" .
    $_POST['email'] . '<br/>' .

    "<b>Wachtwoord: </b>" .
    $token .

    "<br /><br />" . "U kunt " . "<a href='$link'>hier</a> " . "uw wachtwoord veranderen." .

    "<br /><br />Met vriendelijke groet, <br />" . "Madalco Media" .
    "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";

$altcontent = "Geachte " . $_POST['companyname'] . "," .

    " <br/><br/>" . $myuser . " heeft voor u het account <b> " . $_POST['name'] . "</b> " . " aangemaakt, hieronder uw gegevens:<br /><br />" .
    "<b>E-mailadres: </b>" .
    $_POST['email'] . '<br/>' .

    "<b>Wachtwoord: </b>" .
    $token .

    "<br /><br />" . "U kunt " . "<a href='$link'>hier</a> " . "uw wachtwoord veranderen." .

    "<br /><br />Met vriendelijke groet, <br />" . "Madalco Media" .
    "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";
