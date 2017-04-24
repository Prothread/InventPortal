<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 4-4-2017
 * Time: 09:35
 *
 * Extends View pages
 */

?>

<div class="tender-view-side-column">
    <?php
    if(!is_null($logs)) {
        foreach ($logs as $log) {
            $logDate = explode(' ', $log['date']);
            ?>
            <div class="tender-view-box">
                <ul>
                    <li>
                        <?= constant($log['subject']) ?>
                    </li>
                    <li>
                        <?= $logDate[0] ?>
                    </li>
                </ul>
                <button id="logLink<?= $log['id'] ?>" class="notitieviewbtn" data-toggle="modal"
                        data-target="#myModal"
                        onclick="logView(<?= $log['id'] ?>)">...
                </button>
            </div>
            <?php
        }
    }
    ?>
</div>
<!--    Notes-->
<div class="tender-view-side-column">
    <button id="notitie" class="custom-file-upload" data-toggle="modal" data-target="#myModal">Notitie toevoegen
    </button>
    <?php
    if (!is_null($notes)) {
        foreach ($notes as $note) {
            ?>
            <div class="tender-view-box">
                <ul>
                    <li>
                        <?php
                        foreach ($noteTypes as $noteType) {
                            if ($note['noteType'] == $noteType['id']) {
                                echo $noteType['name'];
                            }
                        }
                        ?>
                    </li>
                    <li>
                        <?= $note['creationDate'] ?>
                    </li>
                </ul>
                <button id="noteLink<?= $note['id'] ?>" class="notitieviewbtn" data-toggle="modal"
                        data-target="#myModal"
                        onclick="notitieView(<?= $note['id'] ?>)">...
                </button>
            </div>
            <?php
        }
    }
    ?>
</div>
<!--Tasks-->
<?php if ($type != 'task') { ?>
    <div class="tender-view-side-column">
        <button id="taak" class="custom-file-upload" data-toggle="modal" data-target="#myModal">Taak toevoegen</button>
        <?php foreach (${$typeTasks} as $task) {
            $timeDiff = ${$typeController}->getTimeDifference($task['endDate'], date("Y-m-d"));
            ?>
            <div class="tender-view-box-notitie">
                <?php if ($timeDiff <= 0) { ?>
                    <img class="deadline" src="css/deadline4.png">
                <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                    <img class="deadline" src="css/deadline3.png">
                <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                    <img class="deadline" src="css/deadline2.png">
                <?php } else { ?>
                    <img class="deadline" src="css/deadline1.png">
                <?php } ?>

                <?php if ($task['urgency'] == 0) { ?>

                <?php } else if ($task['urgency'] == 1) { ?>
                    <img class="urgencyImage" src="css/urgentie1.png">
                <?php } else if ($task['urgency'] == 2) { ?>
                    <img class="urgencyImage" src="css/urgentie2.png">
                <?php } else if ($task['urgency'] == 3) { ?>
                    <img class="urgencyImage" src="css/urgentie3.png">
                <?php } else if ($task['urgency'] == 4) { ?>
                    <img class="urgencyImage" src="css/urgentie4.png">
                <?php } ?>

                <ul>
                    <li>
                        <a href="?page=taskview&id=<?= $task['id'] ?>"><?= $task['subject'] ?></a>
                    </li>
                    <li>
                        <?= $task['endDate'] ?>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<!--assignments-->
<?php if ($type == 'project') { ?>
    <div class="tender-view-side-column">
        <button id="opdracht" class="custom-file-upload" data-toggle="modal" data-target="#myModal">Opdracht toevoegen</button>
        <?php foreach (${$typeAssignments} as $assignment) {
            $timeDiff = $assignmentController->getTimeDifference($assignment['endDate'], date("Y-m-d"))
            ?>
            <div class="tender-view-box-notitie">
                <?php if ($timeDiff <= 0) { ?>
                    <img class="deadline" src="css/deadline4.png">
                <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                    <img class="deadline" src="css/deadline3.png">
                <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                    <img class="deadline" src="css/deadline2.png">
                <?php } else { ?>
                    <img class="deadline" src="css/deadline1.png">
                <?php } ?>

                <ul>
                    <li>
                        <a href="?page=assignmentview&id=<?= $assignment['id'] ?>"><?= $assignment['subject'] ?></a>
                    </li>
                    <li>
                        <?= $assignment['endDate'] ?>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </div>
<?php } ?>
</div>
<!--Modal-->

<div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog" id="logview">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="logSubject"></h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="logDescription"><?= TEXT_DESCRIPTION ?></label>
                            <div class="col-md-4">
                                 <textarea class="form-control input-md description" id="logDescription" readonly></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="logDate"><?= TEXT_DATE ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="logDate" type="text" value="" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="logUser"><?= TEXT_IS_USER ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md" id="logUser" type="text" value="" readonly/>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-dialog" id="notitieview">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= TEXT_VIEW_NOTE ?></h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="noteType"><?= TEXT_NOTE_TYPE ?></label>
                            <div class="col-md-4 noteTypeView">
                                <select class="form-control input-md <?php
                                if (isset($noteEditError) && isset($note_noteType_error)) {
                                    echo 'error-input';
                                } ?>" name="noteType" id="noteTypeView">
                                    <?php
                                    foreach ($noteTypes as $noteType) {
                                        ?>
                                        <option
                                            value="<?= $noteType['id'] ?>"
                                            <?php
                                            if (isset($noteEditError) && $noteType['id'] == $_POST['noteType']) {
                                                echo 'selected';
                                            }
                                            ?>
                                        ><?= $noteType['name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="description"><?= TEXT_DESCRIPTION ?></label>
                            <div class="col-md-6">
                                <textarea
                                    class="form-control input-md description <?php
                                    if (isset($noteEditError) && isset($note_description_error)) {
                                        echo 'error-input';
                                    } ?>" id="descriptionView"
                                    name="description"><?php
                                    if (isset($noteEditError)) {
                                        echo $_POST['description'];
                                    } ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="eventDate"><?= TEXT_EVENT_DATE ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md <?php
                                if (isset($noteEditError) && isset($note_eventDate_error)) {
                                    echo 'error-input';
                                } ?>" id="eventDateView" name="eventDate" type="date"
                                       value="<?php
                                       if (isset($noteEditError)) {
                                           echo $_POST['eventDate'];
                                       } else {
                                           echo date('Y-m-d');
                                       } ?>" max="<?= date("Y-m-d") ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="linkType" value="<?php
                            switch ($type) {
                                case 'tender':
                                    echo 1;
                                    break;
                                case 'project':
                                    echo 2;
                                    break;
                                case 'assignment':
                                    echo 3;
                                    break;
                                case 'task':
                                    echo 4;
                                    break;
                                case 'case':
                                    echo 5;
                                    break;
                            }
                            ?>"/>
                            <input type="hidden" name="linkId" value="<?= ${$typeinfo}['id'] ?>"/>
                            <input type="hidden" name="user" value="<?= $thisUserId ?>">
                            <input type="hidden" name="creationDate" value="<?= date('Y-m-d'); ?>"/>
                            <input id="noteIdView" type="hidden" name="id" value="">
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="noteAdd"></label>
                            <div class="col-md-4">
                                <button type="submit" name="noteEdit" class="btn btn-primary"><?= TEXT_EDIT ?></button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <form action="#" method="post" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <input type="hidden" name="deleteId" id="deleteId" value="">
                            <label class="col-md-4 control-label" for="noteAdd"></label>
                            <div class="col-md-4">
                                <input type="hidden" name="noteType" id="deleteNoteType" value="">
                                <button type="submit" name="noteDelete"
                                        class="btn btn-primary"><?= TEXT_DELETE ?></button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-dialog" id="notitieform">
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
                                <select class="form-control input-md <?php if (isset($noteAddError ) && isset($note_noteType_error)){
                                    echo 'error-input';
                                }?>" name="noteType" id="noteType">
                                    <?php
                                    foreach ($noteTypes as $noteType) {
                                        ?>
                                        <option value="<?= $noteType['id'] ?>"><?= $noteType['name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="description"><?= TEXT_DESCRIPTION ?></label>
                            <div class="col-md-6">
                                <textarea class="form-control input-md description <?php
                                if (isset($noteAddError ) && isset($note_description_error)){
                                    echo 'error-input';
                                }?>" id="description" name="description"><?php if (isset($noteAddError )){echo $_POST['description'];} ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="eventDate"><?= TEXT_EVENT_DATE ?></label>
                            <div class="col-md-4">
                                <input class="form-control input-md <?php
                                if (isset($noteAddError ) && isset($note_eventDate_error)){
                                    echo 'error-input';
                                }?>" id="eventDate" name="eventDate" type="date"
                                       value="<?php if (isset($noteAddError )){echo $_POST['eventDate'];}else{echo date('Y-m-d');}?>" max="<?= date("Y-m-d") ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="linkType" value="<?php switch ($type) {
                                case 'tender':
                                    echo 1;
                                    break;
                                case 'project':
                                    echo 2;
                                    break;
                                case 'assignment':
                                    echo 3;
                                    break;
                                case 'task':
                                    echo 4;
                                    break;
                                case 'case':
                                    echo 5;
                                    break;
                            }
                            ?>"/>
                            <input type="hidden" name="linkId" value="<?= ${$typeinfo}['id'] ?>"/>
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
    <?php if ($type != 'task') { ?>
        <div class="modal-dialog" id="taakform">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Taak toevoegen </h4>
                </div>
                <div>
                    <form class="crm-add" action="#" method="post">
                        <div>
                            <label><?= TABLE_TITLE ?></label>
                            <input type="text" name="subject"
                                   class="form-control <?php
                                   if (isset($taskError) && isset($task_subject_error)) {
                                       echo "error-input";
                                   } ?>"
                                   value="<?php
                                   if (isset($_POST['subject'])) {
                                       echo $_POST['subject'];
                                   } ?>">
                        </div>
                        <div>
                            <label><?= TEXT_ASSIGNFOR ?></label>
                            <select disabled class="form-control
                            <?php
                            if (isset($task_client_error)) {
                                echo "error-input";
                            } ?>" name="client">
                                <option value="0"
                                    <?php
                                    if (${$typeinfo}['client'] == 0) {
                                        echo 'selected';
                                    }
                                    ?>><?= TEXT_ASSIGNFOR ?></option>
                                <?php
                                foreach ($clients as $client) {
                                    echo '<option value="' . $client['id'] . '"';
                                    if ($client['id'] == ${$typeinfo}['client']) {
                                        echo 'selected';
                                    }
                                    echo '>' . $client['naam'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label><?= TEXT_EMPLOYEE ?></label>
                            <select class="form-control<?php if (isset($task_user_error)) {
                                echo " error-input";
                            } ?>" name="user">
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
                        <div <?php if ($type != 'project') {
                            echo 'style="display:none;"';
                        } ?>>
                            <label><?= TEXT_PROJECT_ADD ?></label>
                            <select disabled class="form-control <?php if (isset($task_project_error)) {
                                echo "error-input";
                            } ?>" name="project">
                                <?php
                                if ($type != 'project') {
                                    echo '<option value="0"></option>';
                                } else {
                                    echo '<option value="' . ${$typeinfo}['id'] . '" selected>' . ${$typeinfo}['subject'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div <?php if ($type != 'assignment') {
                            echo 'style="display:none;"';
                        } ?>>
                            <label><?= TEXT_ASSIGNMENT_ADD ?></label>
                            <select disabled class="form-control<?php if (isset($taak_assignment_error)) {
                                echo " error-input";
                            } ?>" name="assignment">
                                <?php
                                if ($type != 'assignment') {
                                    echo '<option value="0"></option>';
                                } else {
                                    echo '<option value="' . ${$typeinfo}['id'] . '" selected>' . ${$typeinfo}['subject'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div <?php if ($type != 'tender') {
                            echo 'style="display:none;"';
                        } ?>>
                            <label><?= TEXT_TENDER_ADD ?></label>
                            <select disabled class="form-control <?php if (isset($taak_tender_error)) {
                                echo " error-input";
                            } ?>" name="tender">
                                <?php
                                if ($type != 'tender') {
                                    echo '<option value="0"></option>';
                                } else {
                                    echo '<option value="' . ${$typeinfo}['id'] . '" selected>' . ${$typeinfo}['subject'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div <?php if ($type != 'case') {
                            echo 'style="display:none;"';
                        } ?>>
                            <label><?= TEXT_CASE_ADD ?></label>
                            <select disabled class="form-control<?php if (isset($taak_case_error)) {
                                echo " error-input";
                            } ?>" name="case">
                                <?php
                                if ($type != 'case') {
                                    echo '<option value="0"></option>';
                                } else {
                                    echo '<option value="' . ${$typeinfo}['id'] . '" selected>' . ${$typeinfo}['subject'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label><?= TEXT_URGENCY ?></label>
                            <select class="form-control <?php if (isset($taak_urgency_error)) {
                                echo " error-input";
                            } ?>" name="urgency">
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
                            <input type="number" class="form-control <?php if (isset($task_duration_error)) {
                                echo "error-input";
                            } ?>" name="duration" value="<?php if (isset($_POST['duration'])) {
                                echo $_POST['duration'];
                            }else{echo 0;} ?>" min="0">
                        </div>

                        <div>
                            <label><?= TEXT_END_DATE ?></label>
                            <input type="date" class="form-control <?php if (isset($task_endDate_error)) {
                                echo "error-input";
                            } ?>" name="endDate"
                                   value="<?php if (isset($_POST['endDate'])) {
                                       echo $_POST['endDate'];
                                   } else {
                                       echo date("d-m-y");
                                   } ?>" min="<?= date("Y-m-d") ?>">
                        </div>

                        <div class="description-holder">
                            <label><?= TEXT_DESCRIPTION ?></label>
                            <textarea name="description" class="<?php if (isset($task_description_error)) {
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
                        <input type="hidden" name="client" value="<?= ${$typeinfo}['client'] ?>">
                        <input type="hidden" name="project" value="<?php if ($type == 'project') {
                            echo $id;
                        } else {
                            echo 0;
                        } ?>">
                        <input type="hidden" name="assignment" value="<?php if ($type == 'assignment') {
                            echo $id;
                        } else {
                            echo 0;
                        } ?>">
                        <input type="hidden" name="tender" value="<?php if ($type == 'tender') {
                            echo $id;
                        } else {
                            echo 0;
                        } ?>">
                        <input type="hidden" name="case" value="<?php if ($type == 'case') {
                            echo $id;
                        } else {
                            echo 0;
                        } ?>">
                    </form>

                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
    <?php } ?>
    <?php if ($type == 'project') { ?>
        <div class="modal-dialog" id="opdrachtform">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Opdracht toevoegen </h4>
                </div>
                <div>

                    <form class="crm-add" action="#" method="post">
                        <div>
                            <label><?= TABLE_TITLE ?></label>
                            <input type="text" name="subject"
                                   class="form-control <?php if (isset($assignment_subject_error)) {
                                       echo "error-input";
                                   } ?>"
                                   value="<?php if (isset($_POST['subject'])) {
                                       echo $_POST['subject'];
                                   } ?>">
                        </div>
                        <div>
                            <label><?= TEXT_ASSIGNFOR ?></label>
                            <select disabled class="form-control <?php if (isset($assignment_client_error)) {
                                echo "error-input";
                            } ?>" name="client">
                                <option value="0"<?php if (${$typeinfo}['client'] == 0) {
                                    echo 'selected';
                                } ?>><?= TEXT_ASSIGNFOR ?></option>
                                <?php
                                foreach ($clients as $client) {
                                    echo '<option value="' . $client['id'] . '"';
                                    if ($client['id'] == ${$typeinfo}['client']) {
                                        echo 'selected';
                                    }
                                    echo '>' . $client['naam'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label><?= TEXT_EMPLOYEE ?></label>
                            <select class="form-control <?php if (isset($assignment_user_error)) {
                                echo "error-input";
                            } ?>" name="user">
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
                            <select disabled class="form-control <?php if (isset($assignment_project_error)) {
                                echo "error-input";
                            } ?>" name="project">
                                <option value="<?= $projectinfo['id'] ?>"
                                        selected><?= $projectinfo['subject'] ?></option>
                            </select>
                            <input type="hidden" name="projectId" value="<?= $projectinfo['id'] ?>"/>
                        </div>

                        <div>
                            <label><?= TEXT_END_DATE ?></label>
                            <input type="date" class="form-control <?php if (isset($assignment_endDate_error)) {
                                echo "error-input";
                            } ?>" name="endDate"
                                   value="<?php if (isset($_POST['endDate'])) {
                                       echo $_POST['endDate'];
                                   } else {
                                       echo date("d-m-y");
                                   } ?>" min="<?= date("Y-m-d") ?>">
                        </div>

                        <div class="description-holder">
                            <label><?= TEXT_DESCRIPTION ?></label>
                            <textarea name="description" class="<?php if (isset($assignment_description_error)) {
                                echo "error-input";
                            } ?>"><?php if (isset($_POST['description'])) {
                                    echo $_POST['description'];
                                } ?></textarea>
                        </div>

                        <div class="button-holder">
                            <div class="button-push"></div>
                            <button type="submit" name="submitAssignment"
                                    class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
                        </div>
                        <input type="hidden" name="client" value="<?= ${$typeinfo}['client'] ?>">

                    </form>

                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
    <?php } ?>
</div>

<script>
    var notes = {
        <?php
        foreach ($notes as $note) {
            echo $note['id'] . ':{ noteType:"' . $note['noteType'] . '",description: "' . str_replace("\r\n", '<br>', $note['description']) . '", eventDate:"' . $note['eventDate'] . '"},';
        }
        ?>
    };
    var logs = {
        <?php
        foreach ($logs as $log){
            $logUser = '';
            foreach ($users as $user){
                if($user['id'] == $log['user']){
                    $logUser = $user['naam'];
                }
            }
            $logDescription = explode("[constDivide]",$log['description']);
            $logViewDate = date_create($log['date']);
            echo $log['id'] . ':{ subject:"' . constant($log['subject']) . '",description: "' . constant($logDescription[0]) . ' ' . $logDescription[1] . ' ' . constant($logDescription[2]) . '", date: "' . date_format($logViewDate,'d-m-Y H:i:s') . '", user: "' . $logUser . '"},';
        }
        ?>
    };
    var notitiebtn = document.getElementById("notitie");
    var taakbtn = document.getElementById("taak");
    var opdrachtbtn = document.getElementById("opdracht");

    var notitie = document.getElementById("notitieform");
    var taak = document.getElementById("taakform");
    var opdracht = document.getElementById("opdrachtform");
    var notitieview = document.getElementById("notitieview");

    function hideForms() {
        notitie.style.display = "none";
        <?php if($type != 'task'){?>
        taak.style.display = 'none';
        <?php }
        if($type == 'project'){?>
        opdracht.style.display = 'none';
        <?php }?>
        notitieview.style.display = 'none';
        logview.style.display = 'none';
    }

    notitiebtn.onclick = function () {
        hideForms();
        notitie.style.display = 'block';
    };
    <?php if($type != 'task'){?>
    taakbtn.onclick = function () {
        hideForms();
        taak.style.display = 'block';
    };
    <?php }?>

    <?php if($type == 'project'){?>
    opdrachtbtn.onclick = function () {
        hideForms();
        opdracht.style.display = 'block';
    };
    <?php } ?>

    function logView(id) {
        hideForms();
        logview.style.display = 'block';
        subject = logs[id]['subject'];
        description = logs[id]['description'];
        date = logs[id]['date'];
        user = logs[id]['user'];
        $('#logSubject').html(subject);
        $('#logDescription').val(description);
        $('#logDate').val(date);
        $('#logUser').val(user);
    }

    var noteEditError = false;

    function notitieView(id) {
        hideForms();
        notitieview.style.display = 'block';
        type = notes[id]['noteType'];
        description = notes[id]['description'].replace(/<br>/g,"\r\n");
        eventDate = notes[id]['eventDate'];
        $('#noteIdView').val(id);
        $('#deleteId').val(id);
        $('#deleteNoteType').val(type);
        if (!noteEditError) {
            $('.noteTypeView option[value=' + type + ']').prop('selected', true);
            $('#descriptionView').val(description);
            $('#eventDateView').val(eventDate);
        }
        noteEditError = false;
    }

    $(document).ready(function () {
        <?php
        if (isset($noteAddError)){
        ?>
        $('#notitie').click();
        <?php }elseif (isset($taskError)){
        ?>
        $('#taak').click();
        <?php
        }elseif (isset($assignmentError)){
        ?>
        $('#opdracht').click();
        <?php
        }elseif(isset($noteEditError)){?>
        noteEditError = true;
        $('<?php echo '#noteLink' . $_POST['id']; ?>').click();
        <?php }?>
    });
</script>
