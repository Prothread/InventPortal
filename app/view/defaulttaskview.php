<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'default';

include '../app/Model/viewSetup.php';

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_DEFAULT_TASK_VIEW ?></h1>
        <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') == 1){?>
        <button id="thedeletebutton" class="custom-file-upload" data-toggle="modal"
                data-target="#myModal"> <?= TEXT_DELETE ?> </button>
        <?php }?>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if (isset($default_subject_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php if (isset($_POST['update'])) {
                           echo $_POST['subject'];
                       } else {
                           echo $taskinfo['subject'];
                       } ?>"
                    <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') != 1){echo 'readonly';}?>
                >

            </div>

            <div>
                <div>
                    <label><?= TEXT_DURATION ?></label>
                    <input type="number" class="form-control <?php if (isset($default_duration_error)) {
                        echo "error-input";
                    } ?>" name="duration" min="0"
                           value="<?php if (isset($_POST['update'])) {
                               echo $_POST['duration'];
                           } else {
                               echo $taskinfo['duration'];
                           } ?>"
                        <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') != 1){echo 'readonly';}?>
                    >
                </div>

                <div class="description-holder">
                    <label><?= TEXT_DESCRIPTION ?></label>
                    <textarea name="description" class="<?php if (isset($default_description_error)) {
                        echo "error-input";
                    } ?>"
                        <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') != 1){echo 'readonly';}?>
                    ><?php if (isset($_POST['update'])) {
                            echo $_POST['description'];
                        } else {
                            echo $taskinfo['description'];
                        } ?></textarea>

                </div>

                <div class="button-update">
                    <div class="button-push"></div>
                    <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') == 1){?>
                    <button type="submit" name="update"
                            class="custom-file-upload"><?= TEXT_EDIT ?></button>
                    <?php }?>
                </div>
        </form>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" id="deleteform">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php
                    if($canDelete){
                        echo TEXT_CONFIRM_DELETE;
                    }else{
                        echo TEXT_DEFAULT_LINKED;
                    } ?></h4>
            </div>
            <div class="modal-body">
                <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') == 1){?>
                <form action="#" method="post" class="form-horizontal">
                    <?php if($canDelete) { ?>
                        <fieldset>
                            <form action="#" method="post">
                                <button name="delete" type="submit" id="btndelete"
                                        class="custom-file-upload" data-toggle="modal"
                                        data-target="#myModal"> <?= TEXT_DELETE ?> </button>
                            </form>
                        </fieldset>
                        <?php
                    }else{
                    ?>
                        <div id="cantDeleteHolder">
                            <button id="delete-button" name="deleteform" class="custom-file-upload" data-toggle="modal"
                                    data-target="#myModal"><?= TEXT_OK ?></button>
                        </div>
                    <?php
                    }
                    ?>
                </form>
                <?php }?>
            </div>
        </div>
    </div>
</div>