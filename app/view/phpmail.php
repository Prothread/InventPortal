<?php
#UPLOAD PAGE

if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}
$user = new UserController();
$userinfo = $user->getUserById($_SESSION['usr_id']);

$dbmail = new DbMail();
$imageId = $dbmail->getIncrement();
?>
<div id="Mail">
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="NameText"><?= TEXT_UPLOAD ?></p>
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


                        <form action="?page=uploadImages" method="post" enctype="multipart/form-data" class="form-horizontal dropzone" id="mydropzone">
                            <div class="tab-content">

                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="well" style="font-size: 15px; font-style: italic;"><?= TEXT_STEP1 ?>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput"><?= TABLE_TITLE ?></label>
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
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_UPLOAD_FILES ?></label>
                                            <div class="col-md-4">
                                                <div class="dz-default dz-message">
                                                    <span>
                                                        <label class="custom-file-upload">
                                                            <i class="fa fa-cloud-upload"></i> <?= BUTTON_UPLOAD ?>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_SELECTED_FILES ?></label>
                                            <div class="col-md-4">
                                                <div id="dropzonePreview"></div>
                                            </div>
                                        </div>

                                        <br>
                                    </fieldset>

                                    <ul class="list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-primary next-step"><?= BUTTON_NEXT ?></button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="well" style="font-size: 15px; font-style: italic;"><?= TEXT_STEP2 ?>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput"><?= TEXT_DESCRIPTION ?><span
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
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_INTERNCOMMENT ?></label>
                                            <div class="col-md-4">
                                                    <textarea class="form-control input-md" maxlength="300"
                                                              id="textinput" type="text"
                                                              name="interncomment"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_INTERNCOMMENTIMPORTANCE ?></label>
                                            <div class="col-md-4">
                                                <select name="commentgroep" class="form-control">
                                                    <option value="1" style="color:#5a5454">
                                                        <?= TEXT_INTERNCOMMENTIMPORTANCE1 ?>
                                                    </option>
                                                    <option value="2" style="color:#9a1734">
                                                        <?= TEXT_INTERNCOMMENTIMPORTANCE2 ?>
                                                    </option>
                                                    <option value="3" style="color:#dd2c4c">
                                                        <?= TEXT_INTERNCOMMENTIMPORTANCE3 ?>
                                                    </option>
                                                    <option value="4" style="color:#ff0000">
                                                        <?= TEXT_INTERNCOMMENTIMPORTANCE4 ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <ul class="list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-primary next-step"><?= BUTTON_NEXT ?></button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <?php if($user->getPermission($permgroup, 'CAN_CREATE_CLIENT') == '1') {?>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_NEWCLIENT ?></label>
                                            <div class="col-md-4">
                                                <!-- <a href="#newclient"><div id="NewClientButton">Nieuwe klant</div></a> -->
                                                <div id="NewClientButton" type="button" class="btn btn-info btn-lg"
                                                     data-toggle="modal" data-target="#myModal"><?= BUTTON_NEWCLIENT ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <br>

                                    <div class="demclients">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_SEARCH_CLIENT ?></label>
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
                                            <button type="submit" id="sbmtbtn" class="btn btn-primary"><?= BUTTON_SEND ?></button>
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
                    <h4 class="modal-title"><?= TEXT_NEWCLIENT ?></h4>
                </div>
                <div class="modal-body">

                    <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="createclient">

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

                            <p class="ClientFormText"><?= TEXT_NAMES ?></p>
                            <hr size="1">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_NAME ?><span
                                        style="color:#dd2c4c">*</span></label>
                                <div class="col-md-4">
                                    <input required class="form-control input-md" id="textinput" type="text" name="name"
                                           size="50" placeholder="<?= TEXT_NAME ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_COMPANY_NAME ?></label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" type="text"
                                           name="companyname" size="50" placeholder="<?= TEXT_COMPANY_NAME ?>">
                                </div>
                            </div>

                            <p class="ClientFormText"><?= TEXT_CONTACT_DETAILS ?></p>
                            <hr size="1">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_EMAIL ?><span
                                        style="color:#dd2c4c">*</span></label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" required type="email"
                                           name="email" size="50" placeholder="<?= TEXT_EMAIL ?>">
                                </div>
                            </div>

                            <br/>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_ALTERNATIVE_EMAIL ?></label>
                                <div class="col-md-4">
                                    <span style="font-size:15px"><?= TEXT_ALTERNATIVE_EMAIL_INFO ?></span>
                                    <input class="form-control input-md" id="textinput" type="email" name="altmail"
                                           size="50" placeholder="<?= TEXT_EMAIL ?>">
                                </div>
                            </div>
                            <br/>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_ADRESS ?></label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" type="text"
                                           name="companyadress" size="50" placeholder="<?= TEXT_ADRESS ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_POSTALCODE ?></label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" type="text"
                                           name="postcode" size="50" placeholder="<?= TEXT_POSTALCODE ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_CITY ?></label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="textinput" type="text"
                                           name="plaats" size="50" placeholder="<?= TEXT_CITY ?>">
                                </div>
                            </div>

                            <input type="hidden" name="rechten" value="1">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"></label>
                                <div class="col-md-4">
                                    <input class="btn btn-primary " name="submit" style="width: auto" type="submit" value="<?= TEXT_NEWCLIENT ?>">
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
        var Files = [];

        Dropzone.options.mydropzone = {
            addRemoveLinks: true,
            autoProcessQueue: false, // this is important as you dont want form to be submitted unless you have clicked the submit button
            autoDiscover: false,
            paramName: 'file', // this is optional Like this one will get accessed in php by writing $_FILE['pic'] // if you dont specify it then bydefault it taked 'file' as paramName eg: $_FILE['file']
            previewsContainer: '#dropzonePreview', // we specify on which div id we must show the files
            maxFilesize: 10, // MB
            acceptedFiles: "image/png, image/jpeg, image/gif, application/pdf",
            accept: function(file, done) {
                done();
            },
            error: function(file, msg){
                alert(msg);
            },
            init: function() {

                this.on("queuecomplete", function () {
                    this.options.autoProcessQueue = false;
                    //window.location = 'index.php?page=uploadForm';
                    postForm += (Files.join(", "));

                    alert(postForm);

                    $.ajax({
                        type: "POST",
                        url: "?page=uploadForm",
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
                Files.push(response);
            }

        };

    </script>

