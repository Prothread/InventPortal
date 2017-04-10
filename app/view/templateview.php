<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>jQuery UI Sortable - Default functionality</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
    #sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 60%;
    }

    #sortable li {
        margin: 0 3px 3px 3px;
        padding: 0.4em;
        padding-left: 1.5em;
        font-size: 1.4em;
        height: 18px;
    }

    #sortable li span {
        position: absolute;
        margin-left: -1.3em;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });
</script>

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

$template = new templateController();

$templateinfo = $template->getTemplateById($id);

if (is_null($templateinfo)) {
    $block->Redirect('index.php?page=404');
}

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$taskController = new TaskController();
$defaultTask = $taskController->getAllTasksByStatus(4);

$templateTaskLinksController = new TemplateTaskLinksController();

$allTemplateTasks = array();

$amount = 0;

$error = false;

if (isset($_POST['updateTemplate'])) {

    $valueNames = ["subject", "description", "defaultTasks"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }
    if (strlen($subject) == 0) {
        $error = true;
        $title_error = true;
    }

    if (!isset($defaultTasks) || $defaultTasks == null || $defaultTasks == "") {
        $error = true;
        $default_task_error = true;
    }
    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
    }

    if (!$error) {

        $templateinfo = [
            'id' => $id,
            'onderwerp' => strip_tags($subject),
            'beschrijving' => strip_tags($description)
        ];

        $template->update($templateinfo);

        $templateTaskLinksController->deleteByTemplateId($id);

        if ($defaultTasks != null && isset($defaultTasks)) {
            $tasksId = explode("-", $defaultTasks);
            foreach ($tasksId as $taskid) {
                if (isset($taskid) && $taskid != null) {
                    $t = $taskController->getTaskById($taskid);
                    if ($t['subject'] != null && isset($t['subject'])) {
                        $taskinfo = [
                            'idTemplate' => (int)$id,
                            'idTask' => (int)$taskid
                        ];
                        $templateTaskLinksController->create($taskinfo);
                    }
                }
            }
        }
    }
}

$templateTasksId = $templateTaskLinksController->getTaskByTemplateId($id);

foreach ($templateTasksId as $tTask) {
    array_push($allTemplateTasks, $taskController->getTaskById($tTask['idTask']));
}


if (isset($_POST['delete'])) {
    if ($taskController->delete($id)) {
        $block->Redirect('index.php?page=tasksoverview');
    }
}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEMPLATE_VIEW ?></h1>
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
                       value="<?= $templateinfo['onderwerp'] ?>">

            </div>

            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($description_error)) {
                    echo "error-input";
                } ?>"><?= $templateinfo['beschrijving'] ?></textarea>

            </div>

            <div class="button-update">
                <div class="button-push"></div>
                <button type="submit" name="updateTemplate"
                        class="custom-file-upload" onclick="ez()"><?= TEXT_EDIT ?></button>
            </div>

            <input type="hidden" name="defaultTasks" id="defaultTasks">
        </form>
    </div>

    <div class="add-right-content add-content">
        <div class="crm-add">
            <br>
            <br>
            <div>
                <label><?= TEXT_TASK_ADD ?></label>
                <select id="tasklist" class="<?php if (isset($default_task_error)) {
                    echo "error-input";
                } ?>">
                    <option value=0 selected> -</option>
                    <?php foreach ($defaultTask as $task) { ?>
                        <option value="<?= $task['id'] ?>"> <?= $task['subject'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_TASK_OVERVIEW ?></label>
                <div id="taken-lijst" >
                    <ul id="sortable">
                    <?php foreach ($allTemplateTasks as $task) {
                        $amount++ ?>
                        <script>amount += 1</script>
                        <li id="dt<?= $amount ?>" class="ui-state-default"
                            value="<?= $task['id'] ?>"><?= $task['subject'] ?>
                            <button class="custom-file-upload" onclick="deleteTask(dt<?= $amount ?>)">x</button>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript">

    var amount = <?= $amount?>;

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

    $("#sortable").change(function () {
        var list = document.getElementById("sortable");
        var id = list.options[list.selectedIndex].text;

        console.log("dt: " + dt[id]);

    });

    function deleteTask(task) {
        var parent = document.getElementById("sortable");
        var child = document.getElementById(task.id);
        console.log("dt" + task.id)
        parent.removeChild(child);
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


