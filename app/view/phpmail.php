<?php
#UPLOAD PAGE

if($user->getPermission($permgroup, 'CAN_UPLOAD') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}
?>
<div id="Mail">
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="NameText">Uploaden</p>
                    <hr size="1">

                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Informatie">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Uploaden">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Beschrijving">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab" title="Klant & Versturen">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <form class="UploadForm" action="?page=uploading" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="well" style="font-size: 15px; font-style: italic;">Vul hieronder het onderwerp van de proef in en controleer of uw naam juist is. </div>
                                    <br>
                                    <label>Onderwerp<span style="color:#bc2d4c">*</span></label>
                                    <input maxlength="50" required type="text" name="title" size="50" value="<?php if( isset($mailinfo['title']) ){echo $mailinfo['title'];}?>">&emsp;&emsp;<br><br>
                                    <label>Verstuurder<span style="color:#bc2d4c">*</span>:</label>
                                    <label>Testadmin</label>
                                    <br><br>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Volgende</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="well" style="font-size: 15px; font-style: italic;">Upload hieronder de bestanden die met de proef meegestuurd moeten worden. </div>
                                    <br>
                                    <fieldset>
                                        <label class="fileContainer">Bestand uploaden*
                                            <input required type="file" name="myFile[]" id="imgInp" multiple>
                                        </label>
                                        <br>

                                        <br/>Selected files:
                                        <div id="fileList"></div>

                                        <output id="list"></output>

                                    </fieldset><br>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Volgende</button></li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="well" style="font-size: 15px; font-style: italic;">Vul hieronder een beschrijving of eventuele extra informatie in. </div>
                                    <br>
                                    <label>Beschrijving<span style="color:#bc2d4c">*</span></label>
                                    <input maxlength="500" required class="TaDescriptionActive" name="additionalcontent" size="50" value="<?php if( isset($mailinfo['description']) ){echo $mailinfo['description'];}?>">
                                    <br><br>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Volgende</button></li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="well" style="font-size: 15px; font-style: italic;">Zoek hieronder de klant waar de proef naar moet worden verstuurd of maak een nieuwe klant aan. </div>
                                    <br>
                                    <a href="index.php?page=newclient"><div id="NewClientButton">Nieuwe klant</div></a>
                                    <br>
                                    <label>Klant zoeken<span style="color:#bc2d4c">*</label>
                                    <input type="text" id="tags" name="suggestions" class="suggestionsinput" size="50" value="">
                                    <br><br>
                                    <div id="suggestions">
                                        Klantensuggesties voor <span class="searchterm"></span>...
                                    </div>
                                    <br>
                                    <input type="submit" name="submit" size="50" value="Versturen">
                                </div>

                                <input type="hidden" name="frommail" id="MailFrom" value="<?php if( isset($mailinfo['title']) ){ echo $mailinfo['email'];}?>">
                                <input type="hidden" name="mailto" id="" value="valckxj@outlook.com">
                                <input type="hidden" name="fromname" id="" value="Gijs van den Abeele">
                                <input type="hidden" name="mailname" id="" value="Jeffrey">
                                <br>
                                <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

