
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>jQuery UI Sortable - Default functionality</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
    #sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    } );
</script>

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

$taskController = new TaskController();
$defaultTask = $taskController->getAllTasksByStatus(4);

$templateController = new templateController();
$templates = $templateController->getAllTemplates();

$templateTaskLinksController = new TemplateTaskLinksController();

$error = false;

$post = false;

if (isset($_POST['create'])) {
    $post = true;
    $valueNames = ["subject", "client", "user", "endDate", "description", "defaultTasks"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }
    if (strlen($subject) == 0) {
        $error = true;
        $subject_error = true;
    }
    if (!filter_var($client, FILTER_VALIDATE_INT) && $client !== '0') {
        $error = true;
        $client_error = true;
    }
    if (!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0') {
        $error = true;
        $user_error = true;
    }
    if (!filter_var($endDate, FILTER_SANITIZE_STRING)) {
        $error = true;
        $endDate_error = true;
    }
    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
    }
    if (!$error) {
        if ($user == 0) {
            $status = 0;
        } else {
            $status = 1;
        }
        $projectinfo = [
            'subject' => strip_tags($subject),
            'client' => $client,
            'user' => $user,
            'endDate' => $endDate,
            'description' => strip_tags($description),
            'status' => $status
        ];

        if ($id = $project->create($projectinfo)) {

            if($defaultTasks != null && isset($defaultTasks)){
                $tasksId = explode("-", $defaultTasks);
                foreach ($tasksId as $taskid) {
                    if ($taskid != '') {
                        $task = $taskController->getTaskById($taskid);
                        if($task['user'] != 0){
                            $status = 1;
                        }else{
                            $status = 0;
                        }
                        $taskinfo = [
                            'subject' => strip_tags($task['subject']),
                            'client' => strip_tags($task['client']),
                            'user' => strip_tags($task['user']),
                            'project' => $id,
                            'assignment' => strip_tags($task['assignment']),
                            'urgency' => strip_tags($task['urgency']),
                            'duration' => strip_tags($task['duration']),
                            'description' => strip_tags($task['description']),
                            'endDate' => strip_tags($task['endDate']),
                            'tender' => strip_tags($task['tender']),
                            'cases' => strip_tags($task['cases']),
                            'status' => strip_tags($status)
                        ];
                        $taskController->create($taskinfo);
                    }
                }
            }

            $block = new BlockController();
            $block->Redirect('index.php?page=projectview&id=' . $id);
        } else {

        }
    }
}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_PROJECT_CREATE ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_SUBJECT ?></label>
                <input type="text" class="form-control <?php if (isset($subject_error)) {
                    echo "error-input";
                } ?>" name="subject" value="<?php if ($post) {
                    echo $_POST['subject'];
                }; ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control" name="client">
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
                        echo '<option value="' . $user['id'] . '">' . $user['naam'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_END_DATE ?></label>
                <input type="date" class="form-control" name="endDate" value="<?php if ($post) {
                    echo $_POST['endDate'];
                }; ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($description_error)) {
                    echo "error-input";
                } ?>"><?php if ($post) {
                        echo $_POST['description'];
                    }; ?></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="create" class="custom-file-upload" onclick="ez()"><?= TEXT_CREATE_DROPDOWN ?></button>
            </div>
            <input type="hidden" name="defaultTasks" id="defaultTasks">
        </form>
    </div>
    <div class="add-right-content add-content">
        <h1 class="crm-content-header"><?= TEXT_ADD_TASKS ?></h1>
        <div class="crm-add">
            <div>
                <label><?= TEXT_TEMPLATE ?></label>
                <select id="templatelist">
                    <option value=0 selected> -</option>
                    <?php foreach ($templates as $template) { ?>
                        <option value="<?= $template['id'] ?>"> <?= $template['onderwerp'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_TASK_ADD ?></label>
                <select id="tasklist">
                    <option value=0 selected> -</option>
                    <?php foreach ($defaultTask as $task) { ?>
                        <option value="<?= $task['id'] ?>"> <?= $task['subject'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_TASK_OVERVIEW ?></label>
                <div id="taken-lijst">
                    <ul id="sortable">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var amount = 0;

    var tasks = "";

    var dt = {

        <?php foreach ($defaultTask as $task) {
        echo $task['id'] . ':"' . $task['subject'] . '",';
    } ?>

    };

    function addTask(id){
        var ul = document.getElementById("sortable");
        var li = document.createElement("li");
        var btn = document.createElement("button");
        li.appendChild(document.createTextNode(dt[id]));
        ul.appendChild(li);
        btn.appendChild(document.createTextNode("x"));
        li.appendChild(btn);

        li.setAttribute("value", id);
        li.setAttribute("class", "ui-state-default");

        amount += 1;

        li.setAttribute("id", "dt"+amount);

        btn.setAttribute("onclick", "deleteTask("+"dt"+amount+")");
        btn.setAttribute("class", "custom-file-upload");

    }

    $("#tasklist").change(function () {
        var list = document.getElementById("tasklist");
        var id = list.options[list.selectedIndex].value;

        addTask(id);

        list.selectedIndex = 0;

    });

    <?php foreach ($templates as $template){ ?>
    var template<?=$template['id']?> = [<?php
        $ids = $templateTaskLinksController->getTaskByTemplateId($template['id']);
        foreach ($ids as $id){?>
        <?= $id['idTask'] ?>,
        <?php } ?>
    ]
    <?php }?>

    $("#templatelist").change(function () {
        var list = document.getElementById("templatelist");
        var id = list.options[list.selectedIndex].value;

        var templatename = 'template' + id;
        for(i = 0; i < eval(templatename).length; i++){
            addTask(eval(templatename)[i]);
        }

        list.selectedIndex = 0;

    });

    $("#sortable").change(function () {
        var list = document.getElementById("sortable");
        var id = list.options[list.selectedIndex].text;

        console.log("dt: " + dt[id]);

    });

    function deleteTask(task) {
        var parent = document.getElementById("sortable");
        var child = document.getElementById(task.id);
        parent.removeChild(child);
        console.log("dt"+task.id)
    }

    function ez() {
        tasks = "";
        $('#sortable li').each(function (i) {
            tasks += $(this).attr('value') + "-";
        });
        console.log(tasks);
        $('#defaultTasks').val(tasks);
    }

</script>