<?php

$block = new BlockController();
if (!filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $block->Redirect('index.php?page=404');
}
$id = $_GET['id'];

$mysqli = mysqli_connect();

$case = new CaseController();

$caseinfo = $case->getCaseById($id);

if (is_null($caseinfo)) {
    $block->Redirect('index.php?page=404');
}

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$projectController = new ProjectController();
$projects = $projectController->getAllProjects();

$error = false;

if (isset($_POST['update'])) {

    $valueNames = ["subject", "client", "user", "enddate", "description", "project"];
    foreach ($valueNames as $value) {
        ${$value} = mysqli_real_escape_string($mysqli, $_POST[$value]);
    }
    if (strlen($subject) == 0) {
        $error = true;
        $subject_error = true;
    }
    if (!filter_var($client, FILTER_VALIDATE_INT) && $client !== '0') {
        $error = true;
        $client_error = true;
    }
    if (!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0') {
        $error = true;
        $user_error = true;
    }
    if (!filter_var($enddate, FILTER_SANITIZE_STRING)) {
        $error = true;
        $endDate_error = true;
    }
    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
    }
    if (!$error) {
        if ($user == 0) {
            $status = 0;
        } else {
            $status = 1;
        }
        $caseinfo = [
            'id' => $id,
            'subject' => strip_tags($subject),
            'client' => $client,
            'user' => $user,
            'enddate' => $enddate,
            'description' => strip_tags($description),
            'status' => $status,
            'project' => $project
        ];
        $test = $case->update($caseinfo);
        echo $test;
    }
}
?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_CASE_VIEW ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_SUBJECT ?></label>
                <input type="text" class="form-control <?php if (isset($subject_error)) {
                    echo "error-input";
                } ?>" name="subject" value="<?= $caseinfo['subject'] ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"<?php if ($caseinfo['client'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if ($client['id'] == $caseinfo['client']) {
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
                    <option value="0"<?php if ($caseinfo['user'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if ($user['id'] == $caseinfo['user']) {
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
                    <option value="0"<?php if ($caseinfo['project'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_PROJECT_ADD ?></option>
                    <?php
                    foreach ($projects as $project){
                        echo '<option value="' . $project['id'] . '"';
                        if ($project['id'] == $caseinfo['project']) {
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
                    foreach ($users as $user){
                        echo '<option value="'.$user['id'].'">'.$user['naam'].'</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control" name="enddate" value="<?= $caseinfo['enddate'] ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" <?php if (isset($description_error)) {
                    echo "error-input";
                } ?>><?= $caseinfo['description'] ?></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="update" class="custom-file-upload"><?= TEXT_EDIT ?></button>
            </div>
        </form>
    </div>
    <div class="add-right-content add-content">

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
</div>
