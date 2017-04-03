<?php

$userController = new UserController();
$users = $userController->getUserList();

$thisUserId = $_SESSION['usr_id'];

$typeId = $_GET['typeId'];
$type = $_GET['type'];

?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Werknemer toewijzen aan <?=$_GET['subject']?></h4>
            </div>
            <div class="modal-body">
                <br>

                <form action="?page=queue&type=<?=$type?>&typeId=<?=$typeId?>" method="post" enctype="multipart/form-data"
                      class="form-horizontal">
                    <fieldset>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Werknemers</label>
                            <div class="col-md-4">

                                <?php if ($users !== null || !empty($users)) { ?>
                                    <select class="form-control" name="theUser">

                                        <?php foreach ($users as $user) { ?>
                                            <?php if($user['id'] == $thisUserId) {?>
                                                <option class="form-control input-md" selected
                                                        value="<?= $user['id'] ?>"><?= $user['naam'] ?></option>
                                            <?php } else{ ?>
                                                <option class="form-control input-md"
                                                        value="<?= $user['id'] ?>"><?= $user['naam'] ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                                <?= $type?>
                                <?= $typeId ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"></label>
                            <div class="col-md-4">
                                <input class="btn btn-primary btn-success" type="submit" name="assign"
                                       style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c"
                                        value="Toewijzen">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="Sure" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Weet u zeker dat u dit item wilt verwijderen?</h4>
            </div>
            <div class="modal-body">
                <br>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>