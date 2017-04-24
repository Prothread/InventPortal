<?php

$_SESSION['test'] = 'test';

$thisUserId = $_SESSION['usr_id'];

$tenderCon = new TenderController();
$allTenders = $tenderCon->getTendersByUserId($thisUserId);

$projectController = new ProjectController();
$allProjects = $projectController->getProjectsByUserId($thisUserId);

$assignmentController = new AssignmentController();
$allAssignments = $assignmentController->getAssignmentsByUserId($thisUserId);

$caseController = new CaseController();
$allCases = $caseController->getCasesByUserId($thisUserId);

$taskController = new TaskController();
$allTasks = $taskController->getTasksByUserId($thisUserId);

$userController = new UserController();
$clients = $userController->getClientList();

?>

<div id="crm-dashboard-holder" class="crm-content-wrapper">

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= YOUR_TENDER ?></h1>

        <select class="crm-dashboard-select" id="Tenderselect" onchange="changeFunc('Tenderselect');">
            <option value="standaard" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addtender'"><?= TEXT_CREATE_DROPDOWN ?></button>
            <div id="containerTenderselect">
                <?php $amount = 0;
                foreach ($allTenders as $tender) {
                    $amount++;
                    $timeDiff = $tenderCon->getTimeDifference($tender['endDate'], date("Y-m-d"))
                    ?>
                    <div <?php if ($amount > 5){ ?> style="display: none"
                                                    <?php } ?>class="crm-dashboard-box boxesTenderselect">
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
                                <a class="subjectLinkTenderselect"
                                   href="?page=tenderview&id=<?= $tender['id'] ?>"><?= $tender['subject'] ?></a>
                            </li>
                            <li>
                                <?php foreach ($clients as $client) {
                                    if ($client['id'] == $tender['client']) {
                                        ?>
                                        <a class="clientLinkTenderselect"
                                           href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                        <?php
                                    }
                                } ?>
                            </li>
                            <li class="crm-dashboard-dateTenderselect">
                                <?= date("d-m-Y", strtotime($tender['endDate'])) ?>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= YOUR_PROJECT ?></h1>

        <select class="crm-dashboard-select" id="Projectselect" onchange="changeFunc('Projectselect');">
            <option value="" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addproject'"><?= TEXT_CREATE_DROPDOWN ?></button>
            <div id="containerProjectselect">
                <?php $amount = 0;
                foreach ($allProjects as $project) {
                    $amount++;
                    $timeDiff = $projectController->getTimeDifference($project['endDate'], date("Y-m-d"));
                    ?>
                    <div <?php if ($amount > 5){ ?> style="display: none"
                                                    <?php } ?>class="crm-dashboard-box boxesProjectselect">
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
                                <a class="subjectLinkProjectselect"
                                   href="?page=projectview&id=<?= $project['id'] ?>"><?= $project['subject'] ?></a>
                            </li>
                            <li>
                                <?php foreach ($clients as $client) {
                                    if ($client['id'] == $project['client']) {
                                        ?>
                                        <a class="clientLinkProjectselect"
                                           href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                        <?php
                                    }
                                } ?>
                            </li>
                            <li class="crm-dashboard-dateProjectselect">
                                <?= date("d-m-Y", strtotime($project['endDate'])) ?>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= YOUR_ASSIGNMENT ?></h1>

        <select class="crm-dashboard-select" id="Assignmentselect" onchange="changeFunc('Assignmentselect');">
            <option value="standaard" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addassignment'"><?= TEXT_CREATE_DROPDOWN ?></button>
            <div id="containerAssignmentselect">
                <?php $amount = 0;
                foreach ($allAssignments as $assignment) {
                    $amount++;
                    $timeDiff = $assignmentController->getTimeDifference($assignment['endDate'], date("Y-m-d"));
                    ?>
                    <div <?php if ($amount > 5){ ?> style="display: none"
                                                    <?php } ?>class="crm-dashboard-box boxesAssignmentselect">
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
                                <a class="subjectLinkAssignmentselect"
                                   href="?page=assignmentview&id=<?= $assignment['id'] ?>"><?= $assignment['subject'] ?></a>
                            </li>
                            <li>
                                <?php foreach ($clients as $client) {
                                    if ($client['id'] == $assignment['client']) {
                                        ?>
                                        <a class="clientLinkAssignmentselect"
                                           href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                        <?php
                                    }
                                } ?>
                            </li>
                            <li class="crm-dashboard-dateAssignmentselect">
                                <?= date("d-m-Y", strtotime($assignment['endDate'])) ?>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= YOUR_TASK ?></h1>

        <select class="crm-dashboard-select" id="Taskselect" onchange="changeFunc('Taskselect');">
            <option value="standaard" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
            <option value="urgentie"><?= TEXT_URGENCY ?></option>
        </select>

        <div class="crm-dashboard-inside-row">

            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addtask'"><?= TEXT_CREATE_DROPDOWN ?> </button>
            <div id="containerTaskselect">
                <?php $amount = 0;
                foreach ($allTasks as $task) {
                    $amount++;
                    $timeDiff = $tenderCon->getTimeDifference($task['endDate'], date("Y-m-d"))
                    ?>
                    <div <?php if ($amount > 5){ ?> style="display: none"
                                                    <?php } ?>class="crm-dashboard-box boxesTaskselect">
                        <?php if ($timeDiff <= 0) { ?>
                            <img class="deadline" src="css/deadline4.png">
                        <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                            <img class="deadline" src="css/deadline3.png">
                        <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                            <img class="deadline" src="css/deadline2.png">
                        <?php } else { ?>
                            <img class="deadline" src="css/deadline1.png">
                        <?php } ?>
                        <?php if ($task['urgency'] == 0) { ?>

                        <?php } else if ($task['urgency'] == 1) { ?>
                            <img class="urgencyImage" src="css/urgentie1.png">
                        <?php } else if ($task['urgency'] == 2) { ?>
                            <img class="urgencyImage" src="css/urgentie2.png">
                        <?php } else if ($task['urgency'] == 3) { ?>
                            <img class="urgencyImage" src="css/urgentie3.png">
                        <?php } else if ($task['urgency'] == 4) { ?>
                            <img class="urgencyImage" src="css/urgentie4.png">
                        <?php } ?>
                        <ul>
                            <li>
                                <a class="subjectLinkTaskselect"
                                   href="?page=taskview&id= <?= $task['id'] ?>"><?= $task['subject'] ?></a>
                            </li>
                            <li>
                                <?php foreach ($clients as $client) {
                                    if ($client['id'] == $task['client']) { ?>
                                        <a class="clientLinkTaskselect"
                                           href="?page=showuserprofile&id= <?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php }
                                } ?>
                            </li>
                            <li class="crm-dashboard-dateTaskselect">
                                <?= date("d-m-Y", strtotime($task['endDate'])) ?>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= YOUR_CASE ?></h1>

        <select class="crm-dashboard-select" id="Caseselect" onchange="changeFunc('Caseselect');">
            <option value="standaard" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
        </select>

        <div class="crm-dashboard-inside-row">

            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addcase'"><?= TEXT_CREATE_DROPDOWN ?> </button>
            <div id="containerCaseselect">
                <?php $amount = 0;
                foreach ($allCases as $case) {
                    $amount++;
                    $timeDiff = $tenderCon->getTimeDifference($case['endDate'], date("Y-m-d"))
                    ?>
                    <div <?php if ($amount > 5){ ?> style="display: none"
                                                    <?php } ?>class="crm-dashboard-box boxesCaseselect">
                        <?php if ($timeDiff <= 0) { ?>
                            <img class="deadline" id="1" src="css/deadline4.png">
                        <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                            <img class="deadline" id="2" src="css/deadline3.png">
                        <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                            <img class="deadline" id="3" src="css/deadline2.png">
                        <?php } else { ?>
                            <img class="deadline" id="4" src="css/deadline1.png">
                        <?php } ?>
                        <ul>
                            <li>
                                <a class="subjectLinkCaseselect"
                                   href="?page=caseview&id= <?= $case['id'] ?>"><?= $case['subject'] ?></a>
                            </li>
                            <li>
                                <?php foreach ($clients as $client) {
                                    if ($client['id'] == $case['client']) { ?>
                                        <a class="clientLinkCaseselect"
                                           href="?page=showuserprofile&id= <?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php }
                                } ?>
                            </li>
                            <li class="crm-dashboard-dateCaseselect">
                                <?= date("d-m-Y", strtotime($case['endDate'])) ?>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>

    var selectedValue;
    var $divs;

    function changeFunc(id) {
        var selectBox = document.getElementById(id);
        selectedValue = selectBox.options[selectBox.selectedIndex].value;

        if (id == "Caseselect") {
            $divs = $("div.boxesCaseselect");
        } else if (id == "Taskselect") {
            $divs = $("div.boxesTaskselect");
        } else if (id == "Assignmentselect") {
            $divs = $("div.boxesAssignmentselect");
        } else if (id == "Projectselect") {
            $divs = $("div.boxesProjectselect");
        } else if (id == "Tenderselect") {
            $divs = $("div.boxesTenderselect");
        }

        for (i = 0; i < $divs.length; i++) {
            if (i < 5) {
                $divs[i].style.display = "block";
            } else {
                $divs[i].style.display = "none";
            }
        }

        if (selectedValue == "onderwerp") {
            sortSubject(id);
        }
        if (selectedValue == "klant") {
            sortClient(id);
        }
        if (selectedValue == "datum") {
            sortDate(id);
        }
        if (selectedValue == "urgentie") {
            sortUrgency(id);
        }
        selectBox.selectedIndex = 0;
    }

    var sort = [];
    var sort0;
    var sort1;
    var sort2;
    var sort3;
    sort.add(sort0);
    sort.add(sort1);
    sort.add(sort2);
    sort.add(sort3);

    function sortSubject(id) {
        resetSort(0);
        sort[0]++;
        var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
            var subjectLink = $(".subjectLink" + id);
            if (sort[0] == 1) {
                return $(a).find(subjectLink).text() < $(b).find(subjectLink).text();
            } else {
                sort[0] = 0;
                return $(a).find(subjectLink).text() > $(b).find(subjectLink).text();
            }
        });
        $("#container" + id).html(alphabeticallyOrderedDivs);
    }

    function sortClient(id) {
        resetSort(1);
        sort[1]++;
        var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
            var clientLink = $(".clientLink" + id);
            if (sort[1] == 1) {
                return $(a).find(clientLink).text() < $(b).find(clientLink).text();
            } else {
                sort[1] = 0;
                return $(a).find(clientLink).text() > $(b).find(clientLink).text();
            }
        });
        $("#container" + id).html(alphabeticallyOrderedDivs);
    }

    function sortDate(id) {
        resetSort(2);
        sort[2]++;
        var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
            var date = $(".crm-dashboard-date" + id);
            if (sort[2] == 1) {
                return $(a).find(date).text() < $(b).find(date).text();
            } else {
                sort[2] = 0;
                return $(a).find(date).text() > $(b).find(date).text();
            }
        });
        $("#container" + id).html(alphabeticallyOrderedDivs);
    }

    function sortUrgency(id) {
        resetSort(3);
        sort[3]++;
        var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
            var img = $(".urgencyImage");
            console.log($(a).find(img).attr('src'));
            if (sort[3] == 1) {
                return $(a).find(img).attr('src') < $(b).find(img).attr('src');
            } else {
                sort[3] = 0;
                return $(a).find(img).attr('src') > $(b).find(img).attr('src');
            }
        });

        $("#container" + id).html(alphabeticallyOrderedDivs);
    }

    function resetSort(int) {
        for (i = 0; i < 3; i++) {
            if (i != int) {
                sort[i] = 1;
            }
        }
    }

</script>