<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'project';

include '../app/Model/viewSetup.php';

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
                <input type="text" class="form-control <?php if (isset($project_subject_error)) {
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
                <select class="form-control <?php if (isset($project_client_error)) {
                    echo "error-input";
                } ?>" name="client">
                    <option value="0"
                        <?php
                        if ($projectinfo['client'] == 0) {
                            echo 'selected';
                        }
                        ?>><?= TEXT_ASSIGNFOR ?></option>
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
                <select class="form-control <?php if (isset($project_user_error)) {
                    echo "error-input";
                } ?>" name="user">
                    <option value="0"
                        <?php
                        if ($projectinfo['user'] == 0) {
                            echo 'selected';
                        }
                        ?>><?= TEXT_EMPLOYEE ?></option>
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
                <input type="date" class="form-control <?php if (isset($project_endDate_error)) {
                    echo "error-input";
                } ?>" name="endDate" value="<?php
                if ($post) {
                    echo $_POST['endDate'];
                } else {
                    echo $projectinfo['endDate'];
                }
                ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="
                    <?php
                if (isset($project_description_error)) {
                    echo "error-input";
                }
                ?>"><?php
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
<<<<<<< HEAD
=======
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
        <button id="notitie" class="custom-file-upload" data-toggle="modal" data-target="#myModal">Notitie toevoegen
        </button>
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
        <button id="taak" class="custom-file-upload" data-toggle="modal" data-target="#myModal">Taak toevoegen</button>
        <?php foreach ($projectTasks as $task) {
            $timeDiff = $tenderController->getTimeDifference($task['enddate'], date("Y-m-d"))
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
                        <?= $task['enddate'] ?>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </div>

    <div class="tender-view-side-column">
        <button id="opdracht" class="custom-file-upload" data-toggle="modal" data-target="#myModal">Opdracht toevoegen</button>
        <?php foreach ($projectAssignments as $assignment) {
            $timeDiff = $tenderController->getTimeDifference($assignment['endDate'], date("Y-m-d"))
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

</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" id="notitieform">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= TEXT_ADD_NOTE ?></h4>
            </div>
            <div class="modal-body">

                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="noteType"><?= TEXT_NOTE_TYPE ?></label>
                            <div class="col-md-4">
                                <select name="noteType" id="noteType">
                                    <option value="1">NOTITIT TYPE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description"><?= TEXT_DESCRIPTION ?></label>
                            <textarea id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="linkType" value="1"/>
                            <input type="hidden" name="linkId" value="<?= $tenderinfo['id'] ?>"/>
                            <input type="hidden" name="user" value="<?= $thisUserId ?>">
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>

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
                        <input type="text" name="subject" class="form-control <?php if (isset($title_error)) {
                            echo "error-input";
                        } ?>"
                               value="<?php if (isset($_POST['subject'])) {
                                   echo $_POST['subject'];
                               } ?>">
                    </div>
                    <div>
                        <label><?= TEXT_ASSIGNFOR ?></label>
                        <select disabled class="form-control <?php if (isset($client_error)) {
                            echo "error-input";
                        } ?>" name="client">
                            <option value="0"<?php if ($projectinfo['client'] == 0) {
                                echo 'selected';
                            } ?>><?= TEXT_ASSIGNFOR ?></option>
                            <?php
                            foreach ($clients as $client) {
                                echo '<option value="' . $client['id'] . '"';
                                if ($client['id'] == $projectinfo['client']) {
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
                        <select disabled class="form-control" name="project">
                            <option value="0"><?= TEXT_PROJECT_ADD ?></option>
                            <?php
                            foreach ($projects as $project) {
                                echo '<option value="' . $project['id'] . '"';
                                if ($project['id'] == $id) {
                                    echo 'selected';
                                }
                                echo '>' . $project['subject'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label><?= TEXT_ASSIGNMENT_ADD ?></label>
                        <select disabled class="form-control" name="assignment">
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
                        </select>
                    </div>

                    <div>
                        <label><?= TEXT_TENDER_ADD ?></label>
                        <select disabled class="form-control" name="tender">
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
                        <label><?= TEXT_CASE_ADD ?></label>
                        <select disabled class="form-control" name="case">
                            <option value="0"><?= TEXT_CASE_ADD ?></option>
                            <?php
                            foreach ($cases as $case) {
                                echo '<option value="' . $case['id'] . '"';
                                if (isset($_POST['case']) && $case['id'] == $_POST['case']) {
                                    echo 'selected';
                                }
                                echo '>' . $case['subject'] . '</option>';
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
            <div class="modal-footer">

            </div>
        </div>

    </div>

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
                        <input type="text" name="subject" class="form-control <?php if (isset($title_error)) {
                            echo "error-input";
                        } ?>"
                               value="<?php if (isset($_POST['subject'])) {
                                   echo $_POST['subject'];
                               } ?>">
                    </div>
                    <div>
                        <label><?= TEXT_ASSIGNFOR ?></label>
                        <select disabled class="form-control <?php if (isset($client_error)) {
                            echo "error-input";
                        } ?>" name="client">
                            <option value="0"<?php if ($projectinfo['client'] == 0) {
                                echo 'selected';
                            } ?>><?= TEXT_ASSIGNFOR ?></option>
                            <?php
                            foreach ($clients as $client) {
                                echo '<option value="' . $client['id'] . '"';
                                if ($client['id'] == $projectinfo['client']) {
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
                        <select disabled class="form-control" name="project">
                            <option value="0"><?= TEXT_PROJECT_ADD ?></option>
                            <?php
                            foreach ($projects as $project) {
                                echo '<option value="' . $project['id'] . '"';
                                if ($project['id'] == $id) {
                                    echo 'selected';
                                }
                                echo '>' . $project['subject'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label><?= TEXT_END_DATE ?></label>
                        <input type="date" class="form-control <?php if (isset($creationDate_error)) {
                            echo "error-input";
                        } ?>" name="endDate"
                               value="<?php if (isset($_POST['endDate'])) {
                                   echo $_POST['endDate'];
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
                        <button type="submit" name="submitAssignment"
                                class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>

</div>

<script>
    var notitiebtn = document.getElementById("notitie");
    var taakbtn = document.getElementById("taak");
    var opdrachtbtn = document.getElementById("opdracht");

    var notitie = document.getElementById("notitieform");
    var taak = document.getElementById("taakform");
    var opdracht = document.getElementById("opdrachtform");

    notitiebtn.onclick = function () {
        notitie.style.display = "block";
        taak.style.display = 'none';
        opdracht.style.display = 'none';
    }

    taakbtn.onclick = function () {
        notitie.style.display = "none";
        taak.style.display = 'block';
        opdracht.style.display = 'none';
    }

    opdrachtbtn.onclick = function () {
        notitie.style.display = "none";
        taak.style.display = 'none';
        opdracht.style.display = 'block';
    }
>>>>>>> origin/CRM

