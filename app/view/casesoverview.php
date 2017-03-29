<?php
$case = new CaseController();

$allCases = $case->getAllCases();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

$projectController = new ProjectController();
$projects = $projectController->getAllProjects();

?>

<div id="case-overview-holder">

    <header><?= CASE_OVERVIEW_TEXT ?></header>
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
                <th>Project</th>
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
                                $hasCase = false;
                                foreach ($users as $user) {
                                    if ($user['id'] == $case['user']) {
                                        echo $user['naam'];
                                        $hasCase = true;
                                    }
                                }
                                ?></a>
                            <?php
                            if (!$hasCase) {
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
                            test
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