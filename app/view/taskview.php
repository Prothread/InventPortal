<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'task';

include '../app/Model/viewSetup.php';

?>
    <div class="crm-content-view-wrapper-2">
    <div class="view-content">
        <h1 class="crm-content-header"><?= TASK_OVERVIEW ?></h1>
        <button id="thedeletebutton" class="custom-file-upload" data-toggle="modal"
                data-target="#myModal"> <?= TEXT_DELETE ?> </button>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if (isset($task_subject_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php
                       if ($post) {
                           echo $_POST['subject'];
                       } else {
                           echo $taskinfo['subject'];
                       }
                       ?>">

            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"<?php if ($taskinfo['client'] == 0) {
                        echo 'selected';
                    } ?> > <?= TEXT_ASSIGNFOR ?> </option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if ($post && $client['id'] == $_POST['client']) {
                            echo 'selected';
                        } elseif (!$post && $client['id'] == $taskinfo['client']) {
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
                    <option value="0"<?php if (isset($taskinfo['user']) && $taskinfo['user'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if ($post && $user['id'] == $_POST['userId']) {
                            echo 'selected';
                        } elseif (!$post && $user['id'] == $taskinfo['user']) {
                            echo 'selected';
                        }
                        echo '>' . $user['naam'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_PROJECT_ADD ?></label>
                <select class="form-control" name="project" id="projectSelect">
                    <option value="0"<?php if ($taskinfo['project'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_PROJECT_ADD ?></option>
                    <?php
                    foreach ($projects as $project) {
                        echo '<option value="' . $project['id'] . '"';
                        if ($post && $project['id'] == $_POST['project']) {
                            echo 'selected';
                        } elseif (!$post && $project['id'] == $taskinfo['project']) {
                            echo 'selected';
                        }
                        echo '>' . $project['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_ASSIGNMENT_ADD ?></label>
                <select class="form-control" name="assignment" id="assignmentSelect">
                    <option value="0"<?php if ($taskinfo['assignment'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_ASSIGNMENT_ADD ?></option>
                    <?php
                    foreach ($assignments as $assignment) {
                        echo '<option value="' . $assignment['id'] . '"';
                        if ($post && $assignment['id'] == $_POST['assignment']) {
                            echo 'selected';
                        } elseif (!$post && $assignment['id'] == $taskinfo['assignment']) {
                            echo 'selected';
                        }
                        echo '>' . $assignment['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_TENDER_ADD ?></label>
                <select class="form-control" name="tender" id="tenderSelect">
                    <option value="0"<?php if ($taskinfo['tender'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_TENDER_ADD ?></option>
                    <?php
                    foreach ($tenders as $tender) {
                        echo '<option value="' . $tender['id'] . '"';
                        if ($post && $tender['id'] == $_POST['tender']) {
                            echo 'selected';
                        } elseif (!$post && $tender['id'] == $taskinfo['tender']) {
                            echo 'selected';
                        }
                        echo '>' . $tender['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_CASE_ADD ?></label>
                <select class="form-control" name="cases" id="caseSelect">
                    <option value="0"<?php if ($taskinfo['cases'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_CASE_ADD ?></option>
                    <?php
                    foreach ($caseList as $case) {
                        echo '<option value="' . $case['id'] . '"';
                        if ($post && $case['id'] == $_POST['cases']) {
                            echo 'selected';
                        } elseif (!$post && $case['id'] == $taskinfo['cases']) {
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
                    <?php if ($post == true && $_POST['urgency'] == 0 || $post != true && $taskinfo['urgency'] == 0) { ?>
                        <option value="0" selected>-</option>
                    <?php } else { ?>
                        <option value="0">-</option>
                    <?php } ?>
                    <?php if ($post == true && $_POST['urgency'] == 1 || $post != true && $taskinfo['urgency'] == 1) { ?>
                        <option value="1" selected><?= URGENCY_1 ?></option>
                    <?php } else { ?>
                        <option value="1"><?= URGENCY_1 ?></option>
                    <?php } ?>
                    <?php if ($post == true && $_POST['urgency'] == 2 || $post != true && $taskinfo['urgency'] == 2) { ?>
                        <option value="2" selected><?= URGENCY_2 ?></option>
                    <?php } else { ?>
                        <option value="2"><?= URGENCY_2 ?></option>
                    <?php } ?>
                    <?php if ($post == true && $_POST['urgency'] == 3 || $post != true && $taskinfo['urgency'] == 3) { ?>
                        <option value="3" selected><?= URGENCY_3 ?></option>
                    <?php } else { ?>
                        <option value="3"><?= URGENCY_3 ?></option>
                    <?php } ?>
                    <?php if ($post == true && $_POST['urgency'] == 4 || $post != true && $taskinfo['urgency'] == 4) { ?>
                        <option value="4" selected><?= URGENCY_4 ?></option>
                    <?php } else { ?>
                        <option value="4"><?= URGENCY_4 ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_DURATION ?></label>
                <input type="number" class="form-control <?php if (isset($task_duration_error)) {
                    echo "error-input";
                } ?>" name="duration" min="0" value="<?php if ($post == true) {
                    echo $_POST['duration'];
                } else {
                    echo $taskinfo['duration'];
                } ?>">
            </div>

            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control <?php if (isset($task_endDate_error)) {
                    echo "error-input";
                } ?>" name="endDate" value="<?php if ($post == true) {
                    echo $_POST['endDate'];
                } else {
                    echo $taskinfo['endDate'];
                } ?>">
                <br>
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($task_description_error)) {
                    echo "error-input";
                } ?>"><?php if ($post == true) {
                        echo $_POST['description'];
                    } else {
                        echo $taskinfo['description'];
                    } ?></textarea>

            </div>
            <div class="button-update">
                <div class="button-push"></div>
                <button type="submit" name="update"
                        class="custom-file-upload"><?= TEXT_EDIT ?></button>
            </div>
        </form>
    </div>
</div>
<?php
include '../app/Model/viewColumns.php';
include '../app/view/parentCheckerScript.php';
?>