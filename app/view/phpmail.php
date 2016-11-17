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


                        <form action="?page=uploading" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="well" style="font-size: 15px; font-style: italic;">Vul hieronder het onderwerp van de proef in en controleer of uw naam juist is. </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">Onderwerp</label>
                                        <div class="col-md-4">
                                            <input required class="form-control input-md" id="textinput" type="text" name="title" size="50" placeholder="<?php if( isset($mailinfo['title']) ){echo $mailinfo['title'];}?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">Verstuurder<span style="color:#bc2d4c">*</span></label>
                                        <div class="col-md-4">
                                            <input required class="form-control input-md" id="textinput" type="text" name="verstuurder" size="50" value="Testadmin" disabled>
                                        </div>
                                    </div>

                                    <br><br>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Volgende</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="well" style="font-size: 15px; font-style: italic;">Upload hieronder de bestanden die met de proef meegestuurd moeten worden. </div>
                                    <br>
                                    <fieldset style="clear:both">
                                        <!--
                                        <label class="fileContainer">Nieuwe Bestand(en) uploaden*
                                            <input type="file" name="myFile[]" id="imgInp" multiple onchange="loadFile(event);">
                                        </label>
                                        -->

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Bestanden uploaden</label>
                                            <div class="col-md-4">
                                                <label for="file-upload" class="custom-file-upload">
                                                    <i class="fa fa-cloud-upload"></i> Uploaden
                                                </label>
                                                <input required type="file" name="myFile[]" class="imgInp" id="file-upload" multiple>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Geselecteerde bestanden:</label>
                                            <div class="col-md-4">
                                                <div id="fileList"></div>

                                                <output id="list"></output>
                                            </div>
                                        </div>

                                        <br>
                                    </fieldset>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Volgende</button></li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="well" style="font-size: 15px; font-style: italic;">Vul hieronder een beschrijving of eventuele extra informatie in. </div>
                                    <br>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">Beschrijving<span style="color:#bc2d4c">*</span></label>
                                        <div class="col-md-4">
                                            <input required class="form-control input-md" id="textinput" type="text" name="additionalcontent" value="<?php if( isset($mailinfo['description']) ){echo $mailinfo['description'];}?>">
                                        </div>
                                    </div>

                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Volgende</button></li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step4">
                                        <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">Nieuwe klant aanmaken</label>  
                                    <div class="col-md-4">
                                    <a href="index.php?page=newclient"><div id="NewClientButton">Nieuwe klant</div></a>
                                    </div>
                                    </div>

                                    <br>

                                    
                                    <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">Klant zoeken</label>  
                                    <div class="col-md-4">
                                    <input class="form-control input-md suggestionsinput" id="tags" type="text" name="suggestions" size="50" placeholder="Zoek een klant..."> 
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-md-4 control-label" for="textinput"></label>  
                                    <div class="col-md-4">
                                     <div id="suggestions">
                                        Klantensuggesties voor <span class="searchterm"></span>...
                                    </div>
                                    </div>
                                    </div>

                                    <br>
                                    <br>


                                    <ul class="list-inline pull-right">
                                        <li><input class="btn btn-primary btn-success" name="submit" style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #bb2c4c" type="submit" value="Versturen"></li>
                                    </ul>

                                    <input type="hidden" name="frommail" id="MailFrom" value="<?php if( isset($mailinfo['title']) ){ echo $mailinfo['email'];}?>">

                                    <input type="hidden" name="mailto" id="" value="valckxj@outlook.com">

                                    <input type="hidden" name="fromname" id="" value="Gijs van den Abeele">
                                    <input type="hidden" name="mailname" id="" value="Jeffrey">
                                    <br>
                                   
                                </div>
                                <br>
                                <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

