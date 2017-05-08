<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 6-4-2017
 * Time: 10:23
 */

if($type == 'default'){
    $typeinfo = 'taskinfo';
    $newtypeController = 'TaskController';
    $typeController = 'taskController';
    $typeGetById = 'getTaskById';

}else {
//Dynamic names
    $typeTasks = $type . 'Tasks';
    $typeAssignments = $type . 'Assignments';
    $typeinfo = $type . 'info';
    $typeCap = ucfirst($type);
    $newtypeController = $typeCap . 'Controller';
    $typeController = $type . 'Controller';
    $typeGetById = 'get' . $typeCap . 'ById';
}

//block controller
$block = new BlockController();
if (!filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $block->Redirect('index.php?page=404');
}

//item ID
$id = $_GET['id'];

$pError = false;

if(isset($_GET['p'])) {
    $pLink = $_GET['p'];
    if(!is_numeric($pLink) || $pLink == ''){
        $pError = true;
    }else {
        $pTypeId = $pLink[0];
        switch ($pTypeId) {
            case 1:
                $pType = 'tender';
                break;
            case 2:
                $pType = 'project';
                break;
            case 3:
                $pType = 'assignement';
                break;
            case 5:
                $pType = 'case';
                break;
            default:
                $block->Redirect('index.php?page=404');
        }
        $pId = substr($pLink, 1);
        if($pId == ''){
            $pError = true;
        }
    }
}

if(!is_numeric($id) || $pError){
    $block->Redirect('index.php?page=404');
}elseif (!$pError && isset($pType)){
    $pDeleteRe = true;
}

//mysqli connection (local)
$mysqli = mysqli_connect();

//item controller
${$typeController} = new $newtypeController();
//item info
${$typeinfo} = ${$typeController}->$typeGetById($id);

//item not found
if (is_null(${$typeinfo})) {
    $block->Redirect('index.php?page=404');
}

if ($type == 'template') {
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

//user ID
$thisUserId = $_SESSION['usr_id'];

//type numb setter
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
    case 'default':
        $typeNumb = 4;
        break;
    case 'case':
        $typeNumb = 5;
        break;
}

//tasks controller
$taskController = new TaskController();

if($type != 'default' && $type != 'template') {
//users controller
    $userController = new UserController();
//client list
    $clients = $userController->getClientList();
//user list
    $users = $userController->getUserList();

//log controller
    $logController = new LogController();

//note type contoller
    $noteTypeController = new NoteTypeController();
//note type list
    $noteTypes = $noteTypeController->getNoteTypes();

//note controller
    $noteController = new NoteController();

//note handeler
    if (isset($_POST['noteAdd']) || isset($_POST['noteEdit']) || isset($_POST['noteDelete'])) {
        include '../app/Model/noteProcessor.php';
    }

//related notes
    if($type != 'default' && $type != 'template') {
        $notes = $noteController->getNotesByLinkId($typeNumb, ${$typeinfo}['id']);
    }
}
if ($type == 'task' || $type == 'case' || $type == 'project') {
    //assignment controller
    $assignmentController = new AssignmentController();
    //assignment list
    $assignments = $assignmentController->getAllAssignments();
}
if ($type == 'task' || $type == 'case' || $type == 'assignment') {
    //projects controller
    $projectController = new ProjectController();
    //project list
    $projects = $projectController->getAllProjects();
}
if ($type == 'task') {
    //tender controller
    $tenderController = new TenderController();
    //tender list
    $tenders = $tenderController->getAllTenders();

    //case controller
    $caseController = new CaseController();
    //case list
    $caseList = $caseController->getAllCases();
}
if ($type == 'template') {
    $defaultTask = $taskController->getAllTasksByStatus(4);
    $templateTaskLinksController = new TemplateTaskLinksController();
}

//task submit handler
if (isset($_POST['submitTask'])) {
    include '../app/Model/subTaskAdd.php';
}

//related tasks
if ($type != 'task' && $type != 'default' && $type != 'template') {
    ${$typeTasks} = $taskController->getTasksByLinkId($type, $id);
}

//item add error
$error = false;

//project assigment handler
if ($type == 'project') {
    //assignment add controller
    if (isset($_POST['submitAssignment'])) {

        //value names
        $valueNames = ["subject", "userId", "client", "endDate", "description", "projectId"];

        //value setters + mysqli escape string check
        foreach ($valueNames as $v) {
            ${$v} = trim($_POST[$v]);
            ${$v} = mysqli_real_escape_string($mysqli, ${$v});
        }

        //subject filter
        if (!isset($subject) || $subject == null || $subject == '') {
            $error = true;
            $assignment_subject_error = true;
        }

        //user filter
        if (!filter_var($userId, FILTER_VALIDATE_INT) && $userId !== '0') {
            $error = true;
            $assignment_user_error = true;
        }

        //client filter
        if (!filter_var($client, FILTER_VALIDATE_INT) && $client !== '0') {
            $error = true;
            $assignment_client_error = true;
        }

        //project filter
        if (!filter_var($projectId, FILTER_VALIDATE_INT)) {
            $error = true;
            $assignment_project_error = true;
        }

        //end date filter
        if (!filter_var($endDate, FILTER_SANITIZE_STRING)) {
            $error = true;
            $assignment_endDate_error = true;
        }

        //description filter
        if (!filter_var($description, FILTER_SANITIZE_STRING)) {
            $error = true;
            $assignment_description_error = true;
        }

        //ongoing status setter
        if ($userId == 0) {

            //open status
            $status = 0;
        } else {

            //ongoing status
            $status = 1;
        }

        //error check
        if (!$error) {

            //value array set
            $assignmentinfo = [
                'subject' => strip_tags($subject),
                'userId' => strip_tags($userId),
                'description' => strip_tags($description),
                'endDate' => strip_tags($endDate),
                'projectId' => strip_tags($projectId),
                'status' => $status,
                'client' => strip_tags($client)
            ];

            //assignment create
            $assignmentController->create($assignmentinfo);
            $loginfo = [
                'subject' => 'TEXT_ASSIGNMENT_ADDED',
                'description' => 'TEXT_ASSIGNMENT_ADD[constDivide]' . $subject . '[constDivide]TEXT_ADDED',
                'date' => date('Y-m-d G:i:s'),
                'userId' => $_SESSION['usr_id'],
                'linkType' => $typeNumb,
                'linkId' => $id
            ];
            $logController->create($loginfo);
        } else {

            //assignment error setter
            $assignmentError = true;
        }
    }

    //related assignments
    $projectAssignments = $assignmentController->getAssignmentByProjectId($id);
}

//post check
$post = false;

//post handeler
if (isset($_POST['update'])) {

    //post setter
    $post = true;

    //value names setter
    switch ($type) {
        case 'tender':
            $valueNames = ["subject", "client", "userId", "validity", "value", "chance", "description"];
            break;
        case 'project':
            $valueNames = ["subject", "client", "userId", "endDate", "description"];
            break;
        case 'assignment':
            $valueNames = ["subject", "client", "userId", "endDate", "description", "projectId"];
            break;
        case 'task':
        case 'default':
            $valueNames = ["subject", "client", "userId", "project", "assignment", "urgency", "duration", "endDate", "description", "tender", "cases"];
            if($type == 'default'){
                $_POST['client'] = "0";
                $_POST['userId'] = "0";
                $_POST['project'] = "0";
                $_POST['assignment'] = "0";
                $_POST['endDate'] = "0000-00-00";
                $_POST['urgency'] = "0";
                $_POST['tender'] = "0";
                $_POST['cases'] = "0";
            }
            break;
        case 'case':
            $valueNames = ["subject", "client", "userId", "project", "assignment", "endDate", "description"];
            break;
        case 'template':
            $valueNames = ["subject", "description"];
            $user = "0";
            break;
        default:
            $block->Redirect('index.php?page=404');
            break;
    }

    //value setters + mysqli escape string check
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }

    //value type setters
    $stringVals = ["subject", "description", "endDate"];
    $intVals = ["client", "userId", "validity", "chance", "assignment", "urgency", "duration", "tender", "cases", "project"];
    $floatVals = ["value"];
    //string values filter
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
                $error = true;
            }
        }
    }

    if ($type == 'template') {
        $defaultTasks = mysqli_real_escape_string($mysqli, $_POST['defaultTasks']);
        if (!filter_var($defaultTasks, FILTER_SANITIZE_STRING)) {
            if (trim($defaultTasks) == '') {
                $error = true;
                $template_task_error = true;
            }
        }
    }

    //error check
    if (!$error) {
        //status setter
        if($type == 'default'){

            //default status
            $status = 4;
        }else if ($userId == 0) {

            //open status
            $status = 0;
        } else {

            //ongoing status
            $status = 1;
        }

        if ($type == 'tender') {
            $creationDate = ${$typeinfo}["creationdate"];
        }

        //value array set
        ${$typeinfo} = [
            'id' => $id,
            'status' => $status
        ];

        foreach ($valueNames as $v) {
            ${$typeinfo}[$v] = ${$v};
        }

        if ($type == 'tender') {
            ${$typeinfo}['endDate'] = ${$typeController}->calcEndDate($creationDate, ${$typeinfo}['validity']);
        }
        //item update
        if (${$typeController}->update(${$typeinfo})) {
            if ($type != 'template' && $type != 'default') {
                $loginfo = [
                    'subject' => 'TEXT_' . strtoupper($type) . '_EDITED',
                    'description' => 'TEXT_' . strtoupper($type) . '_ADD' . '[constDivide]' . ${$typeinfo}['subject'] . '[constDivide]' . 'TEXT_LOG_EDITED',
                    'date' => date('Y-m-d G:i:s'),
                    'userId' => $_SESSION['usr_id'],
                    'linkType' => $typeNumb,
                    'linkId' => $id
                ];
                $logController->create($loginfo);
            } else if($type == 'template') {
                $templateTaskLinksController->deleteByTemplateId($id);

                $tasksId = explode("-", $defaultTasks);
                foreach ($tasksId as $taskid) {
                    if (isset($taskid) && $taskid != null) {
                        $t = $taskController->getTaskById($taskid);
                        if ($t['subject'] != null && isset($t['subject'])) {
                            $taskinfo = [
                                'idTemplate' => (int)$id,
                                'idTask' => (int)$taskid
                            ];
                            $templateTaskLinksController->create($taskinfo);
                        }
                    }
                }
            }
            if($type == 'assignment' || $type == 'task'){
                //parent log
                $hasParent = false;
                if($type == 'task'){
                    $parentTypes = ["project","assignment","tender","cases"];
                }else{
                    $parentTypes = ["project"];
                }
                foreach ($parentTypes as $p){
                    if(${$typeinfo}[$p] != 0){
                        $parentType = $p;
                        $parentId = ${$typeinfo}[$p];
                        $hasParent = true;
                    }
                }
                if($hasParent) {
                    switch ($parentType) {
                        case "tender":
                            $parentType = 1;
                            break;
                        case "project":
                            $parentType = 2;
                            break;
                        case "assignment":
                            $parentType = 3;
                            break;
                        case "cases":
                            $parentType = 5;
                            break;
                    };
                }
                $loginfo = [
                    'subject' => 'TEXT_CHILD_' . strtoupper($type) . '_EDITED',
                    'description' => 'TEXT_CHILD_' . strtoupper($type) . '[constDivide]' . ${$typeinfo}['subject'] . '[constDivide]' . 'TEXT_LOG_EDITED',
                    'date' => date('Y-m-d G:i:s'),
                    'userId' => $_SESSION['usr_id'],
                    'linkType' => $parentType,
                    'linkId' => $parentId
                ];
                $logController->create($loginfo);
            }
        }
    }
}

//related logs
if ($type != 'default' && $type != 'template') {
    $logs = $logController->getLogsByLinkId($typeNumb, ${$typeinfo}['id']);
}elseif ($type == 'template'){
    $templateTasksId = $templateTaskLinksController->getTaskByTemplateId($id);

    $allTemplateTasks = array();

    $amount = 0;

    foreach ($templateTasksId as $tTask) {
        array_push($allTemplateTasks, $taskController->getTaskById($tTask['idTask']));
    }
}

//delete handler
if (isset($_POST['delete'])) {

    //delete item
    if (${$typeController}->delete($id)) {
        if(isset($pDeleteRe)){
            $loginfo = [
                'subject' => 'TEXT_CHILD_' . strtoupper($type) . '_DELETED',
                'description' => 'TEXT_CHILD_' . strtoupper($type) . '[constDivide]' . ${$typeinfo}['subject'] . '[constDivide]' . 'TEXT_DELETED',
                'date' => date('Y-m-d G:i:s'),
                'userId' => $_SESSION['usr_id'],
                'linkType' => $pTypeId,
                'linkId' => $pId
            ];
            $logController->create($loginfo);
            $block->Redirect('index.php?page='.$pType.'view&id='.$pId);
        }else if($type == 'default'){
            $block->Redirect('index.php?page=defaulttasksoverview');
        }else {
            $block->Redirect('index.php?page=' . $type . 'soverview');
        }
    }
}
