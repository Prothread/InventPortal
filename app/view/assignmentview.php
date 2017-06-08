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
            <h1 class="crm-content-header"><?= TEXT_ASSIGNMENT_VIEW ?><?php if (isset($finished)) {
                    echo TEXT_HEADER_FINISHED;
                }elseif (isset($deleted)){echo TEXT_HEADER_DELETED;}; ?></h1>
<?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') == 1){?>
            <button id="thedeletebutton" class="custom-file-upload" data-toggle="modal"
                    data-target="#myModal"> <?= TEXT_DELETE ?> </button>
<?php }?>
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
                    ?>"
                        <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                    >
                </div>
                <div>
                    <label><?= TEXT_ASSIGNFOR ?></label>
                    <select class="form-control" name="client"
                        <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                    >
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
                    <select class="form-control" name="userId"
                        <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                    >
                        <option value="0"<?php if (isset($assignmentinfo['user']) && $assignmentinfo['user'] == 0) {
                            echo 'selected';
                        } ?>><?= TEXT_EMPLOYEE ?></option>
                        <?php
                        foreach ($users as $u) {
                            echo '<option value="' . $u['id'] . '"';
                            if ($post && $u['id'] == $_POST['userId']) {
                                echo 'selected';
                            } elseif (!$post && $u['id'] == $assignmentinfo['user']) {
                                echo 'selected';
                            }
                            echo '>' . $u['naam'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label><?= TEXT_PROJECT_ADD ?></label>
                    <select class="form-control" name="projectId"
                        <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                    >
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
                    ?>"
                        <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                    >
                </div>
                <div class="description-holder">
                    <label><?= TEXT_DESCRIPTION ?></label>
                    <textarea name="description" class="<?php if (isset($assignment_description_error)) {
                        echo "error-input";
                    } ?>"
                        <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                    ><?php
                        if ($post) {
                            echo $_POST['description'];
                        } else {
                            echo $assignmentinfo['description'];
                        }
                        ?></textarea>
                </div>
                <?php
if($user->getPermission($permgroup, 'CAN_EDIT_CRM') == 1){
                if (!isset($finished) && !isset($deleted)) {
                ?>
                <div class="button-holder">
                    <div class="button-push"></div>
                        <button type="submit" name="update" class="custom-file-upload"><?= TEXT_EDIT ?></button>
                </div>
                    <?php
                }}
                ?>
            </form>
<?php if($user->getPermission($permgroup, 'CAN_EDIT_CRM') == 1){?>
            <div id="finish-holder">
                <div class="button-push"></div>
                <?php
                if (!isset($finished) && !isset($deleted)) {
                    ?>
                    <button id="finish-button" name="finish" class="custom-file-upload" data-toggle="modal"
                            data-target="#myModal"><?= TEXT_FINISH ?></button>
                    <?php
                } else {
                    ?>
                    <form action="#" method="post">
                        <button id="revert-button" name="revert" class="custom-file-upload"><?= TEXT_REVERT ?></button>
                    </form>
                    <?php
                }
                ?>
            </div>
<?php }?>
        </div>
    </div>
<?php
include '../app/Model/viewColumns.php';
?>