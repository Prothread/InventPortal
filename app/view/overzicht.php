<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 08:52
 */

$uploads = new BlockController();
$uploads->getUploads();

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
        <tr>
            <td>
                Get ondewerp
            </td>
            <td>
                Get verstuurder
            </td>
            <td>
                Get klantnaam
            </td>
            <td>
                Get datum
            </td>
            <td>
                Get verified
            </td>
        </tr>
    </tbody>
</table>
