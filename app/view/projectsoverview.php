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
        <button class="custom-file-upload"
                onclick="window.location.href='?page=addproject'"><?= TEXT_CREATE_DROPDOWN ?></button>
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
            <?php
            if (sizeof($allProjects) > 0) {
                foreach ($allProjects as $project) {
                    $hasUser = false;
                    $hasClient = false;
                    ?>
                    <tr>
                        <td>
                            <a href="?page=projectview&id=<?= $project['id'] ?>"><?= $project['subject'] ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $project['user'] ?>"> <?php
                                foreach ($users as $user) {
                                    if ($user['id'] == $project['user']) {
                                        echo $user['naam'];
                                        $hasUser = true;
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
                            <a href="?page=showuserprofile&id=<?= $project['client'] ?>"> <?php
                                foreach ($clients as $client) {
                                    if ($client['id'] == $project['client']) {
                                        echo $client['naam'];
                                        $hasClient = true;
                                    }
                                }
                                ?></a>
                            <?php
                            if (!$hasClient) {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td>
                            <?= date("d-m-Y", strtotime($project['endDate'])) ?>
                        </td>
                        <td>
                            <img src="css/status-<?= $project['status'] ?>.png">
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