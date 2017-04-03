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

$project = new ProjectController();

$projectinfo = $project->getProjectById($id);

if (is_null($projectinfo)) {
    $block->Redirect('index.php?page=404');
}

$thisUserId = $_SESSION['usr_id'];

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$noteController = new NoteController();
$notes = $noteController->getNotesByLinkId(2, $projectinfo['id']);

$noteTypeController = new NoteTypeController();
$noteTypes = $noteTypeController->getNoteTypes();

$error = false;

$post = false;

if (isset($_POST['noteAdd'])) {
    $valueNames = ["linkType", "linkId", "noteType", "eventDate", "description", "user", "creationDate"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }
    $intNames = ["linkType", "linkId", "noteType", "user"];
    foreach ($intNames as $v) {
        if (!filter_var(${$v}, FILTER_VALIDATE_INT) && ${$v} !== '0') {
            $error = true;
            echo 'FOUT' . ${$v};
        }
    }
    if (!filter_var($eventDate, FILTER_SANITIZE_STRING)) {
        $error = true;
        echo 'FOUT' . $eventDate;
    }
    if (!filter_var($creationDate, FILTER_SANITIZE_STRING)) {
        $error = true;
        echo 'FOUT' . $creationDate;
    }
    if (!filter_var($description, FILTER_SANITIZE_STRING) || $description == '') {
        $error = true;
        echo 'FOUT' . $description;
    }
    if (!$error) {
        $noteInfo = [
            'linkType' => $linkType,
            'linkId' => $linkId,
            'noteType' => $noteType,
            'eventDate' => $eventDate,
            'description' => $description,
            'user' => $user,
            'creationDate' => $creationDate
        ];
        $noteController->create($noteInfo);
    }
}

$error = false;

if (isset($_POST['update'])) {
    $post = true;

    $valueNames = ["subject", "client", "user", "endDate", "description"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
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
    if (!filter_var($endDate, FILTER_SANITIZE_STRING)) {
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
        $projectinfo = [
            'id' => $id,
            'subject' => strip_tags($subject),
            'client' => $client,
            'user' => $user,
            'endDate' => $endDate,
            'description' => strip_tags($description),
            'status' => $status
        ];
        $project->update($projectinfo);
    }
}

if (isset($_POST['delete'])) {
    if ($project->delete($id)) {
        $block->Redirect('index.php?page=projectsoverview');
    }
}
?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_PROJECT_VIEW ?></h1>
        <form action="#" method="post">
            <button type="submit" name="delete" id="deletebtn"
                    class="custom-file-upload"><?= TEXT_DELETE ?></button>
        </form>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_SUBJECT ?></label>
                <input type="text" class="form-control <?php if (isset($subject_error)) {
                    echo "error-input";
                } ?>" name="subject" value="<?php
                if ($post) {
                    echo $_POST['subject'];
                } else {
                    echo $projectinfo['subject'];
                }
                ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"<?php if ($projectinfo['client'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if ($post && $client['id'] == $_POST['client']) {
                            echo 'selected';
                        } elseif (!$post && $client['id'] == $projectinfo['client']) {
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
                    <option value="0"<?php if ($projectinfo['user'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if ($post && $user['id'] == $_POST['user']) {
                            echo 'selected';
                        } elseif (!$post && $user['id'] == $projectinfo['user']) {
                            echo 'selected';
                        }
                        echo '>' . $user['naam'] . '</option>';
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
                    echo $projectinfo['endDate'];
                }
                ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($description_error)) {
                    echo "error-input";
                } ?>"><?php
                    if ($post) {
                        echo $_POST['description'];
                    } else {
                        echo $projectinfo['description'];
                    }
                    ?></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="update" class="custom-file-upload"><?= TEXT_EDIT ?></button>
            </div>
        </form>
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
        <button class="custom-file-upload" data-toggle="modal" data-target="#myModal">Notitie toevoegen</button>
        <?php
        if(!is_null($notes)) {
            foreach ($notes as $note) {
                ?>
                <div class="tender-view-box">
                    <a></a>
                    <ul>
                        <li>
                            <?php
                            foreach ($noteTypes as $noteType){
                                if($note['noteType'] == $noteType['id']){
                                    echo $noteType['name'];
                                }
                            }
                            ?>
                        </li>
                        <li>
                            <?= $note['creationDate'] ?>
                        </li>
                    </ul>
                </div>
                <?php
            }
        }
        ?>
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= TEXT_ADD_NOTE ?></h4>
            </div>
            <div class="modal-body">

                <form action="#" method="post" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="noteType"><?= TEXT_NOTE_TYPE ?></label>
                            <div class="col-md-4">
                                <select class="form-control input-md" name="noteType" id="noteType">
                                    <?php foreach ($noteTypes as $noteType) { ?>
                                        <option value="<?= $noteType['id'] ?>"><?= $noteType['name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="description"><?= TEXT_DESCRIPTION ?></label>
                            <div class="col-md-6">
                                <textarea class="form-control input-md" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="eventDate"><?= TEXT_EVENT_DATE ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="eventDate" name="eventDate" type="date"
                                       value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="linkType" value="2"/>
                            <input type="hidden" name="linkId" value="<?= $projectinfo['id'] ?>"/>
                            <input type="hidden" name="user" value="<?= $thisUserId ?>">
                            <input type="hidden" name="creationDate" value="<?= date('Y-m-d'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="noteAdd"></label>
                            <div class="col-md-4">
                                <button type="submit" name="noteAdd" class="btn btn-primary"><?= TEXT_ADD ?></button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
</div>
