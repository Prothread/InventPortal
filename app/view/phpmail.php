<?php
#UPLOAD PAGE

if($user->getPermission($permgroup, 'CAN_UPLOAD') == 1){

}
else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}
$user = new UserController();
$userinfo = $user->getUserById($_SESSION['usr_id']);
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
                                            <input required class="form-control input-md" maxlength="32" id="textinput" type="text" name="title" size="50" placeholder="<?php if( isset($mailinfo['title']) ){echo $mailinfo['title'];}?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">Verstuurder<span style="color:#bc2d4c">*</span></label>
                                        <div class="col-md-4">
                                            <input required class="form-control input-md" maxlength="32" id="textinput" type="text" name="fromname" value="<?= $userinfo['naam'] ?>" readonly>
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

                                        <?php if($user->getPermission($permgroup, 'CAN_ADD_INTERN_COMMENT') == 1){ ?>
                                            <br /><br />
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Interne opmerking:</label>
                                                <div class="col-md-4">
                                                    <textarea class="form-control input-md" maxlength="300" id="textinput" type="text" name="interncomment"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Belangrijkheid opmerking:</label>
                                                <div class="col-md-4">
                                                    <select name="commentgroep">
                                                        <option value="1" style="color:#5a5454">Normale opmerking</option>
                                                        <option value="2" style="color:#9a1734">Let op de volgende punten</option>
                                                        <option value="3" style="color:#dd2c4c">Belangrijke opmerking</option>
                                                        <option value="4" style="color:red">Eis van de klant</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php } ?>

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
                                            <input required class="form-control input-md" maxlength="250" id="textinput" type="text" name="additionalcontent" value="<?php if( isset($mailinfo['description']) ){echo $mailinfo['description'];}?>">
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
                                            <!-- <a href="#newclient"><div id="NewClientButton">Nieuwe klant</div></a> -->
                                            <div id="NewClientButton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Nieuwe Klant</div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="demclients">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Klant zoeken</label>
                                            <div class="col-md-4">
                                                <select id="allclients" style="width:300px;" name="client" required>
                                                    <?php foreach($user->getAllClients() as $klant) { ?>
                                                        <option value="<?= $klant['id']?>"><?= $klant['naam']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <br>

                                    <ul class="list-inline pull-right">
                                        <li><input class="btn btn-primary btn-success" name="submit" style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #bb2c4c" type="submit" value="Versturen"></li>
                                    </ul>

                                    <input type="hidden" name="frommail" id="MailFrom" value="<?php if( isset($mailinfo['title']) ){ echo $mailinfo['email'];}?>">
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


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nieuwe klant</h4>
                </div>
                <div class="modal-body">

                    <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal newclient" id="createclient">

                        <div id="demclients1">
                            <?php
                                if($session->exists('flash')) {
                                    foreach($session->get('flash') as $flash) {
                                        echo "<div class='alert alert_{$flash['type']}'>{$flash['message']}</div>";
                                    }
                                    $session->remove('flash');
                                }
                            ?>
                        </div>

                        <fieldset>

                            <p class="ClientFormText">Namen</p>
                            <hr size="1">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Naam</label>
                                <div class="col-md-4">
                                    <input required class="form-control input-md" id="textinput" type="text" name="name" size="50" placeholder="Naam">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Bedrijfsnaam</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" required type="text" name="companyname" size="50" placeholder="Bedrijfsnaam">
                                </div>
                            </div>

                            <p class="ClientFormText">Contactgegevens</p>
                            <hr size="1">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">E-mail</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" required type="email" name="email" size="50" placeholder="E-mailadres">
                                </div>
                            </div>

                            <br />
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Alt E-mail</label>
                                <div class="col-md-4">
                                    <span style="font-size:15px">Alternatief email voor contact met de klant</span>
                                    <input class="form-control input-md" id="textinput" type="email" name="altmail" size="50" placeholder="E-mailadres">
                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Adres</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" required type="text" name="companyadress" size="50" placeholder="Adres">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Postcode</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" required type="text" name="postcode" size="50" placeholder="Postcode">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Plaats</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" required type="text" name="plaats" size="50" placeholder="Plaats">
                                </div>
                            </div>

                            <input type="hidden" name="rechten" value="1">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"></label>
                                <div class="col-md-4">
                                    <input class="btn btn-primary btn-success" name="submit"  style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c" type="submit" value="Aanmaken">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
    </div>

