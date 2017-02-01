<?php
#UPLOAD PAGE

if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
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
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                       title="Uploaden">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                       title="Beschrijving">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="complete" role="tab"
                                       title="Klant & Versturen">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <form action="?page=lala" method="post" enctype="multipart/form-data" class="form-horizontal dropzone" id="mydropzone">
                            <div class="tab-content">

                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="well" style="font-size: 15px; font-style: italic;">Upload hieronder de
                                        bestanden die met de proef meegestuurd moeten worden.
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">Onderwerp</label>
                                        <div class="col-md-4">
                                            <input required class="form-control input-md" maxlength="32" id="textinput" type="text" name="title" size="50" placeholder="<?php if (isset($mailinfo['title'])) { echo $mailinfo['title']; } ?>">
                                        </div>
                                    </div>

                                    <br>
                                    <fieldset style="clear:both">
                                        <!--
                                        <label class="fileContainer">Nieuwe Bestand(en) uploaden*
                                            <input type="file" name="myFile[]" id="imgInp" multiple onchange="loadFile(event);">
                                        </label>
                                        -->

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Bestanden
                                                uploaden</label>
                                            <div class="col-md-4">
                                                <div class="dz-default dz-message">
                                                    <span>
                                                        <label class="custom-file-upload">
                                                            <i class="fa fa-cloud-upload"></i> Uploaden
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Geselecteerde
                                                bestanden:</label>
                                            <div class="col-md-4">
                                                <div id="dropzonePreview"></div>
                                            </div>
                                        </div>

                                        <br>
                                    </fieldset>

                                    <ul class="list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-primary next-step">Volgende</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="well" style="font-size: 15px; font-style: italic;">Vul hieronder een
                                        beschrijving of eventuele extra informatie in.
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">Beschrijving<span
                                                style="color:#bc2d4c">*</span></label>
                                        <div class="col-md-4">
                                            <input required class="form-control input-md" maxlength="250" id="textinput"
                                                   type="text" name="additionalcontent"
                                                   value="<?php if (isset($mailinfo['description'])) {
                                                       echo $mailinfo['description'];
                                                   } ?>">
                                        </div>
                                    </div>

                                    <?php if ($user->getPermission($permgroup, 'CAN_ADD_INTERN_COMMENT') == 1) { ?>
                                        <br/><br/>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Interne
                                                opmerking:</label>
                                            <div class="col-md-4">
                                                    <textarea class="form-control input-md" maxlength="300"
                                                              id="textinput" type="text"
                                                              name="interncomment"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Belangrijkheid
                                                opmerking:</label>
                                            <div class="col-md-4">
                                                <select name="commentgroep">
                                                    <option value="1" style="color:#5a5454">Normale opmerking
                                                    </option>
                                                    <option value="2" style="color:#9a1734">Let op de volgende
                                                        punten
                                                    </option>
                                                    <option value="3" style="color:#dd2c4c">Belangrijke opmerking
                                                    </option>
                                                    <option value="4" style="color:#ff0000">Eis van de klant
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <ul class="list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-primary next-step">Volgende</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <?php if($user->getPermission($permgroup, 'CAN_CREATE_CLIENT') == '1') {?>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Nieuwe klant
                                                aanmaken</label>
                                            <div class="col-md-4">
                                                <!-- <a href="#newclient"><div id="NewClientButton">Nieuwe klant</div></a> -->
                                                <div id="NewClientButton" type="button" class="btn btn-info btn-lg"
                                                     data-toggle="modal" data-target="#myModal">Nieuwe Klant
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <br>

                                    <div class="demclients">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Klant zoeken</label>
                                            <div class="col-md-4">
                                                <select id="allclients" style="width:100%" name="client" required>
                                                    <option></option>
                                                    <?php foreach ($user->getAllLatestClients() as $klant) { ?>
                                                        <option value="<?= $klant['id'] ?>"><?php if($klant['bedrijfsnaam']){ echo $klant['bedrijfsnaam'] . '  -  '; } echo $klant['naam'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <br>

                                    <ul class="list-inline pull-right">
                                        <li>
                                            <button type="submit" id="sbmtbtn">Versturen</button>
                                        </li>
                                    </ul>

                                    <input type="hidden" name="frommail" id="MailFrom"
                                           value="<?php if (isset($mailinfo['title'])) {
                                               echo $mailinfo['email'];
                                           } ?>">
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

                    <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal newclient"
                          id="createclient">

                        <div class="demclients1">
                            <?php
                            if ($session->exists('flash')) {
                                foreach ($session->get('flash') as $flash) {
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
                                <label class="col-md-4 control-label" for="textinput">Naam<span
                                        style="color:#dd2c4c">*</span></label>
                                <div class="col-md-4">
                                    <input required class="form-control input-md" id="textinput" type="text" name="name"
                                           size="50" placeholder="Naam">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Bedrijfsnaam</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" type="text"
                                           name="companyname" size="50" placeholder="Bedrijfsnaam">
                                </div>
                            </div>

                            <p class="ClientFormText">Contactgegevens</p>
                            <hr size="1">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">E-mail<span
                                        style="color:#dd2c4c">*</span></label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" required type="email"
                                           name="email" size="50" placeholder="E-mailadres">
                                </div>
                            </div>

                            <br/>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Alt E-mail</label>
                                <div class="col-md-4">
                                    <span style="font-size:15px">Alternatief email voor contact met de klant</span>
                                    <input class="form-control input-md" id="textinput" type="email" name="altmail"
                                           size="50" placeholder="E-mailadres">
                                </div>
                            </div>
                            <br/>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Adres</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" type="text"
                                           name="companyadress" size="50" placeholder="Adres">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Postcode</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" type="text"
                                           name="postcode" size="50" placeholder="Postcode">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Plaats</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" type="text"
                                           name="plaats" size="50" placeholder="Plaats">
                                </div>
                            </div>

                            <input type="hidden" name="rechten" value="1">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"></label>
                                <div class="col-md-4">
                                    <input class="btn btn-primary btn-success" name="submit"
                                           style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c"
                                           type="submit" value="Aanmaken">
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

    <script>

        var postForm = [];
        var Files = '';

        Dropzone.options.mydropzone = {
            addRemoveLinks: true,
            autoProcessQueue: false, // this is important as you dont want form to be submitted unless you have clicked the submit button
            autoDiscover: false,
            paramName: 'file', // this is optional Like this one will get accessed in php by writing $_FILE['pic'] // if you dont specify it then bydefault it taked 'file' as paramName eg: $_FILE['file']
            previewsContainer: '#dropzonePreview', // we specify on which div id we must show the files
            maxFilesize: 10, // MB
            acceptedFiles: "image/png, image/jpeg, image/gif, application/pdf",
            accept: function(file, done) {
                console.log("uploaded");
                done();
            },
            error: function(file, msg){
                alert(msg);
            },
            init: function() {

                this.on("sending", function(file, xhr, formData) {
                    // Will send the filesize along with the file as POST data.
                    //Files.push(file.name);
                    file.myCustomName = <?= $dbmail->getIncrement() ?> + '_' + file.name;
                });

                this.on("queuecomplete", function () {
                    this.options.autoProcessQueue = false;

                    /* Files = <?php echo implode(",", $_SESSION['unique_names']) ?>; */

                    //window.location = 'index.php?page=lala1';
                    postForm += Files;
                    alert(postForm);

                    $.ajax({
                        type: "POST",
                        url: "?page=lala1",
                        data: postForm,
                        cache: false,
                        success: function (result) {
                            window.location.href = 'index.php?page=overview';
                        }
                    });
                    event.preventDefault();
                });

                this.on("processing", function () {
                    this.options.autoProcessQueue = true;
                });

                this.on("error", function(file, message) {
                    alert(message);
                    this.removeFile(file);
                });

                var myDropzone = this;
                //now we will submit the form when the button is clicked
                $("#sbmtbtn").on('click',function(e) {
                    e.preventDefault();
                    myDropzone.processQueue(); // this will submit your form to the specified action path
                    postForm = $('form#mydropzone').serialize() + '&files=';
                });

            }, // init end

            success: function( file, response ){
                console.log(response);
            }

        };

    </script>

