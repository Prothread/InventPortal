<?php
#SETTINGS PAGE

if ($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText"><?= TEXT_SETTINGS ?></p>
                <br>
                <br>
                <p class="ClientFormText"><?= TEXT_EMAIL_TRAFFIC ?></p>
                <hr size="1">
                <form method="post" enctype="multipart/form-data" class="form-horizontal" action="?page=settingsupload">

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= SMTP_ADRES ?></label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="text"
                                   name="smtp" size="50" value="<?= $admin['SMTP'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= SMTP_PORT ?></label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="text"
                                   name="smtpport" size="50" value="<?= $admin['SMTPport'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= TEXT_EMAIL ?></label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="text"
                                   name="email" size="50" value="<?= $admin['Email'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= TEXT_EMAIL_PASS ?></label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="password"
                                   name="emailpassword" size="50" value="<?= $admin['Mailpass'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= WEBSITE_HOST ?></label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="text"
                                   name="host" size="50" value="<?= $admin['Host'] ?>"
                                   placeholder="http://www.madalcomedia.com">
                            <span style="font-size:16px;">*<?= TEXT_WEBSITE_URL ?></span>
                        </div>
                    </div>

                    <br />
                    <br />

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= TEXT_GLOBAL_MAIL ?></label>
                        <div class="col-md-4">
                            <input type="checkbox" name="checker" style="width: 31px; height: 33px; float: left;" id="isGlobalMail" onclick="checkStatus()" <?php if($admin['globalmail']){ echo 'checked'; } ?>>
                            <div id="Globalmail">
                                <input class="form-control input-md" id="textinput" maxlength="64" required type="email" name="globalmail" value="<?= $admin['contactmail'] ?>" placeholder="http://www.madalcomedia.com">
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            if (document.getElementById('isGlobalMail').checked) {
                                $("#Globalmail").show();
                            } else {
                                $("#Globalmail").hide();
                            }
                        });
                        function checkStatus() {
                            if (document.getElementById('isGlobalMail').checked) {
                                $("#Globalmail").show();
                            } else {
                                $("#Globalmail").hide();
                            }
                        }
                    </script>

                    <br>


                    <p class="ClientFormText"><?= TEXT_STYLE_SETTINGS ?></p>
                    <hr size="1">

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= TEXT_HEADER_LOGO ?></label>
                        <div class="col-md-4">
                            <label for="file-upload" class="custom-file-upload">
                                <i class="fa fa-cloud-upload"></i> <?= BUTTON_UPLOAD ?>
                            </label>
                            <input type="file" name="fileToUpload" class="imgInp btn btn-primary btn-success"
                                   id="file-upload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= TEXT_SELECTED_LOGO ?></label>
                        <div class="col-md-4">
                            <div id="fileList"></div>

                            <output id="list"></output>
                        </div>
                    </div>
                    <br />

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= TEXT_BACKGROUND_COLOR_HEADER ?></label>
                        <div class="col-md-4">
                            <input class="form-control input-md" id="textinput" maxlength="64" required type="text"
                                   name="headerkleur" size="50" value="<?= $admin['Header'] ?>"
                                   placeholder="#dd2c4c/rgb(..,..,..)">
                        </div>
                    </div>
                    <br />

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= TEXT_LOGIN_BACKGROUND ?></label>
                        <div class="col-md-4">
                            <label for="file-upload1" class="custom-file-upload">
                                <i class="fa fa-cloud-upload"></i> <?= BUTTON_UPLOAD ?>
                            </label>
                            <input type="file" name="fileToUpload1" class="imgInp1 btn btn-primary btn-success"
                                   id="file-upload1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"><?= TEXT_SELECTED_LOGO ?></label>
                        <div class="col-md-4">
                            <div id="fileList1"></div>

                            <output id="list1"></output>
                        </div>
                    </div>

                    <br />
                    <br />
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput"></label>
                        <div class="col-md-4">
                            <input class="btn btn-primary btn-success" name="submit"
                                   style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #bb2c4c"
                                   type="submit" value="<?= BUTTON_SAVE ?>">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
