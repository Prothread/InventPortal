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
    }

}

$allTenders = $tenderController->getAllTendersByStatus(0);

$allProjects = $projectController->getAllProjectsByStatus(0);

$allCases = $caseController->getAllCasesByStatus(0);

$allAssignments = $assignmentController->getAllAssignmentsByStatus(0);

$allTasks = $taskController->getAllTasksByStatus(0);

$clients = $userController->getClientList();

$userController = new UserController();
$users = $userController->getUserList();

$thisUserId = $_SESSION['usr_id'];

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
                <h1 class="crm-content-header"><?= constant("OPEN_" . $columnTypeUpper . "S") ?></h1>

                <select class="crm-dashboard-select" id="<?= $columnType ?>Sort" onchange="sortItems('<?= $columnType ?>');">
                    <option value="" disabled selected><?= TEXT_FILTER_OPTION ?></option>
                    <option value="subject"><?= TABLE_TITLE ?></option>
                    <option value="date"><?= TEXT_DATE ?></option>
                    <option value="client"><?= TEXT_IS_CLIENT ?></option>
                </select>

                <div class="crm-dashboard-inside-row">
                    <?php if($user->getPermission($permgroup, 'CAN_EDIT_CRM') == 1){?>
                    <button class="custom-file-upload"
                            onclick="window.location.href='?page=add<?= $columnType ?>'"><?= TEXT_CREATE_DROPDOWN ?></button>
<?php }?>
                    <div id="container<?= $columnTypeCap ?>select">
                        <?php $amount = 0;
                        foreach (${$columnTypeAll} as ${$columnType}) {
                            $amount++;
                            $timeDiff = ${$columnTypeController}->getTimeDifference(${$columnType}['endDate'], date("Y-m-d"))
                            ?>
                            <div id="<?= $columnType ?><?= ${$columnType}['id'] ?>" <?php if ($amount > 5){ ?>
                                 style="display: none"
                                 <?php } ?>class="crm-dashboard-box boxes<?= $columnTypeCap ?>select">
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
                                        <a class="subjectLink<?= $columnTypeCap ?>select"
                                           href="?page=<?= $columnType ?>view&id= <?= ${$columnType}['id'] ?>"><?= ${$columnType}['subject'] ?></a>
                                    </li>
                                    <li>
                                        <?php foreach ($clients as $client) {
                                            if ($client['id'] == $tender['client']) {
                                                ?>
                                                <a class="clientLink<?= $columnTypeCap ?>select"
                                                   href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                                <?php
                                            }
                                        } ?>
                                    </li>
                                    <li class="crm-dashboard-date<?= $columnTypeCap ?>select">
                                        <?= date("d-m-Y", strtotime($tender['endDate'])) ?>
                                    </li>
                                </ul>
                                <?php if($user->getPermission($permgroup, 'CAN_EDIT_CRM') == 1){?>
                                <a class="toewijzenlink" data-toggle="modal" data-target="#myModal"
                                   theType="<?= $columnType ?>"
                                   typeId="<?= ${$columnType}['id'] ?>"
                                   typeSubject="<?= ${$columnType}['subject'] ?>"><?= TEXT_ASSIGN ?></a>
                                <?php }?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
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
    </script>
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
            if (window[type + 's'].length <= 4) {
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


