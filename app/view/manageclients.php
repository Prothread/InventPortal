<?php
/**
 * Created by SublimeText.
 * User: Jeffrey
 * Date: 10-Okt-16
 * Time: 09:51
 */
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Klantenbeheer</p>
                <hr size="1">
                <input type="text" size="50" id="TableInput" onkeyup="searchTable()" placeholder="Zoek een klant...">
                <br>
                <br>
                <a href="index.php?page=newclient"><div id="NewClientButton">Nieuwe klant</div></a>
                <table id="overzicht" class="sortable">
                <br><br>
                    <thead>
                    <tr>
                        <th><b>Weergavenaam</b></th>
                        <th><b>Bedrijfsnaam</b></th>
                        <th><b>E-mailadres</b></th>
                        <th><b>Adres</b></th>
                        <th><b>Postcode</b></th>
                        <th><b>Plaats</b></th>
                        <th><b>Edit</b></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            Gianni Ford
                            </td>
                            <td>
                            Ford Cars Limited
                            </td>
                            <td>
                            g.ford@fordcars.com
                            </td>
                            <td>
                            Fordweg 12
                            </td>
                            <td>
                            4521BZ
                            </td>
                            <td>
                            Terneuzen, Nederland
                            </td>    
                            <td>
                            <a href="#"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                            </td>
                        </tr>

                        <tr>
                            <td>
                            Jeffrey Valckx
                            </td>
                            <td>
                            Searchi B.V.
                            </td>
                            <td>
                            info@searchi.com
                            </td>
                            <td>
                            Haarmanweg 12
                            </td>
                            <td>
                            4531BZ
                            </td>
                            <td>
                            Terneuzen, Nederland
                            </td>    
                            <td>
                            <a href="#"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                            </td>
                        </tr>

                        <tr>
                            <td>
                            Elopak
                            </td>
                            <td>
                            Elopak B.V.
                            </td>
                            <td>
                            elo@pak.nl
                            </td>
                            <td>
                            Pakstraat 1-4
                            </td>
                            <td>
                            4574BZ
                            </td>
                            <td>
                            Terneuzen, Nederland
                            </td>    
                            <td>
                            <a href="#"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                            </td>
                        </tr>

                        <tr>
                            <td>
                            ABC
                            </td>
                            <td>
                            ABC B.V.
                            </td>
                            <td>
                            info@abcbv.info
                            </td>
                            <td>
                            Alfabetweg 76
                            </td>
                            <td>
                            4226BZ
                            </td>
                            <td>
                            Terneuzen, Nederland
                            </td>    
                            <td>
                            <a href="#"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                            </td>
                        </tr>

                        <tr>
                            <td>
                            Advertentieblad
                            </td>
                            <td>
                            ZVA
                            </td>
                            <td>
                            druk@zva.nl
                            </td>
                            <td>
                            Papierlaan 54
                            </td>
                            <td>
                            4528BZ
                            </td>
                            <td>
                            Terneuzen, Nederland
                            </td>    
                            <td>
                            <a href="#"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                            </td>
                        </tr>

                        <tr>
                            <td>
                            Carco
                            </td>
                            <td>
                            Carco B.V.
                            </td>
                            <td>
                            wash@carco.be
                            </td>
                            <td>
                            Bremheidelaan 10
                            </td>
                            <td>
                            2300
                            </td>
                            <td>
                            Turnhout, België
                            </td>    
                            <td>
                            <a href="#"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>