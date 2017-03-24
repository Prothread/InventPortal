<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$mysqli = mysqli_connect();

$project = new ProjectController();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$error = false;

$post = false;

if(isset($_POST['create'])){
    $post = true;
    $valueNames = ["title","client","user","endDate","description"];
    foreach ($valueNames as $value){
        ${$value} = mysqli_real_escape_string($mysqli, $_POST[$value]);
    }
    if(strlen($title) == 0){
        $error = true;
        $title_error = "TITLE";
    }
    if(!filter_var($client, FILTER_VALIDATE_INT) && $client !== '0'){
        $error = true;
        $client_error = "CLIENT ID";
    }
    if(!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0'){
        $error = true;
        $user_error = "USER ID";
    }
    if(!filter_var($endDate, FILTER_SANITIZE_STRING)){
        $error = true;
        $endDate_error = "ENDDATE";
    }
    if(!filter_var($description, FILTER_SANITIZE_STRING)){
        $error = true;
        $description_error = "DESCRIPTION";
    }
    if(!$error){
        $projectinfo = [
            'title' => strip_tags($title),
            'client' => $client,
            'user' => $user,
            'endDate' => $endDate,
            'description' => strip_tags($description)
        ];

        if($id = $project->create($projectinfo)){
            $block = new BlockController();
            $block->Redirect('index.php?page=projectview&id='.$id);
        }else{

        }
    }
    Session::flash('error', TEXT_ERROR_FORM);
}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_PROJECT_CREATE ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" class="form-control" name="title" value="<?php if($post){echo $_POST['title'];}; ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
                    <option value="0"><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client){
                        echo '<option value="'.$client['id'].'"';
                        if(isset($_POST['create']) && $client['id'] == $_POST['client']){
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
                    <option value="0"><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user){
                        echo '<option value="'.$user['id'].'">'.$user['naam'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control" name="endDate">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description"></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="create" class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
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
