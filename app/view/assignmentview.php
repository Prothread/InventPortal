<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'assignment';

include '../app/Model/viewSetup.php';

?>
<div class="crm-content-view-wrapper">
    <div class="view-content">
        <h1 class="crm-content-header"><?= TEXT_ASSIGNMENT_VIEW ?></h1>
        <button id="thedeletebutton" class="custom-file-upload" data-toggle="modal" data-target="#myModal"> <?= TEXT_DELETE ?> </button>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_SUBJECT ?></label>
                <input type="text" class="form-control <?php if (isset($assignment_subject_error)) {
                    echo "error-input";
                } ?>" name="subject" value="<?php
                if ($post) {
                    echo $_POST['subject'];
                } else {
                    echo $assignmentinfo['subject'];
                }
                ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"<?php if ($assignmentinfo['client'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if ($post && $client['id'] == $_POST['client']) {
                            echo 'selected';
                        } elseif (!$post && $client['id'] == $assignmentinfo['client']) {
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
                    <option value="0"<?php if (isset($assignmentinfo['user']) && $assignmentinfo['user'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if ($post && $user['id'] == $_POST['userId']) {
                            echo 'selected';
                        } elseif (!$post && $user['id'] == $assignmentinfo['user']) {
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
                        if ($post && $project['id'] == $_POST['projectId']) {
                            echo 'selected';
                        } elseif (!$post && $project['id'] == $assignmentinfo['project']) {
                            echo 'selected';
                        }
                        echo '>' . $project['subject'] . '</option>';
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
                    echo $assignmentinfo['endDate'];
                }
                ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($assignment_description_error)) {
                    echo "error-input";
                } ?>"><?php
                    if ($post) {
                        echo $_POST['description'];
                    } else {
                        echo $assignmentinfo['description'];
                    }
                    ?></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="update" class="custom-file-upload"><?= TEXT_EDIT ?></button>
            </div>
        </form>
    </div>
</div>
<?php
include '../app/Model/viewColumns.php';
?>