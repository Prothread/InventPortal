<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 26-4-2017
 * Time: 14:02
 */
?>
<script type="text/javascript">

    var amount = 0;

    var tasks = "";

    var dt = {

        <?php foreach ($defaultTask as $task) {
        echo $task['id'] . ':"' . $task['subject'] . '",';
    } ?>

    };

    function addTask(id) {
        var ul = document.getElementById("sortable");
        var li = document.createElement("li");
        var btn = document.createElement("button");
        var dtName = document.createElement("p");
        ul.appendChild(li);
        li.appendChild(dtName);
        dtName.appendChild(document.createTextNode(dt[id]));
        btn.appendChild(document.createTextNode("x"));
        li.appendChild(btn);

        li.setAttribute("value", id);
        li.setAttribute("class", "ui-state-default");
        amount += 1;

        li.setAttribute("id", "dt" + amount);

        btn.setAttribute("onclick", "deleteTask(" + "dt" + amount + ")");
        btn.setAttribute("class", "custom-file-upload");
        var liHeight = $("#dt" + amount).height();
        $(btn).css("height", liHeight);
    }

    $("#tasklist").change(function () {
        var list = document.getElementById("tasklist");
        var id = list.options[list.selectedIndex].value;

        addTask(id);

        list.selectedIndex = 0;

    });

    <?php
    if($type != 'template'){
    foreach ($templates as $template){
    ?>
    var template<?=$template['id']?> = [<?php
        $ids = $templateTaskLinksController->getTaskByTemplateId($template['id']);
        if (!is_null($ids)) {
            foreach ($ids as $id) {
                echo $id['idTask'] . ',';
            }
        }?>
    ];
    <?php }}?>

    $("#templatelist").change(function () {
        var list = document.getElementById("templatelist");
        var id = list.options[list.selectedIndex].value;

        var templatename = 'template' + id;
        for (i = 0; i < eval(templatename).length; i++) {
            addTask(eval(templatename)[i]);
        }

        list.selectedIndex = 0;

    });

    $("#sortable").change(function () {
        var list = document.getElementById("sortable");
        var id = list.options[list.selectedIndex].text;
    });

    function deleteTask(task) {
        var parent = document.getElementById("sortable");
        var child = document.getElementById(task.id);
        parent.removeChild(child);
    }

    function getTasks() {
        tasks = "";
        $('#sortable li').each(function (i) {
            tasks += $(this).attr('value') + "-";
        });
        $('#defaultTasks').val(tasks);
    }

    <?php
    if(isset($_POST) && $error == true && $_POST['defaultTasks'] != '-'){
    ?>
    var taskPost = "<?= $_POST['defaultTasks'] ?>";
    var defaultTasks = taskPost.split('-');
    jQuery.each(defaultTasks, function (i, value) {
        if (value != "") {
            addTask(value);
        }
    });
    <?php
    }else if(isset($allTemplateTasks)){
    ?>
    var defaultTasks = [<?php
        foreach ($allTemplateTasks as $task) {
            echo '"' . $task['id'] . '",';
        }
        ?>
    ];
    jQuery.each(defaultTasks, function (i, value) {
        if (value != "") {
            addTask(value);
        }
    });
    <?php
    }
    ?>
</script>