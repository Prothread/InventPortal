<?php
#ACCORDERING PAGINA

if ($user->getPermission($permgroup, 'CAN_ACCORD') == 1) {

} else {
    $block->Redirect('index.php');
    unset($_SESSION['accorduserid']);
    unset($_SESSION['accord']);
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$upload = new BlockController();
$usermail = new MailController();
$user = new UserController();
$session = new Session();

$image_controller = new ImageController();

if ($session->getMailId() == null) {
    $block->Redirect('index.php');
    Session::flash('message', 'Er is niks om te accorderen');
}

if ($session->getMailId() !== null) {
    $myupload = $upload->getUploadById($session->getMailId());
    $uploadedimages = $image_controller->getImagebyMailID($myupload['id']);
} else {
    return 'Er is iets misgegaan';
}
$_SESSION['accordid'] = $myupload['id'];

$UserMailer = $usermail->getUserMailbyMailID($session->getMailId());
$verstuurder = $user->getUserById($UserMailer['userid']);

if (isset($verstuurder['altmail']) && $verstuurder['altmail'] !== '') {
    $_SESSION['mailto'] = $verstuurder['altmail'];
} else {
    $_SESSION['mailto'] = $verstuurder['email'];
}


$UID = date('d.m.Y-G.i.s') . '-192.08.1.124';

$userip = $user->getUserIP();
$UID = date('d.m.Y-G.i.s') . '-' . $userip;

?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <p class="NameText">Productaccordering</p>
                <hr size="1">

                <br/>
                <p> Onderwerp: <span style="color:#bc2d4c"><?= $myupload['onderwerp']; ?></span></p>
                <p> Verstuurder: <span style="color:#bc2d4c"><?= $myupload['verstuurder'] ?></span></p>
                <p> Beschrijving: <span style="color:#bc2d4c"><?= $myupload['beschrijving'] ?></span></p>
                <br><br>

                <p> Bestand(en):
                        <span style="color:#bc2d4c">
                            <?php
                            $numItems = count($uploadedimages);
                            $i = 0;
                            foreach ($uploadedimages as $fakename) {
                                //Haal naam van image op
                                $fname1 = $fakename['images'];
                                //Maak een neppe naam aan voor de image (zonder _id)
                                $fname2 = $image_controller->getFakeImageName($fname1);

                                if (++$i === $numItems) {
                                    echo $fname2;
                                } else {
                                    echo $fname2 . ', ';
                                }
                            } ?>
                        </span>
                    </a
                </p>

                            <?php
                            $imgcount = 0;
                            $verifiedimages = array();
                            foreach ($uploadedimages as $img) {
                                $demimages = $img['images'];
                                $deimage = pathinfo($demimages);
                                $imgcount++;
                                ?>
                                <div id="refresh<?= $imgcount ?>">
                                    <div id="imgakkoord" style="float:left;">
                                        <div style="border:0; width: 250px; height: 320px;">
                                            <a href="#img<?= $imgcount ?>">
                                                <?php if ($deimage['extension'] == 'pdf') { ?>
                                                    <embed width="100%" height="93%"
                                                           src="index.php?page=image&img=<?= $img["images"] ?>"></embed>
                                                    <a href="#img<?= $imgcount ?>">PDF Lightbox</a>
                                                <?php } else { ?>
                                                    <div id="thumbnail2"
                                                         style="background: url('index.php?page=image&img=<?= $img['images'] ?>') no-repeat scroll 50% 50%;background-size:contain;"></div>
                                                <?php } ?>
                                            </a>
                                        </div>

                                        <?php

                                        $imago = $image_controller->getImageVerify($img['id']);

                                        if (isset($_SESSION['img' . $img['id']])) {
                                            if ($session->getImageVerify($img['id']) == 1) { ?>
                                                <div id="akkoord" class="alert alert-success"
                                                     style="text-align: center;" role="alert"><span
                                                        class="glyphicon glyphicon-ok-circle"></span> Akkoord
                                                </div>
                                                <a href="?page=imagecancel&img=<?= $img['id'] ?>">
                                                    <div id="cancel" style="color:black; text-align: center;"
                                                         role="alert"><span
                                                            class="glyphicon glyphicon-chevron-left"></span> Stap terug
                                                    </div>
                                                </a>
                                            <?php } else if ($session->getImageVerify($img['id']) == 2) { ?>
                                                <div id="weiger" class="alert alert-danger" style="text-align: center;"
                                                     role="alert"><span
                                                        class="glyphicon glyphicon-remove-circle"></span> Geweigerd
                                                </div>
                                                <a href="?page=imagecancel&img=<?= $img['id'] ?>">
                                                    <div id="cancel" style="color:black; text-align: center;"
                                                         role="alert"><span
                                                            class="glyphicon glyphicon-chevron-left"></span> Stap terug
                                                    </div>
                                                </a>
                                            <?php } else if ($session->getImageVerify($img['id']) == 3) { ?>
                                                <div id="weiger" class="alert1 alert-info"
                                                     style="background-color:lightgrey; color:grey; text-align: center;"
                                                     role="alert"><span
                                                        class="alert-version">V<?= $isverified['version'] ?></span><br/><span
                                                        class="glyphicon1glyphicon-remove-circle"></span> Gewijzigd
                                                </div>
                                            <?php } else { ?>
                                                <form id="mybuttons" method="post">
                                                    <input type="hidden" id="refreshcount" value="<?= $imgcount ?>">
                                                    <input type="hidden" id="ImageID" value="<?= $img['id'] ?>">
                                                    <input type="submit" id="AccButton" value="Akkoord">
                                                    <input type="submit" id="AccButton1" value="Weiger">
                                                </form>
                                            <?php }
                                        } else if ($imago['verify'] == 1) { ?>
                                            <div id="akkoord" class="alert1 alert-success" style="text-align: center;"
                                                 role="alert"><span
                                                    class="alert-version">V<?= $imago['version'] ?></span><br/><span
                                                    class="glyphicon1 glyphicon-ok-circle"></span> Akkoord
                                            </div>
                                        <?php } else if ($imago['verify'] == 3) { ?>
                                            <div id="weiger" class="alert1 alert-info"
                                                 style="background-color:lightgrey; color:grey; text-align: center;"
                                                 role="alert"><span
                                                    class="alert-version">V<?= $imago['version'] ?></span><br/><span
                                                    class="glyphicon1glyphicon-remove-circle"></span> Gewijzigd
                                            </div>
                                            <?php
                                        } else { ?>
                                            <form id="mybuttons" method="post">
                                                <input type="hidden" id="refreshcount" value="<?= $imgcount ?>">
                                                <input type="hidden" id="ImageID" value="<?= $img['id'] ?>">
                                                <input type="submit" id="AccButton" value="Akkoord">
                                                <input type="submit" id="AccButton1" value="Weiger">
                                            </form>

                                            <?php
                                        } ?>
                                        <div id="refsa"><?php


                                            if (isset($imago)) {

                                                if ($imago['verify'] == 1) {
                                                    $imageverify = 1;
                                                } else if ($imago['verify'] == 3) {
                                                    $imageverify = 3;
                                                } else if (isset($_SESSION['img' . $img['id']])) {

                                                    $imageverify = $session->getImageVerify($img['id']);

                                                    if ($imageverify !== null) {
                                                        $imageverify = $session->getImageVerify($img['id']);
                                                    } else {
                                                        $imageverify = 0;
                                                    }
                                                }
                                                else {
                                                    $imageverify = 0;
                                                }
                                            } else {
                                                $imageverify = 0;
                                            }

                                            if (isset($imageverify)) {
                                                $session->ImageVerify($img['id'], $imageverify);
                                                $sessionverify = $session->getImageVerify($img['id']);

                                                $verifiedimages['img' . $img['id']] = $sessionverify;
                                                //array_push($verifiedimages, $imageverify);
                                            }

                                            ?>
                                        </div>
                                    </div>
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
                                <?php
                            } ?>
                            <div id="refsh"><?php
                                if (in_array(2, $verifiedimages)) {
                                    $verified = 3;
                                    $verifytext = "afgekeurd";
                                } else if (in_array(0, $verifiedimages) || in_array(null, $verifiedimages) || empty($verifiedimages)) {
                                    $verified = 1;
                                    $verifytext = '';
                                } else {
                                    $verified = 2;
                                    $verifytext = 'goedgekeurd';
                                }

                                if (in_array(0, $verifiedimages) || in_array(null, $verifiedimages) || empty($verifiedimages)) {
                                    $verify = 0;
                                } else {
                                    $verify = 1;
                                }
                                $_SESSION['verified'] = $verified;
                                $_SESSION['verifytext'] = $verifytext;
                                ?>
                            </div>

                            <div style="clear: both;"></div>
                            <form id="form" action="?page=updatemail" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <br/>

                            <input disabled="disabled" type="hidden" name="id" value="<?= $myupload['id']; ?>">

                            <p> Omschrijving: <span style="color:#bc2d4c"><?= $myupload['beschrijving'] ?></span>
                            </p>

                            <br>
                            <br>

                            <label class="control-label" for="textinput" style="float:left;">Opmerking<span
                                    style="color:#bc2d4c">*</span></label>
                            <div class="col-md-4">
                                <input name="answer" class="form-control input-md" id="textinput" type="text"
                                       size="50">
                            </div><br /><br />

                        <input type="hidden" name="clientid" value="<?php if (isset($_SESSION['usr_id'])) {
                            echo $_SESSION['usr_id'];
                        } else {
                            echo $session->getUserId();
                        } ?>">
                        <input type="hidden" name="name" value="<?php if (isset($_SESSION['usr_id'])) {
                            echo $_SESSION['usr_name'];
                        } else {
                            echo $myupload['naam'];
                        } ?>">
                        <input type="hidden" name="title" value="<?= $myupload['onderwerp']; ?>">
                        <input type="hidden" name="verstuurder" value="<?= $myupload['verstuurder'] ?>">
                        <input type="hidden" name="UID" value="<?= $UID; ?>">

                        <div id="refer1">
                            <input type="hidden" id="totalverify" value="<?= $verify ?>">
                        </div>

                        <div id="verify" style="display: none" class="alert alert-info" role="alert"></div>

                        <input type="hidden" name="fromname" id="" value="Kevin Ernst">
                        <!--<input type="hidden" name="mailto" id="" value="kevin.herdershof@hotmail.com">-->


                            <br>
                            <label id="Voorwaarden">Ik heb de <a href="index.php?page=conditions" target="_blank"><span
                                        style="color:#bc2d4c">algemene voorwaarden</span></a> gelezen en ga hiermee
                                akkoord</label>
                            <input type="checkbox" name="yeahright" required>
                            <br><br>

                            <input type="submit" id="verstuuracc" name="submit" value="Verstuur">

                            <br><br>

                            <div id="refer">
                                <script>
                                    $("#form").submit(function (event) {
                                        if ($('#totalverify').val() == 1) {
                                            $("#verify").text("Alle afbeeldingen zijn beoordeeld!").show();
                                            return true;
                                        }

                                        $("#verify").text("Nog niet alle afbeeldingen zijn beoordeeld!").show().fadeOut(5000);
                                        event.preventDefault();
                                    });
                                </script>
                            </div>



                        <br>
                        <br>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
