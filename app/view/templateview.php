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
            <form action="#" method="post">
                <button type="submit" name="delete" id="deletebtn"
                        class="custom-file-upload"><?= TEXT_DELETE ?></button>
            </form>

            <form class="crm-add" action="#" method="post">
                <div>
                    <label><?= TABLE_TITLE ?></label>
                    <input type="text" name="subject" class="form-control <?php if (isset($template_subject_error)) {
                        echo "error-input";
                    } ?>"
                           value="<?php if(isset($_POST['subject'])){echo $_POST['subject'];}else{echo $templateinfo['subject'];} ?>">

                </div>

                <div class="description-holder">
                    <label><?= TEXT_DESCRIPTION ?></label>
                    <textarea name="description" class="<?php if (isset($template_description_error)) {
                        echo "error-input";
                    } ?>"><?php if(isset($_POST['description'])){echo $_POST['description'];}else{echo $templateinfo['description'];} ?></textarea>

                </div>

                <div class="button-update">
                    <div class="button-push"></div>
                    <button type="submit" name="update"
                            class="custom-file-upload" onclick="ez()"><?= TEXT_EDIT ?></button>
                </div>

                <input type="hidden" name="defaultTasks" id="defaultTasks">
            </form>
        </div>

        <div class="add-right-content add-content">
            <div class="crm-add">
                <br>
                <br>
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