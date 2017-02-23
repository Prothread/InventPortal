<?php
/**
 * Created by PhpStorm.
 * User: Pjotr
 * Date: 21-2-2017
 * Time: 13:40
 */

$header = ' <div style="background: ' . $admin['Header'] . '; position:relative; width: 100%; height: 130px;">
                        <div style="position: absolute; height: 130px; margin-right: 25px; left: 5px;">
                            <img src="cid:HeaderImage" style="width:auto;height:75%;" />
                        </div>
                    </div> ';

$content = $header . "  <br/><br/>" . "Dear " . $name . "," .
    " <br/><br/>" . "We made a digital sample for you <br /> You can inspect this in the <b>clientportal</b>." . "<br /><br />" .
    "<b>" . "Title: " . "</b>" .
    $title . "<br />" .

    "<b>" . "Description: " . "</b> " .
    $description .

    "<br /><br />" . "You can inspect, accord or edit the assignment with the link below" . "<br />" .
    "<a href='$link'>$title</a> " . "<br /><br />" .

    printImages($unique_names, $link, $admin['Host']) . "<br />" .

    "<br /> <br />" . "With kind regards," . "<br />" . $sender . " </br>Madalco Media" .
    "<br /> <br /><b>Disclaimer: " . "This is an automatically generated mail. Please do not reply to this email" . "</b> ";

$altcontent = "Dear " . $name . "," .
    " <br/><br/>" . "We made a digital sample for you <br /> You can inspect this in the <b>clientportal</b>." . "<br /><br />" .
    "<b>" . "Title" . "</b> " .
    $title . "<br />" .

    "<b>" . "Description" . "</b> " .
    $description .

    "<br /><br />" . "You can inspect, accord or eddit the assignment whith the link below" . "<br />" .
    "<a href='$link'>$title</a> " . "<br /><br />" .

    "<br /> <br />" . "With kind regards," . "<br />" . $sender . " </br>Madalco Media" .
    "<br /> <br /><b>Disclaimer:</b>" . "This is an automatically generated mail. Please do not reply to this email";