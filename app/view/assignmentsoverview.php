<?php
$assignmentController = new AssignmentController();
$allAssignments = $assignmentController->getAllAssignments();

$projectController = new ProjectController();
$projects = $projectController->getAllProjects();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

?>

<div id="case-overview-holder">

    <header><?= ASSIGNMENT_OVERVIEW_TEXT ?></header>
    <hr>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload"
                onclick="window.location.href='?page=addassignment'"><?= TEXT_CREATE_DROPDOWN ?></button>
        <button class="custom-file-upload"><?= TEXT_ARCHIVE ?></button>
    </div>
    <div class="case-overvieuw-table">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th><?= TABLE_SUBJECT ?></th>
                <th><?= TEXT_EMPLOYEE ?></th>
                <th><?= TEXT_SINGLE_CLIENT ?></th>
                <th><?= TEXT_PROJECT_ADD ?></th>
                <th><?= TEXT_END_DATE ?></th>
                <th><?= TEXT_PROGRESS ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($allAssignments) > 0) {
                foreach ($allAssignments as $assignment) { ?>

                    <tr>
                        <td>
                            <a href="?page=assignmentview&id= <?= $assignment['id'] ?>"><?= $assignment['subject'] ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $assignment['user'] ?>"> <?php
                                foreach ($users as $user) {
                                    if ($user['id'] == $assignment['user']) {
                                        echo $user['naam'];
                                    }
                                }
                                ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $assignment['client'] ?>"> <?php
                                foreach ($clients as $client) {
                                    if ($client['id'] == $assignment['client']) {
                                        echo $client['naam'];
                                    }
                                }
                                ?></a>
                        </td>
                        <td>
                            <a href="?page=projectview&id=<?= $assignment['project'] ?>"> <?php
                                foreach ($projects as $project) {
                                    if ($project['id'] == $assignment['project']) {
                                        echo $project['subject'];
                                    }
                                }
                                ?></a>
                        </td>
                        <td>
                            <?= date("d-m-Y", strtotime($assignment['endDate'])) ?>
                        </td>
                        <td>
                            <img src="css/status-<?= $assignment['status'] ?>.png">
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