<?php

$tenderController = new TenderController();
$allTenders = $tenderController->getTendersByStatus(0);

$projectController = new ProjectController();
$allProjects = $projectController->getProjectsByStatus(0);

$caseController = new CaseController();
$allCases = $caseController->getCasesByStatus(0);

$assignmentController = new AssignmentController();
$allAssignments = $assignmentController->getAssignmentsByStatus(0);

$taskController = new TaskController();
$tasks = $taskController->getTasksByStatus(0);

$userController = new UserController();
$clients = $userController->getClientList();

?>

<div id="crm-dashboard-holder">

    <div class="crm-dashboard-row">
        <header><?= OPEN_TENDERS ?></header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addtender'"><?= TEXT_CREATE_DROPDOWN ?></button>
            <?php foreach ($allTenders as $tender) {
                $timeDiff = $tenderController->getTimeDifference($tender['enddate'], date("Y-m-d"))
                ?>
                <div class="crm-dashboard-box">
                    <?php if ($timeDiff <= 0) { ?>
                        <img class="deadline" src="css/deadline4.png">
                    <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                        <img class="deadline" src="css/deadline3.png">
                    <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                        <img class="deadline" src="css/deadline2.png">
                    <?php } else { ?>
                        <img class="deadline" src="css/deadline1.png">
                    <?php } ?>
                    <ul>
                        <li>
                            <a href="?page=tenderview&id= <?= $tender['id'] ?>"><?= $tender['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $tender['client']) {
                                    ?>
                                    <a href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php
                                }
                            } ?>
                        </li>
                        <li>
                            <?= date("d-m-Y", strtotime($tender['enddate'])) ?>
                        </li>
                    </ul>
                    <a class="toewijzenlink" href=""><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header><?= OPEN_PROJECTS ?></header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>
        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addproject'"><?= TEXT_CREATE_DROPDOWN ?></button>
            <?php foreach ($allProjects as $project) {
                $timeDiff = $projectController->getTimeDifference($project['endDate'], date("Y-m-d"))
                ?>
                <div class="crm-dashboard-box">
                    <?php if ($timeDiff <= 0) { ?>
                        <img class="deadline" src="css/deadline4.png">
                    <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                        <img class="deadline" src="css/deadline3.png">
                    <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                        <img class="deadline" src="css/deadline2.png">
                    <?php } else { ?>
                        <img class="deadline" src="css/deadline1.png">
                    <?php } ?>
                    <ul>
                        <li>
                            <a href="?page=projectview&id=<?= $project['id'] ?>"><?= $project['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $project['client']) {
                                    ?>
                                    <a href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php
                                }
                            } ?>
                        </li>
                        <li>
                            <?= date("d-m-Y", strtotime($project['endDate'])) ?>
                        </li>
                    </ul>
                    <a class="toewijzenlink" href=""><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header><?= OPEN_ASSIGNMENTS ?></header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addassignment'"><?= TEXT_CREATE_DROPDOWN ?></button>
            <?php foreach ($allAssignments as $assignment) {
                $timeDiff = $assignmentController->getTimeDifference($assignment['endDate'], date("Y-m-d"));
                ?>
                <div class="crm-dashboard-box">
                    <?php if ($timeDiff <= 0) { ?>
                        <img class="deadline" src="css/deadline4.png">
                    <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                        <img class="deadline" src="css/deadline3.png">
                    <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                        <img class="deadline" src="css/deadline2.png">
                    <?php } else { ?>
                        <img class="deadline" src="css/deadline1.png">
                    <?php } ?>
                    <ul>
                        <li>
                            <a href="?page=assignmentview&id=<?= $assignment['id'] ?>"><?= $assignment['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $assignment['client']) {
                                    ?>
                                    <a href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php
                                }
                            } ?>
                        </li>
                        <li>
                            <?= date("d-m-Y", strtotime($assignment['endDate'])) ?>
                        </li>
                    </ul>
                    <a class="toewijzenlink" href=""><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header>Open taken</header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>

        <div class="crm-dashboard-inside-row">

            <button class="custom-file-upload">Aanmaken</button>

            <?php foreach ($tasks as $task) {
                $timeDiff = $taskController->getTimeDifference($task['enddate'], date("Y-m-d"))
                ?>
                <div class="crm-dashboard-box">
                    <?php if ($timeDiff <= 0) { ?>
                        <img class="deadline" src="css/deadline4.png">
                    <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                        <img class="deadline" src="css/deadline3.png">
                    <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                        <img class="deadline" src="css/deadline2.png">
                    <?php } else { ?>
                        <img class="deadline" src="css/deadline1.png">
                    <?php } ?>
                    <ul>
                        <li>
                            <a href="?page=taskview&id=<?= $task['id'] ?>"><?= $task['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $task['client']) {
                                    ?>
                                    <a href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php
                                }
                            } ?>
                        </li>
                        <li>
                            <?= date("d-m-Y", strtotime($task['enddate'])) ?>
                        </li>
                    </ul>
                    <a class="toewijzenlink" href="">Toewijzen</a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header><?= OPEN_CASES ?></header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload" onclick="window.location.href='?page=addcase'">Aanmaken</button>
            <?php foreach ($allCases as $case) {
                $timeDiff = $projectController->getTimeDifference($case['enddate'], date("Y-m-d"))
                ?>
                <div class="crm-dashboard-box">
                    <?php if ($timeDiff <= 0) { ?>
                        <img class="deadline" src="css/deadline4.png">
                    <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                        <img class="deadline" src="css/deadline3.png">
                    <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                        <img class="deadline" src="css/deadline2.png">
                    <?php } else { ?>
                        <img class="deadline" src="css/deadline1.png">
                    <?php } ?>
                    <ul>
                        <li>
                            <a href="?page=caseview&id=<?= $case['id'] ?>"><?= $case['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $case['client']) {
                                    ?>
                                    <a href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php
                                }
                            } ?>
                        </li>
                        <li>
                            <?= date("d-m-Y", strtotime($case['enddate'])) ?>
                        </li>
                    </ul>
                    <a class="toewijzenlink" href=""><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>