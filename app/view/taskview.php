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
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TASK_OVERVIEW ?></h1>
        <form action="#" method="post">
            <button type="submit" name="delete" id="deletebtn"
                    class="custom-file-upload"><?= TEXT_DELETE ?></button>
        </form>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if(isset($title_error)){echo "error-input";} ?>"
                       value="<?= $taskinfo['subject'] ?>">

            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"<?php if ($taskinfo['client'] == 0) {echo 'selected';} ?> > <?= TEXT_ASSIGNFOR ?> </option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if ($client['id'] == $taskinfo['client']) {
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
                    <option value="0"<?php if ($taskinfo['user'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if ($user['id'] == $taskinfo['user']) {
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
                    <option value="0"<?php if ($taskinfo['project'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_PROJECT_ADD ?></option>
                    <?php
                    foreach ($projects as $project) {
                        echo '<option value="' . $project['id'] . '"';
                        if ($project['id'] == $taskinfo['project']) {
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
                    <option value="0"<?php if ($taskinfo['assignment'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_ASSIGNMENT_ADD ?></option>
                    <?php
                    foreach ($assignments as $assignment) {
                        echo '<option value="' . $assignment['id'] . '"';
                        if ($assignment['id'] == $taskinfo['assignment']) {
                            echo 'selected';
                        }
                        echo '>' . $assignment['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_TENDER_ADD ?></label>
                <select class="form-control" name="tender">
                    <option value="0"<?php if ($taskinfo['tender'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_TENDER_ADD ?></option>
                    <?php
                    foreach ($tenders as $tender) {
                        echo '<option value="' . $tender['id'] . '"';
                        if ($tender['id'] == $taskinfo['tender']) {
                            echo 'selected';
                        }
                        echo '>' . $tender['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_CASE_ADD ?></label>
                <select class="form-control" name="case">
                    <option value="0"<?php if ($taskinfo['cases'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_CASE_ADD ?></option>
                    <?php
                    foreach ($cases as $case) {
                        echo '<option value="' . $case['id'] . '"';
                        if ($case['id'] == $taskinfo['cases']) {
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
                    <?php if($taskinfo['urgency'] == 0){ ?>
                        <option value="0" selected>-</option>
                    <?php } else{ ?>
                        <option value="0">-</option>
                    <?php } ?>
                    <?php if($taskinfo['urgency'] == 1){ ?>
                        <option value="1" selected><?= URGENCY_1 ?></option>
                    <?php } else{ ?>
                        <option value="1"><?= URGENCY_1 ?></option>
                    <?php } ?>
                    <?php if($taskinfo['urgency'] == 2){ ?>
                        <option value="2" selected><?= URGENCY_2 ?></option>
                    <?php } else{ ?>
                        <option value="2"><?= URGENCY_2 ?></option>
                    <?php } ?>
                    <?php if($taskinfo['urgency'] == 3){ ?>
                        <option value="3" selected><?= URGENCY_3 ?></option>
                    <?php } else{ ?>
                        <option value="3"><?= URGENCY_3 ?></option>
                    <?php } ?>
                    <?php if($taskinfo['urgency'] == 4){ ?>
                        <option value="4" selected><?= URGENCY_4 ?></option>
                    <?php } else{ ?>
                        <option value="4"><?= URGENCY_4 ?></option>
                    <?php } ?>
                </select>
            </div>
             <div>
                    <label><?= TEXT_DURATION ?></label>
                    <input type="number" class="form-control" name="duration" min="0" value="<?= $taskinfo['duration'] ?>">
                </div>

                <div>
                    <label><?= TEXT_END_DATE ?></label>
                    <input type="date" class="form-control <?php if(isset($enddate_error)){echo "error-input";} ?>" name="enddate" value="<?= $taskinfo['endDate'] ?>"
                    <br>
                </div>
                <div class="description-holder">
                    <label><?= TEXT_DESCRIPTION ?></label>
                    <textarea name="description" class="<?php if (isset($description_error)) {echo "error-input";} ?>"><?= $taskinfo['description'] ?></textarea>

                </div>
                <div class="button-update">
                    <div class="button-push"></div>
                    <button type="submit" name="updateTask"
                            class="custom-file-upload"><?= TEXT_EDIT ?></button>
                </div>
        </form>
    </div>