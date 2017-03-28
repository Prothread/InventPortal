<?php
$projectController = new ProjectController();

$allProjects = $projectController->getAllProjects();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

?>

<div id="case-overview-holder">

    <header><?= PROJECT_OVERVIEW_TEXT ?></header>
    <hr>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
        <button class="custom-file-upload"><?= TEXT_ARCHIVE ?></button>
    </div>
    <div class="case-overvieuw-table">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th><?= TABLE_SUBJECT ?></th>
                <th><?= TEXT_EMPLOYEE ?></th>
                <th><?= TEXT_SINGLE_CLIENT ?></th>
                <th><?= TEXT_END_DATE ?></th>
                <th><?= TEXT_PROGRESS ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($allProjects as $project) { ?>

                <tr>
                    <td>
                        <a href="?page=projectview&id= <?= $project['id'] ?>"><?= $project['subject'] ?></a>
                    </td>
                    <td>
                        <a href="?page=showuserprofile&id=<?= $project['user'] ?>"> <?php
                            foreach ($users as $user) {
                                if ($user['id'] == $project['user']) {
                                    echo $user['naam'];
                                }
                            }
                            ?></a>
                    </td>
                    <td>
                        <a href="?page=showuserprofile&id=<?= $project['client'] ?>"> <?php
                            foreach ($clients as $client) {
                                if ($client['id'] == $project['client']) {
                                    echo $client['naam'];
                                }
                            }
                            ?></a>
                    </td>
                    <td>
                        <?= $project['endDate'] ?>
                    </td>
                    <td>
                        <img src="css/status-<?= $project['status'] ?>.png">
                    </td>
                </tr>

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