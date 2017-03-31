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
        <button class="custom-file-upload" data-toggle="modal" data-target="#myModal">Notitie toevoegen</button>
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

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
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
