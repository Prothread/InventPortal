<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$block = new BlockController();
if (!filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $block->Redirect('index.php?page=404');
}
$id = $_GET['id'];

$mysqli = mysqli_connect();

$task = new TaskController();

$taskinfo = $task->getTaskById($id);

if (is_null($taskinfo)) {
    $block->Redirect('index.php?page=404');
}

$error = false;

if (isset($_POST['updateDefaultTask'])) {

    $valueNames = ["subject", "duration", "description",];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }
    if (strlen($subject) == 0) {
        $error = true;
        $title_error = true;
    }

    if (!filter_var($duration, FILTER_VALIDATE_INT) && $duration !== '0') {
        $error = true;
        $duration_error = true;
    }

    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
    }

    if (!$error) {

        $status = 4;

        $taskinfo = [
            'id' => $id,
            'subject' => strip_tags($subject),
            'duration' => $duration,
            'description' => strip_tags($description),
            'status' => $status,
        ];
        $task->updateDefault($taskinfo);
    }
}

if (isset($_POST['delete'])) {
    if ($task->delete($id)) {
        $block->Redirect('index.php?page=defaulttasksoverview');
    }
}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_DEFAULTTASK_ADD ?></h1>
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
                <div>
                    <label><?= TEXT_DURATION ?></label>
                    <input type="number" class="form-control" name="duration" min="0" value="<?= $taskinfo['duration'] ?>">
                </div>

                <div class="description-holder">
                    <label><?= TEXT_DESCRIPTION ?></label>
                    <textarea name="description" class="<?php if (isset($description_error)) {echo "error-input";} ?>"><?= $taskinfo['description'] ?></textarea>

                </div>

                <div class="button-update">
                    <div class="button-push"></div>
                    <button type="submit" name="updateDefaultTask"
                            class="custom-file-upload"><?= TEXT_EDIT ?></button>
                </div>
        </form>
    </div>
</div>