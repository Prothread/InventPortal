<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'tender';

include '../app/Model/viewSetup.php';

?>
<div class="crm-content-view-wrapper">
    <div class="view-content">
        <h1 class="crm-content-header"><?= TENDER_OVERVIEW ?><?php if (isset($finished)) {echo TEXT_HEADER_FINISHED;}elseif (isset($deleted)){echo TEXT_HEADER_DELETED;}; ?></h1>
        <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') == 1){?>
        <button id="thedeletebutton" class="custom-file-upload" data-toggle="modal"
                data-target="#myModal"> <?= TEXT_DELETE ?> </button>
        <?php }?>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if (isset($tender_subject_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php
                       if ($post) {
                           echo $_POST['subject'];
                       } else {
                           echo $tenderinfo['subject'];
                       }
                       ?>"
                    <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                >
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control <?php if (isset($tender_client_error)) {
                    echo "error-input";
                } ?>" name="client"
                    <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                >
                    <option value="0"<?php if ($tenderinfo['client'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if ($post && $client['id'] == $_POST['client']) {
                            echo 'selected';
                        } elseif (!$post && $client['id'] == $tenderinfo['client']) {
                            echo 'selected';
                        }
                        echo '>' . $client['naam'] . '</option>';
                    }
                    ?>
                </select>

            </div>
            <div>
                <label><?= TEXT_EMPLOYEE ?></label>
                <select class="form-control" name="userId" <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>>
                    <option value="0"<?php if (isset($tenderinfo['user']) && $tenderinfo['user'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $u) {
                        echo '<option value="' . $u['id'] . '"';
                        if ($post && $u['id'] == $_POST['userId']) {
                            echo 'selected';
                        } elseif (!$post && $u['id'] == $tenderinfo['user']) {
                            echo 'selected';
                        }
                        echo '>' . $u['naam'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_VALIDITY_DURATION ?></label>
                <input type="number" class="form-control <?php if (isset($vadility_error)) {
                    echo "error-input";
                } ?>" name="validity" min="1" max="7500" value="<?php
                if ($post) {
                    echo $_POST['validity'];
                } else {
                    echo $tenderinfo['validity'];
                }
                ?>" <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>>
            </div>
            <div>
                <label><?= TEXT_VALUE ?></label>
                <input type="number" class="form-control <?php if (isset($value_error)) {
                    echo "error-input";
                } ?>" name="value" min="0" value="<?php
                if ($post) {
                    echo $_POST['value'];
                } else {
                    echo $tenderinfo['value'];
                }
                ?>"
                    <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                >

            </div>
            <div>
                <label><?= TEXT_CHANCE ?></label>
                <input type="number" class="form-control" name="chance" max="100" min="0"
                       value="<?php
                       if ($post) {
                           echo $_POST['chance'];
                       } else {
                           echo $tenderinfo['chance'];
                       }
                       ?>"
                    <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                >
            </div>
            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="text" class="form-control" name="endDate" readonly
                       value="<?php
                       if (isset($endDate)) {
                           echo date("d-m-Y", strtotime($endDate));
                       } else {
                           echo date("d-m-Y", strtotime($tenderinfo['endDate']));
                       }
                       ?>"
                    <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                >
                <br>
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($tender_description_error)) {
                    echo "error-input";
                } ?>"
                    <?php  if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){echo 'readonly';}?>
                ><?php
                    if ($post) {
                        echo $_POST['description'];
                    } else {
                        echo $tenderinfo['description'];
                    }
                    ?></textarea>

            </div>
            <?php
            if($user->getPermission($permgroup, 'CAN_EDIT_CRM') == 1){
            if (!isset($finished) && !isset($deleted)) {
            ?>
            <div class="button-update">
                <div class="button-push"></div>
                    <button type="submit" name="update"
                            class="custom-file-upload"><?= TEXT_EDIT ?></button>
            </div>
                <?php
            }
}
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

