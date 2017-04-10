
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

$tender = new TenderController();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$taskController = new TaskController();
$defaultTask = $taskController->getAllTasksByStatus(4);

$templateTaskLinksController = new TemplateTaskLinksController();

$templateController = new templateController();
$templates = $templateController->getAllTemplates();

$error = false;

$post = false;

if (isset($_POST['create'])) {
    $post = true;

    $valueNames = ["subject", "client", "user", "validity", "value", "chance", "creationDate", "description", "defaultTasks"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }

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

    if ($user == 0) {
        $status = 0;
    } else {
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

            if($defaultTasks != null && isset($defaultTasks)){
                $tasksId = explode("-", $defaultTasks);
                foreach ($tasksId as $taskid) {
                    $t = $taskController->getTaskById($taskid);
                    if($t['subject'] != null && isset($t['subject'])) {
                        $taskinfo = [
                            'idTemplate' => (int)$id,
                            'idTask' => (int)$taskid
                        ];
                        $templateTaskLinksController->create($taskinfo);
                    }
                }
            }

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
                <input type="text" name="subject" class="form-control <?php if (isset($title_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php if (isset($_POST['subject'])) {
                           echo $_POST['subject'];
                       } ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control <?php if (isset($client_error)) {
                    echo "error-input";
                } ?>" name="client">
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
                <input type="number" class="form-control <?php if (isset($validity_error)) {
                    echo "error-input";
                } ?>" name="validity" min="1" value="<?php if (isset($_POST['validity'])) {
                    echo $_POST['validity'];
                } ?>">
            </div>
            <div>
                <label><?= TEXT_VALUE ?></label>
                <input type="number" class="form-control <?php if (isset($value_error)) {
                    echo "error-input";
                } ?>" name="value" value="<?php if (isset($_POST['value'])) {
                    echo $_POST['value'];
                } ?>">
            </div>
            <div>
                <label><?= TEXT_CHANCE ?></label>
                <input type="number" class="form-control" name="chance" max="100"
                       value="<?php if (isset($_POST['chance'])) {
                           echo $_POST['chance'];
                       } ?>">
            </div>
            <div>
                <label><?= TEXT_CREATION_DATE ?></label>
                <input type="date" class="form-control <?php if (isset($creationDate_error)) {
                    echo "error-input";
                } ?>" name="creationDate"
                       value="<?php if (isset($_POST['creationdate'])) {
                           echo $_POST['creationdate'];
                       } else {
                           echo date("d-m-y");
                       } ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($description_error)) {
                    echo "error-input";
                } ?>"><?php if (isset($_POST['description'])) {
                        echo $_POST['description'];
                    } ?></textarea>
            </div>
            <!--            Bestanden uploaden moet nog toegevoegd worden-->
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
