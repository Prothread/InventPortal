<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'task';

include '../app/view/addItemSetup.php';

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_TASK_CREATE ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if (isset($title_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php if (isset($_POST['subject'])) {
                           echo $_POST['subject'];
                       } ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control <?php if (isset($client_error)) {
                    echo "error-input";
                } ?>" name="client">
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
                <select class="form-control" name="user">
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
                <select class="form-control" name="project">
                    <option value="0"><?= TEXT_PROJECT_ADD ?></option>
                    <?php
                    foreach ($projects as $project) {
                        echo '<option value="' . $project['id'] . '"';
                        if (isset($_POST['create']) && $project['id'] == $_POST['project']) {
                            echo 'selected';
                        }
                        echo '>' . $project['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_ASSIGNMENT_ADD ?></label>
                <select class="form-control" name="assignment">
                    <option value="0"><?= TEXT_ASSIGNMENT_ADD ?></option>
                    <?php
                    foreach ($assignments as $assignment) {
                        echo '<option value="' . $assignment['id'] . '"';
                        if (isset($_POST['create']) && $assignment['id'] == $_POST['assignment']) {
                            echo 'selected';
                        }
                        echo '>' . $assignment['subject'] . '</option>';
                    }
                    ?>
                    <?php
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_TENDER_ADD ?></label>
                <select class="form-control" name="tender">
                    <option value="0"><?= TEXT_TENDER_ADD ?></option>
                    <?php
                    foreach ($tenders as $tender) {
                        echo '<option value="' . $tender['id'] . '"';
                        if (isset($_POST['create']) && $tender['id'] == $_POST['tender']) {
                            echo 'selected';
                        }
                        echo '>' . $tender['subject'] . '</option>';
                    }
                    ?>
                    <?php
                    ?>
                </select>
            </div>


            <div>
                <label><?= TEXT_CASE_ADD ?></label>
                <select class="form-control" name="case">
                    <option value="0"><?= TEXT_CASE_ADD ?></option>
                    <?php
                    foreach ($cases as $case) {
                        echo '<option value="' . $case['id'] . '"';
                        if (isset($_POST['create']) && $case['id'] == $_POST['case']) {
                            echo 'selected';
                        }
                        echo '>' . $case['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_URGENCY ?></label>
                <select class="form-control" name="urgency">
                    <option value="0">-</option>
                    <option value="1"<?php if (isset($_POST['urgency']) && $_POST['urgency'] == 1) {
                        echo 'selected';
                    } ?>><?= URGENCY_1 ?></option>
                    <option value="2"<?php if (isset($_POST['urgency']) && $_POST['urgency'] == 2) {
                        echo 'selected';
                    } ?>><?= URGENCY_2 ?></option>
                    <option value="3"<?php if (isset($_POST['urgency']) && $_POST['urgency'] == 3) {
                        echo 'selected';
                    } ?>><?= URGENCY_3 ?></option>
                    <option value="4"<?php if (isset($_POST['urgency']) && $_POST['urgency'] == 4) {
                        echo 'selected';
                    } ?>><?= URGENCY_4 ?></option>
                </select>
            </div>

            <div>
                <label><?= TEXT_DURATION ?></label>
                <input type="number" class="form-control <?php if (isset($value_error)) {
                    echo "error-input";
                } ?>" name="duration" value="<?php if (isset($_POST['duration'])) {
                    echo $_POST['duration'];
                } ?>" min="0">
            </div>

            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control <?php if (isset($creationDate_error)) {
                    echo "error-input";
                } ?>" name="endDate"
                       value="<?php if (isset($_POST['endDate'])) {
                           echo $_POST['endDate'];
                       } else {
                           echo date("d-m-y");
                       } ?>" min="<?= date("Y-m-d") ?>">
            </div>

            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($description_error)) {
                    echo "error-input";
                } ?>"><?php if (isset($_POST['description'])) {
                        echo $_POST['description'];
                    } ?></textarea>
            </div>

            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="create"
                        class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
            </div>
        </form>
    </div>
</div>
