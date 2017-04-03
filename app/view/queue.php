
<?php
$tenderController = new TenderController();
$projectController = new ProjectController();
$caseController = new CaseController();
$assignmentController = new AssignmentController();
$taskController = new TaskController();
$userController = new UserController();

$mysqli = mysqli_connect();

if(isset($_POST['assign'])){

    $user = mysqli_real_escape_string($mysqli, $_POST['user']);

    if (!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0') {
        $error = true;
    }

    $theType = $_POST['theType'];
    $typeId = $_POST['typeId'];

    switch ($theType){
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

$tasks = $taskController->getTasksByStatus(0);

$clients = $userController->getClientList();
$showPupUp = true;

$userController = new UserController();
$users = $userController->getUserList();

$thisUserId = $_SESSION['usr_id'];

?>

<div id="crm-dashboard-holder" class="crm-content-wrapper">

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_TENDERS ?></h1>

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
                    <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="tender" typeId="<?=$tender['id']?>" typeSubject="<?=$tender['subject']?>"><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_PROJECTS ?></h1>

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
                    <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="project" typeId="<?=$project['id']?>" typeSubject="<?=$project['subject']?>"><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_ASSIGNMENTS ?></h1>

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
                    <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="assignment" typeId="<?=$assignment['id']?>" typeSubject="<?=$assignment['subject']?>"><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_TASKS ?></h1>

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
                    <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="task" typeId="<?=$task['id']?>" typeSubject="<?=$task['subject']?>"><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <h1 class="crm-content-header"><?= OPEN_CASES ?></h1>

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
                    <a class="toewijzenlink" data-toggle="modal" data-target="#myModal" theType="case" typeId="<?=$case['id']?>" typeSubject="<?=$case['subject']?>"><?= TEXT_ASSIGN ?></a>
                </div>
            <?php } ?>
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
        $(function(){
            $('.toewijzenlink').click(function() {
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



