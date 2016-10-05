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
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Overzicht</p>
                <hr size="1">
                <input type="text" size="50" id="TableInput" onkeyup="searchTable()" placeholder="Zoek een product...">
                <br>
                <br>
                <table id="overzicht" class="sortable">
                    <tr>
                        <th><span style="color:#bc2d4c">Product</span></th>
                        <th><span style="color:#bc2d4c">Verstuurder</span></th>
                        <th><span style="color:#bc2d4c">Klant</span></th>
                        <th><span style="color:#bc2d4c">Voorbeeld</span></th>
                        <th><span style="color:#bc2d4c">Status</span></th>
                        <th><span style="color:#bc2d4c">Datum & Tijd</span></th>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Flyer Terneuzen</span></a></td>
                        <td>Testadmin</td>
                        <td>Gemeente Terneuzen</td>
                        <td><a href="http://www.zouteneuzen.nl/wp-content/uploads/2016/07/Zoute-neuzen-flyer-voorzijde_digitaal-250x355.jpg"><img src="http://i67.tinypic.com/r6whmt.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i63.tinypic.com/29upx01.png" alt="AfGekeurd" style="width: 50px; height: 50px;"></td>
                        <td>4-10-2016 11:16</td>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Offerte bus</span></a></td>
                        <td>Testadmin</td>
                        <td>Connexxion B.V.</td>
                        <td><a href="http://phnompenh.gov.kh/wp-content/uploads/2015/05/blank.pdf"><img src="http://i65.tinypic.com/250o4u8.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i67.tinypic.com/2qv49k5.png" alt="GoedGekeurd" style="width: 50px; height: 50px;"></td>
                        <td>4-10-2016 10:12</td>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Reclame Asus</span></a></td>
                        <td>Testadmin</td>
                        <td>Asus Technology B.V.</td>
                        <td><a href="http://rog.asus.com/media%5C1464624756388.jpg"><img src="http://i63.tinypic.com/2vkxdna.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i68.tinypic.com/6zsbv8.png" alt="GeUpload" style="width: 50px; height: 50px;"></td>
                        <td>3-10-2016 14:26</td>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Flyer Carwash</span></a></td>
                        <td>Testadmin</td>
                        <td>HandCarWash Waasland</td>
                        <td><a href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Voorbeeld_nl.png/320px-Voorbeeld_nl.png"><img src="http://i63.tinypic.com/2vkxdna.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i67.tinypic.com/2qv49k5.png" alt="GoedGekeurd" style="width: 50px; height: 50px;"></td>
                        <td>3-10-2016 11:26</td>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Verpakking Mondi</span></a></td>
                        <td>Testadmin</td>
                        <td>Mondi</td>
                        <td><a href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Voorbeeld_nl.png/320px-Voorbeeld_nl.png"><img src="http://i67.tinypic.com/r6whmt.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i68.tinypic.com/6zsbv8.png" alt="GeUpload" style="width: 50px; height: 50px;"></td>
                        <td>3-10-2016 12:21</td>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Offerte FD</span></a></td>
                        <td>Testadmin</td>
                        <td>FD B.V.</td>
                        <td><a href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Voorbeeld_nl.png/320px-Voorbeeld_nl.png"><img src="http://i65.tinypic.com/250o4u8.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i68.tinypic.com/6zsbv8.png" alt="GeUpload" style="width: 50px; height: 50px;"></td>
                        <td>3-10-2016 14:26</td>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Offerte Blue Bastard</span></a></td>
                        <td>Testadmin</td>
                        <td>DESPAR</td>
                        <td><a href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Voorbeeld_nl.png/320px-Voorbeeld_nl.png"><img src="http://i65.tinypic.com/250o4u8.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i68.tinypic.com/6zsbv8.png" alt="GeUpload" style="width: 50px; height: 50px;"></td>
                        <td>5-10-2016 11:26</td>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Flyer Sligro</span></a></td>
                        <td>Testadmin</td>
                        <td>Sligro B.V.</td>
                        <td><a href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Voorbeeld_nl.png/320px-Voorbeeld_nl.png"><img src="http://i67.tinypic.com/r6whmt.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i68.tinypic.com/6zsbv8.png" alt="GeUpload" style="width: 50px; height: 50px;"></td>
                        <td>4-10-2016 08:00</td>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Reclame Asus</span></a></td>
                        <td>Testadmin</td>
                        <td>Logo Invent-ICT</td>
                        <td><a href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Voorbeeld_nl.png/320px-Voorbeeld_nl.png"><img src="http://i67.tinypic.com/r6whmt.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i68.tinypic.com/6zsbv8.png" alt="GeUpload" style="width: 50px; height: 50px;"></td>
                        <td>5-10-2016 14:21</td>
                    </tr>
                    <tr>
                        <td><a href="#"><span style="color:#bc2d4c">Poster Sony</span></a></td>
                        <td>Testadmin</td>
                        <td>Sony Electronics</td>
                        <td><a href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Voorbeeld_nl.png/320px-Voorbeeld_nl.png"><img src="http://i63.tinypic.com/2vkxdna.png" style="width: 30px; height: 40px;"></a></td>
                        <td><img src="http://i68.tinypic.com/6zsbv8.png" alt="GeUpload" style="width: 50px; height: 50px;"></td>
                        <td>3-10-2016 14:26</td>
                    </tr>
                </table>
                <hr size="1">
            </div>
        </div>
    </div>
</div>
</div>
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

