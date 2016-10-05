<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 08:52
 */

$uploads = new BlockController();
$uploads->getUploads();
//var_dump($uploads->getUploads());

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

        <?php foreach($uploads->getUploads() as $upload) {?>
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
