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
                <p class="NameText">Instellingen</p>
                <hr size="1">
                    <form class="MailSettings" action="#" method="post" enctype="multipart/form-data">
                        <label>SMTP-adres<span style="color:#bc2d4c">*</span></label>
                        <input required type="text" name="title" size="50" value="smtp.madalcomedia.nl">&emsp;&emsp;<br><br>
                        <label>E-mailadres ontvangen<span style="color:#bc2d4c">*</span></label>
                        <input required type="text" name="title" size="50" value="proeven@madalcomedia.nl">&emsp;&emsp;<br><br>
                        <label>E-mailadres versturen<span style="color:#bc2d4c">*</span></label>
                        <input required type="text" name="title" size="50" value="proeven@madalcomedia.nl">&emsp;&emsp;<br><br>
                <hr size="1">
                <p class="NameText">Gebruikers</p>
                <table id="overzicht" class="sortable">
                    <thead>
                    <tr>
                        <th><b>Naam</b></th>
                        <th><b>Rechten</b></th>
                        <th><b>E-mailadres</b></th>
                        <th><b>Edit</b></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            Davy Nielen
                            </td>
                            <td>
                            Admin
                            </td>
                            <td>
                            d.nielen@madalcomedia.nl
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
                            Admin
                            </td>
                            <td>
                            valckxj@outlook.com
                            </td>
                            <td>
                            <a href="#"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                            </td>
                        </tr>

                        <tr>
                            <td>
                            Kevin Ernst
                            </td>
                            <td>
                            Admin
                            </td>
                            <td>
                            kevin.herdershof@hotmail.com
                            </td>
                            <td>
                            <a href="#"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                            </td>
                        </tr>

                                                <tr>
                            <td>
                            Gijs van den Abeele
                            </td>
                            <td>
                            Admin
                            </td>
                            <td>
                            gijsvdabeele@gmail.com
                            </td>
                            <td>
                            <a href="#"><img src="http://i65.tinypic.com/14l68f4.png" style="width: 24px; height: 24px;">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr size="1">
                <p class="NameText">Klanten beheren</p>
                <a href="index.php?page=manageclients"><div id="KlantbeheerButton">Klantenbeheer</div></a>
            </div>
        </div>
    </div>
</div>
