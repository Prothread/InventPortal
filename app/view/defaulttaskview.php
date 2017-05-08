<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'default';

include '../app/Model/viewSetup.php';

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_DEFAULT_TASK_VIEW ?></h1>
        <form action="#" method="post">
            <button type="submit" name="delete" id="deletebtn"
                    class="custom-file-upload"><?= TEXT_DELETE ?></button>
        </form>

        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if (isset($default_subject_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php if(isset($_POST['update'])){echo $_POST['subject'];}else{echo $taskinfo['subject'];} ?>">

            </div>

            <div>
                <div>
                    <label><?= TEXT_DURATION ?></label>
                    <input type="number" class="form-control <?php if (isset($default_duration_error)) {
                        echo "error-input";
                    } ?>" name="duration" min="0"
                           value="<?php if(isset($_POST['update'])){echo $_POST['duration'];}else{echo $taskinfo['duration'];} ?>">
                </div>

                <div class="description-holder">
                    <label><?= TEXT_DESCRIPTION ?></label>
                    <textarea name="description" class="<?php if (isset($default_description_error)) {
                        echo "error-input";
                    } ?>"><?php if(isset($_POST['update'])){echo $_POST['description'];}else{echo $taskinfo['description'];} ?></textarea>

                </div>

                <div class="button-update">
                    <div class="button-push"></div>
                    <button type="submit" name="update"
                            class="custom-file-upload"><?= TEXT_EDIT ?></button>
                </div>
        </form>
    </div>
</div>