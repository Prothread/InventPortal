<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 29-Sep-16
 * Time: 12:47
 */

$uploads = new BlockController();
$uploads->getLastThreeUploads();

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
            Klantnaam
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

    <?php foreach($uploads->getLastThreeUploads() as $upload) {?>
        <tr>
            <td>
                <?= $upload['onderwerp']?>
            </td>
            <td>
                <?= $upload['verstuurder']?>
            </td>
            <td>
                <?= $upload['naam']?>
            </td>
            <td>
                <?= date("d-m-Y", strtotime($upload['datum']));?>
            </td>
            <td>
                <?= $upload['verified']?>
            </td>
        </tr>
    <?php }?>

    </tbody>
</table>