<?php
$case = new CaseController();

$allCases = $case->getAllCases();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$projectController = new ProjectController();
$projects = $projectController->getAllProjects();

$assignmentController = new AssignmentController();
$assignments = $assignmentController->getAllAssignments();

?>

<div id="case-overview-holder">

    <header><?= CASES_OVERVIEW_TEXT ?></header>
    <hr>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
        <button class="custom-file-upload"><?= TEXT_ARCHIVE ?></button>
    </div>
    <div class="case-overvieuw-table">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th><?= TABLE_TITLE ?></th>
                <th><?= TEXT_EMPLOYEE ?></th>
                <th><?= TEXT_CLIENT ?></th>
                <th><?= TEXT_PROJECT_ADD ?></th>
                <th><?= TEXT_ASSIGNMENT_ADD ?></th>
                <th><?= TEXT_END_DATE ?></th>
                <th><?= TEXT_PROGRESS ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (sizeof($allCases) > 0) { ?>
                <?php foreach ($allCases as $case) { ?>

                    <tr>
                        <td>
                            <a href="?page=caseview&id= <?= $case['id'] ?>"><?= $case['subject'] ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $case['user'] ?>"> <?php
                                foreach ($users as $user) {
                                    if ($user['id'] == $case['user']) {
                                        echo $user['naam'];
                                    }
                                }
                                ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $case['client'] ?>"> <?php
                                foreach ($clients as $client) {
                                    if ($client['id'] == $case['client']) {
                                        echo $client['naam'];
                                    }
                                }
                                ?></a>
                        </td>
                        <td>
                            <a href="?page=projectview&id=<?= $case['project'] ?>"> <?php
                                foreach ($projects as $project) {
                                    if ($project['id'] == $case['project']) {
                                        echo $project['subject'];
                                    }
                                }
                                ?></a>
                        </td>
                        <td>
                            <a href="?page=assignmentview&id=<?= $case['assignment'] ?>"> <?php
                                foreach ($assignments as $assignment) {
                                    if ($assignment['id'] == $case['assignment']) {
                                        echo $assignment['subject'];
                                    }
                                }
                                ?></a>
                        </td>
                        <td>
                            <?= date("d-m-Y", strtotime($case['enddate'])) ?>
                        </td>
                        <td>
                            <img src="css/status-<?= $case['status'] ?>.png">
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