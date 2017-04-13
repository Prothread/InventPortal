<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 6-4-2017
 * Time: 10:23
 */

//Dynamic names
$typeTasks = $type . 'Tasks';
$typeAssignments = $type . 'Assignments';
$typeinfo = $type . 'info';
$typeCap = ucfirst($type);
$newtypeController = $typeCap . 'Controller';
$typeController = $type . 'Controller';
$typeGetById = 'get' . $typeCap . 'ById';

//block controller
$block = new BlockController();
if (!filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $block->Redirect('index.php?page=404');
}

//item ID
$id = $_GET['id'];

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
        $typeNumb = 4;
        break;
    case 'case':
        $typeNumb = 5;
        break;
}

//users controller
$userController = new UserController();
//client list
$clients = $userController->getClientList();
//user list
$users = $userController->getUserList();

//tasks controller
$taskController = new TaskController();

if($type == 'task' || $type == 'case' || $type == 'project') {
    //assignment controller
    $assignmentController = new AssignmentController();
    //assignment list
    $assignments = $assignmentController->getAllAssignments();
}
if($type == 'task' || $type == 'case' || $type == 'assignment') {
    //projects controller
    $projectController = new ProjectController();
    //project list
    $projects = $projectController->getAllProjects();
}
if($type == 'task'){
    //tender controller
    $tenderController = new TenderController();
    //tender list
    $tenders = $tenderController->getAllTenders();

    //case controller
    $caseController = new CaseController();
    //case list
    $caseList = $caseController->getAllCases();
}

$logController = new LogController();

//task submit handler
if (isset($_POST['submitTask'])) {
    include '../app/Model/subTaskAdd.php';
}

//related tasks
if ($type != 'task') {
    ${$typeTasks} = $taskController->getTasksByLinkId($type, $id);
}

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
$notes = $noteController->getNotesByLinkId($typeNumb, ${$typeinfo}['id']);

//item add error
$error = false;

//project assigment handler
if ($type == 'project') {
    //assignment add controller
    if (isset($_POST['submitAssignment'])) {

        //value names
        $valueNames = ["subject", "user", "client", "endDate", "description"];

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
        if (!filter_var($user, FILTER_VALIDATE_INT) && $user !== '0') {
            $error = true;
            $assignment_user_error = true;
        }

        //client filter
        if (!filter_var($client, FILTER_VALIDATE_INT) && $client !== '0') {
            $error = true;
            $assignment_client_error = true;
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
        if ($user == 0) {

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
                'user' => strip_tags($user),
                'description' => strip_tags($description),
                'endDate' => strip_tags($endDate),
                'project' => $id,
                'status' => $status,
                'client' => strip_tags($client)
            ];
            //assignment create
            $assignmentController->create($assignmentinfo);
            $loginfo = [
                'subject' => 'TEXT_ASSIGNMENT_ADDED',
                'description' => 'Task ' . $subject .  ' toegevoegd',
                'date' => date('Y-m-d G:i:s'),
                'user' => $_SESSION['usr_id'],
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
            $valueNames = ["subject", "client", "user", "validity", "value", "chance", "description"];
            break;
        case 'project':
            $valueNames = ["subject", "client", "user", "endDate", "description"];
            break;
        case 'assignment':
            $valueNames = ["subject", "client", "user", "endDate", "description", "projectId"];
            break;
        case 'task':
            $valueNames = ["subject", "client", "user", "project", "assignment", "urgency", "duration", "endDate", "description", "tender", "cases"];
            break;
        case 'case':
            $valueNames = ["subject", "client", "user", "projectId", "assignment", "endDate", "description"];
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
    $intVals = ["client", "user", "validity", "chance", "assignment", "urgency", "duration", "tender", "cases","projectId","project"];
    $floatVals = ["value"];

    //string values filter
    foreach ($stringVals as $sVal) {
        if (isset(${$sVal})) {
            ${$sVal} =  trim(${$sVal});
            if (!filter_var(${$sVal}, FILTER_SANITIZE_STRING)) {
                $error = true;
                $sVal_error = $type . '_' . $sVal . '_error';
                ${$sVal_error} = true;
                echo $sVal;
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
    //error check
    if (!$error) {
        //ongoing status setter
        if ($user == 0) {

            //open status
            $status = 0;
        } else {

            //ongoing status
            $status = 1;
        }

        //value array set
        ${$typeinfo} = [
            'id' => $id,
            'status' => $status
        ];
        foreach ($valueNames as $v) {
            ${$typeinfo}[$v] = ${$v};
        }

        //item update
        ${$typeController}->update(${$typeinfo});
        $logController = new LogController();
        $loginfo = [
            'subject' => 'TEXT_' . strtoupper($type) . '_EDITED',
            'description' => 'Project ' . ${$typeinfo}['subject'] .  ' toegevoegd',
            'date' => date('Y-m-d G:i:s'),
            'user' => $_SESSION['usr_id'],
            'linkType' => $typeNumb,
            'linkId' => $id
        ];
        $logController->create($loginfo);
    }
}

//log controller
$logController = new LogController();

//related logs
$logs = $logController->getLogsByLinkId($typeNumb, ${$typeinfo}['id']);

//delete handler
if (isset($_POST['delete'])) {

    //delete item
    if (${$typeController}->delete($id)) {
        $block->Redirect('index.php?page=' . $type . 'soverview');
    }
}
