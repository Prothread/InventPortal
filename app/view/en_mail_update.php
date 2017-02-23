<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 21-2-2017
 * Time: 15:38
 */

$header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                    <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                        <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                    </div>
                </div> ';
$content = $header . "  <br/><br/>" . "Dear " . $usrname . "," .
    " <br/><br/>" . $clntname . " has <b>" . $_SESSION['verifytext'] . "</b> your assignment." . "<br /><br />" .
    "<b>Title assigment: </b>" .
    $_POST['title'] .

    "<br /><br />" . "You can see your assigment  " . "<a href='$link'>here</a> " .

    "<br /> <br />With kind regards, <br />" . $clntname .
    "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";

$altcontent = "Dear " . $usrname . "," .
    " <br/><br/>" . $clntname . " has <b>" . $_SESSION['verifytext'] . "</b> your assignment." . "<br /><br />" .
    "<b>Title assigment: </b>" .
    $_POST['title'] .

    "<br /><br />" . "You can see your assigment  " . "<a href='$link'>here</a> " .

    "<br /> <br />With kind regards, <br />" . $clntname .
    "<br /> <br /><b>Disclaimer:</b> This is an automatically generated mail. Please do not reply to this email";