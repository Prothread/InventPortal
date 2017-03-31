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

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$post = false;
if (isset($_POST['submitTask'])) {
    $post = true;

    $valueNames = ["subject", "client", "user", "project", "assignment", "urgency", "duration", "enddate", "description", "tender"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }

    if (!isset($subject) || $subject == null) {
        $error = true;
        $title_error = true;
        echo '1';
    }

    if (!filter_var($client, FILTER_VALIDATE_INT) && $client !== '0') {
        $error = true;
        $client_error = true;
        echo '2';
    }

    if (!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0') {
        $error = true;
        $user_error = true;
        echo '3';
    }

    if (!filter_var($project, FILTER_VALIDATE_INT) && $project !== '0') {
        $error = true;
        $project_error = true;
        echo '4';
    }

    if (!filter_var($assignment, FILTER_VALIDATE_INT) && $assignment !== '0') {
        $error = true;
        $assignment_error = true;
        echo '5';
    }

    if (!filter_var($urgency, FILTER_VALIDATE_INT) && $urgency !== '0') {
        $error = true;
        $urgency_error = true;
        echo '6';
    }

    if (!filter_var($duration, FILTER_VALIDATE_INT) && $duration !== '0') {
        $error = true;
        $duration_error = true;
        echo '7';
    }

    if (!filter_var($enddate, FILTER_SANITIZE_STRING)) {
        $error = true;
        $enddate_error = true;
        echo '8';
    }

    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
        echo '9';
    }

    if ($client == 0) {
        $status = 0;
    } else {
        $status = 1;
    }

    if (!$error) {
        $taskinfo = [
            'subject' => strip_tags($subject),
            'client' => strip_tags($client),
            'user' => strip_tags($user),
            'project' => strip_tags($project),
            'assignment' => strip_tags($assignment),
            'urgency' => strip_tags($urgency),
            'duration' => strip_tags($duration),
            'description' => strip_tags($description),
            'enddate' => strip_tags($enddate),
            'status' => strip_tags($status),
            'tender' => strip_tags($tender)
        ];
        if ($id = $task->create($taskinfo)) {
            $block = new BlockController();
            $block->Redirect('index.php?page=taskview&id=' . $id);
        } else {
            $errormsg = "Er is een probleem opgetreden tijdens het aan maken van een taak, probeer het later opnieuw.";
        }
    }

}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_TASK_CREATE ?></h1>
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
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control <?php if (isset($client_error)) {
                    echo "error-input";
                } ?>" name="client">
                    <option value="0"><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if (isset($_POST['create']) && $client['id'] == $_POST['client']) {
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
                    <option value="0"><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if (isset($_POST['create']) && $user['id'] == $_POST['user']) {
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
                    <option value="0"><?= TEXT_PROJECT_ADD ?></option>
                    <?php
                    foreach ($projects as $project) {
                        echo '<option value="' . $project['id'] . '"';
                        if (isset($_POST['create']) && $project['id'] == $_POST['project']) {
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
                        if (isset($_POST['create']) && $assignment['id'] == $_POST['assignment']) {
                            echo 'selected';
                        }
                        echo '>' . $assignment['subject'] . '</option>';
                    }
                    ?>
                    <?php
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_TENDER_ADD ?></label>
                <select class="form-control" name="tender">
                    <option value="0"><?= TEXT_TENDER_ADD ?></option>
                    <?php
                    foreach ($tenders as $tender) {
                        echo '<option value="' . $tender['id'] . '"';
                        if (isset($_POST['create']) && $tender['id'] == $_POST['tender']) {
                            echo 'selected';
                        }
                        echo '>' . $tender['subject'] . '</option>';
                    }
                    ?>
                    <?php
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_URGENCY ?></label>
                <select class="form-control" name="urgency">
                    <option value="0">-</option>
                    <option value="1"<?php if (isset($_POST['urgency']) && $_POST['urgency'] == 1) {
                        echo 'selected';
                    } ?>><?= URGENCY_1 ?></option>
                    <option value="2"<?php if (isset($_POST['urgency']) && $_POST['urgency'] == 2) {
                        echo 'selected';
                    } ?>><?= URGENCY_2 ?></option>
                    <option value="3"<?php if (isset($_POST['urgency']) && $_POST['urgency'] == 3) {
                        echo 'selected';
                    } ?>><?= URGENCY_3 ?></option>
                    <option value="4"<?php if (isset($_POST['urgency']) && $_POST['urgency'] == 4) {
                        echo 'selected';
                    } ?>><?= URGENCY_4 ?></option>
                </select>
            </div>

            <div>
                <label><?= TEXT_DURATION ?></label>
                <input type="number" class="form-control <?php if (isset($value_error)) {
                    echo "error-input";
                } ?>" name="duration" value="<?php if (isset($_POST['duration'])) {
                    echo $_POST['duration'];
                } ?>" min="0">
            </div>

            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control <?php if (isset($creationDate_error)) {
                    echo "error-input";
                } ?>" name="enddate"
                       value="<?php if (isset($_POST['enddate'])) {
                           echo $_POST['enddate'];
                       } else {
                           echo date("d-m-y");
                       } ?>">
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
                <button type="submit" name="submitTask"
                        class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
            </div>
        </form>
    </div>
</div>
