<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 21-2-2017
 * Time: 15:39
 */

$header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                    <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                        <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                    </div>
                </div> ';
$content = $header . "  <br/><br/>" . "Geachte " . $usrname . "," .
    " <br/><br/>" . $clntname . " heeft uw proef <b>" . $_SESSION['verifytext'] . "</b>." . "<br /><br />" .
    "<b>Onderwerp van uw proef: </b>" .
    $_POST['title'] .

    "<br /><br />" . "U kunt uw proef " . "<a href='$link'>hier</a> " . "bekijken." .

    "<br /> <br />Met vriendelijke groet, <br />" . $clntname .
    "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";

$altcontent = "Geachte " . $usrname . "," .
    " <br/><br/>" . $clntname . " heeft uw proef " . $_SESSION['verifytext'] . "." . "<br /><br />" .
    "<b>Onderwerp van uw proef: </b>" .
    $_POST['title'] .

    "<br /><br />" . "U kunt uw proef " . "hier: $link " . "bekijken." .

    "<br /> <br />Met vriendelijke groet, <br />" . $clntname .
    "<br /> <br />Disclaimer: This is an automatically generated mail. Please do not reply to this email";
