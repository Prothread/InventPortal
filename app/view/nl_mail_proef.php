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

$content = $header . "  <br/><br/>" . "Geachte " . $name . "," .
    " <br/><br/>" . "Wij hebben voor U een digitale proefdruk gemaakt. <br /> Dit is te zien in het <b>Klantenportaal</b>." . "<br /><br />" .
    "<b>" . "Onderwerp: " . "</b>" .
    $title . "<br />" .

    "<b>" . "Beschrijving: " . "</b> " .
    $description .

    "<br /><br />" . "U kunt uw proef met de onderstaand link bekijken, accorderen of wijzigen" . "<br />" .
    "<a href='$link'>$title</a> " . "<br /><br />" .

    printImages($unique_names, $link, $admin['Host']) . "<br />" .

    "<br /> <br />" . "Met vriendelijke groet," . "<br />" . $sender . " </br>Madalco Media" .
    "<br /> <br /><b>Disclaimer: " . "Dit is een automatish aangemaakte email. Reageer hier a.u.b niet op" . "</b> ";

$altcontent = "Geachte " . $name . "," .
    " <br/><br/>" . "Wij hebben voor U een digitale proefdruk gemaakt. <br /> Dit is te zien in het <b>Klantenportaal</b>." . "<br /><br />" .
    "<b>" . "Onderwerp" . "</b> " .
    $title . "<br />" .

    "<b>" . "Beschrijving" . "</b> " .
    $description .

    "<br /><br />" . "U kunt uw proef met de onderstaand link bekijken, accorderen of wijzigen" . "<br />" .
    "<a href='$link'>$title</a> " . "<br /><br />" .

    "<br /> <br />" . "Met vriendelijke groet," . "<br />" . $sender . " </br>Madalco Media" .
    "<br /> <br /><b>Disclaimer:</b>" . "Dit is een automatish aangemaakte email. Reageer hier a.u.b niet op";