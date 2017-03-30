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

<div id="case-overview-holder" class="crm-content-wrapper">

    <h1 class="crm-content-header"><?= CASE_OVERVIEW_TEXT ?></h1>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload overview-add-button" onclick="window.location.href='?page=addcase'"><?= TEXT_CREATE_DROPDOWN ?></button>
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
                <?php foreach ($allCases as $case) {
                    $hasUser = false;
                    $hasClient = false;
                    $hasProject = false;
                    $hasCase = false;
                    $hasAssignment = false;
                    ?>
                    <tr>
                        <td>
                            <a href="?page=caseview&id= <?= $case['id'] ?>"><?= $case['subject'] ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $case['user'] ?>"> <?php
                                $hasCase = false;
                                foreach ($users as $user) {
                                    if ($user['id'] == $case['user']) {
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
                            <a href="?page=showuserprofile&id=<?= $case['client'] ?>"> <?php
                                $hasClient = false;
                                foreach ($clients as $client) {
                                    if ($client['id'] == $case['client']) {
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
                            <a href="?page=projectview&id=<?= $case['project'] ?>"> <?php
                                $hasProject = false;
                                foreach ($projects as $project) {
                                    if ($project['id'] == $case['project']) {
                                        echo $project['subject'];
                                        $hasProject = true;
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
                            <a href="?page=assignmentview&id=<?= $case['assignment'] ?>"> <?php
                                foreach ($assignments as $assignment) {
                                    if ($assignment['id'] == $case['assignment']) {
                                        echo $assignment['subject'];
                                        $hasAssignment = true;
                                    }
                                }
                                ?></a>
                            <?php
                            if (!$hasAssignment) {
                                echo "-";
                            }
                            ?>
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