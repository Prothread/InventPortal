<?php
#INDIVIDUAL ITEM PAGE

if($user->getPermission($permgroup, 'CAN_SHOW_ITEM') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$session = new Session();
$uploads = new BlockController();

$id = $_GET['id'];
$id = $session->cleantonumber($id);

//Check verified images
$verimages = array();

$upload = $uploads->getUploadById($id);
$comments = $uploads->getComments($id);

$image_controller = new ImageController();
$uploadedimages = $image_controller->getImagebyMailID($upload['id']);

$checknewarray = array();
foreach ($uploadedimages as $img) {
    $isverified = $image_controller->getImageVerify($img['id']);
    array_push($checknewarray, $isverified['verify']);
}
// TODO GET CLIENT FROM MAIL (getusermailbymailid)
?>

<div id="Mail">
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="NameText">Aanpassen</p>

                    <hr size="1">

                    <?php
                    if(in_array(2, $checknewarray) || in_array(0, $checknewarray) ) {?>
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Proef & Status">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Informatie">
                            <span class="round-tab">
                                <i class=" glyphicon glyphicon-list-alt"></i>
                            </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Nieuwe bestanden">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-plus"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab" title="Versturen">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-flag"></i>
                            </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php }
                        else { ?>
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active">
                                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Uploads">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon glyphicon-picture"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Informatie">
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
                            <form class="form-horizontal" action="?page=uploading" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $upload['id']?>">&emsp;&emsp;
                                <div class="tab-content">
                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                        <div class="well" style="font-size: 15px; font-style: italic;">Bekijk hieronder de proef en de status. </div>
                                        <br>
                                        <?php
                                        $imgcount = 0;
                                        foreach ($uploadedimages as $img) {
                                            $demimages = $img['images'];
                                            $deimage = pathinfo($demimages);
                                            $imgcount++;
                                            ?>
                                            <div id="imgakkoord" style="float:left;">
                                                <div style="border:0; width: 250px; max-width: ; height: 320px; text-align:center">

                                                    <a href="#img<?= $imgcount ?>">
                                                        <?php if($deimage['extension'] == 'pdf') { ?>
                                                            <embed width="100%" height="100%" src="index.php?page=image&img=<?= $img["images"]?>"></embed>
                                                            <a href="#img<?= $imgcount ?>">PDF Lightbox</a>
                                                        <?php } else { ?>
                                                            <div id="thumbnail2" style="background: url('index.php?page=image&img=<?= $img['images']?>') no-repeat scroll 50% 50%;background-size:contain;"></div>
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                                <br />

                                                <?php
                                                if(isset($img['id'])) {

                                                    $isverified = $image_controller->getImageVerify($img['id']);

                                                    if($isverified['verify'] == 1) { ?>
                                                        <div id="akkoord" class="alert alert-success" style="text-align: center;" role="alert"><span class="glyphicon glyphicon-ok-circle"></span> Akkoord</div>
                                                    <?php }

                                                    if($isverified['verify'] == 2) {?>
                                                        <div id="weiger" class="alert alert-danger" style="text-align: center;" role="alert"><span class="glyphicon glyphicon-remove-circle"></span> Geweigerd</div>
                                                    <?php }

                                                    if($isverified['verify'] == 3) {?>
                                                        <div id="weiger" class="alert alert-info" style="background-color:lightgrey; color:grey; text-align: center;" role="alert"><span class="glyphicon glyphicon-remove-circle"></span> Gewijzigd</div>
                                                    <?php }

                                                    if($isverified['verify'] == 0) {?>
                                                        <div id="weiger" class="alert alert-info" style="text-align: center;" role="alert"><span class="glyphicon glyphicon-remove-circle"></span> Niet beoordeeld</div>
                                                    <?php }

                                                    array_push($verimages, $isverified['verify']);

                                                }?>

                                            </div>
                                            <a href="#_" class="lightbox" id="img<?=$imgcount ?>">
                                                <div id="lighter" class="w3-animate-opacity">
                                                    <?php if($deimage['extension'] == 'pdf') { ?>
                                                        <embed width="100%" height="100%" src="index.php?page=image&img=<?= $img["images"]?>"></embed>
                                                    <?php } else { ?>
                                                        <div id="thumbnail2" style="background: url('index.php?page=image&img=<?= $img['images']?>') no-repeat scroll 50% 50%;background-size:contain;"></div>
                                                    <?php } ?>
                                                </div>
                                            </a>
                                        <?php }
                                        ?>
                                        <br><br>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-primary next-step">Volgende</button></li>
                                        </ul>
                                    </div>


                                    <div class="tab-pane" role="tabpanel" id="step2">
                                        <div class="well" style="font-size: 15px; font-style: italic;">Bekijk de informatie.</div>

                                        <br>

                                        <div style="clear: both;"></div>
                                        <?php if(in_array(2, $verimages) || in_array(0, $verimages)) { ?>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Onderwerp<span style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input class="form-control input-md" id="textinput" required type="text" name="title" readonly value="<?= $upload['onderwerp']?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Verstuurder<span style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input name="fromname" class="form-control input-md" id="textinput" required type="text" readonly value="<?= $upload['verstuurder']?>">
                                            </div>
                                        </div>

                                        <?php if(isset($upload['answer']) && $upload['answer'] !== '') { ?>
                                        <br />
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Beschijving van de klant</label>
                                            <div class="col-md-4">
                                                <textarea disabled class="form-control input-md" id="textinput1"><?= $upload['answer']?></textarea>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <br />
                                        <?php if($comments !== null) { ?>
                                            <?php $i = 0; $o = 0;?>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Interne opmerkingen</label>
                                                <div class="col-md-4">
                                                    <ul id="comments">
                                                        <span>Gesorteed op !importance!</span>
                                                        <?php foreach($comments as $comment) {?>
                                                            <?php
                                                            $i++;
                                                            $importance = $comment['commentgroep'];
                                                            if($importance == '1') {
                                                                $importancecolor = '#5a5454';
                                                            }
                                                            else if($importance == '2') {
                                                                $importancecolor = '#9a1734';
                                                            }
                                                            else if($importance == '3') {
                                                                $importancecolor = '#dd2c4c';
                                                            }
                                                            else if($importance == '4') {
                                                                $importancecolor = 'red';
                                                            }
                                                            else {
                                                                $importancecolor = 'black';
                                                            }
                                                            ?>
                                                            <a href="" class="question<?= $i ?>"><li style="color: <?= $importancecolor ?>"><div id="leftside"><?= $comment['comment']?></div><div id="rightdate"><?= date('d-m-Y', strtotime($comment['datum'])) ?></div></li></a>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="allanswers">

                                            <div class="form-group new_member_box_display" id="answer">
                                                <label class="col-md-4 control-label" for="textinput"><span>Opmerking </span></label>
                                                <div class="col-md-4">
                                                    <textarea disabled class="form-control input-md" id="textinput1">*selecteer een opmerking*</textarea>
                                                </div>
                                            </div>

                                                <?php foreach($comments as $comment){ ?>
                                                    <?php $o++;
                                                    $importance = $comment['commentgroep'];
                                                    if($importance == '1') {
                                                        $importancecolor = '#5a5454';
                                                    }
                                                    else if($importance == '2') {
                                                        $importancecolor = '#9a1734';
                                                    }
                                                    else if($importance == '3') {
                                                        $importancecolor = '#dd2c4c';
                                                    }
                                                    else if($importance == '4') {
                                                        $importancecolor = 'red';
                                                    }?>
                                                    <div class="form-group isanswer" id="answer<?= $o ?>">
                                                        <label class="col-md-4 control-label" for="textinput">Opmerking <?= $o ?> <br /><?= date("d-m-Y", strtotime($comment['datum'])); ?></label>
                                                        <div class="col-md-4">
                                                            <textarea disabled class="form-control input-md" id="textinput1"><?= $comment['comment']; ?></textarea>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>



                                            <script>
                                                $('[class^="question"]').on('click', function(e){
                                                    e.preventDefault();
                                                    var numb = this.className.replace('question', '');
                                                    $('[id^="answer"]').hide();
                                                    $('#answer' + numb).show();
                                                });
                                            </script>

                                        <?php } ?>

                                        <br>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-primary next-step">Volgende</button></li>
                                        </ul>
                                    </div>
                                    <?php }
                                    else { ?>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Verstuurder<span style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input disabled name="fromname" class="form-control input-md" id="textinput" type="text" size="50" value="<?= $upload['verstuurder']?>">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Onderwerp<span style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input disabled name="title" class="form-control input-md" id="textinput" type="text" size="50" value="<?= $upload['onderwerp']?>">
                                            </div>
                                        </div>


                                    <?php } ?>


                                    <?php if(in_array(2, $verimages) || in_array(0, $verimages)) { ?>
                                        <div class="tab-pane" role="tabpanel" id="step3">
                                            <div class="well" style="font-size: 15px; font-style: italic;">Upload indien nodig nieuwe bestanden. </div>
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
                                                        <label class="col-md-4 control-label" for="textinput">Nieuwe interne opmerking:</label>
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
                                            <br><br>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-primary next-step">Volgende</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step4">
                                        <div class="well" style="font-size: 15px; font-style: italic;">Pas hieronder eventueel de beschrijving aan en verstuur de proef opnieuw. </div>

                                        <br>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Beschrijving<span style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input name="additionalcontent" class="form-control input-md" id="textinput" type="text" size="50" value="<?= $upload['beschrijving']?>">
                                            </div>
                                        </div>
                                        <br><br>
                                        <input type="hidden" name="frommail" id="MailFrom" value="<?= $upload['onderwerp']?>">
                                        <br><br>
                                        <input type="hidden" name="mailname" size="50" value="<?= $upload['naam']?>">&emsp;&emsp;
                                        <input type="hidden" name="mailto" size="50" value="<?= $upload['email']?>">

                                        <ul class="list-inline pull-right">
                                            <li>  <input class="btn btn-primary btn-success" name="submit" style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #bb2c4c" type="submit" value="Opslaan"></li>
                                        </ul>
                                        <br>
                                    <?php }

                                    // VOOR ALS HET AL GEACCORDEERD IS

                                    else {
                                        ?>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Beschrijving<span style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input disabled name="additionalcontent" class="form-control input-md" id="textinput" type="text" size="50" value="<?= $upload['beschrijving']?>">
                                            </div>
                                        </div>

                                        <br /><br />

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Naam klant<span style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input disabled name="mailname" class="form-control input-md" id="textinput" type="text" size="50" value="<?= $upload['naam']?>">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">E-mailadres klant<span style="color:#bc2d4c">*</span></label>
                                            <div class="col-md-4">
                                                <input disabled name="mailto" class="form-control input-md" id="textinput" type="text" size="50" value="<?= $upload['email']?>">
                                            </div>
                                        </div>

                                        <input disabled="disabled" type="hidden" name="frommail" id="MailFrom" value="<?= $upload['onderwerp']?>">

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Beschijving van de klant</label>
                                            <div class="col-md-4">
                                                <input disabled name="mailanswer" class="form-control input-md" id="textinput" type="text" size="50" value="<?= $upload['answer']?>">
                                            </div>
                                        </div>

                                            <?php if($comments !== null) { ?>
                                                <?php $i = 0; $o = 0;?>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="textinput">Interne opmerkingen</label>
                                                    <div class="col-md-4">
                                                        <ul id="comments">
                                                            <span>Gesorteed op !importance!</span>
                                                            <?php foreach($comments as $comment) {?>
                                                                <?php
                                                                $i++;
                                                                $importance = $comment['commentgroep'];
                                                                if($importance == '1') {
                                                                    $importancecolor = '#5a5454';
                                                                }
                                                                else if($importance == '2') {
                                                                    $importancecolor = '#9a1734';
                                                                }
                                                                else if($importance == '3') {
                                                                    $importancecolor = '#dd2c4c';
                                                                }
                                                                else if($importance == '4') {
                                                                    $importancecolor = 'red';
                                                                }
                                                                ?>
                                                                <!-- <div class="form-group">
                                                    <label class="col-md-4 control-label" for="textinput"><span style="color: <?= $importancecolor ?>">Opmerking <?= $i ?>: </span></label>
                                                    <div class="col-md-4">
                                                        <textarea disabled class="form-control input-md" id="textinput"><?= $comment['comment']?></textarea>
                                                    </div>
                                                </div> -->
                                                                <a href="" class="question<?= $i ?>"><li style="color: <?= $importancecolor ?>"><div id="leftside"><?= $comment['comment']?></div><div id="rightdate"><?= $comment['datum'] ?></div></li></a>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="allanswers">

                                                    <div class="form-group new_member_box_display" id="answer">
                                                        <label class="col-md-4 control-label" for="textinput"><span>Opmerking </span></label>
                                                        <div class="col-md-4">
                                                            <textarea disabled class="form-control input-md" id="textinput1">*selecteer een opmerking*</textarea>
                                                        </div>
                                                    </div>

                                                    <?php foreach($comments as $comment){ ?>
                                                        <?php $o++;
                                                        $importance = $comment['commentgroep'];
                                                        if($importance == '1') {
                                                            $importancecolor = '#5a5454';
                                                        }
                                                        else if($importance == '2') {
                                                            $importancecolor = '#9a1734';
                                                        }
                                                        else if($importance == '3') {
                                                            $importancecolor = '#dd2c4c';
                                                        }
                                                        else if($importance == '4') {
                                                            $importancecolor = 'red';
                                                        }?>
                                                        <div class="form-group isanswer" id="answer<?= $o ?>">
                                                            <label class="col-md-4 control-label" for="textinput"><span style="color:<?= $importancecolor ?>">Opmerking <?= $o ?> </span><br /><?= date("d-m-Y", strtotime($comment['datum'])); ?></label>
                                                            <div class="col-md-4">
                                                                <textarea disabled class="form-control input-md" id="textinput1"><?= $comment['comment']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>



                                                <script>
                                                    $('[class^="question"]').on('click', function(e){
                                                        e.preventDefault();
                                                        var numb = this.className.replace('question', '');
                                                        $('[id^="answer"]').hide();
                                                        $('#answer' + numb).show();
                                                    });
                                                </script>

                                            <?php } ?>

                                        </div>
                                        <br><br>


                            </form>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td>Downloads:</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php foreach($uploadedimages as $img) { ?>
                                                    <td style="float:left;margin-right:10px;" class="imgdownloader img<?= $img['id']?>">
                                                        <div class="btn-group">
                                                            <button type="button" id="downloadimagedd" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <div class="imagedownload" style="background: url('index.php?page=image&img=<?= $img['images']?>'); background-size: cover;"> <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                            <?php if($img['downloadable'] == 1 || substr( $img['images'], -3) == 'pdf') { ?>
                                                                <li><a href="?page=download&file=<?= DIR_IMAGE . $img['images']; ?>">Download</a></li>
                                                            <?php }
                                                            else { ?>
                                                                <?php if($user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1){ ?>
                                                                    <li>
                                                                        <form id="downloadbuttons" method="post">
                                                                            <span>Maak downloadbaar: </span>
                                                                            <input type="submit" class="imgdownload id<?= $id ?>" id="img<?= $img['id'] ?>">
                                                                        </form>
                                                                    </li>
                                                                <?php } ?>
                                                                <br />
                                                                <li>U kunt dit product nog niet downloaden</li>
                                                            <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                <?php }?>
                                            </tr>
                                            </tbody>
                                        </table>
                                    <?php if($user->getPermission($permgroup, 'CAN_EDIT_ACCORD') == 1){ ?>
                                    <a href="?page=allimgdown&id=<?= $id ?>">Maak alle files downloadbaar</a>
                                    <?php } ?>


                                    <?php } ?>

                                <div style="clear:both"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>