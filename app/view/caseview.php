<?php

$type = 'case';

include '../app/Model/viewSetup.php';

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_CASE_VIEW ?></h1>
        <form action="#" method="post">
            <button type="submit" name="delete" id="deletebtn"
                    class="custom-file-upload"><?= TEXT_DELETE ?></button>
        </form>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_SUBJECT ?></label>
                <input type="text" class="form-control <?php if (isset($subject_error)) {
                    echo "error-input";
                } ?>" name="subject" value="<?php
                if ($post) {
                    echo $_POST['subject'];
                } else {
                    echo $caseinfo['subject'];
                }
                ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"<?php if ($caseinfo['client'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if ($post && $client['id'] == $_POST['client']) {
                            echo 'selected';
                        } elseif (!$post && $client['id'] == $caseinfo['client']) {
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
                    <option value="0"<?php if ($caseinfo['user'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if ($post && $user['id'] == $_POST['user']) {
                            echo 'selected';
                        } elseif (!$post && $user['id'] == $caseinfo['user']) {
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
                    <option value="0"<?php if ($caseinfo['project'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_PROJECT_ADD ?></option>
                    <?php
                    foreach ($projects as $project){
                        echo '<option value="' . $project['id'] . '"';
                        if ($post && $project['id'] == $_POST['projectId']) {
                            echo 'selected';
                        } elseif (!$post && $project['id'] == $caseinfo['project']) {
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
                        if ($post && $assignment['id'] == $_POST['assignment']) {
                            echo 'selected';
                        } elseif (!$post && $assignment['id'] == $caseinfo['assignment']) {
                            echo 'selected';
                        }
                        echo '>' . $assignment['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control" name="endDate" value="<?php
                if ($post) {
                    echo $_POST['endDate'];
                } else {
                    echo $caseinfo['enddate'];
                }
                ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($description_error)) {
                    echo "error-input";
                } ?>"><?php
                    if ($post) {
                        echo $_POST['description'];
                    } else {
                        echo $caseinfo['description'];
                    }
                    ?></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="update" class="custom-file-upload"><?= TEXT_EDIT ?></button>
            </div>
        </form>
    </div>
