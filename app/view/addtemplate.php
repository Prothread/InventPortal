
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

$error = false;

$taskController = new TaskController();
$defaultTask = $taskController->getAllTasksByStatus(4);

$templateController = new templateController();
$templateTaskLinksController = new TemplateTaskLinksController();

if (isset($_POST['create'])) {
    $post = true;
    $valueNames = ["subject", "description", "defaultTasks"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }

    if (strlen($subject) == 0) {
        $error = true;
        $subject_error = true;
    }
    if (!filter_var($description, FILTER_SANITIZE_STRING)) {
        $error = true;
        $description_error = true;
    }
    if (!$error) {

        $templateinfo = [
            'subject' => strip_tags($subject),
            'description' => strip_tags($description),
        ];

        if ($id = $templateController->create($templateinfo)) {

            if($defaultTasks != null && isset($defaultTasks)){
                $tasksId = explode("-", $defaultTasks);
                foreach ($tasksId as $taskid) {
                    $t = $taskController->getTaskById($taskid);
                    if($t['subject'] != null && isset($t['subject'])) {
                        $templatetaskinfo = [
                            'idTemplate' => (int)$id,
                            'idTask' => (int)$taskid
                        ];

//                        var_dump($templatetaskinfo);
//                        die();

                        $templateTaskLinksController->create($templatetaskinfo);
                    }
                }
            }

            $block = new BlockController();
            $block->Redirect('index.php?page=templateview&id=' . $id);
        } else {

        }
    }
}

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_TEMPLATE_CREATE ?></h1>
        <form class="crm-add" action="#" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" class="form-control" name="subject">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description"></textarea>
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

    $("#tasklist").change(function () {
        var list = document.getElementById("tasklist");
        var id = list.options[list.selectedIndex].value;

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