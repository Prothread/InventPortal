<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$mysqli = mysqli_connect();

$tender = new TenderController();

$error = false;

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();
$post = false;
if (isset($_POST['submitTender'])) {
    $post = true;
    $subject = mysqli_real_escape_string($mysqli, $_POST['subject']);
    $client = mysqli_real_escape_string($mysqli, $_POST['client']);
    $user = mysqli_real_escape_string($mysqli, $_POST['user']);
    $validity = mysqli_real_escape_string($mysqli, $_POST['validity']);
    $value = mysqli_real_escape_string($mysqli, $_POST['value']);
    $chance = mysqli_real_escape_string($mysqli, $_POST['chance']);
    $creationDate = mysqli_real_escape_string($mysqli, $_POST['creationdate']);
    $description = mysqli_real_escape_string($mysqli, $_POST['description']);

    if (!isset($subject) || $subject == null) {
        $error = true;
        $title_error = true;
    }

    if (!filter_var($client, FILTER_VALIDATE_INT)) {
        $error = true;
        $client_error = true;
    }

    if (!filter_var($validity, FILTER_VALIDATE_INT) && $validity !== '0') {
        $error = true;
        $validity_error = true;
    }

    if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
        $error = true;
        $value_error = true;
    }

    if (!filter_var($creationDate, FILTER_SANITIZE_STRING)) {
        $error = true;
        $creationDate_error = true;
    }

    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
    }

    $tender->calcEndDate($creationDate, $validity);

    if($client == 0){
        $status = 0;
    }else{
        $status = 1;
    }

    if (!$error) {
        $tenderinfo = [
            'subject' => strip_tags($subject),
            'client' => strip_tags($client),
            'user' => strip_tags($user),
            'validity' => strip_tags($validity),
            'value' => strip_tags($value),
            'chance' => strip_tags($chance),
            'creationdate' => strip_tags($creationDate),
            'description' => strip_tags($description),
            'status' => strip_tags($status)
        ];
        if ($id = $tender->create($tenderinfo)) {
            $block = new BlockController();
            $block->Redirect('index.php?page=tenderview&id=' . $id);
        } else {
            $errormsg = "Er is een probleem opgetreden tijdens het aan maken van een offerte, probeer het later opnieuw.";
        }
    }

}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_TENDER_CREATE ?></h1>
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
                <label><?= TEXT_VALIDITY_DURATION ?></label>
                <input type="number" class="form-control <?php if(isset($validity_error)){echo "error-input";} ?>" name="validity" min="1" value="<?php if (isset($_POST['validity'])) {
                    echo $_POST['validity'];
                } ?>">
            </div>
            <div>
                <label><?= TEXT_VALUE ?></label>
                <input type="number" class="form-control <?php if(isset($value_error)){echo "error-input";} ?>" name="value" value="<?php if (isset($_POST['value'])) {
                    echo $_POST['value'];
                } ?>">
            </div>
            <div>
                <label><?= TEXT_CHANCE ?></label>
                <input type="number" class="form-control" name="chance" max="100" value="<?php if (isset($_POST['chance'])) {
                    echo $_POST['chance'];
                } ?>">
            </div>
            <div>
                <label><?= TEXT_CREATION_DATE ?></label>
                <input type="date" class="form-control <?php if(isset($creationDate_error)){echo "error-input";} ?>" name="creationdate"
                       value="<?php if (isset($_POST['creationdate'])) {
                           echo $_POST['creationdate'];
                       }else{ echo date("d-m-y"); } ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if(isset($description_error)){echo "error-input";} ?>"><?php if (isset($_POST['description'])) {
                        echo $_POST['description'];
                    } ?></textarea>
            </div>
            <!--            Bestanden uploaden moet nog toegevoegd worden-->
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="submitTender"
                        class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
            </div>
        </form>
    </div>
    <div class="add-right-content add-content">
        <h1 class="crm-content-header"><?= TEXT_ADD_TASKS ?></h1>
        <div class="crm-add">
            <div>
                <label><?= TEXT_TEMPLATE ?></label>
                <select></select>
            </div>
            <div>
                <label><?= TEXT_TASK_ADD ?></label>
                <select></select>
            </div>
            <div>
                <label><?= TEXT_TASK_OVERVIEW ?></label>
                <div id="taken-lijst">

                </div>
            </div>
        </div>
    </div>
</div>
