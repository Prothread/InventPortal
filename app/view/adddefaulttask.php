<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'default';

include '../app/view/addItemSetup.php';

?>

<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_DEFAULTTASK_CREATE ?></h1>
        <form class="crm-add" action="#" method="post">

            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if (isset($default_subject_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php if (isset($_POST['subject'])) {
                           echo $_POST['subject'];
                       } ?>">
            </div>

            <div>
                <label><?= TEXT_DURATION ?></label>
                <input type="number" class="form-control <?php if (isset($value_error)) {
                    echo "error-input";
                } ?>" name="duration" value="<?php if (isset($_POST['duration'])) {
                    echo $_POST['duration'];
                }else{echo 0;} ?>" min="0">
            </div>

            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($default_description_error)) {
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
