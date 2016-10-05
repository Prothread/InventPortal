<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 12:43
 */

$upload = new BlockController();
//$myupload = $upload->getUploadById($_SESSION['id']);
$myupload = $upload->getUploadById(13);

$imgarray = ( explode(", ", $myupload['imgname']) );

?>

<table>
    <thead>
    <tr>
        <td>
            Onderwerp
        </td>

        <td>
            Verstuurder
        </td>

        <td>
            Beschrijving
        </td>

        <td>
            Klantnaam
        </td>

        <td>
            E-mail
        </td>

        <td>
            Images
        </td>

        <td>
            Datum
        </td>

        <td>
            Status
        </td>
    </tr>
    </thead>
    <tbody>

        <tr>
            <td>
                <?= $myupload['onderwerp']?>
            </td>

            <td>
                <?= $myupload['verstuurder']?>
            </td>

            <td>
                <?= $myupload['beschrijving'] ?>
            </td>

            <td>
                <?= $myupload['naam']?>
            </td>

            <td>
                <?= $myupload['email']?>
            </td>

            <td>
                <?php
                    foreach ($imgarray as $img) {?>
                        <img width="400px" src="<?= DIR_IMAGE.$img?>" />
                    <?php }
                ?>
            </td>

            <td>
                <?= date("d-m-Y", strtotime($myupload['datum']));?>
            </td>

            <td>
                <?= $myupload['verified']?>
            </td>
        </tr>

    </tbody>
</table>
