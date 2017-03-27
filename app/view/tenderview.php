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

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$error = false;

if (isset($_POST['updateTender'])) {
    $valueNames = ["subject", "client", "user", "validity", "value", "chance", "creationDate", "description"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }
    if (strlen($subject) == 0) {
        $error = true;
        $title_error = true;
        echo "1";
    }
    if (!filter_var($client, FILTER_VALIDATE_INT) && $client !== '0') {
        $error = true;
        $client_error = true;
        echo "2";
    }
    if (!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0') {
        $error = true;
        $user_error = true;
        echo "3";
    }
    if (!filter_var($validity, FILTER_VALIDATE_INT) && $validity !== '0') {
        $error = true;
        $vadility_error = true;
        echo "4";
    }
    if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
        $error = true;
        $value_error = true;
        echo $value;
    }
    if (!filter_var($chance, FILTER_VALIDATE_INT)) {
        $error = true;
        $chance_error = true;
        echo "6";
    }
    if (!filter_var($creationDate, FILTER_SANITIZE_STRING)) {
        $error = true;
        $createdate_error = true;
        echo "7";
    }
    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
        echo "8";
    }

    if (!$error) {
        if ($client == 0) {
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
            'creationdate' => strip_tags($creationDate),
            'value' => strip_tags($value),
            'status' => $status
        ];
        $tender->update($tenderinfo);
    }
}

if (isset($_POST['deleteTender'])) {
    if ($tender->delete($id)) {
        $block->Redirect('index.php?page=tendersoverview');
    }
}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TENDER_OVERVIEW ?></h1>
        <form action="#" method="post">
            <button type="submit" name="deleteTender" id="deletebtn"
                    class="custom-file-upload"><?= TEXT_DELETE ?></button>
        </form>

        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control"
                       value="<?= $tenderinfo['subject'] ?>">
                <span class="text-danger"><?php if (isset($subject_error)) echo $subject_error; ?></span>
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
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
                <span class="text-danger"><?php if (isset($client_error)) echo $client_error; ?></span>
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
                        if ($user['id'] == $tenderinfo['user']) {
                            echo 'selected';
                        }
                        echo '>' . $user['naam'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_VALIDITY_DURATION ?></label>
                <input type="number" class="form-control" name="validity" value="<?= $tenderinfo['validity'] ?>" ) {
                       echo $_POST['validity'];
                } ?>
                <span class="text-danger"><?php if (isset($validity_error)) echo $validity_error; ?></span>
            </div>
            <div>
                <label><?= TEXT_VALUE ?></label>
                <input type="number" class="form-control" name="value" value="<?= $tenderinfo['value'] ?>">
                <span class="text-danger"><?php if (isset($value_error)) echo $value_error; ?></span>
            </div>
            <div>
                <label><?= TEXT_CHANCE ?></label>
                <input type="number" class="form-control" name="chance" value="<?= $tenderinfo['chance'] ?>" ) {
                       echo $_POST['chance'];
                } ?>
            </div>
            <div>
                <label><?= TEXT_CREATION_DATE ?></label>
                <input type="date" class="form-control" name="creationDate"
                       value="<?= $tenderinfo['creationdate'] ?>"
                <span class="text-danger"><?php if (isset($creationDate_error)) echo $creationDate_error; ?></span>
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description"><?= $tenderinfo['description'] ?></textarea>
                <span class="text-danger"><?php if (isset($description_error)) echo $description_error; ?></span>
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
