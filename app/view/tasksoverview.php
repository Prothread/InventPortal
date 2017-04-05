<?php
$task = new TaskController();

$TheTasks = $task->getAllTasks();

$allTasks = array();

foreach ($TheTasks as $task){
    if($task['status'] != 4) {
        array_push($allTasks, $task);
    }
}

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$project = new ProjectController();
$allProjects = $project->getAllProjects();

?>

<div id="case-overview-holder" class="crm-content-wrapper">

    <h1 class="crm-content-header">Taken Overzicht</h1>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload overview-add-button" onclick="window.location.href='?page=addtask'">Aanmaken
        </button>
        <button class="custom-file-upload">Archief</button>
    </div>
    <div class="case-overvieuw-table">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th>Onderwerp</th>
                <th>Werknemer</th>
                <th>Klant</th>
                <th>Project</th>
                <th>Opdracht</th>
                <th>Duur</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php if (sizeof($allTasks) > 0) { ?>
                <?php foreach ($allTasks as $task) {
                    $hasUser = false;
                    $hasClient = false;
                    $hasProject = false;
                    ?>
                    <tr>
                        <td>
                            <a href="?page=taskview&id=<?= $task['id'] ?>"><?= $task['subject'] ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $task['user'] ?>"> <?php
                                foreach ($users as $user) {
                                    if ($user['id'] == $task['user']) {
                                        $hasUser = true;
                                        echo $user['naam'];
                                    }
                                }
                                ?></a>
                            <?php
                            if (!$hasUser) {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $task['client'] ?>"> <?php
                                if (!is_null($clients)) {
                                    foreach ($clients as $client) {
                                        if ($client['id'] == $task['client']) {
                                            echo $client['naam'];
                                            $hasClient = true;
                                        }
                                    }
                                } ?></a>
                            <?php
                            if (!$hasClient) {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="?page=projectview&id=<?= $task['project'] ?>"> <?php
                                if (!is_null($allProjects)) {
                                    foreach ($allProjects as $project) {
                                        if ($project['id'] == $task['project']) {
                                            echo $project['subject'];
                                            $hasProject = true;
                                        }
                                    }
                                }
                                ?></a>
                            <?php
                            if (!$hasProject) {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="#">TEST</a>
                        </td>
                        <td>
                            <?= $task['duration'] ?>
                        </td>
                        <td>
                            <img src="css/status-<?= $task['status'] ?>.png">
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#myTable').dataTable({
            "order": [[0, "desc"]],
            "deferRender": true
        });

    });
</script>