<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$mysqli = mysqli_connect();

$task = new TaskController();

$error = false;

$projectController = new ProjectController();
$projects = $projectController->getAllProjects();

$assignmentController = new AssignmentController();
$assignments = $assignmentController->getAllAssignments();

$tenderController = new TenderController();
$tenders = $tenderController->getAllTenders();

$caseController = new CaseController();
$cases = $caseController->getAllCases();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$post = false;
if (isset($_POST['submitDefaultTask'])) {
    $post = true;

    $valueNames = ["subject", "duration", "description"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }

    if (!isset($subject) || $subject == null) {
        $error = true;
        $title_error = true;
        echo '1';
    }

    if (!filter_var($duration, FILTER_VALIDATE_INT) && $duration !== '0') {
        $error = true;
        $duration_error = true;
        echo '7';
    }

    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
        echo '9';
    }

    $status = 4;

    if (!$error) {
        $taskinfo = [
            'subject' => strip_tags($subject),
            'duration' => strip_tags($duration),
            'description' => strip_tags($description),
            'status' => strip_tags($status)
        ];
        if ($id = $task->createDefault($taskinfo)) {
            $block = new BlockController();
            $block->Redirect('index.php?page=defaulttaskview&id=' . $id);
        } else {
            $errormsg = "Er is een probleem opgetreden tijdens het aan maken van een taak, probeer het later opnieuw.";
        }
    }
}
?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_DEFAULTTASK_CREATE ?></h1>
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
                <label><?= TEXT_DURATION ?></label>
                <input type="number" class="form-control <?php if (isset($value_error)) {
                    echo "error-input";
                } ?>" name="duration" value="<?php if (isset($_POST['duration'])) {
                    echo $_POST['duration'];
                } ?>" min="0">
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
                <button type="submit" name="submitDefaultTask"
                        class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
            </div>

        </form>
    </div>
</div>
