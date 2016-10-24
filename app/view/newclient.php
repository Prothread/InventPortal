<?php
#PAGE FOR CREATING CLIENTS
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Nieuwe klant</p>
                <hr size="1">
                <br>
                <form class="NewClient" action="?page=clientmail" method="post" enctype="multipart/form-data">
                    <p class="ClientFormText">Namen</p>
                    <hr size="1">
                    <label>Weergavenaam<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="name" size="50"><br><br>

                    <label>Bedrijfsnaam<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="companyname" size="50"><br><br>

                    <p class="ClientFormText">Contactgegevens</p>
                    <hr size="1">
                    <label>E-mailadres<span style="color:#bc2d4c">*</span></label>
                    <input required type="email" name="email" size="50" placeholder="voorbeeld@voorbeeld.nl"><br><br>

                    <label>Bedrijfsadres<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="companyadress" size="50"><br><br>

                    <label>Postcode<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="postcode" size="8"><br><br>

                    <label>Plaats<span style="color:#bc2d4c">*</span></label>
                    <input required type="text" name="plaats" size="50"><br><br>

                    <br><br>
                    <input type="submit" name="submit" size="50" value="Versturen">
                </form
            </div>
        </div>
    </div>
</div>
