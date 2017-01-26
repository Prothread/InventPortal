<?php
#UPLOAD PAGE

if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}
$user = new UserController();
$userinfo = $user->getUserById($_SESSION['usr_id']);
?>
<div id="Mail">
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="popup">Nieuwe klant is aangemaakt</div>
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


                        <form action="?page=uploading" method="post" enctype="multipart/form-data"
                              class="form-horizontal">
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
                                                <label for="file-upload" class="custom-file-upload">
                                                    <i class="fa fa-cloud-upload"></i> <?= BUTTON_UPLOAD ?>
                                                </label>
                                                <input required type="file" name="myFile[]" class="imgInp"
                                                       id="file-upload" multiple>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_SELECTED_FILES ?></label>
                                            <div class="col-md-4">
                                                <div id="fileList"></div>

                                                <output id="list"></output>
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
                                                <select name="commentgroep">
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
                                        <li><input class="btn btn-primary btn-success" name="submit"
                                                   style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #bb2c4c"
                                                   type="submit" value="<?= BUTTON_SEND ?>"></li>
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

