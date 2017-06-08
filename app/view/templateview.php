<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'template';

include '../app/Model/viewSetup.php';

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEMPLATE_VIEW ?></h1>
        <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') == 1){?>
        <button id="thedeletebutton" class="custom-file-upload" data-toggle="modal"
                data-target="#myModal"> <?= TEXT_DELETE ?> </button>
<?php }?>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if (isset($template_subject_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php if (isset($_POST['subject'])) {
                           echo $_POST['subject'];
                       } else {
                           echo $templateinfo['subject'];
                       } ?>"
                    <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') != 1){echo 'readonly';}?>
                >

            </div>

            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($template_description_error)) {
                    echo "error-input";
                } ?>"
                    <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') != 1){echo 'readonly';}?>
                ><?php if (isset($_POST['description'])) {
                        echo $_POST['description'];
                    } else {
                        echo $templateinfo['description'];
                    } ?></textarea>

            </div>

            <div class="button-update">
                <div class="button-push"></div>
                <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') == 1){?>
                <button type="submit" name="update"
                        class="custom-file-upload" onclick="getTasks()"><?= TEXT_EDIT ?></button>
                <?php }?>
            </div>
            <input type="hidden" name="defaultTasks" id="defaultTasks">
        </form>
    </div>

    <div class="add-right-content add-content">
        <div class="crm-add">
            <br>
            <br>
            <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') == 1){?>
            <div>
                <label><?= TEXT_TASK_ADD ?></label>
                <select id="tasklist">
                    <option value=0 selected> -</option>
                    <?php foreach ($defaultTask as $task) { ?>
                        <option value="<?= $task['id'] ?>"> <?= $task['subject'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <?php }?>
            <div>
                <label><?= TEXT_TASK_OVERVIEW ?></label>
                <div id="taken-lijst" class="<?php if (isset($template_task_error)) {
                    echo "error-input";
                } ?>">
                    <ul id="sortable">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../app/view/taskListScript.php';
?>
<div class="modal fade" id="myModal" role="dialog">
    <?php if($user->getPermission($permgroup, 'CAN_EDIT_TEMPLATES') == 1){?>
    <div class="modal-dialog" id="deleteform">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php
                    echo TEXT_CONFIRM_DELETE;
                    ?></h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post" class="form-horizontal">
                    <fieldset>
                        <form action="#" method="post">
                            <button name="delete" type="submit" id="btndelete"
                                    class="custom-file-upload" data-toggle="modal"
                                    data-target="#myModal"> <?= TEXT_DELETE ?> </button>
                        </form>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <?php }?>
</div>
