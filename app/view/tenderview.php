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

$tender = new TenderController();

$tenderinfo = $tender->getTenderById($id);

if (is_null($tenderinfo)) {
    $block->Redirect('index.php?page=404');
}

$thisUserId = $_SESSION['usr_id'];

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$tenderTasks = array();

$templateTaskLinksController = new TemplateTaskLinksController();

$templateTasksId = $templateTaskLinksController->getTaskByTemplateId($id);
$taskController = new TaskController();

if(isset($templateTasksId)) {
    foreach ($templateTasksId as $tTask) {
        if (isset($tTask['idTask']) && $tTask['idTask'] != null) {
            array_push($tenderTasks, $taskController->getTaskById($tTask['idTask']));
        }
    }
}

$moreAssignmentTasks = $taskController->getTaskByAssignmentId($id);

foreach ($moreAssignmentTasks as $tTask) {
    array_push($tenderTasks, $taskController->getTaskById($tTask['idTask']));
}

$tenderController = new TenderController();
$tenders = $tenderController->getAllTenders();

$error = false;

$post = false;

if (isset($_POST['updateTender'])) {
    $post = true;

    $valueNames = ["subject", "client", "user", "validity", "value", "chance", "description"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }
    if (strlen($subject) == 0) {
        $error = true;
        $title_error = true;
    }
    if (!filter_var($client, FILTER_VALIDATE_INT)) {
        $error = true;
        $client_error = true;
    }
    if (!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0') {
        $error = true;
        $user_error = true;
    }
    if (!filter_var($validity, FILTER_VALIDATE_INT) && $validity !== '0') {
        $error = true;
        $vadility_error = true;
    }
    if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
        $error = true;
        $value_error = true;
    }
    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
    }

    $tender->calcEndDate($tenderinfo['creationdate'], $validity);

    $enddate = $tender->getEndDate();

    if (!$error) {
        if ($user == 0) {
            $status = 0;
        } else {
            $status = 1;
        }
        $tenderinfo = [
            'id' => $id,
            'subject' => strip_tags($subject),
            'client' => $client,
            'user' => $user,
            'validity' => $validity,
            'description' => strip_tags($description),
            'chance' => strip_tags($chance),
            'value' => strip_tags($value),
            'status' => $status
        ];

        $tender->update($tenderinfo);
    }
}


if (isset($_POST['delete'])) {
    if ($tender->delete($id)) {
        $block->Redirect('index.php?page=tendersoverview');
    }
}

if (isset($_POST['submitTask'])) {
    $post = true;

    $valueNames = ["subject", "user", "urgency", "duration", "enddate", "description"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }

    if (!isset($subject) || $subject == null) {
        $error = true;
        $title_error = true;
        echo '1';
    }

    if (!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0') {
        $error = true;
        $user_error = true;
        echo '3';
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

    $thisTender = null;

    foreach ($tenders as $tender) {
        if ($tender['id'] == $id) {
            $thisTender = $tender['id'];
        }
    }

    if (!$error) {
        $taskinfo = [
            'subject' => strip_tags($subject),
            'user' => strip_tags($user),
            'urgency' => strip_tags($urgency),
            'duration' => strip_tags($duration),
            'description' => strip_tags($description),
            'enddate' => strip_tags($enddate),
            'tender' => $thisTender

        ];
        if ($id = $taskController->create($taskinfo)) {
            $block = new BlockController();
            $block->Redirect('index.php?page=tenderview&id=' . $thisTender);
        } else {
            $errormsg = "Er is een probleem opgetreden tijdens het aan maken van een taak, probeer het later opnieuw.";
        }
    }
}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TENDER_OVERVIEW ?></h1>
        <form action="#" method="post">
            <button type="submit" name="delete" id="deletebtn"
                    class="custom-file-upload"><?= TEXT_DELETE ?></button>
        </form>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if (isset($title_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php
                       if ($post) {
                           echo $_POST['subject'];
                       } else {
                           echo $tenderinfo['subject'];
                       }
                       ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control <?php if (isset($client_error)) {
                    echo "error-input";
                } ?>" name="client">
                    <option value="0"<?php if ($tenderinfo['client'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if ($post && $client['id'] == $_POST['client']) {
                            echo 'selected';
                        } elseif (!$post && $client['id'] == $tenderinfo['client']) {
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
                    <option value="0"<?php if ($tenderinfo['user'] == 0) {
                        echo 'selected';
                    } ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if ($post && $user['id'] == $_POST['user']) {
                            echo 'selected';
                        } elseif (!$post && $user['id'] == $tenderinfo['user']) {
                            echo 'selected';
                        }
                        echo '>' . $user['naam'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_VALIDITY_DURATION ?></label>
                <input type="number" class="form-control <?php if (isset($vadility_error)) {
                    echo "error-input";
                } ?>" name="validity" min="1" value="<?php
                if ($post) {
                    echo $_POST['validity'];
                } else {
                    echo $tenderinfo['validity'];
                }
                ?>">
            </div>
            <div>
                <label><?= TEXT_VALUE ?></label>
                <input type="number" class="form-control <?php if (isset($value_error)) {
                    echo "error-input";
                } ?>" name="value" min="0" value="<?php
                if ($post) {
                    echo $_POST['value'];
                } else {
                    echo $tenderinfo['value'];
                }
                ?>">

            </div>
            <div>
                <label><?= TEXT_CHANCE ?></label>
                <input type="number" class="form-control" name="chance" max="100" min="0"
                       value="<?php
                       if ($post) {
                           echo $_POST['chance'];
                       } else {
                           echo $tenderinfo['chance'];
                       }
                       ?>">
            </div>
            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="text" class="form-control" name="enddate" readonly
                       value="<?php
                       if (isset($enddate)) {
                           echo date("d-m-Y", strtotime($enddate));
                       } else {
                           echo date("d-m-Y", strtotime($tenderinfo['enddate']));
                       }
                       ?>"
                <br>
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($description_error)) {
                    echo "error-input";
                } ?>"><?php
                    if ($post) {
                        echo $_POST['description'];
                    } else {
                        echo $tenderinfo['description'];
                    }
                    ?></textarea>

            </div>
            <div class="button-update">
                <div class="button-push"></div>
                <button type="submit" name="updateTender"
                        class="custom-file-upload"><?= TEXT_EDIT ?></button>
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
        <button id="notitie" class="custom-file-upload" data-toggle="modal" data-target="#myModal">Notitie toevoegen</button>
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
    <?php foreach ($tenderTasks as $task){
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
            <?php } else if($task['urgency'] == 3){ ?>
                <img class="urgencyImage" src="css/urgentie3.png">
            <?php } else if($task['urgency'] == 4){ ?>
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
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" id="notitieform">

        <!-- Modal content-->
        <div class="modal-content" >
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
            <div >

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
                            <option value="0"<?php if ($tenderinfo['client'] == 0) {
                                echo 'selected';
                            } ?>><?= TEXT_ASSIGNFOR ?></option>
                            <?php
                            foreach ($clients as $client) {
                                echo '<option value="' . $client['id'] . '"';
                                if ($client['id'] == $tenderinfo['client']) {
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
                            <?php
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
                                if ($tender['id'] == $id) {
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
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>

<script>
    var notitiebtn = document.getElementById("notitie");
    var taakbtn = document.getElementById("taak");

    var notitie = document.getElementById("notitieform");
    var taak = document.getElementById("taakform");

    console.log("nb " + notitiebtn);
    console.log("tb " + taakbtn);
    console.log("n " + notitie);
    console.log("t " + taak);

    notitiebtn.onclick = function() {
        notitie.style.display = "block";
        taak.style.display= 'none';
    }

    taakbtn.onclick = function() {
        notitie.style.display = "none";
        taak.style.display= 'block';
    }

</script>

