<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'template';

include '../app/view/addItemSetup.php';

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_TEMPLATE_CREATE ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" class="form-control <?php if (isset($template_subject_error)) {
                    echo "error-input";
                } ?>" name="subject" value="<?php if ($post){echo $_POST['subject'];}?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($template_description_error)) {
                    echo "error-input";
                } ?>" ><?php if ($post){echo $_POST['description'];}?></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="create" class="custom-file-upload" onclick="getTasks()" id="addSubmit"><?= TEXT_CREATE_DROPDOWN ?></button>
            </div>
            <input type="hidden" name="defaultTasks" id="defaultTasks">
        </form>
    </div>
    <div class="add-right-content add-content">
        <h1 class="crm-content-header"><?= TEXT_ADD_TASKS ?></h1>
        <div class="crm-add">
            <div>
                <label><?= TEXT_TASK_ADD ?></label>
                <select id="tasklist">
                    <option value=0 selected> -</option>
                    <?php foreach ($defaultTask as $task) { ?>
                        <option value="<?= $task['id'] ?>"> <?= $task['subject'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_TASK_OVERVIEW ?></label>
                <div id="taken-lijst" class="input-border <?php if(isset($template_defaultTasks_error)){echo 'error-input';} ?>">
                    <ul id="sortable">

                    </ul>
                </div>
            </div>
        </div>
        <div id="submitSpace"></div>
        <label for="addSubmit" class="custom-file-upload" id="hiddenSubmit"><?= TEXT_CREATE_DROPDOWN ?></label>
    </div>
</div>

<?php
include '../app/view/taskListScript.php';