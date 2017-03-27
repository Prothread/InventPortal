<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */
$block = new BlockController();
if(!filter_var($_GET['id'], FILTER_VALIDATE_INT)){
    $block->Redirect('index.php?page=404');
}
$id = $_GET['id'];

$mysqli = mysqli_connect();

$project = new ProjectController();

$projectinfo = $project->getProjectById($id);

if(is_null($projectinfo)){
    $block->Redirect('index.php?page=404');
}

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$error = false;

if(isset($_POST['update'])){

    $valueNames = ["subject","client","user","endDate","description"];
    foreach ($valueNames as $value){
        ${$value} = mysqli_real_escape_string($mysqli, $_POST[$value]);
    }
    if(strlen($subject) == 0){
        $error = true;
        $subject_error = true;
    }
    if(!filter_var($client, FILTER_VALIDATE_INT) && $client !== '0'){
        $error = true;
        $client_error = true;
    }
    if(!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0'){
        $error = true;
        $user_error = true;
    }
    if(!filter_var($endDate, FILTER_SANITIZE_STRING)){
        $error = true;
        $endDate_error = true;
    }
    if(!filter_var($description, FILTER_SANITIZE_STRING)){
        $error = true;
        $description_error = true;
    }
    if(!$error){
        if($user == 0){
            $status = 0;
        }else{
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
        $test = $project->update($projectinfo);
        echo $test;
    }
}
?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_PROJECT_VIEW ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_SUBJECT ?></label>
                <input type="text" class="form-control <?php if(isset($subject_error)){echo "error-input";} ?>" name="subject" value="<?= $projectinfo['subject'] ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"<?php if($projectinfo['client'] == 0){echo 'selected';} ?>><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client){
                        echo '<option value="'.$client['id'].'"';
                        if($client['id'] == $projectinfo['client']){
                            echo 'selected';
                        }
                        echo '>'.$client['naam'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_EMPLOYEE ?></label>
                <select class="form-control" name="user">
                    <option value="0"<?php if($projectinfo['user'] == 0){echo 'selected';} ?>><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user){
                        echo '<option value="'.$user['id'].'"';
                        if($user['id'] == $projectinfo['user']){
                            echo 'selected';
                        }
                        echo '>'.$user['naam'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control" name="endDate" value="<?= $projectinfo['endDate'] ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" <?php if(isset($description_error)){echo "error-input";} ?>><?= $projectinfo['description'] ?></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="update" class="custom-file-upload"><?= TEXT_EDIT ?></button>
            </div>
        </form>
    </div>
    <div class="add-right-content add-content">

    </div>
</div>
