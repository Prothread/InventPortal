<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
    $(function () {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });
</script>
<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 13-4-2017
 * Time: 12:38
 */

$typeCap = ucfirst($type);
$typeController = $typeCap . 'Controller';
$typeinfo = $type . 'info';

switch ($type) {
    case 'tender':
        $typeNumb = 1;
        break;
    case 'project':
        $typeNumb = 2;
        break;
    case 'assignment':
        $typeNumb = 3;
        break;
    case 'task':
        $typeNumb = 4;
        break;
    case 'case':
        $typeNumb = 5;
        break;
    default:
        $block->Redirect('index.php?page=404');
        break;
}

$mysqli = mysqli_connect();

//typecontroller
${$typeController} = new $typeController;

//users & clients
$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

if ($type != 'task') {
// task controller & default tasks
    $taskController = new TaskController();
    $defaultTask = $taskController->getAllTasksByStatus(4);
//templates controller & templates
    $templateController = new templateController();
    $templates = $templateController->getAllTemplates();
//template task links controller
    $templateTaskLinksController = new TemplateTaskLinksController();
}

if($type != 'project' || $type != 'tender'){
    //project controller & projects
    $projectController = new ProjectController();
    $projects = $projectController->getAllProjects();
}

if($type == 'task' || $type == 'case'){
    //assignment controller & assignments
    $assignmentController = new AssignmentController();
    $assignments = $assignmentController->getAllAssignments();
}

if($type == 'task'){
    //tender controller & tenders
    $tenderController = new TenderController();
    $tenders = $tenderController->getAllTenders();
    //case controller & cases
    $caseController = new CaseController();
    $cases = $caseController->getAllCases();
}

$block = new BlockController();

$error = false;

$post = false;

if (isset($_POST['create'])) {
    $post = true;

    switch ($type) {
        case 'tender':
            $valueNames = ["subject", "client", "user", "validity", "value", "chance", "creationDate", "description", "defaultTasks"];
            break;
        case 'project':
            $valueNames = ["subject", "client", "user", "endDate", "description", "defaultTasks"];
            break;
        case 'assignment':
            $valueNames = ["subject", "client", "user", "endDate", "description", "projectId", "defaultTasks"];
            break;
        case 'task':
            $valueNames = ["subject", "client", "user", "project", "assignment", "urgency", "duration", "endDate", "description", "tender", "case"];
            break;
        case 'case':
            $valueNames = ["subject", "client", "user", "endDate", "description", "project", "defaultTasks"];
            break;
        default:
            $block->Redirect('index.php?page=404');
            break;
    }

    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }

    $stringVals = ["subject", "description", "creationDate"];
    $intVals = ["client", "user", "validity", "chance", "assignment", "urgency", "duration", "tender", "case", "projectId", "project"];
    $floatVals = ["value"];

    foreach ($stringVals as $sVal) {
        if (isset(${$sVal})) {
            ${$sVal} = trim(${$sVal});
            if (!filter_var(${$sVal}, FILTER_SANITIZE_STRING)) {
                $error = true;
                $sVal_error = $type . '_' . $sVal . '_error';
                ${$sVal_error} = true;
                echo $sVal . ${$sVal};
            }
        }
    }

    //int values filter
    foreach ($intVals as $iVal) {
        if (isset(${$iVal})) {
            if (!filter_var(${$iVal}, FILTER_VALIDATE_INT) && ${$iVal} !== '0') {
                $error = true;
                $iVal_error = $type . '_' . $iVal . '_error';
                ${$iVal_error} = true;
                echo $iVal;
            }
        }
    }

    //float values filter
    foreach ($floatVals as $fVal) {
        if (isset(${$fVal})) {
            if (!filter_var(${$fVal}, FILTER_VALIDATE_FLOAT)) {
                $error = true;
            }
        }
    }

    if (!$error) {
        if ($user == 0) {
            $status = 0;
        } else {
            $status = 1;
        }
        ${$typeinfo} = [
            'status' => $status
        ];
        foreach ($valueNames as $v) {
            ${$typeinfo}[$v] = ${$v};
        }
        if ($id = ${$typeController}->create(${$typeinfo})) {
            if ($type != 'task' && $defaultTasks != null && isset($defaultTasks)) {
                $tasksId = explode("-", $defaultTasks);
                foreach ($tasksId as $taskid) {
                    if ($taskid != '') {
                        $task = $taskController->getTaskById($taskid);
                        if ($task['user'] != 0) {
                            $status = 1;
                        } else {
                            $status = 0;
                        }
                        $taskinfo = [
                            'subject' => strip_tags($task['subject']),
                            'client' => strip_tags($task['client']),
                            'user' => strip_tags($task['user']),
                            'urgency' => strip_tags($task['urgency']),
                            'duration' => strip_tags($task['duration']),
                            'description' => strip_tags($task['description']),
                            'endDate' => strip_tags($task['endDate']),
                            'status' => strip_tags($status)
                        ];
                        $linkTypes = ["project", "assignment", "tender", "cases"];
                        foreach ($linkTypes as $l) {
                            if ($l == $type) {
                                $taskinfo[$l] = $id;
                            } elseif($type == 'case') {
                                $taskinfo[$l . 's'] = $task[$l . 's'];
                            }else{
                                $taskinfo[$l] = $task[$l];
                            }
                        }
                        $taskController->create($taskinfo);
                    }
                }
            }
            $logController = new LogController();
            $loginfo = [
                'subject' => 'TEXT_' . strtoupper($type) . '_CREATED',
                'description' => 'TEXT_' . strtoupper($type) . '_ADD' . '[constDivide]' . ${$typeinfo}['subject'] . '[constDivide]' . 'TEXT_ADDED',
                'date' => date('Y-m-d G:i:s'),
                'user' => $_SESSION['usr_id'],
                'linkType' => $typeNumb,
                'linkId' => $id
            ];
            $logController->create($loginfo);
        }
        $block = new BlockController();
        $block->Redirect('index.php?page=' . $type . 'view&id=' . $id);
    }
}


