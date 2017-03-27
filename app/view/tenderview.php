<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

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
$_GET['id'];
if (isset($_POST['submitTender'])) {

    $subject = mysqli_real_escape_string($mysqli, $_POST['subject']);
    $client = mysqli_real_escape_string($mysqli, $_POST['client']);
    $user = mysqli_real_escape_string($mysqli, $_POST['user']);
    $validity = mysqli_real_escape_string($mysqli, $_POST['validity']);
    $value = mysqli_real_escape_string($mysqli, $_POST['value']);
    $chance = mysqli_real_escape_string($mysqli, $_POST['chance']);
    $creationDate = mysqli_real_escape_string($mysqli, $_POST['creationDate']);
    $description = mysqli_real_escape_string($mysqli, $_POST['description']);

    if (!isset($subject) || $subject == null) {
        $error = true;
        $subject_error = "You must fill in the subject field.";
    }

    if (!isset($client) || $client == null) {
        $error = true;
        $client_error = "You must select a client.";
    }

    if (!isset($validity) || $validity == null) {
        $error = true;
        $validity_error = "You must set validity days";
    }

    if (!isset($value) || $value == null) {
        $error = true;
        $value_error = "You must set a value";
    }

    if (!isset($creationDate) || $creationDate == null) {
        $error = true;
        $creationDate_error = "You must set the creation date";
    }

    if (!isset($description) || $description == null) {
        $error = true;
        $description_error = "You must set a description";
    }

    if (!$error) {
        $tenderinfo = [
            'subject' => strip_tags($subject),
            'client' => strip_tags($client),
            'user' => strip_tags($user),
            'validity' => strip_tags($validity),
            'value' => strip_tags($value),
            'chance' => strip_tags($chance),
            'creationDate' => strip_tags($creationDate),
            'description' => strip_tags($description)
        ];

        if ($id = $tender->create($tenderinfo)) {
//            $id = 10;
//            $id = $tender->getLastTenderId();
//            $block = new BlockController();
            $block->Redirect('index.php?page=tenderview&id=' . $id);
        } else {
            $errormsg = "Er is een probleem opgetreden tijdens het aan maken van een offerte, probeer het later opnieuw.";
        }
    }

}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TENDER_OVERVIEW ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control" name="title"
                       value="<?= $tenderinfo['onderwerp'] ?>"
                <span class="text-danger"><?php if (isset($subject_error)) echo $subject_error; ?></span>
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"<?php if($tenderinfo['klant'] == 0){echo 'selected';} ?>><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client){
                        echo '<option value="'.$client['id'].'"';
                        if($client['id'] == $tenderinfo['klant']){
                            echo 'selected';
                        }
                        echo '>'.$client['naam'].'</option>';
                    }
                    ?>
                </select>
                <span class="text-danger"><?php if (isset($client_error)) echo $client_error; ?></span>
            </div>
            <div>
                <label><?= TEXT_EMPLOYEE ?></label>
                <select class="form-control" name="user">
                    <option value="0"<?php if($tenderinfo['werknemer'] == 0){echo 'selected';} ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user){
                        echo '<option value="'.$user['id'].'"';
                        if($user['id'] == $tenderinfo['werknemer']){
                            echo 'selected';
                        }
                        echo '>'.$user['naam'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_VALIDITY_DURATION ?></label>
                <input type="number" class="form-control" name="validity" value="<?= $tenderinfo['geldigheidsduur'] ?>") {
                    echo $_POST['validity'];
                } ?>
                <span class="text-danger"><?php if (isset($validity_error)) echo $validity_error; ?></span>
            </div>
            <div>
                <label><?= TEXT_VALUE ?></label>
                <input type="number" class="form-control" name="value" value="<?= $tenderinfo['waarde'] ?>">
                <span class="text-danger"><?php if (isset($value_error)) echo $value_error; ?></span>
            </div>
            <div>
                <label><?= TEXT_CHANCE ?></label>
                <input type="number" class="form-control" name="chance" value="<?= $tenderinfo['kans'] ?>") {
                    echo $_POST['chance'];
                } ?>
            </div>
            <div>
                <label><?= TEXT_CREATION_DATE ?></label>
                <input type="date" class="form-control" name="creationDate"
                       value="<?= $tenderinfo['aanmaakdatum'] ?>"
                <span class="text-danger"><?php if (isset($creationDate_error)) echo $creationDate_error; ?></span>
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description"><?= $tenderinfo['beschrijving'] ?></textarea>
                <span class="text-danger"><?php if (isset($description_error)) echo $description_error; ?></span>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="submitTender"
                        class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
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
