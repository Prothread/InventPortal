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

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$post = false;
if (isset($_POST['submitTask'])) {
    $post = true;
    $subject = mysqli_real_escape_string($mysqli, $_POST['subject']);
    $client = mysqli_real_escape_string($mysqli, $_POST['client']);
    $user = mysqli_real_escape_string($mysqli, $_POST['user']);
    $project = mysqli_real_escape_string($mysqli, $_POST['project']);
    $assignment = mysqli_real_escape_string($mysqli, $_POST['assignment']);
    $urgency = mysqli_real_escape_string($mysqli, $_POST['urgency']);
    $duration = mysqli_real_escape_string($mysqli, $_POST['duration']);
    $description = mysqli_real_escape_string($mysqli, $_POST['description']);
    $enddate = mysqli_real_escape_string($mysqli, $_POST['enddate']);
    $status = mysqli_real_escape_string($mysqli, $_POST['status']);

    if (!isset($subject) || $subject == null) {
        $error = true;
        $title_error = true;
    }

    if (!filter_var($enddate, FILTER_SANITIZE_STRING)) {
        $error = true;
        $enddate_error = true;
    }

    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
    }

    if($client == 0){
        $status = 0;
    }else{
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
            'status' => strip_tags($status)
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
                <input type="text" name="subject" class="form-control <?php if(isset($title_error)){echo "error-input";} ?>"
                       value="<?php if (isset($_POST['subject'])) {
                           echo $_POST['subject'];
                       } ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control <?php if(isset($client_error)){echo "error-input";} ?>" name="client">
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
                    foreach ($projects as $project){
                        echo '<option value="'.$project['id'].'">'.$project['subject'].'</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_ASSIGNMENT_ADD ?></label>
                <select class="form-control" name="assignment">
                    <option value="0"><?= TEXT_ASSIGNMENT_ADD ?></option>
                    <?php
                    foreach ($users as $user){
                        echo '<option value="'.$user['id'].'">'.$user['naam'].'</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_URGENCY ?></label>
                <select class="form-control" name="urgency">
                    <option value="1"><?= URGENCY_1 ?></option>
                    <option value="2"><?= URGENCY_2 ?></option>
                    <option value="3"><?= URGENCY_3 ?></option>
                    <option value="4"><?= URGENCY_4 ?></option>
                </select>
            </div>

            <div>
                <label><?= TEXT_DURATION ?></label>
                <input type="number" class="form-control <?php if(isset($value_error)){echo "error-input";} ?>" name="duration" value="<?php if (isset($_POST['value'])) {
                    echo $_POST['value'];
                } ?>">
            </div>

            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control <?php if(isset($creationDate_error)){echo "error-input";} ?>" name="enddate"
                       value="<?php if (isset($_POST['enddate'])) {
                           echo $_POST['enddate'];
                       }else{ echo date("d-m-y"); } ?>">
            </div>

            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if(isset($description_error)){echo "error-input";} ?>"><?php if (isset($_POST['description'])) {
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
