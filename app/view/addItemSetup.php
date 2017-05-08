<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 13-4-2017
 * Time: 12:38
 */
//Default task en task hebben de sortable niet nodig
if ($type != 'default' && $type != 'task') {
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        $(function () {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        });
    </script>
    <?php

}

//Default tasks heeft andere parameters
if($type == 'default'){
    $typeCap = 'Task';
    $typeController = 'TaskController';
    $typeinfo = 'Taskinfo';
}else{
    $typeCap = ucfirst($type);
    $typeController = $typeCap . 'Controller';
    $typeinfo = $type . 'info';
}

//Block controller
$block = new BlockController();

//Switch voor type nummer
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
    case 'default':
        $typeNumb = 6;
        break;
    case 'template':
        $typeNumb = 7;
        break;
    default:
        //404 fallback
        $block->Redirect('index.php?page=404');
        break;
}

//Mysql connect (replace tijdens implementatie)
$mysqli = mysqli_connect();

//type controller
${$typeController} = new $typeController;

//users & clients
$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

if ($type != 'task' || $type != 'default') {
// task controller & default tasks
    $taskController = new TaskController();
    $defaultTask = $taskController->getAllTasksByStatus(4);
    //templates controller & templates
    $templateController = new TemplateController();
    if ($type != 'template') {
        $templates = $templateController->getAllTemplates();
    }
    //template task links controller
    $templateTaskLinksController = new TemplateTaskLinksController();
}

if ($type != 'project' || $type != 'tender') {
    //project controller & projects
    $projectController = new ProjectController();
    $projects = $projectController->getAllProjects();
}

if ($type == 'task' || $type == 'case') {
    //assignment controller & assignments
    $assignmentController = new AssignmentController();
    $assignments = $assignmentController->getAllAssignments();
}

if ($type == 'task') {
    //tender controller & tenders
    $tenderController = new TenderController();
    $tenders = $tenderController->getAllTenders();
    //case controller & cases
    $caseController = new CaseController();
    $cases = $caseController->getAllCases();
}

$logController = new LogController();

$error = false;

$post = false;

if (isset($_POST['create'])) {
    $post = true;

    switch ($type) {
        case 'tender':
            $valueNames = ["subject", "client", "userId", "validity", "value", "chance", "creationDate", "description", "defaultTasks"];
            break;
        case 'project':
            $valueNames = ["subject", "client", "userId", "endDate", "description", "defaultTasks"];
            break;
        case 'assignment':
            $valueNames = ["subject", "client", "userId", "endDate", "description", "projectId", "defaultTasks"];
            break;
        case 'task':
            $valueNames = ["subject", "client", "userId", "project", "assignment", "urgency", "duration", "endDate", "description", "tender", "case"];
            break;
        case 'case':
            $valueNames = ["subject", "client", "userId", "endDate", "description", "project", "defaultTasks", "assignment"];
            break;
        case 'default':
            $valueNames = ["subject", "duration", "description"];
            break;
        case 'template':
            $valueNames = ["subject", "description", "defaultTasks"];
            break;
        default:
            $block->Redirect('index.php?page=404');
            break;
    }

    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }

    $stringVals = ["subject", "description", "creationDate"];
    $intVals = ["client", "userId", "validity", "chance", "assignment", "urgency", "duration", "tender", "case", "projectId", "project"];
    $floatVals = ["value"];

    foreach ($stringVals as $sVal) {
        if (isset(${$sVal})) {
            ${$sVal} = trim(${$sVal});
            if (!filter_var(${$sVal}, FILTER_SANITIZE_STRING)) {
                if($type == "task" && $sVal == 'endDate' && ${$sVal} == ''){
                    ${$sVal} = "0000-00-00";
                }else {
                    $error = true;
                    $sVal_error = $type . '_' . $sVal . '_error';
                    ${$sVal_error} = true;
                }
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
            }
        }
    }

    //float values filter
    foreach ($floatVals as $fVal) {
        if (isset(${$fVal})) {
            if (!filter_var(${$fVal}, FILTER_VALIDATE_FLOAT)) {
                $error = true . ' ' . '<br>';
            }
        }
    }

    if(isset($defaultTasks) && $defaultTasks == "-" && $type == 'template' || isset($defaultTasks) && $defaultTasks == "" && $type == 'template'){
        $error = true;
    }

    if ($type == 'template' && $defaultTasks != null && isset($defaultTasks)) {
        $error = true;
        $template_error = true;
    }

    if (!$error) {
        if (isset($userId) && $userId == 0) {
            $status = 0;
        } elseif ($type == 'default') {
            $status = 4;
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
            if ($type != 'default' && $type != 'template') {
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
                                'userId' => strip_tags($task['user']),
                                'urgency' => strip_tags($task['urgency']),
                                'duration' => strip_tags($task['duration']),
                                'description' => strip_tags($task['description']),
                                'endDate' => strip_tags($task['endDate']),
                                'status' => strip_tags($status),
                                'project' => 0,
                                'assignment' => 0,
                                'tender' => 0,
                                'cases' => 0,
                            ];
                            switch ($type){
                                case 'project':
                                    $taskinfo['project'] = $id;
                                    break;
                                case 'assignment':
                                    $taskinfo['assignment'] = $id;
                                    break;
                                case 'tender':
                                    $taskinfo['tender'] = $id;
                                    break;
                                case 'case':
                                    $taskinfo['cases'] = $id;
                                    break;
                            };
                            $taskId = $taskController->create($taskinfo);
                            $loginfo = [
                                'subject' => 'TEXT_TASK_CREATED',
                                'description' => 'TEXT_TASK_ADD[constDivide]' . $task['subject'] . '[constDivide]TEXT_ADDED',
                                'date' => date('Y-m-d G:i:s'),
                                'userId' => $_SESSION['usr_id'],
                                'linkType' => 4,
                                'linkId' => $taskId
                            ];
                            $logController->create($loginfo);
                        }
                    }
                }
                $loginfo = [
                    'subject' => 'TEXT_' . strtoupper($type) . '_CREATED',
                    'description' => 'TEXT_' . strtoupper($type) . '_ADD' . '[constDivide]' . ${$typeinfo}['subject'] . '[constDivide]' . 'TEXT_ADDED',
                    'date' => date('Y-m-d G:i:s'),
                    'userId' => $_SESSION['usr_id'],
                    'linkType' => $typeNumb,
                    'linkId' => $id
                ];
                $logController->create($loginfo);
            } elseif ($type == 'template') {
                    $tasksId = explode("-", $defaultTasks);
                    array_pop($tasksId);
                    foreach ($tasksId as $taskid) {
                        $t = $taskController->getTaskById($taskid);
                        if ($t['subject'] != null && isset($t['subject'])) {
                            $templatetaskinfo = [
                                'idTemplate' => (int)$id,
                                'idTask' => (int)$taskid
                            ];
                            $templateTaskLinksController->create($templatetaskinfo);
                        }
                    }
            }
        }
        if ($type == 'default') {
            $block->Redirect('index.php?page=defaulttaskview&id=' . $id);
        } else {
            $block->Redirect('index.php?page=' . $type . 'view&id=' . $id);
        }
    }
}