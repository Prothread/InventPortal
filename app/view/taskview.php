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

$projectController = new ProjectController();
$projects = $projectController->getAllProjects();

if (is_null($taskinfo)) {
    $block->Redirect('index.php?page=404');
}

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$error = false;

if (isset($_POST['updateTask'])) {

    //$test = $tender->getEndDate();

    $valueNames = ["subject", "client", "user", "project", "assignment", "urgency", "duration", "enddate", "description"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }
    if (strlen($subject) == 0) {
        $error = true;
        $title_error = true;
        echo "1";
    }
    if (!filter_var($client, FILTER_VALIDATE_INT)) {
        $error = true;
        $client_error = true;
        echo "2";
    }
    if (!filter_var($enddate, FILTER_SANITIZE_STRING)) {
        $error = true;
        $enddate_error = true;
        echo "4";
    }
    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
        echo "8";
    }

    if (!$error) {
        if ($user == 0) {
            $status = 0;
        } else {
            $status = 1;
        }

        $taskinfo = [
            'id' => $id,
            'subject' => strip_tags($subject),
            'client' => $client,
            'user' => $user,
            'project' => $project,
            'assignment' => $assignment,
            'urgency' => $urgency,
            'duration' => $duration,
            'description' => strip_tags($description),
            'enddate' => $enddate,
            'status' => $status
        ];
        $task->update($taskinfo);
    }
}

if (isset($_POST['deleteTask'])) {
    echo "yea";
    if ($task->delete($id)) {
        $block->Redirect('index.php?page=tasksoverview');
    }
}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TASK_OVERVIEW ?></h1>
        <form action="#" method="post">
            <button type="submit" name="deleteTask" id="deletebtn"
                    class="custom-file-upload"><?= TEXT_DELETE ?></button>
        </form>

        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if(isset($title_error)){echo "error-input";} ?>"
                       value="<?= $taskinfo['subject'] ?>">

            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control <?php if(isset($client_error)){echo "error-input";} ?>" name="client">
                    <option value="0"<?php if ($taskinfo['client'] == 0) {echo 'selected';} ?> > <?= TEXT_ASSIGNFOR ?> </option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if ($client['id'] == $taskinfo['client']) {
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
                    <option value="0"<?php if ($taskinfo['user'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if ($user['id'] == $taskinfo['user']) {
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
                    <option value="0"<?php if ($taskinfo['project'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_PROJECT_ADD ?></option>
                    <?php
                    foreach ($projects as $project) {
                        echo '<option value="' . $project['id'] . '"';
                        if ($project['id'] == $taskinfo['project']) {
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
                    <option value="0"<?php if ($taskinfo['project'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_ASSIGNMENT_ADD ?></option>
                    <?php
                    foreach ($projects as $project) {
                        echo '<option value="' . $project['id'] . '"';
                        if ($project['id'] == $taskinfo['project']) {
                            echo 'selected';
                        }
                        echo '>' . $project['subject'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_URGENCY ?></label>
                <select class="form-control" name="urgency">

                    <?php if($taskinfo['urgency'] == 1){ ?>
                        <option value="1" selected><?= URGENCY_1 ?></option>
                    <?php } else{ ?>
                        <option value="1"><?= URGENCY_1 ?></option>
                    <?php } ?>
                    <?php if($taskinfo['urgency'] == 2){ ?>
                        <option value="2" selected><?= URGENCY_2 ?></option>
                    <?php } else{ ?>
                        <option value="2"><?= URGENCY_2 ?></option>
                    <?php } ?>
                    <?php if($taskinfo['urgency'] == 3){ ?>
                        <option value="3" selected><?= URGENCY_3 ?></option>
                    <?php } else{ ?>
                        <option value="3"><?= URGENCY_3 ?></option>
                    <?php } ?>
                    <?php if($taskinfo['urgency'] == 4){ ?>
                        <option value="4" selected><?= URGENCY_4 ?></option>
                    <?php } else{ ?>
                        <option value="4"><?= URGENCY_4 ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <div>
                    <label><?= TEXT_DURATION ?></label>
                    <input type="number" class="form-control" name="duration" min="0" value="<?= $taskinfo['duration'] ?>">
                </div>

                <div>
                    <label><?= TEXT_END_DATE ?></label>
                    <input type="date" class="form-control <?php if(isset($enddate_error)){echo "error-input";} ?>" name="enddate" value="<?= $taskinfo['enddate'] ?>"
                    <br>
                </div>
                <div class="description-holder">
                    <label><?= TEXT_DESCRIPTION ?></label>
                    <textarea name="description" class="<?php if (isset($description_error)) {echo "error-input";} ?>"><?= $taskinfo['description'] ?></textarea>

                </div>
                <div class="button-update">
                    <div class="button-push"></div>
                    <button type="submit" name="updateTask"
                            class="custom-file-upload"><?= TEXT_EDIT ?></button>
                </div>
        </form>
    </div>
</div>

<div class="tender-view-side-column">
    <div class="tender-view-box">
        <a href="#">...</a>
        <ul>
            <li>
                Log onderwerp
            </li>
            <li>
                Log datum
            </li>
        </ul>
    </div>

    <div class="tender-view-box">
        <a href="#">...</a>
        <ul>
            <li>
                Log onderwerp
            </li>
            <li>
                Log datum
            </li>
        </ul>
    </div>

    <div class="tender-view-box">
        <a href="#">...</a>
        <ul>
            <li>
                Log onderwerp
            </li>
            <li>
                Log datum
            </li>
        </ul>
    </div>
</div>

<div class="tender-view-side-column">
    <button class="custom-file-upload">Notitie toevoegen</button>
    <div class="tender-view-box">
        <a href="#">...</a>
        <ul>
            <li>
                Notitie type
            </li>
            <li>
                Aanmaak datum
            </li>
        </ul>
    </div>

    <div class="tender-view-box">
        <a href="#">...</a>
        <ul>
            <li>
                Notitie type
            </li>
            <li>
                Aanmaak datum
            </li>
        </ul>
    </div>
</div>

<div class="tender-view-side-column">
    <button class="custom-file-upload">Taak toevoegen</button>
    <div class="tender-view-box-notitie">
        <img class="deadline" src="css/deadline3.png">
        <img class="urgentie" src="css/urgentie4.png">
        <a href="#">...</a>
        <ul>
            <li>
                Taak onderwerp
            </li>
            <li>
                Eind datum
            </li>
        </ul>
    </div>

    <div class="tender-view-box-notitie">
        <img class="deadline" src="css/deadline3.png">
        <a href="#">...</a>
        <ul>
            <li>
                Taak onderwerp
            </li>
            <li>
                Eind datum
            </li>
        </ul>
    </div>

    <div class="tender-view-box-notitie">
        <img class="deadline" src="css/deadline3.png">
        <a href="#">...</a>
        <ul>
            <li>
                Taak onderwerp
            </li>
            <li>
                Eind datum
            </li>
        </ul>
    </div>

    <div class="tender-view-box-notitie">
        <img class="deadline" src="css/deadline1.png">
        <a href="#">...</a>
        <ul>
            <li>
                Taak onderwerp
            </li>
            <li>
                Eind datum
            </li>
        </ul>
    </div>
</div>
