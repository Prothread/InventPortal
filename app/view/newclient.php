<?php
#PAGE FOR CREATING CLIENTS

if ($user->getPermission($permgroup, 'CAN_CREATE_CLIENT') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText"><?= TEXT_NEWCLIENT ?></p>
                <br>

                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="createclient">
                    <fieldset>

                        <p class="ClientFormText"><?= TEXT_NAMES ?></p>
                        <hr size="1">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_NAME ?><span
                                    style="color:#dd2c4c">*</span></label>
                            <div class="col-md-4">
                                <input required class="form-control input-md" maxlength="60" id="textinput" type="text"
                                       name="name" size="50" placeholder="<?= TEXT_NAME ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_COMPANY_NAME ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="64" type="text"
                                       name="companyname" size="50" placeholder="<?= TEXT_COMPANY_NAME ?>">
                            </div>
                        </div>

                        <p class="ClientFormText"><?= TEXT_CONTACT_DETAILS ?></p>
                        <hr size="1">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_EMAIL ?><span
                                    style="color:#dd2c4c">*</span></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="60" required type="email"
                                       name="email" size="50" placeholder="<?= TEXT_EMAIL ?>">
                            </div>
                        </div>

                        <br/>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_ALTERNATIVE_EMAIL ?></label>
                            <div class="col-md-4">
                                <span style="font-size:15px"><?= TEXT_ALTERNATIVE_EMAIL_INFO ?></span>
                                <input class="form-control input-md" id="textinput" maxlength="60" type="email"
                                       name="altmail" placeholder="<?= TEXT_EMAIL ?>">
                            </div>
                        </div>
                        <br/>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_ADRESS ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="64" type="text"
                                       name="companyadress" size="50" placeholder="<?= TEXT_ADRESS ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_POSTALCODE ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="8" type="text"
                                       name="postcode" size="50" placeholder="<?= TEXT_POSTALCODE ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?= TEXT_CITY ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="textinput" maxlength="64" type="text"
                                       name="plaats" size="50" placeholder="<?= TEXT_CITY ?>">
                            </div>
                        </div>

                        <?php if($user->getPermission($permgroup, 'CAN_CHANGE_USER_LANGUAGE')) {?>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput"><?= TEXT_LANGUAGE ?></label>
                                <div class="col-md-4">
                                    <select class="form-control" name="taal" required>
                                            <option value="en">English</option>
                                            <option value="nl">Nederlands</option>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                        <input type="hidden" name="rechten" value="1" readonly>

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
        </div>
    </div>
</div>

