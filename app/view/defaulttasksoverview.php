<?php
$task = new TaskController();

$allTasks = $task->getAllTasksByStatus(4);

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$project = new ProjectController();
$allProjects = $project->getAllProjects();

?>

<div id="case-overview-holder" class="crm-content-wrapper">

    <h1 class="crm-content-header">Standaard taken Overzicht</h1>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload overview-add-button" onclick="window.location.href='?page=adddefaulttask'">Aanmaken
        </button>
        <button class="custom-file-upload">Archief</button>
    </div>
    <div class="case-overvieuw-table">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th>Onderwerp</th>
                <th>Beschrijving</th>
            </tr>
            </thead>
            <tbody>
            <?php if (sizeof($allTasks) > 0) { ?>
                <?php foreach ($allTasks as $task) {
                    ?>
                    <tr>
                        <td>
                            <a href="?page=defaulttaskview&id=<?= $task['id'] ?>"><?= $task['subject'] ?></a>
                        </td>
                        <td>
                            <?= $task['description'] ?>
                        </td>
                    </tr>
                <?php }
            } ?>
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