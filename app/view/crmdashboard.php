<?php

$thisUserId = $_SESSION['usr_id'];

$tenderController = new TenderController();
$allTenders = $tenderController->getTendersByUserId($thisUserId);

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
<div id="crm-dashboard-scroll">
    <?php
    $columnTypes = ["tender", "project", "assignment", "task", "case"];
    foreach ($columnTypes as $columnType) {
        $columnTypeCap = ucfirst($columnType);
        $columnTypeUpper = strtoupper($columnType);
        $columnTypeAll = "all" . $columnTypeCap . "s";
        $columnTypeController = $columnType . "Controller";
        ?>
        <div class="crm-dashboard-row">
            <h1 class="crm-content-header"><?= constant("YOUR_" . $columnTypeUpper) ?></h1>

            <select class="crm-dashboard-select" id="<?= $columnType ?>Sort" onchange="sortItems('<?= $columnType ?>')">
                <option value="none" disabled selected><?= TEXT_FILTER_OPTION ?></option>
                <option value="subject"><?= TABLE_TITLE ?></option>
                <option value="date"><?= TEXT_DATE ?></option>
                <option value="client"><?= TEXT_IS_CLIENT ?></option>
            </select>

            <div class="crm-dashboard-inside-row">
                <?php if($user->getPermission($permgroup, 'CAN_EDIT_CRM') == 1){?>
                <button class="custom-file-upload"
                        onclick="window.location.href='?page=add<?= $columnType ?>'"><?= TEXT_CREATE_DROPDOWN ?></button>
                <?php }?>
                <div id="container<?= $columnType ?>select">
                    <?php $amount = 0;
                    foreach (${$columnTypeAll} as ${$columnType}) {
                        $amount++;
                        $timeDiff = ${$columnTypeController}->getTimeDifference(${$columnType}['endDate'], date("Y-m-d"))
                        ?>
                        <div id="<?= $columnType ?><?= ${$columnType}["id"] ?>" <?php if ($amount > 5){ ?>
                             style="display: none"
                             <?php } ?>class="crm-dashboard-box boxes<?= $columnType ?>select">
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
                                    <a ref="?page=<?= $columnType ?>view&id=<?= ${$columnType}['id'] ?>"><?= ${$columnType}['subject'] ?></a>
                                </li>
                                <li>
                                    <?php foreach ($clients as $client) {
                                        if ($client['id'] == ${$columnType}['client']) {
                                            ?>
                                            <a href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                            <?php
                                        }
                                    } ?>
                                </li>
                                <li>
                                    <?= date("d-m-Y", strtotime(${$columnType}['endDate'])) ?>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</div>

<script>

    <?php
    $listTypes = ["tender", "project", "assignment", "case", "task"];
    foreach ($listTypes as $type) {
        $typeCap = ucfirst($type);
        $typeM = $typeCap . 's';
        $typem = $type . 's';
        $typeAll = 'all' . $typeM;
        $typeCon = $type . 'Controller';
        echo 'var ' . $typem . ' = [';
        foreach (${$typeAll} as ${$type}) {
            echo "{id:'" . ${$type}['id'] . "',subject:'" . ${$type}['subject'] . "',client:'" . ${$type}['client'] . "',dateDiff:'" . ${$typeCon}->getTimeDifference(${$type}["endDate"], date("Y-m-d")) . "'},";
        }
        echo '];';
    }
    ?>

    var tenderCurrSort = "none";
    var projectCurrSort = "none";
    var assignmentCurrSort = "none";
    var taskCurrSort = "none";
    var caseCurrSort = "none";

    function sortItems(type) {
        //get sort type
        var selectBox = document.getElementById(type + 'Sort');
        var selectedVal = selectBox.options[selectBox.selectedIndex].value;
        selectBox.selectedIndex = "none";
        //call sort function
        window[selectedVal + "Sort"](type);
    }

    function subjectSort(type) {
        //sort
        if (window[type + 'CurrSort'] != "subjectAsc" && window[type + 'CurrSort'] != "subjectDesc") {
            window[type + 's'].sort(function (a, b) {
                var nameA = a.subject.toUpperCase();
                var nameB = b.subject.toUpperCase();
                if (nameA < nameB) {
                    return -1;
                }
                if (nameA > nameB) {
                    return 1;
                }
                return 0;
            });
            window[type + 'CurrSort'] = "subjectAsc";
        } else {
            window[type + 's'].reverse();
            if (window[type + 'CurrSort'] === "subjectAsc") {
                window[type + 'CurrSort'] = "subjectDesc";
            } else {
                window[type + 'CurrSort'] = "subjectAsc";
            }
        }
        //hide items
        hideItems(type);
        //show items
        displayItems(type);
    }

    function dateSort(type) {
        //sort
        if (window[type + 'CurrSort'] != "dateAsc" && window[type + 'CurrSort'] != "dateDesc") {
            window[type + 's'].sort(function (a, b) {
                return a.dateDiff - b.dateDiff;
            });
            window[type + 'CurrSort'] = "dateAsc";
        } else {
            window[type + 's'].reverse();
            if (window[type + 'CurrSort'] === "dateAsc") {
                window[type + 'CurrSort'] = "dateDesc";
            } else {
                window[type + 'CurrSort'] = "dateAsc";
            }
        }
        //hide items
        hideItems(type);
        //show items
        displayItems(type);
    }

    function clientSort(type) {
        //sort
        if (window[type + 'CurrSort'] != "clientAsc" && window[type + 'CurrSort'] != "clientDesc") {
            window[type + 's'].sort(function (a, b) {
                return a.client - b.client;
            });
            window[type + 'CurrSort'] = "clientAsc";
        } else {
            window[type + 's'].reverse();
            if (window[type + 'CurrSort'] === "clientAsc") {
                window[type + 'CurrSort'] = "clientDesc";
            } else {
                window[type + 'CurrSort'] = "clientAsc";
            }
        }
        //hide items
        hideItems(type);
        //show items
        displayItems(type);
    }

    function hideItems(type) {
        //hide all items of type
        $(".boxes" + type + "select").css('display', 'none');
    }

    function displayItems(type) {
        var loopNumb = 4;
        if(window[type + 's'].length <= 4){
            var itemNumb = window[type + 's'].length;
            loopNumb = itemNumb - 1;
        }
        for (i = loopNumb; i > -1; i--) {
            //show item
            var orderItem = $("#" + type + window[type + 's'][i]["id"]);
            orderItem.css('display', 'block');
            //order items
            orderItem.insertBefore($("#container" + type + "select div:first-child"));
        }
    }
</script>