<?php
$tenderController = new TenderController();
$projectController = new ProjectController();
$caseController = new CaseController();
$assignmentController = new AssignmentController();
$taskController = new TaskController();
$userController = new UserController();

$mysqli = mysqli_connect();

if (isset($_POST['assign'])) {

    $user = mysqli_real_escape_string($mysqli, $_POST['user']);

    if (!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0') {
        $error = true;
    }

    $theType = $_POST['theType'];
    $typeId = $_POST['typeId'];

    switch ($theType) {
        case "tender":
            $tenderController->assignUser($user, $typeId);
            break;
        case "project":
            $projectController->assignUser($user, $typeId);
            break;
        case "assignment":
            $assignmentController->assignUser($user, $typeId);
            break;
        case "task":
            $taskController->assignUser($user, $typeId);
            break;
        case "case":
            $caseController->assignUser($user, $typeId);
            break;
        default:
            echo "What have you done?";
            break;
    }

}

$allTenders = $tenderController->getTendersByStatus(0);

$allProjects = $projectController->getProjectsByStatus(0);

$allCases = $caseController->getCasesByStatus(0);

$allAssignments = $assignmentController->getAssignmentsByStatus(0);

$tasks = $taskController->getAllTasksByStatus(0);

$clients = $userController->getClientList();
$showPupUp = true;

$userController = new UserController();
$users = $userController->getUserList();

$thisUserId = $_SESSION['usr_id'];

?>

<div id="crm-dashboard-holder" class="crm-content-wrapper">

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_TENDERS ?></h1>

        <select class="crm-dashboard-select" id="Tenderselect" onchange="changeFunc('Tenderselect');">
            <option value="" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addtender'"><?= TEXT_CREATE_DROPDOWN ?></button>
            <div id="containerTenderselect">
                <?php $amount = 0; foreach ($allTenders as $tender) {
                    $amount++;
                    $timeDiff = $tenderController->getTimeDifference($tender['endDate'], date("Y-m-d"))
                    ?>
                    <div <?php if ($amount > 5){ ?> style="display: none" <?php } ?>class="crm-dashboard-box boxesTenderselect">
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
                                   href="?page=tenderview&id= <?= $tender['id'] ?>"><?= $tender['subject'] ?></a>
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
                        <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="tender"
                           typeId="<?= $tender['id'] ?>" typeSubject="<?= $tender['subject'] ?>"><?= TEXT_ASSIGN ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_PROJECTS ?></h1>

        <select class="crm-dashboard-select" id="Projectselect" onchange="changeFunc('Projectselect');">
            <option value="standaard" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
        </select>
        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addproject'"><?= TEXT_CREATE_DROPDOWN ?></button>
            <div id="containerProjectselect">
                <?php $amount = 0; foreach ($allProjects as $project) {
                    $amount++;
                    $timeDiff = $projectController->getTimeDifference($project['endDate'], date("Y-m-d"))
                    ?>
                    <div <?php if ($amount > 5){ ?> style="display: none" <?php } ?>class="crm-dashboard-box boxesProjectselect">
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
                        <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="project"
                           typeId="<?= $project['id'] ?>"
                           typeSubject="<?= $project['subject'] ?>"><?= TEXT_ASSIGN ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_ASSIGNMENTS ?></h1>

        <select class="crm-dashboard-select" id="Assignmentselect" onchange="changeFunc('Assignmentselect');">
            <option value="" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=addassignment'"><?= TEXT_CREATE_DROPDOWN ?></button>
            <div id="containerAssignmentselect">
                <?php $amount = 0; foreach ($allAssignments as $assignment) {
                    $amount++;
                    $timeDiff = $assignmentController->getTimeDifference($assignment['endDate'], date("Y-m-d"));
                    ?>
                    <div  <?php if ($amount > 5){ ?> style="display: none" <?php } ?>class="crm-dashboard-box boxesAssignmentselect">
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
                        <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="assignment"
                           typeId="<?= $assignment['id'] ?>"
                           typeSubject="<?= $assignment['subject'] ?>"><?= TEXT_ASSIGN ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_TASKS ?></h1>

        <select class="crm-dashboard-select" id="Taskselect" onchange="changeFunc('Taskselect');">
            <option value="" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
            <option value="urgentie"><?= TEXT_URGENCY ?></option>
        </select>

        <div class="crm-dashboard-inside-row">

            <button class="custom-file-upload">Aanmaken</button>
            <div id="containerTaskselect">
            <?php $amount = 0; foreach ($tasks as $task) {
                $amount++;
                $timeDiff = $taskController->getTimeDifference($task['endDate'], date("Y-m-d"))
                ?>
                <div <?php if ($amount > 5){ ?> style="display: none" <?php } ?>class="crm-dashboard-box boxesTaskselect">
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
                            <a class="subjectLinkTaskselect" href="?page=taskview&id=<?= $task['id'] ?>"><?= $task['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $task['client']) {
                                    ?>
                                    <a class="clientLinkTaskselect" href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php
                                }
                            } ?>
                        </li>
                        <li class="crm-dashboard-dateTaskselect">
                            <?= date("d-m-Y", strtotime($task['endDate'])) ?>
                        </li>
                    </ul>
                    <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="task"
                       typeId="<?= $task['id'] ?>" typeSubject="<?= $task['subject'] ?>"><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_CASES ?></h1>

        <select class="crm-dashboard-select" id="Caseselect" onchange="changeFunc('Caseselect');">
            <option value="" disabled selected><?= TEXT_FILTER_OPTION ?></option>
            <option value="onderwerp"><?= TABLE_TITLE ?></option>
            <option value="datum"><?= TEXT_DATE ?></option>
            <option value="klant"><?= TEXT_IS_CLIENT ?></option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload" onclick="window.location.href='?page=addcase'">Aanmaken</button>
            <div id="containerCaseselect">
            <?php $amount = 0; foreach ($allCases as $case) {
                $amount++;
                $timeDiff = $projectController->getTimeDifference($case['endDate'], date("Y-m-d"))
                ?>
                <div <?php if ($amount > 5){ ?> style="display: none" <?php } ?>class="crm-dashboard-box boxesCaseselect">
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
                            <a class="subjectLinkCaseselect" href="?page=caseview&id=<?= $case['id'] ?>"><?= $case['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $case['client']) {
                                    ?>
                                    <a class="clientLinkCaseselect" href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php
                                }
                            } ?>
                        </li>
                        <li class="crm-dashboard-dateCaseselect">
                            <?= date("d-m-Y", strtotime($case['endDate'])) ?>
                        </li>
                    </ul>
                    <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="case"
                       typeId="<?= $case['id'] ?>" typeSubject="<?= $case['subject'] ?>"><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="toewijzenaan">Toewijzen aan x</h4>
                </div>
                <div class="modal-body">
                    <form action="?page=queue" method="post" class="form-horizontal">
                        <fieldset>
                            <select class="form-control" name="user">
                                <option value="0"><?= TEXT_ASSIGNFOR ?></option>
                                <?php
                                foreach ($users as $user) {
                                    echo '<option value="' . $user['id'] . '"';
                                    if ($user['id'] == $thisUserId) {
                                        echo 'selected';
                                    }
                                    echo '>' . $user['naam'] . '</option>';
                                }
                                ?>
                            </select>
                            <input name="typeId" type="hidden" value="" id="typeId">
                            <input name="theType" type="hidden" value="" id="theType">
                            <br>
                            <label class="col-md-4 control-label" for="textinput"></label>
                            <div class="col-md-4">
                                <input class="btn btn-primary btn-success" type="submit" name="assign"
                                       style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c"
                                       value="Toewijzen">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Sure" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Weet u zeker dat u dit item wilt verwijderen?</h4>
                </div>
                <div class="modal-body">
                    <br>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('.toewijzenlink').click(function () {
                var theType = $(this).attr('theType');
                var typeId = $(this).attr('typeId');
                var typeSubject = $(this).attr('typeSubject');
                console.log(theType);
                console.log(typeId);
                console.log(typeSubject);
                $('#toewijzenaan').text("Werknemer toewijzen aan " + typeSubject);
                $('#typeId').val(typeId);
                $('#theType').val(theType);
            });
        });


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



