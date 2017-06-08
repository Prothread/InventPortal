<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'assignment';

include '../app/view/addItemSetup.php';

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_ASSIGNMENT_CREATE ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_SUBJECT ?></label>
                <input type="text" class="form-control <?php if (isset($assignment_subject_error)) {
                    echo "error-input";
                } ?>" name="subject" value="<?php if ($post) {
                    echo $_POST['subject'];
                }; ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if (isset($_POST['create']) && $client['id'] == $_POST['client']) {
                            echo 'selected';
                        }
                        echo '>' . $client['naam'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_EMPLOYEE ?></label>
                <select class="form-control" name="userId">
                    <option value="0"><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if (isset($_POST['create']) && $user['id'] == $_POST['user']) {
                            echo 'selected';
                        }
                        echo '>' . $user['naam'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_PROJECT_ADD ?></label>
                <select class="form-control" name="projectId">
                    <option value="0"><?= TEXT_PROJECT_ADD ?></option>
                    <?php
                    foreach ($projects as $project) {
                        echo '<option value="' . $project['id'] . '"';
                        if (isset($_POST['create']) && $project['id'] == $_POST['projectId']) {
                            echo 'selected';
                        }
                        echo '>' . $project['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control" name="endDate" value="<?php if ($post) {
                    echo $_POST['endDate'];
                }; ?>" min="<?= date("Y-m-d") ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($assignment_description_error)) {
                    echo "error-input";
                } ?>"><?php if ($post) {
                        echo $_POST['description'];
                    }; ?></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="create" class="custom-file-upload"
                        onclick="getTasks()" id="addSubmit"><?= TEXT_CREATE_DROPDOWN ?></button>
            </div>
            <input type="hidden" name="defaultTasks" id="defaultTasks">
        </form>
    </div>
    <div class="add-right-content add-content">
        <h1 class="crm-content-header"><?= TEXT_ADD_TASKS ?></h1>
        <div class="crm-add">
            <div>
                <label><?= TEXT_TEMPLATE ?></label>
                <select id="templatelist">
                    <option value=0 selected> -</option>
                    <?php foreach ($templates as $template) { ?>
                        <option value="<?= $template['id'] ?>"> <?= $template['onderwerp'] ?> </option>
                    <?php } ?>
                </select>
            </div>
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
                <div id="taken-lijst">
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