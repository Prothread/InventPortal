<?php
#INDIVIDUAL ITEM PAGE

if ($user->getPermission($permgroup, 'CAN_SHOW_ITEM') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$session = new Session();
$uploads = new BlockController();
$usermail = new MailController();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = $session->cleantonumber($id);
}
else {
    return '<div class="alert alert-info"> ' . TEXT_ERROR_OCCURED .'</div>';
}

$myuser = $user->getUserById($_SESSION['usr_id']);

if ($getmail = $usermail->getUserMailbyMailID($id)) {
    if ($_SESSION['usr_id'] == $getmail['userid']) {

    } else if ($_SESSION['usr_id'] == $getmail['clientid']) {

    } else if ($myuser['permgroup'] !== '1') {

    } else {
        echo '<div class="alert alert-info"> '. TEXT_NO_PERMISSION . '</div>';
        return false;
    }
} else {
    return 'Er is een probleem opgetreden';
}

//Check verified images
$verimages = array();

$upload = $uploads->getUploadById($id);
$comments = $uploads->getComments($id);

$image_controller = new ImageController();
$uploadedimages = $image_controller->getImagebyMailID($upload['id']);

if ($uploadedimages == null) {
    return '<div class="alert alert-info"> ' . TEXT_ERROR_OCCURED .'</div>';
}
$checknewarray = array();
foreach ($uploadedimages as $img) {
    $isverified = $image_controller->getImageVerify($img['id']);
    array_push($checknewarray, $isverified['verify']);
}
$clientmail = $usermail->getUserMailbyMailID($id);

//Haalt de key op (tijd, datum, IP-adres)
$theKey = $user->getClientKey($upload['naam']);

?>

<div id="Mail">
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <table style="width:100%">
            <tr>
                <th style="text-align: left;"><p class="NameText" style="font-weight: normal;"><?= TEXT_YOUR_ASSIGNMENT ?></p></th>
                <th style="text-align: right;">

                    <?php if ($user->getPermission($permgroup, 'CAN_USE_ITEM_DELETE') == 1) { ?>
                        <a data-toggle="modal" data-target="#Weigeritem" href="#" style="text-decoration: none;">
                            <button type="button" class="btn btn-labeled btn-success MyOverviewButton" >
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span><?= BUTTON_DECLINE_ASSIGNMENT ?>
                            </button>
                        </a>
                    <?php } ?>

                    <?php if ($user->getPermission($permgroup, 'CAN_USE_ITEM_DELETE') == 1) { ?>
                        <a data-toggle="modal" data-target="#Deleteitem" href="#">
                            <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span><?= BUTTON_DELETE_ASSIGNMENT ?>
                            </button>
                        </a>
                    <?php } ?>

                </th>
            </tr>
        </table>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <hr size="1">

                    <?php
                    if (in_array(2, $checknewarray) || in_array(0, $checknewarray)) { ?>
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                       title="Proef & Status">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-picture"></i>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                       title="Informatie">
                                        <span class="round-tab">
                                            <i class=" glyphicon glyphicon-list-alt"></i>
                                        </span>
                                    </a>
                                </li>
                                <?php if ($user->getPermission($permgroup, 'CAN_UPLOAD')) { ?>
                                    <li role="presentation" class="disabled">
                                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"
                                           title="Nieuwe bestanden">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab"
                                           title="Versturen">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-flag"></i>
                                        </span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php }
                        else { ?>
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active">
                                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                           title="Uploads">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon glyphicon-picture"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                           title="Informatie">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            }
                            ?>
                            <form action="?page=uploadImages" method="post" enctype="multipart/form-data" class="form-horizontal dropzone" id="mydropzone">
                                <input type="hidden" name="client" value="<?= $clientmail['clientid'] ?>">
                                <input type="hidden" name="id" value="<?= $upload['id'] ?>">&emsp;&emsp;
                                <div class="tab-content">
                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                        <div class="well" style="font-size: 15px; font-style: italic;"><?= TEXT_ASSIGNMENT_INFO ?>
                                        </div>
                                        <br>
                                        <?php
                                        $imgcount = 0;
                                        foreach ($uploadedimages as $img) {

                                            $demimages = $img['images'];

                                            $deimage = pathinfo($demimages);
                                            $imgcount++;
                                            ?>
                                            <div id="imgakkoord" style="float:left;">
                                                <div
                                                    style="border:0; width: 250px; max-width: ; height: 320px; text-align:center">

                                                    <a href="#img<?= $imgcount ?>">
                                                        <?php if ($deimage['extension'] == 'pdf') { ?>
                                                            <embed width="100%" height="100%"
                                                                   src="index.php?page=image&img=<?= $img["images"] ?>"></embed>
                                                            <a href="#img<?= $imgcount ?>">PDF Lightbox</a>
                                                        <?php } else { ?>
                                                            <div id="thumbnail2"
                                                                 style="background: url('index.php?page=image&img=<?= $img['images'] ?>') no-repeat scroll 50% 50%;background-size:contain;"></div>
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                                <br/>

                                                <?php
                                                if (isset($img['id'])) {

                                                    $isverified = $image_controller->getImageVerify($img['id']);

                                                    if ($isverified['verify'] == 1) { ?>
                                                        <div id="akkoord" class="alert1 alert-success"
                                                             style="text-align: center;" role="alert"><span
                                                                class="alert-version"><?= TEXT_VERSIE ?> <?= $isverified['version'] ?></span><br/><span
                                                                class="glyphicon1 glyphicon-ok-circle"></span> <?= TEXT_ACCORD ?>
                                                        </div>
                                                    <?php }

                                                    if ($isverified['verify'] == 2) { ?>
                                                        <div id="weiger" class="alert1 alert-danger"
                                                             style="text-align: center;" role="alert"><span
                                                                class="alert-version"><?= TEXT_VERSIE ?> <?= $isverified['version'] ?></span><br/><span
                                                                class="glyphicon1 glyphicon-remove-circle"></span>
                                                            <?= TEXT_DECLINED ?>
                                                        </div>
                                                    <?php }

                                                    if ($isverified['verify'] == 3) { ?>
                                                        <div id="weiger" class="alert1 alert-info"
                                                             style="background-color:lightgrey; color:grey; text-align: center;"
                                                             role="alert"><span
                                                                class="alert-version"><?= TEXT_VERSIE  ?> <?= $isverified['version'] ?></span><br/><span
                                                                class="glyphicon1glyphicon-remove-circle"></span>
                                                            <?= TEXT_EDITED ?>
                                                        </div>
                                                    <?php }

                                                    if ($isverified['verify'] == 0) { ?>
                                                        <div id="weiger" class="alert1 alert-info"
                                                             style="text-align: center;" role="alert"><span
                                                                class="alert-version"><?= TEXT_VERSIE  ?> <?= $isverified['version'] ?></span><br/><span
                                                                class="glyphicon1 glyphicon-remove-circle"></span> <?= TEXT_NO_EDITS ?>
                                                        </div>
                                                    <?php }

                                                    array_push($verimages, $isverified['verify']);

                                                } ?>

                                            </div>
                                            <a href="#_" class="lightbox" id="img<?= $imgcount ?>">
                                                <div id="lighter" class="w3-animate-opacity">
                                                    <?php if ($deimage['extension'] == 'pdf') { ?>
                                                        <embed width="100%" height="100%"
                                                               src="index.php?page=image&img=<?= $img["images"] ?>"></embed>
                                                    <?php } else { ?>
                                                        <div id="thumbnail2"
                                                             style="background: url('index.php?page=image&img=<?= $img['images'] ?>') no-repeat scroll 50% 50%;background-size:contain;"></div>
                                                    <?php } ?>
                                                </div>
                                            </a>
                                        <?php }
                                        ?>
                                        <br><br>
                                        <ul class="list-inline pull-right">
                                            <li>
                                                <button type="button" class="btn btn-primary next-step"><?= BUTTON_NEXT ?>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>


                                    <div class="tab-pane" role="tabpanel" id="step2">
                                        <div class="well" style="font-size: 15px; font-style: italic;"><?= TEXT_ASSIGNMENT_INFO ?>
                                        </div>

                                        <br>

                                        <div style="clear: both;"></div>
                                        <?php if (in_array(2, $verimages) || in_array(0, $verimages)) { ?>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TABLE_TITLE ?><span
                                                    style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input class="form-control input-md" id="textinput" required type="text"
                                                       name="title" readonly value="<?= $upload['onderwerp'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_SENDER ?><span
                                                    style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <?php $usr = $user->getUserById($upload['verstuurder']); ?>
                                                <input name="fromname" class="form-control input-md" id="textinput"
                                                       required type="text" readonly
                                                       value="<?= $usr['naam'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_DESCRIPTION ?><span
                                                    style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input class="form-control input-md" id="textinput" required type="text"
                                                       readonly value="<?= $upload['beschrijving'] ?>">
                                            </div>
                                        </div>

                                        <br/>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_IS_CLIENT ?><span
                                                    style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <?php $clnt = $user->getUserById($upload['naam']); ?>
                                                <input disabled name="mailname" class="form-control input-md"
                                                       id="textinput" type="text" size="50"
                                                       value="<?= $clnt['naam'] ?>">
                                            </div>
                                        </div>

                                        <?php if ($user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1) { ?>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_PRODUCT_ACCORD ?></label>
                                                <div class="col-md-4">
                                                    <textarea class="form-control input-md" readonly><?= $admin['Host'] . '/' ?>index.php?page=verify&id=<?= $upload['id'] ?>&key=<?= $upload['key'] ?></textarea>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if ($user->getPermission($permgroup, 'CAN_ACCORD') == 1 && in_array(0, $verimages)) { ?>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput"></label>
                                                <div class="col-md-4">
                                                    <a href="index.php?page=verify&id=<?= $upload['id'] ?>&key=<?= $upload['key'] ?>">
                                                        <button type="button"
                                                                class="btn btn-labeled btn-success MyOverviewButton"
                                                                style="height: 40px;"><?= TEXT_ACCORD ?>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if (isset($upload['answer']) && $upload['answer'] !== '') { ?>
                                            <br/>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_CLIENT_DESCRIPTION ?></label>
                                                <div class="col-md-4">
                                                    <textarea disabled class="form-control input-md"
                                                              id="textinput1"><?= $upload['answer'] ?></textarea>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <br/>
                                        <?php if ($user->getPermission($permgroup, 'CAN_ADD_INTERN_COMMENT') == 1) { ?>
                                            <?php if ($comments !== null) { ?>
                                                <?php $i = 0;
                                                $o = 0; ?>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="textinput"><?= TEXT_INTERNCOMMENT ?></label>
                                                    <div class="col-md-4">
                                                        <ul id="comments">
                                                            <?php foreach ($comments as $comment) { ?>
                                                                <?php
                                                                $i++;
                                                                $importance = $comment['commentgroep'];
                                                                if ($importance == '1') {
                                                                    $importancecolor = '#5a5454';
                                                                } else if ($importance == '2') {
                                                                    $importancecolor = '#9a1734';
                                                                } else if ($importance == '3') {
                                                                    $importancecolor = '#dd2c4c';
                                                                } else if ($importance == '4') {
                                                                    $importancecolor = 'red';
                                                                } else {
                                                                    $importancecolor = 'black';
                                                                }
                                                                ?>
                                                                <a href="" class="question<?= $i ?>">
                                                                    <li style="color: <?= $importancecolor ?>">
                                                                        <div
                                                                            id="leftside"><?= $comment['comment'] ?></div>
                                                                        <div
                                                                            id="rightdate"><?= date('d-m-Y', strtotime($comment['datum'])) ?></div>
                                                                    </li>
                                                                </a>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="allanswers">

                                                    <div class="form-group new_member_box_display" id="answer">
                                                        <label class="col-md-4 control-label" for="textinput"><span>Opmerking </span></label>
                                                        <div class="col-md-4">
                                                            <textarea disabled class="form-control input-md"
                                                                      id="textinput1">*selecteer een opmerking*</textarea>
                                                        </div>
                                                    </div>

                                                    <?php foreach ($comments as $comment) { ?>
                                                        <?php $o++;
                                                        $importance = $comment['commentgroep'];
                                                        if ($importance == '1') {
                                                            $importancecolor = '#5a5454';
                                                        } else if ($importance == '2') {
                                                            $importancecolor = '#9a1734';
                                                        } else if ($importance == '3') {
                                                            $importancecolor = '#dd2c4c';
                                                        } else if ($importance == '4') {
                                                            $importancecolor = 'red';
                                                        } ?>
                                                        <div class="form-group isanswer" id="answer<?= $o ?>">
                                                            <label class="col-md-4 control-label" for="textinput">Opmerking <?= $o ?>
                                                                <br/><?= date("d-m-Y", strtotime($comment['datum'])); ?>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <textarea disabled class="form-control input-md"
                                                                          id="textinput1"><?= $comment['comment']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>


                                                <script>
                                                    $('[class^="question"]').on('click', function (e) {
                                                        e.preventDefault();
                                                        var numb = this.className.replace('question', '');
                                                        $('[id^="answer"]').hide();
                                                        $('#answer' + numb).show();
                                                    });
                                                </script>

                                            <?php } ?>
                                        <?php } ?>

                                        <br>
                                        <ul class="list-inline pull-right">
                                            <li>
                                                <button type="button" class="btn btn-primary next-step"><?= BUTTON_NEXT ?>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php }
                                    else { ?>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TABLE_TITLE ?></label>
                                            <div class="col-md-4">
                                                <input disabled name="title" class="form-control input-md"
                                                       id="textinput" type="text" size="50"
                                                       value="<?= $upload['onderwerp'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_SENDER ?></label>
                                            <div class="col-md-4">
                                                <input disabled name="fromname" class="form-control input-md"
                                                       id="textinput" type="text" size="50"
                                                       value="<?= $upload['verstuurder'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_DESCRIPTION ?></label>
                                            <div class="col-md-4">
                                                <input disabled name="additionalcontent" class="form-control input-md"
                                                       id="textinput" required type="text"
                                                       value="<?= $upload['beschrijving'] ?>">
                                            </div>
                                        </div>

                                        <?php if ($user->getPermission($permgroup, 'CAN_SHOW_USERIP') == '1') { ?>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_ACCORD_IP ?></label>
                                                <div class="col-md-4">
                                                    <input disabled name="mailname" class="form-control input-md"
                                                           id="textinput" type="text" value="<?= $upload['key'] ?>">
                                                </div>
                                            </div>
                                        <?php } ?>


                                    <?php } ?>


                                    <?php if ($user->getPermission($permgroup, 'CAN_UPLOAD')) { ?>
                                        <?php if (in_array(2, $verimages) || in_array(0, $verimages)) { ?>
                                            <div class="tab-pane" role="tabpanel" id="step3">
                                                <div class="well" style="font-size: 15px; font-style: italic;"><?= TEXT_STEP5 ?>
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
                                                            <i class="fa fa-cloud-upload"></i> <?= TEXT_UPLOAD ?>
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

                                                    <?php if ($user->getPermission($permgroup, 'CAN_ADD_INTERN_COMMENT') == 1) { ?>
                                                        <br/><br/>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_NEW_INTERNCOMMENT ?></label>
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
                                                                    <option value="4" style="color:red">
                                                                        <?= TEXT_INTERNCOMMENTIMPORTANCE4 ?>
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <br>
                                                </fieldset>
                                                <br><br>
                                                <ul class="list-inline pull-right">
                                                    <li>
                                                        <button type="button" class="btn btn-primary next-step">
                                                            <?= BUTTON_NEXT ?>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="step4">
                                            <div class="well" style="font-size: 15px; font-style: italic;"><?= TEXT_STEP6 ?>
                                            </div>

                                            <br>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_NEW_DESCRIPTION ?></label>
                                                <div class="col-md-4">
                                                    <input name="additionalcontent" class="form-control input-md"
                                                           id="textinput" type="text" size="50"
                                                           value="<?= $upload['beschrijving'] ?>">
                                                </div>
                                            </div>
                                            <input type="hidden" name="mailto" size="50"
                                                   value="<?= $upload['email'] ?>">

                                            <ul class="list-inline pull-right">
                                                <li>
                                                    <button type="submit" id="sbmtbtn" class="btn btn-primary"><?= BUTTON_SENDAGAIN ?></button>
                                                </li>
                                            </ul>
                                            <br>
                                        <?php } // VOOR ALS HET AL GEACCORDEERD IS

                                        else {
                                            ?>

                                            <br/><br/>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_CLIENT ?></label>
                                                <div class="col-md-4">
                                                    <?php $clnt = $user->getUserById($upload['naam']); ?>
                                                    <input disabled name="mailname" class="form-control input-md"
                                                           id="textinput" type="text" value="<?= $clnt['naam'] ?>">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_EMAIL_CLIENT ?></label>
                                                <div class="col-md-4">
                                                    <input disabled name="mailto" class="form-control input-md"
                                                           id="textinput" type="text" size="50"
                                                           value="<?= $upload['email'] ?>">
                                                </div>
                                            </div>

                                            <input disabled="disabled" type="hidden" name="frommail" id="MailFrom"
                                                   value="<?= $upload['onderwerp'] ?>">

                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_CLIENT_DESCRIPTION ?></label>
                                                <div class="col-md-4">
                                                    <input disabled name="mailanswer" class="form-control input-md"
                                                           id="textinput" type="text" size="50"
                                                           value="<?= $upload['answer'] ?>">
                                                </div>
                                            </div>

                                        <?php if ($user->getPermission($permgroup, 'CAN_ADD_INTERN_COMMENT') == 1){ ?>
                                        <?php if ($comments !== null) { ?>
                                        <?php $i = 0;
                                        $o = 0; ?>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_INTERNCOMMENT ?></label>
                                                <div class="col-md-4">
                                                    <ul id="comments">
                                                        <?php foreach ($comments as $comment) { ?>
                                                            <?php
                                                            $i++;
                                                            $importance = $comment['commentgroep'];
                                                            if ($importance == '1') {
                                                                $importancecolor = '#5a5454';
                                                            } else if ($importance == '2') {
                                                                $importancecolor = '#9a1734';
                                                            } else if ($importance == '3') {
                                                                $importancecolor = '#dd2c4c';
                                                            } else if ($importance == '4') {
                                                                $importancecolor = 'red';
                                                            }
                                                            ?>
                                                            <a href="" class="question<?= $i ?>">
                                                                <li style="color: <?= $importancecolor ?>">
                                                                    <div id="leftside"><?= $comment['comment'] ?></div>
                                                                    <div id="rightdate"><?= $comment['datum'] ?></div>
                                                                </li>
                                                            </a>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="allanswers">

                                                <div class="form-group new_member_box_display" id="answer">
                                                    <label class="col-md-4 control-label" for="textinput"><span><?= TEXT_COMMENT ?> </span></label>
                                                    <div class="col-md-4">
                                                        <textarea disabled class="form-control input-md"
                                                                  id="textinput1">*<?= TEXT_SELECT_COMMENT ?>*</textarea>
                                                    </div>
                                                </div>

                                                <?php foreach ($comments as $comment) { ?>
                                                    <?php $o++;
                                                    $importance = $comment['commentgroep'];
                                                    if ($importance == '1') {
                                                        $importancecolor = '#5a5454';
                                                    } else if ($importance == '2') {
                                                        $importancecolor = '#9a1734';
                                                    } else if ($importance == '3') {
                                                        $importancecolor = '#dd2c4c';
                                                    } else if ($importance == '4') {
                                                        $importancecolor = 'red';
                                                    } ?>
                                                    <div class="form-group isanswer" id="answer<?= $o ?>">
                                                        <label class="col-md-4 control-label" for="textinput"><span
                                                                style="color:<?= $importancecolor ?>">Opmerking <?= $o ?> </span><br/><?= date("d-m-Y", strtotime($comment['datum'])); ?>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <textarea disabled class="form-control input-md"
                                                                      id="textinput1"><?= $comment['comment']; ?></textarea>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>


                                            <script>
                                                $('[class^="question"]').on('click', function (e) {
                                                    e.preventDefault();
                                                    var numb = this.className.replace('question', '');
                                                    $('[id^="answer"]').hide();
                                                    $('#answer' + numb).show();
                                                });
                                            </script>

                                        <?php } ?>
                                        <?php } ?>

                                            </div>
                                            <br><br>
                                        <?php } ?>

                                    <?php } ?>

                            </form>
                            <?php if ($upload['verified'] == '2') { ?>
                                <table>
                                    <thead>
                                    <tr>
                                        <td><?= TEXT_DOWNLOADS ?></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php foreach ($uploadedimages as $img) { ?>
                                            <td style="float:left;margin-right:10px;"
                                                class="imgdownloader img<?= $img['id'] ?>">
                                                <div class="btn-group">
                                                    <button type="button" id="downloadimagedd"
                                                            class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <div class="imagedownload"
                                                             style="background: url('index.php?page=image&img=<?= $img['images'] ?>'); background-size: cover;">
                                                            <span class="caret"></span>
                                                        </div>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php if ($img['downloadable'] == 1 || substr($img['images'], -3) == 'pdf') { ?>
                                                            <li>
                                                                <a href="?page=download&file='<?= $img['images']; ?>'"><?= TEXT_DOWNLOAD ?></a>
                                                            </li>
                                                        <?php } else { ?>
                                                            <?php if ($user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1) { ?>
                                                                <li>
                                                                    <form id="downloadbuttons" method="post">
                                                                        <span><?= TEXT_MAKE_DOWNLOADABLE ?></span>
                                                                        <input type="submit"
                                                                               class="imgdownload id<?= $id ?>"
                                                                               id="img<?= $img['id'] ?>">
                                                                    </form>
                                                                </li>
                                                            <?php } ?>
                                                            <br/>
                                                            <li><?= TEXT_CANT_DOWNLOAD_YET ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    </tbody>
                                </table>
                                <?php if ($user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1) { ?>
                                    <a data-toggle="modal" data-target="#ImageDownloader" href="#"><?= TEXT_MAKE_ALL_DOWNLOADABLE ?></a>
                                <?php }
                            } ?>

                            <div style="clear:both"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ImageDownloader" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div style="text-align: center;" class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= TEXT_MAKE_ALL_DOWNLOADABLE ?></h4>
                    </div>
                    <div style="text-align: center;" class="modal-body">
                        <br>

                        <p> <?= TEXT_MAKE_ALL_DOWNLOADABLE_MESSAGE ?> <br/><br/>
                            <?= TEXT_ARE_YOU_SURE ?><br/><br/></p>
                        <a class="abuttonmodal" href="?page=allimgdown&id=<?= $id ?>"><?= TEXT_MAKE_ALL_DOWNLOADABLE ?></a>
                        <br/>
                        <br/>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>

            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="Deleteitem" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div style="text-align: center;" class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= TEXT_DELETE_ASSIGNMENT ?></h4>
                    </div>
                    <div style="text-align: center;" class="modal-body">
                        <br>

                        <p> U staat op het punt om het item <b><?= $upload['onderwerp'] ?></b> te verwijderen. <br/><br/>
                            Weet u dit zeker?<br/><br/></p>

                        <?php if ($user->getPermission($permgroup, 'CAN_USE_ITEM_DELETE') == 1) { ?>
                            <a href="?page=deleteitem&id=<?= $_GET['id'] ?>">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                    <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span><?= BUTTON_DELETE_ASSIGNMENT ?>
                                </button>
                            </a>
                        <?php } ?>

                        <br/>
                        <br/>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>

            </div>
        </div>

        <?php if ($isverified['verify'] == 0) { ?>

        <?php } else { ?>

            <div class="container">

                <h2>Geakkordeerd</h2>

                <table class="table">

                    <thead>

                    <tr>
                        <th>Date</th>
                        <th>IP-adress</th>
                        <th>Time</th>
                    </tr>


                    </thead>

                    <tbody>

                    <tr>
                        <!--                            Loopt door de array (tijd, datum, IP-adres)-->
                        <?php foreach (explode('-', $theKey) as $key): ?>

                            <td><?= $key ?></td>

                        <?php endforeach; ?>

                    </tr>

                    </tbody>

                </table>

            </div>

        <?php } ?>

        <!-- Modal -->
        <div class="modal fade" id="Weigeritem" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div style="text-align: center;" class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Opdracht verwijderen</h4>
                    </div>
                    <div style="text-align: center;" class="modal-body">
                        <br>

                        <p> U staat op het punt om het item <b><?= $upload['onderwerp'] ?></b> te weigeren. <br/><br/>
                            Weet u dit zeker?<br/><br/></p>

                        <?php if ($user->getPermission($permgroup, 'CAN_USE_ITEM_DELETE') == 1) { ?>
                            <a href="?page=weigeritem&id=<?= $_GET['id'] ?>">
                                <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                    <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span>Weiger opdrachten
                                </button>
                            </a>
                        <?php } ?>

                        <br/>
                        <br/>
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
                maxFilesize: 15, // MB
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
                        //window.location = 'index.php?page=lala1';
                        postForm += (Files.join(", "));

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