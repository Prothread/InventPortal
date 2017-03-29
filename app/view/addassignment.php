<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$mysqli = mysqli_connect();

$assignment = new AssignmentController();

$project = new ProjectController();
$projects = $project->getAllProjects();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$error = false;

$post = false;

if(isset($_POST['create'])){
    $post = true;
    $valueNames = ["subject","client","user","endDate","description","projectId"];
    foreach ($valueNames as $v){
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
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
    if(!filter_var($projectId, FILTER_VALIDATE_INT) && $projectId !== '0'){
        $error = true;
        $user_error = true;
    }
    if(!$error){
        if($projectId == 0){
            $status = 0;
        }else{
            $status = 1;
        }
        $assignmentinfo = [
            'subject' => strip_tags($subject),
            'client' => $client,
            'user' => $user,
            'endDate' => $endDate,
            'description' => strip_tags($description),
            'project' => $projectId,
            'status' => $status
        ];
        if($id = $assignment->create($assignmentinfo)){
            $block = new BlockController();
            $block->Redirect('index.php?page=assignmentview&id='.$id);
        }else{

        }
    }
}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_ASSIGNMENT_CREATE ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_SUBJECT ?></label>
                <input type="text" class="form-control <?php if(isset($subject_error)){echo "error-input";} ?>" name="subject" value="<?php if($post){echo $_POST['subject'];}; ?>">
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
                        echo '<option value="'.$user['id'].'"';
                        if(isset($_POST['create']) && $user['id'] == $_POST['user']){
                            echo 'selected';
                        }
                        echo '>'.$user['naam'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_PROJECT_ADD ?></label>
                <select class="form-control" name="projectId">
                    <option value="0"><?= TEXT_PROJECT_ADD ?></option>
                    <?php
                    foreach ($projects as $project){
                        echo '<option value="'.$project['id'].'"';
                        if(isset($_POST['create']) && $project['id'] == $_POST['projectId']){
                            echo 'selected';
                        }
                        echo '>'.$project['subject'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control" name="endDate" value="<?php if($post){echo $_POST['endDate'];}; ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if(isset($description_error)){echo "error-input";} ?>"><?php if($post){echo $_POST['description'];}; ?></textarea>
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
